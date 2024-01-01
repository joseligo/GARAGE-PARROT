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
  public function nbCars() {
    $resultMessage = $this->pdo->prepare("
      SELECT COUNT(*) as nbCars FROM Cars");
    // $resultMessage->bindParam(':validation', $validation, PDO::PARAM_INT);
    $resultMessage->execute();
    $nbCars = $resultMessage->fetch($this->pdo::FETCH_ASSOC);
    $data = json_encode($nbCars);
    echo $data;
  }
  public function getCars(int $limit = null, int $page = null)
  {
    $sql = "SELECT id_car, km, main_image,  year, price, date, comment, brand, model, carburetion, CONCAT(brand, model, year) as title FROM Cars
    LEFT JOIN Brands ON Cars.id_brand = Brands.id_brand
    LEFT JOIN Models ON Cars.id_model = Models.id_model
    LEFT JOIN carburetion ON Cars.id_carburetion = carburetion.id_carburetion";

    if ($limit && !$page) {
      $sql .= " LIMIT :limit";
    }
    if ($page) {
      $sql .= " LIMIT :offset, :limit";
    }
    $query = $this->pdo->prepare($sql);
    if ($limit) {
      $query->bindValue(":limit", $limit, $this->pdo::PARAM_INT);
    }
    if ($page) {
      $offset = ($page -1) * $limit;
      $query->bindValue(":offset", $offset, $this->pdo::PARAM_INT);
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
    $carApi->getCars($_GET['limit'], $_GET['page']);
  } elseif ($_GET['action'] === 'nbCars') {
    $carApi = new CarsApi();
    $carApi->nbCars();
  }
};