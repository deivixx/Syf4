<?php

namespace App\Tests\Entity;

use App\Entity\Note;
use App\Entity\User;
use PHPUnit\Framework\TestCase;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use TypeError;

class NoteTest extends KernelTestCase {

    /**
     * @var \Doctrine\ORM\EntityManager
     */
    private $manager;

    /**
     * {@inheritDoc}
     */
    protected function setUp() {
        $kernel = self::bootKernel();

        $this->manager = $kernel->getContainer()
                ->get('doctrine')
                ->getManager();
    }

    protected function tearDown() {
        parent::tearDown();

        $this->manager->close();
        $this->manager = null; // avoid memory leaks
    }

    public function testTitleTooLong() {

        $title = "ascdvfbgthgbegetgtrhgtrhtrhnhbf";

        $note = new Note();

        $note->setTitle($title);
        $this->manager->persist($note);
        $this->expectExceptionMessage("too long");
        $this->manager->flush();
    }

    public function testNullTitle() {

        $note = new Note();

        $this->expectException(TypeError::class);
        $note->setTitle(null);
    }

    public function testNoteOk() {

        $title = "abc";

        $note = new Note();
        $user = $this->manager->getRepository(User::class)->findOneByEmail("admin@ow.es");
        $note->setTitle($title);
        $note->setUser($user);

        $this->manager->persist($note);
        $this->manager->flush();

        $getNote = $this->manager->getRepository(Note::class)->findOneById($note->getId());
        $this->assertEquals($note, $getNote);

        $this->manager->remove($note);
        $this->manager->flush();
    }

}
