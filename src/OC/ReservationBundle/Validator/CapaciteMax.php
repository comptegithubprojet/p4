<?php

namespace OC\ReservationBundle\Validator;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class CapaciteMax extends Constraint
{
	public $message = "Vous ne pouvez pas reserver pour ce jour plus de 1000 billets ont été vendus";

	public function validatedBy()
	{
		return 'oc_reservation_capacitemax'; 
	}
}