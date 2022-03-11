<?php

namespace App\DataFixtures;

use App\Entity\Address;
use App\Entity\Brand;
use App\Entity\Color;
use App\Entity\LensType;
use App\Entity\Material;
use App\Entity\Order;
use App\Entity\OrderHasProduct;
use App\Entity\Product;
use App\Entity\ProductImage;
use App\Entity\Segment;
use App\Entity\Shape;
use App\Entity\ShippingOption;
use App\Entity\Style;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
  private $encoder;

  public function __construct(UserPasswordHasherInterface $encoder)
  {
    $this->encoder = $encoder;
  }

  public function load(ObjectManager $manager): void
  {
    $faker = \Faker\Factory::create();

    $product = new Product();
    $product
      ->setName("aviator classic")
      ->setReference('RB3025 L0205 58-14')
      ->setColorCode('poli or:vert') // monture color : glasses color
      ->setRetailPrice($faker->randomFloat(1, 10, 30))
      ->setSellingPrice($faker->randomFloat(1, 10, 30))
      ->setQuantity($faker->randomNumber(1, true));

    $this->getDataProduct($product, $faker);

    $product1 = new Product();
    $product1
      ->setName("pilot")
      ->setReference('BB4535 F46H 44-97')
      ->setColorCode('noir')
      ->setRetailPrice($faker->randomFloat(1, 10, 30))
      ->setSellingPrice($faker->randomFloat(1, 10, 30))
      ->setQuantity($faker->randomNumber(1, true));

    $this->getDataProduct($product1, $faker);

    $product2 = new Product();
    $product2
      ->setName("classic")
      ->setReference('BRFRF FGG44 56-32')
      ->setColorCode('blanc')
      ->setRetailPrice($faker->randomFloat(1, 10, 30))
      ->setSellingPrice($faker->randomFloat(1, 10, 30))
      ->setQuantity($faker->randomNumber(1, true));

    $this->getDataProduct($product2, $faker);

    //brand
    $brand = new Brand();
    $brand
      ->setName("Hugo Boss")
      ->setLogo("https://fr.wikipedia.org/wiki/Hugo_Boss#/media/Fichier:HUGO-BOSS_POS.png");
    $manager->persist($brand);

    //shape
    $shape = new Shape();
    $shape
      ->setName("square")
      ->setLogo($faker->imageUrl(640, 480, 'animals', true));
    $manager->persist($shape);

    //segment
    $segment = new Segment();
    $segment
      ->setName('solaires')
      ->setLogo($faker->imageUrl(640, 480, 'animals', true));
    $manager->persist($segment);

    $segment2 = new Segment();
    $segment2
      ->setName('sport')
      ->setLogo($faker->imageUrl(640, 480, 'animals', true));
    $manager->persist($segment2);

    $segment3 = new Segment();
    $segment3
      ->setName('lumiere_bleue')
      ->setLogo($faker->imageUrl(640, 480, 'animals', true));
    $manager->persist($segment3);

    $segment4 = new Segment();
    $segment4
      ->setName('vintage')
      ->setLogo($faker->imageUrl(640, 480, 'animals', true));
    $manager->persist($segment4);

    $segment5 = new Segment();
    $segment5
      ->setName('accessoires')
      ->setLogo($faker->imageUrl(640, 480, 'animals', true));
    $manager->persist($segment5);

    //lens_type
    $lensType = new LensType();
    $lensType
      ->setName("soft");
    $manager->persist($lensType);

    //style
    $style = new Style();
    $style
      ->setName("sport");
    $manager->persist($style);

    //color
    $color = new Color();
    $color
      ->setName("black")
      ->setLogo($faker->hexColor());
    $manager->persist($color);

    //material
    $material = new Material();
    $material
      ->setName("titanium")
      ->setLogo($faker->imageUrl(640, 480, 'animals', true));
    $manager->persist($material);

    //product_images
    $productImage = new ProductImage;
    $productImage
      ->setPath("ray-ban-6214c562cd88e070069467.png");
    $manager->persist($productImage);

    $productImage1 = new ProductImage;
    $productImage1
      ->setPath("hugo-boss-boss-1131-s-003ir.jpg");
    $manager->persist($productImage1);

    $productImage2 = new ProductImage;
    $productImage2
      ->setPath("hugo-boss-boss-1131-s-003ir2.jpg");
    $manager->persist($productImage2);

    //shipping
    $shippingOption = new ShippingOption;
    $shippingOption
      ->setName("Livraison Express")
      ->setPrice(5);
    $manager->persist($shippingOption);

    $shippingOption1 = new ShippingOption;
    $shippingOption1
      ->setName("Livraison Gratuite")
      ->setPrice(0);
    $manager->persist($shippingOption1);

    //create some vendors
    $vendor = new User();
    $hash = $this->encoder->hashPassword($vendor, "8888");
    $vendor
      ->setUsername($faker->word())
      ->setPassword($hash)
      ->setEmail($faker->email())
      ->setRoles([
        "ROLE_PRO"
      ])
      ->addProduct($product);

    $manager->persist($vendor);

    $vendor2 = new User();
    $hash = $this->encoder->hashPassword($vendor2, "8888");
    $vendor2
      ->setUsername($faker->word())
      ->setPassword($hash)
      ->setEmail($faker->email())
      ->setRoles([
        "ROLE_PRO"
      ])
      ->addProduct($product1)
      ->addProduct($product2);

    $manager->persist($vendor2);

    // add info to products and persist
    $product
      ->setBrand($brand)
      ->setShape($shape)
      ->setSegment($segment)
      ->setLensType($lensType)
      ->setStyle($style)
      ->setColor($color)
      ->setMaterial($material)
      ->addProductImage($productImage);

    $manager->persist($product);

    $product1
      ->setBrand($brand)
      ->setShape($shape)
      ->setSegment($segment)
      ->setLensType($lensType)
      ->setStyle($style)
      ->setColor($color)
      ->setMaterial($material)
      ->addProductImage($productImage1);

    $manager->persist($product1);

    $product2
      ->setBrand($brand)
      ->setShape($shape)
      ->setSegment($segment)
      ->setLensType($lensType)
      ->setStyle($style)
      ->setColor($color)
      ->setMaterial($material)
      ->addProductImage($productImage2);

    $manager->persist($product2);

    //create some random users
    for ($i = 0; $i < 10; $i++) {
      $admin = new User();
      $hash = $this->encoder->hashPassword($admin, "8888");
      $admin
        ->setUsername($faker->word())
        ->setPassword($hash)
        ->setEmail($faker->email())
        ->setRoles([
          "ROLE_ADMIN"
      ]);

      $manager->persist($admin);
      $manager->flush();
    }
    for ($i = 0; $i < 10; $i++) {
      $user = new User();
      $hash = $this->encoder->hashPassword($user, "8888");
      $user
        ->setUsername($faker->word())
        ->setPassword($hash)
        ->setEmail($faker->email())
        ->setRoles([
          "ROLE_USER"
      ]);

      $manager->persist($user);
      $manager->flush();
    }

    //invoicing_address
    $invoicingAddress = new Address;
    $invoicingAddress
      ->setName("112 avenue Charles de Gaulle")
      ->setRecipient("345 rue Anatole France")
      ->setCountry("France")
      ->setCity("Neuilly-sur-Seine")
      ->setUser($user);
    $manager->persist($invoicingAddress);

    //delivery_address
    $deliveryAddress = new Address;
    $deliveryAddress
      ->setName("345 rue Anatole France")
      ->setRecipient("112 avenue Charles de Gaulle")
      ->setCountry("France")
      ->setCity("Neuilly-sur-Seine")
      ->setUser($user);
    $manager->persist($deliveryAddress);

    //orders
    $order = new Order();
    $order
      ->setInvoicingAddress($invoicingAddress)
      ->setDeliveryAddress($deliveryAddress)
      ->setShipping($shippingOption);

    $this->getDataOrder($order);

    $manager->persist($order);

    //orderHasProduct
    $orderHasProduct = new OrderHasProduct();
    $orderHasProduct
      ->setQuantity(3)
      ->setProduct($product1)
      ->setOrder($order);

    $this->getDataOrderHasProduct($orderHasProduct);

    $manager->persist($orderHasProduct);

    $manager->flush();
  }

  private function getDataProduct(Product $product, $faker)
  {
    $state = $this->getStatusRandom();
    $product->setState($state);

    $category = $this->getCategoryRandom();
    $product->setCategory($category);

    $uvProtection = $this->getUvProtectionRandom();
    $product->setUvProtection($uvProtection);

    $itemAvailability = $this->getItemAvailabilityRandom();
    $product->setItemAvailability($itemAvailability);

    $eyeSize = $this->getEyeSizeRandom($faker);
    $product->setEyeSize($eyeSize);

    $bridgeSize = $this->getBridgeSizeRandom($faker);
    $product->setBridgeSize($bridgeSize);

    $templeLength = $this->getTempleLengthRandom($faker);
    $product->setTempleLength($templeLength);
  }

  private function getDataOrder(Order $order)
  {
    $orderStatus = $this->getOrderStatus();
    $order->setOrderStatus($orderStatus);
  }

  private function getDataOrderHasProduct(OrderHasProduct $orderHasProduct)
  {
    $orderStatus = $this->getOrderStatus();
    $orderHasProduct->setOrderHasProductStatus($orderStatus);
  }


  /** Product *****************************************************************************/

  // get random state
  private function getStatusRandom(): string
  {
    $items = ['damagedCondition', 'newCondition', 'refurbishedCondition', 'usedCondition'];
    return $items[random_int(0, 3)];
  }

  // get random category
  private function getCategoryRandom(): string
  {
    $items = ['male', 'female', 'child', 'unisex'];
    return $items[random_int(0, 3)];
  }

  // get random category
  private function getUvProtectionRandom(): string
  {
    $items = ['category0', 'category1', 'category2', 'category3', 'category4'];
    return $items[random_int(0, 4)];
  }

  private function getItemAvailabilityRandom(): string
  {
    $items = ['backOrder', 'discontinued', 'inStock', 'inStoreOnly', 'limitedAvailability', 'onlineOnly', 'outOfStock', 'preOrder', 'preSale', 'soldOut'];
    return $items[random_int(0, 9)];
  }

  private function getEyeSizeRandom($faker)
  {
    return $faker->numberBetween(7, 20);
  }

  private function getBridgeSizeRandom($faker)
  {
    return $faker->numberBetween(7, 20);
  }

  private function getTempleLengthRandom($faker)
  {
    return $faker->numberBetween(5, 20);
  }

  /**END  Product************************************************************************* */

  /** Order *****************************************************************************/

  private function getOrderStatus(): string
  {
    $items = ['orderCancelled','orderDelivered','orderInTransit','orderPaymentDue','orderPickupAvailable','orderProblem','orderProcessing','orderReturned'];
    return $items[random_int(0, 7)];
  }

  /**END  Order************************************************************************* */
}
