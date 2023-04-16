import Echo from 'laravel-echo';
import IOClient from 'socket.io-client';

window.io = IOClient;
window.Echo = new Echo({
    broadcaster: 'socket.io',
    host: window.location.hostname + ':6001'
});

window.Echo.channel('messages').listen('MessageCreated', (e) => {
    appendMessage(e.message.from, e.message.from, e.message.body, 'out', 'sender-name');
    appendMessage(e.message.to, e.message.from, e.message.body, 'in');
});

const chats = document.querySelectorAll('.chat');
chats.forEach(function (item) {
    item.addEventListener('submit', function (e) {
        e.preventDefault();
        const form = this;
        const message = form.querySelector('.chat > label > .input-message').value;
        if (!message) {
            alert('Please white any message!');
            return;
        }
        const sender = form.dataset.sender;
        const receiver = form.dataset.receiver;
        form.querySelector('.chat > label > .input-message').value = '';
        postMessage(message, sender, receiver);
    });
});

function postMessage(message, from, to) {
   const formData = new FormData();
   formData.append('body', message);
   formData.append('from', from);
   formData.append('to', to);

    fetch('messages', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': window.csrfToken,
            'X-Requested-With': 'XMLHttpRequest',
        },
        body: formData,
    }).then(() => {});
}

function appendMessage(chatOwner, dataSender, messageBody, messageClass, messageSenderClass) {
    const parent = document.querySelector(`.chat[data-sender="${chatOwner}"]`);
    const newMessageSender = document.createElement('div');
    newMessageSender.classList.add(messageSenderClass)

    const newMessage = document.createElement('div');
    newMessage.classList.add('message-content', messageClass);

    const history = parent.querySelector('.history');
    history.appendChild(newMessageSender).textContent = dataSender;
    history.appendChild(newMessage).textContent = messageBody;
    history.scrollTo(0, history.scrollHeight);
}
