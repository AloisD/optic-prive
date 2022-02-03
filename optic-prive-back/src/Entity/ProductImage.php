<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\ProductImageRepository;
use Doctrine\ORM\Mapping as ORM;
use Knp\DoctrineBehaviors\Contract\Entity\TimestampableInterface;
use Knp\DoctrineBehaviors\Model\Timestampable\TimestampableTrait;

#[ORM\Entity(repositoryClass: ProductImageRepository::class)]
#[ApiResource]
class ProductImage implements TimestampableInterface
{
  use TimestampableTrait;

  #[ORM\Id]
  #[ORM\GeneratedValue]
  #[ORM\Column(type: 'integer')]
  private $id;

  #[ORM\Column(type: 'string', length: 255)]
  private $path;

  public function getId(): ?int
  {
    return $this->id;
  }

  public function getPath(): ?string
  {
    return $this->path;
  }

  public function setPath(string $path): self
  {
    $this->path = $path;

    return $this;
  }
}
