<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Table(name="steps")
 * @ORM\Entity()
 */
class Step
{
    /**
     * @var int|null
     *
     * @ORM\Id
     * @ORM\Column(name="id", type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected ?int $id = null;

    /**
     * @var int
     * @ORM\Column(name="order_number", type="integer")
     * @Gedmo\SortablePosition()
     */
    protected int $orderNumber = -1;

    /**
     * @var string
     * @ORM\Column(name="name", type="string")
     */
    protected string $name = '';

    /**
     * @var float
     * @ORM\Column(name="probability", type="float")
     */
    protected float $probability = 0.0;

    /**
     * @var Pipeline|null
     * @ORM\ManyToOne(targetEntity="App\Entity\Pipeline", fetch="EXTRA_LAZY", inversedBy="steps", cascade={"persist"})
     * @ORM\JoinColumn(name="pipeline_id", referencedColumnName="id", nullable=false)
     *
     * @Gedmo\SortableGroup
     */
    protected ?Pipeline $pipeline = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getOrderNumber(): ?int
    {
        return $this->orderNumber;
    }

    public function setOrderNumber(int $orderNumber): self
    {
        $this->orderNumber = $orderNumber;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getProbability(): ?float
    {
        return $this->probability;
    }

    public function setProbability(float $probability): self
    {
        $this->probability = $probability;

        return $this;
    }

    public function getPipeline(): ?Pipeline
    {
        return $this->pipeline;
    }

    public function setPipeline(?Pipeline $pipeline): self
    {
        $this->pipeline = $pipeline;

        return $this;
    }
}