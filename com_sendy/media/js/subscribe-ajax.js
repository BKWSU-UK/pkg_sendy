document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('sendy-subscribe-form');
    const messagesDiv = document.getElementById('subscription-messages');

    if (form) {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Clear previous messages
            messagesDiv.innerHTML = '';
            
            // Get form data
            const formData = new FormData(form);
            formData.append(Joomla.getOptions('csrf.token'), '1');

            // Send Ajax request
            fetch('index.php?option=com_sendy&task=subscribe.ajaxSubmit&format=json', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                const messageClass = data.success ? 'alert alert-success' : 'alert alert-danger';
                messagesDiv.innerHTML = `<div class="${messageClass}">${data.message}</div>`;
                
                if (data.success) {
                    form.reset();
                }
            })
            .catch(error => {
                messagesDiv.innerHTML = '<div class="alert alert-danger">An error occurred. Please try again.</div>';
            });
        });
    }
}); 