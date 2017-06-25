<?php
namespace AppBundle\Form\Handler;

use AppBundle\Entity\Contact;
use AppBundle\Exception\InvalidFormException;
use AppBundle\Form\Type\ContactType;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Manager\ContactManagerInterface;
use Symfony\Component\HttpFoundation\Response;

class ContactFormHandler implements FormHandlerInterface
{
    /**
     *
     * @var ContactManagerInterface
     */
    private $manager;

    /**
     * @var FormFactoryInterface
     */
    protected $formFactory;

    /**
     * @param ContactManagerInterface $contactManager
     * @param FormFactoryInterface $formFactory
     */
    public function __construct(ContactManagerInterface $contactManager, FormFactoryInterface $formFactory)
    {
        $this->manager = $contactManager;
        $this->formFactory = $formFactory;
    }

    /**
     * @param Request $request
     *
     * @return Contact
     *
     * @throws InvalidFormException
     */
    public function handle(Request $request)
    {
        $data = $this->convertData($request->request->all());
        $form = $this->formFactory->create(
            ContactType::class,
                new Contact(),
                ['method' => $request->getMethod()]);

        // to work, we have to pass the entity name as key, like:
        // {"contact": {"gender": "mister", "name": "Brau", "firstName": "laurent"}}
        //$form->handleRequest($request);

        // to work, we don't have to pass the entity name as key, like:
        // {"gender": "mister", "name": "Brau", "firstName": "laurent"}
        $form->submit($data, $request->getMethod() !== 'PATCH');

        if ($form->isSubmitted() && !$form->isValid()) {
            throw new InvalidFormException('Invalid submitted data', Response::HTTP_UNPROCESSABLE_ENTITY, $form);
        }

        $contact = $form->getData();
        $this->manager->save($contact);

        return $contact;
    }

    /**
     * @param array $data
     *
     * @return array
     */
    protected function convertData(array $data)
    {
        return [
            'gender' => isset($data['gender']) ? $data['gender'] : "",
            'name' => isset($data['name']) ? $data['name'] : "",
            'firstName' => isset($data['firstName']) ? $data['firstName']: "",
            'postalCode' => isset($data['postalCode']) ? (int) $data['postalCode']: "",
            'mail' => isset($data['mail']) ? $data['mail'] : "",
            'phone' => isset($data['phone']) ? $data['phone'] : "",
            'actuality' => isset($data['actuality']) ? $this->convertBoolean($data['actuality']) : false,
            'offer' => isset($data['offer']) ? $this->convertBoolean($data['offer']) : false ,
        ];
    }

    /**
     * @param $boolean
     *
     * @return bool
     */
    protected function convertBoolean($boolean)
    {
        if (is_string($boolean)) {
            if ("false" === $boolean || "0" === $boolean) {
                return false;
            }

            return true;
        }

        return boolval($boolean);
    }
}