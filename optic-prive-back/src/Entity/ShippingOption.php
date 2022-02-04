<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\ShippingOptionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Knp\DoctrineBehaviors\Contract\Entity\TimestampableInterface;
use Knp\DoctrineBehaviors\Model\Timestampable\TimestampableTrait;

#[ORM\Entity(repositoryClass: ShippingOptionRepository::class)]
#[ApiResource]
class ShippingOption implements TimestampableInterface
{
  use TimestampableTrait;

  #[ORM\Id]
  #[ORM\GeneratedValue]
  #[ORM\Column(type: 'integer')]
  private $id;

  #[ORM\Column(type: 'string', length: 255)]
  private $name;

  #[ORM\Column(type: 'decimal', precision: 5, scale: '2')]
  private $price;

  #[ORM\OneToMany(mappedBy: 'shipping', targetEntity: Order::class)]
  private $orders;

  public function __construct()
  {
      $this->orders = new ArrayCollection();
  }

  public function getId(): ?int
  {
    return $this->id;
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

  public function getPrice(): ?string
  {
    return $this->price;
  }

  public function setPrice(string $price): self
  {
    $this->price = $price;

    return $this;
  }

  /**
   * @return Collection|Order[]
   */
  public function getOrders(): Collection
  {
      return $this->orders;
  }

  public function addOrder(Order $order): self
  {
      if (!$this->orders->contains($order)) {
          $this->orders[] = $order;
          $order->setShipping($this);
      }

      return $this;
  }

  public function removeOrder(Order $order): self
  {
      if ($this->orders->removeElement($order)) {
          // set the owning side to null (unless already changed)
          if ($order->getShipping() === $this) {
              $order->setShipping(null);
          }
      }

      return $this;
  }
}
