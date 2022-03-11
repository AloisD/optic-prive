<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\OrderRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Knp\DoctrineBehaviors\Contract\Entity\TimestampableInterface;
use Knp\DoctrineBehaviors\Model\Timestampable\TimestampableTrait;

#[ORM\Entity(repositoryClass: OrderRepository::class)]
#[ORM\Table(name: '`order`')]
#[ApiResource()]
class Order implements TimestampableInterface
{
  use TimestampableTrait;

  #[ORM\Id]
  #[ORM\GeneratedValue]
  #[ORM\Column(type: 'integer')]
  private $id;

  #[ORM\Column(type: 'enumOrderStatus')]
  private $order_status;

  #[ORM\OneToMany(mappedBy: 'order', targetEntity: OrderHasProduct::class)]
  private $orderHasProducts;

  #[ORM\ManyToOne(targetEntity: Address::class, inversedBy: 'orders')]
  #[ORM\JoinColumn(nullable: false)]
  private $invoicing_address;

  #[ORM\ManyToOne(targetEntity: Address::class, inversedBy: 'ordres')]
  #[ORM\JoinColumn(nullable: false)]
  private $delivery_address;

  #[ORM\ManyToOne(targetEntity: ShippingOption::class, inversedBy: 'orders')]
  #[ORM\JoinColumn(nullable: false)]
  private $shipping;

  public function __construct()
  {
      $this->orderHasProducts = new ArrayCollection();
  }

  public function getId(): ?int
  {
    return $this->id;
  }

  public function getOrderStatus()
  {
    return $this->order_status;
  }

  public function setOrderStatus($order_status): self
  {
    $this->order_status = $order_status;

    return $this;
  }

  /**
   * @return Collection|OrderHasProduct[]
   */
  public function getOrderHasProducts(): Collection
  {
      return $this->orderHasProducts;
  }

  public function addOrderHasProduct(OrderHasProduct $orderHasProduct): self
  {
      if (!$this->orderHasProducts->contains($orderHasProduct)) {
          $this->orderHasProducts[] = $orderHasProduct;
          $orderHasProduct->setOrder($this);
      }

      return $this;
  }

  public function removeOrderHasProduct(OrderHasProduct $orderHasProduct): self
  {
      if ($this->orderHasProducts->removeElement($orderHasProduct)) {
          // set the owning side to null (unless already changed)
          if ($orderHasProduct->getOrder() === $this) {
              $orderHasProduct->setOrder(null);
          }
      }

      return $this;
  }

  public function getInvoicingAddress(): ?Address
  {
      return $this->invoicing_address;
  }

  public function setInvoicingAddress(?Address $invoicing_address): self
  {
      $this->invoicing_address = $invoicing_address;

      return $this;
  }

  public function getDeliveryAddress(): ?Address
  {
      return $this->delivery_address;
  }

  public function setDeliveryAddress(?Address $delivery_address): self
  {
      $this->delivery_address = $delivery_address;

      return $this;
  }

  public function getShipping(): ?ShippingOption
  {
      return $this->shipping;
  }

  public function setShipping(?ShippingOption $shipping): self
  {
      $this->shipping = $shipping;

      return $this;
  }
}
