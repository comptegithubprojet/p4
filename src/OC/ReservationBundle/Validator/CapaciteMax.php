<?php

namespace OC\ReservationBundle\Validator;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class CapaciteMax extends Constraint
{
	public $message = "Vous ne pouvez pas reserver pour ce jour car la capacité maximale du musée a été atteinte";

	public function validatedBy()
	{
		return 'oc_reservation_capacitemax'; 
	}
}