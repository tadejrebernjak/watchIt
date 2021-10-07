function openMenu() {
    var menu = document.getElementById("menu");

    menu.style.left = "0";
    menu.classList.add("open");
}

function closeMenu() {
    var menu = document.getElementById("menu");

    menu.style.left = "-500px";
    menu.classList.remove("open");
}