<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PanierRepository")
 */
class Panier
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="Article")
     */
    private $commande;

    /**
     * @ORM\ManyToOne(targetEntity="User")
     */
    private $user;




    public function getId()
    {
        return $this->id;
    }

    public function getCommande(): ?article
    {
        return $this->commande;
    }

    public function setCommande(?article $commande): self
    {
        $this->commande = $commande;

        return $this;
    }

    public function getUser(): ?user
    {
        return $this->user;
    }

    public function setUser(?user $user): self
    {
        $this->user = $user;

        return $this;
    }
}
