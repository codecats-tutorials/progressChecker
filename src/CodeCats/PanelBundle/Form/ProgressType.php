<?php

namespace CodeCats\PanelBundle\Form;

use CodeCats\PanelBundle\Form\DataTransformer\StringToDateTimeTransformer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Csrf\CsrfProvider\CsrfProviderInterface;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ProgressType extends AbstractType implements CsrfProviderInterface
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
     //       ->add('id')
            ->add('started', 'date', array(
                'widget' => 'single_text',
                'format' => 'yyyy-MM-dd',
            ))
            ->add('ended', 'date', array(
                'widget' => 'single_text',
                'format' => 'yyyy-MM-dd',
            ))
//            ->add('started', 'text')
//            ->addViewTransformer(new StringToDateTimeTransformer())
//            ->add(
//                $builder->create('started', 'text')->addModelTransformer(new StringToDateTimeTransformer())
//            )
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

    /**
     * Generates a CSRF token for a page of your application.
     *
     * @param string $intention Some value that identifies the action intention
     *                          (i.e. "authenticate"). Doesn't have to be a secret value.
     */
    public function generateCsrfToken($intention)
    {
        // TODO: Implement generateCsrfToken() method.
    }

    /**
     * Validates a CSRF token.
     *
     * @param string $intention The intention used when generating the CSRF token
     * @param string $token The token supplied by the browser
     *
     * @return Boolean Whether the token supplied by the browser is correct
     */
    public function isCsrfTokenValid($intention, $token)
    {
        return true;
        // TODO: Implement isCsrfTokenValid() method.
    }
}
