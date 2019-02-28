<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;



class NoteType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('title', TextType::class, ['label' => 'Título','help' => 'Escribe el título de la nota'])
                ->add('note', TextType::class, ['label' => 'Nota', 'help' => 'Escribe la nota'])
                ->add('dueDate', DateType::class, ['label' => 'Fecha vencimiento', 'help' => 'Fecha en la que caduca'])
                ->add('attachedFile', FileType::class, ['label' => 'Adjunto','required'=>false])
                ->add('save', SubmitType::class, ['label' => 'Guardar Nota'])
        ;
    }

}
