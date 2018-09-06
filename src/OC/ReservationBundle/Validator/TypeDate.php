<?php

namespace OC\ReservationBundle\Validator;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class TypeDate extends Constraint
{
	public $message = "Vous ne pouvez pas reserver avec le type de billet journée pour aujourd hui";

	public function validatedBy()
	{
		return 'oc_reservation_typedate'; 
	}
}