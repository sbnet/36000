<?php
namespace  Sbnet\FrontBundle\ApiAccess;

class ApiAccess
{
  private $url;
  private $restClient;

  public function __construct(\Circle\RestClientBundle\Services\RestClient $restClient, $url)
  {
    $this->url = $url;
    $this->restClient = $restClient;
  }

  public function search($q)
  {
    $cities = [];

    if (is_numeric($q)) {
      $r = $this->restClient->get($this->url."city/postal/$q");
      $cities = json_decode($r->getContent());
    } else {
      $r = $this->restClient->get($this->url."city/search/$q");
      $cities = json_decode($r->getContent());
    }

    return $cities;
  }
}
