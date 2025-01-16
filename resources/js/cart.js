console.log('Cart.js is loaded!');

document.addEventListener('DOMContentLoaded', function() {
    console.log('DOM Content Loaded');
    
    // Get CSRF token from meta tag
    const csrfToken = document.querySelector('meta[name="csrf-token"]').content;
    console.log('CSRF Token:', csrfToken ? 'Found' : 'Not found');

    // Add click event listeners to all quantity update buttons
    const buttons = document.querySelectorAll('.btn-update-quantity');
    console.log('Found quantity buttons:', buttons.length);

    buttons.forEach(button => {
        button.addEventListener('click', function(e) {
            console.log('Button clicked!');
            console.log('Cart ID:', this.dataset.cartId);
            console.log('Action:', this.dataset.action);
            
            const cartId = this.dataset.cartId;
            const action = this.dataset.action;
            const quantityDisplay = this.parentElement.querySelector('.quantity-display');
            const currentQuantity = parseInt(quantityDisplay.textContent);

            console.log('Current quantity:', currentQuantity);

            // Determine new quantity based on action
            let newQuantity;
            if (action === 'increase') {
                newQuantity = currentQuantity + 1;
            } else if (action === 'decrease') {
                newQuantity = Math.max(1, currentQuantity - 1);
            }
            
            console.log('New quantity:', newQuantity);

            // Send update request to server
            updateCartQuantity(cartId, newQuantity, quantityDisplay);
        });
    });

    // Function to update cart quantity
    async function updateCartQuantity(cartId, newQuantity, displayElement) {
        try {
            console.log('Sending update request...');
            const response = await fetch(`/cart/update/${cartId}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json'
                },
                body: JSON.stringify({
                    quantity: newQuantity
                })
            });

            console.log('Response status:', response.status);

            if (!response.ok) {
                throw new Error('Network response was not ok');
            }

            const data = await response.json();
            console.log('Response data:', data);

            if (data.success) {
                // Update quantity display
                displayElement.textContent = newQuantity;
                
                // Update total price if it exists
                if (data.total) {
                    const totalElement = document.querySelector('[data-total-price]');
                    if (totalElement) {
                        totalElement.textContent = `$${parseFloat(data.total).toFixed(2)}`;
                    }
                }
            } else {
                alert('Failed to update quantity');
            }
        } catch (error) {
            console.error('Error:', error);
            alert('An error occurred while updating the cart');
        }
    }
});