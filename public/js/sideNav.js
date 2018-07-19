function openNav() {
    document.getElementById("mySidenav").style.width = "320px";

    setTimeout(mostrar, 200);
}

function mostrar() {
    document.getElementById("btnLogout").style.visibility = "visible";
    document.getElementById("btnPerfil").style.visibility = "visible";
    document.getElementById("items").style.visibility = "visible";
}

function closeNav() {
    document.getElementById("mySidenav").style.width = "0";
    document.getElementById("btnLogout").style.visibility = "hidden";
    document.getElementById("btnPerfil").style.visibility = "hidden";
    document.getElementById("items").style.visibility = "hidden";
}