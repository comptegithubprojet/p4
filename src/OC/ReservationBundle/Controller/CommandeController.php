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
        'commande' => $commande,
        ));
    }

    public function recapitulatifAction()
    {
        $commande = $this->container->get('session')->get('commande');

        $this->container->get('oc_reservation.prixbillet')->determinationPrixBillet($commande);
        $this->container->get('oc_reservation.prixtotal')->determinationPrixTotal($commande);

        return $this->render('OCReservationBundle:Commande:recapitulatif.html.twig', array(
        'commande' => $commande,
        ));
    }

    public function checkoutAction()
    {
        \Stripe\Stripe::setApiKey("SK_PUBLIC_TEST_API");

        // Get the credit card details submitted by the form
        $token = $_POST['stripeToken'];

        // Create a charge: this will charge the user's card
        try {
            $charge = \Stripe\Charge::create(array(
                "amount" => 1000, // Amount in cents
                "currency" => "eur",
                "source" => $token,
                "description" => "Paiement Stripe - OpenClassrooms Exemple"
            ));
            $this->addFlash("success","Bravo ça marche !");
            return $this->redirectToRoute("oc_reservation_home");
        } catch(\Stripe\Error\Card $e) {

            $this->addFlash("error","Snif ça marche pas :(");
            return $this->redirectToRoute("oc_reservation_recapitulatif");
            // The card has been declined
        }
    }
}