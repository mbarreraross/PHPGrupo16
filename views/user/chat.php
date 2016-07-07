<?php
 $base_url="http://".$_SERVER['SERVER_NAME'].'/mvc/';
?>
<html>
<head>
  
  <link rel="stylesheet" href="<?php echo $base_url; ?>views/user/chatRoom.css">
   <script src='http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js'></script>
    <script type="text/javascript">
 $(document).ready(function () {
        
            
        $('#btnInit').click(function () {
            var dispo;
            if($('#btnInit').text()=='No disponible'){
                dispo = 'off';
            }else{
                dispo = 'on';
            }
            
            $.ajax({
                    method: "POST",
                    url: "http://localhost/mvc/api/changeDispo?ajax=true",
                    data: { id: $('#btnInit').val(), disponible: dispo}
                })
                .done(function( result ) {
                    if (result.success){
                        if($('#btnInit').text()=='No disponible'){
                            $('#btnInit').text('Disponible');
                        }else{
                            $('#btnInit').text('No disponible')
                        }
                    }
                });
                       
        });   
        
        registrarMensaje();
        $.ajaxSetup({"cache":false});         
        setInterval("cargarTodosMensajes()",5000);                        
});

var registrarMensaje = function(){
          $("#btnMensaje").on("click", function(e){
             e.preventDefault(); 
             var now = new Date().toLocaleString();
             $.ajax({
                 type: "POST",
                 url: "http://localhost/mvc/api/guardarMensaje?ajax=true",
                 data: {
                     mensaje : $("#MsjEnviado").val(),
                     fecha : now,
                     agente : $('#NomAgente').val(),
                     id_agente : $('#IdAgente').val(),
                     usuario : "Invitado",
                     id_usuario : $("#session").val(),
                     envio : $("#envio").val()
                 }
             }).done(function(info){
                 $("#MsjEnviado").val('');
             })
          });
      }
      
      var cargarTodosMensajes = function(){
          $.ajax({
                 type: "POST",
                 url: "http://localhost/mvc/api/cargarMensaje?ajax=true",
                 data: {
                     id_agente : $('#IdAgente').val(),
                     id_usuario : $("#session").val()
                 }
             }).done(function(msg){
                 $("#chatClean").html('');
                 $("#contenedorChat ul").append(msg.msg);
             })
      }
       
    </script>

        

</head>
<body>
    <div class="container bootstrap snippet">
        
        <input type="hidden" name="envio" id="envio" value="1"></input>
        <?php
        echo "<input type='hidden' name='IdAgente' id='IdAgente' value='{$usuarios['id']}'></input>";
        echo "<input type='hidden' name='NomAgente' id='NomAgente' value='{$usuarios['name']}'></input>";
        echo "<input type='hidden' name='session' id='session' value='{$usuarios['id_conversacion']}'></input>";
        //foreach ($usuarios as $key => $usuario) {
            if($usuarios['disponible'] == 'on'){
                echo "<button class='btn btn-success no-rounded' id='btnInit' value='{$usuarios['id']}' type='button' style='position: absolute;right: 0px;'>No disponible</button>";
            }else{
                echo "<button class='btn btn-success no-rounded' id='btnInit' value='{$usuarios['id']}' type='button' style='position: absolute;right: 0px;'>Disponible</button>";
            }
        
         
            
      //  }
         ?>
      
        <div class="row">
            <div class="col-md-4 bg-white" id="allContainer" style="display:none">
                <div class="row border-bottom padding-sm" style="height: 40px;">
                   <h2 style="margin-left:20px"> Agentes Disponibles</h2>
                  
                </div>
                 <br>
                <!-- =============================================================== -->
                <!-- member list -->
                <ul class="friend-list">
                    
                </ul>
            </div>

            <!--=========================================================-->
            <!-- selected chat -->
            <div class="col-md-8 bg-white">
                <div class="chat-message" id="contenedorChat">
                    <ul class="chat" id="chatClean">
                       


                    </ul>
                </div>
                <div class="chat-box bg-white" style="margin-top: 400px;">
                    <div class="input-group">
                        <input class="form-control border no-shadow no-rounded" id="MsjEnviado" placeholder="Escriba su mensaje ...">
                        <span class="input-group-btn">
                            <button class="btn btn-success no-rounded" id="btnMensaje" type="button">Enviar</button>
                        </span>
                    </div><!-- /input-group -->
                </div>
            </div>
        </div>
    </div>

</body>

</html>