<?php

namespace OC\ReservationBundle\EnvoiBillet;

class OCEnvoiBillet
{
	private $mailer;
	private $templating;

	public function __construct(\Swift_Mailer $mailer, $templating)
	{
		$this->mailer = $mailer;
		$this->templating = $templating;
	} 
	/**
	 * Envoi les billets par email
	 *
	 * @param entity $billet
	 * @return 
	 */
	public function envoiBilletMail($billet, $commande)
	{
		$message = (new \Swift_Message('Hello Email'))
        ->setFrom('reizswety@gmail.com')
        ->setTo($commande->getEmail())
        ->setBody(
            $this->templating->render(
                'OCReservationBundle:Email:billet.html.twig',
                array('billet' => $billet)
            ),
            'text/html'
        )
        ;

        $this->mailer->send($message);
	}
}