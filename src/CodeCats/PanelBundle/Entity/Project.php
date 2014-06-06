<?php

namespace CodeCats\PanelBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Project
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="CodeCats\PanelBundle\Entity\ProjectRepository")
 */
class Project
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
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255)
     */
    private $description;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateStarted", type="date")
     */
    private $dateStarted;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="timeStarted", type="time")
     */
    private $timeStarted;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateEnded", type="date")
     */
    private $dateEnded;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="timeEnded", type="time")
     */
    private $timeEnded;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateDeadline", type="date")
     */
    private $dateDeadline;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="timeDeadline", type="time")
     */
    private $timeDeadline;

    /**
     * @var
     *
     * @ORM\ManyToOne(targetEntity="CodeCats\PanelBundle\Entity\User", inversedBy="projectsManage")
     */
    private $manager;

    /**
     * @var
     *
     * @ORM\ManyToMany(targetEntity="CodeCats\PanelBundle\Entity\User", inversedBy="projects")
     * ORM\JoinColumn(name="project_id", referencedColumnName="id")
     */
    private $workers;

    public function __construct()
    {
        $this->workers = ArrayCollection();
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
     * Set name
     *
     * @param string $name
     * @return Project
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Project
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

    /**
     * Set dateStarted
     *
     * @param \DateTime $dateStarted
     * @return Project
     */
    public function setDateStarted($dateStarted)
    {
        $this->dateStarted = $dateStarted;

        return $this;
    }

    /**
     * Get dateStarted
     *
     * @return \DateTime 
     */
    public function getDateStarted()
    {
        return $this->dateStarted;
    }

    /**
     * Set timeStarted
     *
     * @param \DateTime $timeStarted
     * @return Project
     */
    public function setTimeStarted($timeStarted)
    {
        $this->timeStarted = $timeStarted;

        return $this;
    }

    /**
     * Get timeStarted
     *
     * @return \DateTime 
     */
    public function getTimeStarted()
    {
        return $this->timeStarted;
    }

    /**
     * Set dateEnded
     *
     * @param \DateTime $dateEnded
     * @return Project
     */
    public function setDateEnded($dateEnded)
    {
        $this->dateEnded = $dateEnded;

        return $this;
    }

    /**
     * Get dateEnded
     *
     * @return \DateTime 
     */
    public function getDateEnded()
    {
        return $this->dateEnded;
    }

    /**
     * Set timeEnded
     *
     * @param \DateTime $timeEnded
     * @return Project
     */
    public function setTimeEnded($timeEnded)
    {
        $this->timeEnded = $timeEnded;

        return $this;
    }

    /**
     * Get timeEnded
     *
     * @return \DateTime 
     */
    public function getTimeEnded()
    {
        return $this->timeEnded;
    }

    /**
     * Set dateDeadline
     *
     * @param \DateTime $dateDeadline
     * @return Project
     */
    public function setDateDeadline($dateDeadline)
    {
        $this->dateDeadline = $dateDeadline;

        return $this;
    }

    /**
     * Get dateDeadline
     *
     * @return \DateTime 
     */
    public function getDateDeadline()
    {
        return $this->dateDeadline;
    }

    /**
     * Set timeDeadline
     *
     * @param \DateTime $timeDeadline
     * @return Project
     */
    public function setTimeDeadline($timeDeadline)
    {
        $this->timeDeadline = $timeDeadline;

        return $this;
    }

    /**
     * Get timeDeadline
     *
     * @return \DateTime 
     */
    public function getTimeDeadline()
    {
        return $this->timeDeadline;
    }

    public function setManager(User $manager)
    {
        $this->manager = $manager;
    }

    public function getManager()
    {
        return $this->manager;
    }

    public function addWorker(User $user)
    {
        $this->workers->add($user);
    }

    public function getWorker()
    {
        return $this->workers;
    }
}
