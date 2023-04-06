<?php

namespace App\Dto;

abstract class AbstractDto implements DtoInterface
{
    private object $entity;
    private string $formAction = '';

    public function getId(): ?int
    {
        if (!\method_exists($this->entity, 'getId')) {
            return null;
        }

        return $this->entity->getId();
    }

    public function getEntity(): object
    {
        return $this->entity;
    }

    public function setEntity($entity): self
    {
        $this->entity = $entity;

        return $this;
    }

    public function getFormAction(): ?string
    {
        return $this->formAction;
    }

    public function setFormAction(string $action = ''): self
    {
        $this->formAction = $action;

        return $this;
    }
}