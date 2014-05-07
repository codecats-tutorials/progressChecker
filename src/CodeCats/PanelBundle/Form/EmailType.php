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
        $opt = array('required' => false);

        $builder
            ->add('username', 'text', $opt)
            ->add('password', 'repeated', array(
                'first_name'    => 'password',
                'second_name'   => 'confirm',
                'type'          => 'password',
                'required'      => false
            ))
            ->add('transferProtocol', 'text', $opt)
            ->add('port', 'number', $opt)
            ->add('sendFrom', 'text', $opt)
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
