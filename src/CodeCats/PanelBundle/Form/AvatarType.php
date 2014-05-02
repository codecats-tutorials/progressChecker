<?php
/**
 * Created by PhpStorm.
 * User: s
 * Date: 4/28/14
 * Time: 9:47 PM
 */

namespace CodeCats\PanelBundle\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class AvatarType extends AbstractType{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('file')
          //  ->add('path')
        ;
    }
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class'        => 'CodeCats\PanelBundle\Entity\Avatar',
            'csrf_protection'   => false
        ));
    }

    /**
     * Returns the name of this type.
     *
     * @return string The name of this type
     */
    public function getName()
    {
        return 'codecats_panelbundle_avatar';
    }
}