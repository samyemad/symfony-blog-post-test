<?php

namespace App\Controller\API\BlogPost;

use App\Entity\BlogPost;
use App\Enum\SerializationGroup;
use App\Service\Serializer\CustomSerializerInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DetailBlogPostController extends AbstractController
{
    #[Route('/api/blogposts/{id}', name: 'api_blogpost_detail', methods: ['GET'])]
    public function __invoke(
        string $id,
        EntityManagerInterface $entityManager,
        CustomSerializerInterface $serializer
    ): JsonResponse {
        $blogPost = $entityManager->getRepository(BlogPost::class)->find($id);
        if (!$blogPost) {
            return $this->json(['message' => 'Blog post not found'], Response::HTTP_NOT_FOUND);
        }
        $data = $serializer->serialize($blogPost, 'json', ['groups' => SerializationGroup::DETAILS->value]);

        return new JsonResponse($data, Response::HTTP_OK, [], true);
    }
}
