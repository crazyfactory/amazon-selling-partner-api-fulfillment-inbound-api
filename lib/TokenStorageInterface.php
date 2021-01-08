<?php
namespace CrazyFactory\SpapiClient;

interface TokenStorageInterface {
  public function getToken($key): ?array;
  public function storeToken($key, $value);
}
