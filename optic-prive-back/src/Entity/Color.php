<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\ColorRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Knp\DoctrineBehaviors\Contract\Entity\TimestampableInterface;
use Knp\DoctrineBehaviors\Model\Timestampable\TimestampableTrait;

#[ORM\Entity(repositoryClass: ColorRepository::class)]
#[ApiResource]
class Color implements TimestampableInterface
{
  use TimestampableTrait;

  #[ORM\Id]
  #[ORM\GeneratedValue]
  #[ORM\Column(type: 'integer')]
  private $id;

  #[ORM\Column(type: 'string', length: 255)]
  private $name;

  #[ORM\Column(type: 'string', length: 255, nullable: true)]
  private $logo;

  #[ORM\OneToMany(mappedBy: 'color', targetEntity: Product::class)]
  private $products;

  public function __construct()
  {
      $this->products = new ArrayCollection();
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

  public function getLogo(): ?string
  {
    return $this->logo;
  }

  public function setLogo(?string $logo): self
  {
    $this->logo = $logo;

    return $this;
  }

  /**
   * @return Collection|Product[]
   */
  public function getProducts(): Collection
  {
      return $this->products;
  }

  public function addProduct(Product $product): self
  {
      if (!$this->products->contains($product)) {
          $this->products[] = $product;
          $product->setColor($this);
      }

      return $this;
  }

  public function removeProduct(Product $product): self
  {
      if ($this->products->removeElement($product)) {
          // set the owning side to null (unless already changed)
          if ($product->getColor() === $this) {
              $product->setColor(null);
          }
      }

      return $this;
  }
}
