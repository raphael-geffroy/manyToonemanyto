<?php

namespace App\Entity;

use App\Repository\PriceRepository;
use App\Repository\ProductRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProductRepository::class)]
class Product
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToMany(mappedBy: 'product', targetEntity: Price::class, fetch: 'EAGER')]
    private Collection $prices;

    public function __construct()
    {
        $this->prices = new ArrayCollection();
    }

    public function getCurrentPrice(): ?Price
    {
        return $this->prices->matching(PriceRepository::createCurrentCriteria())->first()?:null;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, Price>
     */
    public function getPrices(): Collection
    {
        return $this->prices;
    }

    public function addPrice(Price $price): self
    {
        if (!$this->prices->contains($price)) {
            $this->prices->add($price);
            $price->setProduct($this);
        }

        return $this;
    }

    public function removePrice(Price $price): self
    {
        $this->prices->removeElement($price);
        return $this;
    }
}
