<?php

namespace AppBundle\Manager;

use AppBundle\Entity\Contact;

interface ContactManagerInterface
{
    /**
     * @param Contact $contact
     */
    public function save(Contact $contact);
}