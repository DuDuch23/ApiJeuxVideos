<?php

namespace App\Command;

use App\Repository\UserRepository;
use App\Repository\VideoGameRepository;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Serializer\SerializerInterface;
use Twig\Environment;

#[AsCommand(
    name: 'send-newsletter',
    description: 'Commande permettant d\'envoyer aux utilisateurs ayant souscris un abonnement à la newsletter, un email',
)]
class SendNewsletterCommand extends Command
{
    private $userRepository;
    private $mailer;
    private $videoGameRepository;
    private $serializer;
    private $twig;

    public function __construct(UserRepository $userRepository, MailerInterface $mailer, VideoGameRepository $videoGameRepository, SerializerInterface $serializer, Environment $twig)
    {
        parent::__construct();
        $this->userRepository = $userRepository;
        $this->mailer = $mailer;
        $this->videoGameRepository = $videoGameRepository;
        $this->serializer = $serializer;
        $this->twig = $twig;
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

        $emailContent = $this->twig->render('emails/newsletter.html.twig', [
            'upcomingGames' => $upcomingGames,
        ]);

        foreach ($subscribedUsers as $user) {
            $email = (new Email())
                ->from('alexduduch77@gmail.com')
                ->to($user->getEmail())
                ->subject('Newsletter - Nouveaux jeux vidéo à venir')
                ->html($emailContent);

            $this->mailer->send($email);
        }

        $output->writeln('Les emails ont été envoyés.');

        return Command::SUCCESS;
    }
}