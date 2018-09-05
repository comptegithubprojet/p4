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
        $session = $this->container->get('session');

        $commande = $session->get('commande');

        $this->container->get('oc_reservation.stripepaiement')->validationPaiement($commande);

        if($commande::PAIEMENT_VALIDE !== null) 
        {
            $envoiBillet = $this->container->get('oc_reservation.envoibillet');
            $codeBillet = $this->container->get('oc_reservation.codebillet');

            foreach ($commande->getBillets() as $billet) 
            {
                $codeBillet->genereCode($billet);
                $envoiBillet->envoiBilletMail($billet, $commande);
            }

            $em = $this->getDoctrine()->getManager();

            foreach($commande->getBillets() as $billet)
            {
                $billet->setCommande($commande);               
            }

            $em->persist($commande);
            $em->flush();

            $session->set('commande', null);

            return $this->redirectToRoute("oc_reservation_home");
        }
        elseif($commande::PAIEMENT_NON_VALIDE !== null)
        {
            return $this->redirectToRoute("oc_reservation_recapitulatif");
        }
    }
}