/**
 * Model for city table
 *
 * @author Stéphane BRUN - stephane@sbnet.fr
 * @see https://www.terlici.com/2015/08/13/mysql-node-express.html
 */
var db = require('../mysqlConfig.js')

exports.getBiggers = function(limit, done) {
    var sql = 'SELECT * FROM city ORDER BY population DESC LIMIT ' + limit;

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
    var sql = db.mysql.format('SELECT * FROM city WHERE id=?', id);

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

exports.getByIdFull = function(id, done) {
    var sql = "SELECT c.*, ";
        sql += "a.id AS area_id, a.name AS area_name, a.formal_name AS area_formal_name, a.code AS area_code, a.surface AS area_surface, a.density AS area_density, a.population AS area_population, ";
        sql += "r.id AS region_id, r.cheflieu_id, r.country_id, r.name AS region_name, r.formal_name AS region_formal_name, r.code AS region_code, r.emblem_url AS region_emblem, ";
        sql += "co.id AS country_id, co.name AS country_name, co.formal_name AS country_formal_name, co.iso_code2 AS country_iso_code_2, co.iso_code3 AS country_iso_code_3 ";
        sql +="FROM city c ";
        sql +="INNER JOIN area a ON c.area_id = a.id ";
        sql +="INNER JOIN region r ON a.region_id = r.id ";
        sql +="INNER JOIN country co ON r.country_id = co.id ";
        sql +="WHERE c.id=?";

    sql = db.mysql.format(sql, id);
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

exports.getByPostal = function(id, done) {
    var sql = "SELECT * FROM city WHERE post_code=?";
    sql = db.mysql.format(sql, id);

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

exports.getByPostalFull = function(id, done) {
    var sql = "SELECT c.*, ";
        sql += "a.id AS area_id, a.name AS area_name, a.formal_name AS area_formal_name, a.code AS area_code, a.surface AS area_surface, a.density AS area_density, a.population AS area_population, ";
        sql += "r.id AS region_id, r.cheflieu_id, r.country_id, r.name AS region_name, r.formal_name AS region_formal_name, r.code AS region_code, r.emblem_url AS region_emblem, ";
        sql += "co.id AS country_id, co.name AS country_name, co.formal_name AS country_formal_name, co.iso_code2 AS country_iso_code_2, co.iso_code3 AS country_iso_code_3 ";
        sql +="FROM city c ";
        sql +="INNER JOIN area a ON c.area_id = a.id ";
        sql +="INNER JOIN region r ON a.region_id = r.id ";
        sql +="INNER JOIN country co ON r.country_id = co.id ";
        sql +="WHERE c.post_code=?";

    sql = db.mysql.format(sql, id);
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

/* TODO: Should improve the concat as it can't be indexed !*/
exports.getByInsee = function(insee, done) {
    var sql = "SELECT * FROM city WHERE CONCAT(department_code, city_code) = ?";
    sql = db.mysql.format(sql, insee);

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

exports.getByArea = function(id, done) {
    var sql = "SELECT * FROM city WHERE area_id = ? ORDER BY name";
    sql = db.mysql.format(sql, id);

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
    var sql = "SELECT * FROM city WHERE search LIKE ? ORDER BY `post_code`";
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
exports.near = function(postcode, distance, limit, done) {
    var sql =  "SELECT DISTINCT dest.*, 11100*glength(LineStringFromWKB(LineString(GeomFromText(astext(PointFromWKB(orig.coordinates))),GeomFromText(astext(PointFromWKB(dest.coordinates)))))) as sdistance ";
        sql += "FROM city orig, city dest ";
        sql += "WHERE orig.post_code = ? ";
        sql += "having sdistance < ? ";
        sql += "ORDER BY sdistance LIMIT 10";

    var inserts = [postcode, distance, limit];
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
