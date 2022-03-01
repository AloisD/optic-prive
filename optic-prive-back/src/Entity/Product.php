<?php

namespace App\Entity;

use App\Entity\Brand;
use App\Entity\Shape;
use App\Entity\Style;
use App\Entity\Segment;
use App\Entity\LensType;
use App\Entity\ProductImage;
use App\Entity\OrderHasProduct;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\ProductRepository;
use App\Controller\Api\ProductImageAction;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;
use Knp\DoctrineBehaviors\Model\Sluggable\SluggableTrait;
use Knp\DoctrineBehaviors\Contract\Entity\SluggableInterface;
use Knp\DoctrineBehaviors\Contract\Entity\TimestampableInterface;
use Knp\DoctrineBehaviors\Model\Timestampable\TimestampableTrait;
use App\Controller\Api;
use App\Controller\Api\ProductLatestAction;
use App\Controller\Api\ProductSegmentAction;

#[ORM\Entity(repositoryClass: ProductRepository::class)]
#[ApiResource(
  collectionOperations: [
    'get' => [
      'normalization_context' => ['groups' => ['product_read']],
    ],
    "post",
    'product_latest' => [
      'normalization_context' => ['groups' => ['product_read']],
      'method' => 'GET',
      'pagination_enabled' =>  false,
      'path' => '/products/latest',
      'controller' => ProductLatestAction::class,
      'deserialize' => false
    ],
    'product_solaires' => [
      'normalization_context' => ['groups' => ['product_read']],
      'method' => 'GET',
      'pagination_enabled' =>  true,
      'path' => '/products/solaires',
      'controller' => ProductSegmentAction::class,
      'deserialize' => false
    ],
  ],
  itemOperations: [
    'get' => [
      'normalization_context' => ['groups' => ['product_details_read']],
    ],
    'put',
    'delete',
    'product_image' => [
      'method' => 'POST',
      'path' => '/products/{id}/image',
      'controller' => ProductImageAction::class,
      'deserialize' => false,
      'openapi_context' => [
        'requestBody' => [
          'content' => [
            'multipart/form-data' => [
              'schema' => [
                'type' => 'object',
                'properties' => [
                  'image' => [
                    'type' => 'string',
                    'format' => 'binary',
                  ],
                ],
              ],
            ],
          ],
        ],
      ],
    ]
  ],
)]
class Product implements SluggableInterface, TimestampableInterface
{
  use SluggableTrait;
  use TimestampableTrait;

  #[ORM\Id]
  #[ORM\GeneratedValue]
  #[ORM\Column(type: 'integer')]
  #[Groups(["product_read", "product_details_read"])]
  private $id;

  #[Groups(["product_read", "product_details_read"])]
  #[ORM\Column(type: 'string', length: 255)]
  private $name;

  #[ORM\Column(type: 'string', length: 255)]
  #[Groups(["product_read", "product_details_read"])]
  private $reference;

  #[ORM\Column(type: 'string', length: 255)]
  #[Groups(["product_read", "product_details_read"])]
  private $color_code;

  #[ORM\Column(type: 'decimal', precision: 5, scale: '2')]
  #[Groups(["product_read", "product_details_read"])]
  private $retail_price;

  #[ORM\Column(type: 'decimal', precision: 5, scale: '2')]
  #[Groups(["product_read", "product_details_read"])]
  private $selling_price;

  #[ORM\Column(type: 'integer')]
  #[Groups(["product_read", "product_details_read"])]
  private $quantity;

  #[ORM\Column(type: 'integer', nullable: true)]
  #[Groups(["product_details_read"])]
  private $eye_size;

  #[ORM\Column(type: 'integer', nullable: true)]
  #[Groups(["product_details_read"])]
  private $bridge_size;

  #[ORM\Column(type: 'integer', nullable: true)]
  #[Groups(["product_details_read"])]
  private $temple_length;

  #[ORM\Column(type: 'enumState')]
  #[Groups(["product_details_read"])]
  private $state;

  #[ORM\Column(type: 'enumCategory')]
  #[Groups(["product_details_read"])]
  private $category;

  #[ORM\Column(type: 'enumUvProtection', nullable: true)]
  #[Groups(["product_details_read"])]
  private $uv_protection;

  #[ORM\Column(type: 'enumItemAvailability', nullable: false)]
  private $item_availability;

  #[ORM\ManyToOne(targetEntity: Brand::class, inversedBy: 'products')]
  #[ORM\JoinColumn(nullable: false)]
  #[Groups(["product_read", "product_details_read"])]
  private $brand;

  #[ORM\ManyToOne(targetEntity: Shape::class, inversedBy: 'products')]
  #[ORM\JoinColumn(nullable: false)]
  #[Groups(["product_details_read"])]
  private $shape;

  #[ORM\ManyToOne(targetEntity: Segment::class, inversedBy: 'products')]
  #[ORM\JoinColumn(nullable: false)]
  #[Groups(["product_details_read"])]
  private $segment;

  #[ORM\ManyToOne(targetEntity: LensType::class, inversedBy: 'products')]
  #[ORM\JoinColumn(nullable: false)]
  #[Groups(["product_details_read"])]
  private $lens_type;

  #[ORM\ManyToOne(targetEntity: Style::class, inversedBy: 'products')]
  #[ORM\JoinColumn(nullable: false)]
  #[Groups(["product_details_read"])]
  private $style;

