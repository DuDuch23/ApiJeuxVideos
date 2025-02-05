<?php

namespace App\Controller;

use App\Entity\VideoGame;
use App\Repository\VideoGameRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Serializer\SerializerInterface;

#[Route('/api/videogame')]
#[IsGranted('ROLE_USER')]
class ApiVideoGamesController extends AbstractController
{
    #[Route('', name: 'api_video_game_index', methods: ['GET'])]
    public function index(VideoGameRepository $videoGameRepository, SerializerInterface $serializer): JsonResponse
    {
        $videoGames = $videoGameRepository->findAll();
        $json = $serializer->serialize($videoGames, 'json', ['groups' => 'video_game:read']);

        return new JsonResponse($json, Response::HTTP_OK, [], true);
    }

    #[Route('/{id}', name: 'api_video_game_show', methods: ['GET'])]
    public function show(VideoGame $videoGame, SerializerInterface $serializer): JsonResponse
    {
        $json = $serializer->serialize($videoGame, 'json', ['groups' => 'video_game:read']);

        return new JsonResponse($json, Response::HTTP_OK, [], true);
    }
}