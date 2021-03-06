<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Controller\Api\MeAction;
use App\Controller\Api\RegisterUserAction;
use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Knp\DoctrineBehaviors\Contract\Entity\TimestampableInterface;
use Knp\DoctrineBehaviors\Model\Timestampable\TimestampableTrait;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ApiResource(
  collectionOperations: [
    'register' => [
      'pagination_enabled' => false,
      'method' => 'POST',
      'path' => '/users/register',
      'controller' => RegisterUserAction::class,
      'read' => false
    ],
    'me' => [
      'pagination_enabled' => false,
      'method' => 'GET',
      'path' => '/me',
      'controller' => MeAction::class,
      'read' => false,
      'normalization_context' => ['groups' => ['read_profile']]
    ]
  ],
  itemOperations: [
    'get' => ['security' => 'is_granted("ROLE_ADMIN") or (is_granted("ROLE_USER") and user.getId() == object.getId())'],
    'put'
  ]
)]
class User implements UserInterface, PasswordAuthenticatedUserInterface, TimestampableInterface
{
  use TimestampableTrait;

  #[ORM\Id]
  #[ORM\GeneratedValue]
  #[ORM\Column(type: 'integer')]
  #[Groups(["read_profile"])]
  private $id;

  #[Groups(["read_profile"])]
  #[ORM\Column(type: 'string', length: 180, unique: true)]
  private $email;

  #[Groups(["read_profile"])]
  #[ORM\Column(type: 'json')]
  private $roles = [];

  #[ORM\Column(type: 'string')]
  private $password;

  #[Groups(["read_profile", "product_read"])]
  #[ORM\Column(type: 'string', length: 255, nullable: true)]
  private $username;

  #[ORM\OneToMany(mappedBy: 'user', targetEntity: BusinessUser::class)]
  private $businessUsers;

  #[ORM\OneToMany(mappedBy: 'user', targetEntity: Address::class, cascade: ['persist'], orphanRemoval: true)]
  private $addresses;

  #[ORM\OneToMany(mappedBy: 'seller', targetEntity: Product::class)]
  private $products;

  #[ORM\OneToMany(mappedBy: 'buyer', targetEntity: Order::class)]
  private $orders;

  public function __construct()
  {
    $this->businessUsers = new ArrayCollection();
    $this->addresses = new ArrayCollection();
    $this->products = new ArrayCollection();
    $this->orders = new ArrayCollection();
  }

  public function getId(): ?int
  {
    return $this->id;
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

  /**
   * A visual identifier that represents this user.
   *
   * @see UserInterface
   */
  public function getUserIdentifier(): string
  {
    return (string) $this->email;
  }

  /**
   * @see UserInterface
   */
  public function getRoles(): array
  {
    $roles = $this->roles;
    // guarantee every user at least has ROLE_USER
    $roles[] = 'ROLE_USER';

    return array_unique($roles);
  }

  public function setRoles(array $roles): self
  {
    $this->roles = $roles;

    return $this;
  }

  /**
   * @see PasswordAuthenticatedUserInterface
   */
  public function getPassword(): string
  {
    return $this->password;
  }

  public function setPassword(string $password): self
  {
    $this->password = $password;

    return $this;
  }

  /**
   * @see UserInterface
   */
  public function eraseCredentials()
  {
    // If you store any temporary, sensitive data on the user, clear it here
    // $this->plainPassword = null;
  }

  public function getUsername(): ?string
  {
    return $this->username;
  }

  public function setUsername(?string $username): self
  {
    $this->username = $username;

    return $this;
  }

  /**
   * @return Collection<int, BusinessUser>
   */
  public function getBusinessUsers(): Collection
  {
    return $this->businessUsers;
  }

  public function addBusinessUser(BusinessUser $businessUser): self
  {
    if (!$this->businessUsers->contains($businessUser)) {
      $this->businessUsers[] = $businessUser;
      $businessUser->setUser($this);
    }

    return $this;
  }

  public function removeBusinessUser(BusinessUser $businessUser): self
  {
    if ($this->businessUsers->removeElement($businessUser)) {
      // set the owning side to null (unless already changed)
      if ($businessUser->getUser() === $this) {
        $businessUser->setUser(null);
      }
    }

    return $this;
  }

  /**
   * @return Collection<int, Address>
   */
  public function getAddresses(): Collection
  {
    return $this->addresses;
  }

  public function addAddress(Address $address): self
  {
    if (!$this->addresses->contains($address)) {
      $this->addresses[] = $address;
      $address->setUser($this);
    }

    return $this;
  }

  public function removeAddress(Address $address): self
  {
    if ($this->addresses->removeElement($address)) {
      // set the owning side to null (unless already changed)
      if ($address->getUser() === $this) {
        $address->setUser(null);
      }
    }

    return $this;
  }

  public function __toString()
  {
    return $this->email;
  }

  /**
   * @return Collection<int, Product>
   */
  public function getProducts(): Collection
  {
    return $this->products;
  }

  public function addProduct(Product $product): self
  {
    if (!$this->products->contains($product)) {
      $this->products[] = $product;
      $product->setSeller($this);
    }

    return $this;
  }

  public function removeProduct(Product $product): self
  {
    if ($this->products->removeElement($product)) {
      // set the owning side to null (unless already changed)
      if ($product->getSeller() === $this) {
        $product->setSeller(null);
      }
    }

    return $this;
  }

  /**
   * @return Collection<int, Order>
   */
  public function getOrders(): Collection
  {
      return $this->orders;
  }

  public function addOrder(Order $order): self
  {
      if (!$this->orders->contains($order)) {
          $this->orders[] = $order;
          $order->setBuyer($this);
      }

      return $this;
  }

  public function removeOrder(Order $order): self
  {
      if ($this->orders->removeElement($order)) {
          // set the owning side to null (unless already changed)
          if ($order->getBuyer() === $this) {
              $order->setBuyer(null);
          }
      }

      return $this;
  }
}
