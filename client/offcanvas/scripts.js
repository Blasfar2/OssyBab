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
        let price = parseInt(item.getAttribute('data-price'));
        let quantity = parseInt(item.querySelector('.quantity').textContent);
        total += price * quantity;
    });
    document.getElementById('total-price').textContent = total;
}

document.addEventListener('DOMContentLoaded', (event) => {
    updateTotal(); // Ensure the total is correct on page load
});

