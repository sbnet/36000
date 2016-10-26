var express = require('express');
var router = express.Router();
var db = require('../mysqlConfig.js');

/* Get by his ID */
router.get('/id/:id', function(req, res, next) {
  var sql = "SELECT * FROM ?? WHERE ??=?";
  var inserts = ['city', 'id', req.params.id];
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

/* Get by his ID */
router.get('/postal/:id', function(req, res, next) {

  // If full data is required
  if (typeof req.query.full !== 'undefined') {
    var sql = "SELECT c.*, ";
        sql += "a.id AS area_id, a.name AS area_name, a.formal_name AS area_formal_name, a.code AS area_code, a.surface AS area_surface, a.density AS area_density, a.population AS area_population, ";
        sql += "r.id AS region_id, r.cheflieu_id, r.country_id, r.name AS region_name, r.formal_name AS region_formal_name, r.code AS region_code, r.emblem_url AS region_emblem, ";
        sql += "co.id AS country_id, co.name AS country_name, co.formal_name AS country_formal_name, co.iso_code2 AS country_iso_code_2, co.iso_code3 AS country_iso_code_3 ";
        sql +="FROM city c ";
        sql +="INNER JOIN area a ON c.area_id = a.id ";
        sql +="INNER JOIN region r ON a.region_id = r.id ";
        sql +="INNER JOIN country co ON r.country_id = co.id ";
        sql +="WHERE c.post_code=?";
  } else {
    // Only the city record
    var sql = "SELECT * FROM `city` WHERE `post_code`=?";
  }

  var inserts = [req.params.id];
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

/* Get by his INSEE */
/* TODO: Should improve the concat as it can't be indexed !*/
router.get('/insee/:insee', function(req, res, next) {
  var sql = "SELECT * FROM ?? WHERE CONCAT(??, ??) = ?";
  var inserts = ['city', 'department_code', 'city_code', req.params.insee];
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

/* Search for city */
router.get('/search/:q', function(req, res, next) {
  var sql = "SELECT * FROM ?? WHERE ?? LIKE ?";
  var inserts = ['city', 'search', '%' + req.params.q.toUpperCase() + '%'];
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

/*
  Search by postal code for cities near another one

  It need the following stored function that calculate the distance between two points
  This is an aproximation, it is not accurate if the 2 points are near the poles as the calculation is not mapped on a sphere
  but on a straight line

  CREATE FUNCTION `distance`(`a` POINT, `b` POINT) RETURNS DOUBLE DETERMINISTIC return round(glength(linestringfromwkb(linestring(asbinary(a), asbinary(b)))))

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
