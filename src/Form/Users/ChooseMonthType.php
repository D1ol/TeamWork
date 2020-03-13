<?php


namespace App\Form\Users;


use App\Entity\Users\User;
use App\Form\CustomFormClasses\MonthChoiceType;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;

class ChooseMonthType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('month', MonthChoiceType::class, [
                'attr' => [
                    'class' => 'form-control form-control-light'
                ],
                'placeholder' =>'Choose month',
                'required' => true,
            ])
            ->add('user', EntityType::class, [
                'class' => User::class,
                'query_builder' => function(EntityRepository $er){
                    return $er->createQueryBuilder('u')
                        ->orderBy('u.name');
                },
                'choice_label' => function ($user) {
                    return $user->getName().' '.$user->getSurname();
                },
                'attr' => [
                    'class' => 'form-control form-control-light'
                ],
                'label' => false,
                'placeholder' =>'Choose user',
                'required' => true,
            ])
            ->add(
                'submit',
                SubmitType::class,
                [
                    'attr' => [
                        'class' => 'btn btn-success waves-effect'
                    ]
                ]
            );

    }

}