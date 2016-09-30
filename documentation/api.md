# API Documentation

## Overview
This API rely on [Node.js](https://nodejs.org) and [Express](https://expressjs.com). I have done it jut to be more familiar with node and express. I tried to use the best pratices as much as possible.

You are really welcome if you want to improve, point some mistakes or anything else, just go to the [Github repository](https://github.com/sbnet/36000) and participate.

## List of functions

  * [Region access](#regions)
    * [Get all regions](#getRegions)
    * [Get a region by his ID](#getRegionById)
    * [Search for a region by his name](#searchRegion)    
  * [Area access](#areas)
    * [Get all areas](#)
    * [Get a area by his ID](#)
    * [Search for a area by his name](#)
  * [City access](#)

## Regions

### getRegions

Type: GET

URL: /regions

Parameters: none

Description: Get all the regions

### getRegionById

Type: GET

URL: /regions/id/:id

Parameters:

|name |Type    |Description             |
|-----|--------|------------------------|
|id   |Integer |The id of region to get |


Description: Get all the regions

### searchRegion

Type: GET

URL: /region/search/:q

Parameters:

|name |Type    |Description             |
|-----|--------|------------------------|
|q    |string  |The name of the region to search |

Description: Search for a region by its name.
