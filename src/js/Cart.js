import Interface from './Interface';

class Cart {
    constructor(productId, quantity) {
        this.productId = productId;
        this.quantity = quantity;
        this.baseUrl = 'http://localhost/trend';
    }

    insertDB() {
        //llamado a ajax
        const xhr = new XMLHttpRequest();
        let self = this;
        //abrir la conexion
        xhr.open('POST', `${this.baseUrl}/cart/add`, true);
        xhr.onload = function () {
            if (xhr.status == 200) {
                const response = self.extractJSON(xhr.responseText);
                let message;
                let  type;
                const newInterface = new Interface();

                Object.keys(response).forEach((key) => {
                    switch (key) {
                        case 'success':
                            message = response[key];
                            type = key;
                            newInterface.toggleCartIcon('fa-shopping-cart', 'fa-check-circle', response['data']);
                            newInterface.updateCounter('inc');
                            // newInterface.addProductToCart(response['data'].id);
                            self.getFromDB(response['data'].id);
                            break;
                        case 'error':
                            message = response[key];
                            type = key;
                            break;
                        case 'warning':
                            message = response[key];
                            type = key;
                            break;
                        case 'delete':
                            self.deleteFromDB(response[key]);
                            break;
                    }
                });

                newInterface.showAlert(message, type);
            }
        }

        //crear formdata
        const productInfo = new FormData();
        productInfo.append('id', this.productId);
        productInfo.append('quantity', this.quantity);

        //enviar
        xhr.send(productInfo);
    }

    deleteFromDB(id, showAlert = true) {
        const xhr = new XMLHttpRequest();
        let self = this;
        xhr.open('POST', `${this.baseUrl}/cart/delete`, true);

        xhr.onload = function() {
            if (xhr.status == 200) {
                const response = self.extractJSON(xhr.responseText);
                let message;
                let  type;
                const newInterface = new Interface();

                Object.keys(response).forEach((key) => {
                    switch (key) {
                        case 'error':
                            message = response[key];
                            type = key;
                            break;
                        case 'info':
                            message = response[key];
                            type = key;
                            newInterface.removeOrderFromDOM(id);
                            showAlert ? newInterface.toggleCartIcon('fa-check-circle', 'fa-shopping-cart', response['id']) : '';
                            newInterface.updateCounter('dec');
                            newInterface.removeProductFromCart(response['id']);
                            break;
                    }
                });

                showAlert ? newInterface.showAlert(message, type) : '';
            }
        }

        const cart = new FormData();
        cart.append('id', id);

        xhr.send(cart);

    }

    getFromDB(id) {
        const xhr = new XMLHttpRequest();
        let self = this;
        xhr.open('POST', `${this.baseUrl}/cart/showOne`, true);
        xhr.onload = function() {
            if (xhr.status == 200) {
                const response = self.extractJSON(xhr.response);
                const ui = new Interface();
                ui.addProductToCart(response.data);
            }
        }
        const product = new FormData();
        product.append('id', id);
        xhr.send(product);

    }

    extractJSON(response) {
        let start = response.indexOf('{\"json_start');
        let end = (response.indexOf('json_end\":true') + 'json_end\":true}'.length);
        const jsonResponse = JSON.parse(response.substring(start, end));
        return jsonResponse;
    }
}

export default Cart;