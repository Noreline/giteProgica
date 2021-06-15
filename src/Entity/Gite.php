<?php

namespace App\Entity;

use App\Repository\GiteRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=GiteRepository::class)
 */
class Gite
{
    /**
    * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank()
     */
    private $address;

    /**
     * @ORM\Column(type="integer")
     * @Assert\NotBlank()
     */
    private $superficy;

    /**
     * @ORM\Column(type="integer")
     * @Assert\NotBlank()
     */
    private $bedroom;

    /**
     * @ORM\Column(type="integer")
     * @Assert\NotBlank()
     */
    private $nbBed;

    /**
     * @ORM\Column(type="boolean")
     * @Assert\NotBlank()
     */
    private $animals;

    /**
     * @ORM\Column(type="float")
     * @Assert\NotBlank()
     */
    private $priceAnimals;

    /**
     * @ORM\Column(type="float")
     * @Assert\NotBlank()
     */
    private $priceHightSeason;

    /**
     * @ORM\Column(type="float")
     * @Assert\NotBlank()
     */
    private $priceLowSeason;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank()
     * @Assert\Length(min=5,max=40, minMessage="Nom trop court",maxMessage="Nom trop long")
     */
    private $name;

    /**
     * @ORM\Column(type="text")
     * @Assert\NotBlank()
     * @Assert\Length(min=100,max=500, minMessage="Description trop courte",maxMessage="Description trop longue")
     */
    private $descript;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getSuperficy(): ?int
    {
        return $this->superficy;
    }

    public function setSuperficy(int $superficy): self
    {
        $this->superficy = $superficy;

        return $this;
    }

    public function getBedroom(): ?int
    {
        return $this->bedroom;
    }

    public function setBedroom(int $bedroom): self
    {
        $this->bedroom = $bedroom;

        return $this;
    }

    public function getNbBed(): ?int
    {
        return $this->nbBed;
    }

    public function setNbBed(int $nbBed): self
    {
        $this->nbBed = $nbBed;

        return $this;
    }

    public function getAnimals(): ?bool
    {
        return $this->animals;
    }

    public function setAnimals(bool $animals): self
    {
        $this->animals = $animals;

        return $this;
    }

    public function getPriceAnimals(): ?float
    {
        return $this->priceAnimals;
    }

    public function setPriceAnimals(float $priceAnimals): self
    {
        $this->priceAnimals = $priceAnimals;

        return $this;
    }

    public function getPriceHightSeason(): ?float
    {
        return $this->priceHightSeason;
    }

    public function setPriceHightSeason(float $priceHightSeason): self
    {
        $this->priceHightSeason = $priceHightSeason;

        return $this;
    }

    public function getPriceLowSeason(): ?float
    {
        return $this->priceLowSeason;
    }

    public function setPriceLowSeason(float $priceLowSeason): self
    {
        $this->priceLowSeason = $priceLowSeason;

        return $this;
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

    public function getDescript(): ?string
    {
        return $this->descript;
    }

    public function setDescript(string $descript): self
    {
        $this->descript = $descript;

        return $this;
    }
}
