<?php

namespace CodeCats\PanelBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Email
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="CodeCats\PanelBundle\Entity\EmailRepository")
 */
class Email implements \JsonSerializable
{
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
     * @ORM\Column(name="username", type="string", length=255)
     */
    private $username;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=255)
     */
    private $password;

    /**
     * @var string
     *
     * @ORM\Column(name="transfer_protocol", type="string", length=255)
     */
    private $transferProtocol;

    /**
     * @var integer
     *
     * @ORM\Column(name="port", type="integer")
     */
    private $port;

    /**
     * @var string
     *
     * @ORM\Column(name="send_from", type="string", length=255)
     */
    private $sendFrom;

    /**
     * @ORM\OneToMany(targetEntity="CodeCats\PanelBundle\Entity\User", mappedBy="companyEmail")
     */
    private $users;

    public function __construct()
    {
        $this->users = new ArrayCollection();
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
     * @return Email
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
     * Set password
     *
     * @param string $password
     * @return Email
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

    /**
     * Set transferProtocol
     *
     * @param string $transferProtocol
     * @return Email
     */
    public function setTransferProtocol($transferProtocol)
    {
        $this->transferProtocol = $transferProtocol;

        return $this;
    }

    /**
     * Get transferProtocol
     *
     * @return string 
     */
    public function getTransferProtocol()
    {
        return $this->transferProtocol;
    }

    /**
     * Set port
     *
     * @param integer $port
     * @return Email
     */
    public function setPort($port)
    {
        $this->port = $port;

        return $this;
    }

    /**
     * Get port
     *
     * @return integer 
     */
    public function getPort()
    {
        return $this->port;
    }

    /**
     * Set sendFrom
     *
     * @param string $sendFrom
     * @return Email
     */
    public function setSendFrom($sendFrom)
    {
        $this->sendFrom = $sendFrom;

        return $this;
    }

    /**
     * Get sendFrom
     *
     * @return string 
     */
    public function getSendFrom()
    {
        return $this->sendFrom;
    }

    public function addUser(User $user)
    {
        $this->users->add($user);
    }

    public function getUsers()
    {
        return $this->users;
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
        return array(
            'id'                => $this->getId(),
            'username'          => $this->getUsername(),
            'password'          => $this->getPassword(),
            'transferProtocol'  => $this->getTransferProtocol(),
            'port'              => $this->getPort(),
            'sendFrom'          => $this->getSendFrom()
        );
    }
}
