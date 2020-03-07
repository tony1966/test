var http=require('http')
http.createServer(function(req, res) {
  console.log("req.url=" + req.url + "\r\n");
  console.log("req.method=" + req.method + "\r\n");
  console.log("req.httpVersio=" + req.httpVersion + "\r\n");
  console.log("req.complete=" + req.complete + "\r\n");
  console.log("req.headers=" + JSON.stringify(req.headers) + "\r\n");  
  console.log("req.trailers=" + JSON.stringify(req.trailers) + "\r\n");
  console.log("req.connection=" + req.connection + "\r\n");
  console.log("req.socket=" + req.socket + "\r\n");
  console.log("req.client=" + req.client + "\r\n");
  res.write('Hello World!\n');
  res.end();
  }).listen(8080);
console.log('HTTP 伺服器正在監聽 8080 埠 ... \r\n');