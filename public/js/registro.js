document.addEventListener('DOMContentLoaded', function() {
    // Obtén todos los botones con la clase .show-record-btn
    document.querySelectorAll('.show-record-btn').forEach(button => {
        button.addEventListener('click', function() {
            const visitorId = this.getAttribute('data-id'); // Obtener el ID del visitante desde el atributo data-id

            // Realizar una solicitud fetch para obtener los detalles del visitante
            fetch(`obtener_detalles_visitor.php?id=${visitorId}`)
                .then(response => response.json())
                .then(data => {
                    if (data.error) {
                        alert(data.error); // Mostrar error si no hay datos disponibles
                    } else {
                        // Llenar los datos en la tabla del modal
                        const registroDetailsTable = document.getElementById('registroDetailsTable').getElementsByTagName('tbody')[0];
                        registroDetailsTable.innerHTML = ''; // Limpiar tabla existente
                        
                        const row = registroDetailsTable.insertRow();
                        row.insertCell(0).textContent = data.fecha || 'N/A';
                        row.insertCell(1).textContent = data.hora_entrada || 'N/A';
                        row.insertCell(2).textContent = data.hora_salida || 'N/A';
                        row.insertCell(3).textContent = data.observaciones || 'N/A';
                        
                        // Mostrar el modal
                        document.getElementById('registroModal').style.display = 'block';
                    }
                })
                .catch(error => {
                    console.error('Error al obtener los detalles del visitante:', error);
                    alert('No se pudieron cargar los detalles del visitante.');
                });
        });
    });

    // Cerrar el modal cuando el usuario haga clic en el botón de cerrar
    document.querySelector('.close-btn').addEventListener('click', function() {
        document.getElementById('registroModal').style.display = 'none';
    });

    // Cerrar el modal si el usuario hace clic fuera del contenido del modal
    window.addEventListener('click', function(event) {
        if (event.target === document.getElementById('registroModal')) {
            document.getElementById('registroModal').style.display = 'none';
        }
    });
});

