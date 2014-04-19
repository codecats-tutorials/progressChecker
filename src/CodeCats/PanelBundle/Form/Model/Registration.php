<?php
/**
 * Created by PhpStorm.
 * User: t
 * Date: 4/19/14
 * Time: 10:48 AM
 */

namespace CodeCats\PanelBundle\Form\Model;


use CodeCats\PanelBundle\Entity\User;

class Registration
{

    /**
     * @Assert\Type(type="CodeCats\PanelBundle\Entity\User")
     * @Assert\Valid()
     */
    protected $user;

    /**
     * @Assert\NotBlank()
     * @Assert\True()
     */
    protected $termsAccepted;

    public function setUser(User $user)
    {
        $this->user = $user;
    }

    public function getUser()
    {
        return $this->user;
    }

    public function setTermsAccepted($terms)
    {
        $this->termsAccepted = (bool) $terms;
    }

    public function getTermsAccepted()
    {
        return $this->termsAccepted;
    }
} 