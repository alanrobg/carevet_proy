<div class="modal fade" id="update<?=$idconsulta?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-title">
        <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Editar Consulta</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="../Procesos/p_consulta.php?data=<?=$encoded_data?>&accion=update&idconsulta=<?=$idconsulta?>" method="Post" enctype="multipart/form-data">
                <div class="col-sm-12 col-md-12 col-lg-12">
                    <input type="text" value="<?=$usuario->getIdusuario()?>" name="idusuario" readonly="" hidden="">
                    <div class="input-group mb-3">
                        <label style="flex-basis: 40%" class="input-group-text">Veterinario:<label style="color: red">*</label></label>
                        <select style="flex-basis: 60%" class="form-select"  name="idusu" required="">
                              <option value="">Seleccione un Veterinario</option>
                              <?php
                              foreach ($usuarioDAO->seleccionarxVeterinario() as $kvet=>$dvet) {
                                  $cad = "";
                                  $cad2 = "";
                                  if($dvet->getIdusuario() == $idtrabajador){
                                      $cad2 = "selected";
                                  }else{
                                      $cad2 = "";
                                  }
                                  ///DATOS DE TITULO
                                  $name = $dvet->getNombre_usuario(); $apellido = $dvet->getApellido_usuario();
                                  echo "<option value=".$dvet->getIdusuario()." ".$cad2.">".$name." ".$apellido."</option>";
                                  }
                              ?>
                          </select>
                    </div>
                    <div class="input-group mb-3">
                        <label style="flex-basis: 40%" class="input-group-text">Cliente:<label style="color: red">*</label></label>
                        <select style="flex-basis: 60%" class="form-select"  name="idcliente" required="" onchange="actualizarClienteMascota()">
                              <option value="">Seleccione un Cliente</option>
                              <?php
                              foreach ($clienteDAO->seleccionar() as $kcli=>$dcli) {
                                  $cad = "";
                                  $cad2 = "";
                                  if($dcli->getIdcliente() == $idcliente){
                                      $cad2 = "selected";
                                  }else{
                                      $cad2 = "";
                                  }
                                  ///DATOS DE TITULO
                                  $name = $dcli->getNombre_cli(); $apellido = $dcli->getApellido_cli();
                                  echo "<option value=".$dcli->getIdcliente()." ".$cad2.">".$name." ".$apellido."</option>";
                                  }
                              ?>
                          </select>
                    </div>
                    <div class="input-group mb-3">
                        <label style="flex-basis: 40%" class="input-group-text">Mascota:<label style="color: red">*</label></label>
                        <select style="flex-basis: 60%" class="form-select" name="idmascota" required="" id="selectMascotas">
                            <option value="">Seleccione una Mascota</option>
                            <?php
                                foreach ($mascotaDAO->seleccionar() as $kmascota=>$dmascota) {
                                    $cad = "";
                                    $cad2 = "";
                                    if($dmascota->getIdmascota() == $idmascota){
                                        $cad2 = "selected";
                                    }else{
                                        $cad2 = "";
                                    }
                                    $raza = $razaDAO->seleccionar_idraza(new raza($dmascota->getIdraza(), null, null));
                                    $especie = $especieDAO->seleccionar_idespecie(new especie($raza->getIdespecie(), null));
                                    ///DATOS DE TITULO
                                    echo "<option value=".$dmascota->getIdmascota()." ".$cad2.">".$dmascota->getNom_mascota()."</option>";
                                }
                            ?>
                        </select>
                    </div>
                    <div class="input-group mb-3">
                        <label style="flex-basis: 40%" class="input-group-text">Comentario:</label>
                        <textarea class="form-control" cols="20" rows="3" name="comentario"><?=$com?></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Editar</button>
                    </div>
                </div>
            </form>
        </div>
        </div>
    </div>
</div>

<script>
function actualizarClienteMascota() {

  const clienteSelect = document.getElementById('idcliente');
  const mascotaSelect = document.getElementById('selectMascotas');
  const clienteSeleccionado = clienteSelect.value;
  console.log('consolano1', clienteSeleccionado)
  // Limpiamos el select de subcategoría
  mascotaSelect.innerHTML = '';

  // Si no se ha seleccionado una categoría, no hay subcategorías
  if (!clienteSeleccionado) {
    return;
  }

  // Llamada AJAX para obtener las subcategorías dependientes del backend (PHP)
  const xhr = new XMLHttpRequest();
  const url = `../../api/mascotas/select-cliente-mascota.php?cliente_id=${clienteSeleccionado}`;
  console.log('consolano')
  xhr.open('GET', url);
  xhr.onreadystatechange = function () {
    if (xhr.readyState === XMLHttpRequest.DONE) {
      if (xhr.status === 200) {
        console.log('responsete:', xhr.responseText)
        const mascotas = JSON.parse(xhr.responseText);

        // Agregamos las opciones de subcategoría al select
        mascotas.forEach((mascota) => {
          const option = document.createElement('option');
          option.value = mascota.id;
          option.text = mascota.name;
          mascotaSelect.appendChild(option);
        });
      } else {
        console.error('Error al obtener las subcategorías.');
      }
    }
  };


  xhr.send();
}
</script>