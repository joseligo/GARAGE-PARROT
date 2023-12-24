<?php

namespace App\Entity;

class Car 
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
    return $this->announcementDate;
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
}
