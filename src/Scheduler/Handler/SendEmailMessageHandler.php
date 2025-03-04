<?php

namespace App\Scheduler\Handler;

use App\Repository\VideoGameRepository;
use App\Service\MailerService;
use App\Scheduler\Message\SendEmailMessage;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;
use Twig\Environment;

#[AsMessageHandler]
class SendEmailMessageHandler
{
    private MailerService $mailerService;
    private VideoGameRepository $videoGameRepository;
    private Environment $twig;

    public function __construct(MailerService $mailerService, VideoGameRepository $videoGameRepository, Environment $twig)
    {
        $this->mailerService = $mailerService;
        $this->videoGameRepository = $videoGameRepository;
        $this->twig = $twig;
    }

    public function __invoke(SendEmailMessage $message)
    {
        $now = new \DateTime();
        $endDate = (new \DateTime())->add(new \DateInterval('P7D'));
        $upcomingGames = $this->videoGameRepository->findByReleaseDate($now, $endDate);

        // Pass the template name and parameters instead of the HTML content
        $this->mailerService->sendEmail(
            $message->getRecipientEmail(), 
            'Notification quotidienne',
            'emails/newsletter.html.twig', // Nom du template
            ['upcomingGames' => $upcomingGames] // Les paramètres pour le template
        );
    }
}