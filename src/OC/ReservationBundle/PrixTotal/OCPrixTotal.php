<?php

namespace OC\ReservationBundle\PrixTotal;

class OCPrixTotal
{
	/**
	 * Calcul le prix total de la commande et l'associe avec le setter
	 *
	 * @param entity $commande
	 */
	public function determinationPrixTotal($commande)
	{
		$prixTotal = 0;

		foreach($commande->getBillets() as $billet)
		{
			$prixTotal += $billet->getPrixValeur();
		}

		$commande->setPrixTotal($prixTotal);
	}
}