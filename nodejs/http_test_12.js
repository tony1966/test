var http=require('http')
var url=require('url')
var server=http.createServer(function(req, res) {
  res.writeHead(200, {'ContentType': 'text/plain'});
  switch (req.method) {
     case 'POST' :
          req.setEncoding('utf8');
          req.on('data', function(chunk) {
            console.log(chunk);
            });
          req.on('end', function() {
            console.log('Request ends');
            res.end();
            });
         break;
     case 'GET' :
     default :
         console.log(url.parse(req.url, true).query);
         res.end('Hello World!');
         break;
     }
  });
server.listen(8080, 'localhost');
console.log('HTTP 伺服器正在監聽 8080 埠 ...');