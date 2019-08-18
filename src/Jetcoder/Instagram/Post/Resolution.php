<?php
declare(strict_types=1);
/**
 * Created by Nguyen Van Thiep,
 * User: macosxvn
 * Date: 2019-08-18
 * Time: 16:36
 */

namespace Jetcoder\Instagram\Post;

class Resolution
{
    /**
     * @var string
     */
    protected $url;

    /**
     * @var int
     */
    protected $width;

    /**
     * @var int
     */
    protected $height;

    /**
     * Resolution constructor.
     *
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->url = $data['url'];
        $this->width = $data['width'];
        $this->height = $data['height'];
    }

    /**
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * @param string $url
     * @return Resolution
     */
    public function setUrl(string $url): self
    {
        $this->url = $url;
        return $this;
    }

    /**
     * @return int
     */
    public function getWidth(): int
    {
        return $this->width;
    }

    /**
     * @param int $width
     * @return Resolution
     */
    public function setWidth(int $width): self
    {
        $this->width = $width;
        return $this;
    }

    /**
     * @return int
     */
    public function getHeight(): int
    {
        return $this->height;
    }

    /**
     * @param int $height
     * @return Resolution
     */
    public function setHeight(int $height): self
    {
        $this->height = $height;
        return $this;
    }
}
