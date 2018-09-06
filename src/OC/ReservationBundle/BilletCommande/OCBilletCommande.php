<?php

namespace OC\ReservationBundle\BilletCommande;

class OCBilletCommande
{
	/**
	 * Associe l'entité commande à l'entité billet
	 *
	 * @param entity $commande
	 */
	public function associeBilletCommande($commande)
    {
		foreach($commande->getBillets() as $billet)
        {
            $billet->setCommande($commande);               
        }
    }
}