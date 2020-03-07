var http=require('http')
var server=http.createServer(function(req, res) {
  res.writeHead(200, {'ContentType': 'text/html'});
  res.write('<!DOCTYPE html>');
  res.write('<head>\n');
  res.write('<title>Hello</title>\n');
  res.write('</head>\n');
  res.write('<body>\n');
  res.write('<b>Hello World!</b>\n');
  res.write('</body>\n');
  res.write('</html>');
  res.end();
  });
server.listen(8080);
console.log('HTTP 伺服器正在監聽 8080 埠 ...');