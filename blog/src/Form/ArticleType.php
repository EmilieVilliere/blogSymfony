<?php

namespace App\Form;

use App\Entity\Article;
use App\Entity\Tag;
use function Sodium\add;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ArticleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('tags',
                EntityType::class,
                [
                    'class' => Tag::class,
                    'choice_label' => 'name',
                    'multiple'     => true,
                    'expanded'     => true,
                ])



            ->add('title')
            ->add('content')
            ->add('category', null, ['choice_label' => 'name']);

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Article::class,
        ]);
    }
}
