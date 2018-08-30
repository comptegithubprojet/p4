<?php

namespace OC\ReservationBundle\PrixBillet;

use \Datetime;

class OCPrixBillet
{
	private $repositoryPrix;

	public function __construct($repositoryPrix)
	{
		$this->repositoryPrix = $repositoryPrix;
	}


	/**
	 * Associe une entité Prix à l'entité Billet
	 *
	 * @param entity $commande
	 * @return 
	 */
	public function determinationPrixBillet($commande)
	{


		$listPrix = $this->repositoryPrix->findAll();

		foreach($commande->getBillets() as $billet)
		{
			$now = new DateTime;
			$dateNaissance = $billet->getDateNaissance();
			$interval = $dateNaissance->diff($now);
			$age = $interval->format('%y');

			foreach ($listPrix as $prix)
			{
				if($age <= $prix->getAgeMax() && $age >= $prix->getAgeMin())
				{
					$billet->setPrix($prix);
				}
			}

		}
	}
}