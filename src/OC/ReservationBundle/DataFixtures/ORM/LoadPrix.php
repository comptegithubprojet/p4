<?php

namespace OC\PlatformBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use OC\ReservationBundle\Entity\Prix;

class LoadPrix implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $prix1 = new Prix();
        $prix2 = new Prix();
        $prix3 = new Prix();
        $prix4 = new Prix();

        $prix1->setNom('Enfant');
        $prix1->setValeur('8');
        $prix1->setAgeMin('4');
        $prix1->setAgeMax('11');

        $prix2->setNom('Normal');
        $prix2->setValeur('16');
        $prix2->setAgeMin('12');
        $prix2->setAgeMax('59');

        $prix3->setNom('Senior');
        $prix3->setValeur('12');
        $prix3->setAgeMin('60');
        $prix3->setAgeMax('100');

        $prix4->setNom('Reduit');
        $prix4->setValeur('10');
        $prix4->setAgeMin('12');
        $prix4->setAgeMax('100');


        $manager->persist($prix1);
        $manager->persist($prix2);
        $manager->persist($prix3);
        $manager->persist($prix4);

        $manager->flush();
    }
}