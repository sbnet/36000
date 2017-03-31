/**
 * Model for region table
 *
 * @author Stéphane BRUN - stephane@sbnet.fr
 * @see https://www.terlici.com/2015/08/13/mysql-node-express.html
 */
var db = require('../mysqlConfig.js')

exports.getAll = function(done) {
    var sql = 'SELECT * FROM region ORDER BY name DESC';

    db.connection.query(
        sql,
        function select(error, results, fields) {
            if(error) {
                db.connection.end();
                return done(error);
            }
            done(null, results);
        }
    );
}

exports.getById = function(id, done) {
    var sql = db.mysql.format('SELECT * FROM region WHERE id=?', id);

    db.connection.query(
        sql,
        function select(error, results, fields) {
            if(error) {
                db.connection.end();
                return done(error);
            }
            done(null, results);
        }
    );
}

exports.search = function(q, done) {
    var sql = 'SELECT * FROM region WHERE search LIKE ?';
    var input = parseSearchInput(q);
    var inserts = ['%' + input + '%'];
    sql = db.mysql.format(sql, inserts);

    db.connection.query(
        sql,
        function select(error, results, fields) {
            if(error) {
                db.connection.end();
                return done(error);
            }
            done(null, results);
        }
    );
}

/**
 * Parse the imput, keep only alpha-numeric chars and make the string uppercase
 *
 * @param {string} The imput string to parse
 * @return {string} The parsed string
 */
function parseSearchInput(input) {
  var parsed = input
                .replace(/[^A-Z0-9]+/ig, '')
                .toUpperCase();

  return parsed;
}
