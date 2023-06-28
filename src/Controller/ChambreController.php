<?php

namespace App\Controller;

use App\Repository\ChambreRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ChambreController extends AbstractController
{
    #[Route('/chambre', name: 'app_chambre')]
    public function index(): Response
    {
        return $this->render('chambre/index.html.twig', [
            'controller_name' => 'ChambreController',
        ]);
    }
    #[Route('/simple', name: 'app_simple')]
    public function simple(): Response
    {
        return $this->render('chambre/simple.html.twig');
    }
    public function show(ChambreRepository $repo ) : Response
    {
        $chambre= $repo->findBy([],['prix' < 200]);
        
        return $this->render('app/simple.html.twig', [
            'chambre' => $chambre
        ]);
    }
}
