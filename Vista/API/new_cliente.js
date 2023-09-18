
const form = document.querySelector('#formulario1');
const btnAgregar = document.querySelector('#btnAgregar'); // Selecciona el botón "Agregar"
const btnParche  = document.querySelector('#btnActualizar');

btnAgregar.addEventListener('click', async (event) => {
    event.preventDefault(); // Evita la acción por defecto del botón

    // Obtén los datos del formulario
    const apellidoCli = form.querySelector('[name="apellido_cli"]').value;
    const nombreCli = form.querySelector('[name="nombre_cli"]').value;
    const dniCli = form.querySelector('[name="dni_cli"]').value;
    const nacimientoCli = form.querySelector('[name="nacimiento_cli"]').value;
    const direccionCli = form.querySelector('[name="direccion_cli"]').value;
    const telefonoCli = form.querySelector('[name="telefono_cli"]').value;
    const correoCli = form.querySelector('[name="correo_cli"]').value;
    const id_usuario = form.querySelector('[name="idusuario"]').value;
    
    // Crea un objeto con los datos del nuevo servicio
    const nuevoCliente = {
        apellido_cli: apellidoCli,
        nombre_cli: nombreCli,
        dni_cli: dniCli,
        nacimiento_cli: nacimientoCli,
        direccion_cli: direccionCli,
        telefono_cli: telefonoCli,
        correo_cli: correoCli,
        idusuario: id_usuario
    };
    console.log("apellido_cli: ",apellidoCli);
    console.log("nombre_cli: ",nombreCli);
    console.log("dni_cli: ",dniCli);
    console.log("nacimiento_cli: ",nacimientoCli);
    console.log("direccion_cli: ",direccionCli);
    console.log("telefono_cli: ",telefonoCli);
    console.log("correo_cli: ",correoCli);
    console.log("idusuario: ",id_usuario);
    try {
        // Realiza una solicitud POST a la API externa
        const response = await fetch('http://localhost/CareVet_Proy/Vista/Procesos/p_api_cliente.php?accion=create', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(nuevoCliente)
        });

        // Muestra la respuesta en la consola
        console.log('Respuesta de la API:', await response.json());
        
        if (response.ok) {
            // El servicio se creó con éxito, puedes hacer algo aquí, como cerrar el modal o mostrar un mensaje de éxito.
            console.log('Servicio creado con éxito');
            $('#newcliente').modal('hide'); // Cierra el modal
            btnParche.click(); // Simula un clic en el botón de actualización
            // Recargar la página actual
            // location.reload();
        } else {
            // Ocurrió un error al crear el servicio, maneja el error aquí.
            console.error('Error al crear el servicio');
            console.error('Error al crear el servicio. Código de estado:', response.status);
        }
    } catch (error) {
        console.error('Error de red', error);
    }
});