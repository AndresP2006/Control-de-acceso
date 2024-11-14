<?php require_once RUTA_APP . '/views/inc/header-historial_Re.php'; ?>

<div class="content_cuerpo">
    <div class="content_cuerpo-bloque2">
        <div class="content_cuerpo-bloque2-caja">
            <h1 class="content_cuerpo-bloque2-caja-titulo">
                Historial de Registro
            </h1>
        </div>
        <table>
            <tr>
                <th class="content__tabla-titulo">Nombre y Apellido</th>
                <th class="content__tabla-titulo">Fecha de entrda</th>
                <th class="content__tabla-titulo">Fecha de salida</th>
                <th class="content__tabla-titulo">Hora de entrada</th>
                <th class="content__tabla-titulo">Hora de salida</th>
                <th class="content__tabla-titulo">Num_Dep</th>
            </tr>
            <tr>
                <td class="content__tabla-informacion">
                    Andres david pereira puello
                </td>
                <td class="content__tabla-informacion">25/8/2024</td>
                <td class="content__tabla-informacion">25/8/2024</td>
                <td class="content__tabla-informacion">4:45pm</td>
                <td class="content__tabla-informacion">6:00pm</td>
                <td class="content__tabla-informacion">203</td>
            </tr>
            <tr>
                <td class="content__tabla-informacion">Juan David Rua Porta</td>
                <td class="content__tabla-informacion">20/8/2024</td>
                <td class="content__tabla-informacion">20/8/2024</td>
                <td class="content__tabla-informacion">3:45pm</td>
                <td class="content__tabla-informacion">4:00pm</td>
                <td class="content__tabla-informacion">150</td>
            </tr>
            <tr>
                <td class="content__tabla-informacion">Juan David Charrys Meza</td>
                <td class="content__tabla-informacion">10/12/2024</td>
                <td class="content__tabla-informacion">16/6/2024</td>
                <td class="content__tabla-informacion">5:00Am</td>
                <td class="content__tabla-informacion">5:00pm</td>
                <td class="content__tabla-informacion">106</td>
            </tr>
        </table>
    </div>
    <div class="content_cuerpo-bloque3">
        <div class="content_cuerpo-bloque3-contenido">
            <button class="content_cuerpo-bloque3-botones">
                <a href="/paginas/Admin/adminitracion.html"> Usuarios</a>
            </button>
            <button class="content_cuerpo-bloque3-botones" id="NuevoUsuaro">
                Nuevo usuario
            </button>
            <!-- Formulario modal de visitantes -->
            <div id="Modal" class="modal">
                <div class="modal-content">
                    <div class="cerrado">
                        <h3 class="titulo-form">Nuevo registro</h3>
                        <span class="closes">&times;</span>
                    </div>
                    <form id="myForm">
                        <div class="content_cuerpo-bloque2-caja-titulo-contenido">
                            <div
                                class="content_cuerpo-bloque2-caja-titulo-contenido-bloque1">
                                <p
                                    class="content_cuerpo-bloque2-caja-titulo-contenido-parrafo">
                                    Numero de Documento:
                                </p>
                                <p
                                    class="content_cuerpo-bloque2-caja-titulo-contenido-parrafo">
                                    Nombres:
                                </p>
                                <p
                                    class="content_cuerpo-bloque2-caja-titulo-contenido-parrafo">
                                    Apellidos:
                                </p>
                                <p
                                    class="content_cuerpo-bloque2-caja-titulo-contenido-parrafo">
                                    Telefono:
                                </p>
                                <p
                                    class="content_cuerpo-bloque2-caja-titulo-contenido-parrafo">
                                    Motivo de Visita:
                                </p>
                                <p
                                    class="content_cuerpo-bloque2-caja-titulo-contenido-parrafo">
                                    Numero de Departamento:
                                </p>
                                <input type="submit" value="Guardar" class="Enviar" />
                            </div>
                            <div
                                class="content_cuerpo-bloque2-caja-titulo-contenido-bloque2">
                                <input type="text" id="u_id" name="u_id" />
                                <input type="text" id="U_Nombre" name="U_Nombre" />
                                <input type="text" id="U_Apellido" name="U_Apellido" />
                                <input type="text" id="U_Telefono" name="U_Telefono" />
                                <input type="text" id="U_Motivo" name="U_Motivo" />
                                <input type="text" id="U_Paquete" name="U_Paquete" />
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- Fin del formulario -->

            <button class="content_cuerpo-bloque3-botones">
                <a href="/paginas/Admin/HisRegistro.html"> Historial de registro</a>
            </button>

            <button class="content_cuerpo-bloque3-botones">
                <a href="/paginas/Admin/listaV.html">Lista de visitante</a>
            </button>
            <button class="content_cuerpo-bloque3-botones">
                <a href="/paginas/Admin/Paquetes.html">Paquetes</a>
            </button>

            <button class="content_cuerpo-bloque3-botones" id="openModalBtn">
                Editar usuario
            </button>
            <div id="myModal" class="modal">
                <div class="modal-content">
                    <span class="close">&times;</span>
                    <h2>Usuarios y Contraseñas</h2>
                    <table>
                        <caption>
                            Usuarios y Contraseñas
                        </caption>
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Usuario</th>
                                <th>Contraseña</th>
                                <th>Admin</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Andres</td>
                                <td>Andres2020</td>
                                <td>****</td>
                                <td><input type="checkbox" /></td>
                            </tr>
                            <tr>
                                <td>Stiven</td>
                                <td>Stiven023</td>
                                <td>***</td>
                                <td><input type="checkbox" /></td>
                            </tr>
                        </tbody>
                    </table>
                    <button class="Nboto">Nuevo usuario</button>
                </div>
            </div>
            <script src="/main/admin/editarU.js"></script>

            <button class="content_cuerpo-bloque3-botones">
                <a href=""> Eliminar registro</a>
            </button>

            <button class="content_cuerpo-bloque3-botones" id="showFormButton">
                Eliminar historial
            </button>
            <div id="modalOverlay" class="modal-overlay">
                <div class="modal-content">
                    <span class="modal-close">&times;</span>
                    <div class="form-area">
                        <h1>Formulario de Control</h1>
                        <form id="controlForm">
                            <div class="btn-wrapper">
                                <button type="button" class="btn-remove" id="removeBtn">
                                    Eliminar
                                </button>
                            </div>
                            <div class="form-group">
                                <label for="months">Conservar los últimos (Meses):</label>
                                <input type="text" id="months" name="months" />
                            </div>
                            <div class="form-group">
                                <label for="deleteHistory">Ingresa 0 para eliminar todo el historial:</label>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <script src="/main/admin/historialE.js"></script>
        </div>
    </div>
</div>

<?php require_once RUTA_APP . '/views/inc/footer-admin.php'; ?>