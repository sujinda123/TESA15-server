var app = require('express')();
var http = require('http').createServer(app);
var io = require('socket.io')(http);

app.get('/', (req, res) => {
  res.sendFile(__dirname + '/index.html');
});

io.sockets.on('connection', function (socket) 
{
  socket.on('msgUpdate_total_month', (msg) => {
    io.emit('msgUpdate_total_month', msg);
  });
  socket.on('msgUpdate_total_day', (msg) => {
    io.emit('msgUpdate_total_day', msg);
  });
  socket.on('msgUpdate_total_good', (msg) => {
    io.emit('msgUpdate_total_good', msg);
  });
  socket.on('msgUpdate_total_bad', (msg) => {
    io.emit('msgUpdate_total_bad', msg);
  });

  socket.on('msgUpdate_good_lemon', (msg) => {
    io.emit('msgUpdate_good_lemon', msg);
  });
  socket.on('msgUpdate_bad_lemon', (msg) => {
    io.emit('msgUpdate_bad_lemon', msg);
  });
  socket.on('msgUpdate_small_lemon', (msg) => {
    io.emit('msgUpdate_small_lemon', msg);
  });
  socket.on('msgUpdate_medium_lemon', (msg) => {
    io.emit('msgUpdate_medium_lemon', msg);
  });
  socket.on('msgUpdate_big_lemon', (msg) => {
    io.emit('msgUpdate_big_lemon', msg);
  });
  socket.on('msgUpdate_updated_at', (msg) => {
    io.emit('msgUpdate_updated_at', msg);
  });
});

http.listen(3001, () => {
  console.log('listening on *:3000');
});
