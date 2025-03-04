<?php

namespace App\Service;

use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Twig\Environment;

class MailerService
{
    public function __construct(
        private MailerInterface $mailer,
        private Environment $twig
    ) {}

    public function sendEmail(string $recipientEmail, string $subject, string $template, array $context = []): void
    {
        $emailContent = $this->twig->render($template, $context);

        $email = (new Email())
            ->from('alexduduch77@gmail.com')
            ->to($recipientEmail)
            ->subject($subject)
            ->html($this->twig->render($template, $context));

        $this->mailer->send($email);
    }
}
