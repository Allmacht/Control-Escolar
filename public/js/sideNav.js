function openNav() {
    ocultar();
    document.getElementById("mySidenav").style.width = "320px";
    setTimeout(mostrar, 240);
}

function mostrar() {
    document.getElementById("btnLogout").style.visibility = "visible";
    document.getElementById("btnPerfil").style.visibility = "visible";
    document.getElementById("items").style.visibility = "visible";
    document.getElementById("item").style.transition = "500ms";
    document.getElementById("item1").style.transition = "500ms";
    document.getElementById("item2").style.transition = "500ms";
    document.getElementById("item3").style.transition = "500ms";
}

function closeNav() {
    ocultar();
    document.getElementById("mySidenav").style.width = "0";
}

function ocultar(){
    document.getElementById("btnLogout").style.visibility = "hidden";
    document.getElementById("btnPerfil").style.visibility = "hidden";
    document.getElementById("items").style.visibility = "hidden";
    document.getElementById("item").style.transition ="0s";
    document.getElementById("item1").style.transition = "0s";
    document.getElementById("item2").style.transition = "0s";
    document.getElementById("item3").style.transition = "0s";

}