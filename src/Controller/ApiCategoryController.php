<?php

namespace App\Controller;

use ApiPlatform\Metadata\UrlGeneratorInterface;
use App\Entity\Category;
use App\Repository\CategoryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;

#[Route('/api/category')]
#[IsGranted('ROLE_USER')]
class ApiCategoryController extends AbstractController
{
    #[Route('', name: 'api_category_index', methods: ['GET'])]
    public function index(CategoryRepository $categoryRepositoryGameRepository,
    SerializerInterface $serializer): JsonResponse
    {
        $category = $categoryRepositoryGameRepository->findAll();
        $json = $serializer->serialize($category, 'json', ['groups' => 'category:read']);

        return new JsonResponse($json, Response::HTTP_OK, [], true);
    }

    #[Route('/{id}', name: 'api_category_show', methods: ['GET'])]
    public function show(Category $category,
    SerializerInterface $serializer): JsonResponse
    {
        $json = $serializer->serialize($category, 'json', ['groups' => 'category:read']);

        return new JsonResponse($json, Response::HTTP_OK, [], true);
    }

    #[Route('/new', name: 'api_category_new', methods: ['POST'])]
    #[IsGranted('ROLE_ADMIN')]
    public function new(Request $request,
    EntityManagerInterface $em,
    SerializerInterface $serializer,
    UrlGeneratorInterface $urlGenerator): JsonResponse
    {
        $category = $serializer->deserialize($request->getContent(), Category::class, 'json');
        $em->persist($category);
        $em->flush();

        $location = $urlGenerator->generate(
            'api_category_new',
            [
                'name' => $category->getName(),
        ],
            UrlGeneratorInterface::ABS_URL
        );

        return $this->json(
            ["success" => "Catégorie crée avec succès", "Catégorie crée" => $category->getName()], Response::HTTP_CREATED,
            ["Location" => $location], ['groups' => 'getCategory']
        );
    }

    #[Route('/{id}', name: 'api_category_update', methods: ['PUT'])]
    #[IsGranted('ROLE_ADMIN')]
    public function update(Request $request,
    Category $currentCategory,
    EntityManagerInterface $em,
    SerializerInterface $serializer,
    UrlGeneratorInterface $urlGenerator): JsonResponse
    {
        $updateCategory = $serializer->deserialize($request->getContent(),
        Category::class,
        'json',
        [AbstractNormalizer::OBJECT_TO_POPULATE => $currentCategory]);

        $em->persist($updateCategory);
        $em->flush();

        $location = $urlGenerator->generate(
            'api_category_update',
            [
                'id' => $updateCategory->getId(),
                'name' => $updateCategory->getName(),
        ],
            UrlGeneratorInterface::ABS_URL
        );

        return $this->json(['status' => 'success'], Response::HTTP_OK, ["Location" => $location]);
    }

    #[Route('/{id}', name: 'api_category_delete', methods: ['DELETE'])]
    #[IsGranted('ROLE_ADMIN')]
    public function delete(Category $category,
    EntityManagerInterface $em): JsonResponse
    {
        $em->remove($category);
        $em->flush();

        return $this->json(['status' => 'Catégorie supprimée avec succès', 'Catégorie supprimé' => $category->getName()], Response::HTTP_OK);
    }

}