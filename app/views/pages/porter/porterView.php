<?php require_once RUTA_APP . '/views/inc/header-porter.php'; ?>

   
    <div class="cuerpo">
        <div class="contador_ingresos">
            <h2>Han Ingresado</h2>
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
                <form>
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
                    <button class="miModal__cerrar close" id="cerrarMiModal" type="button">&times;</button>
                    <h2 class="miModal__titulo">Información del Residente</h2>


                    <div class="miModal__grupo">
                        <label class="miModal__label" for="nombres">Nombre:</label>
                        <input class="miModal__input" type="text" id="nombres" readonly name="nombres">
                    </div>

                    <div class="miModal__grupo">
                        <label class="miModal__label" for="apellidos">Apellido:</label>
                        <input class="miModal__input" type="text" id="apellidos" readonly name="apellidos">
                    </div>

                    <div class="miModal__grupo">
                        <label class="miModal__label" for="telefono">Teléfono:</label>
                        <input class="miModal__input" type="text" id="telefono" readonly name="telefono">
                    </div>

                    <div class="miModal__grupo">
                        <label class="miModal__label" for="torre">Torre:</label>
                        <input class="miModal__input" type="text" id="torre" readonly name="torre">
                    </div>
                    <div class="miModal__grupo">
                        <label class="miModal__label" for="apartamento">Número de Departamento:</label>
                        <input class="miModal__input" type="text" id="apartamento" readonly name="apartamento">
                    </div>

                    <div class="miModal__grupo">
                        <label class="miModal__label" for="Paquete">Total de paquetes:</label>
                        <input class="miModal__input" type="text" id="Paquete" readonly name="Paquete">
                    </div>

                    <button class="boton-flotante" id="abrirTablaFlotante" type="button">Paquetes</button>

                    <div class="tabla-flotante" id="tablaFlotante">
                        <div class="tabla-flotante__contenido">
                            <h2>Tabla de datos</h2>
                            <table class="tabla-flotante__tabla">
                                <thead>
                                    <tr>
                                        <th>Fecha</th>
                                        <th>Descripcion</th>
                                        <th>Estado</th>
                                        <th>Entregar</th>
                                    </tr>
                                </thead>
                                <tbody id="paquetesTable">



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
                <div id="VisitasModal" class="modal_v">
                    <div class="modal-content">
                        <div class="cerrado">
                            <h3 class="titulo-form">Nuevo registro</h3>
                            <button class="miModal__cerrar_v close" id="close" type="button">&times;</button>

                            <!-- <span class="close" id="close">&times;</span> -->
                        </div>
                        <form id="myForm" action="<?php echo RUTA_URL; ?>/PorterController/createGuest" method="post">
                            <h4>Documento: <input type="text" id="u_id" name="u_id" /></h4>
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
                            <select name="select_personas" id="select_personas" class="filter-select_personas">
                                <option value="0">Residentes</option>
                            </select>
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
                        <h4>Descripcion: <textarea id="Pa_Descripcion" name="descripcion"></textarea></h4>
                        <?php
                        date_default_timezone_set('UTC');
                        $hoy = date("Y-m-d");
                        ?>
                        <h4>Fecha de entrega: <input type="date" id="Pa_Fecha" name="fecha" max="<?php echo $hoy; ?>" />
                        </h4>
                        <h4>Recibidor: <input type="text" id="Pa_Firma" name="recibidor" /></h4>

                        <div class="titulo_torre">
                            <h4>Torre</h4>
                            <h4 class="ap">Apartamento</h4>
                        </div>
                        <div class="select_torre">
                            <select id="select_torre_p" class="filter-select">
                                <option value="">Torre</option>
                                <?php foreach ($datos['torre'] as $torre) {
                                    echo "<option value='{$torre->To_id}'>{$torre->To_letra}</option>";
                                } ?>
                            </select>
                            <select name="select_id" id="select_apartamento_p" class="filter-select">
                                <option value="0">Apartamento</option>
                            </select>
                        </div>
                        <select name="select_personas" id="select_personas_p" class="filter-select_personas">
                            <option value="0">Residentes</option>
                        </select>
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

