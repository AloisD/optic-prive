<?php

namespace App\Controller\Admin;

use App\Entity\Order;
use App\Entity\Product;
use App\Entity\Brand;
use App\Entity\BusinessUser;
use App\Entity\Color;
use App\Entity\LensType;
use App\Entity\Material;
use App\Entity\Segment;
use App\Entity\Shape;
use App\Entity\ShippingOption;
use App\Entity\Style;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Config\Assets;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;

class DashboardController extends AbstractDashboardController
{
    public function configureAssets(): Assets
    {
        return Assets::new()->addCssFile('css/admin.css');
    }

    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
         $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);

        return $this->redirect($adminUrlGenerator->setController(ProductCrudController::class)->generateUrl());
    }

    public function configureCrud(): Crud
    {
        return Crud::new()
        ->setPaginatorPageSize(20)
        ->setPaginatorRangeSize(4)
        ;
    }


    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Optic Prive Admin');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Tableau de bord', 'fa fa-home');
        yield MenuItem::linkToCrud('Produits', 'fas fa-list', Product::class);
        yield MenuItem::subMenu('Catégories', 'fa fa-article')
        ->setPermission('ROLE_ADMIN')
        ->setSubItems([
          MenuItem::linkToCrud('Marques', 'fas fa-list', Brand::class),
          MenuItem::linkToCrud('Formes', 'fas fa-list', Shape::class),
          MenuItem::linkToCrud('Segments', 'fas fa-list', Segment::class),
          MenuItem::linkToCrud('Types de verres', 'fas fa-list', LensType::class),
          MenuItem::linkToCrud('Styles', 'fas fa-list', Style::class),
          MenuItem::linkToCrud('Couleurs', 'fas fa-list', Color::class),
          MenuItem::linkToCrud('Matériaux', 'fas fa-list', Material::class),
        ]);
        yield MenuItem::linkToCrud('Utilisateurs', 'fas fa-list', User::class)
        ->setPermission('ROLE_ADMIN');
        yield MenuItem::subMenu('détails', 'fa fa-article')
        ->setPermission('ROLE_ADMIN')
        ->setSubItems([
          MenuItem::linkToCrud('Pro', 'fas fa-list', BusinessUser::class),
        ]);
        yield MenuItem::linkToCrud('Commandes', 'fas fa-list', Order::class)
        ->setPermission('ROLE_ADMIN');
        yield MenuItem::linkToCrud('Frais de port', 'fas fa-list', ShippingOption::class)
        ->setPermission('ROLE_ADMIN');
        yield MenuItem::linkToUrl('Visiter le site public', null, '/');
    }
}
