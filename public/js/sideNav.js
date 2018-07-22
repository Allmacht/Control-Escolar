function openNav() {
    ocultar();
    document.getElementById("mySidenav").style.width = "320px";
    setTimeout(mostrar, 240);
}

function mostrar() {
    document.getElementById("btnLogout").style.visibility = "visible";
    document.getElementById("btnPerfil").style.visibility = "visible";
    document.getElementById("items").style.visibility = "visible";
}

function closeNav() {
    ocultar();
    document.getElementById("mySidenav").style.width = "0";
}

function ocultar(){
    document.getElementById("btnLogout").style.visibility = "hidden";
    document.getElementById("btnPerfil").style.visibility = "hidden";
    document.getElementById("items").style.visibility = "hidden";
}