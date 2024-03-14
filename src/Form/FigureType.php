<?php

namespace App\Form;

use App\Entity\Figure;
use App\Entity\Media;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FigureType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('content', TextType::class, [
                'label' => 'Contenu',
                'attr' => ['placeholder' => 'Contenu de la fagure !'],
            ])
            ->add('name', TextType::class, [
                'label' => 'Nom :',
                'attr' => ['placeholder' => 'Nom de la figure !'],
            ])
            ->add('category', ChoiceType::class, [
                'label' => 'Groupe',
                'choices' => [
                    'Groupe 1' => 'Groupe 1',
                    'Groupe 2' => 'Groupe 2',
                    'Groupe 3' => 'Groupe 3',
                    'Groupe 4' => 'Groupe 4',
                ],
                'multiple' => false,
            ])
            ->add('medias', EntityType::class, [
                'class' => Media::class,
                'choice_label' => 'path',
                'multiple' => true,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Figure::class,
        ]);
    }
}
