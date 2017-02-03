/**
 * Model for city table
 *
 * @author Stéphane BRUN - stephane@sbnet.fr
 * @see https://www.terlici.com/2015/08/13/mysql-node-express.html
 */
var db = require('../mysqlConfig.js')

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
