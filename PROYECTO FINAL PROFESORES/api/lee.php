<?php


                $dato=file_get_contents("php://input");
                $dato=json_decode($dato);

                foreach($dato->persona as $hola){

                    if($dato->validado=="true" && $hola->id =="1"){

                      echo $hola->nombre. " ".$hola->diaFin;
                    }
    
                    else if($dato->validado=="false"){
                        echo "Algo ha ido mal, comprueba tus datos";
                        break;
                    }
                }
                
                // $hola=$dato->persona;
                // if($dato->validado=="true" && $hola->id =="1"){

                //     foreach($dato->persona as $a){
                //         echo $a->nombre." " . $a->diaFin." "."</br>";
                //     }
                // }

                // else if($dato->validado=="false"){
                //     echo "Algo ha ido mal, comprueba tus datos";
                // }

                // {"validado": "true",
                //     "persona": [{
                
                //         "id":"1",
                //               "nombre":"jesus",
                //             "horaComienzo":"10:15",
                //             "diaFin":"02-01-2022",
                //             "horaFin":"14:30"
                // },
                // {
                //         "id":"2",
                //               "nombre":"Manolo",
                //             "horaComienzo":"10:15",
                //             "diaFin":"10-01-2022",
                //             "horaFin":"14:30"
                // }]
                // }
                
                
?>