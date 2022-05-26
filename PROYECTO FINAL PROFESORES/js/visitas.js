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
                    // var botones= clonVisitas.querySelectorAll("button");
                    // debugger;
                    for (let l=1;l<=4;l++){
                        elementos[l].onchange=function(){
                            debugger;
                        let botonGuardar= this.parentElement.parentElement.querySelector("button");
                        console.log(botonGuardar);
                        console.log(this);
                        // botonGuardar.setAttribute("disabled",false);
                        botonGuardar.disabled=false;

                        }
                    }
                    
                    var botonBorrar=clonVisitas.children[5].children[1];
                    var botonGuardar=clonVisitas.children[5].children[0];
                    botonBorrar.onclick=ProgramaBorrado(respuesta.user[i].visitas[j].id_visita,botonBorrar);
                    // debugger;
                    botonGuardar.onclick=ProgramaGuardar(respuesta.user[i],respuesta.user[i].visitas[j].id_visita,botonGuardar);
                    // botonGuardar.setAttribute("disabled",true);
                    botonGuardar.disabled=true;
                    // debugger;

                    copiaAlumno.querySelector("table tbody").appendChild(clonVisitas);
                    // copiaAlumno.appendChild(clonVisitas);

               
                } 
              
                
            //  debugger;
             
        }

        
        // debugger;
            var clonVisitas=copiaVISITAS.cloneNode(true);
            var botones= clonVisitas.querySelectorAll("button");
            botones[1].parentElement.removeChild(botones[1]);
            // debugger;
            botones[0].innerHTML="Añadir";
            var botones1= clonVisitas.querySelectorAll("button");
            botones[0].onclick=ProgramaInsertar(respuesta.user[i],botones1);

            copiaAlumno.querySelector("table tbody").appendChild(clonVisitas);
  
         }
         copiaAnexo.appendChild(copiaAlumno);
         
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

function guardarDatos(){
    return function (ev){
        ev.preventDefault();



    
    }
}

