<div id="myModal" class="modal">
    <div class="modal-content">
        <div class="cerrado">
            <h3 class="titulo-form translatable">Nuevo registro</h3>
            <span class="close" id="close">&times;</span>
        </div>
        <form id="myForm" action="<?php echo RUTA_URL; ?>/UserController/createUser" method="post">
            <label for="" class="label_new_registro translatable">Documento</label><br>
            <input type="text" id="u_id" class="imput_new_registro translatable" name="Pe_id" placeholder="Documento" />
            <label for="" class="label_new_registro translatable">Nombre</label><br>
            <input type="text" id="U_Nombre" class="imput_new_registro translatable" name="U_Nombre" placeholder="Nombre" />
            <label for="" class="label_new_registro translatable">Apellidos</label><br>
            <input type="text" id="U_Apellido" class="imput_new_registro translatable" name="U_Apellido" placeholder="Apellidos" />
            <label for="" class="label_new_registro translatable">Telefono</label><br>
            <input type="text" id="U_Telefono" class="imput_new_registro translatable" name="U_Telefono" placeholder="Telefono" />
            <label for="" class="label_new_registro translatable">Correo</label><br>
            <input type="email" id="U_Gmail" class="imput_new_registro translatable" name="U_Gmail" placeholder="Correo" required />
            <div class="titulo_torre">
                <h4 class="label_new_registro translatable">Torre</h4>
                <h4 class="ap label_new_registro translatable">Apartamento</h4>
            </div>
            <div class="select_torre">
                <div class="select_torre2">
                    <select id="select_torre2" class="filter-select translatable">
                        <option value="" class="translatable">Torre</option>
                        <?php foreach ($_SESSION['torre'] as $torre) {
                            echo "<option value='{$torre->To_id}'>{$torre->To_letra}</option>";
                        } ?>
                    </select>
                    <select name="U_Departamento" id="U_Departamento" class="filter-select translatable">
                        <option value="" class="translatable">Apartamento</option>
                    </select>
                    <input type="text" style="display: none;" name="U_Departamento2" id="U_Departamento2">
                </div>
            </div>

            <select name="U_id" class="Rol translatable" id="U_id">
                <option value="" class="translatable">Rol</option>
                <option value=1 class="translatable">Administrador</option>
                <option value=2 class="translatable">Guardia</option>
                <option value=3 class="translatable">Residente</option>
            </select>
            <label for="" id="passwordLabel" class="translatable">Contraseña</label><br>
            <input type="text" id="U_password" name="U_contrasena" class="translatable" placeholder="Contraseña" />
            <div id="sugerencias" style="color: red; margin-top: 5px;"></div>

            <center>
                <input type="submit" value="Enviar" id="Enviar" class="Enviar translatable" name="registro" />
            </center>
        </form>
    </div>
</div>
<script src="<?php echo RUTA_URL; ?>/js/ValidacionesAdmin.js"></script>
<script>
    document.getElementById("U_Gmail").addEventListener("blur", function() {
        let correo = this.value.trim();
        if (correo === "") return;
        const input = this;

        fetch("<?php echo RUTA_URL ?>/UserController/ValidarCorreo", {
                method: "POST",
                headers: {
                    "Content-Type": "application/x-www-form-urlencoded",
                },
                body: "correo=" + encodeURIComponent(correo)
            })
            .then(response => response.json())
            .then(data => {
                console.log(data.existe)
                if (data.existe === true) {
                    advertencia("El correo ya ha sido registrado.");
                    input.value = "";
                    input.focus();
                }
            })
            .catch(error => {
                console.error("Error al validar el correo:", error);
            });
    });

    function advertencia(mensaje) {
        Swal.fire({
            title: "ADVERTENCIA!",
            text: mensaje,
            icon: "warning",
        });
    }

    const clave = document.getElementById('U_password');
    const sugerencias = document.getElementById('sugerencias');

    clave.addEventListener('input', () => {
        const valor = clave.value;
        let mensajes = [];

        if (valor.trim() === "") {
            mensajes.push(""); // No muestra nada si está vacío
        } else if (valor.length > 15) {
            mensajes.push("No debe tener más de 10 caracteres.");
        } else if (!/[!@#$%^&*()_+{}\[\]:;<>,.?~\\/-]/.test(valor)) {
            mensajes.push("Agrega al menos un carácter especial (@, #, $, etc).");
        } else if (valor.length < 6) {
            mensajes.push("Mínimo 6 caracteres.");
        } else if (!/[A-Z]/.test(valor)) {
            mensajes.push("Agrega al menos una letra mayúscula.");
        }

        sugerencias.innerHTML = mensajes.join("<br>");
    });
    document.getElementById("u_id").addEventListener("input", function() {
        // Reemplaza todo lo que no sea número por vacío
        this.value = this.value.replace(/\D/g, "");
    });
    document.getElementById("U_Telefono").addEventListener("input", function() {
        // Solo números y máximo 10 dígitos
        this.value = this.value.replace(/\D/g, "").slice(0, 10);
    });



    document.getElementById("myForm").addEventListener("submit", function(e) {
        let errores = [];

        const documento = document.getElementById("u_id");
        const nombre = document.getElementById("U_Nombre");
        const apellido = document.getElementById("U_Apellido");
        const telefono = document.getElementById("U_Telefono");
        const correo = document.getElementById("U_Gmail");
        const contrasena = document.getElementById("U_password");
        const rol = document.getElementById("U_id");

        const torre = document.getElementById("select_torre2").value.trim();
        const apartamento = document.getElementById("U_Departamento").value.trim();

        // Validaciones del documento
        if (!/^\d{7,10}$/.test(documento.value.trim())) {
            errores.push("Documento: solo números entre 7 y 10 dígitos.");
        }

        // Validaciones del nombre
        if (!/^[a-zA-ZÁÉÍÓÚáéíóúÑñ\s]{2,}$/.test(nombre.value.trim())) {
            errores.push("Nombre: solo letras, mínimo 2 caracteres.");
        }

        // Validaciones del apellido
        if (!/^[a-zA-ZÁÉÍÓÚáéíóúÑñ\s]{2,}$/.test(apellido.value.trim())) {
            errores.push("Apellidos: solo letras, mínimo 2 caracteres.");
        }

        // Validación del teléfono
        if (!/^\d{10}$/.test(telefono.value.trim())) {
            errores.push("Teléfono: debe contener exactamente 10 números.");
        }

        // Validación de correo vació (estructura se valida con HTML5 y ya tienes AJAX)
        if (correo.value.trim() === "") {
            errores.push("Correo: campo obligatorio.");
        }

        // Contraseña ya tiene sus validaciones propias, pero aseguramos que no esté vacía
        if (contrasena.value.trim() === "") {
            errores.push("Contraseña: campo obligatorio.");
        }

        // Validación de selección de rol
        if (rol.value.trim() === "") {
            errores.push("Rol: selecciona una opción.");
        }

        // Torre y apartamento combinados
        if ((torre !== "" && apartamento === "") || (torre === "" && apartamento !== "")) {
            errores.push("Torre/Apartamento: debes seleccionar ambos o dejar ambos vacíos.");
        }

        // Mostrar errores si los hay
        if (errores.length > 0) {
            e.preventDefault();
            advertencia(errores.join("\n"));
        }
    });
</script>