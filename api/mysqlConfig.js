var mysql = require('mysql');

//http://www.developper-jeux-video.com/acces-mysql-nodejs/
// Connect to mysql
var connection = mysql.createConnection({
  user: "root",
  password: "",
  host: "localhost",
  database: "36000"
});

module.exports = {
  connection
};
