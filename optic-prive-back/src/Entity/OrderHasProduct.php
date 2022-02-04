<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\OrderHasProductRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OrderHasProductRepository::class)]
#[ApiResource]
class OrderHasProduct
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'integer')]
    private $quantity;

    #[ORM\Column(type: 'enumOrderStatus')]
    private $order_has_product_status;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $rating;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private $rating_date;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $payment_info;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private $payment_date;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $shipping_company;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $tracking_number;

    #[ORM\Column(type: 'decimal', precision: 5, scale: 2, nullable: true)]
    private $price_paid_excl_tax;

    #[ORM\Column(type: 'decimal', precision: 5, scale: 2, nullable: true)]
    private $price_paid__incl_vat;

    #[ORM\Column(type: 'decimal', precision: 5, scale: 2, nullable: true)]
    private $shipping_cost_paid;

    #[ORM\Column(type: 'decimal', precision: 5, scale: 2, nullable: true)]
    private $plateform_fee_paid;

    #[ORM\Column(type: 'datetime_immutable')]
    private $createdAt;

    #[ORM\Column(type: 'datetime_immutable')]
    private $updatedAt;

    #[ORM\ManyToOne(targetEntity: Product::class, inversedBy: 'orderHasProducts')]
    #[ORM\JoinColumn(nullable: false)]
    private $product;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): self
    {
        $this->quantity = $quantity;

        return $this;
    }

    public function getOrderHasProductStatus()
    {
        return $this->order_has_product_status;
    }

    public function setOrderHasProductStatus($order_has_product_status): self
    {
        $this->order_has_product_status = $order_has_product_status;

        return $this;
    }

    public function getRating(): ?int
    {
        return $this->rating;
    }

    public function setRating(?int $rating): self
    {
        $this->rating = $rating;

        return $this;
    }

    public function getRatingDate(): ?\DateTimeInterface
    {
        return $this->rating_date;
    }

    public function setRatingDate(?\DateTimeInterface $rating_date): self
    {
        $this->rating_date = $rating_date;

        return $this;
    }

    public function getPaymentInfo(): ?string
    {
        return $this->payment_info;
    }

    public function setPaymentInfo(?string $payment_info): self
    {
        $this->payment_info = $payment_info;

        return $this;
    }

    public function getPaymentDate(): ?\DateTimeInterface
    {
        return $this->payment_date;
    }

    public function setPaymentDate(?\DateTimeInterface $payment_date): self
    {
        $this->payment_date = $payment_date;

        return $this;
    }

    public function getShippingCompany(): ?string
    {
        return $this->shipping_company;
    }

    public function setShippingCompany(?string $shipping_company): self
    {
        $this->shipping_company = $shipping_company;

        return $this;
    }

    public function getTrackingNumber(): ?string
    {
        return $this->tracking_number;
    }

    public function setTrackingNumber(?string $tracking_number): self
    {
        $this->tracking_number = $tracking_number;

        return $this;
    }

    public function getPricePaidExclTax(): ?string
    {
        return $this->price_paid_excl_tax;
    }

    public function setPricePaidExclTax(?string $price_paid_excl_tax): self
    {
        $this->price_paid_excl_tax = $price_paid_excl_tax;

        return $this;
    }

    public function getPricePaidInclVat(): ?string
    {
        return $this->price_paid__incl_vat;
    }

    public function setPricePaidInclVat(?string $price_paid__incl_vat): self
    {
        $this->price_paid__incl_vat = $price_paid__incl_vat;

        return $this;
    }

    public function getShippingCostPaid(): ?string
    {
        return $this->shipping_cost_paid;
    }

    public function setShippingCostPaid(?string $shipping_cost_paid): self
    {
        $this->shipping_cost_paid = $shipping_cost_paid;

        return $this;
    }

    public function getPlateformFeePaid(): ?string
    {
        return $this->plateform_fee_paid;
    }

    public function setPlateformFeePaid(?string $plateform_fee_paid): self
    {
        $this->plateform_fee_paid = $plateform_fee_paid;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeImmutable $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function getProduct(): ?Product
    {
        return $this->product;
    }

    public function setProduct(?Product $product): self
    {
        $this->product = $product;

        return $this;
    }
}
