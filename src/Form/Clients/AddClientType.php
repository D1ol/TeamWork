<?php


namespace App\Form\Clients;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class AddClientType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
            'name',
            TextType::class,
            [
                'attr' => [
                    'class' => 'form-control'
                ],
                'label'=>'Client name'
            ])
            ->add('color', TextType::class, [
                'attr' => [
                    'class' => 'colorpicker form-control'
                ]
            ])
            ->add('clientFile', FileType::class, [
                'attr' => [
                    'class' => 'dropify',
                    'accept' => "image/*",
                    'data-max-file-size' => "2M"
                ],
                'label' => false
            ])
            ->add(
            'submit',
            SubmitType::class,
            []
        );
    }
}