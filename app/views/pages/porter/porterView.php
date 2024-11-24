<?php require_once RUTA_APP . '/views/inc/header-porter.php'; ?>

<div class="content">
    <div class="encabezado">
        <div class="titulo">
            <h1 class="titulo_1">Control de registro de <b>entrada y salida</b></h1>
        </div>
        <div id="popup-cambiar" class="ventana-emergente">
            <div class="ventana-emergente__caja ventana-emergente__caja--opciones">
            </div>
        </div>
        <div class="cerrar-sescion">
            <a href="../homeView.php"><button class="boton">Cerrar Sesion</button></a>
        </div>
    </div>
    <div class="cuerpo">
        <div class="contador_ingresos">
            <h2>Han ingresado</h2>
            <div class="contador">
                <?php
                if (isset($datos['total'])) {
                    echo $datos['total'];
                }
                ?>
            </div>
        </div>
        <div class="opciones">
            <!-- Buscar  -->
            <div>
                <form action="<?php RUTA_URL; ?>/PorterController/getPeopleBypa" method="post">
                    <input id="texto" class="PeopleId" type="text" name="residente"
                        placeholder="Buscar Persona con paquetes" />
                    <center>
                        <button class="Buscar" id="abrirMiModal" name="Busca" type="button">Buscar</button>
                    </center>
                </form>
            </div>
            <!-- Modal -->
            <!-- Modal con formulario -->
            <div class="miModal" id="miModal">
                <form class="miModal__contenido">
                    <button class="miModal__cerrar" id="cerrarMiModal">&times;</button>
                    <h2 class="miModal__titulo">Información del Residente</h2>


                    <div class="miModal__grupo">
                        <label class="miModal__label" for="nombres">Nombre:</label>
                        <input class="miModal__input" type="text" id="nombres" name="nombres">
                    </div>

                    <div class="miModal__grupo">
                        <label class="miModal__label" for="apellidos">Apellido:</label>
                        <input class="miModal__input" type="text" id="apellidos" name="apellidos">
                    </div>

                    <div class="miModal__grupo">
                        <label class="miModal__label" for="telefono">Teléfono:</label>
                        <input class="miModal__input" type="text" id="telefono" name="telefono">
                    </div>

                    <div class="miModal__grupo">
                        <label class="miModal__label" for="departamento">Número de Departamento:</label>
                        <input class="miModal__input" type="text" id="departamento" name="departamento">
                    </div>

                    <div class="miModal__grupo">
                        <label class="miModal__label" for="Paquete">Total de paquetes:</label>
                        <input class="miModal__input" type="text" id="Paquete" name="Paquete">
                    </div>

                    <button class="boton-flotante" id="abrirTablaFlotante" type="button">Abrir Tabla</button>

                    <div class="tabla-flotante" id="tablaFlotante">
                        <div class="tabla-flotante__contenido">
                            <h2>Tabla de datos</h2>
                            <table class="tabla-flotante__tabla">
                                <thead>
                                    <tr>
                                        <th>Fecha</th>
                                        <th>Descripcio</th>
                                        <th>Entregar</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr id="paquetesTable">
                                        <td></td>
                                    </tr>
                                </tbody>
                            </table>

                        </div>
                    </div>
                </form>
            </div>


            <form action="<?php echo RUTA_URL; ?>/PorterController/dropGuest" method="post">
                <input id="texto" type="text" placeholder="Salida de visitante" name="salida_visita" />
                <center>
                    <input type="submit" value="Salida" class="Buscar" id="Actualizar" name="salida">
                </center>
            </form>

            <!-- fin -->


            <div class="registros">
                <button class="nuevo_registro" id="nuevo_registro">
                    Nuevo Visitante
                </button>

                <!-- Formulario modal de visitantes -->
                <div id="myModal" class="modal">
                    <div class="modal-content">
                        <div class="cerrado">
                            <h3 class="titulo-form">Nuevo registro</h3>
                            <span class="close" id="close">&times;</span>
                        </div>
                        <form id="myForm" action="<?php echo RUTA_URL; ?>/PorterController/createGuest" method="post">
                            <h4>Cedula: <input type="text" id="u_id" name="u_id" /></h4>
                            <h4>Nombre: <input type="text" id="U_Nombre" name="U_Nombre" /></h4>
                            <h4>Apellido: <input type="text" id="U_Apellido" name="U_Apellido" /></h4>
                            <h4>Telefono: <input type="text" id="U_Telefono" name="U_Telefono" /></h4>
                            <h4>Motivo de visita: <input type="text" id="U_Motivo" name="U_Motivo" /></h4>
                            <div class="titulo_torre">
                                <h4>Torre</h4>
                                <h4 class="ap">Apartamento</h4>
                            </div>
                            <div class="select_torre">
                                <select id="select_torre" class="filter-select">
                                    <option value="">Torre</option>
                                    <?php foreach ($datos['torre'] as $torre) {
                                        echo "<option value='{$torre->To_id}'>{$torre->To_letra}</option>";
                                    } ?>
                                </select>
                                <select name="select_id" id="select_apartamento" class="filter-select">
                                    <option value="0">Apartamento</option>
                                </select>
                            </div>
                            <center>
                                <input type="submit" value="Enviar" class="Enviar" name="Visitantes" />
                            </center>
                        </form>
                    </div>
                </div>
            </div>
            <!-- Fin del formulario -->
            <br />
            <br />
            <br />
            <!-- formulario del Paquete -->
            <button class="paquetes" id="openModalBtn">Nuevo Paquete</button>

            <!-- Formulario modal de paquetes -->
            <div id="packageModal" class="modal">
                <div class="modal-content2">
                    <div class="cerrado">
                        <h3 class="titulo-form">Registro de paquetes</h3>
                        <span class="close2" id="closeModal">&times;</span>
                    </div>
                    <form id="packageForm" action="<?php echo RUTA_URL; ?>/PorterController/enterPackage" method="post">
                        <h4>Estado: <input type="text" id="Pa_Estado" name="estado" /></h4>
                        <h4>Descripcio: <textarea id="Pa_Descripcion" name="descripcion"></textarea></h4>
                        <h4>Fecha de entrega: <input type="date" id="Pa_Fecha" name="fecha" /></h4>
                        <h4>Recibidor: <input type="text" id="Pa_Firma" name="recibidor" /></h4>
                        <h4>Documento del Residente: <input type="text" id="U_Id" name="documento" /></h4>
                        <center>
                            <input type="submit" value="Enviar" name="paquetes" class="Enviar" />
                        </center>
                    </form>
                </div>
            </div>
            <!-- Fin del formulario del Paquete -->
        </div>
    </div>
