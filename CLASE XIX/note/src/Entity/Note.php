<?php

namespace App\Entity;

class Note {

    protected $title;
    protected $note;
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

}
