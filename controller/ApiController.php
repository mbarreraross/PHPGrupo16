<?php

Class apiController Extends baseController {

public function index(){

}

public function deleteUser() {
    
  if (isset($_POST['id'])){
    $id = $_POST['id'];

    try {
      $userToDelete = new UserModel($this->registry, $id);
      $ok = $userToDelete->delete();
      
      if ($ok){
        $resultado = array(
                        'success' => true,
                        'msg' => 'Usuario borrado exitosamente.',
                    );
      }else{
        $resultado = array(
                        'success' => false,
                        'msg' => 'No se pudo borrar el usuario.',
                    );
      }    
      
    } catch (Exception $e) {
      $resultado = array(
            'success' => false,
            'msg' => $e->getMessage(),
        );
    }
  }else{
    $resultado = array(
          'success' => false,
          'msg' => 'Falta parametro id.',
      );
  }

  echo json_encode($resultado);
}

public function updateUser() {
    
       if (isset($_POST['id'])) {
           $id = $_POST['id'];

           try {
               $userToDelete = new UserModel($this->registry, $id);
               $ok = $userToDelete->update($_POST);
               if ($ok) {
                   $resultado = array(
                       'success' => true,
                       'msg' => 'Usuario borrado exitosamente.',
                   );
               } else {
                   $resultado = array(
                       'success' => false,
                       'msg' => 'No se pudo borrar el usuario.',
                   );
               }
           } catch (Exception $e) {
               $resultado = array(
                   'success' => false,
                   'msg' => $e->getMessage(),
               );
           }
       } else {
           $resultado = array(
               'success' => false,
               'msg' => 'Falta parametro id.',
           );
       }

       echo json_encode($resultado);
   }

public function enviarEmail() {
    

    // send email
    mail($_POST['email'],$_POST['asunto'],$_POST['texto']);
      
     $ok = true; 
      if ($ok){
        $resultado = array(
                        'success' => true,
                        'msg' => 'Enviado exitosamente',
                    );
      }else{
        $resultado = array(
                        'success' => false,
                        'msg' => 'No se pudo cambiar el estado.',
                    );
      }    
      
    
 

  echo json_encode($resultado);
}


public function changeDispo() {
    
  if (isset($_POST['id'])){
    $id = $_POST['id'];

    try {
      $userToChange = new UserModel($this->registry, $id);
      $ok = $userToChange->update($_POST);
      
      if ($ok){
        $resultado = array(
                        'success' => true,
                        'msg' => 'Cambio de estado exitoso.',
                    );
      }else{
        $resultado = array(
                        'success' => false,
                        'msg' => 'No se pudo cambiar el estado.',
                    );
      }    
      
    } catch (Exception $e) {
      $resultado = array(
            'success' => false,
            'msg' => $e->getMessage(),
        );
    }
  }else{
    $resultado = array(
          'success' => false,
          'msg' => 'Falta parametro id.',
      );
  }

  echo json_encode($resultado);
}

public function updateIdConv() {
    
  if (isset($_POST['id'])){
    $id = $_POST['id'];

    try {
      $userToChange = new UserModel($this->registry, $id);
      $ok = $userToChange->update($_POST);
      
      if ($ok){
        $resultado = array(
                        'success' => true,
                        'msg' => 'Cambio de estado exitoso.',
                    );
      }else{
        $resultado = array(
                        'success' => false,
                        'msg' => 'No se pudo cambiar el estado.',
                    );
      }    
      
    } catch (Exception $e) {
      $resultado = array(
            'success' => false,
            'msg' => $e->getMessage(),
        );
    }
  }else{
    $resultado = array(
          'success' => false,
          'msg' => 'Falta parametro id.',
      );
  }

  echo json_encode($resultado);
}

public function guardarMensaje() {
    
    try {
      $model = new ChatModel($this->registry);
	        
      $tz_object = new DateTimeZone('America/Argentina/Buenos_Aires');

        $datetime = new DateTime();
        $datetime->setTimezone($tz_object);
        $_POST['fecha']= $datetime->format('Y\-m\-d\ h:i:s');      
      //$_POST['fecha'] = date("Y-m-d H:i:s");
                
	  $ok = $model->saveConversacion($_POST);
      
      if ($ok){
        $resultado = array(
                        'success' => true,
                        'msg' => 'Agregado',
                    );
      }else{
        $resultado = array(
                        'success' => false,
                        'msg' => 'No agregado',
                    );
      }    
      
    } catch (Exception $e) {
      $resultado = array(
            'success' => false,
            'msg' => $e->getMessage(),
        );
    }

  echo json_encode($resultado);
}

public function cargarMensaje() {
    
    //try {
      $model = new ChatModel($this->registry);
	        
      $conversaciones = $model->getConversaciones();
      $html = '';          
      foreach ($conversaciones as $key => $conversacion) {
         if($_POST['id_agente'] == $conversacion['id_agente'] and $_POST['id_usuario'] == $conversacion['id_usuario']){   
            $agente = $conversacion['agente'];
            $usuario = $conversacion['usuario'];
            $fecha = $conversacion['fecha'];
            $mensaje = $conversacion['mensaje'];
            $modelUsr = new UserModel($this->registry);

		    $usuarioUsr = $modelUsr->getUsuario($_POST['id_agente']);
            $imagen = base64_encode($usuarioUsr['imagen']);
            
            if ($conversacion['envio'] == 0) {
                $html .= "<li class='right clearfix'><span class='chat-img pull-right'><img src='http://bootdey.com/img/Content/user_1.jpg' alt='User Avatar'></span>";
                $html .= "<div class='chat-body clearfix'><div class='header'><strong class='primary-font'>$usuario</strong>";
                $html .= "<small class='pull-right text-muted'><i class='fa fa-clock-o'></i>$fecha</small>";
                $html .= "</div> <p>$mensaje</p>  </div></li>";
            }
            else {
                $html .= "<li class='left clearfix'><span class='chat-img pull-left'><img src='data:text/plain;base64,$imagen' alt='User Avatar'></span>";
                $html .= "<div class='chat-body clearfix'><div class='header'><strong class='primary-font'>$agente</strong>";
                $html .= "<small class='pull-right text-muted'><i class='fa fa-clock-o'></i>$fecha</small>";
                $html .= "</div> <p>$mensaje</p>  </div></li>";
            }

         }					
								
	}          
      
        $resultado = array(
                        'success' => true,
                        'msg' => $html,
                    );   
      
   /* } catch (Exception $e) {
      $resultado = array(
            'success' => false,
            'msg' => $e->getMessage(),
        );
    }
*/
  echo json_encode($resultado);
}
public function cargarMensajeFiltro() {

       //try {
       $model = new ChatModel($this->registry);

       $conversaciones = $model->getConversaciones();
       $html = '';
       $fecha = $_POST['fechaI'];
       $dia = substr($fecha, 8, 2);
       $mes = substr($fecha, 5, 2);
       $anio = substr($fecha, 0, 4);
       $fIni = $mes . '-' . $dia . '-' . $anio;
       $numFI = strtotime ($fIni);
       $fecha = $_POST['fechaF'];
        $dia = substr($fecha, 8, 2);
       $mes = substr($fecha, 5, 2);
       $anio = substr($fecha, 0, 4);
       $fFin = $mes . '-' . $dia . '-' . $anio;
       $numFF = strtotime ($fFin);
       
       foreach ($conversaciones as $key => $conversacion) {
           $fecha = $conversacion['fecha'];
           $dia = substr($fecha, 8, 2);
           $mes = substr($fecha, 5, 2);
           $anio = substr($fecha, 0, 4);
           $fConv = $mes . '-' . $dia . '-' . $anio;  
           $numFConv = strtotime ($fConv);
 ;
           if ($_POST['id_agente'] == $conversacion['id_agente'] and $numFConv>=$numFI and $numFConv<=$numFF) {
               $agente = $conversacion['agente'];
               $usuario = $conversacion['usuario'];
               $fecha = $conversacion['fecha'];
               $mensaje = $conversacion['mensaje'];
               $modelUsr = new UserModel($this->registry);

               $usuarioUsr = $modelUsr->getUsuario($_POST['id_agente']);
               $imagen = base64_encode($usuarioUsr['imagen']);

               if ($conversacion['envio'] == 0) {
                   $html .= "<li class='right clearfix'><span class='chat-img pull-right'><img src='http://bootdey.com/img/Content/user_1.jpg' alt='User Avatar'></span>";
                   $html .= "<div class='chat-body clearfix'><div class='header'><strong class='primary-font'>$usuario</strong>";
                   $html .= "<small class='pull-right text-muted'><i class='fa fa-clock-o'></i>$fecha</small>";
                   $html .= "</div> <p>$mensaje</p>  </div></li>";
               } else {
                   $html .= "<li class='left clearfix'><span class='chat-img pull-left'><img src='data:text/plain;base64,$imagen' alt='User Avatar'></span>";
                   $html .= "<div class='chat-body clearfix'><div class='header'><strong class='primary-font'>$agente</strong>";
                   $html .= "<small class='pull-right text-muted'><i class='fa fa-clock-o'></i>$fecha</small>";
                   $html .= "</div> <p>$mensaje</p>  </div></li>";
               }
           }
       }

       $resultado = array(
           'success' => true,
           'msg' => $html,
       );

       /* } catch (Exception $e) {
         $resultado = array(
         'success' => false,
         'msg' => $e->getMessage(),
         );
         }
        */
       echo json_encode($resultado);
   }
}

?>