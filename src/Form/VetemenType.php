<?php

namespace App\Form;

use App\Entity\Vetement;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType; 
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\Choice;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;


use GuzzleHttp\Client;





class VetemenType extends AbstractType
{

// utilisation de la bibliothèque Guzzle pour effectuer des requêtes HTTP (composer require guzzlehttp/guzzle)
    // private function getMarquesFromApi(): array
    // {
    //     $client = new Client();
    //     $response = $client->get('https://example.com/api/marques'); 
    //     $data = json_decode($response->getBody(), true);

    //     return array_combine($data, $data);
    // }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {

        
      
        $builder
            ->add('nom', TextType::class, [
                'constraints' => [
                    new NotBlank(),
                    new Length(['min' => 2, 'max' => 255]),
                ],
            ])
            ->add('description', TextareaType::class, [
                'constraints' => [
                    new NotBlank(),
                    new Length(['min' => 10]),
                ],
            ])
            ->add('tailles', ChoiceType::class, [
                'choices' => [
                    'Petit' => 'petit',
                    'Moyen' => 'moyen',
                    'Grand' => 'grand',
                    'M' => 'M',
                    'S' => 'S',
                    'XL' => 'XL',

                ],
                'constraints' => [
                    new NotBlank(),
                    new Choice(['choices' => ['petit', 'moyen', 'grand', 'M', 'S', 'XL']]),
                ],
            ])
            ->add('marque', EntityType::class, [
                'class' => \App\Entity\Marque::class,
                'choice_label' => 'nom', // Remplacez par le champ que vous souhaitez afficher dans la liste déroulante
            ])
            ->add('image', FileType::class, [
                'label' => 'Image (JPEG, PNG, ou GIF file)',
                'mapped' => false,
                'required' => false,
                'constraints' => [
                    new File([
                        'maxSize' => '1024k',
                        'mimeTypes' => ['image/jpeg', 'image/png', 'image/gif'],
                        'mimeTypesMessage' => 'Please upload a valid image file',
                    ]),
                ],
            ])
            ->add('valider', SubmitType::class);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Vetement::class,
            // 'marques' => $this->getMarquesFromApi(),

        ]);
    }
}
