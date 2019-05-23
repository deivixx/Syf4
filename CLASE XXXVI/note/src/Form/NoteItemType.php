<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use App\Entity\NoteItem;
use Symfony\Component\OptionsResolver\OptionsResolver;

class NoteItemType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
        ->add('text', TextType::class, ['label' => false, 'attr' => ['placeholder' => 'texto', 'size' => 64]])
        ->add('dueDate', DateType::class, ['label' => false, 'required' => false, 'widget' => 'single_text', 'attr' => ['size' => 10, 'placeholder' => 'Vencimiento']])       
        ;
    }

    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults([
            'data_class' => NoteItem::class,
        ]);
    }

}
