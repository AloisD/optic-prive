<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\BusinessUserRepository;
use Doctrine\ORM\Mapping as ORM;
use Knp\DoctrineBehaviors\Contract\Entity\TimestampableInterface;
use Knp\DoctrineBehaviors\Model\Timestampable\TimestampableTrait;

#[ORM\Entity(repositoryClass: BusinessUserRepository::class)]
#[ApiResource]
class BusinessUser implements TimestampableInterface
{
    use TimestampableTrait;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $country;

    #[ORM\Column(type: 'string', length: 255)]
    private $city;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $street;

    #[ORM\Column(type: 'integer', nullable: true)]
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

    #[ORM\Column(type: 'integer')]
    private $platform_fee_rate;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $discounted_fee;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private $discount_validity_end;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'businessUsers')]
    #[ORM\JoinColumn(nullable: false)]
    private $user;

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

    public function getPlatformFeeRate(): ?int
    {
        return $this->platform_fee_rate;
    }

    public function setPlatformFeeRate(int $platform_fee_rate): self
    {
        $this->platform_fee_rate = $platform_fee_rate;

        return $this;
    }

    public function getDiscountedFee(): ?int
    {
        return $this->discounted_fee;
    }

    public function setDiscountedFee(?int $discounted_fee): self
    {
        $this->discounted_fee = $discounted_fee;

        return $this;
    }

    public function getDiscountValidityEnd(): ?\DateTimeInterface
    {
        return $this->discount_validity_end;
    }

    public function setDiscountValidityEnd(?\DateTimeInterface $discount_validity_end): self
    {
        $this->discount_validity_end = $discount_validity_end;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }
}
