<?php


namespace App\Form\Chat;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class ChatType  extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('message' ,TextareaType::class, [
                'attr' => [
                    'class' => 'form-control type_msg',
                    'placeholder' => 'Type your message...'
                ],

            ])
            ->add(
                'submit',
                SubmitType::class,
                [
                    'attr' => [
                        'class' => 'input-group-text send_btn'
                    ]
                ]
            );
    }
}