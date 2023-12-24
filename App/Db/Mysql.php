<?php

namespace App\Db;

class Mysql {

    private $db_name;
    private $db_user;
    private $db_password;
    private $db_port;
    private $db_host;
    private $pdo = null;
    private static $_instance = null;

    private function __construct() 
    {
      $conf = ['db_name' => 'joseligo_ecf_garage_parrot',
      'db_user' => 'joseligo',
      'db_password' => 'Cameli@7685',
      'db_port' => '3306',
      'db_host' => 'mysql-joseligo.alwaysdata.net'
    ];
      // if($_SERVER['PHP_SELF'] === '/App/Repository/CarsRepository.php') {
      //   $conf = require_once '../../config.php';
      // } else {$conf = require_once 'config.php';}
      if(isset($conf['db_name'])) {
        $this->db_name = $conf['db_name'];
      }
      if(isset($conf['db_user'])) {
        $this->db_user = $conf['db_user'];
      }
      if(isset($conf['db_password'])) {
        $this->db_password = $conf['db_password'];
      }
      if(isset($conf['db_port'])) {
        $this->db_port = $conf['db_port'];
      }
      if(isset($conf['db_host'])) {
        $this->db_host = $conf['db_host'];
      }
    }
    public static function getInstance():self
    {
      if(is_null(self::$_instance)) {
      self::$_instance = new Mysql();
      } 
      return self::$_instance;
    }

    public function getPDO():\PDO
    {
      
      if(is_null($this->pdo)){
        $this->pdo = new \PDO('mysql:dbname=' . $this->db_name . ';charset=utf8;host=' . $this->db_host.':'.$this->db_port, $this->db_user, $this->db_password);
    }
      return $this->pdo;
    }

}