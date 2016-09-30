# API Documentation

## Overview
This API rely on [Node.js](https://nodejs.org) and [Express](https://expressjs.com). I have done it jut to be more familiar with node and express. I tried to use the best pratices as much as possible.

You are really welcome if you want to improve, point some mistakes or anything else, just go to the [Github repository](https://github.com/sbnet/36000) and participate.

## List of functions

  * [Region access](./api-region.md)
    * Get all regions
    * Get a region by his ID
    * Search for a region by his name
  * [Area access](./api-area.md)
    * Get all areas
    * Get a area by his ID
    * Search for a area by his name
  * [City access](./api-city.md)
    * findOneByInsee
    * findByPostalCode
    * findByName
    * findOneByGeoPoint
    * findNearInsee
    * findNearGeoPoint
    * findNearPostalCode

## Tests
This api is tested with [Mocha](https://mochajs.org/) and [Chai](http://chaijs.com/) You need to have it installed before running the tests.

```
npm install -g mocha
```
