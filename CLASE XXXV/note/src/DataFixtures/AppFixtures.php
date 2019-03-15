<?php

namespace App\DataFixtures;

use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\User;
use App\Entity\Note;
use App\Entity\NoteItem;

class AppFixtures extends Fixture {

    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder) {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager) {

        $user1 = new User();
        $user2 = new User();
        $user3 = new User();

        $user1->setEmail("david@ow.es");
        $user1->setPassword($this->passwordEncoder->encodePassword(
                        $user1, 'david'
        ));
        $manager->persist($user1);

        $user2->setEmail("syf@ow.es");
        $user2->setPassword($this->passwordEncoder->encodePassword(
                        $user2, 'syf'
        ));
        $manager->persist($user2);

        
        $user3->setEmail("admin@ow.es");
        $user3->setPassword($this->passwordEncoder->encodePassword(
                        $user3, 'admin'
        ));
        $user3->setRoles(["ROLE_ADMIN"]);
        $manager->persist($user3);



        for ($i = 0; $i < 5; $i++) {
            $note = new Note();
            $note->setTitle($i);
            
            if($i<3)
                $note->setUser($user1);
            else
                $note->setUser($user2);
            
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

    public function getDependencies() {
        return array(
            UserFixtures::class,
        );
    }

}
