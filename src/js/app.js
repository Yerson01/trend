import Cart from './Cart';
import Interface from "./Interface";

//add to cart
const addButtons = document.querySelectorAll('.add-to-cart');

if (addButtons !== null) {
    addButtons.forEach(addBtn => {
        addBtn.addEventListener('click', e => {
            e.preventDefault();
            const quantityInput = document.querySelector('#quantity');
            let quantity = 1;

            if (quantityInput) {
                quantity = Number(quantityInput.value);
            }
            // Agregar el producto al carrito
            if (quantity >= 1) {
               const productId = addBtn.getAttribute('data-id');
                //enviarlo al controlador
                const cart = new Cart(productId, quantity);
                cart.insertDB();
            }
        });
    });
}

//delete from cart
const orderList = document.querySelectorAll('.shopping-list');
if (orderList !== null) {
    orderList.forEach(list => {
        list.addEventListener('click', e => {
            e.preventDefault();
            if (e.target.classList.contains('delete-order')) {
                const orderId = e.target.getAttribute('data-id');
                const newCart = new Cart();
                newCart.deleteFromDB(orderId, false);
            }
        });
    });
}

//delete from shoppinglist preview
const shoppingPreview = document.querySelector('.shopping-list-preview');
if (shoppingPreview !== null) {
    shoppingPreview.addEventListener('click', e => {
        if (e.target.classList.contains('remove-preview')) {
             const cart = new Cart();
             cart.deleteFromDB(e.target.getAttribute('data-id'));
        }
     });
}



//ANIMATIONS
const ui = new Interface();

//toggle add-cart button
const productActions = document.querySelector('.product-actions');
if (productActions != null) {
    productActions.addEventListener('click', e => {
        if (e.target.classList.contains('add-to-cart')) {
            ui.toggleCartButton(e.target);
        }
    });
}

//toggle slide navbar
const burguer = document.querySelector('.toggle-navbar');
burguer.addEventListener('click', e => {
    ui.slideNavbar(e.target);
});


/*down-arrow hidden on scroll*/
const downArrow = document.querySelector('.down-arrow');
if (downArrow !== null) {
    document.addEventListener('DOMContentLoaded', () => {
        ui.toggleArrow(downArrow);
    });

    window.addEventListener('scroll', () => {
        ui.toggleArrow(downArrow);
    });
}

/*footer always down*/
const footer = document.querySelector('footer');
window.addEventListener('DOMContentLoaded', footerDown);
window.addEventListener('resize', footerDown);

function footerDown() {
    const body = document.querySelector('body');
    body.style.marginBottom = `${footer.clientHeight+70}px`;
}



/*Banner on scroll animations*/
window.addEventListener('scroll', () => {
    ui.bannerOnScroll();
});
document.addEventListener('DOMContentLoaded', () => {
    ui.bannerOnScroll();
});


/*Targets on scroll animations*/
window.addEventListener('scroll', () => {
    ui.targetOnScroll();
});
document.addEventListener('DOMContentLoaded', () => {
    ui.targetOnScroll();
});



// const payBtn = document.querySelector('#pay-all');
// payBtn.addEventListener('click', e => {
//
// });



