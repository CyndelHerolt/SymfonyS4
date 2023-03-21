<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Translation\TranslatorInterface;

class ContactController extends AbstractController
{
    #[Route(path: '/{_locale}/contact', name: 'contact', requirements: ['_locale' => 'en|fr|de',],)]
    public function contact(
        TranslatorInterface $translator,
        Request $request,
    )
    {
//        $locale = $request->getLocale();
//
//        //Si la locale est fr alors on affiche le bouton en anglais
//        if($locale == 'fr') {
//            $next = 'en';
//        }
//
//        $translated = $translator->trans('Symfony is great');
//        $bouton = $translator->trans('switch to');
//
//        return $this->render('default/index.html.twig', [
//            'translated' => $translated,
//            'bouton' => $bouton,
//            'locale' => $next,
//        ]);
    }
}
