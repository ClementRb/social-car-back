<?php
// src/Entity/User.php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Car", mappedBy="User", orphanRemoval=true)
     */
    private $Cars;

    /**
     * @ORM\Column(type="string", unique=true, nullable=true)
     */
    private $apiToken;

    public function __construct()
    {
        parent::__construct();
        $this->Cars = new ArrayCollection();
        // your own logic
    }

    /**
     * @return Collection|Car[]
     */
    public function getCars(): Collection
    {
        return $this->Cars;
    }

    public function addCars(Car $Cars): self
    {
        if (!$this->Cars->contains($Cars)) {
            $this->Cars[] = $Cars;
            $Cars->setUser($this);
        }

        return $this;
    }

    public function removeCars(Car $Cars): self
    {
        if ($this->Cars->contains($Cars)) {
            $this->Cars->removeElement($Cars);
            // set the owning side to null (unless already changed)
            if ($Cars->getUser() === $this) {
                $Cars->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return mixed
     */
    public function getApiToken()
    {
        return $this->apiToken;
    }

    /**
     * @param mixed $apiToken
     */
    public function setApiToken($apiToken): void
    {
        $this->apiToken = $apiToken;
    }
}