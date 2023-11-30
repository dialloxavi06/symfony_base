<?php

namespace App\Form;

use App\Entity\Vetement;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType; // Add this line

class VetemenType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom')
            ->add('description')
            ->add('tailles')
            ->add('marque')
            ->add('image', FileType::class, [
                'label' => 'Image (JPEG, PNG, ou GIF file)',
                'mapped' => false,
                'required' => false,
            ])
            ->add('valider', SubmitType::class);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Vetement::class,
        ]);
    }
}
