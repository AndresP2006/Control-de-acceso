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


<?php if (!empty($datos['messageError'])): ?>
    <script>
        advertencia("<?php echo addslashes($datos['messageError']); ?>");
    </script>
<?php endif; ?>

<?php if (!empty($datos['messageInfo'])): ?>
    <script>
        realizado("<?php echo addslashes($datos['messageInfo']); ?>");
    </script>
<?php endif; ?>
<script>
    const RUTA_URL = "<?php echo RUTA_URL ?>";
</script>
<script src="<?php echo RUTA_URL; ?>/js/Filtro.js"></script>