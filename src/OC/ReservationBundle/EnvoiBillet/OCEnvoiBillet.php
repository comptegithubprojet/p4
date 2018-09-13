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
		$message = (new \Swift_Message('Reservation musée du Louvre '.$billet->getNom()))
        ->setFrom('reizswety@gmail.com')
        ->setTo($commande->getEmail());

        $logo = $message->embed(\Swift_Image::fromPath('bundles/ocreservation/img/logo.png'));
        $codebarre = $message->embed(\Swift_Image::fromPath('bundles/ocreservation/img/codebarre.png'));

        $message->setBody(
            $this->templating->render('OCReservationBundle:Email:billet.html.twig', array(
            	'billet' => $billet,
            	'commande' => $commande,
            	'logo' => $logo,
            	'codebarre' => $codebarre,
            )),
            'text/html'
        )
        ;

        $this->mailer->send($message);
	}
}