<?php

namespace OC\ReservationBundle\Validator;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use \Datetime;
use \DateTimeZone;

class TypeDateValidator extends ConstraintValidator
{
	public function validate($value, Constraint $constraint)
  	{  		
  		$commande = $this->context->getObject();

		$typeVisite = $commande->getType();

		if($typeVisite == "Journée")
		{
			$maintenant = new DateTime;
			$maintenant->setTimezone(new DateTimeZone('Europe/Paris'));

			$dateVisite = $commande->getJour();

			if($maintenant->format('%y%m%d') == $dateVisite->format('%y%m%d'))
			{
				$heure = $maintenant->format('H');

				if($heure >= 14)
				{
					$this->context->addViolation($constraint->message);
				}
			}
		}
	}
}