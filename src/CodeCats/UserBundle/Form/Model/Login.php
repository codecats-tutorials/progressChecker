<?php
namespace CodeCats\UserBundle\Form\Model;

use CodeCats\PanelBundle\Entity\User;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * Description of Login
 *
 * @author t
 */
class Login 
{
    /**
     *
     */
    protected $login;
    
    protected $password;
    
    public function setLogin($login) 
    {
        $this->login = $login;
    }
    
    public function getLogin() 
    {
        return $this->login;
    }
    
    public function setPassword($password) 
    {
        $this->password = $password;
    }
    
    public function getPassword() 
    {
        return $this->password;
    }
}
