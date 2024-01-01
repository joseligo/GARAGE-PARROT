<?php

namespace App\Api;

use App\Entity\Car;
use App\Repository\Repository;

include_once '../Repository/Repository.php';
include_once '../Db/Mysql.php';
include_once '../Entity/Car.php';

class CarsApi extends Repository
{

  function minMax()
  {
    $resultMessage = $this->pdo->prepare("
  SELECT MIN(km) as minKm, MAX(km)  as maxKm, 
  MIN(price) as minPrice, MAX(price) as maxPrice, 
  Min(year) as minYear, MAX(year) as maxYear FROM Cars");
    // $resultMessage->bindParam(':validation', $validation, PDO::PARAM_INT);
    $resultMessage->execute();
    $minMax = $resultMessage->fetch($this->pdo::FETCH_ASSOC);
    $data = json_encode($minMax);
    echo $data;
  }
  public function getCars(int $limit = null)
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
      $listCars[] = $car->jsonSerialize();
    }
    $listCarsJSON = json_encode($listCars);
    echo $listCarsJSON;
  }

  function carsFilters($priceMin, $priceMax, $kmMin, $kmMax, $yearMin, $yearMax)
  {
    $resultMessage =  $this->pdo->prepare(
      "SELECT id_car, km, main_image,  year, price, date, comment, brand, model, CONCAT(brand, model, year) as title FROM Cars
  LEFT JOIN Brands ON Cars.id_brand = Brands.id_brand
  LEFT JOIN Models ON Cars.id_model = Models.id_model
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
    echo $result;
    $data = json_encode($result);
    echo $data;
  }
  function carsHome($limit)
  {
    $resultMessage = $this->pdo->prepare(
      "
  SELECT main_image FROM Cars LIMIT :limit;"
    );
    $resultMessage->bindParam(':limit', $limit, $this->pdo::PARAM_INT);
    $resultMessage->execute();
    $result = $resultMessage->fetchAll($this->pdo::FETCH_ASSOC);
    $data = json_encode($result);
    echo $data;
  }
}

if (isset($_GET['action'])) {
  if ($_GET['action'] === 'minMax') {
    $carApi = new CarsApi();
    $carApi->minMax();
  } elseif ($_GET['action'] === 'filter') {
    $carApi = new CarsApi();
    $carApi->carsFilters($_POST['priceMin'], $_POST['priceMax'], $_POST['kmmin'], $_POST['kmmax'], $_POST['yearmin'], $_POST['yearmax']);
  } elseif ($_GET['action'] === 'showAllCars') {
    $carApi = new CarsApi();
    $carApi->getCars();
  }
};