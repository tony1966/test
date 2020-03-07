var http=require('http')
var server=http.createServer(function(req, res) {
  res.setHeader('ContentType', 'text/plain');
  res.statusCode=200;
  res.write('Hello World!\n');
  res.end();
  });
server.listen(8080);
console.log('HTTP 伺服器正在監聽 8080 埠 ...');