window.addEventListener("load", function(){


    var botonEnviar=document.getElementsByTagName("button")[0];
 
    var txtUser=document.getElementById("correo");
    var txtContraseña=document.getElementById("contrasena");

    botonEnviar.onclick=comprobarUsuario(txtUser,txtContraseña);

})

function comprobarUsuario(txtUser,txtContraseña){
    return function (ev){
        ev.preventDefault();
        var datos="user="+txtUser.value+"&clave="+txtContraseña.value;
       //AJAX
       var ajax=new XMLHttpRequest();

       ajax.onreadystatechange=function(){
           if(this.readyState==4 && this.status==200){
               var respuesta=JSON.parse(this.responseText);
            //    debugger;
               if(respuesta.success){
                   document.getElementById("identificacion").style.display="none";
                   var plantilla=traerPlantilla("plantillas/visitas.html");
                   //for(let i=0;i<respuesta.user.length;i++){
                        var copia=plantilla.cloneNode(true);
                        copia.children[0].children[0].innerHTML=respuesta.user;
                        copia.children[1].style.display="none";
                        copia.children[0].children[1].onclick=pulsado;
                        copia.children[0].children[1].onmouseover=punteroFlecha;
                        copia.children[0].children[1].onmouseout=punteroCursor;
                 
                        document.body.appendChild(copia);
                   //}
               }
               if(respuesta.error){
                  var mensajeError=document.getElementById("mensaje");
                mensajeError.innerHTML=respuesta.error;
                 
               }
            
           }

       }

       ajax.open("POST","./php/login.php");
       ajax.setRequestHeader("Content-type","application/x-www-form-urlencoded");
       ajax.send(datos);
    }

}

function traerPlantilla(url){
    var ajax=new XMLHttpRequest();
    ajax.open("GET",url,false);
    ajax.send();

    var TextoPlantilla=ajax.responseText;
    var div=document.createElement("div");
    div.innerHTML=TextoPlantilla;
    return div;

}

function pulsado(){
    var valor=this.innerHTML;
    if(valor==="+"){
        this.innerHTML="-";
        this.parentNode.nextElementSibling.style.display="block";
    }
    else{
        this.innerHTML="+";
        this.parentNode.nextElementSibling.style.display="none";
    }
}

function punteroFlecha(){
    this.style.cursor="Arrow";
}

function punteroCursor(){
    this.style.cursor="pointer";
}




   
