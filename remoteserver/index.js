var express = require('express');
var app = express();

var bodyParser = require('body-parser')
app.use(bodyParser.urlencoded({ extended: false }))
app.use(bodyParser.json())

app.get('/', function (req, res) {
    res.send('Сделан вызов на корневой URL. Метод GET');
});

app.post('/resource', function (req, res) {
    res.send('Сделан вызов на URL какого-то ресурса. Метод ' + req.method + '. Переданы параметры: ' + JSON.stringify(req.body));
});

app.put('/resource', function (req, res) {
    res.send('Сделан вызов на URL какого-то ресурса. Метод ' + req.method + '. Переданы параметры: ' + JSON.stringify(req.body));
});

app.delete('/resource', function (req, res) {
    res.send('Сделан вызов на URL какого-то ресурса. Метод ' + req.method + '. Переданы параметры: ' + JSON.stringify(req.body));
});

app.get('/xyz/:int', function (req, res) {
    res.send('Сделан вызов на URL XYZ. Метод GET. Передан числовой параметр: ' + req.params.int);
});

app.listen(8888, function () {
    console.log('Remote server app listening on port 8888!')
});