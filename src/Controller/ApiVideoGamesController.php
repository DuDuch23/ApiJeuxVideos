<?php

namespace App\Controller;

use ApiPlatform\Metadata\UrlGeneratorInterface;
use App\Entity\VideoGame;
use App\Repository\CategoryRepository;
use App\Repository\EditorRepository;
use App\Repository\VideoGameRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Contracts\Cache\TagAwareCacheInterface;

#[Route('/api/videogame')]
#[IsGranted('ROLE_USER')]
class ApiVideoGamesController extends AbstractController
{
    #[Route('', name: 'api_video_game_index', methods: ['GET'])]
    public function index(VideoGameRepository $videoGameRepository, SerializerInterface $serializer, Request $request
    ): JsonResponse
    {
        $page = $request->get('page', 1);
        $limit = $request->get('limit', 5);

        $videoGames = $videoGameRepository->findAllWithPagination($page, $limit);
        
        $json = $serializer->serialize($videoGames, 'json', [
            'groups' => 'videogame:read'
        ]);
        // dump($json);

        return new JsonResponse($json, Response::HTTP_OK, [], true);
    }

    #[Route('/{id}', name: 'api_video_game_show', methods: ['GET'])]
    public function show(VideoGame $videoGame, SerializerInterface $serializer): JsonResponse
    {
        $json = $serializer->serialize($videoGame, 'json', ['groups' => 'videogame:read']);

        return new JsonResponse($json, Response::HTTP_OK, [], true);
    }

    #[Route('/new', name: 'api_video_game_new', methods: ['POST'])]
    #[IsGranted('ROLE_ADMIN')]
    public function new(Request $request,
        EntityManagerInterface $em,
        SerializerInterface $serializer,
        EditorRepository $editorRepository,
        CategoryRepository $categoryRepository,
        UrlGeneratorInterface $urlGenerator): JsonResponse
    {
        $videoGame = $serializer->deserialize($request->getContent(), VideoGame::class, 'json');
        $em->persist($videoGame);
        $em->flush();
        
        if ($request->request->get("editor_id")) {
            $editor = $editorRepository->find($request->request->get("editor_id"));
    
            if ($editor) {
                $videoGame->setIdEditor($editor);
                $em->persist($videoGame);
                $em->flush();
            }
        }
    
        if ($request->request->get("category_id")) {
            $category = $categoryRepository->find($request->request->get("category_id"));
    
            if ($category) {
                $videoGame->setIdCategory($category);
                $em->persist($videoGame);
                $em->flush();
            }
        }
    
        $location = $urlGenerator->generate(
            'api_video_game_new',
            [
                'id' => $videoGame->getId(),
                'title' => $videoGame->getTitle(),
                'releaseDate' => $videoGame->getReleaseDate(),
                'description' => $videoGame->getDescription(),
                'editor' => $videoGame->getEditor(),
                'category' => $videoGame->getCategory(),
            ],
            UrlGeneratorInterface::ABS_URL
        );
        return $this->json(
            $videoGame, Response::HTTP_CREATED,
            ["Location" => $location], ['groups' => 'getVideoGame']
        );
    }

    #[Route('/{id}', name: 'api_video_game_update', methods: ['PUT'])]
    #[IsGranted('ROLE_ADMIN')]
    public function update(Request $request,
    VideoGame $currentVideoGame,
    EntityManagerInterface $em,
    SerializerInterface $serializer,
    UrlGeneratorInterface $urlGenerator): JsonResponse
    {
        $updateVideoGame = $serializer->deserialize($request->getContent(),
        VideoGame::class,
        'json',
        [AbstractNormalizer::OBJECT_TO_POPULATE => $currentVideoGame]);

        $em->persist($updateVideoGame);
        $em->flush();

        $location = $urlGenerator->generate(
            'api_video_game_update',
            [
                'id' => $updateVideoGame->getId(),
                'title' => $updateVideoGame->getTitle(),
                'releaseDate' => $updateVideoGame->getReleaseDate(),
                'description' => $updateVideoGame->getDescription(),
                'category' => $updateVideoGame->getCategory(),
                'editor' => $updateVideoGame->getEditor(),
        ],
            UrlGeneratorInterface::ABS_URL
        );

        return $this->json(['status' => 'success'], Response::HTTP_OK, ["Location" => $location]);
    }

    #[Route('/{id}', name: 'api_video_game_delete', methods: ['DELETE'])]
    #[IsGranted('ROLE_ADMIN')]
    public function delete(VideoGame $videoGame,
    EntityManagerInterface $em, TagAwareCacheInterface $cachePool): JsonResponse
    {
        $cachePool->invalidateTags(["videoGameCache"]);
        $em->remove($videoGame);
        $em->flush();

        return $this->json(['status' => 'Jeux vidéos supprimé avec succès', 'Jeux videos supprime' => $videoGame->getTitle()], Response::HTTP_OK);
    }

}