<?php

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\PostalCode;

class LoadPostalCodeData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        for ($i = 1; $i <= 20; $i++) {
            $postalCode = new PostalCode();
            $postalCode->setCode(75000 + $i);
            $manager->persist($postalCode);
        }

        $manager->flush();
    }

    public function getOrder()
    {
        return 1;
    }
}
