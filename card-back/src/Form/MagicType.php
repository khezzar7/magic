<?php

namespace App\Form;

use App\Entity\Magic;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class MagicType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('image',FileType::class, array(
              'label'=>'image'
            ))
            ->add('title')
            ->add('body')
            ->add('edition')
            ->add('rarity')
            ->add('artist')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Magic::class,
        ]);
    }
}
