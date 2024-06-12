function changeQuantity(button, amount) {
    let quantityElement = button.parentElement.querySelector('.quantity');
    let me = button.parentElement.querySelector('#new_quantity_input');

    let quantity = parseInt(quantityElement.textContent) + amount;
    if (quantity < 1) {
        quantity = 1;
    }
    quantityElement.textContent = quantity;
    me.value = quantity;

    updateTotal();
}

function updateTotal() {
    let total = 0;
    let cartItems = document.querySelectorAll('.cart-item');
    cartItems.forEach(item => {
        let price = parseFloat(item.getAttribute('data-price'));
        let quantity = parseInt(item.querySelector('.quantity').textContent);
        total += price * quantity;
        
    });
    document.getElementById('total-price').textContent = total;
    // No need to update the hidden input field 'new_quantity' here
}

document.addEventListener('DOMContentLoaded', (event) => {
    updateTotal(); // Ensure the total is correct on page load
});
