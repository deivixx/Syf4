<?php

namespace App\Tests\Entity;

use App\Entity\Note;
use PHPUnit\Framework\TestCase;
use TypeError;

class NoteTestCase extends TestCase {

    public function testNullTitle() {

        $note = new Note();

        $this->expectException(TypeError::class);
        $note->setTitle(null);
    }

}
