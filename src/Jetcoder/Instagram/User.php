<?php
declare(strict_types=1);
/**
 * Created by Nguyen Van Thiep,
 * User: macosxvn
 * Date: 2019-08-18
 * Time: 15:31
 */

namespace Jetcoder\Instagram;

class User
{
    /**
     * @var string
     */
    protected $id;

    /**
     * @var string
     */
    protected $username;

    /**
     * @var string
     */
    protected $fullName;

    /**
     * @var string
     */
    protected $profilePicture;

    /**
     * @var string
     */
    protected $bio;

    /**
     * @var string
     */
    protected $website;

    /**
     * @var bool
     */
    protected $isBusiness;

    /**
     * @var array
     */
    protected $counts = [];

    /**
     * User constructor.
     *
     * @param $data
     */
    public function __construct(array $data = [])
    {
        $this->id = $data['id'];
        $this->username = $data['username'];
        $this->fullName = $data['full_name'];
        $this->profilePicture = $data['profile_picture'] ?? '';
        $this->bio = $data['bio'] ?? '';
        $this->website = $data['website'] ?? '';
        $this->isBusiness = $data['is_business'];
        $this->counts = $data['counts'] ?? [];
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
     * @return User
     */
    public function setId(string $id): self
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * @param string $username
     * @return User
     */
    public function setUsername(string $username): self
    {
        $this->username = $username;
        return $this;
    }

    /**
     * @return string
     */
    public function getFullName(): string
    {
        return $this->fullName;
    }

    /**
     * @param string $fullName
     * @return User
     */
    public function setFullName(string $fullName): self
    {
        $this->fullName = $fullName;
        return $this;
    }

    /**
     * @return string
     */
    public function getProfilePicture(): string
    {
        return $this->profilePicture;
    }

    /**
     * @param string $profilePicture
     * @return User
     */
    public function setProfilePicture(string $profilePicture): self
    {
        $this->profilePicture = $profilePicture;
        return $this;
    }

    /**
     * @return string
     */
    public function getBio(): string
    {
        return $this->bio;
    }

    /**
     * @param string $bio
     * @return User
     */
    public function setBio(string $bio): self
    {
        $this->bio = $bio;
        return $this;
    }

    /**
     * @return string
     */
    public function getWebsite(): string
    {
        return $this->website;
    }

    /**
     * @param string $website
     * @return User
     */
    public function setWebsite(string $website): self
    {
        $this->website = $website;
        return $this;
    }

    /**
     * @return array
     */
    public function getCounts(): array
    {
        return $this->counts;
    }

    /**
     * @param string $field
     * @return string
     */
    public function getCountField(string $field): string
    {
        return $this->counts[$field] ?? '';
    }

    /**
     * @param array $counts
     * @return User
     */
    public function setCounts(array $counts): self
    {
        $this->counts = $counts;
        return $this;
    }

    /**
     * @return bool
     */
    public function isBusiness(): bool
    {
        return $this->isBusiness;
    }

    /**
     * @param bool $isBusiness
     * @return User
     */
    public function setIsBusiness(bool $isBusiness): self
    {
        $this->isBusiness = $isBusiness;
        return $this;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'username' => $this->username,
            'full_name' => $this->fullName,
            'profile_picture' => $this->profilePicture,
            'bio' => $this->bio,
            'website' => $this->website,
            'is_business' => (bool) $this->isBusiness,
            'counts' => $this->counts
        ];
    }
}
