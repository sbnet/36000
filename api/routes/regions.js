var express = require('express');
var router = express.Router();

var mysql = require('../mysqlConfig.js');

/* GET regions listing. */
router.get('/', function(req, res, next) {
  var q = 'SELECT * FROM region';

  mysql.connection.query(
    q,
    function select(error, results, fields) {
      if (error) {
        console.log(error);
        mysql.connection.end();
        return;
      }
      mysql.connection.end();

      res.setHeader('Content-Type', 'application/json');
      res.send(JSON.stringify(results));
    }
  );
});

/* GET regions listing. */
router.get(['/search', '/search/*'], function(req, res, next) {
  res.setHeader('Content-Type', 'application/json');
  res.send("region search");
});
module.exports = router;
