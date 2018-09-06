<?php

namespace OC\PlatformBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use OC\ReservationBundle\Entity\Commande;
use \Datetime;

class LoadCommande implements FixtureInterface
{
	public function load(ObjectManager $manager)
    {
		$listCommande = [];

		for($i = 0; $i < 100; $i++)
		{
			$commande = new Commande();
			$commande->setJour(new DateTime('2018-10-31'));
			$commande->setEmail('test@mail.com');
			$commande->setPrixTotal('1');
			$commande->setNbBillets('10');
			$commande->setType('Journée');

			$listCommande[$i] = $commande;
		}

		foreach($listCommande as $commande)
		{
			$manager->persist($commande);
		}
		
		$manager->flush();
	}
}