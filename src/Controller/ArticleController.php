<?php

namespace App\Controller;

use App\Entity\Adresse;
use App\Entity\Article;
use App\Event\ArticleCreatedEvent;
use App\Form\AdresseType;
use App\Form\ArticleType;
use App\Repository\AdresseRepository;
use App\Repository\ArticleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

class ArticleController extends AbstractController
{
    #[Route('/article', name: 'app_article')]
    public function index(ArticleRepository $articleRepository): Response
    {
        $articles = $articleRepository->findAll();

        return $this->render('article/index.html.twig', [
            'controller_name' => 'ArticleController',
            'articles' => $articles,
        ]);
    }
    #[Route('/article/new', name: 'app_article_new')]
    public function new(
        ArticleRepository $articleRepository,
        Request $request,
        EventDispatcherInterface $eventDispatcher
    ): Response
    {

        $articlesByPrice = $articleRepository->findAllByMinPrice();
        $articlesByPriceAndName = $articleRepository->findAllByMinPriceAndName();
        $articlesByPriceNameAndCp = $articleRepository->findAllByMinPriceNameAndCp();

        $article = new Article();
//        $adresse = new Adresse();
        $form = $this->createForm(ArticleType::class, $article,
            [
                'codePostal' => '12345'
            ]);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $articleRepository->save($article, true);

//            Appel de l'évènement
            $event = new ArticleCreatedEvent($article);
            $eventDispatcher->dispatch($event, ArticleCreatedEvent::NAME);

            return $this->redirectToRoute('app_article');
        }

        return $this->render('article/new.html.twig', [
            'controller_name' => 'ArticleController',
            'form' => $form->createView(),
            'articlesByPrice' => $articlesByPrice,
            'articlesByPriceAndName' => $articlesByPriceAndName,
            'articlesByPriceNameAndCp' => $articlesByPriceNameAndCp,
        ]);
    }
}
