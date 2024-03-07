<?php

namespace App\Controller\Web\BlogPost;

use App\Entity\BlogPost;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ListBlogPostsController extends AbstractController
{
    #[Route('/blog', name: 'web_blog_list')]
    public function __invoke(EntityManagerInterface $em): Response
    {
        $blogPosts = $em->getRepository(BlogPost::class)->findAll();

        return $this->render('web/blog/list.html.twig', [
            'blogPosts' => $blogPosts,
        ]);
    }
}
