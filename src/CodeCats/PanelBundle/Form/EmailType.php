<?php

namespace CodeCats\PanelBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class EmailType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username', 'text', array(
                'required' => false
            ))
            ->add('password', 'repeated', array(
                'first_name'    => 'password',
                'second_name'   => 'confirm',
                'type'          => 'password',
                'required'      => false
            ))
            ->add('transferProtocol', 'text', array(
                'required' => false
            ))
            ->add('port', 'number', array(
                'required' => false
            ))
            ->add('sendFrom', 'text', array(
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
            'data_class' => 'CodeCats\PanelBundle\Entity\Email'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'emailType';
    }
}
