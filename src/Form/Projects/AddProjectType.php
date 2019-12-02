<?php


namespace App\Form\Projects;



use App\Entity\Clients\Client;
use App\Entity\Projects\Project;
use App\Entity\Users\User;
use App\Entity\Users\Users;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AddProjectType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name' ,TextType::class, [
                'attr' => [
                    'class' => 'form-control form-control-light',
                    'autocomplete' => 'off'
                ]
            ])
            ->add('description' ,TextareaType::class, [
                'attr' => [
                    'rows' => 5,
                    'cols' => 5,
                    'class' => 'form-control form-control-light'
                ],
                'required' => false
            ])
            ->add('client', EntityType::class, [
                'class' => Client::class,
                'choice_label' => 'name',
                'query_builder' => function(EntityRepository $er){
                    return $er->createQueryBuilder('c')
                        ->orderBy('c.name');
                },
                'attr' => [
                    'class' => 'form-control form-control-light'
                ],
                'label' => 'Client name'
            ])

            ->add('users', EntityType::class, [
                'class' => User::class,
                'query_builder' => function (EntityRepository $er) use ($options) {
                    return $er->createQueryBuilder('u');
                },
                'choice_label' => function ($users) {
                    return $users->getSurname() . " " . $users->getName();
                },
                'attr' => [
                    'class' => 'js-example-basic-multiple form-control '
                ],
                'multiple' => true,
                'label' => 'Users',
                'required' => false
            ])
            ->add(
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