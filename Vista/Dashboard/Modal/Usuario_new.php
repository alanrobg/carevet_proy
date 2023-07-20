<div class="modal fade" id="newUsuario" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-title">
        <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Nuevo Usuario</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="../Procesos/p_usuario1.php?data=<?=$encoded_data?>&accion=create" method="Post" enctype="multipart/form-data">
                <div class="col-sm-12 col-md-12 col-lg-12">
                    <div class="input-group mb-3">
                      <label style="flex-basis: 40%" class="input-group-text">Apellido:</label>
                      <input style="flex-basis: 60%" type="text" class="form-control" name="apellido_usu" value="">
                    </div>
                    <div class="input-group mb-3">
                      <label style="flex-basis: 40%" class="input-group-text">Nombre:</label>
                      <input style="flex-basis: 60%" type="text" class="form-control" name="nombre_usu" value="">
                    </div>
                    <div class="input-group mb-3">
                      <label style="flex-basis: 40%" class="input-group-text">DNI:</label>
                      <input style="flex-basis: 60%" type="number" class="form-control" name="dni_usu" id="dni_usu" value="" maxlength="10" onchange="minLengthDNI()" oninput="maxLengthDNI()">
                    </div>
                    <div class="input-group mb-3">
                      <label style="flex-basis: 40%" class="input-group-text">Dirección:</label>
                      <input style="flex-basis: 60%" type="text" class="form-control" name="direccion" value="">
                    </div>
                    <div class="input-group mb-3">
                      <label style="flex-basis: 40%" class="input-group-text">Fecha de Nacimiento:</label>
                      <input style="flex-basis: 60%" type="date" class="form-control" name="nacimiento" value="">
                    </div>
                   <div class="input-group mb-3">
                      <label style="flex-basis: 40%" class="input-group-text">Telefono:</label>
                      <input style="flex-basis: 60%" type="text" class="form-control" name="telefono" id="telefono" value="" maxlength="10" onchange="minLengthTelefono()" oninput="maxLengthTelefono()">
                    </div>
                    <div class="input-group mb-3">
                      <label style="flex-basis: 40%" class="input-group-text">Correo:</label>
                      <input style="flex-basis: 60%" type="text" class="form-control" name="correo" id="correo" value="" onchange="validateEmail()">
                    </div>
                    <div class="input-group mb-3">
                      <label style="flex-basis: 40%" class="input-group-text">Contrato:</label>
                      <select class="form-select"  name="contrato" required="" >
                          <option value="TP">Temporal</option>
                          <option value="PR">Permanente</option>
                      </select>
                    </div>
                    
                    <div class="input-group mb-3">
                          <label style="flex-basis: 40%" class="input-group-text">Tipo Cliente:<label style="color: red">*</label></label>
                          <select class="form-select"  name="idarea" required="" >
                                <option value="">Seleccione un tipo</option>
                                <?php
                                foreach ($usuarioDAO_area->seleccionar() as $kcliup => $dcliup) {
                                    echo "<option value=" . $dcliup->getIdusuario_area() . ">" . $dcliup->getNom_area() . "</option>";
                                }
                                ?>
                            </select>
                    </div>
                    <div class="input-group mb-3">
                      <label style="flex-basis: 40%" class="input-group-text">Usuario:</label>
                      <input style="flex-basis: 60%" type="text" class="form-control" name="usuario" value="">
                    </div>
                    
                    <div class="input-group mb-3">
                      <label style="flex-basis: 40%" class="input-group-text">Contraseña:</label>
                      <input style="flex-basis: 60%" type="password" class="form-control" name="password" value="">
                    </div>
                    
                    <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" onclick="validateEmail()">Agregar</button>
                    </div>
                </div>
            </form>
        </div>
        </div>
    </div>
</div>

<script>
    function maxLengthDNI() {
      const inputElement = document.getElementById('dni_usu');
      const maxLength = parseInt(inputElement.getAttribute('maxlength'), 10);

      const inputValue = inputElement.value;
      const length = inputValue.length;
      console.log('cos:', maxLength)

      if (length > maxLength) {
        alert(`La longitud máxima permitida es ${maxLength} caracteres.`);
        inputElement.value = inputValue.substring(0, maxLength);
      }
    }

    function minLengthDNI() {
      const inputElement = document.getElementById('dni_usu');
      const maxLength = parseInt(inputElement.getAttribute('maxlength'), 10);

      const inputValue = inputElement.value;
      const length = inputValue.length;
      console.log('cos:', maxLength)

      if (length < maxLength-2) {
        alert(`La longitud mínima es ${maxLength-2}.`);
        inputElement.value = inputValue.substring(0, maxLength);
      }
    }

    function maxLengthTelefono() {
      const inputElement = document.getElementById('dni_usu');
      const maxLength = parseInt(inputElement.getAttribute('maxlength'), 10);

      const inputValue = inputElement.value;
      const length = inputValue.length;
      console.log('cos:', maxLength)

      if (length > maxLength) {
        alert(`La longitud máxima permitida es ${maxLength} caracteres.`);
        inputElement.value = inputValue.substring(0, maxLength);
      }
    }

    function minLengthTelefono() {
      const inputElement = document.getElementById('dni_usu');
      const maxLength = parseInt(inputElement.getAttribute('maxlength'), 10);

      const inputValue = inputElement.value;
      const length = inputValue.length;
      console.log('cos:', maxLength)

      if (length < maxLength-2) {
        alert(`La longitud mínima es ${maxLength-2}.`);
        inputElement.value = inputValue.substring(0, maxLength);
      }
    }

    function validateEmail() {
      const emailInput = document.getElementById('correo');
      const email = emailInput.value.trim(); // Eliminamos espacios en blanco al inicio y al final

      // Expresión regular para verificar el formato de una dirección de correo electrónico
      const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

      if (!emailPattern.test(email)) {
        alert('Por favor, ingresa una dirección de correo electrónico válida.');
      } 
    }
  </script>