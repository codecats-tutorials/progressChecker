<?php

namespace CodeCats\PanelBundle\Form;

use CodeCats\PanelBundle\Form\DataTransformer\StringToDateTimeTransformer;
use CodeCats\PanelBundle\Form\Type\ExtjsTimeType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Csrf\CsrfProvider\CsrfProviderInterface;
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
            ->add('description', 'text', array(
                'required' => false
            ))
            ->add('started', 'date', array(
                'widget' => 'single_text',
                'format' => 'yyyy-MM-dd',
            ))
            ->add('ended', 'date', array(
                'widget' => 'single_text',
                'format' => 'yyyy-MM-dd',
            ))
            ->add('endedTime', new ExtjsTimeType())
//            ->add('endedTime', 'code_cats.type.extjs_time')
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
        return 'progress';
    }
}
