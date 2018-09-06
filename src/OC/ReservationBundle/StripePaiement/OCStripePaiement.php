<?php

namespace OC\ReservationBundle\StripePaiement;

class OCStripePaiement
{
	/**
	 * Valide ou pas le paiement stripe
	 *
	 * @param entity $commande
	 * @return une const de la classe commande
	 */
	public function validationPaiement($commande)
	{
		\Stripe\Stripe::setApiKey("sk_test_HmGkIffDNEZUY8gNaudbU6v5");

        // Get the credit card details submitted by the form
        $token = $_POST['stripeToken'];

        // Create a charge: this will charge the user's card
        try 
        {
            $charge = \Stripe\Charge::create(array(
                "amount" => $commande->getPrixTotal() * 100, // Amount in cents
                "currency" => "eur",
                "source" => $token,
                "description" => "Paiement Stripe - OpenClassrooms"
            ));
            return $commande::PAIEMENT_VALIDE;
        } 
        catch(\Stripe\Error\Card $e) 
        {
            return $commande::PAIEMENT_NON_VALIDE;
            // The card has been declined
        }
	}
}