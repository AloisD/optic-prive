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
#[ApiResource]
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
}
