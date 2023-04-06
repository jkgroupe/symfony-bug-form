<?php

namespace App\Dto;

use App\Entity\Step;
use App\Form\StepForm;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @method Step getEntity()
 */
class StepDto extends AbstractDto
{
    public ?int $position;

    #[Assert\NotBlank]
    public ?string $name;

    #[Assert\NotBlank]
    public ?float $probability;

    public function __construct(Step $step = null)
    {
        $step = $step ?? (new Step());
        $this->setEntity($step);
        $this->name = $step->getName();
        $this->probability = $step->getProbability();
        $this->position = $step->getOrderNumber();
    }

    public function hydrate(): void
    {
        $this
            ->getEntity()
            ->setName($this->name)
            ->setProbability($this->probability)
            ->setOrderNumber($this->position);
    }

    public function getFormClass(): string
    {
        return StepForm::class;
    }
}