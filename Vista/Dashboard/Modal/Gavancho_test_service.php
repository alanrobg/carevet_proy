<div>
<?php
foreach ($reserva_destinoDAO->seleccionar_reserva_destino_listaRes($idreserva) as $k=>$mdest){
        $idreserva_destino = $mdest->getIdreserva_destino();
        $idreserva_m = $mdest->getIdreserva();
        $idiata = $mdest->getIdiata();
        $txtref = $mdest->getTexto_referencial_res_des();
        $codiata = $iataDAO->seleccionar_idiata(new iata($idiata, null, null, null, null, null))->getCod_iat();
        $pais = $iataDAO->seleccionar_idiata(new iata($idiata, null, null, null, null, null))->getPais_iat();
        $ciudad = $iataDAO->seleccionar_idiata(new iata($idiata, null, null, null, null, null))->getCiudad_iat();
        $aeropuerto = $iataDAO->seleccionar_idiata(new iata($idiata, null, null, null, null, null))->getAeropuerto_iat();
        $ubigeo = $iataDAO->seleccionar_idiata(new iata($idiata, null, null, null, null, null))->getUbigeo_iat();
            ?>
<div class="modal fade" id="addnewServicio<?=$idreserva_destino?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-title">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Agregar Servicio</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
              <div class="col-sm-12 col-md-12 col-lg-12">
                  <div class="input-group mb-3 tabcell">
                        <label style="flex-basis: 30%" class="col-form-label">Proveedor:</label>
                        <input class="form-control" type="text" name="buscador_proveedor" id="searchInput<?=$idreserva_destino?>" placeholder="Buscar...">
                  </div>
                    <script>
                    function searchSelectOptions() {
                    // Get the input and select elements
                    var input = document.getElementById('searchInput<?=$idreserva_destino?>');
                    var select = document.getElementById('provider<?=$idreserva_destino?>');

                    // Convert the input value to lowercase for case-insensitive search
                    var searchValue = input.value.toLowerCase();

                    // Loop through the select options
                    for (var i = 0; i < select.options.length; i++) {
                      var option = select.options[i];
                      var optionText = option.text.toLowerCase();

                      // Check if the option text contains the search value
                      if (optionText.indexOf(searchValue) > -1) {
                        // Option matches the search, show it
                        option.style.display = '';
                      } else {
                        // Option does not match the search, hide it
                        option.style.display = 'none';
                      }
                    }
                  }

                  // Attach an event listener to the search input
                  var searchInput = document.getElementById('searchInput<?=$idreserva_destino?>');
                  searchInput.addEventListener('input', searchSelectOptions);
                    </script>
                  <select class="form-select" id="provider<?=$idreserva_destino?>"  onchange="updateServices<?=$idreserva_destino?>()">
                        <option value="">Seleccionar...</option>
                        <?php
                        $vec = array();
                        foreach($proveedordao->seleccionar() as $proveedor){
                            $proveedor_tipo = $proveedor_tipodao->seleccionar_idproveedor_tipo(new proveedor_tipo($proveedor->getIdproveedor_tipo(), null));
                            $proveedor_cad = "";
                            switch ($proveedor_tipo->getIdproveedor_tipo()){
                                case 1: 
                                    $proveedor_cad.= $proveedor_tipo->getNombre_pro_tip()." ";
                                    $proveedor_cad.= $proveedor->getApellido_paterno_pro()." ";
                                    $proveedor_cad.= $proveedor->getApellido_materno_pro()." ";
                                    $proveedor_cad.= $proveedor->getNombre_pro()." ";
                                    $proveedor_cad.= $proveedor->getDni_pro()
                                    ;break;
                                case 2: 
                                    $proveedor_cad.= $proveedor_tipo->getNombre_pro_tip()." ";
                                    $proveedor_cad.= $proveedor->getRazon_social_pro()." ";
                                    $proveedor_cad.= $proveedor->getRuc_pro();
                                    ;break;
                            }
                            $servicios_vec = array();

                            foreach($serviciodao->seleccionar_idproveedor(new servicio(null, $proveedor->getIdproveedor(), null, null, null)) as $servicio){
                                $servicios_vec[] = [$servicio->getIdservicio(),$servicio->getNombre_ser()." ".$servicio_tipodao->seleccionar_idservicio_tipo(new servicio_tipo($servicio->getIdservicio_tipo(), null))->getNombre_ser_tip()];
                            }
                            $vec[$proveedor->getIdproveedor()] = $servicios_vec;
                            ?>
                        <option  class="articulo_proveedor"  value="<?=$proveedor->getIdproveedor()?>"><?=$proveedor_cad?></option>
                      <?php
                        }
                        ?>
                    </select>
                    
                    
                  <form action="../Procesos/p_destino_servicio.php?data=<?=$encoded_data?>&accion=create&idreserva=<?=$idreserva?>"
                        method="Post" enctype="multipart/form-data">
                        <input hidden="" type="text" name="idresdes" value="<?=$idreserva_destino?>">
                        <div class="input-group mb-3 tabcell">
                            <label style="flex-basis: 30%" class="input-group-text col-form-label">Servicio:<label style="color: red">*</label></label>
                            
                            <select id="service<?=$idreserva_destino?>" class="form-select" name="idservicio">
                                <option value="">Seleccionar...</option>
                            </select>
                            <script>
                            // Define the providers and services arrays
                            var providers = <?=json_encode($vec)?>;

                            // Function to update the services based on the selected provider
                            function updateServices<?=$idreserva_destino?>() {
                              var providerSelect = document.getElementById('provider<?=$idreserva_destino?>');
                              var serviceSelect = document.getElementById('service<?=$idreserva_destino?>');
                              var selectedProvider = providerSelect.value;

                              // Clear previous options
                              serviceSelect.innerHTML = '';

                              if (selectedProvider !== '') {
                                // Get the services array based on the selected provider
                                var selectedServices = providers[selectedProvider];

                                // Create new option elements for each service
                                for (var i = 0; i < selectedServices.length; i++) {
                                  var option = document.createElement('option');
                                  option.value = selectedServices[i][0];
                                  option.text = selectedServices[i][1];
                                  serviceSelect.appendChild(option);
                                }
                              }
                            }
                          </script>
                        </div>
                        <div class="input-group mb-3 tabcell">
                          <label style="flex-basis: 30%" class="input-group-text col-form-label">Fecha Inicio:<label style="color: red">*</label></label>
                          <input style="flex-basis: 70%" type="date" class="form-control" name="finicio_des_ser" value="" required="">
                        </div>
                        <div class="input-group mb-3 tabcell">
                          <label style="flex-basis: 30%" class="input-group-text col-form-label">Fecha Fin:<label style="color: red">*</label></label>
                          <input style="flex-basis: 70%" type="date" class="form-control" name="ffin_des_ser" value="" required="">
                        </div>
                        <div class="input-group mb-3 tabcell">
                          <label style="flex-basis: 30%" class="input-group-text col-form-label">Fee:<label style="color: red">*</label></label>
                          <input style="flex-basis: 70%" type="text" class="form-control" name="fee_des_ser" value="" required=""
                                 step="0.01" pattern="[0-9]+(\.[0-9]{1,2})?">
                        </div>
                        <div class="input-group mb-3 tabcell">
                          <label style="flex-basis: 30%" class="input-group-text col-form-label">Comision:<label style="color: red">*</label></label>
                          <input style="flex-basis: 70%" type="text" class="form-control" name="comision_des_ser" value="" required=""
                                 step="0.01" pattern="[0-9]+(\.[0-9]{1,2})?">
                        </div>
                        <div class="input-group mb-3 tabcell">
                          <label style="flex-basis: 30%" class="input-group-text col-form-label">Incentivo:<label style="color: red">*</label></label>
                          <input style="flex-basis: 70%" type="text" class="form-control" name="incentivo_des_ser" value="" required=""
                                 step="0.01" pattern="[0-9]+(\.[0-9]{1,2})?">
                        </div>
                        <div class="input-group mb-3 tabcell">
                          <label style="flex-basis: 30%" class="input-group-text col-form-label">IGV:<label style="color: red">*</label></label>
                          <input style="flex-basis: 70%" type="text" class="form-control" name="igv_des_ser" value="" required=""
                                 step="0.01" pattern="[0-9]+(\.[0-9]{1,2})?">
                        </div>
                        <div class="input-group mb-3 tabcell">
                          <label style="flex-basis: 30%" class="input-group-text col-form-label">Costo ($USD):<label style="color: red">*</label></label>
                          <input style="flex-basis: 70%" type="text" class="form-control" name="costo_des_ser" value="" required=""
                                 step="0.01" pattern="[0-9]+(\.[0-9]{1,2})?">
                        </div>
                        <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success">Crear</button>
                        </div>
                    </form>
                </div>

          </div>

        </div>
    </div>
</div>
<?php
}
?>
</div>