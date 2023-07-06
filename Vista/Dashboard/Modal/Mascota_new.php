<div class="modal fade" id="newMascota" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-title">
        <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Nueva Mascota</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="../Procesos/p_mascota.php?data=<?=$encoded_data?>&accion=create" method="Post" enctype="multipart/form-data">
                <div class="col-sm-12 col-md-12 col-lg-12">
                    <div class="input-group mb-3">
                        <label style="flex-basis: 40%" class="input-group-text">Nombre:</label>
                        <input style="flex-basis: 60%" type="text" class="form-control" name="nombre" value="" required="">
                    </div>
                    <div class="input-group mb-3">
                        <label style="flex-basis: 40%" class="input-group-text">Cliente:</label>
                        <select style="flex-basis: 60%" class="form-select"  name="idcli" required="" required="">
                            <option value="">Seleccione un Cliente</option>
                            <?php
                            foreach ($clienteDAO->seleccionar() as $kcli=>$dcli) {
                                $cad = "";
                                $cad2 = "";
                                if($dcli->getIdusuario()==$cad){
                                    $cad2 = "selected";
                                }else{
                                    $cad2 = "";
                                }
                                /*DATOS DEL CLIENTE*/
                                $name = $dcli->getNombre_cli(); $apellido = $dcli->getApellido_cli();
                                echo "<option value=".$dcli->getIdcliente()." ".$cad2.">"." ".$name." ".$apellido."</option>";
                                }
                            ?>
                        </select>
                    </div>
                    <div class="input-group mb-3">
                        <label style="flex-basis: 40%" class="input-group-text">Nacimiento:</label>
                        <input style="flex-basis: 60%" type="date" class="form-control" name="nacimiento" value="" required="">
                    </div>
                    <div class="input-group mb-3">
                        <label style="flex-basis: 40%" class="input-group-text">Color:</label>
                        <input style="flex-basis: 60%" type="text" class="form-control" name="color" value="" required="">
                    </div>
                    <div class="input-group mb-3">
                        <label style="flex-basis: 40%" class="input-group-text">Foto:</label>
                        <input style="flex-basis: 60%" type="file" class="form-control" name="fileToUpload" value="" required="">
                    </div>
                    <div class="input-group mb-3">
                        <label style="flex-basis: 40%" class="input-group-text">Esterilizado:</label>
                        <select style="flex-basis: 60%" class="form-select"  name="esterilizado" required="" required="">
                            <option value="">Seleccione</option>
                            <option value="Si">Esterilizado</option>
                            <option value="No">No Esterilizado</option>
                        </select>
                    </div>
                    
                    <div class="input-group mb-3">
                        <label style="flex-basis: 40%" class="input-group-text">Especie:</label>
                        <input style="flex-basis: 60%" type="text" class="form-control" value="" required="">
                    </div>
                    <div class="input-group mb-3">
                        <label style="flex-basis: 40%" class="input-group-text">Raza:</label>
                        <input style="flex-basis: 60%" type="text" class="form-control" name="raza" value="" required="">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Agregar</button>
                    </div>
                </div>
            </form>
        </div>
        </div>
    </div>
</div>