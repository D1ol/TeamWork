<?php

namespace App\Form\Users;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class AddUserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add(
            'email',
            EmailType::class,
            [
                'attr' => [
                'class' => 'form-control form-control-line'
            ],
                'label'=>'Email'
            ]
        )->add(
            'password',
            RepeatedType::class,
            [

                'type' => PasswordType::class,
                'invalid_message' => 'The password fields must match.',
                'required' => true,
                'first_options'  => [
                    'attr' => [
                    'class' => 'form-control form-control-line'
                ],
                    'label' => 'Password'
                ],
                'second_options' => [
                    'attr' => [
                        'class' => 'form-control form-control-line'
                    ],
                    'label' => 'Repeat Password'
                ],
            ]
        )->add(
            'name',
            TextType::class,
            [
                'attr' => [
                    'class' => 'form-control form-control-line'
                ],
                'label'=>'Name'
            ]
        )->add(
            'surname',
            TextType::class,
            [
                'attr' => [
                    'class' => 'form-control form-control-line'
                ],
                'label'=>'Surname'
            ]
        )->add(
            'phone',
            TextType::class,
            [
                'attr' => [
                    'class' => 'form-control form-control-line'
                ],
                'label'=>'Phone'
            ]
        )->add(
            'submit',
            SubmitType::class,
            [
                'attr' => [
                    'class' => 'btn btn-success'
                ]
            ]
        );
    }
}