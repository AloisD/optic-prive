<?php

namespace App\Controller\Admin;

use App\Entity\Address;
use App\Entity\Order;
use App\Entity\Product;
<<<<<<< HEAD
use App\Entity\Brand;
use App\Entity\Color;
use App\Entity\LensType;
use App\Entity\Material;
use App\Entity\Segment;
use App\Entity\Shape;
use App\Entity\Style;
=======
use App\Entity\ProductImage;
>>>>>>> aafc90f1d632764cb7de1c12f0b28bd85f9d0922
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
         $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);

        return $this->redirect($adminUrlGenerator->setController(ProductCrudController::class)->generateUrl());
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Optic Prive Admin');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
<<<<<<< HEAD
        yield MenuItem::subMenu('Offer', 'fa fa-article')->setSubItems([
            MenuItem::linkToCrud('Product', 'fas fa-list', Product::class),
            MenuItem::linkToCrud('Brand', 'fas fa-list', Brand::class),
            MenuItem::linkToCrud('Shape', 'fas fa-list', Shape::class),
            MenuItem::linkToCrud('Segment', 'fas fa-list', Segment::class),
            MenuItem::linkToCrud('Lens type', 'fas fa-list', LensType::class),
            MenuItem::linkToCrud('Style', 'fas fa-list', Style::class),
            MenuItem::linkToCrud('Color', 'fas fa-list', Color::class),
            MenuItem::linkToCrud('Material', 'fas fa-list', Material::class),
        ]);
=======
        yield MenuItem::linkToCrud('Product', 'fas fa-list', Product::class);
/*         yield MenuItem::subMenu('Offer', 'fa fa-article')->setSubItems([
            MenuItem::linkToCrud('Product', 'fas fa-list', Product::class),
            MenuItem::linkToCrud('Picture', 'fas fa-list', ProductImage::class)
        ]); */
>>>>>>> aafc90f1d632764cb7de1c12f0b28bd85f9d0922
        yield MenuItem::linkToCrud('Order', 'fas fa-list', Order::class);
        yield MenuItem::linkToCrud('Address', 'fas fa-list', Address::class);
        yield MenuItem::linkToUrl('Visit public website', null, '/');
    }
}
