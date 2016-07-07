<?php

Class chatController Extends baseController {

	public function index() {
		/*** set a template variable ***/
	        $this->registry->template->welcome = 'User controller index';
		/*** load the index template ***/
	        $this->registry->template->show('user/index');
	}
	
	public function frontend(){
		$model = new UserModel($this->registry);
        
        
		$usuarios = $model->getUsuariosDisponibles('on');

		$this->registry->template->usuarios = $usuarios;
        //session_start();
        $r=session_id();
        $this->registry->template->r = $r;
		$this->registry->template->show('frontend/chat');
	}

    public function conv(){
$model = new ChatModel($this->registry);
               $modelU = new userModel($this->registry);
               
               $Usuarios = $modelU->getUsuarios();
$Convs = $model->getConversaciones();
              
$this->registry->template->Convs = $Convs;
               $this->registry->template->Usuarios = $Usuarios;

$this->registry->template->show('user/conv');
}


}