<?php require_once RUTA_APP . '/views/inc/footer-porter.php'; ?>

<script>
    <?php if (isset($datos['messageError']) && $datos['messageError'] != null) { ?>
        error("<?php echo htmlspecialchars($datos['messageError']); ?>");
    <?php } elseif (isset($datos['messageInfo']) && $datos['messageInfo'] != null) { ?>
        realizado("<?php echo htmlspecialchars($datos['messageInfo']); ?>");
    <?php } ?>


    $(document).ready(function () {


        $('#abrirMiModal').click(function () {
            let PeopleID = $('#texto').val();
            if (PeopleID) {
                let tabla = $('#paquetesTable').val();
                $.ajax({
                    url: '<?php echo RUTA_URL; ?>/PorterController/getPeopleBypa', //de donde recibe la informacion
                    type: 'POST', //de que manera lo recibe
                    data: {
                        residente: PeopleID
                    },
                    success: function (respuesta) {
                        let resp = JSON.parse(respuesta);

                        $('#miModal').addClass('miModal--activo');
                        $('#nombres').val(resp.Pe_nombre);
                        $('#apellidos').val(resp.Pe_apellidos);
                        $('#telefono').val(resp.Pe_telefono);
                        $('#torre').val(resp.Torre);
                        $('#apartamento').val(resp.Apartamento);
                        $('#Paquete').val(resp.Total_paquetes);


                        if (!resp.Pe_id) {
                            error('Digite una identificacion valida');
                            $('#miModal').removeClass('miModal--activo');
                        } else if (resp.Total_paquetes === 0) {
                            $('#miModal').addClass('miModal--activo');
                        } else {
                            $('#miModal').addClass('miModal--activo');
                        }

                        $('#abrirTablaFlotante').click(function () {
                            $.ajax({
                                url: '<?php echo RUTA_URL; ?>/PorterController/getPaquetById',
                                type: 'POST',
                                data: {
                                    residente: PeopleID
                                },

                                success: function (paquetes) {

                                    let paq = JSON.parse(paquetes);

                                    let td;

                                    if (Array.isArray(paq)) {

                                        let paquetesPendientes = paq.filter(item => item.Pa_estado !== 'Entregado');

                                        if (paquetesPendientes.length > 0) {

                                            for (let item of paquetesPendientes) {
                                                td += '<tr>';
                                                td += '<td>' + item.Pa_fecha + '</td>';
                                                td += '<td>' + item.Pa_descripcion + '</td>';
                                                td += '<td>' + item.Pa_estado + '</td>';
                                                td += '<td><center><button type="button" class="btnEditarPaquete" data-id="' + item.Pa_id + '">📬</button></center></td>';
                                                td += '</tr>';
                                            }
                                        } else {
                                            td = '<tr><td colspan="4" style="text-align: center;">No hay paquetes pendientes.</td></tr>';

                                        }
                                    } else {

                                        td = '<tr><td colspan="4" style="text-align: center;">No hay datos disponibles.</td></tr>';
                                    }

                                    $('#paquetesTable').html(td);
                                }
                            })
                        })
                    },
                    error: function () {
                        $('#respuesta').html('Error al procesar la solicitud.');
                    }
                });
            }
        });
        $(document).on('click', '.btnEditarPaquete', function () {
            let paqueteId = $(this).data('id');
            $.ajax({
                url: '<?php echo RUTA_URL; ?>/PorterController/updatePaquete',
                type: 'POST',
                data: {
                    paquete_id: paqueteId,
                    nuevo_estado: 'Entregado'
                },
                success: function (response) {
                    let resp = JSON.parse(response);
                    if (resp.success) {
                        realizado('Paquete entregado.')
                        $('#abrirTablaFlotante').trigger('click');
                    } else {
                        error('Error al entregar el paquete.');
                    }
                },
                error: function () {
                    advertencia('Hubo un problema con la solicitud.');
                }
            });
        });


        // selector de torre visitas
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
                            optionSelect += '<option value="' + item.Ap_id + '">' + item
                                .Ap_numero + '</option>'

                        $('#select_apartamento').html(optionSelect)
                    }
                })

                $('#select_apartamento').change(function () {
                    let valueApartament = $('#select_apartamento').val();
                    if (valueApartament) {

                        $.ajax({
                            url: '<?php echo RUTA_URL ?>/ApartamentController/getPeopleByApartament',
                            type: 'POST',
                            data: {
                                apartamento_id: valueApartament
                            },
                            success: function (personas) {

                                const pers = JSON.parse(personas)

                                let optionSelect_pe =
                                    '<option value="0">Residentes</option>'

                                for (let item of pers)
                                    optionSelect_pe += '<option value="' + item.Pe_id +
                                        '">' + item.Pe_nombre + ' ' + item.Pe_apellidos +
                                        '</option>'

                                $('#select_personas').html(optionSelect_pe)
                            }
                        })
                    } else {
                        optionSelect = '<option value="0">Apartamento</option>'
                        $('#select_apartamento').html(optionSelect)

                        optionSelect = '<option value="0">Residentes</option>'
                        $('#select_personas').html(optionSelect_pe)
                    }
                })



            } else {
                optionSelect = '<option value="0">Apartamento</option>'
                $('#select_apartamento').html(optionSelect)

                optionSelect = '<option value="0">Residentes</option>'
                $('#select_personas').html(optionSelect)
            }
        })

        // selector de torre paquetes

        $('#select_torre_p').change(function () {
            let ValueTower = $('#select_torre_p').val();
            if (ValueTower) {

                $.ajax({
                    url: '<?php echo RUTA_URL ?>/ApartamentController/getApartamentByTower',
                    type: 'POST',
                    data: {
                        TowerId: ValueTower
                    },
                    success: function (respuesta) {

                        const res_p = JSON.parse(respuesta)

                        let optionSelect_p = '<option value="0">Apartamento</option>'

                        for (let item of res_p)
                            optionSelect_p += '<option value="' + item.Ap_id + '">' + item.Ap_numero + '</option>'

                        $('#select_apartamento_p').html(optionSelect_p)
                    }
                })

                $('#select_apartamento_p').change(function () {
                    let valueApartament = $('#select_apartamento_p').val();
                    if (valueApartament) {

                        $.ajax({
                            url: '<?php echo RUTA_URL ?>/ApartamentController/getPeopleByApartament',
                            type: 'POST',
                            data: {
                                apartamento_id: valueApartament
                            },
                            success: function (personas) {

                                const pers_p = JSON.parse(personas)

                                let optionSelect_pe_p = '<option value="0">Residentes</option>'

                                for (let item of pers_p)
                                    optionSelect_pe_p += '<option value="' + item.Pe_id + '">' + item.Pe_nombre + ' ' + item.Pe_apellidos + '</option>'

                                $('#select_personas_p').html(optionSelect_pe_p)
                            }
                        })
                    } else {
                        optionSelect = '<option value="0">Apartamento</option>'
                        $('#select_apartamento').html(optionSelect)

                        optionSelect = '<option value="0">Residentes</option>'
                        $('#select_personas_p').html(optionSelect_pe)
                    }
                })



            } else {
                optionSelect = '<option value="0">Apartamento</option>'
                $('#select_apartamento_p').html(optionSelect)

                optionSelect = '<option value="0">Residentes</option>'
                $('#select_personas_p').html(optionSelect)
            }
        })

        //Modal

        $('#cerrarMiModal').click(() => {
            $('#miModal').removeClass('miModal--activo');
        })
    });
</script>