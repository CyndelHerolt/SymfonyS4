<?php

namespace App\EventSubscriber;

use App\Event\ArticleCreatedEvent;
use App\Service\MailerService;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Mailer\Mailer;

class ArticleCreatedSubscriber implements EventSubscriberInterface
{
    public function __construct(
        MailerService $mailer
    ) {
        $this->mailer = $mailer;
    }

    public static function getSubscribedEvents()
    {
        return [
            ArticleCreatedEvent::NAME => 'onArticleCreated',
        ];
    }

    public function onArticleCreated(ArticleCreatedEvent $event)
    {
        if ($event) {
            $this->mailer->sendMail('symfonys4@mail.com', 'test@mail.com', 'Test', 'Test', 'Test');
        }}
}
