<div class="box">
	<div class="box-header">
		<h3 class="box-title">Agentes</h3>
	</div>
	<!-- /.box-header -->
	<div class="box-body">
		<div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
		<div class="row">
			
		</div>

		<div class="row">
			<div class="col-sm-12">
				<table id="example1" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
					<thead>
						<tr role="row">
							<th class="sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Rendering engine: activate to sort column descending" aria-sort="ascending" style="width: 249px;">ID</th>
							<th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Nombre: activar para ordenar por nombre acendente" style="width: 306px;">Nombre</th>
							<th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Edades: activar orden acendente" style="width: 271px;">Edad</th>
                            <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Email: activar orden acendente" style="width: 271px;">Email</th>					
                            <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Imagen: activar orden acendente" style="width: 271px;">Imagen</th>
                            <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Imagen: activar orden acendente" style="width: 271px;">Borrar</th>
                            <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Imagen: activar orden acendente" style="width: 271px;">Bloqueado</th>					
                    </thead>
					<tbody>

						  <?php  
							foreach ($usuarios as $key => $usuario) {
								$trCssClass = $key % 2 == 0 ? 'odd' : 'even';
								$linkToEdit = '../../mvc/user/update?id=' . $usuario['id'];
                                $imagen = base64_encode($usuario['imagen']);
								
								echo "<tr class='$trCssClass'>
                                       
										<td class='sorting_1'>
											<a href='$linkToEdit'>{$usuario['id']}</a>
										</td>
										<td>
											{$usuario['name']}
										</td>
										<td>
											{$usuario['age']}
										</td>
                                         <td>
											{$usuario['mail']}
										</td>
										<td>     
                                            <img height='50' width='50' src='data:text/plain;base64,$imagen'/>
										</td>                                                                                
										<td>";
                                        if($usuario['es_admin']!='on'){
											echo "<a href='#' class='delete' id='{$usuario['id']}'>Borrar</a>";
                                        }
										echo "</td>
                                        <td>";
                                        if($usuario['es_admin']!='on'){
                                            if($usuario['bloqueado']==='on')
                                            {
                                                echo "<a href='#' class='bloquear' id='{$usuario['id']}b'>Desbloquear</a>";
                                            }
                                            else 
                                            { 
                                                echo"<a href='#' class='bloquear' id='{$usuario['id']}b'>Bloquear</a>"  ;                                                                               
                                            } 
                                        }
                                            echo"</td>
									</tr>";
							}

						?>
	
					</tbody>

					<tfoot>
						
					</tfoot>

			</table>
		</div>
	</div>

	<div class="row">
        <?php
         $linkToConv = '../../mvc/chat/conv';    
		echo "<a href='$linkToConv' style='margin-left: 20px;'>Ver conversaciones</a>";
        ?>
	</div>
</div>
