window.addEventListener("load", function(){


    
    var botonEnviar=document.getElementsByTagName("button")[0];
 
    var txtUser=document.getElementById("correo");
    var txtContraseña=document.getElementById("contrasena");

    botonEnviar.onclick=comprobarUsuario(txtUser,txtContraseña);


    CompruebaLogueado();

    
})

function ocultaEmpresa(){
    return function (ev){
        ev.preventDefault();


        var span=this;
        var empresa=span.parentElement.parentElement.parentElement;
        if(this.innerHTML==" + "){
            this.innerHTML=" - ";
            var acuerdo=empresa.getElementsByClassName("acuerdo");
            for (let i=0;i<acuerdo.length;i++){
                acuerdo[i].style.display="block";
            }
        }else{
            this.innerHTML=" + ";
            var acuerdo=empresa.getElementsByClassName("acuerdo");
            for (let i=0;i<acuerdo.length;i++){
                acuerdo[i].style.display="none";
            }
        }

    }
}

function cerrarUsuario(){
    return function (ev){
        ev.preventDefault();

        var ajax=new XMLHttpRequest();
        ajax.onreadystatechange=function(){
            if(this.readyState==4 && this.status==200){
                var respuesta=JSON.parse(this.responseText);
 
                if(respuesta.success){
                    
                    var botonCierraSesion=document.getElementById("logout");
                    var padre=botonCierraSesion.parentNode;
                    padre.removeChild(botonCierraSesion);
                    var divEmpresas=padre.getElementsByClassName("empresa");
                    var numEmpresas=divEmpresas.length;
                    for (let i=0;i<numEmpresas;i++){
                        padre.removeChild(divEmpresas[0]);
                    }
                    var divInicioSesion=document.getElementById("identificacion");
                    divInicioSesion.style.display="block";
                    var inputCorreo=divInicioSesion.children[4];
                    var inputContraseña=divInicioSesion.children[8];
                    inputCorreo.value="";
                    inputContraseña.value="";
                 }
                  
                }
         
            }
            ajax.open("GET","./api/logout.php");
            ajax.send();
} 
}

function comprobarUsuario(txtUser,txtContraseña){
    return function (ev){
        ev.preventDefault();
        var datos="user="+txtUser.value+"&clave="+txtContraseña.value;
       //AJAX
       var ajax=new XMLHttpRequest();

       ajax.onreadystatechange=function(){
           if(this.readyState==4 && this.status==200){
               var respuesta=JSON.parse(this.responseText);
            //    objetoS =respuesta;
            //    debugger;
         

               if(respuesta.success){

                     procesaDatos(respuesta);
                     
                    //  var ocultar=document.getElementById("oculto");
                    //  // ocultar.setAttribute('id', 'oculto');
                    //  ocultar.innerHTML=" + ";
                    //  var aaa= document.getElementsByClassName("cabEmpresa")[0];
                    //  var ocultarEmpresa= document.getElementsByClassName("empresa")[0];
                    //  ocultarEmpresa.children[1].style.display ='none';
                    //  aaa.appendChild(ocultar);
                    //  ocultar.onclick=ocultaEmpresa;
                     
                }
                
                if(respuesta.error){
                    var mensajeError=document.getElementById("mensaje");
                  mensajeError.innerHTML=respuesta.error;
                   
                 }
               }

               
            
           }
           ajax.open("POST","./api/login.php");
           ajax.setRequestHeader("Content-type","application/x-www-form-urlencoded");
           ajax.send(datos);
       }

}

