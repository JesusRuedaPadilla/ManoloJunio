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
// debugger;

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

function ocultaEmpresaAdmin(){
    return function (ev){
        ev.preventDefault();
// debugger;

        var span=this;
        var empresa=span.parentElement.parentElement;
        if(this.innerHTML==" + "){
            this.innerHTML=" - ";
            var acuerdo=empresa.getElementsByClassName("empresa");
            var acuerdo2=empresa.getElementsByClassName("acuerdo");
            for (let i=0;i<acuerdo2.length;i++){
                acuerdo[i].style.display="block";
                acuerdo2[i].style.display="block";
            }
        }else{
            this.innerHTML=" + ";
            var acuerdo=empresa.getElementsByClassName("empresa");
            var acuerdo2=empresa.getElementsByClassName("acuerdo");
            for (let i=0;i<acuerdo2.length;i++){
                acuerdo[i].style.display="none";
                acuerdo2[i].style.display="none";
            }
        }

    }
}


function ResetContraseñaProfesor(id_usuario){
    return function (ev){
        ev.preventDefault();

        var botonReset=this;
        // debugger
    
            var datos="user="+id_usuario;
            // debugger;
        
                var ajax=new XMLHttpRequest();
        
                ajax.onreadystatechange=function(){
                    if(this.readyState==4 && this.status==200){
                        
                        var respuesta=JSON.parse(this.responseText);
                        
                        if(respuesta.succes==true){
    
                            alert("Contraseña reseteada correctamente");
                            // debugger;
                            // cerrarUsuario();
                           
                            // CambioContraseñaHTML=document.getElementById("cambioContraseña");
                            // CambioContraseñaHTML.parentElement.removeChild(CambioContraseñaHTML);
                            // inicioHTML=document.getElementById("identificacion");
                            // inicioHTML.style.display="block";
                            // inicioHTML.children[4].value="";
                            // inicioHTML.children[8].value="";
    
                        }
    
                        else{
                            alert("No se ha podido actualizar la contraseña");
                        }
                     
                    }
                 
                }
                ajax.open("POST","./api/resetContraseñaXAdmin.php");
                ajax.setRequestHeader("Content-type","application/x-www-form-urlencoded");
                ajax.send(datos);

    }
    
}

