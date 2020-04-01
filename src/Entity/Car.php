<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CarRepository")
 */
class Car implements \JsonSerializable
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\CarsBrand", inversedBy="cars")
     * @ORM\JoinColumn(nullable=false)
     */
    private $brand;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\CarModels", inversedBy="cars")
     * @ORM\JoinColumn(nullable=false)
     */
    private $Model;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\CarSubmodels", inversedBy="cars")
     * @ORM\JoinColumn(nullable=false)
     */
    private $SubModel;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="cars")
     * @ORM\JoinColumn(nullable=false)
     */
    private $User;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Garage", inversedBy="cars")
     * @ORM\JoinColumn(nullable=true)
     */
    private $Garage;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSubModel(): ?CarSubmodels
    {
        return $this->SubModel;
    }

    public function setSubModel(?CarSubmodels $SubModel): self
    {
        $this->SubModel = $SubModel;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->User;
    }

    public function setUser(?User $User): self
    {
        $this->User = $User;

        return $this;
    }


    public function getBrand(): ?CarsBrand
    {
        return $this->brand;
    }

    public function setBrand(?CarsBrand $brand): self
    {
        $this->brand = $brand;

        return $this;
    }

    public function getModel(): ?CarModels
    {
        return $this->Model;
    }

    public function setModel(?CarModels $Model): self
    {
        $this->Model = $Model;

        return $this;
    }
    public function getGarage(): ?Garage
    {
        return $this->Garage;
    }

    public function setGarage(?Garage $Garage): self
    {
        $this->Garage = $Garage;

        return $this;
    }

    public function jsonSerialize()
    {
        return [
            'id' => $this->getId(),
            'brand' => $this->getBrand(),
            'model' => $this->getModel(),
            'subModel' => $this->getSubModel(),
            ];
    }

}
