<?php
namespace App\Repository;

use App\Entity\Car;
use App\Tools\StringTools;

class CarsRepository extends Repository
{
  public function getCars(int $limit = null):array
  {
    $sql = "SELECT id_car, km, main_image,  year, price, date, comment, brand, model, carburetion, CONCAT(brand, model, year) as title FROM Cars
    LEFT JOIN Brands ON Cars.id_brand = Brands.id_brand
    LEFT JOIN Models ON Cars.id_model = Models.id_model
    LEFT JOIN carburetion ON Cars.id_carburetion = carburetion.id_carburetion";

    if ($limit) {
      $sql .= " LIMIT :limit";
    }
    $query = $this->pdo->prepare($sql);
    if ($limit) {
      $query->bindValue(":limit", $limit, $this->pdo::PARAM_INT);
    }
    $query->execute();

    $response = $query->fetchAll($this->pdo::FETCH_ASSOC);

    $listCars = [];
    foreach ($response as $car) {
      $car = new Car($car['id_car'], $car['brand'], $car['model'], $car['carburetion'], $car['km'], $car['year'], $car['price'], $car['comment'], $car['date'], $car['main_image'], [], []);
      $listCars[] = $car;
  }
  return $listCars;
}
  public function showAllCars() {
    $listCars = self::getCars();
    foreach($listCars as $car) {
      
      require '../templates/annoncetest.php';
  }
}
  public function getCarsJson(int $limit = null):bool|string
  {
    $listCars = self::getCars($limit);
    $listCarsJSON = json_encode($listCars);
    return $listCarsJSON;
  }
  public function deleteCars(int $idCar):void 
  {
    
    $sql = "DELETE FROM `Cars` WHERE id_car = :idCar";
    $query = $this->pdo->prepare($sql);
    $query->bindValue(":idCar", $idCar, $this->pdo::PARAM_INT);
    $query->execute();
  }
  public function saveCar(int $brand, int $model, int $carburetion, int $km, string $mainImage, int $year, int $price, string $comment)
  {
    
    $sql = "INSERT INTO `Cars` (`id_car`, `id_brand`, `id_model`, `id_carburetion`, `km`, `main_image`,`year`, `price`, `date`, `comment`) VALUES (NULL, :idBrand, :idModel, :carburetion, :km, :mainImage, :year, :price, NOW(), :comment);";
    $query = $this->pdo->prepare($sql);
    $query->bindParam(':idBrand', $brand, $this->pdo::PARAM_INT);
    $query->bindParam(':idModel', $model, $this->pdo::PARAM_INT);
    $query->bindParam(':carburetion', $carburetion, $this->pdo::PARAM_INT);
    $query->bindParam(':km', $km, $this->pdo::PARAM_INT);
    $query->bindParam(':mainImage', $mainImage, $this->pdo::PARAM_STR);
    $query->bindParam(':year', $year, $this->pdo::PARAM_INT);
    $query->bindParam(':price', $price, $this->pdo::PARAM_INT);
    $query->bindParam(':comment', $comment, $this->pdo::PARAM_STR);
    return $query->execute();
  }
public function saveImage($file)
{
  $fileName = null;
    if(isset($file) && $file != '' ) {

      $checkImage = getimagesize($file['tmp_name']);
      if ($checkImage !== false) {
        $fileName = uniqid().'-'.StringTools::formatNameImage($file);
        move_uploaded_file($file['tmp_name'], './App/assets/images/uploads/'.$fileName);
        return $fileName;
      } 
}
}
function carsFilters($priceMin, $priceMax, $kmMin, $kmMax, $yearMin, $yearMax)
{
  
  $resultMessage = $this->pdo->prepare(
  "SELECT id_car, km, main_image,  year, price, date, comment, brand, model, carburetion, CONCAT(brand, model, year) as title FROM Cars
  LEFT JOIN Brands ON Cars.id_brand = Brands.id_brand
  LEFT JOIN Models ON Cars.id_model = Models.id_model
  LEFT JOIN carburetion ON Cars.id_carburetion = carburetion.id_carburetion
  WHERE 
  (price BETWEEN :priceMin AND :priceMax) 
  AND (km BETWEEN :kmmin AND :kmmax) 
  AND (year BETWEEN :yearMin AND :yearMax);"
  );
  $resultMessage->bindParam(':priceMin', $priceMin, $this->pdo::PARAM_INT);
  $resultMessage->bindParam(':priceMax', $priceMax, $this->pdo::PARAM_INT);
  $resultMessage->bindParam(':kmmin', $kmMin, $this->pdo::PARAM_INT);
  $resultMessage->bindParam(':kmmax', $kmMax, $this->pdo::PARAM_INT);
  $resultMessage->bindParam(':yearMin', $yearMin, $this->pdo::PARAM_INT);
  $resultMessage->bindParam(':yearMax', $yearMax, $this->pdo::PARAM_INT);
  $resultMessage->execute();
  $result = $resultMessage->fetchAll($this->pdo::FETCH_ASSOC);
  foreach($result as $car) {
    $car = new Car($car['id_car'], $car['brand'], $car['model'], $car['carburetion'], $car['km'], $car['year'], $car['price'], $car['comment'], $car['date'], $car['main_image'], [], []);
    require '../templates/annoncetest.php';
  }
}
public function getCarburetion(){
  
    $sql = "SELECT * FROM `carburetion` ORDER BY id_carburetion";
    $query = $this->pdo->prepare($sql);
    $query->execute();

    $response = $query->fetchAll($this->pdo::FETCH_ASSOC);

    $listCarburetion = [];
    foreach ($response as $carburetion) {
      $listCarburetion[] = [$carburetion["id_carburetion"], $carburetion["carburetion"]];
    };
    return $listCarburetion;
  }
}