function cerrarUsuario(){
    return function (ev){
        ev.preventDefault();
// debugger;
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
                    botonCambioContraseña=document.getElementsByClassName("change")[0];
                    padre.removeChild(botonCambioContraseña);
                    for (let i=0;i<numEmpresas;i++){
                        padre.removeChild(divEmpresas[0]);
                    }

                    var divInicioSesion=document.getElementById("identificacion");
                    divInicioSesion.style.display="block";
                    var span= divInicioSesion.getElementsByTagName("span")[0];
                    span.innerHTML="";
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


function cerrarUsuarioAdmin(){
    return function (ev){
        ev.preventDefault();
// debugger;
        var ajax=new XMLHttpRequest();
        ajax.onreadystatechange=function(){
            if(this.readyState==4 && this.status==200){
                var respuesta=JSON.parse(this.responseText);
 
                if(respuesta.success){
                    
                    var botonCierraSesion=document.getElementById("logout");
                    var select=document.getElementsByClassName("select")[0];
                    var padre=botonCierraSesion.parentNode;
                    padre.removeChild(botonCierraSesion);
                    padre.removeChild(select);
                    var divProfesores=padre.getElementsByClassName("profesor");
                    var numProfesores=divProfesores.length;
                    botonCambioContraseña=document.getElementsByClassName("change")[0];
                    padre.removeChild(botonCambioContraseña);
                    for (let i=0;i<numProfesores;i++){
                        padre.removeChild(divProfesores[0]);
                    }
                    var divInicioSesion=document.getElementById("identificacion");
                    divInicioSesion.style.display="block";
                    debugger;
                    var span= divInicioSesion.getElementsByTagName("span")[0];
                    span.innerHTML="";
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
         
         
            if(respuesta.success && respuesta.admin==true && respuesta.contraseñaCambiada==true){
                   debugger;
                procesaDatosAdmin(respuesta);

                }
                if(respuesta.success && respuesta.admin==false && respuesta.contraseñaCambiada==true){
                   
                    procesaDatos(respuesta);

               }

               if(respuesta.contraseñaCambiada==false){
                // alert("Hay que cambiar la contraseña para iniciar sesion de forma correcta");

                document.getElementById("identificacion").style.display="none";
                var plantilla=traerPlantilla("plantillas/cambioContraseña.html");
                document.body.appendChild(plantilla);
            //    debugger;
               var aceptar=plantilla.getElementsByClassName("enviar")[0];
                
               aceptar.onclick=cambioContraseña(plantilla,respuesta.user);               
                
                
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
function cambioContraseña(plantilla,respuesta){
    return function(ev){
        ev.preventDefault();
    // debugger;
    var contraseñaXDefecto=plantilla.getElementsByClassName("contrasenaVieja")[0];
    var contrasenaCambiada1=plantilla.getElementsByClassName("contrasenaNueva1")[0];
    var contrasenaCambiada2=plantilla.getElementsByClassName("contrasenaNueva2")[0];

    if((contrasenaCambiada1.value==contrasenaCambiada2.value) && contraseñaXDefecto.value!=0){

        var datos="claveOld="+contraseñaXDefecto.value+"&user="+respuesta+"&clave="+contrasenaCambiada2.value;
        // debugger;
        var aceptar=plantilla.getElementsByClassName("enviar")[0];
    
            var ajax=new XMLHttpRequest();
    
            ajax.onreadystatechange=function(){
                if(this.readyState==4 && this.status==200){
                    
                    var respuesta=JSON.parse(this.responseText);
                    
                    if(respuesta.succes==true){

                        alert("Contraseña actualizada correctamente, inicie sesion con la nueva contraseña");
                        // debugger;
                        // cerrarUsuario();
                       
                        CambioContraseñaHTML=document.getElementById("cambioContraseña");
                        CambioContraseñaHTML.parentElement.removeChild(CambioContraseñaHTML);
                        inicioHTML=document.getElementById("identificacion");
                        inicioHTML.style.display="block";
                        inicioHTML.children[4].value="";
                        inicioHTML.children[8].value="";

                    }

                    else{
                        alert("No se ha podido actualizar la contraseña");
                    }
                 
                }
             
            }
            ajax.open("POST","./api/cambioContraseña.php");
            ajax.setRequestHeader("Content-type","application/x-www-form-urlencoded");
            ajax.send(datos);
    }

    else{
        alert("La contraseñas no coinciden");
    }

 

    }   
}
      
function ModificaPlantillaCambioContraseña(respuesta){
    return function(ev){
        ev.preventDefault();
    // debugger;
    var plantilla1=traerPlantilla("plantillas/cambioContraseña.html");
    var body=document.getElementsByTagName("body")[0];
        let logout=document.getElementById("logout");
        let botonCambioContraseña=document.getElementsByClassName("change")[0];
        var empresas=document.getElementsByClassName("empresa");

        for(let i=0;i<empresas.length;i++){
          var empresa= empresas[i].style.display="none";
        }
       
        logout.parentElement.removeChild(logout);
        botonCambioContraseña.parentElement.removeChild(botonCambioContraseña);
        // empresas.parentElement.removeChild(empresas);

        document.body.appendChild(plantilla1);

        var aceptar=plantilla1.getElementsByClassName("enviar")[0];
                
        aceptar.onclick=cambioContraseña(plantilla1,respuesta.usuario);    


    }   
}

function ModificaPlantillaCambioContraseñaADMIN(respuesta){
    return function(ev){
        ev.preventDefault();
    debugger;
    var plantilla1=traerPlantilla("plantillas/cambioContraseña.html");
    var body=document.getElementsByTagName("body")[0];
    var select=document.getElementsByClassName("select")[0];
    body.removeChild(select);
        let logout=document.getElementById("logout");
        let botonCambioContraseña=document.getElementsByClassName("change")[0];
        var profesor=document.getElementsByClassName("profesor");

        for(let i=0;i<profesor.length;i++){
          var empresa= profesor[i].style.display="none";
        }
       
        logout.parentElement.removeChild(logout);
        botonCambioContraseña.parentElement.removeChild(botonCambioContraseña);
        // empresas.parentElement.removeChild(empresas);

        document.body.appendChild(plantilla1);

        var aceptar=plantilla1.getElementsByClassName("enviar")[0];
                
        aceptar.onclick=cambioContraseña(plantilla1,respuesta.usuario);    


    }   
}
   

function CompruebaLogueado(){
  var ajax=new XMLHttpRequest();
       ajax.onreadystatechange=function(){
           if(this.readyState==4 && this.status==200){
               var respuesta=JSON.parse(this.responseText);
            // debugger;
            if(respuesta.success && respuesta.admin==true && respuesta.contraseñaCambiada==true){
                   debugger;
                procesaDatosAdmin(respuesta);


                }
                if(respuesta.success && respuesta.admin==false && respuesta.contraseñaCambiada==true){
                   
                    procesaDatos(respuesta);

               }

               if(respuesta.contraseñaCambiada==false){
                // alert("Hay que cambiar la contraseña para iniciar sesion de forma correcta");

                document.getElementById("identificacion").style.display="none";
                var plantilla=traerPlantilla("plantillas/cambioContraseña.html");
                document.body.appendChild(plantilla);
            //    debugger;
               var aceptar=plantilla.getElementsByClassName("enviar")[0];
                
               aceptar.onclick=cambioContraseña(plantilla,respuesta.user);               
                
                
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
    var botonCambioContraseña=plantilla.getElementsByClassName("change")[0];
    document.body.appendChild(botonCambioContraseña);
    var divAux=document.createElement("div");
    divAux.appendChild(plantilla.querySelector(".alumno"));
    var alumno = divAux.children[0];
    divAux.appendChild(plantilla.querySelector(".anexo"));
    var anexo = divAux.children[1];
    divAux.appendChild(plantilla.querySelector(".acuerdo"));
    var acuerdo = divAux.children[2];
    botonCierraSesion.onclick=cerrarUsuario();
// debugger;

    botonCambioContraseña.onclick=ModificaPlantillaCambioContraseña(respuesta);
 
    // botonCambioContraseña.onclick=traerPlantilla("plantillas/cambioContraseña.html");
    // var desaparece=plantilla;

    // desaparece.parentElement.removeChild(desaparece);
 
    var copiaVISITAS= alumno.querySelector(".visita");
    divAux.appendChild(copiaVISITAS);

    var empresa=" ";
    var convenio=" ";
    var sede=" ";

    // debugger;
    for(let i=0;i<respuesta.user.length;i++){
        if(respuesta.user[i].nombre_empresa!=empresa){
            // debugger;
            empresa= respuesta.user[i].nombre_empresa;
            convenio=" ";
            var copia=plantilla.children[0].cloneNode(true);
            document.body.appendChild(copia);
            copia.querySelector(".nombre").innerHTML=empresa;

            var btnDespliegue=copia.querySelector(".despliegue");
            btnDespliegue.innerHTML=" + ";
            btnDespliegue.onclick=ocultaEmpresa(plantilla);

        }
        // debugger;
        if(respuesta.admin==true){
            alert("El usuario introducido ES un administrador");
            
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
                            // debugger;
                        let botonGuardar= this.parentElement.parentElement.querySelector("button");
                        // console.log(botonGuardar);
                        // console.log(this);
                        // botonGuardar.setAttribute("disabled",false);
                        botonGuardar.disabled=false;

                        }
                    }
                    
                    var botonBorrar=clonVisitas.children[5].children[1];
                    var botonGuardar=clonVisitas.children[5].children[0];
                    botonBorrar.onclick=ProgramaBorrado(respuesta.user[i].visitas[j].id_visita,botonBorrar);
                    // debugger;
                    botonGuardar.onclick=ProgramaGuardar(respuesta.user[i],respuesta.user[i].visitas[j].id_visita,botonGuardar);
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
// debugger;
            copiaAlumno.querySelector("table tbody").appendChild(clonVisitas);
  
         }
         copiaAnexo.appendChild(copiaAlumno);
         
    }

 }

 function procesaDatosAdmin(respuesta){
    //  debugger;
    document.getElementById("identificacion").style.display="none";
    var plantilla=traerPlantilla("plantillas/visitasAdmin.html");

   
// debugger;
    var botonCierraSesion=plantilla.children[0];
    document.body.appendChild(botonCierraSesion);
    var botonCambioContraseña=plantilla.getElementsByClassName("change")[0];
    document.body.appendChild(botonCambioContraseña);
    var select=plantilla.getElementsByClassName("select")[0];
    document.body.appendChild(select);
    select.innerHTML="";
    botonCierraSesion.onclick=cerrarUsuarioAdmin();

    botonCambioContraseña.onclick=ModificaPlantillaCambioContraseñaADMIN(respuesta);
    

    for(let q=0;q<respuesta.profesor.length;q++){

        var option=document.createElement("option");
  
        option.innerHTML=respuesta.profesor[q].nombre+" "+respuesta.profesor[q].apellidos;
        // debugger;
    
        
        select.appendChild(option);
    
            option.onclick=mostrarProfesor(respuesta.profesor[q],plantilla,respuesta);
           
       
    }

    muestraPrimerProfesor(respuesta.profesor[0],plantilla,respuesta);
}

function muestraPrimerProfesor(respuesta,plantilla,respuestas){

     
debugger;
var divAux=document.createElement("div");
divAux.appendChild(plantilla.querySelector(".alumno"));
var alumno = divAux.children[0];
divAux.appendChild(plantilla.querySelector(".anexo"));
var anexo = divAux.children[1];
divAux.appendChild(plantilla.querySelector(".acuerdo"));
var acuerdo = divAux.children[2];

// var plantilla1=traerPlantilla("plantillas/cambioContraseña.html");
// botonCambioContraseña.onclick=cambioContraseña(plantilla1,respuesta);
// var desaparece=plantilla;

// desaparece.parentElement.removeChild(desaparece);

var copiaVISITAS= alumno.querySelector(".visita");
divAux.appendChild(copiaVISITAS);

    var empresa=" ";
    var convenio=" ";
    var sede=" ";
    var nombre=" ";
    // debugger;

        // debugger;
        for(let j=0;j<respuesta.datos.length;j++){

            if(respuesta.nombre!=nombre){
                nombre=  respuesta.nombre;
                apellidos= respuesta.apellidos;
// debugger;
                var copia=plantilla.children[0].cloneNode(true);
                document.body.appendChild(copia);
                copia.querySelector(".nombre").innerHTML=nombre +" "+apellidos;
                var excel=copia.getElementsByClassName("excel")[0];
                excel.onclick=generaDatosExcel(respuestas);
                var btnDespliegue=copia.querySelector(".despliegue");
                btnDespliegue.innerHTML=" + ";
                btnDespliegue.onclick=ocultaEmpresaAdmin(plantilla);
                // debugger;
                if(respuesta.rol!="administrador"){
                    var btnReseteo=copia.querySelector(".reset");
                   
                    btnReseteo.onclick=ResetContraseñaProfesor(respuesta.id_usuario); 
                }
                else if(respuesta.rol=="administrador"){
                    var btnReseteo=copia.querySelector(".reset");
                    btnReseteo.parentElement.removeChild(btnReseteo);
                }
            
            }
// debugger;
            if(respuesta.datos[j].nombre_empresa!=empresa){
                empresa=  respuesta.datos[j].nombre_empresa;
                convenio=" ";
                var copia1=plantilla.children[1].cloneNode(true);
                document.body.appendChild(copia1);
                copia1.querySelector(".nombre").innerHTML=empresa;
                copia1.style.display="none";
                copia.appendChild(copia1);
                // var btnDespliegue=copia.querySelector(".despliegue");
                // btnDespliegue.innerHTML=" + ";
                // btnDespliegue.onclick=ocultaEmpresa(plantilla);
    
            }
            // debugger;
            // if(respuesta.admin==true){
            //     alert("El usuario introducido ES un administrador");
                
            // }
            if(respuesta.datos[j].Descrip!=convenio){
                convenio= respuesta.datos[j].Descrip;
                sede=" ";
                var copiaConvenio=acuerdo.cloneNode(true);
                copiaConvenio.querySelector(".descrAcuerdo").innerHTML=convenio;
                copiaConvenio.style.display="none";
                copia.appendChild(copiaConvenio);
            }
    // debugger;
            if(respuesta.datos[j].descripcion!=sede){
                sede= respuesta.datos[j].descripcion;
                var copiaAnexo=anexo.cloneNode(true);
                copiaAnexo.querySelector(".sede").innerHTML=sede;
                copiaConvenio.appendChild(copiaAnexo);
                
            }
    
            if(respuesta.datos[j].nombre_alumno!=alumno){
                alum= respuesta.datos[j].nombre_alumno;
                var copiaAlumno = alumno.cloneNode(true);
    
                 copiaAlumno.querySelector(".nombreAlumno").innerHTML=alum;
             
            // debugger;
                if(respuesta.datos[j].visitas.length>0){
    
                    for(let l=0;l<respuesta.datos[j].visitas.length;l++){
                        // debugger;
                        var clonVisitas=copiaVISITAS.cloneNode(true);
                        var elementos= clonVisitas.querySelectorAll("input");
                        debugger;
                        elementos[1].value=respuesta.datos[j].visitas[l].fecha_inicio;
                        elementos[2].value=respuesta.datos[j].visitas[l].hora_inicio;
                        elementos[3].value=respuesta.datos[j].visitas[l].fecha_fin;
                        elementos[4].value=respuesta.datos[j].visitas[l].hora_fin;
                        elementos[5].value=respuesta.datos[j].visitas[l].dieta;
                        
                        var check= clonVisitas.querySelectorAll("input");
                        //  debugger;
                        for(let ñ=0;ñ<check.length;ñ++){
                            debugger;
                            elementos[5].onchange=compruebaNumeroVisitas(respuesta.datos[j].visitas[l]);
                        }

                        if(elementos[5].value=respuesta.datos[j].visitas[l].dieta==1){
                            debugger;
                           var holaar= elementos[5];
                           holaar.checked=true;

                           if(holaar.checked==true){
                            holaar.parentElement.parentElement.children[1].children[0].setAttribute("readonly",true);
                            holaar.parentElement.parentElement.children[2].children[0].setAttribute("readonly",true);
                            holaar.parentElement.parentElement.children[3].children[0].setAttribute("readonly",true);
                            holaar.parentElement.parentElement.children[4].children[0].setAttribute("readonly",true);
                            holaar.parentElement.previousElementSibling.children[0].disabled=true;
                            holaar.parentElement.previousElementSibling.children[1].disabled=true;
                        }
                           

                        }
                        // var botones= clonVisitas.querySelectorAll("button");
                        // debugger;
                        for (let k=1;k<=4;k++){
                            elementos[k].onchange=function(){
                                // debugger;
                            let botonGuardar= this.parentElement.parentElement.querySelector("button");
                            // console.log(botonGuardar);
                            // console.log(this);
                            // botonGuardar.setAttribute("disabled",false);
                            botonGuardar.disabled=false;
                            
                            }
                        }
                        
                        var botonBorrar=clonVisitas.children[5].children[1];
                        var botonGuardar=clonVisitas.children[5].children[0];
                        // debugger;
                        botonBorrar.onclick=ProgramaBorrado(respuesta.datos[j].visitas[l].id_visita,botonBorrar);
                        // debugger;
                        botonGuardar.onclick=ProgramaGuardar(respuesta,respuesta.datos[j].visitas[l].id_visita,botonGuardar);
                        botonGuardar.disabled=true;
                        // debugger;
    
                        copiaAlumno.querySelector("table tbody").appendChild(clonVisitas);
                        // copiaAlumno.appendChild(clonVisitas);
    
                       var reseteoContraseña=document.getElementsByClassName("reset")[0];
                      
                     
                       
                    } 
                  
                    
                //  debugger;
                 
            }
    
            
            // debugger;
            // var check=document.getElementsByClassName("checker");
            
            //    var hola= check.length;
            //    var tr= check.length.parentElement.parentElement;
            //    tr.removeChild(tr.children[6]);
            
            // var tr=check.parentElement.parentElement;
            
           
            // if(check!=null){
            //     check.parentElement.removeChild(check);
            // }
          
                var clonVisitas=copiaVISITAS.cloneNode(true);
                var botones= clonVisitas.querySelectorAll("button");
                botones[1].parentElement.removeChild(botones[1]);
                // debugger;
                botones[0].innerHTML="Añadir";
                var botones1= clonVisitas.querySelectorAll("button");
                debugger;
                botones[0].onclick=ProgramaInsertar(respuesta.datos[j],botones1);
             
                copiaAlumno.querySelector("table tbody").appendChild(clonVisitas);
// debugger;
             
         
             }
            //  debugger;
          debugger;
             copiaAnexo.appendChild(copiaAlumno);
            //  debugger;
            //  var check= copiaAnexo.querySelectorAll("input");
            //  //  debugger;
            //  for(let ñ=0;ñ<check.length;ñ++){
            //      debugger;
            //      check[ñ].onchange=compruebaNumeroVisitas(respuesta.profesor[i].datos[j]);
            //  }
            
             var tr= document.getElementsByClassName("visita");
             var longitudTr=tr.length-1;
            tr[longitudTr];
            if(tr[longitudTr].children[5].children[0].textContent=="Añadir"){
                var ocultaCheck=tr[longitudTr].children[6].children[0].parentElement;
                ocultaCheck.style.display="none";
            
  
        }
    
        }
       

    
}
   

function mostrarProfesor(respuesta,respuestas){
        return function(ev){
// debugger;
// for(let g=0;g<4;g++){
//     document.getElementById("identificacion").parentElement.removeChild(document.getElementById("identificacion").nextElementSibling);
//     g+1;
// }
var eliminaProfesor=document.getElementsByClassName("profesor")[0];
eliminaProfesor.parentElement.removeChild(eliminaProfesor);
// var a=document.getElementsByClassName("empresa")[0];
// a.parentElement.removeChild(a);
// var b=document.getElementsByClassName("profesor")[0];
// b.parentElement.removeChild(b);
// var b=document.getElementsByClassName("profesor")[0];
// b.parentElement.removeChild(b);

// document.body.children[4].style.display="none";

var plantilla=traerPlantilla("plantillas/visitasAdmin.html");
plantilla.children[0].style.display="none";

var divAux=document.createElement("div");
divAux.appendChild(plantilla.querySelector(".alumno"));
var alumno = divAux.children[0];
divAux.appendChild(plantilla.querySelector(".anexo"));
var anexo = divAux.children[1];
divAux.appendChild(plantilla.querySelector(".acuerdo"));
var acuerdo = divAux.children[2];

// var plantilla1=traerPlantilla("plantillas/cambioContraseña.html");
// botonCambioContraseña.onclick=cambioContraseña(plantilla1,respuesta);
// var desaparece=plantilla;

// desaparece.parentElement.removeChild(desaparece);

var copiaVISITAS= alumno.querySelector(".visita");
divAux.appendChild(copiaVISITAS);

    var empresa=" ";
    var convenio=" ";
    var sede=" ";
    var nombre=" ";
    // debugger;

        // debugger;
        for(let j=0;j<respuesta.datos.length;j++){

            if(respuesta.nombre!=nombre){
                nombre=  respuesta.nombre;
                apellidos= respuesta.apellidos;
// debugger;
                plantilla.children[2].removeChild(plantilla.children[2].children[1])
                var copia=plantilla.children[2].cloneNode(true);
                document.body.appendChild(copia);
                copia.querySelector(".nombre").innerHTML=nombre +" "+apellidos;
                var excel=copia.getElementsByClassName("excel")[0];
                excel.onclick=generaDatosExcel(respuestas);
                var btnDespliegue=copia.querySelector(".despliegue");
                btnDespliegue.innerHTML=" + ";
                btnDespliegue.onclick=ocultaEmpresaAdmin(plantilla);
                debugger;
                if(respuesta.rol!="administrador"){
                    var btnReseteo=copia.querySelector(".reset");
                   
                    btnReseteo.onclick=ResetContraseñaProfesor(respuesta.id_usuario); 
                }
                else if(respuesta.rol=="administrador"){
                    var btnReseteo=copia.querySelector(".reset");
                    btnReseteo.parentElement.removeChild(btnReseteo);
                }
            
            }
// debugger;
            if(respuesta.datos[j].nombre_empresa!=empresa){
                empresa=  respuesta.datos[j].nombre_empresa;
                convenio=" ";
                var copia1=plantilla.children[3].cloneNode(true);
                document.body.appendChild(copia1);
                copia1.querySelector(".nombre").innerHTML=empresa;
                copia1.style.display="none";
                copia.appendChild(copia1);
                // var btnDespliegue=copia.querySelector(".despliegue");
                // btnDespliegue.innerHTML=" + ";
                // btnDespliegue.onclick=ocultaEmpresa(plantilla);
    
            }
            // debugger;
            // if(respuesta.admin==true){
            //     alert("El usuario introducido ES un administrador");
                
            // }
            if(respuesta.datos[j].Descrip!=convenio){
                convenio= respuesta.datos[j].Descrip;
                sede=" ";
                var copiaConvenio=acuerdo.cloneNode(true);
                copiaConvenio.querySelector(".descrAcuerdo").innerHTML=convenio;
                copiaConvenio.style.display="none";
                copia.appendChild(copiaConvenio);
            }
    // debugger;
            if(respuesta.datos[j].descripcion!=sede){
                sede= respuesta.datos[j].descripcion;
                var copiaAnexo=anexo.cloneNode(true);
                copiaAnexo.querySelector(".sede").innerHTML=sede;
                copiaConvenio.appendChild(copiaAnexo);
                
            }
    
            if(respuesta.datos[j].nombre_alumno!=alumno){
                alum= respuesta.datos[j].nombre_alumno;
                var copiaAlumno = alumno.cloneNode(true);
    
                 copiaAlumno.querySelector(".nombreAlumno").innerHTML=alum;
             
            // debugger;
                if(respuesta.datos[j].visitas.length>0){
    
                    for(let l=0;l<respuesta.datos[j].visitas.length;l++){
                        // debugger;
                        var clonVisitas=copiaVISITAS.cloneNode(true);
                        var elementos= clonVisitas.querySelectorAll("input");
                        debugger;
                        elementos[1].value=respuesta.datos[j].visitas[l].fecha_inicio;
                        elementos[2].value=respuesta.datos[j].visitas[l].hora_inicio;
                        elementos[3].value=respuesta.datos[j].visitas[l].fecha_fin;
                        elementos[4].value=respuesta.datos[j].visitas[l].hora_fin;
                        elementos[5].value=respuesta.datos[j].visitas[l].dieta;
                        
                        var check= clonVisitas.querySelectorAll("input");
                        //  debugger;
                        for(let ñ=0;ñ<check.length;ñ++){
                            debugger;
                            elementos[5].onchange=compruebaNumeroVisitas(respuesta.datos[j].visitas[l]);
                        }

                        if(elementos[5].value=respuesta.datos[j].visitas[l].dieta==1){
                            debugger;
                           var holaar= elementos[5];
                           holaar.checked=true;

                           if(holaar.checked==true){
                            holaar.parentElement.parentElement.children[1].children[0].setAttribute("readonly",true);
                            holaar.parentElement.parentElement.children[2].children[0].setAttribute("readonly",true);
                            holaar.parentElement.parentElement.children[3].children[0].setAttribute("readonly",true);
                            holaar.parentElement.parentElement.children[4].children[0].setAttribute("readonly",true);
                            holaar.parentElement.previousElementSibling.children[0].disabled=true;
                            holaar.parentElement.previousElementSibling.children[1].disabled=true;
                        }
                           

                        }
                        // var botones= clonVisitas.querySelectorAll("button");
                        // debugger;
                        for (let k=1;k<=4;k++){
                            elementos[k].onchange=function(){
                                // debugger;
                            let botonGuardar= this.parentElement.parentElement.querySelector("button");
                            // console.log(botonGuardar);
                            // console.log(this);
                            // botonGuardar.setAttribute("disabled",false);
                            botonGuardar.disabled=false;
                            
                            }
                        }
                        
                        var botonBorrar=clonVisitas.children[5].children[1];
                        var botonGuardar=clonVisitas.children[5].children[0];
                        // debugger;
                        botonBorrar.onclick=ProgramaBorrado(respuesta.datos[j].visitas[l].id_visita,botonBorrar);
                        // debugger;
                        botonGuardar.onclick=ProgramaGuardar(respuesta,respuesta.datos[j].visitas[l].id_visita,botonGuardar);
                        botonGuardar.disabled=true;
                        // debugger;
    
                        copiaAlumno.querySelector("table tbody").appendChild(clonVisitas);
                        // copiaAlumno.appendChild(clonVisitas);
    
                       var reseteoContraseña=document.getElementsByClassName("reset")[0];
                      
                     
                       
                    } 
                  
                    
                //  debugger;
                 
            }
    
            
            // debugger;
            // var check=document.getElementsByClassName("checker");
            
            //    var hola= check.length;
            //    var tr= check.length.parentElement.parentElement;
            //    tr.removeChild(tr.children[6]);
            
            // var tr=check.parentElement.parentElement;
            
           
            // if(check!=null){
            //     check.parentElement.removeChild(check);
            // }
          
                var clonVisitas=copiaVISITAS.cloneNode(true);
                var botones= clonVisitas.querySelectorAll("button");
                botones[1].parentElement.removeChild(botones[1]);
                // debugger;
                botones[0].innerHTML="Añadir";
                var botones1= clonVisitas.querySelectorAll("button");
                debugger;
                botones[0].onclick=ProgramaInsertar(respuesta.datos[j],botones1);
             
                copiaAlumno.querySelector("table tbody").appendChild(clonVisitas);
// debugger;
             
         
             }
            //  debugger;
          debugger;
             copiaAnexo.appendChild(copiaAlumno);
            //  debugger;
            //  var check= copiaAnexo.querySelectorAll("input");
            //  //  debugger;
            //  for(let ñ=0;ñ<check.length;ñ++){
            //      debugger;
            //      check[ñ].onchange=compruebaNumeroVisitas(respuesta.profesor[i].datos[j]);
            //  }
            
             var tr= document.getElementsByClassName("visita");
             var longitudTr=tr.length-1;
            tr[longitudTr];
            if(tr[longitudTr].children[5].children[0].textContent=="Añadir"){
                var ocultaCheck=tr[longitudTr].children[6].children[0].parentElement;
                ocultaCheck.style.display="none";
            
  
        }
    
        }
       
    }
}
    
function generaDatosExcel(respuestas){
    return function(ev){
        debugger;
        var DatosVisitasExcel = Array(respuestas.profesor.length);
        for(let i=0;i<respuestas.profesor.length;i++){
            for(let j=0;j<respuestas.profesor[i].datos.length;j++){
                for(let k=0;k<respuestas.profesor[i].datos[j].visitas.length;k++){

                    var nombreProf=respuestas.profesor[i].nombre+ " "+respuestas.profesor[i].apellidos;
                    var localidad=respuestas.profesor[i].datos[j].localidad;
                    var provincia=respuestas.profesor[i].datos[j].provincia;
                    var nombreAlumno=respuestas.profesor[i].datos[j].nombre_alumno;
                    var dietas=respuestas.profesor[i].datos[j].visitas[k].dieta;
                    var fecha_inicio=respuestas.profesor[i].datos[j].visitas[k].fecha_inicio;
                    var hora_inicio=respuestas.profesor[i].datos[j].visitas[k].hora_inicio;
                    var fecha_fin=respuestas.profesor[i].datos[j].visitas[k].fecha_fin;
                    var hora_fin=respuestas.profesor[i].datos[j].visitas[k].hora_fin;

                    if(dietas==1){
                        DatosVisitasExcel[i]=[{nombreProf,localidad,provincia,nombreAlumno,dietas,fecha_inicio,hora_inicio,
                        fecha_fin,hora_fin}];
                    }
            
                }

            }
        
             }

            var ajax=new XMLHttpRequest();
            ajax.onreadystatechange=function(){
                if(this.readyState==4 && this.status==200){
                    var respuesta=JSON.parse(this.responseText);
                    if(respuesta.success==true){
                        alert("Se ha descargado el EXCEL");
                    }
                    else if(respuesta.success==false){
                        alert("Ha ocurrido un error al generar el Excel");
                    }
            
                }
            }
                ajax.open("POST","./api/generaExcel.php");
                ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
                ajax.send("DatosVisitas=" + JSON.stringify(DatosVisitasExcel));

        }

    } 
 

 function compruebaNumeroVisitas(respuesta){
    return function(ev){
        debugger;
        if(this.checked==true){
            this.parentElement.parentElement.children[1].children[0].setAttribute("readonly",true);
            this.parentElement.parentElement.children[2].children[0].setAttribute("readonly",true);
            this.parentElement.parentElement.children[3].children[0].setAttribute("readonly",true);
            this.parentElement.parentElement.children[4].children[0].setAttribute("readonly",true);
            this.parentElement.previousElementSibling.children[0].disabled=true;
            this.parentElement.previousElementSibling.children[1].disabled=true;
        }
        else if(this.checked==false){
            this.parentElement.parentElement.children[1].children[0].removeAttribute("readonly");
            this.parentElement.parentElement.children[2].children[0].removeAttribute("readonly");
            this.parentElement.parentElement.children[3].children[0].removeAttribute("readonly");
            this.parentElement.parentElement.children[4].children[0].removeAttribute("readonly");
            this.parentElement.previousElementSibling.children[0].disabled=false;
            this.parentElement.previousElementSibling.children[1].disabled=false;
        }
     
        var datos="id_visita="+respuesta.id_visita+"&dieta="+respuesta.dieta;
        
        ev.preventDefault();
       if(numberOfCheckedItems==3){
        this.setAttribute("disabled",true);
       }
        else{

       
        if(this.checked=="false"){
            this.checked="true";
        }
        else if(this.checked=="true"){
            this.checked="false";
        }

        var ajax=new XMLHttpRequest();
        ajax.onreadystatechange=function(){
            if(this.readyState==4 && this.status==200){
                var respuesta=JSON.parse(this.responseText);
 
            }
        }
            ajax.open("POST","./api/VisitasChequeadas.php");
            ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
            ajax.send(datos);

          var holas= this.parentElement.parentElement.parentElement.children;
          var numberOfCheckedItems = 0; 
          for(let i=0;i<holas.length-1;i++){
            
           var chequeado=holas[i].children[6].children[0].checked;
            
           if(chequeado==true){
            numberOfCheckedItems=numberOfCheckedItems+1;  
           }
           var chequeado = Array(holas.length-1);
           if(numberOfCheckedItems==3){
            for(let i=0;i<holas.length-1;i++){
           
            chequeado[i]=holas[i].children[6].children[0].checked;
            if(chequeado[i]==false){
                var botoncheckbox=this.parentElement.parentElement.parentElement.getElementsByClassName("checker")[i];
              botoncheckbox.setAttribute("disabled",true);
              
            }

            }
            debugger;
            chequeado="check="+chequeado;
            
        }
        else if(numberOfCheckedItems<3){
            for(let i=0;i<holas.length-1;i++){
           
                chequeado[i]=holas[i].children[6].children[0].checked;
                if(chequeado[i]==false){
                  var botoncheckbox=this.parentElement.parentElement.parentElement.getElementsByClassName("checker")[i];
                  botoncheckbox.removeAttribute("disabled");
                }
    
                }
        }
    }
    }
    
 }
}
 
function traerPlantilla(url){
    // debugger;
    var ajax=new XMLHttpRequest();
    ajax.open("GET",url,false);
    ajax.send();
    var TextoPlantilla=ajax.responseText;
    var div=document.createElement("div");
    div.innerHTML=TextoPlantilla;
    return div;


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
                    // debugger;
                   var FilaEliminada= botonBorrar.parentElement.parentElement;
                   FilaEliminada.parentElement.removeChild(FilaEliminada);
                //    alert("VISITA ELIMINADA CORRECTAMENTE");
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
        // for(let i=0;i<usuarios.length;i++){
        //     for(let j=0;j<usuarios[i].visitas.length;j++)

        //     if((usuarios[i].visitas[j].fecha_inicio && usuarios[i].visitas[j].hora_inicio.substring("0","5") && 
        //     usuarios[i].visitas[j].fecha_fin && usuarios[i].visitas[j].hora_fin.substring("0","5")) === (inputs[1].value && (inputs[2].value) && (inputs[3].value) && (inputs[4].value))){

        //         var Visita=null;
        //         alert("LOS DATOS INTRODUCIDOS CONCUERDAN CON OTRA VISITA YA PROGRAMADA, REVISE LOS DATOS E INTENTELO DE NUEVO");
                
        // }
           
        // }
    
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
                //   debugger;
                   var id_visitaInsertada= respuestas.response[0].id_visita;
                   var Filainsertada= botones1[0].parentElement.parentElement;
                   var fila=Filainsertada.cloneNode(true);
                    // debugger;
                   for(let i=1;i<Filainsertada.children.length-1;i++){

                    Filainsertada.children[i].children[0].value="";

                   }
    // debugger;
                   Filainsertada.parentElement.insertBefore(fila, Filainsertada.parentElement.children[0]);
                //    debugger;
                   botonBorrar= fila.children[5].children[0].cloneNode(true);
                //    fila.children[5].children[0].disabled=true;
                   var botonGuardar=fila.children[5].children[0].innerHTML="Guardar";
                   fila.children[5].children[0].parentElement.appendChild(botonBorrar);
                   botonBorrar.innerHTML="Borrar";
                 debugger;
                    fila.children[5].children[0].onclick=ProgramaGuardar(respuesta.id_alumno_detalle_convenio,id_visitaInsertada,botonGuardar);
                    fila.children[5].children[1].onclick=ProgramaBorrado(id_visitaInsertada,botonBorrar);
                    fila.children[6].style.display="block";
                    // debugger;
                    var check=fila.parentElement.getElementsByClassName("checker");
                    
                debugger;
                var ajax=new XMLHttpRequest();
                ajax.onreadystatechange=function(){
                    if(this.readyState==4 && this.status==200){
                        // debugger;
                        var respuestas=JSON.parse(this.responseText);
                        for(let i=0;i<check.length;i++){
                            debugger;
                            respuestas;
                            check[0].onchange=compruebaNumeroVisitasAlInsertar(respuestas.response,respuestas.response.id_visita);
                        }
                    }
                        
                    }
                    ajax.open("POST","./api/dameVisitaAdmin.php",false);
                    ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
                    ajax.send("id_visita="+id_visitaInsertada);

                   
            // clonCheckBox.appendChild(inputs[0].parentElement);
                 }
                //  debugger;
              
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
                debugger;
            
                ajax.send("visita=" + JSON.stringify(Visita)+"&id_usuario="+respuesta.id_usuario);
            
           


    }
}

function compruebaNumeroVisitasAlInsertar(respuesta,id_visitaInsertada){
    return function(ev){
        debugger;
        if(this.checked==true){
            this.parentElement.parentElement.children[1].children[0].setAttribute("readonly",true);
            this.parentElement.parentElement.children[2].children[0].setAttribute("readonly",true);
            this.parentElement.parentElement.children[3].children[0].setAttribute("readonly",true);
            this.parentElement.parentElement.children[4].children[0].setAttribute("readonly",true);
            this.parentElement.previousElementSibling.children[0].disabled=true;
            this.parentElement.previousElementSibling.children[1].disabled=true;
        }
        else if(this.checked==false){
            this.parentElement.parentElement.children[1].children[0].removeAttribute("readonly");
            this.parentElement.parentElement.children[2].children[0].removeAttribute("readonly");
            this.parentElement.parentElement.children[3].children[0].removeAttribute("readonly");
            this.parentElement.parentElement.children[4].children[0].removeAttribute("readonly");
            this.parentElement.previousElementSibling.children[0].disabled=false;
            this.parentElement.previousElementSibling.children[1].disabled=false;
        }
     
        var datos="id_visita="+id_visitaInsertada+"&dieta="+respuesta.dieta;
        // var ajax=new XMLHttpRequest();
        // ajax.onreadystatechange=function(){
        //     if(this.readyState==4 && this.status==200){

        //         var respuestas=JSON.parse(this.responseText);

        //         respuesta;
        //         id_visitaInsertada;
        //         var datos="id_visita="+id_visitaInsertada+"&dieta="+respuesta.dieta;

    
        //     }
        // }
        // ajax.open("POST","./api/dameVisitaAdmin.php",false);
        // ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
        // ajax.send(datos);

        debugger;
        // fila[0].children[1].children[0].setAttribute("readonly", true);
        // ev.preventDefault();
       if(numberOfCheckedItems==3){
        this.setAttribute("disabled",true);
       }
        else{

       
        if(this.checked=="false"){
            this.checked="true";
            
        }
        else if(this.checked=="true"){
            this.checked="false";
            
        }

        var ajax=new XMLHttpRequest();
        ajax.onreadystatechange=function(){
            if(this.readyState==4 && this.status==200){
                var respuesta=JSON.parse(this.responseText);
                respuesta.dieta;
            }
        }
            ajax.open("POST","./api/VisitasChequeadas.php");
            ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
            ajax.send(datos);

            

          var holas= this.parentElement.parentElement.parentElement.children;
          var numberOfCheckedItems = 0; 
          for(let i=0;i<holas.length-1;i++){
            
           var chequeado=holas[i].children[6].children[0].checked;
            
           if(chequeado==true){
            numberOfCheckedItems=numberOfCheckedItems+1;  
           }
           var chequeado = Array(holas.length-1);
           if(numberOfCheckedItems==3){
            for(let i=0;i<holas.length-1;i++){
           
            chequeado[i]=holas[i].children[6].children[0].checked;
            if(chequeado[i]==false){
                var botoncheckbox=this.parentElement.parentElement.parentElement.getElementsByClassName("checker")[i];
              botoncheckbox.setAttribute("disabled",true);
              
            }

            }
            debugger;
            chequeado="check="+chequeado;
            
        }
        else if(numberOfCheckedItems<3){
          
                // this.parentElement.parentElement.children[1].children[0].setAttribute("readonly",true);
                // this.parentElement.parentElement.children[2].children[0].setAttribute("readonly",true);
                // this.parentElement.parentElement.children[3].children[0].setAttribute("readonly",true);
                // this.parentElement.parentElement.children[4].children[0].setAttribute("readonly",true);
           
          
            for(let i=0;i<holas.length-1;i++){
           
                chequeado[i]=holas[i].children[6].children[0].checked;
        
                if(chequeado[i]==false){
                  var botoncheckbox=this.parentElement.parentElement.parentElement.getElementsByClassName("checker")[i];
                  botoncheckbox.removeAttribute("disabled");
                //   this.parentElement.parentElement.children[1].children[0].removeAttribute("readonly");
                //   this.parentElement.parentElement.children[2].children[0].removeAttribute("readonly");
                //   this.parentElement.parentElement.children[3].children[0].removeAttribute("readonly");
                //   this.parentElement.parentElement.children[4].children[0].removeAttribute("readonly");
                }
    
                }
        }
    }
    }
    
 }

}

function ProgramaGuardar(respuesta,id_visita,botonGuardar){
    return function(ev){
        // debugger;
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
                // debugger;
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
