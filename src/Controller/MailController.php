<?php

namespace App\Controller;

use App\Service\MailerService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MailController extends AbstractController
{
    #[Route('/mail', name: 'app_mail')]
    public function index(MailerService $mailerService): Response
    {
        $mailerService->sendMail('symfonys4@mail.com', 'test@mail.com', 'Test', 'Test', 'Test');

        return $this->render('mail/index.html.twig', [
        ]);
    }
}
