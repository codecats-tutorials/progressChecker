<?php

namespace CodeCats\PanelBundle\Form;

use CodeCats\PanelBundle\Form\DataTransformer\StringToDateTimeTransformer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ProgressType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('description')
     //       ->add('id')
            //->add('started', 'datetime')
          //  ->add('ended', 'datetime')
            ->add('started', 'text')
            ->addViewTransformer(new StringToDateTimeTransformer())
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {

        $resolver->setDefaults(array(
            'csrf_protection' => false,
            'csrf_field_name' => '_dc',
            'data_class' => 'CodeCats\PanelBundle\Entity\Progress'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'codecats_panelbundle_progress';
    }
}
