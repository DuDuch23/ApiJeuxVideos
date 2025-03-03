<?php

namespace App\Controller;

use ApiPlatform\Metadata\UrlGeneratorInterface;
use App\Entity\User;
use App\Repository\UserRepository;
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

#[Route('/api/user')]
#[IsGranted('ROLE_ADMIN')]
class ApiUserController extends AbstractController
{
    #[Route('', name: 'api_user_index', methods: ['GET'])]
    public function index(UserRepository $userRepository, SerializerInterface $serializer, Request $request): JsonResponse
    {
        $page = $request->get('page', 1);
        $limit = $request->get('limit', 5);

        $users = $userRepository->findAllWithPagination($page, $limit);
        
        $json = $serializer->serialize($users, 'json', [
            'groups' => 'user:read'
        ]);

        return new JsonResponse($json, Response::HTTP_OK, [], true);
    }

    #[Route('/{id}', name: 'api_user_show', methods: ['GET'])]
    public function show(User $user, SerializerInterface $serializer): JsonResponse
    {
        $json = $serializer->serialize($user, 'json', ['groups' => 'user:read']);

        return new JsonResponse($json, Response::HTTP_OK, [], true);
    }

    #[Route('/new', name: 'api_user_new', methods: ['POST'])]
    public function new(Request $request, EntityManagerInterface $em, SerializerInterface $serializer): JsonResponse
    {
        $user = $serializer->deserialize($request->getContent(), User::class, 'json');
        $em->persist($user);
        $em->flush();

        return $this->json($user, Response::HTTP_CREATED, [], ['groups' => 'user:read']);
    }

    #[Route('/{id}', name: 'api_user_update', methods: ['PUT'])]
    public function update(Request $request, User $currentUser, EntityManagerInterface $em, SerializerInterface $serializer): JsonResponse
    {
        $updateUser = $serializer->deserialize($request->getContent(),
            User::class,
            'json',
            [AbstractNormalizer::OBJECT_TO_POPULATE => $currentUser]);

        $em->persist($updateUser);
        $em->flush();

        return $this->json(['status' => 'success'], Response::HTTP_OK);
    }

    #[Route('/{id}', name: 'api_user_delete', methods: ['DELETE'])]
    public function delete(User $user, EntityManagerInterface $em, TagAwareCacheInterface $cachePool): JsonResponse
    {
        $cachePool->invalidateTags(["userCache"]);
        $em->remove($user);
        $em->flush();

        return $this->json(['status' => 'User deleted successfully', 'User deleted' => $user->getEmail()], Response::HTTP_OK);
    }
}