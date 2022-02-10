<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\AddressRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Knp\DoctrineBehaviors\Contract\Entity\TimestampableInterface;
use Knp\DoctrineBehaviors\Model\Timestampable\TimestampableTrait;

#[ORM\Entity(repositoryClass: AddressRepository::class)]
#[ApiResource]
class Address implements TimestampableInterface
{
  use TimestampableTrait;

  #[ORM\Id]
  #[ORM\GeneratedValue]
  #[ORM\Column(type: 'integer')]
  private $id;

  #[ORM\Column(type: 'string', length: 255)]
  private $name;

  #[ORM\Column(type: 'string', length: 255)]
  private $recipient;

  #[ORM\Column(type: 'string', length: 255)]
  private $country;

  #[ORM\Column(type: 'string', length: 255)]
  private $city;

  #[ORM\Column(type: 'string', length: 255, nullable: true)]
  private $street;

  #[ORM\Column(type: 'integer', nullable: true)]
  private $number;

  #[ORM\Column(type: 'string', length: 255, nullable: true)]
  private $company;

  #[ORM\Column(type: 'text', nullable: true)]
  private $additionnal_details;

  #[ORM\OneToMany(mappedBy: 'invoicing_address', targetEntity: Order::class)]
  private $orders;

  #[ORM\OneToMany(mappedBy: 'delivery_address', targetEntity: Order::class)]
  private $ordres;

  public function __construct()
  {
      $this->orders = new ArrayCollection();
      $this->ordres = new ArrayCollection();
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

  public function getRecipient(): ?string
  {
    return $this->recipient;
  }

  public function setRecipient(string $recipient): self
  {
    $this->recipient = $recipient;

    return $this;
  }

  public function getCountry(): ?string
  {
    return $this->country;
  }

  public function setCountry(string $country): self
  {
    $this->country = $country;

    return $this;
  }

  public function getCity(): ?string
  {
    return $this->city;
  }

  public function setCity(string $city): self
  {
    $this->city = $city;

    return $this;
  }

  public function getStreet(): ?string
  {
    return $this->street;
  }

  public function setStreet(?string $street): self
  {
    $this->street = $street;

    return $this;
  }

  public function getNumber(): ?int
  {
    return $this->number;
  }

  public function setNumber(?int $number): self
  {
    $this->number = $number;

    return $this;
  }

  public function getCompany(): ?string
  {
    return $this->company;
  }

  public function setCompany(?string $company): self
  {
    $this->company = $company;

    return $this;
  }

  public function getAdditionnalDetails(): ?string
  {
    return $this->additionnal_details;
  }

  public function setAdditionnalDetails(?string $additionnal_details): self
  {
    $this->additionnal_details = $additionnal_details;

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
          $order->setInvoicingAddress($this);
      }

      return $this;
  }

  public function removeOrder(Order $order): self
  {
      if ($this->orders->removeElement($order)) {
          // set the owning side to null (unless already changed)
          if ($order->getInvoicingAddress() === $this) {
              $order->setInvoicingAddress(null);
          }
      }

      return $this;
  }

  /**
   * @return Collection|Order[]
   */
  public function getOrdres(): Collection
  {
      return $this->ordres;
  }

  public function addOrdre(Order $ordre): self
  {
      if (!$this->ordres->contains($ordre)) {
          $this->ordres[] = $ordre;
          $ordre->setDeliveryAddress($this);
      }

      return $this;
  }

  public function removeOrdre(Order $ordre): self
  {
      if ($this->ordres->removeElement($ordre)) {
          // set the owning side to null (unless already changed)
          if ($ordre->getDeliveryAddress() === $this) {
              $ordre->setDeliveryAddress(null);
          }
      }

      return $this;
  }

  public function __toString()
  {
    return $this->recipient. ': ' .$this->name;
  }
}
