<?php

class userModel extends AbstractModel{
    private $table_name = 'usuarios';
    protected $id;
    protected $name='';
    protected $age = 0;
    protected $mail='';
    protected $password='';
    protected $lunes='';
    protected $martes='';
    protected $miercoles='';
    protected $jueves='';
    protected $viernes='';
    protected $sabado='';
    protected $domingo='';
    protected $hora_inicio='';
    protected $hora_fin='';
    protected $es_admin='';
    protected $bloqueado='';
    protected $imagen='';
    protected $disponible='';
    
  public function __construct($registry, $id=null){
    	parent::__construct($registry);

    	if (!is_null($id)){
    		try {
          $datos = $this->getUsuario($id);
          if ($datos){
            $this->fromArray($datos);
          }
        } catch (Exception $e) {
          return false;
        } 
    	}
    }

  public function getUsuarios(){
		$usuarios = $this->registry->db->get($this->table_name);
		return $usuarios;
	}
    

  public function getUsuariosDisponibles($disponible){
    $usuariosdis = $this->registry->db->where('disponible',$disponible)->get($this->table_name);

    return $usuariosdis;
  }
  
  public function getUsuario($id){
    $usuario = $this->registry->db->where('id',$id)->getOne($this->table_name);

    return $usuario;
  }
  
   public function getUsuarioMail($mail){
    $usuario = $this->registry->db->where('mail',$mail)->getOne($this->table_name);

    return $usuario;
  }

  public function login($mail, $password){
    $query = "SELECT * from usuarios where mail = ? and password = SHA1('".$password."+salt"."') and bloqueado='off' ";
    $usuario = $this->registry->db->rawQuery($query, Array ($mail));
	
		return $usuario;
	}

	public function save($datos){
		$datos['password'] = $this->registry->db->func('SHA1(?)',Array ($datos['password']."+salt"));
		$resultado = $this->registry->db->insert($this->table_name, $datos);

    if ($resultado){
      //Send notification to anyone who want to know
      // Ok, user is created, tell anyone who's interested
        \simple_event_dispatcher\Events::trigger('user', 'create', [
            'username' => $datos['name']
        ]);

    }
		return $resultado;
	}

	public function delete(){
		return $this->registry->db
					->where('id', $this->getId())
					->delete($this->table_name);
	}

	public function update($datos){
		return $this->registry->db->where('id', $this->getId())
								  ->update($this->table_name, $datos);
	}

	/**
	 * Hace un where filtrando por las condiciones que se reciben por parametro
	 * Ej: filter(
	 * 				array('name'=>array('=','Luis'),
	 * 				    'age'=>array('>',10)
	 *         	       )
	 *           )
	 * @param  [array] $conditions Condiciones con clave la columna
	 * @return [array] Resultado de la consulta 
	 */
	public function filter($conditions){
		
		foreach ($conditions as $column => $operadorValor) {
			foreach ($operadorValor as $operador => $valor) {
				$this->registry->db->where($column, $valor, $operador);
			}
		}

		return $this->registry->db->get($this->table_name);
		
	}
        

}


?>