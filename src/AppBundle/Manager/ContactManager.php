<?php

namespace AppBundle\Manager;

use AppBundle\Entity\Contact;
use AppBundle\Repository\ContactRepositoryInterface;
use Doctrine\Common\Persistence\ObjectManager;

class ContactManager implements ContactManagerInterface
{
    /**
     * @var ContactRepositoryInterface
     */
    private $contactRepository;

    /**
     * @param ContactRepositoryInterface $contactRepository
     */
    public function __construct(ContactRepositoryInterface $contactRepository)
    {
        $this->contactRepository = $contactRepository;
    }

    /**
     * {@inheritdoc}
     */
    public function save(Contact $contact)
    {
        $this->contactRepository->save($contact);
    }
}