<?php

namespace App\Form;

use App\Entity\Muscle;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class MuscleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nameOfMuscle', null, ['attr'=>['placeholder'=>"le nom du muscle/de l'endroit du corps que vous voulez ajouter OBLIGATOIRE"]])
            ->add('image', null, ['attr'=>['placeholder'=>"une url vers la photo web OPTIONEL"]])
            ->add('ExtraExpl', null, ['attr'=>['placeholder'=>"un texte qui reprend des explications complémentaires OPTIONEL"]])
            ->add('save', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Muscle::class,
        ]);
    }
}
