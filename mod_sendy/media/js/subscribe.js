document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('sendy-subscribe-form');
    const messagesDiv = document.getElementById('subscription-messages');

    if (form) {
        form.addEventListener('submit', function(e) {
            e.preventDefault();

            const formData = new FormData(form);
            formData.append(Joomla.getOptions('csrf.token'), '1');

            // Send Ajax request
            fetch('?option=com_sendy&task=subscribe.ajaxSubmit&format=json', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.messages && Array.isArray(data.messages) && data.messages.length > 0) {
                    const messageHtml = data.messages.map(messageObj => {
                        const alertClass = messageObj.type === 'error' ? 'alert-danger bg-[#BA665E]' : 'alert-success';
                        return `<div class="alert ${alertClass} rounded-[6px] text-white text-17px p-2">${messageObj.message}</div>`;
                    }).join('');
                    messagesDiv.innerHTML = messageHtml;
                } else {
                    messagesDiv.innerHTML = `<div class="${data.success ? 'alert alert-success rounded-[6px] mb-4' : 'alert alert-danger bg-[#BA665E] rounded-[6px] text-white text-17px p-2'}">${data.message}</div>`;
                }
                
                if (data.success) {
                    form.reset();
                    form.style.display = 'none';
                    const thankYouMessage = `
                        <div class="text-center p-4">
                            <h3 class="text-xl mb-2">Thank You for Subscribing!</h3>
                            <p>You should receive an email shortly with a confirmation link.</p>
                        </div>`;
                    messagesDiv.insertAdjacentHTML('afterend', thankYouMessage);
                }
            })
            .catch(error => {
                messagesDiv.innerHTML = '<div class="alert alert-danger bg-[#BA665E] rounded-[6px] text-white text-17px p-2">An error occurred. Please try again.</div>';
            });
        });
    }
}); 