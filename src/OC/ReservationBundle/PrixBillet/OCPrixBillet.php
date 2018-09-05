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
		$tarifGratuit = $this->repositoryPrix->findOneBy(array('nom' => 'Gratuit'));
		$tarifEnfant = $this->repositoryPrix->findOneBy(array('nom' => 'Enfant'));
		$tarifNormal = $this->repositoryPrix->findOneBy(array('nom' => 'Normal'));
		$tarifSenior = $this->repositoryPrix->findOneBy(array('nom' => 'Senior'));
		$tarifReduit = $this->repositoryPrix->findOneBy(array('nom' => 'Reduit'));

		$listPrix = array($tarifGratuit, $tarifEnfant, $tarifNormal, $tarifSenior);

		foreach($commande->getBillets() as $billet)
		{
			$now = new DateTime;
			$dateNaissance = $billet->getDateNaissance();
			$interval = $dateNaissance->diff($now);
			$age = $interval->format('%y');

			foreach ($listPrix as $prix)
			{
				if($billet->getReduction() == true && $age >= 12)
				{
					$billet->setPrixValeur($tarifReduit->getValeur());
					$billet->setPrixNom($tarifReduit->getNom());
				}
				elseif($billet->getReduction() == false && $age <= $prix->getAgeMax() && $age >= $prix->getAgeMin())
				{			
					$billet->setPrixValeur($prix->getValeur());
					$billet->setPrixNom($prix->getNom());		
				}
			}

		}
	}
}