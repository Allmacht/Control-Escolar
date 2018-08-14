function openNav() {
    ocultar();
    document.getElementById("mySidenav").style.width = "320px";
    setTimeout(mostrar, 240);
}

function mostrar() {
    document.getElementById("btnLogout").style.visibility = "visible";
    document.getElementById("btnPerfil").style.visibility = "visible";
    document.getElementById("items").style.visibility = "visible";
    if(document.getElementById("item")){
        document.getElementById("item").style.transition = "500ms";
    }
    if (document.getElementById("item1")) {
        document.getElementById("item1").style.transition = "500ms";
    }
    if (document.getElementById("item2")) {
        document.getElementById("item2").style.transition = "500ms";
    }
    if (document.getElementById("item3")) {
        document.getElementById("item3").style.transition = "500ms";
    }
    if (document.getElementById("item4")) {
        document.getElementById("item4").style.transition = "500ms";
    }    
}
   

function closeNav() {
    ocultar();
    document.getElementById("mySidenav").style.width = "0";
}

function ocultar(){
    document.getElementById("btnLogout").style.visibility = "hidden";
    document.getElementById("btnPerfil").style.visibility = "hidden";
    document.getElementById("items").style.visibility = "hidden";
    
    if(document.getElementById("item")){
        document.getElementById("item").style.transition = "0s";
    }
    if(document.getElementById("item1")){
        document.getElementById("item1").style.transition = "0s";
    }
    if(document.getElementById("item2")){
        document.getElementById("item2").style.transition = "0s";
    }
    if(document.getElementById("item3")){
        document.getElementById("item3").style.transition = "0s";
    }
    if(document.getElementById("item4")){
        document.getElementById("item4").style.transition = "0s";
    }

}