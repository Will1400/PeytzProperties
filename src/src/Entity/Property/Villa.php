<?php
namespace App\Entity;
use Doctrine\ORM\Mapping as ORM;
/**
 * @ORM\Entity
 * @ORM\Table(name="villa")
 */
class Villa extends AbstractProperty{

    /**
     * @ORM\Column(type="integer")
     */
    protected $gardenArea;

    public function getGardenArea(): ?int
    {
        return $this->gardenArea;
    }

    public function setGardenArea(int $gardenArea): self
    {
        $this->gardenArea = $gardenArea;

        return $this;
    }
}