<?php

namespace App\Form;

use App\Entity\Produits;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;

class ProduitType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder

            ->add('email')
            ->add('photo', filetype::class)
            ->add('prix', MoneyType::class)

            ->add('couchage')
            ->add('ariver', datetype::class, [

                'widget' => 'single_text',

                // this is actually the default format for single_text

                'format' => 'yyyy-MM-dd',
            ])



            ->add('depart', datetype::class, [

                'widget' => 'single_text',

                // this is actually the default format for single_text

                'format' => 'yyyy-MM-dd',
            ])
            ->add('descreption')
            ->add('category')
            ->add('ville')

            ->add('valider', SubmitType::class);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Produits::class,
        ]);
    }
}
