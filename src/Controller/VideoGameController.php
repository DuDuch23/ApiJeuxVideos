<?php

namespace App\Controller;

use App\Repository\CategoryRepository;
use App\Repository\EditorRepository;
use App\Repository\VideoGameRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
#[Route('api/', name: 'api_')]
class VideoGameController extends AbstractController
{
    #[Route('login', name: 'api_login', methods: ['POST'])]
    public function login(AuthenticationUtils $authenticationUtils): JsonResponse
    {
        return new JsonResponse(['message' => 'Login successful'], 200);
    }

    #[Route('videogame', name: 'video_game', methods: ['GET'])]
    public function getVideogame(VideoGameRepository $videoGameRepository): JsonResponse
    {
        $allVideogame = $videoGameRepository->findAll();

        return $this->json([
            $allVideogame, Response::HTTP_OK
        ]);
    }

    #[Route('editor', name: 'editor', methods: ['GET'])]
    public function getEditor(EditorRepository $editorRepository): JsonResponse
    {
        $allEditor = $editorRepository->findAll();

        return $this->json([
            $allEditor, Response::HTTP_OK
        ]);
    }

    #[Route('category', name: 'category', methods: ['GET'])]
    public function getCategory(CategoryRepository $categoryRepository): JsonResponse
    {
        $allCategory = $categoryRepository->findAll();

        return $this->json([
            $allCategory, Response::HTTP_OK
        ]);
    }
}
