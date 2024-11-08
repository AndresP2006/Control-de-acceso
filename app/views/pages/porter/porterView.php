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
            <a href="../../index.html"><button class="boton">Cerrar Sesion</button></a>
        </div>
    </div>
    <div class="cuerpo">
        <div class="contador_ingresos">
            <h2>Han ingresado</h2>
            <div class="contador">
                <?php // echo $conteo 
                ?>
            </div>
        </div>
        <div class="opciones">
            <!-- problemas  -->
            <form action="http://localhost:8080/Control-de-acceso-main/paginas/Guardia/controllers/indexContrl.php" method="post">
                <input id="texto" type="text" placeholder="Buscar Persona con paquetes" name="residente" />
                <input type="submit" value="Buscar" class="Buscar" id="Actualizar" name="Busca">
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
                        <form id="myForm" action="index.php" method="post">
                            <h4>Cedula: <input type="text" id="u_id" name="u_id" /></h4>
                            <h4>Nombre: <input type="text" id="U_Nombre" name="U_Nombre" /></h4>
                            <h4>Apellido: <input type="text" id="U_Apellido" name="U_Apellido" /></h4>
                            <h4>Telefono: <input type="text" id="U_Telefono" name="U_Telefono" /></h4>
                            <h4>Motivo de vitida: <input type="text" id="U_Motivo" name="U_Motivo" /></h4>
                            <h4>Numero de departameto: <input type="text" id="U_Departamento" name="U_Departamento" /></h4>
                            <center>
                                <input type="submit" value="Enviar" class="Enviar" name="Residentes" />
                            </center>
                        </form>
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
                        <form id="packageForm" action="index.php" method="post">
                            <h4>Estado: <input type="text" id="Pa_Estado" name="pa_estado" /></h4>
                            <h4>Descripcio: <textarea id="Pa_Descripcion" name="pa_descripcion"></textarea></h4>
                            <h4>Fecha de entrega: <input type="date" id="Pa_Fecha" name="Pa_Fechaf" /></h4>
                            <h4>Responsable: <input type="text" id="Pa_Firma" name="pa_Responsable" /></h4>
                            <h4>Descumento del Residente: <input type="text" id="U_Id" name="u_id" /></h4>
                            <center>
                                <input type="submit" value="Enviar" name="Paquetes" class="Enviar" />
                            </center>
                        </form>
                    </div>
                </div>
                <!-- Fin del formulario del Paquete -->
            </div>
        </div>
    </div>
    <!-- Formulario para mostrar los datos -->

    <!-- mostrar datos de los formularios -->
    <div id="overlay">
        <form class="formulario">
            <div class="cerradi">
                <span class="x" id="cerrar">&times;</span>
                <h2>Residente</h2>
            </div>
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" value="<?php echo $Nombre ?>">

            <label for="Apellido">Apellido:</label>
            <input type="text" id="Apellido" name="Apellido" value="<?php echo $Apellido ?>">

            <label for="Telefono">Telefono:</label>
            <input type="text" id="Telefono" name="Telefono" value="<?php echo $Telefono ?>">

            <label for="Motivo">Motivo de visita:</label>
            <input type="text" id="Motivo" name="Motivo" value="<?php echo $Motivo ?>">

            <label for="departameto">Numero de departameto:</label>
            <input type="text" id="departameto" name="departameto" value="<?php echo $Departamento ?>">

            <label for="Paquete">Paquete:</label>
            <input type="text" id="Paquete" name="Paquete" value="<?php echo $Descripcion ?>">


            <!-- <input type="submit" value="Actualizar" name="Actualizar"> -->

        </form>
    </div>
</div>

<?php require_once RUTA_APP . '/views/inc/footer-porter.php'; ?>