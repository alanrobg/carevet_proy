<div>
<?php
foreach ($vacunaDAO->seleccionar() as $kvac=>$dvac){
    $idvac = $dvac->getIdvacuna();
    $nom = $dvac->getNom_vacuna();
    $des = $dvac->getDes_vacuna();
    ?>

<div class="modal fade" id="updatevac<?=$idvac?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-title">
        <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Editar Vacuna</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="../Procesos/p_vacuna2.php?data=<?=$encoded_data?>&idvac=<?=$idvac?>&accion=update" method="Post" enctype="multipart/form-data">
                <div class="col-sm-12 col-md-12 col-lg-12">
                    <div class="input-group mb-3">
                      <label style="flex-basis: 40%" class="input-group-text">Nombre:</label>
                      <input style="flex-basis: 60%" type="text" class="form-control" name="nom_vacuna" value="<?=$nom?>">
                    </div>
                    <div class="input-group mb-3">
                      <label style="flex-basis: 40%" class="input-group-text">Descripción:</label>
                      <input style="flex-basis: 60%" type="text" class="form-control" name="des_vacuna" value="<?=$des?>">
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
    <!-- FIN_VENTANA_EMERGENTE---------------------------------------------------------------------------------------- -->
<?php
}
?>
</div>