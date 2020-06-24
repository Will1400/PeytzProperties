<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

abstract class AbstractProperty
{

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    protected $id;

      /**
     * @ORM\Column(type="integer")
     */
    protected $ownerId;

    /**
     * @ORM\Column(type="string", length=180)
     */
    protected $address;

    /**
     * @ORM\Column(type="integer")
     */
    protected $area;

    /**
     * @ORM\Column(type="integer")
     */
    protected $price;

    /**
     * @ORM\Column(type="boolean")
     */
    protected $forSale;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getOwnerId(): ?int
    {
        return $this->ownerId;
    }
    public function setOwnerId($ownerId): self
    {
        $this->ownerId = $ownerId;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function getArea(): ?int
    {
        return $this->area;
    }

    public function setArea(int $area): self
    {
        $this->area = $area;

        return $this;
    }

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(int $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getForSale(): ?bool
    {
        return $this->forSale;
    }

    public function setForSale(bool $forSale): self
    {
        $this->forSale = $forSale;

        return $this;
    }
}
