var http=require('http');
var options={
 hostname: 'localhost',
 port: 8080,
 path: '/',
 method: 'POST'
    }
var client=http.request(options, function(res) {
      console.log('Status code : ' + res.statusCode);
      res.setEncoding('utf8');
      res.on('data',function(chunk) {  //監視 data 事件 (收到 body)
      console.log('BODY:' + chunk);
      });
    });
client.on('error', function(e) {
    console.log('Errror : ' + e.message); 
    });
client.write('ABC\n');
client.end();