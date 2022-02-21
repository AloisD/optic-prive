<?php

namespace App\Controller\Api;

use App\Entity\User;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Serializer\SerializerInterface;

#[AsController]
class MeAction extends AbstractController
{

  public function __construct(private Security $security, private SerializerInterface $serializer)
  {
  }

  public function __invoke()
  {
    return $this->json($this->security->getUser(), 200, [], ['groups' => 'read_profile']);
  }
}
