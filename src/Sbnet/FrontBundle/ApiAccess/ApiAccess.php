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
      $r = $this->restClient->get($this->url."/city/postal/$q");
      $cities = json_decode($r->getContent());
    } else {
      $r = $this->restClient->get($this->url."/city/search/$q");
      $cities = json_decode($r->getContent());
    }

    return $cities;
  }

  public function getById($id)
  {
    $r = $this->restClient->get($this->url."/city/id/$id?full");
    $city = json_decode($r->getContent());

    // @TODO: check for errors, the API may return an error if not found
    return $city[0];
  }
}
