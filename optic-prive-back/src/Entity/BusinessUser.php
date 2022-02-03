<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\BusinessUserRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BusinessUserRepository::class)]
#[ApiResource]
class BusinessUser
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $country;

    #[ORM\Column(type: 'string', length: 255)]
    private $city;

    #[ORM\Column(type: 'string', length: 255)]
    private $street;

    #[ORM\Column(type: 'integer')]
    private $number;

    #[ORM\Column(type: 'string', length: 255)]
    private $company;

    #[ORM\Column(type: 'text', nullable: true)]
    private $additional_details;

    #[ORM\Column(type: 'string', length: 255)]
    private $siren;

    #[ORM\Column(type: 'string', length: 255)]
    private $phone;

    #[ORM\Column(type: 'string', length: 255)]
    private $email;

    #[ORM\Column(type: 'datetime_immutable')]
    private $createdAt;

    #[ORM\Column(type: 'datetime_immutable')]
    private $updatedAt;

    #[ORM\Column(type: 'decimal', precision: 5, scale: 2)]
    private $platform_fee_rate;

    #[ORM\Column(type: 'decimal', precision: 5, scale: 2)]
    private $discounted_fee;

    #[ORM\Column(type: 'datetime')]
    private $discount_validity_end;

    public function getId(): ?int
    {
        return $this->id;
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

    public function setStreet(string $street): self
    {
        $this->street = $street;

        return $this;
    }

    public function getNumber(): ?int
    {
        return $this->number;
    }

    public function setNumber(int $number): self
    {
        $this->number = $number;

        return $this;
    }

    public function getCompany(): ?string
    {
        return $this->company;
    }

    public function setCompany(string $company): self
    {
        $this->company = $company;

        return $this;
    }

    public function getAdditionalDetails(): ?string
    {
        return $this->additional_details;
    }

    public function setAdditionalDetails(?string $additional_details): self
    {
        $this->additional_details = $additional_details;

        return $this;
    }

    public function getSiren(): ?string
    {
        return $this->siren;
    }

    public function setSiren(string $siren): self
    {
        $this->siren = $siren;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeImmutable $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function getPlatformFeeRate(): ?string
    {
        return $this->platform_fee_rate;
    }

    public function setPlatformFeeRate(string $platform_fee_rate): self
    {
        $this->platform_fee_rate = $platform_fee_rate;

        return $this;
    }

    public function getDiscountedFee(): ?string
    {
        return $this->discounted_fee;
    }

    public function setDiscountedFee(string $discounted_fee): self
    {
        $this->discounted_fee = $discounted_fee;

        return $this;
    }

    public function getDiscountValidityEnd(): ?\DateTimeInterface
    {
        return $this->discount_validity_end;
    }

    public function setDiscountValidityEnd(\DateTimeInterface $discount_validity_end): self
    {
        $this->discount_validity_end = $discount_validity_end;

        return $this;
    }
}
