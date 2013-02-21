<?php
/**
 * Created by JetBrains PhpStorm.
 * User: danvbe
 * Date: 2/21/13
 * Time: 6:47 AM
 * To change this template use File | Settings | File Templates.
 */
namespace Localuri\MediaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="Localuri\MediaBundle\Repository\MediaRepository")
 * @ORM\HasLifecycleCallbacks
 * @ORM\Table(name="lcl_media")
 */
class Media
{
    /**
     * @var The id of the record
     *
     * @ORM\Id
     * @ORM\Column(type="integer", nullable=false)
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true, unique=true)
     */
    protected  $file_name;

    /**
     * this is not persisted... it is here to handle the actual upload
     *
     * @Assert\File(maxSize="6000000")
     */
    protected $file;

    /**
     * a property used temporarily while deleting - it is not persisted, yet is needed on deletion
     * @var string
     */
    protected $filenameForRemove;

    /**
     * @var Creation date
     *
     * @ORM\Column(type="datetime", nullable=true)
     */
    protected $created_at;

    /**
     * @var Last update date
     *
     * @ORM\Column(type="datetime", nullable=true)
     */
    protected $updated_at;



    ////////////////////////Lifecycle related functions //////////////////////////////
    /**
     * @ORM\PrePersist()
     */
    public function prePersistFunction(){
        $this->created_at = new \DateTime();
    }

    /**
     * @ORM\PrePersist()
     * @ORM\PreUpdate()
     */
    public function preUpload()
    {
        $this->updated_at = new \DateTime();
        if (null !== $this->file) {
            $this->file_name = uniqid().'.'.$this->file->guessExtension();
        }
    }

    /**
     * @ORM\PostPersist()
     * @ORM\PostUpdate()
     */
    public function upload()
    {
        if (null === $this->file) {
            return;
        }

        // you must throw an exception here if the file cannot be moved
        // so that the entity is not persisted to the database
        // which the UploadedFile move() method does
        $this->file->move( $this->getUploadRootDir(), $this->file_name);

        unset($this->file);
    }

    /**
     * Here we store the path of the file
     * to be unlinked only AFTER the record deletion occurs (when we don't have access to record related elements)
     * @ORM\PreRemove()
     */
    public function storeFilenameForRemove()
    {
        $this->filenameForRemove = $this->getAbsolutePath();
    }

    /**
     * The actual deletion of the file - done AFTER deletion of record
     * @ORM\PostRemove()
     */
    public function removeUpload()
    {
        if ($this->filenameForRemove) {
            unlink($this->filenameForRemove);
        }
    }
    ////////////////////////END Lifecycle related functions //////////////////////////////

    ////////////////////////Path related functions //////////////////////////////
    /**
     * Returns the path for this entity's image
     * @return null|string
     */
    public function getAbsolutePath()
    {
        if(null === $this->extension)
            return null;
        return $this->getUploadRootDir().'/'.$this->file_name;
    }

    /**
     * The web path for the image (necessary when displaying the image)
     * @return null|string
     */
    public function getWebPath()
    {
        if(null === $this->extension)
            return null;
        return $this->getUploadDir().'/'.$this->file_name;
    }

    protected function getUploadRootDir()
    {
        // the absolute directory path where uploaded
        // images should be saved
        return __DIR__.'/../../../../web/'.$this->getUploadDir();
    }

    protected function getUploadDir()
    {
        // get rid of the __DIR__ so it doesn't screw up
        // when displaying uploaded doc/image in the view.
        return 'uploads/media';
    }
    ////////////////////////END Path related functions //////////////////////////////
}
