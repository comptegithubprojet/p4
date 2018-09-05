<?php

namespace OC\ReservationBundle\Validator;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use \Datetime;
use \DateTimeZone;

class TypeDateValidator extends ConstraintValidator
{
	private $session;

	public function __construct($session)
	{
		$this->session = $session;
	}

	public function validate($value, Constraint $constraint)
  	{
  		$commande = $this->session->get('commande');

  		\Doctrine\Common\Util\Debug::dump($commande);

		$typeVisite = $commande->getType();

		if($typeVisite == "Journée")
		{
			$maintenant = new DateTime;
			$maintenant->setTimezone(new DateTimeZone('Europe/Paris'));

			$dateVisite = $commande->getJour();

			$interval = $maintenant->diff($dateVisite);
			$differenceJour = $interval->format('%a');

			$heure = $maintenant->format('H');

			if($differenceJour == 0)
			{
				if($heure > 14)
				{
					$this->context->addViolation($constraint->message);
				}
			}
		}
	}
}