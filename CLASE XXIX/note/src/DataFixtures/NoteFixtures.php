<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Note;
use App\Entity\NoteItem;

class NoteFixtures extends Fixture {

    public function load(ObjectManager $manager) {

        for ($i = 0; $i < 5; $i++) {
            $note = new Note();
            $note->setTitle($i);

            $date = new \DateTime();
            $item1 = new NoteItem();
            $item1->setText("Lorem ipsum dolor sit amet consectetur adipiscing ");
            $item1->setDueDate($date->modify('+1 day'));
            $note->addNoteItem($item1);



            $item2 = new NoteItem();
            $item2->setText("Maecenas blandit malesuada penatibus tincidunt convallis");
            $note->addNoteItem($item2);


            $date2 = new \DateTime();
            $item3 = new NoteItem();
            $item3->setText("Quis id elementum risus sodales tellus interdum ultrices");
            $item3->setDueDate($date2->modify('+1 month'));
            $note->addNoteItem($item3);

            $manager->persist($note);
        }




        $manager->flush();
    }

}
