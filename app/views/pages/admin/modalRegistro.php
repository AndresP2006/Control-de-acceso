<div id="myModal" class="modal">
    <div class="modal-content">
        <div class="cerrado">
            <h3 class="titulo-form">Nuevo registro</h3>
            <span class="close" id="close">&times;</span>
        </div>
        <form id="myForm" action="<?php echo RUTA_URL; ?>/UserController/createUser" method="post">
            <label for="">Cedula</label><br>
            <input type="text" id="u_id" name="Pe_id" />
            <label for="">Nombre</label><br>
            <input type="text" id="U_Nombre" name="U_Nombre" />
            <label for="">Apellidos</label><br>
            <input type="text" id="U_Apellido" name="U_Apellido" />
            <label for="">Telefono</label><br>
            <input type="text" id="U_Telefono" name="U_Telefono" />
            <label for="">Correo</label><br>
            <input type="text" id="U_Gmail" name="U_Gmail" />
            <div class="select_torre2">
                <select id="select_torre2" class="filter-select">
                    <option value="">Torre</option>
                    <?php foreach ($_SESSION['torre'] as $torre) {
                        echo "<option value='{$torre->To_id}'>{$torre->To_letra}</option>";
                    } ?>
                </select>
                <select name="U_Departamento" id="U_Departamento" class="filter-select">
                    <option value="">Apartamento</option>
                </select>
                <input type="text" style="display: none;" name="U_Departamento2" id="U_Departamento2">
            </div>
            <select name="U_id" class="Rol" id="U_id">
                <option value="">Seleccionar</option>
                <option value=1>Administrador</option>
                <option value=2>Guardia</option>
                <option value=3>Residente</option>
            </select>
            <label for="" id="passwordLabel">Contraseña</label><br>
            <input type="text" id="U_password" name="U_contrasena" />

            <center>
                <input type="submit" value="Enviar" class="Enviar" name="registro" />
            </center>
        </form>
    </div>
</div>