<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\DateFilter;


/**
 * @ApiResource
 * @ApiFilter(DateFilter::class, properties={"dueDate"})
 * @ORM\Entity(repositoryClass="App\Repository\NoteItemRepository")
 */
class NoteItem
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=64)
     */
    private $text;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $dueDate;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Note", inversedBy="noteItems")
     * @ORM\JoinColumn(nullable=false)
     */
    private $note;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getText(): ?string
    {
        return $this->text;
    }

    public function setText(string $text): self
    {
        $this->text = $text;

        return $this;
    }

    public function getDueDate(): ?\DateTimeInterface
    {
        return $this->dueDate;
    }

    public function setDueDate(?\DateTimeInterface $dueDate): self
    {
        $this->dueDate = $dueDate;

        return $this;
    }

    public function getNote(): ?Note
    {
        return $this->note;
    }

    public function setNote(?Note $note): self
    {
        $this->note = $note;

        return $this;
    }
}
