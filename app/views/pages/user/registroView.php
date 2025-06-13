<?php require_once RUTA_APP . '/views/inc/header-user.php'; ?>

<!-- Formulario de visitantes -->
<div class="container_registros">
  
  <div class="formulario_div">
    <form class="registro-usuario-form" id="myForm" action="<?php echo RUTA_URL; ?>/PorterController/userPeopleVisit" method="post">
  <div class="registro-usuario-cerrado">
    <h3 class="registro-usuario-titulo-form">Nuevo registro</h3>
  </div>
  <h4 class="registro-usuario-label">Documento: <input type="text" id="u_id" name="u_id"  autocomplete="off" class="registro-usuario-input" /></h4>
  <h4 class="registro-usuario-label">Nombre: <input type="text" id="U_Nombre" name="U_Nombre" class="registro-usuario-input" /></h4>
  <h4 class="registro-usuario-label">Apellido: <input type="text" id="U_Apellido" name="U_Apellido" class="registro-usuario-input" /></h4>
  <h4 class="registro-usuario-label">Telefono: <input type="text" id="U_Telefono" name="U_Telefono" class="registro-usuario-input" /></h4>
  <h4 class="registro-usuario-label">Motivo de visita: <input type="text" id="U_Motivo" name="U_Motivo" class="registro-usuario-input" /></h4>
  <input type="hidden"  name="idResidente" value="<?php echo $datos['isUsuario']; ?>" readonly >
  <h4 class="registro-usuario-label">Torre: 
    <input type="text" name="torre" value="<?php echo $datos['torre']; ?>" readonly class="registro-usuario-input" >
  </h4>
  <h4 class="registro-usuario-label">Apartamento: 
    <input type="text" name="apartamento" value="<?php echo $datos['apartamento']; ?>" readonly class="registro-usuario-input" >
  </h4>
  <center>
    <input type="submit" value="Enviar" class="registro-usuario-enviar" id="enviarVisita" name="Visitantes" />
  </center>
</form>
  </div>
  <div class="visitas_Costantes">
    
    <table class="visitas-constantes-tabla">
      <thead class="visitas-constantes-thead">
      <tr class="visitas-constantes-tr">
        <th class="visitas-constantes-th">Cedula</th>
        <th class="visitas-constantes-th">Nombre</th>
        <th class="visitas-constantes-th">Apellido</th>
        <th class="visitas-constantes-th">Telefono</th>
        <th class="visitas-constantes-th">Solicitar Entrada</th>
      </tr>
      </thead>
      <tbody class="visitas-constantes-tbody">
      <tr class="visitas-constantes-tr">
        <td class="visitas-constantes-td">1042851729</td>
        <td class="visitas-constantes-td">ANDRES</td>
        <td class="visitas-constantes-td">1042851729</td>
        <td class="visitas-constantes-td">1042851729</td>
        <td class="visitas-constantes-td">✅</td>
      </tr>
      </tbody>
    </table>
  </div>
  <div>
    <a href="<?php echo RUTA_URL; ?>/HomeController/resident" class="registro-usuario-enlaces">
      <span class="registro-usuario-icons registro-usuario-exit">↩️</span>
    </a>
  </div>
</div>

<!-- ✅  -->
<!-- 🛂 -->

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
