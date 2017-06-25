<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Contact;
use AppBundle\Exception\InvalidFormException;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\View\View;
use Nelmio\ApiDocBundle\Annotation as Doc;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\ConstraintViolationListInterface;

/**
 * @Route("api/{version}", defaults={"version": "v1"})
 */
class ContactController extends FOSRestController
{
    /**
     * @param Request $request
     *
     * @Rest\Post("/contact", name="app_api_post_contact", options={"expose"=true})
     *
     * @Rest\View(statusCode=201)
     *
     * @return View
     *
     * @Doc\ApiDoc(
     *      section="Contact",
     *      description="Creates a new contact.",
     *      statusCodes={
     *          201="Returned if contact has been successfully created",
     *          422="Returned if errors",
     *          500="Returned if server error"
     *      }
     * )
     */
    public function postContactAction(Request $request)
    {
        try {
            $contact = $this->get('app.form.handler.contact')->handle($request);

            return $this->view($contact);
        } catch (InvalidFormException $e) {
            return $this->view($e->getForm(), $e->getCode());
        }
    }
}
