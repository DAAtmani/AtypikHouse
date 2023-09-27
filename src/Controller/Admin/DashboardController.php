<?php

namespace App\Controller\Admin;

use App\Entity\Category;
use App\Entity\Produits;
use App\Entity\Reservation;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        return parent::index();
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Project');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
         yield MenuItem::linkToCrud('user', 'fas fa-list', User::class);
         yield MenuItem::linkToCrud('produits', 'fas fa-list', Produits::class);
         yield MenuItem::linkToCrud('category', 'fas fa-list', Category::class);
         yield MenuItem::linkToCrud('reservation', 'fas fa-list',Reservation::class);
    }
}
