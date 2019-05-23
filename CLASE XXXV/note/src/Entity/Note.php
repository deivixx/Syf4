<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiFilter;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;

/**
 * @ApiResource
 * @ORM\Entity(repositoryClass="App\Repository\NoteRepository")
 */
class Note
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=15)
     */
    private $title;

 
    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $attachedFile;

    
    /**
     * @ORM\OneToMany(targetEntity="App\Entity\NoteItem", mappedBy="note", orphanRemoval=true,cascade={"persist"})
     */
    private $noteItems;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="notes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    public function __construct()
    {
        $this->noteItems = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    
    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

 
    public function getAttachedFile(): ?string
    {
        return $this->attachedFile;
    }

    public function setAttachedFile(?string $attachedFile): self
    {
        $this->attachedFile = $attachedFile;

        return $this;
    }

    /**
     * @return Collection|NoteItem[]
     */
    public function getNoteItems(): Collection
    {
        return $this->noteItems;
    }

    public function addNoteItem(NoteItem $noteItem): self
    {
        if (!$this->noteItems->contains($noteItem)) {
            $this->noteItems[] = $noteItem;
            $noteItem->setNote($this);
        }

        return $this;
    }

    public function removeNoteItem(NoteItem $noteItem): self
    {
        if ($this->noteItems->contains($noteItem)) {
            $this->noteItems->removeElement($noteItem);
            // set the owning side to null (unless already changed)
            if ($noteItem->getNote() === $this) {
                $noteItem->setNote(null);
            }
        }

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }
}
