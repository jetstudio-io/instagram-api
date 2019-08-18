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

class Image extends Post
{
    /**
     * @var Resolution
     */
    protected $lowSolution;

    /**
     * @var Resolution
     */
    protected $thumbnail;

    /**
     * @var Resolution
     */
    protected $standardResolution;

    public function __construct(array $data = [])
    {
        parent::__construct($data);

        $this->lowSolution = new Resolution($data['images']['low_resolution']);
        $this->thumbnail = new Resolution($data['images']['thumbnail']);
        $this->standardResolution = new Resolution($data['images']['standard_resolution']);
    }

    /**
     * @return Resolution
     */
    public function getLowSolution(): Resolution
    {
        return $this->lowSolution;
    }

    /**
     * @param Resolution $lowSolution
     * @return Image
     */
    public function setLowSolution(Resolution $lowSolution): self
    {
        $this->lowSolution = $lowSolution;
        return $this;
    }

    /**
     * @return Resolution
     */
    public function getThumbnail(): Resolution
    {
        return $this->thumbnail;
    }

    /**
     * @param Resolution $thumbnail
     * @return Image
     */
    public function setThumbnail(Resolution $thumbnail): self
    {
        $this->thumbnail = $thumbnail;
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
     * @return Image
     */
    public function setStandardResolution(Resolution $standardResolution): self
    {
        $this->standardResolution = $standardResolution;
        return $this;
    }
}
