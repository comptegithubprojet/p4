<?php

namespace OC\ReservationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Billet
 *
 * @ORM\Table(name="billet")
 * @ORM\Entity(repositoryClass="OC\ReservationBundle\Repository\BilletRepository")
 */
class Billet
{

    /**
     * @ORM\OneToOne(targetEntity="OC\ReservationBundle\Entity\Prix", cascade={"persist"})
     */
    private $prix;

    /**
     * @ORM\ManyToOne(targetEntity="OC\ReservationBundle\Entity\Commande", inversedBy="billets")
     * @ORM\JoinColumn(nullable=false)
     */
    private $commande;


    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=255)
     * @Assert\Length(min=3, max=20, minMessage="Merci de rentrer un nom valide", maxMessage="Merci de rentrer un nom valide")
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="prenom", type="string", length=255)
     * @Assert\Length(min=3, max=20, minMessage="Merci de rentrer un nom valide", maxMessage="Merci de rentrer un nom valide")
     */
    private $prenom;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateNaissance", type="date")
     */
    private $dateNaissance;

    /**
     * @var string
     *
     * @ORM\Column(name="pays", type="string", length=255)
     * @Assert\Country()
     */
    private $pays;

    /**
     * @var bool
     *
     * @ORM\Column(name="reduction", type="boolean", options={"default":false})
     */
    private $reduction;


    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nom.
     *
     * @param string $nom
     *
     * @return Billet
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom.
     *
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set prenom.
     *
     * @param string $prenom
     *
     * @return Billet
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * Get prenom.
     *
     * @return string
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * Set dateNaissance.
     *
     * @param \DateTime $dateNaissance
     *
     * @return Billet
     */
    public function setDateNaissance($dateNaissance)
    {
        $this->dateNaissance = $dateNaissance;

        return $this;
    }

    /**
     * Get dateNaissance.
     *
     * @return \DateTime
     */
    public function getDateNaissance()
    {
        return $this->dateNaissance;
    }

    /**
     * Set reduction.
     *
     * @param bool $reduction
     *
     * @return Billet
     */
    public function setReduction($reduction)
    {
        $this->reduction = $reduction;

        return $this;
    }

    /**
     * Get reduction.
     *
     * @return bool
     */
    public function getReduction()
    {
        return $this->reduction;
    }

    /**
     * Set prix.
     *
     * @param \OC\ReservationBundle\Entity\Prix|null $prix
     *
     * @return Billet
     */
    public function setPrix(\OC\ReservationBundle\Entity\Prix $prix = null)
    {
        $this->prix = $prix;

        return $this;
    }

    /**
     * Get prix.
     *
     * @return \OC\ReservationBundle\Entity\Prix|null
     */
    public function getPrix()
    {
        return $this->prix;
    }

    /**
     * Set commande.
     *
     * @param \OC\ReservationBundle\Entity\Commande $commande
     *
     * @return Billet
     */
    public function setCommande(\OC\ReservationBundle\Entity\Commande $commande)
    {
        $this->commande = $commande;

        return $this;
    }

    /**
     * Get commande.
     *
     * @return \OC\ReservationBundle\Entity\Commande
     */
    public function getCommande()
    {
        return $this->commande;
    }

    /**
     * Set pays.
     *
     * @param string $pays
     *
     * @return Billet
     */
    public function setPays($pays)
    {
        $this->pays = $pays;

        return $this;
    }

    /**
     * Get pays.
     *
     * @return string
     */
    public function getPays()
    {
        return $this->pays;
    }
}
