<?php

namespace App\Entity;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\NewsletterRepository")
 */
class Newsletter
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="text")
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="text", type="text")
     */
    private $text;

    /**
     * @var int
     *
     * @ORM\Column(type="integer", nullable=true)
     */
    public $success;

    /**
     * @var int
     *
     * @ORM\Column(type="integer", nullable=true)
     */
    private $fail;

    /**
     * @var int
     *
     * @ORM\Column(type="integer", nullable=true)
     */
    private $pending;

    /**
     * @var int
     *
     * @ORM\Column(type="integer", nullable=true)
     */
    private $overall;

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle(string $title): self
    {
        $this->title = $title;
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
     */
    public function setText(string $text): self
    {
        $this->text = $text;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getSuccess(): ?int
    {
        return $this->success;
    }

    /**
     * @param int $success
     */
    public function setSuccess(int $success): self
    {
        $this->success = $success;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getFail(): ?int
    {
        return $this->fail;
    }

    /**
     * @param int $fail
     */
    public function setFail(int $fail): self
    {
        $this->fail = $fail;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getPending(): ?int
    {
        return $this->pending;
    }

    /**
     * @param int $pending
     */
    public function setPending(int $pending): self
    {
        $this->pending = $pending;
        return $this;
    }

    /**
     * @return int
     */
    public function getOverall(): int
    {
        return $this->overall;
    }

    /**
     * @param int $overall
     */
    public function setOverall(int $overall): self
    {
        $this->overall = $overall;
        return $this;
    }

}
