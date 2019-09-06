/*down-arrow hidden on scroll*/
const downArrow = document.querySelector('.down-arrow');
const header = document.querySelector('header');

window.addEventListener('scroll', () => {
    const headerHeight = header.clientHeight;
    let isHidden = false;
    if (headerHeight !== headerHeight - pageYOffset) isHidden = true;
    downArrow.style.transition = '.2s';

    if (isHidden) {
        downArrow.style.opacity = '0';
        downArrow.style.pointerEvents = 'none';
    } else {
        downArrow.style.opacity = '1';
        downArrow.style.pointerEvents = 'unset';
    }
});

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


/*delete elements at x seconds*/
let alert = document.querySelector('.alert');
setTimeout(() => {
    alert.style.display = 'none';
}, 4000);





