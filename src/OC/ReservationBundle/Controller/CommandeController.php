<?php

namespace OC\ReservationBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class CommandeController extends Controller
{
    public function indexAction()
    {
        return $this->render('OCReservationBundle:Commande:index.html.twig');
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