<?php
declare(strict_types=1);
/**
 * Created by Nguyen Van Thiep,
 * User: macosxvn
 * Date: 2019-08-18
 * Time: 21:37
 */

namespace Jetcoder\Instagram\Post;

class Caption
{
    /**
     * @var string
     */
    protected $id;

    /**
     * @var string
     */
    protected $text;

    /**
     * @var \DateTimeImmutable
     */
    protected $createdTime;

    public function __construct(array $data)
    {
        $this->id = $data['id'];
        $this->text = $data['text'];
        $this->createdTime = new \DateTimeImmutable('@' . $data['created_time']);
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
     * @return Caption
     */
    public function setId(string $id): self
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getText(): string
    {
        return $this->text;
    }

    /**
     * @param string $text
     * @return Caption
     */
    public function setText(string $text): self
    {
        $this->text = $text;
        return $this;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getCreatedTime(): \DateTimeImmutable
    {
        return $this->createdTime;
    }

    /**
     * @param \DateTimeImmutable $createdTime
     * @return Caption
     */
    public function setCreatedTime(\DateTimeImmutable $createdTime): self
    {
        $this->createdTime = $createdTime;
        return $this;
    }
}
