<?php

namespace CodeCats\PanelBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * Description of LoginType
 *
 * @author t
 */
class LoginType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options) 
    {
        $builder->add('login')
                ->add('password', 'password')
                ->add('Submit', 'submit');
    }
    
    public function getName() 
    {
        return 'login';
    }
}