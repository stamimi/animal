<?php

namespace Animal\PlatformBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;

class AnimalType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom',        TextType::class)
            ->add('age',        BirthdayType::class)
            ->add('famille',    TextType::class)
            ->add('race',       TextType::class)
            ->add('nourriture', TextType::class)
            ->add('ajouter',    SubmitType::class, array('label' => 'Ajouter', 'attr' => array('class' => 'btn btn-primary')));
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Animal\PlatformBundle\Entity\Animal'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'animal_platformbundle_animal';
    }


}
