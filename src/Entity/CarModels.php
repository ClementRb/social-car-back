<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CarModelsRepository")
 */
class CarModels implements \JsonSerializable
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\CarsBrand", inversedBy="carModels")
     * @ORM\JoinColumn(nullable=false)
     */
    private $carBrand;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\CarSubmodels", mappedBy="carModel")
     */
    private $carSubmodels;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Car", mappedBy="Model", orphanRemoval=true)
     */
    private $cars;

    public function __construct()
    {
        $this->carSubmodels = new ArrayCollection();
        $this->cars = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getCarBrand(): ?CarsBrand
    {
        return $this->carBrand;
    }

    public function setCarBrand(?CarsBrand $carBrand): self
    {
        $this->carBrand = $carBrand;

        return $this;
    }

    /**
     * @return Collection|CarSubmodels[]
     */
    public function getCarSubmodels(): Collection
    {
        return $this->carSubmodels;
    }

    public function addCarSubmodel(CarSubmodels $carSubmodel): self
    {
        if (!$this->carSubmodels->contains($carSubmodel)) {
            $this->carSubmodels[] = $carSubmodel;
            $carSubmodel->setCarModel($this);
        }

        return $this;
    }

    public function removeCarSubmodel(CarSubmodels $carSubmodel): self
    {
        if ($this->carSubmodels->contains($carSubmodel)) {
            $this->carSubmodels->removeElement($carSubmodel);
            // set the owning side to null (unless already changed)
            if ($carSubmodel->getCarModel() === $this) {
                $carSubmodel->setCarModel(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Car[]
     */
    public function getCars(): Collection
    {
        return $this->cars;
    }

    public function addCar(Car $car): self
    {
        if (!$this->cars->contains($car)) {
            $this->cars[] = $car;
            $car->setModel($this);
        }

        return $this;
    }

    public function removeCar(Car $car): self
    {
        if ($this->cars->contains($car)) {
            $this->cars->removeElement($car);
            // set the owning side to null (unless already changed)
            if ($car->getModel() === $this) {
                $car->setModel(null);
            }
        }

        return $this;
    }

    public function jsonSerialize()
    {
        return [
            'id' => $this->getId(),
            'name' => $this->getName()
        ];
    }
}
