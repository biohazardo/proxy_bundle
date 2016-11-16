var express = require('express');
var app = express();

app.get('/', function (req, res) {
    res.send('Сделан вызов на корневой URL. Метод GET');
});

app.post('/resource', function (req, res) {
    res.send('Сделан вызов на URL какого-то ресурса. Метод POST');
});

app.put('/resource', function (req, res) {
    res.send('Сделан вызов на URL какого-то ресурса. Метод PUT');
});

app.delete('/resource', function (req, res) {
    res.send('Сделан вызов на URL какого-то ресурса. Метод DELETE');
});

app.listen(8888, function () {
    console.log('Remote server app listening on port 8888!')
});