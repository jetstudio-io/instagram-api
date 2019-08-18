<?php
declare(strict_types=1);

namespace Jetcoder\Instagram\Post;

use Jetcoder\Instagram\Post;

/**
 * Created by Nguyen Van Thiep,
 * User: macosxvn
 * Date: 2019-08-18
 * Time: 16:34
 */

class Video extends Post
{
    /**
     * @var Resolution
     */
    protected $lowResolution;

    /**
     * @var Resolution
     */
    protected $standardResolution;

    /**
     * @var Resolution
     */
    protected $imageLowResolution;

    /**
     * @var Resolution
     */
    protected $imageThumbnail;

    /**
     * @var Resolution
     */
    protected $imageStandardResolution;

    public function __construct(array $data = [])
    {
        parent::__construct($data);

        $this->lowResolution = new Resolution($data['videos']['low_resolution']);
        $this->standardResolution = new Resolution($data['videos']['standard_resolution']);

        $this->imageLowResolution = new Resolution($data['images']['low_resolution']);
        $this->imageThumbnail = new Resolution($data['images']['thumbnail']);
        $this->imageStandardResolution = new Resolution($data['images']['standard_resolution']);
    }

    /**
     * @return Resolution
     */
    public function getLowResolution(): Resolution
    {
        return $this->lowResolution;
    }

    /**
     * @param Resolution $lowResolution
     * @return Video
     */
    public function setLowResolution(Resolution $lowResolution): self
    {
        $this->lowResolution = $lowResolution;
        return $this;
    }

    /**
     * @return Resolution
     */
    public function getStandardResolution(): Resolution
    {
        return $this->standardResolution;
    }

    /**
     * @param Resolution $standardResolution
     * @return Video
     */
    public function setStandardResolution(Resolution $standardResolution): self
    {
        $this->standardResolution = $standardResolution;
        return $this;
    }

    /**
     * @return Resolution
     */
    public function getImageLowResolution(): Resolution
    {
        return $this->imageLowResolution;
    }

    /**
     * @param Resolution $imageLowResolution
     * @return Video
     */
    public function setImageLowResolution(Resolution $imageLowResolution): self
    {
        $this->imageLowResolution = $imageLowResolution;
        return $this;
    }

    /**
     * @return Resolution
     */
    public function getImageThumbnail(): Resolution
    {
        return $this->imageThumbnail;
    }

    /**
     * @param Resolution $imageThumbnail
     * @return Video
     */
    public function setImageThumbnail(Resolution $imageThumbnail): self
    {
        $this->imageThumbnail = $imageThumbnail;
        return $this;
    }

    /**
     * @return Resolution
     */
    public function getImageStandardResolution(): Resolution
    {
        return $this->imageStandardResolution;
    }

    /**
     * @param Resolution $imageStandardResolution
     * @return Video
     */
    public function setImageStandardResolution(Resolution $imageStandardResolution): self
    {
        $this->imageStandardResolution = $imageStandardResolution;
        return $this;
    }
}
