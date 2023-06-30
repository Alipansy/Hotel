<?php

namespace App\Controller;

use DateTime;
use App\Entity\Chambre;
use App\Entity\Commande;
use App\Form\ReservationType;
use App\Repository\SliderRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

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
    #[Route("/reservation/resa/{id}", name:"app_resa")]
    public function resa(Chambre $chambre = null, EntityManagerInterface $manager, Request $rq)
    {
        if (!$chambre)
            return $this->redirectToRoute('home');

        $commande = new Commande;
        $form = $this->createForm(ReservationType::class, $commande);
        $form->handleRequest($rq);

        if ($form->isSubmitted() && $form->isValid()) {
            $commande->setDateEnregistrement(new DateTime());
            $commande->setIdChambre($chambre);

            $depart = $commande->getDateArrivee();
            if ($depart->diff($commande->getDateDepart())->invert == 1) {
                $this->addFlash('danger', 'Une période de temps ne peut pas être négative.');
                return $this->redirectToRoute('app_resa', [
                    'id' => $chambre->getId()
                ]);
            }
            $jours = $depart->diff($commande->getDateDepart())->days;
            $prixTotal = ($commande->getIdChambre()->getPrix() * $jours) + $commande->getIdChambre()->getPrix();

            $commande->setPrixTotal($prixTotal);

            $manager->persist($commande);
            $manager->flush();
            $this->addFlash('success', 'Votre commande a bien été enregistrée !');
            return $this->redirectToRoute('home');
        }

        return $this->render('reservation/resa.html.twig', [
            'form' => $form,
            'room' => $chambre
        ]);
    }

}
