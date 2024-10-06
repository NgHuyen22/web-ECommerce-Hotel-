const minusBtn = document.querySelector('.minus-btn');
const plusBtn = document.querySelector('.plus-btn');
const quantityInput = document.getElementById('quantity');

minusBtn.addEventListener('click', () => {
    if (quantityInput.value > 1) {
        quantityInput.value--;
    }
});

plusBtn.addEventListener('click', () => {
    quantityInput.value++;
});
