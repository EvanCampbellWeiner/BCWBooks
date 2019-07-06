<?php
//Library includes file used to store connection information in a more efficient manner
function connectdb(){

  $config = parse_ini_file('pwd/config.ini');

  $host = 'localhost';
  $db = 'abradshaw';
  $charset = 'utf8mb4';
  $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
  $options = [
      PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
      PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
      PDO::ATTR_EMULATE_PREPARES   => false,
  ];

  try {
       $pdo = new PDO($dsn, $config['username'], $config['password'], $options);
  } catch (\PDOException $e) {
       throw new \PDOException($e->getMessage(), (int)$e->getCode());
  }

  return $pdo;
}

?>
