<?php
declare(strict_types=1);
/**
 * Created by Nguyen Van Thiep,
 * User: macosxvn
 * Date: 2019-08-18
 * Time: 16:13
 */

namespace Jetcoder\Instagram;

use DateTimeImmutable;
use Jetcoder\Instagram\Post\Caption;
use Jetcoder\Instagram\Post\Location;

abstract class Post
{
    const TYPE_IMAGE = 'image';
    const TYPE_VIDEO = 'video';
    /**
     * @var string
     */
    protected $id;
    /**
     * @var string
     */
    protected $link;

    /**
     * @var int
     */
    protected $likes;

    /**
     * @var int
     */
    protected $comments;

    /**
     * @var string
     */
    protected $type;

    /**
     * @var string
     */
    protected $filter;

    /**
     * @var DateTimeImmutable
     */
    protected $createdTime;

    /**
     * @var Caption|null
     */
    protected $caption = null;

    /**
     * @var null | Location
     */
    protected $location = null;

    public function __construct(array $data = [])
    {
        $this->id = $data['id'];
        $this->link = $data['link'];
        $this->type = $data['type'];
        $this->likes = $data['likes']['count'];
        $this->comments = $data['comments']['count'];
        $this->filter = $data['filter'];
        $this->createdTime = new DateTimeImmutable('@' . $data['created_time']);
        if ($data['caption']) {
            $this->caption = new Caption($data['caption']);
        }
        if ($data['location']) {
            $this->location = new Location($data['location']);
        }
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @param string $id
     * @return Post
     */
    public function setId(string $id): self
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getLink(): string
    {
        return $this->link;
    }

    /**
     * @param string $link
     * @return Post
     */
    public function setLink(string $link): self
    {
        $this->link = $link;
        return $this;
    }

    /**
     * @return int
     */
    public function getLikes(): int
    {
        return $this->likes;
    }

    /**
     * @param int $likes
     * @return Post
     */
    public function setLikes(int $likes): self
    {
        $this->likes = $likes;
        return $this;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param string $type
     * @return Post
     */
    public function setType(string $type): self
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @return string
     */
    public function getFilter(): string
    {
        return $this->filter;
    }

    /**
     * @param string $filter
     * @return Post
     */
    public function setFilter(string $filter): self
    {
        $this->filter = $filter;
        return $this;
    }
}
