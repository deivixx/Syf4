<?php

namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;

class Note {

    /**
    * @Assert\NotBlank
    * @Assert\Length(max=10, maxMessage="Título demasiado largo")
    */
    protected $title;
    
    /**
    * @Assert\NotBlank
    * @Assert\Length(max=255, maxMessage="Nota demasiado larga", min=4, minMessage="Nota demasiado corta")
    */    
    protected $note;
    
    /**
     * @Assert\NotBlank
     * @Assert\Type("\DateTime")
     */
    protected $dueDate;

    function getTitle() {
        return $this->title;
    }

    function getNote() {
        return $this->note;
    }

    function setTitle($title) {
        $this->title = $title;
    }

    function setNote($note) {
        $this->note = $note;
    }
    
    public function getDueDate() {
        return $this->dueDate;
    }

    public function setDueDate(\DateTime $dueDate = null) {
        $this->dueDate = $dueDate;
    }
    
    
    protected $attachedFile;

    function getAttachedFile() {
        return $this->attachedFile;
    }

    function setAttachedFile($attachedFile) {
        $this->attachedFile = $attachedFile;
    }


    
    

}
