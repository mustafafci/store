import Echo from 'laravel-echo';

import Pusher from 'pusher-js';
window.Pusher = Pusher;

Pusher.logToConsole = true;

window.Echo = new Echo({
  broadcaster: 'pusher',
  authEndpoint: `http://store.test/broadcasting/auth`,
  headers: {
    'X-CSRF-Token': '{{ csrf_token() }}'
  },
  key: import.meta.env.VITE_PUSHER_APP_KEY,
  cluster: import.meta.env.VITE_PUSHER_APP_CLUSTER,
  forceTLS: true
});

let channel = window.Echo.private(`notify.${userId}`);
channel.listen('.order-created', function (data) {
  console.log(data);
  alert(data.body);
  alert(JSON.stringify(data));
});