<?php
namespace App\Entity;
use Doctrine\ORM\Mapping as ORM;
/**
 * @ORM\Entity
 * @ORM\Table(name="Apartment")
 */
class Apartment extends AbstractProperty{
    /**
     * @ORM\Column(type="boolean")
     */
    protected $balcony;

    public function getBalcony(): ?bool
    {
        return $this->balcony;
    }

    public function setBalcony(bool $balcony): self
    {
        $this->balcony = $balcony;

        return $this;
    }
}