</div>
<!-- Formulario para mostrar los datos -->
</div>

<?php

$_SESSION;
?>
<?php require_once RUTA_APP . '/views/inc/footer-porter.php'; ?>
<script>
    <?php if (isset($datos['messageInfo'])) { ?>
        realizado("<?php echo $datos['messageInfo']; ?>")
    <?php } ?>

    $(document).ready(function () {


        $('#abrirMiModal').click(function () {
            let PeopleID = $('#texto').val();
            let tabla = $('#paquetesTable').val();
            $.ajax({
                url: '<?php echo RUTA_URL; ?>/PorterController/getPeopleBypa?residente=' + PeopleID, //de donde recibe la informacion
                type: 'GET', //de que manera lo recibe
                data: {
                    TowerId: tabla
                },
                success: function (respuesta) {
                    let resp = JSON.parse(respuesta);

                    $('#miModal').addClass('miModal--activo');
                    $('#nombres').val(resp.Pe_nombre);
                    $('#apellidos').val(resp.Pe_apellidos);
                    $('#telefono').val(resp.Pe_telefono);
                    $('#departamento').val(resp.Ap_id);
                    $('#Paquete').val(resp.Total_paquetes);

                    let td = '<td>  </td>';
                    if (Array.isArray(resp)) {
                        for (let item of resp) {
                            td += '<td>' + item.Pa_estado + '</td>';
                            td += '<td>' + item.Pa_fecha + '</td>';
                            td += '<td>' + item.Pa_descripcion + '</td>';
                        }
                    }


                    $('#paquetesTable').html(td);

                },
                error: function () {
                    $('#respuesta').html('Error al procesar la solicitud.');
                }
            });
        });

        // selector de torre
        $('#select_torre').change(function () {
            let ValueTower = $('#select_torre').val();
            if (ValueTower) {

                $.ajax({
                    url: '<?php echo RUTA_URL ?>/ApartamentController/getApartamentByTower',
                    type: 'POST',
                    data: {
                        TowerId: ValueTower
                    },
                    success: function (respuesta) {

                        const res = JSON.parse(respuesta)

                        let optionSelect = '<option value="0">Apartamento</option>'

                        for (let item of res)
                            optionSelect += '<option value="' + item.Ap_id + '">' + item.Ap_numero + '</option>'

                        $('#select_apartamento').html(optionSelect)
                    }
                })
            } else {
                optionSelect = '<option value="0">Apartamento</option>'
                $('#select_apartamento').html(optionSelect)
            }
        })
    });
</script>