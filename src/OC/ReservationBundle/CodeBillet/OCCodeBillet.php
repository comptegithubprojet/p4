<?php

namespace OC\ReservationBundle\CodeBillet;

class OCCodeBillet
{
	/**
	 * Associe un attribut code à l'entité billet
	 *
	 * @param entity $billet
	 * @return 
	 */
	public function genereCode($billet)
    {
        $chars = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
		$code = "";

		for ($i = 0; $i < 30; $i++) 
		{
    		$code .= $chars[mt_rand(0, strlen($chars)-1)];
		}

		$billet->setCode($code);
    }
}