<?php require_once RUTA_APP . '/views/inc/header-user.php'; ?>

<!-- Formulario de visitantes -->
<form id="myForm" action="<?php echo RUTA_URL; ?>/PorterController/userPeopleVisit" method="post">
    <div class="cerrado">
        <h3 class="titulo-form">Nuevo registro</h3>
        <a href="<?php echo RUTA_URL; ?>/HomeController/resident" class="enlaces">
            <span class="icons exit">↩️</span>
        </a>
    </div>
    <h4>Documento: <input type="text" id="u_id" name="u_id"  autocomplete="off" /></h4>
    <h4>Nombre: <input type="text" id="U_Nombre" name="U_Nombre" /></h4>
    <h4>Apellido: <input type="text" id="U_Apellido" name="U_Apellido" /></h4>
    <h4>Telefono: <input type="text" id="U_Telefono" name="U_Telefono" /></h4>
    <h4>Motivo de visita: <input type="text" id="U_Motivo" name="U_Motivo" /></h4>
    <input type="hidden"  name="idResidente" value="<?php echo $datos['isUsuario']; ?>" readonly >
    <h4>Torre: 
        <input type="text" name="torre" value="<?php echo $datos['torre']; ?>" readonly>
    </h4>
    <h4>Apartamento: 
        <input type="text" name="apartamento" value="<?php echo $datos['apartamento']; ?>" readonly>
    </h4>
    <center>
        <input type="submit" value="Enviar" class="Enviar" id="enviarVisita" name="Visitantes" />
    </center>
</form>

<?php require_once RUTA_APP .'/views/inc/footer-user.php'; ?>

<style> 
form {
    background: #fff;
    border-radius: 10px;
    padding: 30px 40px;
    width: 400px;
    margin: 40px auto;
    box-shadow: 0 8px 32px rgba(0,0,0,0.2);
    position: relative;
    animation: fadeIn 0.3s;
}

@keyframes fadeIn {
    from { transform: translateY(-30px); opacity: 0; }
    to { transform: translateY(0); opacity: 1; }
}

.cerrado {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 15px;
}
.titulo-form {
    margin: 0;
    font-size: 1.5em;
    color: #333;
}
.miModal__cerrar_v {
    display: none;
}

/* Inputs y selects */
form h4 {
    margin: 10px 0 5px 0;
    font-size: 1em;
    color: #444;
}
input[type="text"], select {
    width: 100%;
    padding: 8px 10px;
    margin-top: 3px;
    margin-bottom: 10px;
    border: 1px solid #ccc;
    border-radius: 6px;
    font-size: 1em;
    background: #f9f9f9;
    transition: border 0.2s;
}
input[type="text"]:focus, select:focus {
    border: 1.5px solid #3498db;
    outline: none;
}

/* Título torre y apartamento */
.titulo_torre {
    display: flex;
    justify-content: space-between;
    margin-top: 10px;
}
.titulo_torre h4 {
    margin: 0;
}

/* Selects en línea */
.select_torre {
    display: flex;
    gap: 10px;
    margin-bottom: 10px;
}
.filter-select, .filter-select_personas {
    flex: 1;
}

/* Botón enviar */
.Enviar {
    background: #3498db;
    color: #fff;
    border: none;
    border-radius: 6px;
    padding: 10px 30px;
    font-size: 1.1em;
    cursor: pointer;
    margin-top: 15px;
    transition: background 0.2s;
}
.Enviar:hover {
    background: #217dbb;
}

</style>