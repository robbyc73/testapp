<?php

namespace TestBundle\Form;

use TestBundle\Entity\JobSeeker;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class JobSeekerType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', 'text', array('required' => true))
            ->add('surname', 'text',array('required' => true))
            ->add('dOB', 'date',array('required' => true))
	    ->add('add', 'submit', [
       'label' => 'Add Job Seeker', 
       'attr' => ['class' => 'ui primary button']
  ]);
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'TestBundle\Entity\JobSeeker'
        ))
        ->setRequired(['em'])
        ->setAllowedTypes('em', 'Doctrine\ORM\EntityManager');
    }

/*public function getName()

 {
 return 'jobseeker';
 }*/

}
