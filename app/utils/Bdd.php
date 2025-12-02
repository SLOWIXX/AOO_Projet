<?php
abstract class Bdd
{
 protected $co = null;

 protected function __construct()
 {
  if ($this->co == null) {
   $this->connect();
  }
 }

 private function connect(): void
 {
  $this->co = new PDO(
   'mysql:host=' . $_ENV['host'] . ';dbname=' . $_ENV['dbname'],
   $_ENV['username'],
   $_ENV['password']
  );
 }
}
