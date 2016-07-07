<?php 

?>

<form action="/mvc/user/save" enctype="multipart/form-data" method="POST">
<div align="center"><label for="name">Nombre</label></div>
<div align="center"><input type="text" name="name"  /></div>
<div align="center"><label for="password">Password</label></div>
<div align="center"><input type="password" name="password" /></div>
 <div align="center"> 
   <label for="age">Edad</label>
 </div>
 <div align="center">
   <input type="text" name="age" />
 </div>

 <div align="center"><label for="mail">E-mail</label></div>
 <div align="center">
   <input type="mail" name="mail" />
 </div>
 <div align="center"><label for="hora_inicio">Horario Inicio</label></div>
 <div align="center">
   <input type="time" name="hora_inicio" />
 </div>
 <div align="center"><label for="hora_fin">Horario Fin</label></div>
 <div align="center">
   <input type="time" name="hora_fin" />
 </div>
 <div align="center">
   <div>
     <label align="center">Imagen</label>
   </div>
   <div align="center">
     <input id="inputFile" type="file" name="imagen" accept="image/*" onchange="CargarImagen()" />   
   
     <!--<img id="ImgCarga" align="middle" style="width:120px;height:120px" src="~/favicon.ico" alt="Me"/>
     <input id="dataImg" type="hidden" value=""/>-->
   </div>
 </div>
   <hr/>
   <div>
     <div align="center"><label for="jornada" >Jornada laboral</label>
     </div>
     <table id="example1" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
       <thead>
         <tr>
           <th width="2%">Lunes</th>
           <th width="2%">Martes</th>
           <th width="2%">Miercoles</th>
           <th width="2%">Jueves</th>
           <th width="2%">Viernes</th>
           <th width="2%">Sabado</th>
           <th width="2%">Domingo</th>
         </tr>
       </thead>
       <tbody>
         <tr>
           <td>
             <input type="checkbox" name="lunes" id="lunes"/>
           </td>
           <td>
             <input type="checkbox" name="martes" id="martes"/>
           </td>
           <td>
             <input type="checkbox" name="miercoles" id="miercoles"/>
           </td>
           <td>
             <input type="checkbox" name="jueves" id="jueves"/>
           </td>
           <td>
             <input type="checkbox" name="viernes" id="viernes"/>
           </td>
           <td>
             <input type="checkbox" name="sabado" id="sabado"/>
           </td>
           <td>
           <input type="checkbox"  name="domingo" id="domingo"/>
           </td>
       </tr>
      </tbody>
    </table>
   </div>
   <input id="bloqueado" name="bloqueado" type="hidden" for="bloqueado" value="off"/>
   <input id="disponible" name="disponible" type="hidden" for="disponible" value="off"/>
 
 

<input type="submit" name='enviar' value="Guardar"/>
</form>    