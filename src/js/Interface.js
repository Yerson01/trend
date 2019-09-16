class Interface {
    constructor() {
        this.base_url = 'http://localhost/trend';
    }

    removeOrderFromDOM(id) {
        let deleteButtons = document.querySelectorAll('.delete-order');
        let price;
        const art = document.querySelector('.total-articles');
        deleteButtons.forEach(btn => {
            if (btn.getAttribute('data-id') == id) {
                price = Number(btn.parentElement.parentElement.parentElement.querySelector('.order-price').textContent);
                btn.parentElement.parentElement.parentElement.remove();
                if (art != null) {
                    //restar cantidad de articulos
                    let quantity = Number(document.querySelector('.total-articles').textContent) - 1;
                    if (quantity >= 0) {
                        document.querySelector('.total-articles').textContent = quantity;
                    }
                    //restar suma total
                    let prevTotal = Number(document.querySelector('.total-sum span').textContent);
                    let total = (prevTotal - price).toFixed(2);
                    if (total >= 0) {
                        document.querySelector('.total-sum span').textContent = total;
                    }
                    if (total == 0) {
                        document.querySelector('#pay-all').disabled = true;
                    }

                }
            }
        });
    }

    addProductToCart(product) {
        //crear contenedor
        const productContainer = document.createElement('li');
        productContainer.className = 'preview';
        productContainer.setAttribute('data-id', product.id);

        //crear imagen
        const contImg = document.createElement('a');
        contImg.setAttribute('href', `${this.base_url}/product/show&id=${product.productId}`);
        contImg.className = 'preview-img';

        const img = document.createElement('img');
        img.setAttribute('src', `${this.base_url}/src/img/products/${product.image}`);
        img.setAttribute('alt', product.name);

        contImg.appendChild(img);


        //crear info
        const infoContainer = document.createElement('div');
        infoContainer.className = 'preview-info';

        const title = document.createElement('p');
        title.className = 'order-title';
        title.textContent = product.name;

        const quantity = document.createElement('p');
        quantity.className = 'order-quantity';
        quantity.innerHTML = `<span>${product.quantity}</span> x`;

        infoContainer.appendChild(title);
        infoContainer.appendChild(quantity);

        //crear total 
        const totalCont = document.createElement('div');
        totalCont.className = 'order-total';
        
        const total = document.createElement('p');
        total.textContent = `$ ${product.total}`;

        totalCont.appendChild(total);

        //crear actions
        const actionsCont = document.createElement('div');
        actionsCont.className = 'preview-actions';

        const btnDelete = document.createElement('i');
        btnDelete.classList.add('far', 'fa-trash-alt', 'remove-preview');
        btnDelete.setAttribute('data-id', product.id);

        actionsCont.appendChild(btnDelete);

        //crear boton de mostrar todos
        const btnShowCont = document.createElement('div');
        btnShowCont.className = 'show-all-container';

        const iconCont = document.createElement('a');
        iconCont.setAttribute('href', `${this.base_url}/cart/index`);
        iconCont.classList.add('btn', 'bg-third', 'white', 'border-third', 'show-all');
        iconCont.innerHTML = '<span>Show All</span>';

        const icon = document.createElement('i');
        icon.classList.add('fas', 'fa-arrow-right');

        iconCont.appendChild(icon);
        btnShowCont.appendChild(iconCont);

        //agregar todo al contenedor
        productContainer.appendChild(contImg);
        productContainer.appendChild(infoContainer);
        productContainer.appendChild(totalCont);
        productContainer.appendChild(actionsCont);

        //agregarlo a dom
        const shoppingList = document.querySelector('.shopping-list-preview');
        if (shoppingList.children.length == 1) {
            shoppingList.appendChild(btnShowCont);
            document.querySelector('.empty-cart').remove();
        }
        if (shoppingList.children.length <= 4) {
            shoppingList.insertBefore(productContainer, shoppingList.children[0]);
        }
        
    }

    removeProductFromCart(id) {
        const shoppingList = document.querySelectorAll('.shopping-list-preview li');
        shoppingList.forEach(row => {
            if (row.getAttribute('data-id') == id) {
                row.remove();
                if (shoppingList.length == 1) {
                    const alert = document.createElement('li');
                    alert.classList.add('preview', 'empty-cart');
                    alert.textContent = 'The cart is empty';
                    const shoppingList = document.querySelector('.shopping-list-preview');
                    shoppingList.children[0].remove();
                    shoppingList.appendChild(alert);
                }
            }
        });
    }

    toggleCartIcon(toRemove, toAdd, element) {
        const icons = document.querySelectorAll('.toggle-icon');
        icons.forEach(icon => {
            if (icon.parentElement.getAttribute('data-id') == element.productId) {
                if (icon.classList.contains(toRemove)) {
                    icon.classList.remove(toRemove);
                    icon.classList.add(toAdd);
                    icon.setAttribute('order-id', element.id);
                }
            } else if (icon.getAttribute('order-id') == element) {
                if (icon.classList.contains(toRemove)) {
                    icon.classList.remove(toRemove);
                    icon.classList.add(toAdd);
                }
            }
        });
    }

    toggleCartButton(btn) {
        const wrap = btn.children[0];
        const icon = wrap.children[0];
        const textBtn = wrap.children[1];

        let orderId = true;
        if (icon.hasAttribute('order-id')) {
            icon.className = 'fas fa-shopping-cart';
            textBtn.textContent = ' Add To Cart';
            wrap.style.animation = 'drop 1s';
            icon.removeAttribute('order-id');
        } else {
            icon.className = 'far fa-times-circle';
            textBtn.textContent = ' Remove from cart';
            wrap.style.animation = 'up 1s';
            icon.setAttribute('order-id', orderId);
        }
    }

    slideNavbar(btn) {
        const menu = document.querySelector('.slide-menu');
        if (menu.classList.contains('nav-is-open')) {
            menu.classList.remove('nav-is-open');
            btn.classList.remove('times');
            btn.classList.add('bar');
            // btn.classList.remove('rotate-90');
            // btn.classList.add('fa-bars');
        } else {
            menu.classList.add('nav-is-open');
            
            btn.classList.remove('bar');
            btn.classList.add('times');
            // btn.classList.add('rotate-90');
            // btn.classList.remove('fa-bars');
            // btn.classList.add('fa-times');
        }
    }

    updateCounter(action) {
        const counter = document.querySelector('#products-number');
        const quantity = Number(counter.textContent);
        if (action == 'inc') {
            counter.textContent = quantity + 1;
        } else if (action == 'dec') {
            counter.textContent = quantity - 1;
        }
    }

    showAlert(message, type) {
        const alert = document.createElement('div');
        alert.classList.add('alert', 'float', type);
        alert.textContent = message;
        alert.classList.add('hidden');
        if (!document.querySelector(`alert.${type}`)) {
            document.querySelector('body').appendChild(alert);
        }

        setTimeout(() => {
            alert.classList.add('visible');

            setTimeout(() => {
                alert.classList.remove('visible');
                setTimeout(() => {
                    alert.remove();
                }, 500);
            }, 3000)
        }, 100)
    }

    toggleArrow(arrow) {
        const header = document.querySelector('header');
        const headerHeight = header.clientHeight;
        let toUp = false;
        if (headerHeight !== headerHeight - pageYOffset) toUp = true;
        arrow.style.transition = '.2s';

        if (toUp) {
            arrow.classList.add('arrow-to-up');
            arrow.setAttribute('href', '#home');
        } else {
            arrow.classList.remove('arrow-to-up');
            arrow.setAttribute('href', '#main');
        }
    }

    targetOnScroll() {
        let targets = document.querySelectorAll('.benefit');
        let counter = 0;
        targets.forEach(target => {
            let targetPosition = this.observeElement(target);
            let activeTarget = targetPosition < 0;
            counter++;
            if (activeTarget) {
                target.style.animation = `to-left ${counter}s`;
            } else {
                target.style.animation = 'none';
            }
        });
    }

    bannerOnScroll() {
        let banner = document.querySelector('.banner');
        let bannerText = banner.querySelector('.banner-text');

        let bannerPosition = this.observeElement(banner);
        let bannerTextPosition = this.observeElement(bannerText);
        let activeBanner = bannerPosition < 0;
        let activeText = bannerTextPosition < 0;

        if (activeBanner) {
            banner.style.animation = 'to-left 2s';
        } else {
            banner.style.animation = 'none';
        }

        if (activeText) {
            bannerText.style.animation = 'show 2s';
        } else {
            bannerText.style.animation = 'none';
        }
        // console.log(cord.bottom - cord.height )
        // console.log(((banner.top + pageYOffset) - pageYOffset));
        // console.log(active);
    }

    observeElement(element) {
        let elementProps = element.getBoundingClientRect();
        let elementPosition = ((pageYOffset - window.innerHeight) + elementProps.top) - pageYOffset;
        return elementPosition;
    }
}

export default Interface;