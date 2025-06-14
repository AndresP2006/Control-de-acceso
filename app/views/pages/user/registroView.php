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
    <h2>Visitas Constantes</h2>
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
       <?php foreach ($datos['registros'] as $visita): ?>
        <tr class="visitas-constantes-tr">
          <td class="visitas-constantes-td"><?= htmlspecialchars($visita['Vi_id']) ?></td>
          <td class="visitas-constantes-td"><?= htmlspecialchars($visita['Vi_nombres']) ?></td>
          <td class="visitas-constantes-td"><?= htmlspecialchars($visita['Vi_apellidos']) ?></td>
          <td class="visitas-constantes-td"><?= htmlspecialchars($visita['Vi_telefono']) ?></td>
          <td class="visitas-constantes-td">
              <?php
                  $solicitar = $visita['Vi_permiso'] ?? '';
                  if ($solicitar == 'solicitado') {
                ?>
                  <button class="Permiso" disabled>🛂</button>
                <?php } else{ ?>
                  <form action="<?= RUTA_URL; ?>/PorterController/userPeopleVisit" method="post">
                    <input type="hidden" name="u_id" value="<?= htmlspecialchars($visita['Vi_id']) ?>">
                    <input type="hidden" name="U_Nombre" value="<?= htmlspecialchars($visita['Vi_nombres']) ?>">
                    <input type="hidden" name="U_Apellido" value="<?= htmlspecialchars($visita['Vi_apellidos']) ?>">
                    <input type="hidden" name="U_Telefono" value="<?= htmlspecialchars($visita['Vi_telefono']) ?>">
                    <input type="hidden" name="U_Motivo" value="Visitas a un amigo">
                    <input type="hidden" name="idResidente" value="<?= htmlspecialchars($datos['isUsuario']) ?>">
                    <input type="hidden" name="torre" value="<?= htmlspecialchars($datos['torre']) ?>">
                    <input type="hidden" name="apartamento" value="<?= htmlspecialchars($datos['apartamento']) ?>">
                    <button class="Permiso">✅</button>
                  </form>
                <?php } ?>
          </td>
        </tr>
      <?php endforeach; ?>
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
