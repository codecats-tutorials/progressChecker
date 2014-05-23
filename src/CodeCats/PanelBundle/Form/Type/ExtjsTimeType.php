<?php
/**
 * Created by PhpStorm.
 * User: s
 * Date: 5/23/14
 * Time: 9:04 PM
 */

namespace CodeCats\PanelBundle\Form\Type;


use CodeCats\PanelBundle\Form\DataTransformer\ExtjsTimeToObjectTransformer;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ExtjsTimeType extends AbstractType {
    private $om;

    public function __construct(ObjectManager $om)
    {
        $this->om = $om;
    }

    public function buildForm(FormBuilderInterface $builderInterface, array $options)
    {
        $transformer = new ExtjsTimeToObjectTransformer($this->om);
        $builderInterface->addModelTransformer($transformer);
    }

    public function setDefaultOptions(OptionsResolverInterface $resolverInterface)
    {
        $resolverInterface->setDefaults(array(
            'invalid_message' => 'The selected date not valid',
        ));
    }

    public function getParent()
    {
        return 'text';
    }
    /**
     * Returns the name of this type.
     *
     * @return string The name of this type
     */
    public function getName()
    {
        return 'extjs_time';
    }
}