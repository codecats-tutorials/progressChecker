<?php

namespace CodeCats\PanelBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use DateTime;

/**
 * Progress
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="CodeCats\PanelBundle\Entity\ProgressRepository")
 */
class Progress implements \JsonSerializable
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
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255)
     */
    private $description;

    /**
     * @var DateTime
     *
     * @ORM\Column(name="started", type="datetime")
     */
    private $started;

    /**
     * @var DateTime
     *
     * @ORM\Column(name="ended", type="datetime")
     */
    private $ended;

    public function __construct()
    {
        $this->setStarted(new DateTime());
        $this->setEnded(new DateTime());
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
     * Set title
     *
     * @param string $title
     * @return Progress
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Progress
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    public function setStarted($date)
    {
        $this->started = $date;

        return $this;
    }

    public function getStarted()
    {
        return $this->started;
    }

    public function setEnded($date)
    {
        $this->ended = $date;

        return $this;
    }

    public function getEnded()
    {
        return $this->ended;
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
        $pattern = 'Y-m-d';

        return array(
            'id'            => $this->getId(),
            'title'         => $this->getTitle(),
            'description'   => $this->getDescription(),
            'started'       => $this->getStarted()->format($pattern),
            'ended'         => $this->getEnded()->format($pattern)
        );
    }
}
