<?php

namespace App\Controller\Web\BlogPost;

use App\Entity\BlogPost;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class DetailBlogPostController extends AbstractController
{
    #[Route('/blog/{id}', name: 'web_blog_detail')]
    public function __invoke(EntityManagerInterface $em, string $id): Response
    {
        $blogPost = $em->getRepository(BlogPost::class)->find($id);

        if (!$blogPost) {
            throw new NotFoundHttpException('Blog post not found');
        }

        return $this->render('web/blog/detail.html.twig', [
            'blogPost' => $blogPost,
        ]);
    }
}
