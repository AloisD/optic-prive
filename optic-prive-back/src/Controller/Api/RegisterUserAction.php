<?php

namespace App\Controller\Api;

use App\Entity\Product;
use App\Entity\ProductImage;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

#[AsController]
final class RegisterUserAction extends AbstractController
{
  private $encoder;
  private $manager;

  public function __construct(UserPasswordHasherInterface $encoder, EntityManagerInterface $manager)
  {
    $this->encoder = $encoder;
    $this->manager = $manager;
  }

  public function __invoke(User $data, Request $request): User
  {
    $hash = $this->encoder->hashPassword($data, $data->getPassword());
    $data->setPassword($hash);
    $this->manager->persist($data);
    $this->manager->flush();
    return $data;
  }
}
