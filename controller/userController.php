<?php

Class userController Extends baseController {

	public function index() {
		/*** set a template variable ***/
	        $this->registry->template->welcome = 'User controller index';
		/*** load the index template ***/
	        $this->registry->template->show('user/index');
	}

	
	public function all(){
		$model = new UserModel($this->registry);

		$usuarios = $model->getUsuarios();

		$this->registry->template->usuarios = $usuarios;

		$this->registry->template->show('user/all');
	}

	public function save(){
		if (isset($_POST['enviar'])){

			$model = new UserModel($this->registry);
	        
	        unset($_POST['enviar']);
	        unset($_POST['id']);
                        
            $archivo = $_FILES["imagen"]["tmp_name"]; 
            $image = imagecreatefrompng($archivo);
            ob_start();
            imagepng($image);
            $_POST['imagen'] = ob_get_contents();
            ob_end_clean();
                            
			$insertOk = $model->save($_POST);

			if ($insertOk){

				$usuarios = $model->getUsuarios();
				
				$this->registry->template->usuarios = $usuarios;
				$this->registry->template->show('user/all');

			}else{
				$this->registry->error = 'No se pudo guardar';
				$this->registry->template->show('error404');
			}
		}else{
			$this->registry->template->show('user/save');
		}

	}

	public function update($params=array()){
		if (!isset($_POST['update'])){
		
			if (isset($params["id"])){
				$user = new UserModel($this->registry, $params["id"]);
			}else{
				$user = new UserModel($this->registry);
			}
			
			if (isset($params['ajax'])){
				echo json_encode($user->toArray());
			}else{
				$this->registry->template->user = $user;
				$this->registry->template->show('user/update');
			}
		}else{
			//var_dump($_POST);die;
			$user = new UserModel($this->registry, $_POST["id"]);

			unset($_POST['update']);
			unset($_POST['id']);
	        
			$insertOk = $user->update($_POST);

			if ($insertOk){

				$usuarios = $user->getUsuarios();
				
				$this->registry->template->usuarios = $usuarios;
				$this->registry->template->show('user/all');

			}else{
				$this->registry->template->blog_heading = 'Error al guardar los datos';
				$this->registry->template->error = 'No se pudo guardar';
				$this->registry->template->show('error404');
			}

		}

	}

	public function login(){
		if (isset($_POST['Login'])){
			//Logica del login
 
			$user = new UserModel($this->registry);
			$loginOk = $user->login($_POST['mail'], $_POST['password']);
            
			if ($loginOk){
                $usuario = $user->getUsuarioMail($_POST['mail']);
                if($usuario["es_admin"] == 'on'){
                    $usuarios = $user->getUsuarios();
		
                    $this->registry->template->usuarios = $usuarios;
                    $this->registry->template->show('user/all');
                }
                else{
                    $this->registry->template->usuarios = $usuario;
                    $this->registry->template->show('user/chat');
                }
			}else{
				echo "Usuario o password invalidos";
			}
		}else{
			//Muestro el formulario
			$this->registry->template->show('user/login');
		}
	}

	public function delete(){
		$model = new UserModel($this->registry);
                
		$usuarios = $model->getUsuarios();
		
		$this->registry->template->usuarios = $usuarios;
		$this->registry->template->show('user/all');

	}


}
