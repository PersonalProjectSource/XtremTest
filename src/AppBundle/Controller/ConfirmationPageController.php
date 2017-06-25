<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class ConfirmationPageController extends Controller
{
    /**
     * @Route("/confirmation", name="confirmation", options={"expose"=true})
     * @Method("GET")
     */
    public function indexAction()
    {
        return $this->render('confirmation_page/index.html.twig');
    }
}
