<?php

namespace OC\ReservationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use OC\ReservationBundle\Validator\TypeDate;
use OC\ReservationBundle\Validator\CapaciteMax;

/**
 * Commande
 *
 * @ORM\Table(name="commande")
 * @ORM\Entity(repositoryClass="OC\ReservationBundle\Repository\CommandeRepository")
 */
class Commande
{
    const PAIEMENT_NON_VALIDE = 1;
    const PAIEMENT_VALIDE = 2;
    
    /**
     * @ORM\OneToMany(targetEntity="OC\ReservationBundle\Entity\Billet", mappedBy="commande", cascade={"persist"})
     */
    private $billets; 

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="jour", type="date")
     * @CapaciteMax()
     */
    private $jour;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255)
     * @Assert\Email(message="Merci de renseigner un email valide")
     */
    private $email;

    /**
     * @var int
     *
     * @ORM\Column(name="nbBillets", type="integer")
     * @Assert\Range(min=1, max=10, minMessage="Le nombre de billets doit etre compris entre 1 et 10", maxMessage="Le nombre de billets doit etre compris entre 1 et 10")
     */
    private $nbBillets;

    /**
     * @var int
     *
     * @ORM\Column(name="prixTotal", type="integer")
     */
    private $prixTotal;


    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=255)
     * @TypeDate()
     */
    private $type;


    /**
     * Constructor
     */
    public function __construct()
    {
        $this->billets = new \Doctrine\Common\Collections\ArrayCollection();
    }


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
     * Set jour.
     *
     * @param \DateTime $jour
     *
     * @return Commande
     */
    public function setJour($jour)
    {
        $this->jour = $jour;

        return $this;
    }

    /**
     * Get jour.
     *
     * @return \DateTime
     */
    public function getJour()
    {
        return $this->jour;
    }

    /**
     * Set email.
     *
     * @param string $email
     *
     * @return Commande
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email.
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Add billet.
     *
     * @param \OC\ReservationBundle\Entity\Billet $billet
     *
     * @return Commande
     */
    public function addBillet(\OC\ReservationBundle\Entity\Billet $billet)
    {
        $this->billets[] = $billet;

        return $this;
    }

    /**
     * Remove billet.
     *
     * @param \OC\ReservationBundle\Entity\Billet $billet
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeBillet(\OC\ReservationBundle\Entity\Billet $billet)
    {
        return $this->billets->removeElement($billet);
    }

    /**
     * Get billets.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getBillets()
    {
        return $this->billets;
    }

    /**
     * Set prixTotal.
     *
     * @param int $prixTotal
     *
     * @return Commande
     */
    public function setPrixTotal($prixTotal)
    {
        $this->prixTotal = $prixTotal;

        return $this;
    }

    /**
     * Get prixTotal.
     *
     * @return int
     */
    public function getPrixTotal()
    {
        return $this->prixTotal;
    }

    /**
     * Set nbBillets.
     *
     * @param int $nbBillets
     *
     * @return Commande
     */
    public function setNbBillets($nbBillets)
    {
        $this->nbBillets = $nbBillets;

        return $this;
    }

    /**
     * Get nbBillets.
     *
     * @return int
     */
    public function getNbBillets()
    {
        return $this->nbBillets;
    }

    /**
     * Set type.
     *
     * @param string $type
     *
     * @return Commande
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type.
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }
}
