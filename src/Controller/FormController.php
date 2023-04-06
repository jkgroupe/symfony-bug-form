<?php

namespace App\Controller;

use App\Dto\PipelineDto;
use App\Entity\Pipeline;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FormController extends AbstractController
{
    #[Route('/', name: 'app_form')]
    public function form(FormFactoryInterface $formFactory, Request $request): Response
    {
        $dto = new PipelineDto(new Pipeline());

        $form = $formFactory->create($dto->getFormClass(), $dto, [
            'method' => Request::METHOD_POST,
            'action' => $dto->getFormAction() ?? ''
        ]);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entity = $dto->getEntity();
            $dto->hydrate();

            dd($dto);
        }

        return $this->render("form/form.html.twig", [
            "form" => $form->createView()
        ]);
    }
}