function ProgramaBorrado(id_visita,botonBorrar){
    return function(ev){
        ev.preventDefault();
        var ajax=new XMLHttpRequest();
        ajax.onreadystatechange=function(){
            if(this.readyState==4 && this.status==200){
                var respuesta=JSON.parse(this.responseText);
 
                if(respuesta.success){
                    
                    // alert("Elemento "+id_visita+ " Eliminado");
                    debugger;
                   var FilaEliminada= botonBorrar.parentElement.parentElement;
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

function ProgramaInsertar(respuesta,botones1){
    return function(ev){
        debugger;
        var fila=this.parentElement.parentElement;
        var inputs=fila.querySelectorAll("input");
        // let indice = inputs[2].value.indexOf(" ' ' ");
        let cadenaExtraida1 = inputs[2].value.substring("0", "2");
        
        // let cadenaExtraida2 = inputs[4].value.substring("0", "2");
        // var cadenita= cadenaExtraida2-cadenaExtraida1;
        // debugger;
        if(((inputs[1].value=="") || (inputs[2].value=="") || (inputs[3].value=="") || (inputs[4].value=="")) || 
        (inputs[1].value>inputs[3].value) || ((inputs[1].value==inputs[3].value) && (inputs[2].value>=inputs[4].value)) /*|| cadenita<2*/){
            var Visita=null;
        }
        else{
            if((((inputs[1].value==inputs[3].value) && (inputs[2].value!=inputs[4].value)) /*&& cadenita>=2*/) || (inputs[1].value<inputs[3].value) && (inputs[2].value!=inputs[4].value) /*&& cadenita>=2)*/){
                var Visita=[inputs[1].value, inputs[2].value,inputs[3].value,inputs[4].value,respuesta.id_alumno_detalle_convenio];
            }
            
        }
       
        // console.log(inputs[1].value + "<->"+ inputs[2].value + "<->"+inputs[3].value + "<->"+inputs[4].value + "<->");
        // ev.preventDefault();
        // debugger;
        // var visita=Añadido.children[1].children[0].value;
        var ajax=new XMLHttpRequest();
        ajax.onreadystatechange=function(){
            if(this.readyState==4 && this.status==200){
                // debugger;
                var respuestas=JSON.parse(this.responseText);
    
                if(respuestas.success && respuestas.response){
                   
                    // alert(Visita[0]);
                  
                   var id_visitaInsertada= respuestas.response[0].id_visita;
                   var Filainsertada= botones1[0].parentElement.parentElement;
                   var fila=Filainsertada.cloneNode(true);
                    // debugger;
                   for(let i=1;i<Filainsertada.children.length-1;i++){

                    Filainsertada.children[i].children[0].value="";

                   }

                   Filainsertada.parentElement.insertBefore(fila, Filainsertada.parentElement.children[0]);
                   var botonGuardar=fila.children[5].children[0].innerHTML="Guardar";
                   botonBorrar= fila.children[5].children[0].cloneNode(true);
                   fila.children[5].children[0].parentElement.appendChild(botonBorrar);
                   botonBorrar.innerHTML="Borrar";
                   debugger;
                    fila.children[5].children[0].onclick=ProgramaGuardar(respuesta.id_alumno_detalle_convenio,id_visitaInsertada,botonGuardar);
                    fila.children[5].children[1].onclick=ProgramaBorrado(id_visitaInsertada,botonBorrar);
                   
                 }
                 if(respuestas.fallo){
                     alert("Compruebe que todos los datos introducidos son correctos");
                 }
 
                  
                }
         
            }

            // Terminado{
                // hacer Json stringify de Visitas y en php hacer un json decode 
            // }
            
                // debugger;
                ajax.open("POST","./api/InsertarVisita.php");
                ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
                // debugger;
            
                ajax.send("visita=" + JSON.stringify(Visita));
            
           


    }
}


function ProgramaGuardar(respuesta,id_visita,botonGuardar){
    return function(ev){
        debugger;
        var fila=this.parentElement.parentElement;
        var inputs=fila.querySelectorAll("input");
        // debugger;
        var Visita=[inputs[1].value, inputs[2].value,inputs[3].value,inputs[4].value,respuesta.id_alumno_detalle_convenio,id_visita];
        // console.log(inputs[1].value + "<->"+ inputs[2].value + "<->"+inputs[3].value + "<->"+inputs[4].value + "<->");
    
        // ev.preventDefault();
        // debugger;
        // var visita=Añadido.children[1].children[0].value;
        var ajax=new XMLHttpRequest();
        ajax.onreadystatechange=function(){
            if(this.readyState==4 && this.status==200){
                // debugger;
                var respuesta=JSON.parse(this.responseText);
                debugger;
                if(respuesta.success){

                    alert("VISITA ACTUALIZADA CORRECTAMENTE");
                    botonGuardar.disabled=true;
                //     // alert(Visita[0]);
                //    var FilaActualizada= botonGuardar.parentElement.parentElement;
                //    var fila=Filainsertada.cloneNode(true);
                //     // debugger;
                //    for(let i=1;i<Filainsertada.children.length-1;i++){

                //     Filainsertada.children[i].children[0].value="";

                //    }

                //    Filainsertada.parentElement.insertBefore(fila, Filainsertada.parentElement.children[0]);
                //    fila.children[5].children[0].innerHTML="Guardar";
                //    botonBorrar= fila.children[5].children[0].cloneNode(true);
                //    fila.children[5].children[0].parentElement.appendChild(botonBorrar);
                //    botonBorrar.innerHTML="Borrar";

                //    fila.children[5].children[1].onclick=ProgramaBorrado(id_visitaInsertada,botonBorrar);
                   
                 }
                 
                 if(respuesta.fallo){
                     alert("No se ha podido insertar la visita");
                 }
 
                  
                }
         
            }

                // debugger;
                ajax.open("POST","./api/actualizarVisita.php");
                ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
                // debugger;
            
                ajax.send("visita=" + JSON.stringify(Visita));
            
           


    }
}


   
