<?php
/**
 * Created by PhpStorm.
 * User: t
 * Date: 4/19/14
 * Time: 10:58 AM
 */

namespace CodeCats\PanelBundle\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class RegistrationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        //$builder->add('user', )
    }

    /**
     * Returns the name of this type.
     *
     * @return string The name of this type
     */
    public function getName()
    {
        return 'registration';
    }
}