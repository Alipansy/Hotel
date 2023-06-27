<?php

namespace App\Controller\Admin;

use App\Entity\User;
use App\Entity\Chambre;
use App\Entity\Slider;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;

class DashboardController extends AbstractDashboardController
{
    public function __construct(private AdminUrlGenerator $adminUrlGenerator)
    {
        
    }
    #[Route('/ectoplasma', name: 'admin')]
    public function index(): Response
    {
        

        // Option 1. You can make your dashboard redirect to some common page of your backend
        //
        // $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
        // return $this->redirect($adminUrlGenerator->setController(OneOfYourCrudController::class)->generateUrl());

        // Option 2. You can make your dashboard redirect to different pages depending on the user
        //
        // if ('jane' === $this->getUser()->getUsername()) {
        //     return $this->redirect('...');
        // }

        // Option 3. You can render some custom template to display a proper dashboard with widgets, etc.
        // (tip: it's easier if your template extends from @EasyAdmin/page/content.html.twig)
        //
        // return $this->render('some/path/my-dashboard.html.twig');
        $url= $this->adminUrlGenerator->setController(ChambreCrudController::class)->generateUrl();
        return $this->redirect($url);
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Hotel Holidays');
    }

    public function configureMenuItems(): iterable
   {
     return[
            MenuItem::linkToDashboard("BACKOFFICE",'fa fa-home'),
            MenuItem::section('User'),
            MenuItem::linkToCrud('Utilisateur','fa fa-user', User::class),
            MenuItem::subMenu('Hotel', 'fa fa-hotel')->setSubItems([
            MenuItem::linkToCrud('chambre','fa fa-bed', Chambre::class),
            MenuItem::linkToCrud('slider','fa fa-image', Slider::class),
               
 
            ]),
            MenuItem::section('Retour au site'),
            MenuItem::linkToRoute('Accueil du site', 'fa fa-home', 'home'),
        ];
        
        // yield MenuItem::linkToCrud('The Label', 'fas fa-list', EntityClass::class);
    }
}
