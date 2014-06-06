<?php

namespace CodeCats\PanelBundle\Form;

use CodeCats\PanelBundle\Form\DataTransformer\StringToDateTimeTransformer;
use CodeCats\PanelBundle\Form\Type\ExtjsTimeType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Csrf\CsrfProvider\CsrfProviderInterface;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ProjectType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('description', 'text', array(
                'required' => false
            ))
            ->add('dateStarted', 'date', array(
                'widget' => 'single_text',
                'format' => 'yyyy-MM-dd',
                'required' => false
            ))
            ->add('timeStarted', new ExtjsTimeType(array('nullable' => true)), array(
                'required' => false
            ))
            ->add('dateEnded', 'date', array(
                'widget' => 'single_text',
                'format' => 'yyyy-MM-dd',
                'required' => false
            ))
            ->add('timeEnded', new ExtjsTimeType(array('nullable' => true)), array(
                'required' => false
            ))
            ->add('dateDeadline', 'date', array(
                'widget' => 'single_text',
                'format' => 'yyyy-MM-dd',
                'required' => false
            ))
            ->add('timeDeadline', new ExtjsTimeType(array('nullable' => true)), array(
                'required' => false
            ))
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
            'data_class' => 'CodeCats\PanelBundle\Entity\Project'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'Project';
    }
}
