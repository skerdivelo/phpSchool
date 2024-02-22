var mysql = require("mysql");

var con = mysql.createConnection({
    host: "localhost",
    port: "3306",
    user: "root",
    password: "Sk3dinho",
    database: "ecommerce",
});

con.connect(function (err) {
    if (err) throw err;
    console.log("Connesso al database!");

    con.query("SELECT * FROM prodotti", function (err, result, fields) {
        if (err) throw err;
        console.log(result);
    });
});
