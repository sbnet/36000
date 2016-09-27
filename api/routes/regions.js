var express = require('express');
var router = express.Router();
var db = require('../mysqlConfig.js');

/* GET regions listing. */
router.get('/', function(req, res, next) {
  var q = 'SELECT * FROM region';

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

/* Get a region by his ID */
router.get('/id/:id', function(req, res, next) {

  var sql = "SELECT * FROM ?? WHERE ??=?";
  var inserts = ['region', 'id', req.params.id];
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

/* Search for a region */
router.get('/search/:q', function(req, res, next) {

  var sql = "SELECT * FROM ?? WHERE search LIKE ?";
  var inserts = ['region', '%' + req.params.q.toUpperCase() + '%'];
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
  res.render('region-search', { title: 'Region search' });
});
module.exports = router;
