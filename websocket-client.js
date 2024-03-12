const WebSocket = require('ws');

const serverUrl = 'ws://192.168.1.14:8080';

const socket = new WebSocket(serverUrl);

socket.on('open', () => {
  console.log('WebSocket connection opened.');
});

socket.on('message', (data) => {
  console.log(`Received from server: ${data}`);
  // Handle incoming messages from the server
});

socket.on('close', () => {
  console.log('WebSocket connection closed.');
  // Handle the connection being closed, and you may want to attempt to reconnect.
});
