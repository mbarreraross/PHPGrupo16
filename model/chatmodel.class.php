<?php

class chatModel extends AbstractModel{
    private $table_name = 'conversacion';
    protected $id;
    protected $mensaje='';
    protected $fecha='';
    protected $agente='';
    protected $id_agente=0;
    protected $usuario='';
    protected $id_usuario='';
    protected $envio=2;
    
  public function __construct($registry, $id=null){
    	parent::__construct($registry);

    	if (!is_null($id)){
    		try {
          $datos = $this->getConversacion($id);
          if ($datos){
            $this->fromArray($datos);
          }
        } catch (Exception $e) {
          return false;
        } 
    	}
    }

  public function getConversaciones(){
		$usuarios = $this->registry->db->get($this->table_name);
		return $usuarios;
	}
  
  public function getConversacion($id){
    $conversacion = $this->registry->db->where('id',$id)->getOne($this->table_name);

    return $conversacion;
  }

	public function saveConversacion($datos){
		$resultado = $this->registry->db->insert($this->table_name, $datos);

    
		return $resultado;
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