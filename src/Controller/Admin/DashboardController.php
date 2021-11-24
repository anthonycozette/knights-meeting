<?php

namespace App\Controller\Admin;

use App\Entity\Commentaire;
use App\Entity\Contact;
use App\Entity\Evenement;
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
        return $this->render('admin/dashboard.thml.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('GN');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linktoDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('User', 'fas fa-user', User::class);
        yield MenuItem::linkToCrud('Evenements', 'fas fa-list', Evenement::class);
        yield MenuItem::linkToCrud('Commentaire', 'fas fa-comment', Commentaire::class);
        yield MenuItem::linkToCrud('Message de contact', 'fas fa-envelope', Contact::class);
    }
}