  #[ORM\ManyToOne(targetEntity: Color::class, inversedBy: 'products')]
  #[ORM\JoinColumn(nullable: false)]
  #[Groups(["product_details_read"])]
  private $color;

  #[ORM\ManyToOne(targetEntity: Material::class, inversedBy: 'products')]
  #[ORM\JoinColumn(nullable: false)]
  #[Groups(["product_details_read"])]
  private $material;

  #[ORM\OneToMany(mappedBy: 'product', targetEntity: ProductImage::class, cascade: ['persist'], orphanRemoval: true)]
  #[Groups(["product_read", "product_details_read"])]
  private $productImages;

  #[ORM\OneToMany(mappedBy: 'product', targetEntity: OrderHasProduct::class)]
  private $orderHasProducts;

  public function __construct()
  {
    $this->productImages = new ArrayCollection();
    $this->orderHasProducts = new ArrayCollection();
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

  public function getReference(): ?string
  {
    return $this->reference;
  }

  public function setReference(string $reference): self
  {
    $this->reference = $reference;

    return $this;
  }

  public function getColorCode(): ?string
  {
    return $this->color_code;
  }

  public function setColorCode(string $color_code): self
  {
    $this->color_code = $color_code;

    return $this;
  }

  public function getRetailPrice(): ?string
  {
    return $this->retail_price;
  }

  public function setRetailPrice(string $retail_price): self
  {
    $this->retail_price = $retail_price;

    return $this;
  }

  public function getSellingPrice(): ?string
  {
    return $this->selling_price;
  }

  public function setSellingPrice(string $selling_price): self
  {
    $this->selling_price = $selling_price;

    return $this;
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

  public function getEyeSize(): ?int
  {
    return $this->eye_size;
  }

  public function setEyeSize(?int $eye_size): self
  {
    $this->eye_size = $eye_size;

    return $this;
  }

  public function getBridgeSize(): ?int
  {
    return $this->bridge_size;
  }

  public function setBridgeSize(?int $bridge_size): self
  {
    $this->bridge_size = $bridge_size;

    return $this;
  }

  public function getTempleLength(): ?int
  {
    return $this->temple_length;
  }

  public function setTempleLength(?int $temple_length): self
  {
    $this->temple_length = $temple_length;

    return $this;
  }

  public function getState()
  {
    return $this->state;
  }

  public function setState($state): self
  {
    $this->state = $state;

    return $this;
  }

  public function getCategory()
  {
    return $this->category;
  }

  public function setCategory($category): self
  {
    $this->category = $category;

    return $this;
  }

  public function getUvProtection()
  {
    return $this->uv_protection;
  }

  public function setUvProtection($uv_protection): self
  {
    $this->uv_protection = $uv_protection;

    return $this;
  }

  public function getItemAvailability()
  {
    return $this->item_availability;
  }

  public function setItemAvailability($item_availability): self
  {
    $this->item_availability = $item_availability;

    return $this;
  }

  public function getBrand(): ?Brand
  {
    return $this->brand;
  }

  public function setBrand(?Brand $brand): self
  {
    $this->brand = $brand;

    return $this;
  }

  /**
   * @return string[]
   */
  public function getSluggableFields(): array
  {
    return ['name'];
  }

  public function getShape(): ?Shape
  {
    return $this->shape;
  }

  public function setShape(?Shape $shape): self
  {
    $this->shape = $shape;

    return $this;
  }

  public function getSegment(): ?Segment
  {
    return $this->segment;
  }

  public function setSegment(?Segment $segment): self
  {
    $this->segment = $segment;

    return $this;
  }

  public function getLensType(): ?LensType
  {
    return $this->lens_type;
  }

  public function setLensType(?LensType $lens_type): self
  {
    $this->lens_type = $lens_type;

    return $this;
  }

  public function getStyle(): ?Style
  {
    return $this->style;
  }

  public function setStyle(?Style $style): self
  {
    $this->style = $style;

    return $this;
  }

  public function getColor(): ?Color
  {
    return $this->color;
  }

  public function setColor(?Color $color): self
  {
    $this->color = $color;

    return $this;
  }

  public function getMaterial(): ?Material
  {
    return $this->material;
  }

  public function setMaterial(?Material $material): self
  {
    $this->material = $material;

    return $this;
  }

  /**
   * @return Collection|ProductImage[]
   */
  public function getProductImages(): Collection
  {
    return $this->productImages;
  }

  public function addProductImage(ProductImage $productImage): self
  {
    if (!$this->productImages->contains($productImage)) {
      $this->productImages[] = $productImage;
      $productImage->setProduct($this);
    }

    return $this;
  }

  public function removeProductImage(ProductImage $productImage): self
  {
    if ($this->productImages->removeElement($productImage)) {
      // set the owning side to null (unless already changed)
      if ($productImage->getProduct() === $this) {
        $productImage->setProduct(null);
      }
    }

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
      $orderHasProduct->setProduct($this);
    }

    return $this;
  }

  public function removeOrderHasProduct(OrderHasProduct $orderHasProduct): self
  {
    if ($this->orderHasProducts->removeElement($orderHasProduct)) {
      // set the owning side to null (unless already changed)
      if ($orderHasProduct->getProduct() === $this) {
        $orderHasProduct->setProduct(null);
      }
    }

    return $this;
  }

  public function __toString()
  {
    return $this->name;
  }
}
