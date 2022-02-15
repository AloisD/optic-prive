<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\ProductImageRepository;
use Doctrine\ORM\Mapping as ORM;
use Knp\DoctrineBehaviors\Contract\Entity\TimestampableInterface;
use Knp\DoctrineBehaviors\Model\Timestampable\TimestampableTrait;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\HttpFoundation\File\File;

#[ORM\Entity(repositoryClass: ProductImageRepository::class)]
#[ApiResource]
/**
 * @Vich\Uploadable
 */
class ProductImage implements TimestampableInterface
{
  use TimestampableTrait;

  #[ORM\Id]
  #[ORM\GeneratedValue]
  #[ORM\Column(type: 'integer')]
  private $id;

  #[ORM\Column(type: 'string', length: 255)]
  private $path;

  /**
   * @Vich\UploadableField(mapping="product_image", fileNameProperty="path")
   * @var File
   */
  private $image;

  #[ORM\ManyToOne(targetEntity: Product::class, inversedBy: 'productImages')]
  #[ORM\JoinColumn(nullable: false)]
  private $product;

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

  public function getProduct(): ?Product
  {
      return $this->product;
  }

  public function setProduct(?Product $product): self
  {
      $this->product = $product;

      return $this;
  }

  public function __toString()
  {
    return $this->getPath();
  }


  /**
   * If manually uploading a file (i.e. not using Symfony Form) ensure an instance
   * of 'UploadedFile' is injected into this setter to trigger the update. If this
   * bundle's configuration parameter 'inject_on_load' is set to 'true' this setter
   * must be able to accept an instance of 'File' as the bundle will inject one here
   * during Doctrine hydration.
   *
   * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile|null $imageFile
   */
  public function setImage(?File $image = null): void
  {
    $this->image = $image;

    if (null !== $image) {
      // It is required that at least one field changes if you are using doctrine
      // otherwise the event listeners won't be called and the file is lost
      $this->updatedAt = new \DateTimeImmutable();
    }
  }

  public function getImage(): ?File
  {
    return $this->image;
  }

}
