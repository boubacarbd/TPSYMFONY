<?php

namespace App\Form;

use App\Entity\Book;
use App\Entity\Borrow;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BorrowType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
           ->add('status', ChoiceType::class, [
            'choices' => [
                'Emprunté' => 'emprunté',
            ],
        ])
            // ->add('status')
            ->add('borrowDate', null, [
                'widget' => 'single_text',
            ])
            ->add('book', EntityType::class, [
                'class' => Book::class,
                'choice_label' => 'title',
            ])
            // ->add('user', EntityType::class, [
            //     'class' => User::class,
            //     'choice_label' => 'name',
            // ])
            // ->add('borrow', EntityType::class, [
            //     'class' => Book::class,
            //     'choice_label' => 'id',
            // ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Borrow::class,
        ]);
    }
}
