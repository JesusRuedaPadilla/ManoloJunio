window.addEventListener("load", function(){


    
    var botonEnviar=document.getElementsByTagName("button")[0];
 
    var txtUser=document.getElementById("correo");
    var txtContraseña=document.getElementById("contrasena");

    botonEnviar.onclick=comprobarUsuario(txtUser,txtContraseña);

    CompruebaLogueado();

 

})


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
            ajax.open("GET","./php/logout.php");
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
                     
                }
                
                 
               }
               else if(respuesta.error){
                  var mensajeError=document.getElementById("mensaje");
                mensajeError.innerHTML=respuesta.error;
                 
               }
            
           }
           ajax.open("POST","./php/login.php");
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
           ajax.open("GET","./php/SesionPHPInit.php");
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
    var visitas= alumno.children[1];
    divAux.appendChild(plantilla.querySelector(".anexo"));
    var anexo = divAux.children[1];
    divAux.appendChild(plantilla.querySelector(".acuerdo"));
    var acuerdo = divAux.children[2];
    botonCierraSesion.onclick=cerrarUsuario();
    var empresa=" ";
    var convenio=" ";
    var sede=" ";

    // debugger;
    for(let i=0;i<respuesta.user.length;i++){
        if(respuesta.user[i].nombre_empresa!=empresa){
            empresa= respuesta.user[i].nombre_empresa;
            convenio=" ";
            var copia=plantilla.children[0].cloneNode(true);
            copia.querySelector(".nombre").innerHTML=empresa;
        }

        if(respuesta.user[i].Descrip!=convenio){
            convenio= respuesta.user[i].Descrip;
            sede=" ";
            var copiaConvenio=acuerdo.cloneNode(true);
            copiaConvenio.querySelector(".descrAcuerdo").innerHTML=convenio;
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
         
          
             
         debugger;

            if(respuesta.user[i].visitas[i]!=null){

                visit= respuesta.user[i].visitas[i].fecha_inicio;
                
            //     var copiaVisitas = visitas.cloneNode(true);
            //   var copiaVisit= copiaVisitas.children[0];
              
            //   var puede=copiaVisit.children[1].children[0].children[1];
            //   puede.children[0].value=visit;

             var copiaVISITAS= copiaAlumno.querySelector(".visita").children[1];

             copiaVISITAS.children[0].value=visit;

             
                var visitas= copiaAlumno.querySelector(".visitas");
    
                copiaAlumno.appendChild(visitas);
                
                copiaAnexo.appendChild(copiaAlumno);
                
            }
        //     visit= respuesta.user[i].visitas[i].fecha_inicio;
        //     var copiaVisitas = visitas.cloneNode(true);
        //   var copiaVisit= copiaVisitas.children[0];
          
        //   var puede=copiaVisit.children[1].children[0].children[1]
        //   puede.children[0].value=visit;
        
        //     copiaAlumno.appendChild(copiaVisitas);
        //     copiaAnexo.appendChild(copiaAlumno);
        //     // copiaAnexo.appendChild(copiaAlumno);
            
            else{   
                copiaAnexo.appendChild(copiaAlumno);
            }
           
            //  var divVisitas=document.getElementsByClassName("visita")[0];
            //  var inputFechaInicio= divVisitas.children[1].children[0].value;
            //  inputFechaInicio=respuesta.user[i].visitas[i].fecha_inicio;

        }

        document.body.appendChild(copia);
 }
}
// function CierraSesion(){
    
// }
function traerPlantilla(url){
    var ajax=new XMLHttpRequest();
    ajax.open("GET",url,false);
    ajax.send();

    var TextoPlantilla=ajax.responseText;
    var div=document.createElement("div");
    div.innerHTML=TextoPlantilla;
    return div;

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




   
