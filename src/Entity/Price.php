<?php

namespace App\Entity;

use App\Repository\PriceRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PriceRepository::class)]
// La condition where ne s'ajoute pas dans la migration pourtant cela fonctionnait dans notre monorepo
// Donc bool nullable si migration pas auto sinon bool.
#[ORM\UniqueConstraint(name: 'uniq_price__product_id__is_current', fields: ['product', 'isCurrent']/*, options: ['where' => 'is_current']*/)]
class Price
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private int $amount;

    #[ORM\ManyToOne(inversedBy: 'prices')]
    #[ORM\JoinColumn(nullable: false)]
    private Product $product;

    #[ORM\Column(nullable: true)]
    private ?bool $isCurrent = null;

    public function getProduct(): Product
    {
        return $this->product;
    }

    public function setProduct(Product $product): void
    {
        $this->product = $product;
    }

    public function __construct(Product $product, int $amount)
    {
        $this->setProduct($product);
        $this->amount = $amount;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAmount(): int
    {
        return $this->amount;
    }

    public function setAmount(int $amount): self
    {
        $this->amount = $amount;

        return $this;
    }

    /**
     * @return bool|null
     */
    public function getIsCurrent(): ?bool
    {
        return $this->isCurrent;
    }

    /**
     * @param bool|null $isCurrent
     */
    public function setIsCurrent(?bool $isCurrent): void
    {
        $this->isCurrent = $isCurrent;
    }
}
