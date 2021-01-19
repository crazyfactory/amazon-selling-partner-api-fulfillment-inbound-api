<?php
namespace CrazyFactory\SpapiClient;

trait HttpClientFactoryTrait {
  private function createHttpClient($config)
  {
    $debug = $this->config->getDebug() ?? false;
    $httpConfig = array_merge(['debug' => $debug], $config);
    return new \GuzzleHttp\Client($httpConfig);
  }

}
