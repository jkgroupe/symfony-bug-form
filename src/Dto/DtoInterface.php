<?php

namespace App\Dto;

interface DtoInterface
{
    public function hydrate(): void;

    public function setEntity($entity);

    public function getEntity(): object;

    public function getFormClass(): string;

    public function getId(): ?int;

    public function setFormAction(string $action = ''): DtoInterface;

    public function getFormAction(): ?string;
}