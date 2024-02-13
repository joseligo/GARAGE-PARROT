<?php

namespace App\Entity;

class Service
{
  protected int $id;
  protected string $title;
  protected string $comment;
  protected string $picture;
  protected string $author;

  public function __construct(int $id, string $title, string $comment, string $picture, string $author)
  {
    $this->id = $id;
    $this->title = $title;
    $this->comment = $comment;
    $this->picture = $picture;
    $this->author = $author;
  }
  /**
   * Get the value of id
   */
  public function getId(): int
  {
    return $this->id;
  }

  /**
   * Get the value of title
   */
  public function getTitle(): string
  {
    return $this->title;
  }
  public function getTitleUpperCase(): string
  {
    return mb_strtoupper($this->title);
  }

  /**
   * Get the value of comment
   */
  public function getComment(): string
  {
    return $this->comment;
  }

  /**
   * Get the value of picture
   */
  public function getPicture(): string
  {
    return $this->picture;
  }

  /**
   * Get the value of author
   */
  public function getAuthor(): string
  {
    return $this->author;
  }
}