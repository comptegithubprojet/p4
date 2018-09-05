<?php

namespace OC\ReservationBundle\Validator;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class TypeDate extends Constraint
{
	public $message = "Vous ne pouvez pas reserver pour le jour meme avec le type de billet journée";

	public function validatedBy()
	{
		return 'oc_reservation_typedate'; 
	}
}