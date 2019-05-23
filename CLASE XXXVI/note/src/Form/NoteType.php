<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use App\Form\NoteItemType;
use App\Entity\Note;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class NoteType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('title', TextType::class, ['label' => 'titulo.nota', 'help' => 'titulo.help'])
                ->add('attachedFile', FileType::class, ['label' => 'adjunto', 'required' => false])
                ->add('noteItems', CollectionType::class, [
                    'entry_type' => NoteItemType::class,
                    'allow_add' => true,
                    'allow_delete' => true,
                    'by_reference' => false,
                    'label' => false,
                ])
                ->add('save', SubmitType::class, ['label' => 'guardar.nota'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults([
            'data_class' => Note::class,
        ]);
    }

}
