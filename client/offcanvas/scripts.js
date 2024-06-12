function changeQuantity(button, amount) {
    let quantityElement = button.parentElement.querySelector('.quantity');
    let quantity = parseInt(quantityElement.textContent) + amount;
    if (quantity < 1) {
        quantity = 1;
    }
    quantityElement.textContent = quantity;

    updateTotal();
}

function updateTotal() {
    let total = 0;
    let cartItems = document.querySelectorAll('.cart-item');
    cartItems.forEach(item => {
        let price = parseFloat(item.getAttribute('data-price')); // Parse as float instead of integer
        let quantity = parseInt(item.querySelector('.quantity').textContent);
        total += price * quantity;
    });
    document.getElementById('total-price').textContent = total.toFixed(2); // Ensure two decimal places
}

document.addEventListener('DOMContentLoaded', (event) => {
    updateTotal(); // Ensure the total is correct on page load
});
