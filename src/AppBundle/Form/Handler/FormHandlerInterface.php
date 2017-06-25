<?php

namespace AppBundle\Form\Handler;

use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;

interface FormHandlerInterface
{
    /**
     * handles the form
     *
     * @param Request $request
     */
    public function handle(Request $request);
}