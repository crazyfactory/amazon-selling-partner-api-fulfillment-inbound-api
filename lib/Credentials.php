<?php
namespace CrazyFactory\Spapi\Client;
use GuzzleHttp\Client;

class Credentials {

  use HttpClientFactoryTrait;

  private $config;
  private $tokenStorege;
  private $signer;

  public function __construct(TokenStorageInterface $tokenStorage, Signer $signer, array $config = [])
  {
    $this->config = $config;
    $this->tokenStorege = $tokenStorage;
    $this->signer = $signer;
  }

  public function getCredentials()
  {

      $lwaAccessToken = $this->getLWAToken();
      $stsCredentials = $this->getStsTokens();

      return [
        'lwa_access_token' => $lwaAccessToken,
        'sts_credentials' => $stsCredentials
      ];
  }

  private function getLWAToken()
  {

    $knownToken = $this->loadTokenFromStorage('lwa_access_token');
    if (!is_null($knownToken)) {
      return $knownToken;
    }

    $client = $this->createHttpClient([
      'base_uri' => 'https://api.amazon.com'
    ]);

    try {
      $requestOptions =  [
        'form_params' => [
          'grant_type' => 'refresh_token',
          'refresh_token' => $this->config['refresh_token'],
          'client_id' => $this->config['client_id'],
          'client_secret' => $this->config['client_secret']
        ]
      ];
      $response = $client->post('/auth/o2/token', $requestOptions);
    } catch (\Exception $e) {
      //log something
      throw $e;
    }
     $json = json_decode($response->getBody(), true);
     $this->tokenStorege->storeToken('lwa_access_token', [
       'token' => $json['access_token'],
       'expiresOn' => time() + ($this->config['access_token_longevity'] ?? 3600)
     ]);

     return $json['access_token'];

  }


  private function getStsTokens()
  {
    $knownToken = $this->loadTokenFromStorage('sts_credentials');
    if (!is_null($knownToken)) {
      return $knownToken;
    }

    $requestOptions = [
      'headers' => [
        'accept' => 'application/json'
      ],
      'form_params' => [
        'Action' => 'AssumeRole',
        'DurationSeconds' =>  $this->config['sts_session _longevity'] ?? 3600,
        'RoleArn' => $this->config['role_arn'],
        'RoleSessionName' => 'session1',
        'Version' => '2011-06-15',
      ]
    ];

    $host = 'sts.amazonaws.com';
    $uri = '/';

    $requestOptions = $this->signer->sign($requestOptions, [
      'service' => 'sts',
      'access_key' => $this->config['access_key'],
      'secret_key' => $this->config['secret_key'],
      'region' => 'us-east-1', //This should be hardcoded
      'host' => $host,
      'uri' => $uri,
      'payload' => \GuzzleHttp\Psr7\build_query($requestOptions['form_params']),
      'method' => 'POST',
    ]);

    $client = $this->createHttpClient([
      'base_uri' => 'https://' . $host
    ]);

    try {
      $response = $client->post($uri, $requestOptions);

      $json = json_decode($response->getBody(), true);
      $credentials = $json['AssumeRoleResponse']['AssumeRoleResult']['Credentials'] ?? null;
      $tokens = [
        'access_key' => $credentials['AccessKeyId'],
        'secret_key' => $credentials['SecretAccessKey'],
        'session_token' => $credentials['SessionToken']
      ];
      $this->tokenStorege->storeToken('sts_credentials', [
        'token' => $tokens,
        'expiresOn' => $credentials['Expiration']
      ]);

      return $tokens;

    } catch (\Exception $e) {
      //log something
      throw $e;
    }

  }

  private function loadTokenFromStorage($key)
  {
    $knownToken = $this->tokenStorege->getToken($key);
    if (!empty($knownToken)) {
      $expiresOn = $knownToken['expiresOn'];
      if ($expiresOn > time()) {
        return $knownToken['token'];
      }
    }
    return null;
  }
}
