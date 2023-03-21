<?php

namespace App\Service;

use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class MailerService
{

    public function __construct(
        MailerInterface $mailer,
    )
    {
        $this->mailer = $mailer;
    }

    public function sendMail($from, $to, $subject, $text, $html)
    {
        $email = (new Email())
            ->from($from)
            ->to($to)
            ->subject($subject)
            ->text($text)
            ->html($html);

        $this->mailer->send($email);
    }

}
