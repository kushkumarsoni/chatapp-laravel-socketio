const express = require('express');
const { message } = require('laravel-mix/src/Log');
const app = express();
const server = require('http').createServer(app);

const io = require('socket.io')(server,{
    cors: {origin: "*" }
});

io.on('connection', (socket) => {
    console.log('someone connected!');

    socket.on('sendChatToServer',(message) => {
        console.log(message);
        io.sockets.emit('sendChatToClient',message);
        // socket.broadcast.emit('sendChatToClient',message);
    });

    socket.on('disconnect',(socket) => {
        console.log("Disconnected");
    });
  });

server.listen(3000,() => {
    console.log("Server is running..");
})
