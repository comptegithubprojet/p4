<?php

namespace OC\ReservationBundle\OCFormBillets;

class OCFormBillets
{
	private $number;

	public function __construct($number)
	{
		$this->number = $number;
	}

	public function createFormBillets($number)
	{
		for( $i= 0 ; $i <= $number ; $i++ )
		{

		}
	}
}