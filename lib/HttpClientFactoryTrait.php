<?php
namespace CrazyFactory\SpapiClient;

trait HttpClientFactoryTrait {
  private function createHttpClient($config)
  {
    $httpConfig = $this->config['http'] ?? [];
    $httpConfig = array_merge($httpConfig, $config);
    return new \GuzzleHttp\Client($httpConfig);
  }

}
