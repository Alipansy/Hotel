<?php

namespace App\Controller;

use App\Repository\SliderRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AppController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index(SliderRepository $repo): Response
    {
        $slide = $repo->findBy(['ordre'=>[1,2,3]],['ordre' =>'ASC']);
        return $this->render('app/index.html.twig', [
            'slides'=>$slide,
        ]);
    }
}
