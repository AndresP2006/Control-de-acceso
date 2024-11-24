<div id="myModal-Udate" class="modal">
    <div class="modal-content">
        <div class="cerrado">
            <h3 class="titulo-form">registro</h3>
            <span class="close" id="close">&times;</span>
        </div>
        <form id="myForm" action="<?php echo RUTA_URL; ?>/UserController/createUser" method="post">
            <label for="">Cedula</label><br>
            <input type="text" id="E_id" name="U_id" value="<?php ?>" readonly  />
            <label for="">Nombre</label><br>
            <input type="text" id="E_Nombre" name="U_Nombre" value="<?php ?>" />
            <label for="">Apellidos</label><br>
            <input type="text" id="E_Apellido" name="U_Apellido" value="<?php ?>" />
            <label for="">Telefono</label><br>
            <input type="text" id="E_Telefono" name="U_Telefono" value="<?php ?>" />
            <label for="">Correo</label><br>
            <input type="text" id="E_Gmail" name="U_Gmail" value="<?php ?>" />
            <label for="">Departamento</label><br>
            <input type="text" id="E_Departamento" name="U_Departamento" value="<?php ?>" />
            <label for="">Rol</label><br>
            <!-- <input type="text" id="U_torre" name="U_torre" value="<?php ?>" /> -->
            <select name="R_id" class="Rol" id="R_id">
                <option value="">Seleccionar</option>
                <option value=1>Administrador</option>
                <option value=2>Guardia</option>
                <option value=3>Residente</option>
            </select>
            <label for="" id="E_passwordl">Contraseña</label><br>
            <input type="text" id="E_password" name="E_contrasena" />
            
            <center>
                <input type="submit" value="Enviar" class="Enviar" name="udate" />
            </center>
        </form>
    </div>
</div>