<?php require_once RUTA_APP . '/views/inc/header-admin.php'; ?>



<div class="content">
    <header>
        <div class="content_Encabezado">

            <h1 class="content_Encabezado-titulo">Control de registro de <br><samp
                    style="color: red; margin-left: 30px;">Entrada y
                    Salida</samp></h1>

            <button id="cambiar-usuario">Cambiar usuario</button>
            <div id="popup-cambiar" class="ventana-emergente">
                <div class="ventana-emergente__caja ventana-emergente__caja--opciones">
                    <span class="ventana-emergente__cerrar" id="cerrar-popup">&times;</span>
                    <button class="boton" id="boton-seguridad">Guardia</button>
                    <button class="boton" id="boton-administracion">Administración</button>
                </div>
            </div>
            <div class="cerrar-sescion">
                <a href="../index.html"><button class="boton">Cerrar Sesion</button></a>
            </div>

            <!-- Formulario de guardia -->
            <div class="ventana-emergente__seguridad" id="popup-seguridad">
                <div class="ventana-emergente__formulario" id="formulario-seguridad">
                    <span class="ventana-emergente__cerrar" id="cerrar-seguridad">&times;</span>
                    <form action="" class="formulario-general">
                        <h2>Guardia</h2>
                        <label for="" class="formulario-general__label">
                            Usuario
                            <input type="text" class="formulario-general__input" placeholder="Usuario" />
                        </label>
                        <label for="" class="formulario-general__label">
                            Contraseña
                            <input type="password" class="formulario-general__input" placeholder="Clave" />
                        </label>
                        <a href="/paginas/Guardia/Visitas.html"><input type="button"
                                class="formulario-general__boton" value="Ingresar" /></a>
                    </form>
                </div>
            </div>

            <!-- Formulario de administración -->
            <div class="ventana-emergente__seguridad" id="popup-administracion">
                <div class="ventana-emergente__formulario" id="formulario-administracion">
                    <span class="ventana-emergente__cerrar" id="cerrar-administracion">&times;</span>
                    <form action="" class="formulario-general">
                        <h2>Administración</h2>
                        <label for="" class="formulario-general__label">
                            Usuario
                            <input type="text" name="usuario" class="formulario-general__input"
                                placeholder="Usuario" />
                        </label>
                        <label for="" class="formulario-general__label">
                            Contraseña
                            <input type="password" name="password" class="formulario-general__input"
                                placeholder="Clave" />
                        </label>
                        <a href="/paginas/Admin/adminitracion.html"><input type="button"
                                class="formulario-general__boton" value="Ingresar" /></a>
                    </form>
                </div>
            </div>
        </div>
    </header>
    <div class="content_cuerpo">
        <div class="content_cuerpo-bloque1">
            <div class="content_cuerpo-bloque1-texto">
                <input id="texto" type="text"> <button class="content_cuerpo-bloque1-boton">Buscar</button>
            </div>
            <select name="selector" id="selector">
                <option value="1">Nombre y Apellido</option>
                <option value="2">Andres David Pereira Puello</option>
                <option value="3">Juan David Charry Meza</option>
                <option value="4">Juan David Rua Porta</option>
                <option value="5">Luis Adriano Padilla Cardales</option>
                <option value="6">Stiven Dario Catalán Silgado</option>
            </select>

        </div>
        <div class="content_cuerpo-bloque2">
            <div class="content_cuerpo-bloque2-caja">
                <h1 class="content_cuerpo-bloque2-caja-titulo">Datos Basicos</h1>
            </div>
            <div class="content_cuerpo-bloque2-caja-titulo-contenido">
                <div class="content_cuerpo-bloque2-caja-titulo-contenido-bloque1">
                    <p class="content_cuerpo-bloque2-caja-titulo-contenido-parrafo">Numero de Documento:
                    </p>

                    <p class="content_cuerpo-bloque2-caja-titulo-contenido-parrafo"> Nombres: </p>
                    <p class="content_cuerpo-bloque2-caja-titulo-contenido-parrafo"> Apellidos:</p>
                    <p class="content_cuerpo-bloque2-caja-titulo-contenido-parrafo">Telefono:</p>


                    <p class="content_cuerpo-bloque2-caja-titulo-contenido-parrafo">Motivo de Visita: </p>
                    <p class="content_cuerpo-bloque2-caja-titulo-contenido-parrafo">Numero de Departamento: </p>
                </div>
                <div class="content_cuerpo-bloque2-caja-titulo-contenido-bloque2">
                    <input type="text" value="1047052850">
                    <input type="text" value="Andres David">
                    <input type="text" value="Pereira Puello">
                    <input type="text" value="3135226922">
                    <input type="text" value="Dejar un paquete">
                    <input type="text" value="420">
                </div>
            </div>

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
                                <div class="content_cuerpo-bloque2-caja-titulo-contenido-bloque1">
                                    <p class="content_cuerpo-bloque2-caja-titulo-contenido-parrafo">
                                        Numero de Documento:
                                    </p>
                                    <p class="content_cuerpo-bloque2-caja-titulo-contenido-parrafo">
                                        Nombres:
                                    </p>
                                    <p class="content_cuerpo-bloque2-caja-titulo-contenido-parrafo">
                                        Apellidos:
                                    </p>
                                    <p class="content_cuerpo-bloque2-caja-titulo-contenido-parrafo">
                                        Telefono:
                                    </p>
                                    <p class="content_cuerpo-bloque2-caja-titulo-contenido-parrafo">
                                        Motivo de Visita:
                                    </p>
                                    <p class="content_cuerpo-bloque2-caja-titulo-contenido-parrafo">
                                        Numero de Departamento:
                                    </p>
                                    <input type="submit" value="Guardar" class="Enviar" />
                                </div>
                                <div class="content_cuerpo-bloque2-caja-titulo-contenido-bloque2">
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
            </div>
        </div>
    </div>
</div>



<?php require_once RUTA_APP . '/views/inc/footer-admin.php'; ?>