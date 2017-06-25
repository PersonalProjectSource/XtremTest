<?php

namespace AppBundle\Repository;

use AppBundle\Entity\Contact;

interface ContactRepositoryInterface
{
    /**
     * @param Contact $contact
     *
     * @return mixed
     */
    public function save(Contact $contact);
}