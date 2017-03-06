var express = require('express');
var router = express.Router();
var city = require('../models/city.js');
var config = require('../config.js');
var api = require('../api.js');

/* Get by his ID */
router.get('/id/:id', function(req, res, next) {
    res.setHeader('Content-Type', 'application/json');

    // If full data is required
    if (typeof req.query.full !== 'undefined') {
        city.getByIdFull(req.params.id, function(error, result) {
            if(error){
                res.send(JSON.stringify(error));
            }
            result = api.parseId('city', result);
            res.send(JSON.stringify(result));
        });
    } else {
        city.getById(req.params.id, function(error, result) {
            if(error){
                res.send(JSON.stringify(error));
            }
            result = api.parseId('city', result);
            res.send(JSON.stringify(result));
        });
    }
});

/* Get by his post code */
router.get('/postal/:id', function(req, res, next) {
    res.setHeader('Content-Type', 'application/json');

    // If full data is required
    if (typeof req.query.full !== 'undefined') {
        city.getByPostalFull(req.params.id, function(error, result) {
            if(error){
                res.send(JSON.stringify(error));
            }
            result = api.parseId('city', result);
            res.send(JSON.stringify(result));
        });
    } else {
        city.getByPostal(req.params.id, function(error, result) {
            if(error){
                res.send(JSON.stringify(error));
            }
            result = api.parseId('city', result);
            res.send(JSON.stringify(result));
        });
    }

});

/* Get by his INSEE code */
router.get('/insee/:insee', function(req, res, next) {
    res.setHeader('Content-Type', 'application/json');
    city.getByInsee(req.params.insee, function(error, result) {
        if(error){
            res.send(JSON.stringify(error));
        }
        result = api.parseId('city', result);
        res.send(JSON.stringify(result));
    });
});

/* Get by his area_id */
router.get('/area/:id', function(req, res, next) {
    res.setHeader('Content-Type', 'application/json');
    city.getByArea(req.params.id, function(error, result) {
        if(error){
            res.send(JSON.stringify(error));
        }
        result = api.parseId('city', result);
        res.send(JSON.stringify(result));
    });
});

/* Search for city */
router.get('/search/:q', function(req, res, next) {
    res.setHeader('Content-Type', 'application/json');
    city.search(req.params.q, function(error, result) {
        if(error){
            res.send(JSON.stringify(error));
        }
        result = api.parseId('city', result);
        res.send(JSON.stringify(result));
    });
});

/*
  Search by postal code for cities near another one

  It need the following stored function that calculate the distance between two points
  This is an aproximation, it is not accurate if the 2 points are near the poles as the calculation is not mapped on a sphere
  but on a straight line

  Use this kind of query to get the cities
  SELECT DISTINCT glength(LineStringFromWKB(LineString(GeomFromText(astext(PointFromWKB(orig.coordinates))),GeomFromText(astext(PointFromWKB(dest.coordinates))))))*100 AS sdistance
  FROM city orig, city dest
  WHERE orig.post_code = '84470' having sdistance < 50
  ORDER BY sdistance limit 10

  This one seems to fail with mysql 5.5
  SELECT DISTINCT dest.post_code, 11100*distance(orig.coordinates, dest.coordinates) as sdistance
    FROM city orig, city dest
    WHERE orig.post_code = '84470'
    having sdistance < 50
    ORDER BY sdistance limit 10
*/
router.get('/near/:postcode', function(req, res, next) {
  var sql =  "SELECT DISTINCT dest.*, 11100*glength(LineStringFromWKB(LineString(GeomFromText(astext(PointFromWKB(orig.coordinates))),GeomFromText(astext(PointFromWKB(dest.coordinates)))))) as sdistance ";
      sql += "FROM city orig, city dest ";
      sql += "WHERE orig.post_code = ? ";
      sql += "having sdistance < ? ";
      sql += "ORDER BY sdistance LIMIT 10";

  var distance = req.query.distance || 50;
  var limit = req.query.limit || 10;
  var inserts = [req.params.postcode, distance, limit];
  sql = db.mysql.format(sql, inserts);

  db.connection.query(
    sql,
    function select(error, results, fields) {
      if(error){
        db.connection.end();
        return;
      }

      res.setHeader('Content-Type', 'application/json');
      res.send(JSON.stringify(results));
    }
  );
});

router.get('/search', function(req, res, next) {
  res.render('areas-search', { title: 'Areas search' });
});

module.exports = router;
