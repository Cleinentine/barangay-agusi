let hamburger_menu = document.getElementById('hamburger_menu')
    hamburger_menu.addEventListener('click', toggle_hamburger_menu)

function toggle_hamburger_menu() {
    document.querySelector('.first-bar').classList.toggle('rotate-first-bar')
    document.querySelector('.nav').classList.toggle('drop-nav')
    document.querySelector('.second-bar').classList.toggle('hide-second-bar')
    document.querySelector('.third-bar').classList.toggle('rotate-third-bar')
    document.querySelector('.hamburger-menu').classList.toggle('adjust-hamburger-menu')
}
