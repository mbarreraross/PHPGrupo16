<?php

 /*** include the controller class ***/
 include __SITE_PATH . '/application/' . 'controller_base.class.php';

 include __SITE_PATH . '/application/' . 'AbstractModel.class.php';

 /*** include the registry class ***/
 include __SITE_PATH . '/application/' . 'registry.class.php';

 /*** include the router class ***/
 include __SITE_PATH . '/application/' . 'router.class.php';

 /*** include the template class ***/
 include __SITE_PATH . '/application/' . 'template.class.php';

require_once(__SITE_PATH . '/application/' .'Events.php');

 /*** auto load model classes ***/
function __autoload($class_name) {
    $filename = strtolower($class_name) . '.class.php';
    $file = __SITE_PATH . '/model/' . $filename;

    if (file_exists($file) == false)
    {
        return false;
    }
  include ($file);
}

 /*** a new registry object ***/
 $registry = new registry;

 /*** create the database registry object ***/

$registry->db = new MysqliDb ('localhost', 'root', 'root', 'test');




  // Register an event for every time a user is created
  \simple_event_dispatcher\Events::register('user', 'create', function($namespace, $event, &$parameters) { 
    //Enviar un mail de registro exitoso
    $mensaje = "Bienvenido usuario " . $parameters['username'];

    // Si cualquier línea es más larga de 70 caracteres, se debería usar wordwrap()
    $mensaje = wordwrap($mensaje, 70, "\r\n");

    // Enviarlo
    mail('sandinosaso@gmail.com', 'Mi título', $mensaje);
    
  });



?>
