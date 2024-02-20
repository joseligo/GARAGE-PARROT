<?php

namespace App\Entity;

class Car implements \JsonSerializable
{
  protected int $idCar;
  protected string $brand;
  protected string $model;
  protected string $carburetion;
  protected int $milage;
  protected int $yearOfManufacture;
  protected float $price;
  protected string $comment;
  protected string $announcementDate;
  protected string $mainImage;
  protected array $secondaryImage;
  protected array $options;

  public function __construct(int $idCar, string $brand,string $model, string $carburetion, int $milage, int $yearOfManufacture, float $price, string $comment, string $announcementDate, string $mainImage, array $secondaryImage, array $options)
  {
    $this->idCar = $idCar;
    $this->brand = $brand;
    $this->model = $model;
    $this->carburetion = $carburetion;
    $this->milage = $milage;
    $this->yearOfManufacture = $yearOfManufacture;
    $this->price = $price;
    $this->comment = $comment;
    $this->announcementDate = $announcementDate;
    $this->mainImage = $mainImage;
    $this->secondaryImage = $secondaryImage;
    $this->options = $options;
  }
  public function getTitle():string
  {
    $title = $this->brand." ".$this->model." - ".$this->yearOfManufacture;
    return $title;
  }

  /**
   * Get the value of comment
   */
  public function getComment(): string
  {
    return $this->comment;
  }

  /**
   * Get the value of announcementDate
   */
  public function getAnnouncementDate(): string
  {
    $date= new \DateTime($this->announcementDate);
    $dateFormated = $date->format('d/m/y');
    return $dateFormated;
  }

  /**
   * Get the value of mainImage
   */
  public function getMainImage(): string
  {
    return $this->mainImage;
  }

  /**
   * Get the value of model
   */
  public function getModel(): string
  {
    return $this->model;
  }

  /**
   * Get the value of brand
   */
  public function getBrand(): string
  {
    return $this->brand;
  }

  /**
   * Get the value of idCar
   */
  public function getIdCar(): int
  {
    return $this->idCar;
  }
  /**
   * Get the value of carburetion
   */
  public function getCarburetion(): string
  {
    return $this->carburetion;
  }
  /**
   * Set the value of carburetion
   */
  public function setCarburetion(string $carburetion): self
  {
    $this->carburetion = $carburetion;

    return $this;
  }
  public function jsonSerialize()
    {
        return [
            'idCar' => $this->getIdCar(),
            'brand' => $this->getBrand(),
            'model' => $this->getModel(),
            'carburetion' =>$this->getCarburetion(),
            'yearOfManufacture' => $this->getYearOfManufacture(),
            'milage' => $this->getMilage(),
            'price' => $this->getPrice(),
            'mainImage' => $this->getMainImage(),
            'title' => $this->getTitle(),
            'comment' => $this->getComment(),
            'dateAnnonce' => $this->getAnnouncementDate()
        ];
    }


  /**
   * Get the value of milage
   */
  public function getMilage(): int
  {
    return $this->milage;
  }

  /**
   * Set the value of milage
   */
  public function setMilage(int $milage): self
  {
    $this->milage = $milage;

    return $this;
  }

  /**
   * Get the value of yearOfManufacture
   */
  public function getYearOfManufacture(): int
  {
    return $this->yearOfManufacture;
  }

  /**
   * Set the value of yearOfManufacture
   */
  public function setYearOfManufacture(int $yearOfManufacture): self
  {
    $this->yearOfManufacture = $yearOfManufacture;

    return $this;
  }

  /**
   * Get the value of price
   */
  public function getPrice(): float
  {
    return $this->price;
  }

  /**
   * Set the value of price
   */
  public function setPrice(float $price): self
  {
    $this->price = $price;

    return $this;
  }

  /**
   * Get the value of secondaryImage
   */
  public function getSecondaryImage(): array
  {
    return $this->secondaryImage;
  }

  /**
   * Set the value of secondaryImage
   */
  public function setSecondaryImage(array $secondaryImage): self
  {
    $this->secondaryImage = $secondaryImage;

    return $this;
  }
}
