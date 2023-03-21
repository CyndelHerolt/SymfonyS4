<?php

namespace App\Controller;

use App\Entity\Adresse;
use App\Form\AdresseType;
use App\Repository\AdresseRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdresseController extends AbstractController
{
    #[Route('/adresse', name: 'app_adresse_new')]
    public function new(
        AdresseRepository $adresseRepository,
        Request           $request,
    ): Response
    {

        $adressesByCp = $adresseRepository->findAllByCodePostal();
//        dump($adressesByCp);
//        die();

        $adressesByCpSort = $adresseRepository->findAllByCodePostalAndSortByRue();

        $adresse = new Adresse();
        $form = $this->createForm(AdresseType::class, $adresse);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $adresseRepository->save($adresse, true);

            return $this->redirectToRoute('app_adresse_new');
        }

        return $this->render('adresse/new.html.twig', [
            'form' => $form->createView(),
            'adressesByCp' => $adressesByCp,
            'adressesByCpSort' => $adressesByCpSort,
        ]);
    }
}
