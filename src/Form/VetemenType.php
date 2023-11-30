<?php

namespace App\Form;

use App\Entity\Vetement;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType; // Add this use statement

class VetemenType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom')
            ->add('description')
            ->add('tailles')
            ->add('marque')
            ->add('image', FileType::class, [ // Add FileType field for image
                'label' => 'Image (JPEG, PNG, or GIF file)',
                'mapped' => false, // This is not a mapped field to the database
                'required' => false, // It's not required in the form
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Vetement::class,
        ]);
    }
}
