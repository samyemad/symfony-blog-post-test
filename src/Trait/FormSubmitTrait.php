<?php

namespace App\Trait;

use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;

trait FormSubmitTrait
{
    protected function submitFormWithRequestData(FormInterface $form, Request $request): void
    {
        $formData = array_merge(
            $request->request->all(),
            $request->files->all()
        );
        $form->submit($formData);
    }
}

