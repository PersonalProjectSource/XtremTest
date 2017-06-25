<?php

namespace AppBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class PostalCode extends Constraint
{
    public $message = 'Valeur non autorisée.';
}
