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
      ->setName(' ')
      ->setReference('NB6046')
      ->setColorCode('3') // monture color : glasses color
      ->setRetailPrice(93.00)
      ->setSellingPrice(74.40)
      ->setQuantity(1)
      ->setEyeSize(53)
      ->setBridgeSize(20)
      ->setTempleLength(150)
      ->setState('newCondition')
      ->setCategory('unisex')
      ->setUvProtection('category3')
      ->setItemAvailability('inStock');

    $product1 = new Product();
    $product1
      ->setName(' ')
      ->setReference('NB6030')
      ->setColorCode('3') // monture color : glasses color
      ->setRetailPrice(93.00)
      ->setSellingPrice(74.40)
      ->setQuantity(1)
      ->setEyeSize(54)
      ->setBridgeSize(17)
      ->setTempleLength(135)
      ->setState('newCondition')
      ->setCategory('unisex')
      ->setUvProtection('category3')
      ->setItemAvailability('inStock');

    $product2 = new Product();
    $product2
      ->setName(' ')
      ->setReference('NB6037')
      ->setColorCode('4') // monture color : glasses color
      ->setRetailPrice(93.00)
      ->setSellingPrice(74.40)
      ->setQuantity(1)
      ->setEyeSize(54)
      ->setBridgeSize(21)
      ->setTempleLength(135)
      ->setState('newCondition')
      ->setCategory('unisex')
      ->setUvProtection('category3')
      ->setItemAvailability('inStock');

    $product3 = new Product();
    $product3
      ->setName(' ')
      ->setReference('NB6038')
      ->setColorCode('3') // monture color : glasses color
      ->setRetailPrice(93.00)
      ->setSellingPrice(74.40)
      ->setQuantity(1)
      ->setEyeSize(54)
      ->setBridgeSize(19)
      ->setTempleLength(135)
      ->setState('newCondition')
      ->setCategory('unisex')
      ->setUvProtection('category3')
      ->setItemAvailability('inStock');

    $product4 = new Product();
    $product4
      ->setName(' ')
      ->setReference('NB6037')
      ->setColorCode('1') // monture color : glasses color
      ->setRetailPrice(93.00)
      ->setSellingPrice(74.40)
      ->setQuantity(1)
      ->setEyeSize(54)
      ->setBridgeSize(20)
      ->setTempleLength(135)
      ->setState('newCondition')
      ->setCategory('unisex')
      ->setUvProtection('category3')
      ->setItemAvailability('inStock');

    //brand
    $brand = new Brand();
    $brand
      ->setName("New Balance")
      ->setLogo("https://commons.wikimedia.org/wiki/File:NB_Stckd_logo.jpg");
    $manager->persist($brand);

    //shape
    $shape = new Shape();
    $shape
      ->setName("rectangle");
    $manager->persist($shape);

    $shape1 = new Shape();
    $shape1
      ->setName("papillon");
    $manager->persist($shape1);

    $shape2 = new Shape();
    $shape2
      ->setName("pentos");
    $manager->persist($shape2);

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
      ->setName("verres mirroir/polarisés");
    $manager->persist($lensType);

    $lensType1 = new LensType();
    $lensType1
      ->setName("verres polarisés");
    $manager->persist($lensType1);

    //style
    $style = new Style();
    $style
      ->setName(" ");
    $manager->persist($style);

    //color
    $color = new Color();
    $color
      ->setName("noir/jaune");
    $manager->persist($color);

    $color1 = new Color();
    $color1
      ->setName("bleu/blanc/violet");
    $manager->persist($color1);

    $color2 = new Color();
    $color2
      ->setName("gris translucide/rouge");
    $manager->persist($color2);

    $color3 = new Color();
    $color3
      ->setName("rouge/noir/bleu");
    $manager->persist($color3);

    //material
    $material = new Material();
    $material
      ->setName(" ");
    $manager->persist($material);

    //product_images
    $productImage = new ProductImage;
    $productImage
      ->setPath('NB6038.jpeg');
    $manager->persist($productImage);

    $productImage1 = new ProductImage;
    $productImage1
      ->setPath('NB6038 (2).jpeg');
    $manager->persist($productImage1);

    $productImage2 = new ProductImage;
    $productImage2
      ->setPath('NB6038 (3).jpeg');
    $manager->persist($productImage2);

    $productImage3 = new ProductImage;
    $productImage3
      ->setPath('NB6037-1.jpeg');
    $manager->persist($productImage3);

    $productImage4 = new ProductImage;
    $productImage4
      ->setPath('NB6037-1 (2).jpeg');
    $manager->persist($productImage4);

    $productImage5 = new ProductImage;
    $productImage5
      ->setPath('NB6037-1 (3).jpeg');
    $manager->persist($productImage5);

    $productImage6 = new ProductImage;
    $productImage6
      ->setPath('NB6046.jpeg');
    $manager->persist($productImage6);

    $productImage7 = new ProductImage;
    $productImage7
      ->setPath('NB6046 (2).jpeg');
    $manager->persist($productImage7);

    $productImage8 = new ProductImage;
    $productImage8
      ->setPath('NB6046 (3).jpeg');
    $manager->persist($productImage8);

    $productImage9 = new ProductImage;
    $productImage9
      ->setPath('NB6046 (4).jpeg');
    $manager->persist($productImage9);

    $productImage10 = new ProductImage;
    $productImage10
      ->setPath('NB6037-4.jpeg');
    $manager->persist($productImage10);

    $productImage11 = new ProductImage;
    $productImage11
      ->setPath('NB6037-4 (2).jpeg');
    $manager->persist($productImage11);

    $productImage12 = new ProductImage;
    $productImage12
      ->setPath('NB6037-4 (3).jpeg');
    $manager->persist($productImage12);

    $productImage13 = new ProductImage;
    $productImage13
      ->setPath('NB6030 (2).jpeg');
    $manager->persist($productImage13);

    $productImage14 = new ProductImage;
    $productImage14
      ->setPath('NB6030');
    $manager->persist($productImage14);

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
      ->addProduct($product3);

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
      ->addProduct($product4);

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
      ->addProductImage($productImage6)
      ->addProductImage($productImage7)
      ->addProductImage($productImage8)
      ->addProductImage($productImage9)
      ->setSeller($vendor);

    $manager->persist($product);

    $product1
      ->setBrand($brand)
      ->setShape($shape1)
      ->setSegment($segment)
      ->setLensType($lensType1)
      ->setStyle($style)
      ->setColor($color1)
      ->setMaterial($material)
      ->addProductImage($productImage13)
      ->addProductImage($productImage14)
      ->setSeller($vendor);

    $manager->persist($product1);

    $product2
      ->setBrand($brand)
      ->setShape($shape2)
      ->setSegment($segment)
      ->setLensType($lensType1)
      ->setStyle($style)
      ->setColor($color2)
      ->setMaterial($material)
      ->addProductImage($productImage3)
      ->addProductImage($productImage4)
      ->addProductImage($productImage5)
      ->setSeller($vendor);

    $manager->persist($product2);

    $product3
      ->setBrand($brand)
      ->setShape($shape)
      ->setSegment($segment)
      ->setLensType($lensType1)
      ->setStyle($style)
      ->setColor($color3)
      ->setMaterial($material)
      ->addProductImage($productImage)
      ->addProductImage($productImage1)
      ->addProductImage($productImage2)
      ->setSeller($vendor);

    $manager->persist($product3);

    $product4
      ->setBrand($brand)
      ->setShape($shape2)
      ->setSegment($segment)
      ->setLensType($lensType1)
      ->setStyle($style)
      ->setColor($color)
      ->setMaterial($material)
      ->addProductImage($productImage10)
      ->addProductImage($productImage11)
      ->addProductImage($productImage12)
      ->setSeller($vendor);

    $manager->persist($product4);

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
      ->setUser($user)
      ->setFirstname('Jean')
      ->setLastname('Dujardin');
    $manager->persist($invoicingAddress);

    //delivery_address
    $deliveryAddress = new Address;
    $deliveryAddress
      ->setName("345 rue Anatole France")
      ->setRecipient("112 avenue Charles de Gaulle")
      ->setCountry("France")
      ->setCity("Neuilly-sur-Seine")
      ->setUser($user)
      ->setFirstname('Johnny')
      ->setLastname('Halliday');
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

    //orderHasProduct1
    $orderHasProduct1 = new OrderHasProduct();
    $orderHasProduct1
      ->setQuantity(2)
      ->setProduct($product2)
      ->setOrder($order);

    $this->getDataOrderHasProduct($orderHasProduct1);

    $manager->persist($orderHasProduct1);

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

