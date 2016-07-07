<?php
 $base_url="http://".$_SERVER['SERVER_NAME'].'/mvc/';
?>
<html>
<head>
  
  <link rel="stylesheet" href="<?php echo $base_url; ?>views/frontend/chatRoom.css">
   <script src='http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js'></script>
    <script type="text/javascript">
 $(document).ready(function () {
     
        $('a').click(function (e) {
            e.preventDefault();
            $('#IdAgente').val($(this).attr('id'));
            $('#NomAgente').val($(this).text().trim());
            if (document.getElementById('chatConAgentes').style.display == 'none') {
                document.getElementById('chatConAgentes').style.display = '';
                
            }
            $.ajax({
                 type: "POST",
                 url: "http://localhost/mvc/api/updateIdConv?ajax=true",
                 data: {
                     id : $('#IdAgente').val(),
                     id_conversacion : $("#session").val()
                 }
             }).done(function(info){
                
             })
            
        });
          
        $("#envioEmail").on("click", function(e){
             e.preventDefault(); 
             $.ajax({
                 type: "POST",
                 url: "http://localhost/mvc/api/enviarEmail?ajax=true",
                 data: {
                     email : $("#email").val(),
                     asunto : $('#asunto').val(),
                     texto : $('#texto').val()
                 }
             }).done(function(info){
                 $("#email").val('');
                 $('#asunto').val('');
                 $('#texto').val('');
                 alert(info.msg);
             })
          });
          
                    
        $('#btnInit').click(function () {
            
                        if (document.getElementById('allContainer').style.display == 'none') {
                            document.getElementById('allContainer').style.display = '';
                           
                        }
                       
                    });     
                    
         $('#btnFinalizar').click(function () {
            
                        if (document.getElementById('allContainer').style.display == '') {
                            document.getElementById('allContainer').style.display = 'none';
                           
                        }
                       
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
      <button class="btn btn-success no-rounded" id="btnInit" type="button" style="position: absolute;right: 0px;">Comenzar</button>
        <input type="hidden" name="IdAgente" id="IdAgente" value=""></input>
        <input type="hidden" name="NomAgente" id="NomAgente" value=""></input>
        <input type="hidden" name="envio" id="envio" value="0"></input>
        <div class="row" id="allContainer" style="display:none">
            <div class="col-md-4 bg-white ">
                <div class="row border-bottom padding-sm" style="height: 40px;">
                  <?php
                  //$usuarios= null;
                   if($usuarios != null){
                    echo '<h2 style="margin-left:20px"> Agentes Disponibles</h2>';
                   }
                  ?> 
                </div>
                 <br>
                <!-- =============================================================== -->
                <!-- member list -->
                <ul class="friend-list">
                    <?php
                   
                    
                   
                    echo "<input type='hidden' name='session' id='session' value='$r'></input>";
                    
                    if($usuarios != null){
                        foreach ($usuarios as $key => $usuario) {
                                    //$trCssClass = $key % 2 == 0 ? 'odd' : 'even';
                                    //$linkToEdit = '../../mvc/user/update?id=' . $usuario['id'];
                                    //.base64_encode( $usuario['imagen'] ).
                                   if($usuario['id'] != 1){  
                                     $imagen =base64_encode($usuario['imagen']);
                                    echo "<li>
                                            <a href='#{$usuario['id']}' id='{$usuario['id']}' class='clearfix'>
                                                <img src='data:image/jpeg;base64,$imagen' alt='' class='img-circle'/>
                                                <div class='friend-name'>
                                                   {$usuario['name']}
                                                </div>
                                            </a>
                                            
                                           </li>";
                                   }
                                }
                      ?>            
                  </ul>
                  <?php
                    }else{
                        
                    echo  '<div class="form-group"><div id="erre" style="color:red; font-size:12px; display:inline "></div>
                        <input type="email" class="form-control"  name="email" id="email" placeholder="Email">
                      </div>
                      <div class="form-group"><div id="errn" style="color:red; font-size:12px; display:inline "></div>
                        <input type="text" class="form-control"   name="asunto" id="asunto" placeholder="Asunto">
                      </div>
		               <div class="form-group"><div id="errq" style="color:red; font-size:12px; display:inline "></div>
                       	<textarea class="form-control"  name="texto" id="texto" placeholder="Escriba aqui ..."></textarea>
                      </div>
                      <button type="submit" name="envioEmail" id="envioEmail" class="btn btn-default">Enviar</button>';
                        
                    }
                  ?>
            </div>

            <!--=========================================================-->
            <!-- selected chat -->
            <div class="col-md-8 bg-white " id="chatConAgentes" style="display:none">
                <div class="chat-message" id="contenedorChat">
                    <ul class="chat" id="chatClean">
                       


                    </ul>
                </div>
                <div class="chat-box bg-white" style="margin-top: 400px;">
                    <div class="input-group">
                        <input class="form-control border no-shadow no-rounded" id="MsjEnviado" placeholder="Escriba su mensaje ...">
                        <span class="input-group-btn">
                            <button class="btn btn-success no-rounded" id="btnMensaje" type="button">Enviar</button>
                            <button class="btn btn-success no-rounded" id="btnFinalizar" type="button">Finalizar</button>
                        </span>
                    </div><!-- /input-group -->
                </div>
            </div>
        </div>
    </div>

</body>

</html>