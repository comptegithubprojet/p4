<?php

namespace OC\ReservationBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class CommandeController extends Controller
{
    public function indexAction()
    {
        return new Response("Page accueil");
    }

    public function billetAction()
    {
        return new Response("Page billet");
    }

    public function recapitulatifAction()
    {
        return new Response("Page recap");
    }
}