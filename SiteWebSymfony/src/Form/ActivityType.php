<?php

namespace App\Form;

use App\Entity\Activity;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Entity\Muscle;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class ActivityType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', null, ['attr'=>['placeholder'=>"le titre de l'activité OBLIGATOIRE"]])
            ->add('description', null, ['attr'=>['placeholder'=>"un texte qui explique l'activité OPTIONEL"]])
            ->add('image', null, ['attr'=>['placeholder'=>"une url vers la photo web OPTIONEL"]])
            ->add('duration', null, ['attr'=>['placeholder'=>"en minute sans virgule OPTIONEL"]])
            ->add('difficult', null, ['attr'=>['placeholder'=>"un nombre entre 0 et 5, 0 étant le plus facile OPTIONEL"]])
            ->add('author', null, ['attr'=>['placeholder'=>"la personne qui a écrit cette exercice ou inventé OPTIONEL"]])
            ->add('material', null, ['attr'=>['placeholder'=>"un texte ou vous notez tous le matériel avec des virgules par exemple OPTIONEL"]])
            ->add('muscle', EntityType::class, [
                'placeholder'=> 'Pas de muscle en particulier',
                'class' => Muscle::class,
                'choice_label'=> 'nameOfMuscle',
                'required'   => false
            ])
            ->add('save', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Activity::class,
        ]);
    }
}
