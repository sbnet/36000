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

  public function getBiggers($limit)
  {
    $r = $this->restClient->get($this->url."/city/biggers/$limit");
var_dump($r);    
    $cities = json_decode($r->getContent());
    return $cities;
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
    $city = $city[0];

    // Add dregres coordinates from radian
    $city->coordinates->lon = number_format(rad2deg($city->coordinates->x), 5, '.', '');
    $city->coordinates->lat = number_format(rad2deg($city->coordinates->y), 5, '.', '');

    // @TODO: check for errors, the API may return an error if not found
    return $city;
  }

  public function getRegions()
  {
    $r = $this->restClient->get($this->url."/region");
    $regions = json_decode($r->getContent());

    // @TODO: check for errors, the API may return an error if not found
    return $regions;
  }

  public function getCitiesByAreaId($id)
  {
    $r = $this->restClient->get($this->url."/city/area/$id");
    $cities = json_decode($r->getContent());

    // @TODO: check for errors, the API may return an error if not found
    return $cities;
  }

  public function getAreaById($id)
  {
    $r = $this->restClient->get($this->url."/area/id/$id");
    $area = json_decode($r->getContent());

    // @TODO: check for errors, the API may return an error if not found
    return $area[0];
  }

  public function getAreasByRegionId($region_id)
  {
    $r = $this->restClient->get($this->url."/area/regionid/$region_id");
    $regions = json_decode($r->getContent());

    // @TODO: check for errors, the API may return an error if not found
    return $regions;
  }

  public function getRegionById($id)
  {
    $r = $this->restClient->get($this->url."/region/id/$id");
    $region = json_decode($r->getContent());

    // @TODO: check for errors, the API may return an error if not found
    return $region[0];
  }
}
