<?php

namespace OC\ReservationBundle\Validator;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class CapaciteMaxValidator extends ConstraintValidator
{
	private $repositoryCommande;

	public function __construct($repositoryCommande)
	{
		$this->repositoryCommande = $repositoryCommande;
	}

	public function validate($value, Constraint $constraint)
  	{
  		$jourVisite = $this->context->getObject()->getJour();
  		$nbBilletsVisite = $this->context->getObject()->getNbBillets();

  		$listCommande = $this->repositoryCommande->findBy(array('jour' => $jourVisite));

  		$nbBillets = $nbBilletsVisite;

  		foreach($listCommande as $commande)
  		{
  			$nbBillets += $commande->getNbBillets();
  		}

  		if($nbBillets > 1000)
  		{
  			$this->context->addViolation($constraint->message);
  		}
  	}
}