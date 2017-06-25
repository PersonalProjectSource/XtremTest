<?php

namespace AppBundle\Validator\Constraints;

use AppBundle\Repository\PostalCodeRepository;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;

class PostalCodeValidator extends ConstraintValidator
{
    /**
     * @var PostalCodeRepository
     */
    private $postalCodeRepository;

    public function __construct(PostalCodeRepository $postalCodeRepository)
    {
        $this->postalCodeRepository = $postalCodeRepository;
    }

    /**
     * {@inheritDoc}
     */
    public function validate($value, Constraint $constraint)
    {
        if (!$constraint instanceof PostalCode) {
            throw new UnexpectedTypeException($constraint, __NAMESPACE__.'\PostalCode');
        }

        if (!preg_match("/^(([0-8][0-9])|(9[0-5]))[0-9]{3}/", $value) || !in_array($value, $this->postalCodeRepository->getByPostalCode())) {
            $this->context->addViolation($constraint->message);
        }
    }
}
