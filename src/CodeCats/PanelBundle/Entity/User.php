<?php

namespace CodeCats\PanelBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * User
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="CodeCats\PanelBundle\Entity\UserRepository")
 */
class User implements UserInterface, \JsonSerializable, \Serializable
{
    const GRADE_DEVELOPER   = 'developer';
    const GRADE_ADMIN       = 'admin';
    const GRADE_MODERATOR   = 'moderator';
    const GRADE_USER        = 'user';
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="username", type="string", length=55)
     */
    private $username;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=255)
     */
    private $password;

    /**
     * @ORM\Column(type="string", columnDefinition="ENUM('DEVELOPER', 'ADMIN', 'MODERATOR', 'USER') NOT NULL")
     */
    private $grade;

    /**
     * @ORM\OneToMany(targetEntity="CodeCats\PanelBundle\Entity\Progress", mappedBy="user")
     */
    private $progresses;

    /**
     * @ORM\ManyToMany(targetEntity="CodeCats\PanelBundle\Entity\Phone", inversedBy="users", fetch="EAGER")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $phones;

    /**
     * @Assert\Type(type="CodeCats\PanelBundle\Entity\Avatar")
     * @ORM\OneToOne(targetEntity="CodeCats\PanelBundle\Entity\Avatar", inversedBy="user", cascade={"persist"})
     */
    private $avatar;

    /**
     * @ORM\ManyToOne(targetEntity="CodeCats\PanelBundle\Entity\Email", inversedBy="users")
     * @ORM\JoinColumn(referencedColumnName="id")
     */
    private $companyEmail;

    public function __construct()
    {
        $this->progresses   = new ArrayCollection();
        $this->phones       = new ArrayCollection();
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set username
     *
     * @param string $username
     * @return User
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get username
     *
     * @return string 
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return User
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set password
     *
     * @param string $password
     * @return User
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string 
     */
    public function getPassword()
    {
        return $this->password;
    }

    public function eraseCredentials() {
        
    }

    public function getRoles() {
        return array('ROLE_USER');
    }

    public function getSalt() {
        return null;
    }

    public function setGrade($grade)
    {
        if ( ! in_array($grade, array(self::GRADE_ADMIN, self::GRADE_DEVELOPER, self::GRADE_MODERATOR, self::GRADE_USER))) {
            throw new \InvalidArgumentException('Invalid grade');
        }
        $this->grade = $grade;
    }

    public function getGrade()
    {
        return $this->grade;
    }

    public function addProgresses(Progress $progress)
    {
        $this->progresses->add($progress);
    }

    public function getProgresses()
    {
        return $this->progresses;
    }

    public function addPhone(Phone $phone)
    {
        $this->phones->add($phone);
    }

    public function getPhones()
    {
        return $this->phones;
    }

    public function setAvatar(Avatar $avatar)
    {
        $this->avatar = $avatar;
    }

    public function getAvatar()
    {
        return $this->avatar;
    }

    public function setCompanyEmail(Email $email)
    {
        $this->companyEmail = $email;
    }

    public function getCompanyEmail()
    {
        return $this->companyEmail;
    }

    /**
     * (PHP 5 &gt;= 5.4.0)<br/>
     * Specify data which should be serialized to JSON
     * @link http://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     */
    public function jsonSerialize()
    {
        $phones = null;
        foreach($this->getPhones() as $phone) {
            $phones[] = $phone;
        }
        return array(
            'id'        => $this->getId(),
            'username'  => $this->getUsername(),
            'email'     => $this->getEmail(),
            'grade'     => $this->getGrade(),
            'roles'     => $this->getRoles(),
            'phones'    => $phones
        );
    }

    /**
     * (PHP 5 &gt;= 5.1.0)<br/>
     * String representation of object
     * @link http://php.net/manual/en/serializable.serialize.php
     * @return string the string representation of the object or null
     */
    public function serialize()
    {
        return serialize(array(
            $this->id,
            $this->username,
            $this->password,
            // see section on salt below
            // $this->salt,
        ));
    }

    /**
     * (PHP 5 &gt;= 5.1.0)<br/>
     * Constructs the object
     * @link http://php.net/manual/en/serializable.unserialize.php
     * @param string $serialized <p>
     * The string representation of the object.
     * </p>
     * @return void
     */
    public function unserialize($serialized)
    {
        list (
            $this->id,
            $this->username,
            $this->password,
            // see section on salt below
            // $this->salt
        ) = unserialize($serialized);
    }
}
