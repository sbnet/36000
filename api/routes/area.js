var express = require('express');
var router = express.Router();
var db = require('../mysqlConfig.js');

/* GET full listing */
router.get('/', function(req, res, next) {
  var q = 'SELECT * FROM area';

  db.connection.query(
    q,
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
router.get('/id/:id', function(req, res, next) {
  var sql = "SELECT * FROM ?? WHERE ??=?";
  var inserts = ['area', 'id', req.params.id];
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

/* Get by his region_id */
router.get('/regionid/:id', function(req, res, next) {
  var sql = "SELECT * FROM area WHERE region_id=?";
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


/* Get by his code */
router.get('/code/:id', function(req, res, next) {
  var sql = "SELECT * FROM ?? WHERE ??=?";
  var inserts = ['area', 'code', req.params.id];
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

/* Search for an area */
router.get('/search/:q', function(req, res, next) {
  var sql = "SELECT * FROM ?? WHERE ?? LIKE ?";
  var inserts = ['area', 'search', '%' + req.params.q.toUpperCase() + '%'];
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
