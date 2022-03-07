<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiProperty;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiSubresource;
use App\Repository\SegmentRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Knp\DoctrineBehaviors\Contract\Entity\TimestampableInterface;
use Knp\DoctrineBehaviors\Model\Timestampable\TimestampableTrait;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: SegmentRepository::class)]
#[ApiResource]
class Segment implements TimestampableInterface
{
  use TimestampableTrait;

  #[ORM\Id]
  #[ORM\GeneratedValue]
  #[ORM\Column(type: 'integer')]
  #[ApiProperty(identifier: false)]
  private $id;

  #[ORM\Column(type: 'string', length: 255)]
  #[Groups(["product_details_read", "product_read"])]
  #[ApiProperty(identifier: true)]
  private $name;

  #[ORM\Column(type: 'string', length: 255, nullable: true)]
  private $logo;

  #[ORM\OneToMany(mappedBy: 'segment', targetEntity: Product::class)]
  #[ApiSubresource()]
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
          $product->setSegment($this);
      }

      return $this;
  }

  public function removeProduct(Product $product): self
  {
      if ($this->products->removeElement($product)) {
          // set the owning side to null (unless already changed)
          if ($product->getSegment() === $this) {
              $product->setSegment(null);
          }
      }

      return $this;
  }

  public function __toString()
  {
    return $this->name;
  }
}
