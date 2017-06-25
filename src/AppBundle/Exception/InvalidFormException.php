<?php

namespace AppBundle\Exception;

use Symfony\Component\Form\FormInterface;

class InvalidFormException extends \RuntimeException
{
    /**
     * @var FormInterface
     */
    protected $form;

    /**
     * InvalidFormException constructor.
     *
     * @param string $message
     * @param int $code
     * @param FormInterface|null $form
     * @param \Throwable|null $previousException
     */
    public function __construct($message, $code = 422, FormInterface $form = null, \Throwable $previousException = null)
    {
        parent::__construct($message, $code, $previousException);
        $this->form = $form;
    }

    /**
     * @return FormInterface
     */
    public function getForm()
    {
        return $this->form;
    }
}
