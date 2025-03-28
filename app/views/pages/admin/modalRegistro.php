<div id="myModal" class="modal">
    <div class="modal-content">
        <div class="cerrado">
            <h3 class="titulo-form">Nuevo registro</h3>
            <span class="close" id="close">&times;</span>
        </div>
        <form id="myForm" action="<?php echo RUTA_URL; ?>/UserController/createUser" method="post">
            <label for="" class="label_new_registro" >Documento</label><br>
            <input type="text" id="u_id" class="imput_new_registro" name="Pe_id" />
            <label for="" class="label_new_registro" >Nombre</label><br>
            <input type="text" id="U_Nombre" class="imput_new_registro" name="U_Nombre" />
            <label for="" class="label_new_registro" >Apellidos</label><br>
            <input type="text" id="U_Apellido" class="imput_new_registro" name="U_Apellido" />
            <label for="" class="label_new_registro" >Telefono</label><br>
            <input type="text" id="U_Telefono" class="imput_new_registro" name="U_Telefono" />
            <label for="" class="label_new_registro" >Correo</label><br>
            <input type="email" id="U_Gmail" class="imput_new_registro" name="U_Gmail" requiere/>
            <div class="titulo_torre">
                <h4 class="label_new_registro" >Torre</h4>
                <h4 class="ap label_new_registro "  >Apartamento</h4>
            </div>
            <div class="select_torre">
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
            </div>

            <select name="U_id" class="Rol" id="U_id">
                <option value="">Rol</option>
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