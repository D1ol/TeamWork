<?php


namespace App\Form\Tasks;


use App\Entity\Projects\Project;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;


class AddTaskType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('description' ,TextType::class, [
                'attr' => [
                    'class' => 'form-control '
                ],
                'required' => false
            ])
            ->add('project', EntityType::class, [
                'class' => Project::class,
                'query_builder' => function (EntityRepository $er) use ($options) {
                    return $er->createQueryBuilder('p');
                },
                'choice_label' => function ($project) {
                    return $project->getName();
                },
                'attr' => [
                    'class' => 'js-example-basic-multiple form-control '
                ],
                'multiple' => false,
                'label' => 'Projects',
                'placeholder' => '',
                'required' => true
            ]);
    }

}