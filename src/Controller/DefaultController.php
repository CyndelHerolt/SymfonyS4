<?php
// src/Controller/DefaultController.php
namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Translation\TranslatorInterface;

//...


class DefaultController extends AbstractController
{
    #[Route('/{_locale}', name: 'app', requirements: ['_locale' => 'en|fr|de'])]
    public function index(
        TranslatorInterface $translator,
    )
    {
//        $locale = $translator->getLocale();
        $fr = $translator->trans('french');
        $en = $translator->trans('english');
        $de = $translator->trans('german');

        $translated = $translator->trans('Symfony is great');
        $bienvenue = $translator->trans('welcome to this wonderful website');
        $switch = $translator->trans('switch to');

        return $this->render('default/index.html.twig', [
            'translated' => $translated,
            'bienvenue' => $bienvenue,
            'switch' => $switch,
            'fr' => $fr,
            'en' => $en,
            'de' => $de,
        ]);
    }
}
