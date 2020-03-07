var http=require('http');
var path=require('path');
var fs=require('fs');
http.createServer(function(req, res) {
  var filename=path.basename(req.url);
  var filepath=path.join(__dirname, 'public', (filename || 'index.htm'));
  console.log(__dirname);
  console.log(filename);
  console.log(filepath);
  fs.exists(filepath, function(exists) {
    if (exists) {
      fs.readFile(filepath, function(err, data) {
        if (!err) {
          res.writeHead(200, {'ContentType': 'text/html'});
          res.end(data);
          }
        else {console.log(err);}
        });
      }
    else {
      res.writeHead(404, {'ContentType': 'text/plain'});
      res.end('Not Found');
      }
    });
  }).listen(8080, 'localhost');
console.log('HTTP 伺服器正在監聽 8080 埠 ...\n');