<?php

namespace OC\ReservationBundle\PrixTotal;

class OCPrixTotal
{
	/**
	 * Calcul le prix total de la commande et l'associe
	 *
	 * @param entity $commande
	 * @return 
	 */
	public function determinationPrixTotal($commande)
	{
		$prixTotal = 0;

		foreach($commande->getBillets() as $billet)
		{
			$prixTotal += $billet->getPrix()->getValeur();
		}

		$commande->setPrixTotal($prixTotal);
	}
}