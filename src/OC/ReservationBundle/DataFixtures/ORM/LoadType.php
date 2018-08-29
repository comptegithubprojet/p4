<?php

namespace OC\PlatformBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use OC\ReservationBundle\Entity\Type;

class LoadType implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $names = array(
            'Journée',
            'Demi-journée'
        );

        foreach ($names as $name) 
        {
            $type = new Type();
            $type->setNom($name);

            $manager->persist($type);
        }

        $manager->flush();
    }
}