<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\ProductRepository;

#[ORM\Entity(repositoryClass: ProductRepository::class)]
#[ApiResource()]
class Product
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $name;

    #[ORM\Column(type: 'string', length: 255)]
    private $reference;

    #[ORM\Column(type: 'string', length: 255)]
    private $color_code;

    #[ORM\Column(type: 'decimal', precision: 5, scale: '2')]
    private $retail_price;

    #[ORM\Column(type: 'decimal', precision: 5, scale: '2')]
    private $selling_price;

    #[ORM\Column(type: 'integer')]
    private $quantity;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $eye_size;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $bridge_size;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $temple_length;

    #[ORM\Column(type: 'datetime_immutable')]
    private $created_at;

    #[ORM\Column(type: 'datetime_immutable')]
    private $updated_at;

    #[ORM\Column(type: 'enumState')]
    private $state;

    #[ORM\Column(type: 'enumCategory')]
    private $category;

    #[ORM\Column(type: 'enumUvProtection', nullable: true)]
    private $uv_protection;

    #[ORM\Column(type: 'enumItemAvailability')]
    private $item_availability;

    #[ORM\ManyToOne(targetEntity: Brand::class, inversedBy: 'products')]
    #[ORM\JoinColumn(nullable: false)]
    private $brand;

    #[ORM\ManyToOne(targetEntity: Shape::class, inversedBy: 'products')]
    #[ORM\JoinColumn(nullable: false)]
    private $shape;

    #[ORM\ManyToOne(targetEntity: Segment::class, inversedBy: 'products')]
    #[ORM\JoinColumn(nullable: false)]
    private $segment;

    #[ORM\ManyToOne(targetEntity: LensType::class, inversedBy: 'products')]
    #[ORM\JoinColumn(nullable: false)]
    private $lens_type;

    #[ORM\ManyToOne(targetEntity: Style::class, inversedBy: 'products')]
    #[ORM\JoinColumn(nullable: false)]
    private $style;

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

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeImmutable $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updated_at;
    }

    public function setUpdatedAt(\DateTimeImmutable $updated_at): self
    {
        $this->updated_at = $updated_at;

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
}
