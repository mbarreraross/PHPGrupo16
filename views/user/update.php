<div class="row">
    <div class="col-md-6">
        <!-- general form elements -->
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Editar Usuario</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" action="/mvc/user/update" method="POST">
                <div class="box-body">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Usuario</label>
                        <input type="text" class="form-control" name="name" id="name" placeholder="Enter username" value="<?php echo $user->getName(); ?>">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Password</label>
                        <input type="password" class="form-control" name="password" id="exampleInputPassword1" placeholder="Password" value="<?php echo $user->getPassword(); ?>">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputFile">Edad</label>
                        <input type="text" class="form-control" name="age" id="age" placeholder="Enter username" value="<?php echo $user->getAge(); ?>">
                    </div>
                     <div class="form-group">
                         <label for="exampleInputEmail">E-mail</label>
                         <input type="mail" class="form-control" name="mail" value="<?php echo $user->getmail(); ?>"/>
                    </div>
                    <div align="center"><label for="hora_inicio">Horario Inicio</label></div>
                    <div align="center">

                        <input type="time" name="hora_inicio" value="<?php echo $user->gethora_inicio(); ?>"/>
                    </div>
                    <div align="center"><label for="hora_fin">Horario Fin</label></div> 
                    <div align="center">
                        <input type="time" name="hora_fin" value="<?php echo $user->gethora_fin(); ?>"/>
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
                                    <input type="hidden" name="lunes" id="lunes" value=""/> 
                                    <?php
                                    if ($user->getlunes() == 'on') {
                                        ?>
                                        <input type="checkbox" name="lunes" id="lunes" onchange="contarSeleccionados()" checked/>
                                        <?php
                                    } else {
                                        ?>
                                        <input type="checkbox" name="lunes" id="lunes" onchange="contarSeleccionados()"/>
                                        <?php
                                    }
                                    ?>
                                </td>
                                <td>
                                    <input type="hidden" name="martes" id="martes" value=""/> 
                                    <?php
                                    if ($user->getmartes() == 'on') {
                                        ?>
                                        <input type="checkbox" name="martes" id="martes" onchange="contarSeleccionados()" checked/>                                                                                
                                        <?php
                                    } else {
                                        ?>
                                        <input type="checkbox" name="martes" id="martes" onchange="contarSeleccionados()"/>
                                        <?php
                                    }
                                    ?>                                            
                                </td>      
                                <td>
                                    <input type="hidden" name="miercoles" id="miercoles" value=""/> 
                                    <?php
                                    if ($user->getmiercoles() == 'on') {
                                        ?>
                                        <input type="checkbox" name="miercoles" id="miercoles" onchange="contarSeleccionados()" checked/>
                                        <?php
                                    } else {
                                        ?>
                                        <input type="checkbox" name="miercoles" id="miercoles" onchange="contarSeleccionados()"/>
                                        <?php
                                    }
                                    ?>
                                </td>      
                                <td>
                                    <input type="hidden" name="jueves" id="jueves" value=""/> 
                                    <?php
                                    if ($user->getjueves() == 'on') {
                                        ?>
                                        <input type="checkbox" name="jueves" id="jueves"  onchange="contarSeleccionados()" checked/>
                                        <?php
                                    } else {
                                        ?>
                                        <input type="checkbox" name="jueves" id="jueves" onchange="contarSeleccionados()"/>
                                        <?php
                                    }
                                    ?>
                                </td>
                                <td>
                                    <input type="hidden" name="viernes" id="viernes" value=""/> 
                                    <?php
                                    if ($user->getviernes() == 'on') {
                                        ?>
                                        <input type="checkbox" name="viernes" id="viernes" onchange="contarSeleccionados()" checked/>
                                        <?php
                                    } else {
                                        ?>
                                        <input type="checkbox" name="viernes" id="viernes" onchange="contarSeleccionados()"/>
                                        <?php
                                    }
                                    ?>
                                </td>
                                <td>
                                    <input type="hidden" name="sabado" id="sabado" value=""/> 
                                    <?php
                                    if ($user->getsabado() == 'on') {
                                        ?>
                                        <input type="checkbox" name="sabado" id="sabado" onchange="contarSeleccionados()" checked/>
                                        <?php
                                    } else {
                                        ?>
                                        <input type="checkbox" name="sabado" id="sabado" onchange="contarSeleccionados()"/>
                                        <?php
                                    }
                                    ?>
                                </td>
                                <td>
                                    <input type="hidden" name="domingo" id="domingo" value=""/> 
                                    <?php
                                    if ($user->getdomingo() == 'on') {
                                        ?>
                                        <input type="checkbox" name="domingo" id="domingo" onchange="contarSeleccionados()" checked/>
                                        <?php
                                    } else {
                                        ?>
                                        <input type="checkbox" name="domingo" id="domingo" onchange="contarSeleccionados()"/>
                                        <?php
                                    }
                                    ?>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <input type="hidden" name="id" value="<?php echo $user->getId(); ?>" />
                    <button type="submit" name="update" class="btn btn-primary">Guardar</button>
                </div>
            </form>
        </div>
        <!-- /.box -->
    </div>
</div>
<script>
    function contarSeleccionados()
    {
        if (document.getElementById('lunes').checked)
        {
            document.getElementById('lunes').value = "on";
        } else
        {
            document.getElementById('lunes').value = "off";
        }
        if (document.getElementById('martes').checked)
        {
            document.getElementById('martes').value = "on";
        } else
        {
            document.getElementById('martes').value = "off";
        }
        if (document.getElementById('miercoles').checked)
        {
            document.getElementById('miercoles').value = "on";
        } else
        {
            document.getElementById('miercoles').value = "off";
        }
        if (document.getElementById('jueves').checked)
        {
            document.getElementById('jueves').value = "on";
        } else
        {
            document.getElementById('jueves').value = "off";
        }
        if (document.getElementById('viernes').checked)
        {
            document.getElementById('viernes').value = "on";
        } else
        {
            document.getElementById('viernes').value = "off";
        }
        if (document.getElementById('sabado').checked)
        {
            document.getElementById('sabado').value = "on";
        } else
        {
            document.getElementById('sabado').value = "off";
        }
        if (document.getElementById('domingo').checked)
        {
            document.getElementById('domingo').value = "on";
        } else
        {
            document.getElementById('domingo').value = "off";
        }

    }
    function devolver($variable) {

        if ($variable == 'lunes') {
            alert($variable);
            if ($lunes == '0') {
                $lunes = 'on';
            } else {
                $lunes = '0';
                alert($variable);
            }
        }
    }
</script>
