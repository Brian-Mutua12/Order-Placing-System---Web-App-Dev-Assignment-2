// Get DOM Elements
const modal = document.querySelector('#my-modal');
const modalBtn1 = document.querySelector('#menu-item-1');
const modalBtn2 = document.querySelector('#menu-item-2');
const modalBtn3 = document.querySelector('#menu-item-3');
const modalBtn4 = document.querySelector('#menu-item-4');
const closeBtn = document.querySelector('.close');
const foodType = document.querySelector('.food-type');
const addBtn = document.querySelector('#add');
const subtractBtn = document.querySelector('#subtract');

// Events
modalBtn1.addEventListener('click', openModal);
modalBtn2.addEventListener('click', openModal);
modalBtn3.addEventListener('click', openModal);
modalBtn4.addEventListener('click', openModal);
closeBtn.addEventListener('click', closeModal);
window.addEventListener('click', outsideClick);
addBtn.addEventListener('click', addQuantity);
subtractBtn.addEventListener('click', subtractQuantity);

// Open
function openModal(e) {
    if (e.target.id === 'menu-item-1') {
        foodType.innerHTML = 'How many donuts?'
    } else if (e.target.id === 'menu-item-2') {
        foodType.innerHTML = 'How many plates of chapo beans?'
    } else if (e.target.id === 'menu-item-3') {
        foodType.innerHTML = 'How many plates of pilau meat?'
    } else {
        foodType.innerHTML = 'How many cups of tea?'
    }
    modal.style.display = 'block';
}

// Close
function closeModal() {
    modal.style.display = 'none';
}

// Close If Outside Click
function outsideClick(e) {
    if (e.target == modal) {
        modal.style.display = 'none';
    }
}

function addQuantity() {
    document.querySelector('#count-input').value++;
}

function subtractQuantity() {
    document.querySelector('#count-input').value--;
}