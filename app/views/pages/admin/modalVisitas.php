<?php
echo "<td>
        <button class='boton-abrir' onclick='abrirModal(\"$uniqueId\")'>
            <span>➕</span> 
        </button>
        </td>";
echo "</tr>";
echo "<tr>
        <td colspan='6'>
            <div class='modal' id='$uniqueId' style='display: none;'>
                <div class='modal__contenido'>
                    <span class='modal__cerrar' onclick='cerrarModal(\"$uniqueId\")'>&times;</span>
                    <table class='tabla-nueva'>
                        <thead class='tabla-nueva__encabezado'>
                            <tr class='tabla-nueva__fila'>
                                <th class='tabla-nueva__celda'>Fecha</th>
                                <th class='tabla-nueva__celda'>Hora de entrada</th>
                                <th class='tabla-nueva__celda'>Hora de salida</th>
                            </tr>
                        </thead>
                        <tbody class='tabla-nueva__cuerpo'>
                            <tr class='tabla-nueva__fila'>
                                <td class='tabla-nueva__celda'>" . $historial['Re_fecha_entrada'] . "</td>
                                <td class='tabla-nueva__celda'>" . $historial['Re_hora_entrada'] . "</td>
                                <td class='tabla-nueva__celda'>" . $historial['Re_hora_salida'] . "</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </td>
        </tr>";
?>


<style>
.modal {
    display: none;
    position: fixed;
    z-index: 1000;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    overflow: auto;
    background-color: rgba(0, 0, 0, 0.4);
    /* Fondo semi-transparente */
}

.modal__contenido {
    background-color: #ccd0cf;
    margin: 10% auto;
    padding: 20px;
    border: 1px solid #888;
    border-radius: 20px;
    width: 80%;
    /* Ancho del modal */
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
}

.modal__cerrar {
    color: black;
    float: right;
    font-size: 28px;
    font-weight: bold;
    cursor: pointer;
}

.modal__cerrar:hover,
.modal__cerrar:focus {
    color: black;
    text-decoration: none;
    cursor: pointer;
}
</style>