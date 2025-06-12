<div id="myModal-Udate" class="modal">
    <div class="modal-content">
        <div class="cerrado">
            <h3 class="titulo-form translatable">Registro</h3>
            <span class="close" id="close">&times;</span>
        </div>
        <form id="myForm" class="editarForm" action="<?php echo RUTA_URL; ?>/UserController/EditarUser" method="post">
            <label for="" class="translatable">Documento</label><br>
            <input type="text" id="E_id" name="E_id" readonly />

            <label for="" class="translatable">Nombre</label><br>
            <input type="text" id="E_Nombre" name="E_Nombre" class="translatable" placeholder="Nombre" />

            <label for="" class="translatable">Apellidos</label><br>
            <input type="text" id="E_Apellido" name="E_Apellido" class="translatable" placeholder="Apellidos" />

            <label for="" class="translatable">Telefono</label><br>
            <input type="text" id="E_Telefono" name="E_Telefono" class="translatable" placeholder="Telefono" />

            <label for="" class="translatable">Correo</label><br>
            <input type="email" id="E_Gmail" name="E_Gmail" class="translatable" placeholder="Correo" required />

            <div class="titulo_torre">
                <h4 class="translatable">Torre</h4>
                <h4 class="ap translatable">Apartamento</h4>
            </div>
            <div class="select_torre">
                <select name="E_torre" id="select_torre" class="filter-select translatable">
                    <option value="" class="translatable">Torre</option>
                    <?php foreach ($_SESSION['torre'] as $torre) {
                        echo "<option value='{$torre->To_id}'>{$torre->To_letra}</option>";
                    } ?>
                </select>
                <select name="E_Departamento" id="E_Departamento" class="filter-select translatable">
                    <option value="" class="translatable">Apartamento</option>
                </select>
                <input type="text" style="display: none;" name="E_Departamento2" id="E_Departamento2">
            </div>

            <label for="" class="translatable">Rol</label><br>
            <select name="R_id" class="Rol translatable" id="R_id">
                <option value="" class="translatable">Seleccionar</option>
                <option value=1 class="translatable">Administrador</option>
                <option value=2 class="translatable">Guardia</option>
                <option value=3 class="translatable">Residente</option>
            </select>

            <center>
                <input type="submit" value="Actualizar" class="Enviar translatable" name="udate" />
            </center>
        </form>
    </div>
    <!-- <script src="<?php echo RUTA_URL; ?>/js/ValidacionesAdmin.js"></script> -->
</div>