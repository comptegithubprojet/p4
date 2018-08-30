<?php

namespace OC\ReservationBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session;
use OC\ReservationBundle\Entity\Commande;
use OC\ReservationBundle\Entity\Billet;
use OC\ReservationBundle\Form\CommandeType;
use OC\ReservationBundle\Form\CommandeBilletType;

class CommandeController extends Controller
{
    public function indexAction(Request $request)
    {
        $commande = new Commande();
        $form   = $this->get('form.factory')->create(CommandeType::class, $commande);

        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid())
        {
            $this->get('session')->set('commande', $commande);

            return $this->redirectToRoute('oc_reservation_billet');
        }

        return $this->render('OCReservationBundle:Commande:index.html.twig', array(
        'form' => $form->createView(),
        ));
    }

    public function billetAction(Request $request)
    {   
        $commande = $this->container->get('session')->get('commande');
        $form   = $this->get('form.factory')->create(CommandeBilletType::class, $commande);

        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid())
        {
            $this->get('session')->set('commande', $commande);

            return $this->redirectToRoute('oc_reservation_recapitulatif');
        }

        return $this->render('OCReservationBundle:Commande:billet.html.twig', array(
        'form' => $form->createView(),
        ));
    }

    public function recapitulatifAction()
    {
        $commande = $this->container->get('session')->get('commande');

        return $this->render('OCReservationBundle:Commande:recapitulatif.html.twig', array(
        'commande' => $commande,
        ));
    }
}