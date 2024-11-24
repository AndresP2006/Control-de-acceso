<div id="myModal" class="modal">
    <div class="modal-content">
        <div class="cerrado">
            <h3 class="titulo-form">Nuevo registro</h3>
            <span class="close" id="close">&times;</span>
        </div>
        <form id="myForm" action="<?php echo RUTA_URL; ?>/UserController/createUser" method="post">
            <label for="">Cedula</label><br>
            <input type="text" id="u_id" name="U_id" />
            <label for="">Nombre</label><br>
            <input type="text" id="U_Nombre" name="U_Nombre" />
            <label for="">Apellidos</label><br>
            <input type="text" id="U_Apellido" name="U_Apellido" />
            <label for="">Telefono</label><br>
            <input type="text" id="U_Telefono" name="U_Telefono" />
            <label for="">Correo</label><br>
            <input type="text" id="U_Gmail" name="U_Gmail" />
            <label for="">Departamento</label><br>
            <input type="text" id="U_Departamento" name="U_Departamento" />
            <label for="">Torre</label><br>
            <input type="text" id="U_torre" name="U_torre" />
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