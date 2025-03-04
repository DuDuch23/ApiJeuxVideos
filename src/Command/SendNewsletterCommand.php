<?php

namespace App\Command;

use App\Repository\UserRepository;
use App\Repository\VideoGameRepository;
use App\Service\MailerService;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Scheduler\Attribute\AsCronTask;
use Symfony\Component\Serializer\SerializerInterface;
use Twig\Environment;

#[AsCommand(
    name: 'send-newsletter',
    description: 'Commande permettant d\'envoyer aux utilisateurs ayant souscris un abonnement à la newsletter, un email',
)]
#[AsCronTask('30 8 * * 1')]
class SendNewsletterCommand extends Command
{
    private $userRepository;
    private $mailerService;
    private $videoGameRepository;

    public function __construct(
        UserRepository $userRepository,
        VideoGameRepository $videoGameRepository,
        MailerService $mailerService
    ) {
        parent::__construct();
        $this->userRepository = $userRepository;
        $this->videoGameRepository = $videoGameRepository;
        $this->mailerService = $mailerService;
    }

    protected function configure(): void
    {
        $this->setName('app:send-newsletter')
            ->setDescription('Envoie la newsletter aux utilisateurs abonnés.');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $subscribedUsers = $this->userRepository->findBy(['subscriptionToNewsletter' => true]);

        $now = new \DateTime();
        $endDate = (new \DateTime())->add(new \DateInterval('P7D'));
        $upcomingGames = $this->videoGameRepository->findByReleaseDate($now, $endDate);

        foreach ($subscribedUsers as $user) {
            $this->mailerService->sendEmail(
                $user->getEmail(),
                'Newsletter - Nouveaux jeux vidéo à venir',
                'emails/newsletter.html.twig',
                ['upcomingGames' => $upcomingGames]
            );
        }

        $output->writeln('Les emails ont été envoyés.');

        return Command::SUCCESS;
    }
}