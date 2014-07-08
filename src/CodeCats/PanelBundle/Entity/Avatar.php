<?php

namespace CodeCats\PanelBundle\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Avatar
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="CodeCats\PanelBundle\Entity\AvatarRepository")
 * @ORM\HasLifecycleCallbacks
 */
class Avatar
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
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="path", type="string", length=255)
     */
    private $path;

    /**
     * @var DateTime
     *
     * @ORM\Column(name="lastChanged", type="datetime")
     */
    private $lastChanged;

    /**
     * @ORM\OneToOne(targetEntity="CodeCats\PanelBundle\Entity\User", mappedBy="avatar")
     */
    private $user;

    /**
     * @Assert\File(maxSize="9666666")
     */
    private $file;

    private $temp;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getName()
    {
        return $this->name;
    }
    /**
     * Set path
     *
     * @param string $path
     * @return Avatar
     */
    public function setPath($path)
    {
        $this->path = $path;
    }

    /**
     * Get path
     *
     * @return string 
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * Set lastChanged
     *
     * @param DateTime $lastChanged
     * @return Avatar
     */
    public function setLastChanged($lastChanged)
    {
        $this->lastChanged = $lastChanged;
    }

    /**
     * Get lastChanged
     *
     * @return DateTime
     */
    public function getLastChanged()
    {
        return $this->lastChanged;
    }

    public function setUser(User $user)
    {
        $this->user = $user;
    }

    public function getUser()
    {
        return $this->user;
    }

    public function setFile(UploadedFile $file = null)
    {
        $this->file = $file;

        if (isset($this->path)) {
            $this->temp = $this->path;
            $this->path = null;
        } else {
            $this->path = 'initial';
        }
    }

    public function getFile()
    {
        return $this->file;
    }

    /**
     * @ORM\PrePersist()
     * @ORM\PreUpdate()
     */
    public function preUpload()
    {
        if (null !== $this->getFile()) {
            $filename = sha1(uniqid(mt_rand(), true));
            $this->path = $filename . '.' . $this->getFile()->guessExtension();
            $this->setName($this->getFile()->getClientOriginalName());
            $this->setLastChanged(new DateTime());
        }
    }

    /**
     * @ORM\PostPersist()
     * @ORM\PostUpdate()
     */
    public function upload()
    {

        if (null === $this->getFile()) {
            return;
        }

        $this->getFile()->move($this->getUploadRootDir(), $this->path);

        if ( ! empty($this->temp)) {
            $file = $this->getUploadRootDir() . '/' . $this->temp;
            if (file_exists($file)){
                unlink($file);
            }
            $this->temp = null;
        }
        $this->file = null;

    }

    /**
     * @ORM\PostRemove()
     */
    public function removeUpload()
    {
        if ($file = $this->getAbsolutePath()) {
            unlink($file);
        }
    }

    public function getAbsolutePath()
    {
        return null === $this->path
            ? null
            : $this->getUploadRootDir() . '/' . $this->path;
    }

    public function getWebPath()
    {
        return null === $this->path
            ? null
            : $this->getUploadDir() . '/' . $this->path;
    }

    public function getUploadRootDir()
    {
        return __DIR__ . '/../../../../web/' . $this->getUploadDir();
    }

    public function getUploadDir()
    {
        return 'uploads/avatars';
    }
}
