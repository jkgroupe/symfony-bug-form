<?php

namespace App\Dto;

use App\Entity\Pipeline;
use App\Form\PipelineForm;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @method Pipeline getEntity()
 */
class PipelineDto extends AbstractDto
{
    #[Assert\NotBlank]
    public ?string $name;

    #[Assert\Valid]
    public array $steps = [];

    public function __construct(Pipeline $pipeline)
    {
        $this->setEntity($pipeline);
        $this->name = $pipeline->getName();
        $this->steps = [];

        foreach ($pipeline->getSteps() as $step) {
            $this->steps[] = new StepDto($step);
        }
    }

    public function hydrate(): void
    {
        $this->getEntity()->setName($this->name);
        $this->getEntity()->getSteps()->clear();

        foreach ($this->steps as $step) {
            $step->hydrate();
            $this->getEntity()->addStep($step->getEntity());
        }
    }

    public function getFormClass(): string
    {
        return PipelineForm::class;
    }
}