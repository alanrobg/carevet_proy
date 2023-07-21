<div class="modal fade" id="listaVacuna" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-title">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Lista Vacunas</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table border="1" width="100%" class="table">
                        <thead>
                            <tr>
                                <th>Nombre de Vacuna</th>
                                <th>Fecha Aplicacion</th>
                                <th>Fecha Prox. Aplicacion</th>
                                <th>Observación</th>
                            </tr>
                        </thead>
                        <!--FOREACH-->
                        <?php
                        $idmascota;
                        foreach ($detalle_vacunaDAO->seleccionar($idmascota) as $k=>$d){
                            
                            //DATOS DE SERVICIO
                            $nomvacuna=$d->getNomvacuna();
                            $desvacuna=$d->getDesvacuna();
                            $fechavac=$d->getFechadetalle();
                            $fechaproxvac=$d->getFechaproxdetalle();
                            $obsvacuna=$d->getObsvacuna();
                        ?>
                        <tr class="articulo">
                            <td><?=$nomvacuna?></td>
                            <td><?=$desvacuna?></td>
                            <td><?=$fechavac?></td>
                            <td><?=$fechaproxvac?></td>
                            <td><?=$obsvacuna?></td>
                            
                        </tr>
                        <?php    
                        }

                        ?>
                    <!--FIN FOREACH-->
                </table>
            </div>
        </div>
    </div>
</div>

