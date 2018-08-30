<?php

namespace OC\ReservationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Commande
 *
 * @ORM\Table(name="commande")
 * @ORM\Entity(repositoryClass="OC\ReservationBundle\Repository\CommandeRepository")
 */
class Commande
{
    /**
     * @ORM\OneToOne(targetEntity="OC\ReservationBundle\Entity\Type", cascade={"persist"})
     */
    private $type;

    /**
     * @ORM\OneToMany(targetEntity="OC\ReservationBundle\Entity\Billet", mappedBy="commande")
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
     */
    private $jour;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255)
     */
    private $email;

    /**
     * @var int
     *
     * @ORM\Column(name="prixTotal", type="integer")
     */
    private $prixTotal;

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
     * Constructor
     */
    public function __construct()
    {
        $this->billets = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set type.
     *
     * @param \OC\ReservationBundle\Entity\Type|null $type
     *
     * @return Commande
     */
    public function setType(\OC\ReservationBundle\Entity\Type $type = null)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type.
     *
     * @return \OC\ReservationBundle\Entity\Type|null
     */
    public function getType()
    {
        return $this->type;
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
}
