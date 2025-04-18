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
            <div id="sugerencias" style="color: red; margin-top: 5px;"></div>

            <center>
                <input type="submit" value="Enviar" class="Enviar" name="registro" />
            </center>
        </form>
    </div>
</div>
<script src="<?php echo RUTA_URL;?>/js/ValidacionesAdmin.js"></script>
<script>
  const clave = document.getElementById('U_password');
  const sugerencias = document.getElementById('sugerencias');

  clave.addEventListener('input', () => {
    const valor = clave.value;
    let mensajes = [];

    if (valor.length > 15) {
      mensajes.push("No debe tener más de 10 caracteres.");
    }

    if (!/[!@#$%^&*()_+{}\[\]:;<>,.?~\\/-]/.test(valor)) {
      mensajes.push("Agrega al menos un carácter especial (@, #, $, etc).");
    }

    if (valor.length < 6) {
      mensajes.push("Mínimo 6 caracteres.");
    }

    if (!/[A-Z]/.test(valor)) {
      mensajes.push("Agrega al menos una letra mayúscula.");
    }

    sugerencias.innerHTML = mensajes.join("<br>");
  });
</script>