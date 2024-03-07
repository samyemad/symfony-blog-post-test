<?php

namespace App\Controller\API\Author;

use App\Entity\Author;
use App\Form\AuthorType;
use App\Service\Author\AuthorProcessorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Trait\FormSubmitTrait;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use App\Trait\SuccessResponseTrait;
use App\Trait\ErrorResponseTrait;

#[Route('/api/author', name: 'api_author_create', methods: ['POST'])]
class CreateAuthorController extends AbstractController
{
    use FormSubmitTrait;
    use SuccessResponseTrait;
    use ErrorResponseTrait;

    public function __invoke(Request $request, AuthorProcessorInterface $authorProcessor): Response
    {
        $author = new Author();
        $form = $this->createForm(AuthorType::class, $author);
        $this->submitFormWithRequestData($form, $request);
        if ($form->isSubmitted() && $form->isValid()) {
            /** @var UploadedFile $imageFile */
            $imageFile = $form->get('image')->getData();
            if (!$imageFile instanceof UploadedFile) {
                return $this->errorJson('You Must Provide Image for Author');
            }
            $authorProcessor->processAuthor($author, $imageFile);
            return $this->successJson(
                ['authorId' => $author->getId()]
            );
        }
        return $this->errorJson(
            (string)$form->getErrors(true)
        );
    }
}
