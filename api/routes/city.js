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
  var sql = "SELECT * FROM ?? WHERE ??=?";
  var inserts = ['city', 'post_code', req.params.id];
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

router.get('/search', function(req, res, next) {
  res.render('areas-search', { title: 'Areas search' });
});
module.exports = router;
