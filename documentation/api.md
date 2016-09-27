# API Documentation

## Overview
This API rely on [Node.js](https://nodejs.org) and [Express](https://expressjs.com). I have done it jut to be more familiar with node and express. I tried to use the best pratices as much as possible.

You are really welcome if you want to improve, point some mistakes or anything else, just go to the [Github repository](https://github.com/sbnet/36000) and participate.

## List of functions

  * [Region access](regions)
    * [Get all regions](regions all)
    * [Get a region by his ID](region by id)
    * [Search for a region by his name](regions by name)

  * [Area access](areas)
    * [Get all areas](areas all)
    * [Get a area by his ID](area by id)
    * [Search for a area by his name](areas by name)

  * [City access](city)

[regions]: regions
## Regions

[regions all]: regions
### getRegions
GET : /regions

Get all the regions

[region by id]: regions
### getRegionById
GET : /regions/id/:id

[regions by name]: regions
### searchRegion
GET : /region/search/:q
