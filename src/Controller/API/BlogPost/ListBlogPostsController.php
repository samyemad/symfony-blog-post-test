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

class ListBlogPostsController extends AbstractController
{
    #[Route('/api/blogposts', name: 'api_blogposts_list', methods: ['GET'])]
    public function __invoke(
        EntityManagerInterface $em,
        CustomSerializerInterface $serializer
    ): JsonResponse {
        $blogPosts = $em->getRepository(BlogPost::class)->findAll();
        $data = $serializer->serialize($blogPosts, 'json', ['groups' => SerializationGroup::GENERAL->value]);
        return new JsonResponse($data, Response::HTTP_OK, [], true);
    }
}
