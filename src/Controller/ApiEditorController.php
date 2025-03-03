<?php

namespace App\Controller;

use ApiPlatform\Metadata\UrlGeneratorInterface;
use App\Entity\Editor;
use App\Repository\EditorRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;

#[Route('/api/editor')]
#[IsGranted('ROLE_USER')]
class ApiEditorController extends AbstractController
{
    #[Route('', name: 'api_editor_index', methods: ['GET'])]
    public function index(EditorRepository $editorRepository,
    SerializerInterface $serializer): JsonResponse
    {
        $editor = $editorRepository->findAll();
        $json = $serializer->serialize($editor, 'json', ['groups' => 'editor:read']);

        return new JsonResponse($json, Response::HTTP_OK, [], true);
    }

    #[Route('/{id}', name: 'api_editor_show', methods: ['GET'])]
    public function show(Editor $editor,
    SerializerInterface $serializer): JsonResponse
    {
        $json = $serializer->serialize($editor, 'json', ['groups' => 'editor:read']);

        return new JsonResponse($json, Response::HTTP_OK, [], true);
    }

    #[Route('/new', name: 'api_editor_new', methods: ['POST'])]
    #[IsGranted('ROLE_ADMIN')]
    public function new(Request $request,
    EntityManagerInterface $em,
    SerializerInterface $serializer,
    UrlGeneratorInterface $urlGenerator): JsonResponse
    {
        $editor = $serializer->deserialize($request->getContent(), Editor::class, 'json');
        $em->persist($editor);
        $em->flush();

        $location = $urlGenerator->generate(
            'api_editor_new',
            [
                'name' => $editor->getName(),
                'country' => $editor->getCountry(),
        ],
            UrlGeneratorInterface::ABS_URL
        );

        return $this->json(
            ["success" => "Editeur crée avec succès", "Editeur crée" => $editor->getName()], Response::HTTP_CREATED,
            ["Location" => $location], ['groups' => 'getEditor']
        );
    }

    #[Route('/{id}', name: 'api_editor_update', methods: ['PUT'])]
    #[IsGranted('ROLE_ADMIN')]
    public function update(Request $request,
    Editor $currentEditor,
    EntityManagerInterface $em,
    SerializerInterface $serializer,
    UrlGeneratorInterface $urlGenerator): JsonResponse
    {
        $updateEditor = $serializer->deserialize($request->getContent(),
        Editor::class,
        'json',
        [AbstractNormalizer::OBJECT_TO_POPULATE => $currentEditor]);

        $em->persist($updateEditor);
        $em->flush();

        $location = $urlGenerator->generate(
            'api_editor_update',
            [
                'id' => $updateEditor->getId(),
                'name' => $updateEditor->getName(),
                'country' => $updateEditor->getCountry(),
        ],
            UrlGeneratorInterface::ABS_URL
        );

        return $this->json(['status' => 'success'], Response::HTTP_OK, ["Location" => $location]);
    }

    #[Route('/{id}', name: 'api_editor_delete', methods: ['DELETE'])]
    #[IsGranted('ROLE_ADMIN')]
    public function delete(Editor $editor,
    EntityManagerInterface $em): JsonResponse
    {
        $em->remove($editor);
        $em->flush();

        return $this->json(['status' => 'Editeur supprimé avec succès', 'Editeur supprimé' => $editor->getName()], Response::HTTP_OK);
    }

}