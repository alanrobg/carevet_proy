let dataTable;
let dataTableIsInitialized = false;

const dataTableOptions = {
    //scrollX: "2000px",
    lengthMenu: [5, 10, 15, 20, 100, 200],
    destroy: true,
    language: {
            processing: 'Procesando...',
            lengthMenu: 'Mostrar _MENU_ registros',
            zeroRecords: 'No se encontraron resultados',
            info: "Mostrando _START_ a _END_ de _TOTAL_ registros",
            emptyTable: 'Ningún dato disponible en esta tabla',
            infoEmpty: 'Mostrando registros del 0 al 0 de un total de 0 registros',
            infoFiltered: '(filtrado de un total de _MAX_ registros)',
            search: 'Buscar:',
            infoThousands: ',',
            loadingRecords: 'Cargando...',
            responsive: true,
            paging: false,
            searching: false,
            paginate: {
              first: 'Primero',
              last: 'Último',
              next: 'Siguiente',
              previous: 'Anterior'
            }
        }
};

const initDataTable = async () => {
    if (dataTableIsInitialized) {
        dataTable.destroy();
    }
    // Luego de agregar un servicio con éxito o actualizar la lista
    // Limpiar los campos del modal
    document.querySelector('[name="apellido_cli"]').value = '';
    document.querySelector('[name="nombre_cli"]').value = '';
    document.querySelector('[name="dni_cli"]').value = '';
    document.querySelector('[name="nacimiento_cli"]').value = '';
    document.querySelector('[name="direccion_cli"]').value = '';
    document.querySelector('[name="telefono_cli"]').value = '';
    document.querySelector('[name="correo_cli"]').value = '';
    await listService();

    dataTable = $("#data_table").DataTable(dataTableOptions);

    dataTableIsInitialized = true;
};

const listService = async () => {
    try {
        const response = await fetch("http://localhost/CareVet_Proy/Vista/API/test.php");
        const clientes = await response.json();

        let content = ``;
        clientes.forEach((cliente) => {
            content += `
                <tr>
                    <td>${cliente.idcliente}</td>
                    <td>${cliente.apellido_cli}</td>
                    <td>${cliente.nombre_cli}</td>
                    <td>${cliente.dni_cli}</td>
                    <td>${cliente.nacimiento_cli}</td>
                    <td>${cliente.direccion_cli}</td>
                    <td>${cliente.telefono_cli}</td>
                </tr>`;
        });
        table_service.innerHTML = content;
    } catch (ex) {
        alert(ex);
    }
};

window.addEventListener("load", async () => {
    await initDataTable();
    
});


// Obtén el botón de actualizar
const btnActualizar = document.querySelector('#btnActualizar');

// Define una bandera para rastrear si la actualización está en progreso
let actualizacionEnProgreso = false;

// Escucha el evento de clic en el botón "Actualizar"
btnActualizar.addEventListener('click', async () => {
    // Verifica si la actualización ya está en progreso, si es así, no hagas nada
    if (actualizacionEnProgreso) {
        return;
    }

    // Deshabilita el botón de actualización
    btnActualizar.disabled = true;

    try {
        // Llama a la función para actualizar la lista
        await initDataTable();
        // Luego de agregar un servicio con éxito o actualizar la lista
        // Limpiar los campos del modal
        document.querySelector('[name="apellido_cli"]').value = '';
        document.querySelector('[name="nombre_cli"]').value = '';
        document.querySelector('[name="dni_cli"]').value = '';
        document.querySelector('[name="nacimiento_cli"]').value = '';
        document.querySelector('[name="direccion_cli"]').value = '';
        document.querySelector('[name="telefono_cli"]').value = '';
        document.querySelector('[name="correo_cli"]').value = '';
        console.log('Lista de Clientes actualizada');

    } catch (error) {
        console.error('Error al actualizar la lista:', error);
    } finally {
        // Habilita el botón de actualización nuevamente
        btnActualizar.disabled = false;
    }
});
