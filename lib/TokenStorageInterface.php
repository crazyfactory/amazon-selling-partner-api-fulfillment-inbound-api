<?php
namespace CrazyFactory\Spapi;

interface TokenStorageInterface {
  public function getToken($key): ?array;
  public function storeToken($key, $value);
}
