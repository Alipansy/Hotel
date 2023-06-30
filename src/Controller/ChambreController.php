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
public function simple(ChambreRepository $repo): Response
{
    $chambres = $repo->simple(200);

    return $this->render('chambre/simple.html.twig', [
        'chambres' => $chambres,
    ]);
}
#[Route('/confort', name: 'app_confort')]
public function confort(ChambreRepository $repo): Response
{
    $chambres = $repo->confort(200);

    return $this->render('chambre/confort.html.twig', [
        'chambres' => $chambres,
    ]);
}
#[Route('/suite', name: 'app_suite')]
public function suite(ChambreRepository $repo): Response
{
    $chambres = $repo->suite(500);

    return $this->render('chambre/suite.html.twig', [
        'chambres' => $chambres,
    ]);
}

}