function CompruebaLogueado(){
  var ajax=new XMLHttpRequest();
       ajax.onreadystatechange=function(){
           if(this.readyState==4 && this.status==200){
               var respuesta=JSON.parse(this.responseText);

               if(respuesta.success){
                   
                     procesaDatos(respuesta);

                    //  var ocultar=document.getElementById("oculto");
                    //  // ocultar.setAttribute('id', 'oculto');
                    //  ocultar.innerHTML=" + ";
                    //  var aaa= document.getElementsByClassName("cabEmpresa")[0];
                    //  var ocultarEmpresa= document.getElementsByClassName("empresa")[0];
                    //  ocultarEmpresa.children[1].style.display ='none';
                    //  aaa.appendChild(ocultar);
                    //  ocultar.onclick=ocultaEmpresa;
                }

                 
               }
        
           }
           ajax.open("GET","./api/SesionPHPInit.php");
           ajax.send();
}


 function procesaDatos(respuesta){
     
    document.getElementById("identificacion").style.display="none";
    var plantilla=traerPlantilla("plantillas/visitas.html");

   

    var botonCierraSesion=plantilla.children[0];
    document.body.appendChild(botonCierraSesion);
    var divAux=document.createElement("div");
    divAux.appendChild(plantilla.querySelector(".alumno"));
    var alumno = divAux.children[0];
    divAux.appendChild(plantilla.querySelector(".anexo"));
    var anexo = divAux.children[1];
    divAux.appendChild(plantilla.querySelector(".acuerdo"));
    var acuerdo = divAux.children[2];
    botonCierraSesion.onclick=cerrarUsuario();
 
    var copiaVISITAS= alumno.querySelector(".visita");
    divAux.appendChild(copiaVISITAS);

    var empresa=" ";
    var convenio=" ";
    var sede=" ";

    // debugger;
    for(let i=0;i<respuesta.user.length;i++){
        if(respuesta.user[i].nombre_empresa!=empresa){
            empresa= respuesta.user[i].nombre_empresa;
            convenio=" ";
            var copia=plantilla.children[0].cloneNode(true);
            document.body.appendChild(copia);
            copia.querySelector(".nombre").innerHTML=empresa;

            var btnDespliegue=copia.querySelector(".despliegue");
            btnDespliegue.innerHTML=" + ";
            btnDespliegue.onclick=ocultaEmpresa(plantilla);
        //     var ocultar=plantilla.getElementsByTagName("span")[1];
        //     // ocultar.setAttribute('id', 'oculto');
        //     ocultar.innerHTML=" + ";
        //     var aaa= document.getElementsByClassName("cabEmpresa")[0];
        //     var ocultarEmpresa= document.getElementsByClassName("empresa")[0];
        //     ocultarEmpresa.children[1].style.display ='none';
        //     aaa.appendChild(ocultar);

        // debugger;

        //     ocultar.onclick=ocultaEmpresa(plantilla);

        }

        if(respuesta.user[i].Descrip!=convenio){
            convenio= respuesta.user[i].Descrip;
            sede=" ";
            var copiaConvenio=acuerdo.cloneNode(true);
            copiaConvenio.querySelector(".descrAcuerdo").innerHTML=convenio;
            copiaConvenio.style.display="none";
            copia.appendChild(copiaConvenio);
        }

        if(respuesta.user[i].descripcion!=sede){
            sede= respuesta.user[i].descripcion;
            var copiaAnexo=anexo.cloneNode(true);
            copiaAnexo.querySelector(".sede").innerHTML=sede;
            copiaConvenio.appendChild(copiaAnexo);
            
        }

        if(respuesta.user[i].nombre_alumno!=alumno){
            alum= respuesta.user[i].nombre_alumno;
            var copiaAlumno = alumno.cloneNode(true);

             copiaAlumno.querySelector(".nombreAlumno").innerHTML=alum;
         
        
            if(respuesta.user[i].visitas.length>0){

                for(let j=0;j<respuesta.user[i].visitas.length;j++){
                    // debugger;
                    var clonVisitas=copiaVISITAS.cloneNode(true);
                    var elementos= clonVisitas.querySelectorAll("input");

                    elementos[1].value=respuesta.user[i].visitas[j].fecha_inicio;
                    elementos[2].value=respuesta.user[i].visitas[j].hora_inicio;
                    elementos[3].value=respuesta.user[i].visitas[j].fecha_fin;
                    elementos[4].value=respuesta.user[i].visitas[j].hora_fin;
                    
                    var botones= clonVisitas.querySelectorAll("button");
                    botones[1].onclick=ProgramaBorrado(respuesta.user[i].visitas[j].id_visita,botones);
                    // debugger;

                    copiaAlumno.querySelector("tbody").appendChild(clonVisitas);
                    copiaAlumno.appendChild(clonVisitas);

               
                } 
              
                
            //  debugger;
             
        }

        
        // debugger;
            var clonVisitas=copiaVISITAS.cloneNode(true);
            var botones= clonVisitas.querySelectorAll("button");
            botones[1].parentElement.removeChild(botones[1]);
            // debugger;
            botones[0].innerHTML="Añadir";
           
            botones[0].onclick=ProgramaInsertar();

            copiaAlumno.querySelector("table tbody").appendChild(clonVisitas);

            // var botonAñadir=botones[0];
            // var Añadido=botonAñadir.parentElement.parentElement;
            // debugger;
           

            // var botonCrear=document.getElementsByTagName("button")[4];
            // debugger;
            // botonCrear.innerHTML=" ";
            // if(botonCrear.innerHTML=!" "){
        
            //     botonCrear.style.display="none";
        
            // }
            // else if(botonCrear.innerHTML==" "){
                
            //     var botonCrear=document.getElementsByTagName("button")[4];
            //     botonCrear.innerHTML=" + ";
               
            // }
  
         }
         copiaAnexo.appendChild(copiaAlumno);
         
    }
         
                    // copiaAlumno.querySelector("tbody").appendChild(clonVisitas);

                    // var botonCrear=document.createElement("button");
                    // var ultimoTh=clonVisitas.querySelector("th:last-child");
                   
                    

                    // debugger;
                    // botonCrear.innerHTML=" ";
                    // if(botonCrear.innerHTML!=" "){
                
                    //     botonCrear.style.display="none";
                
                    // }
                    // else if(botonCrear.innerHTML==" "){
        
                    //     // var botonCrear=document.getElementsByTagName("button")[4];
                    //     botonCrear.innerHTML=" + ";
                       
                    // }


    //var botonGuardar= document.getElementsByTagName("button")[2];

    //botonGuardar.onclick=guardarDatos();
    // var botonCrear=document.getElementsByTagName("button")[4];
    // debugger;
    // if(botonCrear.innerHTML=!null){

    //     var botonCrear=document.getElementsByTagName("button")[4];
    //     botonCrear.innerHTML=" + ";

    // }
    // else{
    //     botonCrear.style.display="none";
    // }

//     var ocultar=plantilla.getElementsByTagName("span")[1];
//     // ocultar.setAttribute('id', 'oculto');
//     ocultar.innerHTML=" + ";
//     var aaa= document.getElementsByClassName("cabEmpresa")[0];
//     var ocultarEmpresa= document.getElementsByClassName("empresa")[0];
//     ocultarEmpresa.children[1].style.display ='none';
//     aaa.appendChild(ocultar);
//   debugger;
//     ocultar.onclick=ocultaEmpresa(plantilla);
   
    
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

function guardarDatos(){
    return function (ev){
        ev.preventDefault();



    
    }
}

// function pulsado(){
//     var valor=this.innerHTML;
//     if(valor==="+"){
//         this.innerHTML="-";
//         this.parentNode.nextElementSibling.style.display="block";
//     }
//     else{
//         this.innerHTML="+";
//         this.parentNode.nextElementSibling.style.display="none";
//     }
// }

// function punteroFlecha(){
//     this.style.cursor="Arrow";
// }

// function punteroCursor(){
//     this.style.cursor="pointer";
// }

function ProgramaBorrado(id_visita,botones){
    return function(ev){
        ev.preventDefault();
        var ajax=new XMLHttpRequest();
        ajax.onreadystatechange=function(){
            if(this.readyState==4 && this.status==200){
                var respuesta=JSON.parse(this.responseText);
 
                if(respuesta.success){
                    
                    // alert("Elemento "+id_visita+ " Eliminado");
                    // debugger;
                   var FilaEliminada= botones[1].parentElement.parentElement;
                   FilaEliminada.parentElement.removeChild(FilaEliminada);
                   alert("VISITA ELIMINADA CORRECTAMENTE");
                 }
 
                  
                }
         
            }

            ajax.open("POST","./api/borrarVisita.php");
            ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
            ajax.send("id_visita=" + id_visita);
   
        // ev.preventDefault();
        // alert("Borra el registro: "+ id_visita);


    }
}

function ProgramaInsertar(){
    return function(ev){
        
        var fila=this.parentElement.parentElement;
        var inputs=fila.querySelectorAll("input");
        console.log(inputs[1].value + "<->"+ inputs[2].value + "<->"+inputs[3].value + "<->"+inputs[4].value + "<->");

        // ev.preventDefault();
        // debugger;
        // var visita=Añadido.children[1].children[0].value;
        // var ajax=new XMLHttpRequest();
        // ajax.onreadystatechange=function(){
        //     if(this.readyState==4 && this.status==200){
        //         var respuesta=JSON.parse(this.responseText);
 
        //         if(respuesta.success){
        //             debugger;
        //             Añadido;
        //             // alert("Elemento "+id_visita+ " Eliminado");
        //             // debugger;
        //            var FilaEliminada= botones[1].parentElement.parentElement;
        //            FilaEliminada.parentElement.removeChild(FilaEliminada);
        //            alert("VISITA ELIMINADA CORRECTAMENTE");
        //          }
 
                  
        //         }
         
        //     }

        //     ajax.open("POST","./api/borrarVisita.php");
        //     ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
        //     ajax.send(visita);


    }
}


   
