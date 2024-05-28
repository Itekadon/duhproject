document.addEventListener('DOMContentLoaded', function() {
    const messageForm = document.getElementById('messageForm');
    const messagesContainer = document.getElementById('messagesContainer');

    // Function to fetch and display messages
    function fetchMessages() {
        fetch('fetch_messages.php')
            .then(response => response.json())
            .then(messages => {
                messagesContainer.innerHTML = '';
                messages.forEach(message => {
                    const messageDiv = document.createElement('div');
                    messageDiv.className = 'message';
                    messageDiv.innerHTML = `
                        <p><strong>${message.username}</strong> <em>${new Date(message.timestamp).toLocaleString()}</em></p>
                        <p>${message.message}</p>
                    `;
                    messagesContainer.appendChild(messageDiv);
                });
            })
            .catch(error => console.error('Error fetching messages:', error));
    }

    // Fetch messages on page load
    fetchMessages();

    // Handle message form submission
    messageForm.addEventListener('submit', function(event) {
        event.preventDefault();
        const formData = new FormData(messageForm);
        
        fetch('post_message.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.text())
        .then(result => {
            console.log(result);
            messageForm.reset();
            fetchMessages();
        })
        .catch(error => console.error('Error posting message:', error));
    });

    // Poll for new messages every 10 seconds
    setInterval(fetchMessages, 10000);
});
