//import './bootstrap';
window.addEventListener('DOMContentLoaded', e => {
    document.querySelector('.one').style.animationName = 'fade-in-a';
})

window.addEventListener('scroll', e => {
    // console.log(parseInt(document.querySelector('.three').getBoundingClientRect()['top']), parseInt(innerHeight) + 200)
    if (pageYOffset > 30) {
        document.querySelector('header').style.top = (innerWidth < 600) ? '-50px' : '-45px';
    } else {
        document.querySelector('header').style.top = '0px';
    }
    // hecks whether the element is within the limits of the viewport or not
    let fade = (element, animationName) => {
        if (element.getBoundingClientRect()['top'] < innerHeight)
            element.style.animationName = animationName;
    };

    Array.from(document.querySelectorAll('.section:not(.one):not(.two)')).forEach(section => fade(section, 'fade-in-a'));
    Array.from(document.querySelectorAll('#section7 img')).forEach(image => fade(image, 'fade-in-a'));
    fade(document.querySelector('#section4'), 'fade-in-b');
    fade(document.querySelector('#section5'), 'fade-in-b');
})

// ............... NAVIGATION & CONTACT BUTTON EFFECTS .................

document.querySelector('nav button').addEventListener('mouseover', () => {
    document.querySelector('nav button span').style.animationName = 'buttonEffect'
})
document.querySelector('nav button').addEventListener('mouseout', () => {
    document.querySelector('nav button span').style.animationName = 'buttonEffectRemoval'
})

document.querySelector('.contact button').addEventListener('mouseover', () => {
    document.querySelector('.contact button span').style.animationName = 'buttonEffect'
})
document.querySelector('.contact button').addEventListener('mouseout', () => {
    document.querySelector('.contact button span').style.animationName = 'buttonEffectRemoval'
})

require('./bootstrap');
window.Vue = require('vue');
