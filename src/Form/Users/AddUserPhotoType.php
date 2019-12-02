<?php


namespace App\Form\Users;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;

class AddUserPhotoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder

            ->add('userFile', FileType::class, [
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