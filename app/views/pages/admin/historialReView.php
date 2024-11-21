<?php require_once RUTA_APP . '/views/inc/header-registro.php'; ?>


<div class="content_cuerpo">
    <div class="content_cuerpo-bloque2">
        <div class="content_cuerpo-bloque2-caja">
            <h1 class="content_cuerpo-bloque2-caja-titulo">Historial de Registro</h1>
        </div>
        <table>
            <tr>
                <th class="content__tabla-titulo">Nombre</th>
                <th class="content__tabla-titulo">Fecha Entrada</th>
                <th class="content__tabla-titulo">Hora Entrada</th>
                <th class="content__tabla-titulo">Hora de salida </th>
                <th class="content__tabla-titulo">Num_Dep</th>
            </tr>
            <?php
            $model = new PeopleModel();
            $registro = $model->showRegistro();

            if (is_array($registro)) {
                foreach ($registro as $visitas): ?>
                    <tr>
                        <td class="content__tabla-informacion"><?php echo $visitas["Vi_nombres"]; ?></td>
                        <td class="content__tabla-informacion"><?php echo $visitas["Re_fecha_entrada"]; ?></td>
                        <td class="content__tabla-informacion"><?php echo $visitas["Re_hora_entrada"]; ?></td>
                        <td class="content__tabla-informacion"><?php echo $visitas["Re_hora_salida"]; ?></td>
                        <td class="content__tabla-informacion"><?php echo $visitas["Vi_departamento"]; ?></td>
                    </tr>
            <?php endforeach;
            } else {
                echo "No se encontraron registros.";
            }
            ?>
        </table>
    </div>
    <div class="content_cuerpo-bloque3">
        <div class="content_cuerpo-bloque3-contenido">

            <button class="content_cuerpo-bloque3-botones">
                <a href="<?php echo RUTA_URL; ?>/HomeController/usuario">Usuarios</a>
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
                    <form id="myForm" action="<?php echo RUTA_URL; ?>/UserController/createUser" method="post">
                        <div class="content_cuerpo-bloque2-caja-titulo-contenido">
                            <div class="content_cuerpo-bloque2-caja-titulo-contenido-bloque1">
                                <br>
                                <br>
                                <p class="content_cuerpo-bloque2-caja-titulo-contenido-parrafo-2">
                                    Numero de Documento:
                                </p>
                                <br>
                                <p class="content_cuerpo-bloque2-caja-titulo-contenido-parrafo-2">
                                    Nombres:
                                </p>
                                <br>
                                <p class="content_cuerpo-bloque2-caja-titulo-contenido-parrafo-2">
                                    Apellidos:
                                </p>
                                <br>
                                <p class="content_cuerpo-bloque2-caja-titulo-contenido-parrafo-2">
                                    Telefono:
                                </p>
                                <br>
                                <p class="content_cuerpo-bloque2-caja-titulo-contenido-parrafo-2">
                                    Gmail:
                                </p>
                                <br>
                                <p class="content_cuerpo-bloque2-caja-titulo-contenido-parrafo-2">
                                    Numero de Departamento:
                                </p>
                                <br>
                                <p class="content_cuerpo-bloque2-caja-titulo-contenido-parrafo-2">
                                    Contraseña:
                                </p>
                                <br>
                                <p class="content_cuerpo-bloque2-caja-titulo-contenido-parrafo-2">
                                    Rol:
                                </p>
                                <br>
                                <input type="submit" value="Guardar" name="Enviar" class="Enviar" />
                            </div>
                            <div class="content_cuerpo-bloque2-caja-titulo-contenido-bloque2">
                                <input type="text" id="u_id" name="U_id" />
                                <input type="text" id="U_Nombre" name="U_Nombre" />
                                <input type="text" id="U_Apellido" name="U_Apellido" />
                                <input type="text" id="U_Telefono" name="U_Telefono" />
                                <input type="text" id="U_Gmail" name="U_Gmail" />
                                <input type="text" id="U_Departamento" name="U_Departamento" />
                                <input type="text" id="U_contrasena" name="U_contrasena" />
                                <select name="R_id" class="Rol">
                                    <option value="">Seleccionar</option>
                                    <option value=1>Administrador</option>
                                    <option value=2>Guardia</option>
                                    <option value=3>Residente</option>
                                </select>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- Fin del formulario -->

            <button class="content_cuerpo-bloque3-botones">
                <a href="<?php echo RUTA_URL; ?>/HomeController/historialRe"> Historial de registro</a>
            </button>

            <button class="content_cuerpo-bloque3-botones">
                <a href="<?php echo RUTA_URL; ?>/HomeController/histrialVi">Lista de visitante</a>
            </button>
            <button class="content_cuerpo-bloque3-botones">
                <a href="<?php echo RUTA_URL; ?>/HomeController/paquetes">Paquetes</a>
            </button>

            <button class="content_cuerpo-bloque3-botones" id="openModalBtn">
                Editar usuario
            </button>
            <div id="myModal" class="modal">
                <div class="modal-content2">
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
                                <td><input type="checkbox"></td </tr>
                            <tr>
                                <td>Stiven</td>
                                <td>Stiven023</td>
                                <td>***</td>
                                <td><input type="checkbox"></td </tr>
                        </tbody>
                    </table>
                    <button class="Nboto">Nuevo usuario</button>
                </div>
            </div>

            <button class="content_cuerpo-bloque3-botones">
                <a href=""> Eliminar registro</a>
            </button>

            <button class="content_cuerpo-bloque3-botones" id="showFormButton">
                Eliminar historial
            </button>
            <div id="modalOverlay" class="modal-overlay">
                <div class="modal-content3">
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
        </div>
    </div>


    <?php require_once RUTA_APP . '/views/inc/footer-historial.php'; ?>