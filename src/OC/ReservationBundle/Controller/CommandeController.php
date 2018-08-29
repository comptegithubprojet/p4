<?php

namespace OC\ReservationBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use OC\ReservationBundle\Entity\Commande;
use OC\ReservationBundle\Form\CommandeType;

class CommandeController extends Controller
{
    public function indexAction()
    {
        $commande = new Commande();
        $form   = $this->get('form.factory')->create(CommandeType::class, $commande);

        return $this->render('OCReservationBundle:Commande:index.html.twig', array(
        'form' => $form->createView(),
        ));
    }

    public function billetAction()
    {
        return $this->render('OCReservationBundle:Commande:billet.html.twig');
    }

    public function recapitulatifAction()
    {
        return $this->render('OCReservationBundle:Commande:recapitulatif.html.twig');
    }
}