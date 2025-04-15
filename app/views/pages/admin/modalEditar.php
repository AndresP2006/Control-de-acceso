<div id="myModal-Udate" class="modal">
    <div class="modal-content">
        <div class="cerrado">
            <h3 class="titulo-form">Registro</h3>
            <span class="close" id="close">&times;</span>
        </div>
        <form id="myForm" action="<?php echo RUTA_URL; ?>/UserController/EditarUser" method="post">
            <label for="">Documento</label><br>
            <input type="text" id="E_id" name="E_id" readonly />

            <label for="">Nombre</label><br>
            <input type="text" id="E_Nombre" name="E_Nombre" />

            <label for="">Apellidos</label><br>
            <input type="text" id="E_Apellido" name="E_Apellido" />

            <label for="">Telefono</label><br>
            <input type="text" id="E_Telefono" name="E_Telefono" />

            <label for="">Correo</label><br>
            <input type="email" id="E_Gmail" name="E_Gmail"  require/>

            <!-- <label for="">Departamento</label><br>
            <input type="text" id="E_Departamento" name="E_Departamento" /> -->
            <div class="titulo_torre">
                <h4>Torre</h4>
                <h4 class="ap">Apartamento</h4>
            </div>
            <div class="select_torre">
                <select name="E_torre"id="select_torre" class="filter-select">
                    <option value="">Torre</option>
                    <?php foreach ($_SESSION['torre'] as $torre) {
                        echo "<option value='{$torre->To_id}'>{$torre->To_letra}</option>";
                    } ?>
                </select>
                <select name="E_Departamento" id="E_Departamento" class="filter-select">
                    <option value="">Apartamento</option>
                </select>
                <input type="text" style="display: none;" name="E_Departamento2" id="E_Departamento2">
            </div>

            <label for="">Rol</label><br>
            <select name="R_id" class="Rol" id="R_id">
                <option value="">Seleccionar</option>
                <option value=1>Administrador</option>
                <option value=2>Guardia</option>
                <option value=3>Residente</option>
            </select>

            <center>
                <input type="submit" value="Actualizar" class="Enviar" name="udate" />
            </center>
        </form>

    </div>
</div>