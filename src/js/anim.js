

/*position fixed*/
const main = document.querySelector('main');
const elements = document.querySelectorAll('.position-fixed');

window.addEventListener('scroll', () => {
    if ((main.offsetTop - window.pageYOffset) < 0) {
        elements.forEach(element => {
            element.style.position = 'fixed';
        });
    } else {
        elements.forEach(element => {
            element.style.position = 'absolute';
        });
    }
});




/*show burguer menu*/
// const menu = document.querySelector('#burger-menu');
//
// menu.addEventListener('click', (e) => {
//     e.stopPropagation();
//
// });





