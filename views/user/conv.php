<?php $base_url = "http://" . $_SERVER['SERVER_NAME'] . '/mvc/'; 

                ?>

<link rel="stylesheet" href="<?php echo $base_url; ?>views/user/mostrarConv.css"  />
<link rel="stylesheet" href="<?php echo $base_url; ?>views/user/chatRoom.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
   <script src='http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js'></script>
    <script type="text/javascript">
        
        $(document).ready(function () {
            $('#btnFiltrar').click(function () {
                cargarTodosMensajes();
            });
        });
        
      var cargarTodosMensajes = function(){
          if ($('#fInicio').val()=='')
          {
              $('#fInicio').val('2010-01-01');
          }
         if ($('#fFin').val()=='')
          {
              $('#fFin').val('2020-01-01');
          }


          
          $.ajax({
                 type: "POST",
                 url: "http://localhost/mvc/api/cargarMensajeFiltro?ajax=true",
                 data: {
                     id_agente : $('#agenteSelected').val(),
                     fechaI : $("#fInicio").val(),
                     fechaF : $("#fFin").val()
                 }
             }).done(function(msg){
                $("#chatClean").html('');
                 $("#contenedorChat ul").append(msg.msg);
                 
             })
      }
       
    </script>

<div class="box">
    <div class="box-header">
        <h3 class="box-title"></h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        <div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
            <div class="row">

                <div class="col-sm-4">
                    <div id="example1_filter" class="dataTables_filter">
                        <label>Agente: 			
                            <select name="example1_length" aria-controls="example1" id="agenteSelected" class="form-control input-sm">
                                <?php
                                foreach ($Usuarios as $key => $Usuario) {//$agente) {
                                echo "<option value='{$Usuario['id']}'>{$Usuario['name']}</option>";

                                }?>
                            </select> </label>
                            <label class="input-group"> 			
                                <input type="date" id="fInicio" name="fecha_inicio" value=""/>
                                <span class="input-group-addon">-</span>
                                <input type="date" id="fFin"name="hora_fin" value="" /></label>
                        <button class="btn btn-success no-rounded" id="btnFiltrar" type="button">Filtrar</button>
                    </div>
                    
                </div>
            </div>

        </div>	
    </div>
</div>
    <div id="chat">
        <div id="header-chat">

        </div>

            <div class="chat-message" id="contenedorChat">
                    <ul class="chat" id="chatClean">
                       


                    </ul>
                </div>


    </div>
