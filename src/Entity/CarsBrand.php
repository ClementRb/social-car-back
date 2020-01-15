<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CarsBrandRepository")
 */
class CarsBrand implements \JsonSerializable
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
    private $Name;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\CarModels", mappedBy="carBrand", orphanRemoval=true)
     */
    private $carModels;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Car", mappedBy="brand", orphanRemoval=true)
     */
    private $cars;

    public function __construct()
    {
        $this->carModels = new ArrayCollection();
        $this->cars = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->Name;
    }

    public function setName(string $Name): self
    {
        $this->Name = $Name;

        return $this;
    }

    /**
     * @return Collection|CarModels[]
     */
    public function getCarModels(): Collection
    {
        return $this->carModels;
    }

    public function addCarModel(CarModels $carModel): self
    {
        if (!$this->carModels->contains($carModel)) {
            $this->carModels[] = $carModel;
            $carModel->setCarBrand($this);
        }

        return $this;
    }

    public function removeCarModel(CarModels $carModel): self
    {
        if ($this->carModels->contains($carModel)) {
            $this->carModels->removeElement($carModel);
            // set the owning side to null (unless already changed)
            if ($carModel->getCarBrand() === $this) {
                $carModel->setCarBrand(null);
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
            $car->setBrand($this);
        }

        return $this;
    }

    public function removeCar(Car $car): self
    {
        if ($this->cars->contains($car)) {
            $this->cars->removeElement($car);
            // set the owning side to null (unless already changed)
            if ($car->getBrand() === $this) {
                $car->setBrand(null);
            }
        }

        return $this;
    }

    public function jsonSerialize()
    {
        return [
            'name' => $this->getName()
        ];
    }


}
