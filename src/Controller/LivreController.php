<?php

namespace App\Controller;

use App\Entity\Avis;
use App\Form\AvisFormType;
use App\Repository\AvisRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class LivreController extends AbstractController
{
    
    #[Route('/avis', name:'app_avis')]
public function formAvis(Request $request, EntityManagerInterface $manager, Avis $avis = null)
{
    $avis = new Avis();

    $form = $this->createForm(AvisFormType::class, $avis);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
        $avis->setDateEnregistrement(new \DateTime());
        $manager->persist($avis);
        $manager->flush();

        return $this->redirectToRoute('app_avis');
    }

    return $this->render("livre/index.html.twig", [
        "formAvis" => $form
    ]);

}



}

