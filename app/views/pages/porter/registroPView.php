<?php require_once RUTA_APP . '/views/inc/header-porter.php'; ?>
<div style="position: relative;left: 85%;width: 50px; ">
    <a href="<?php echo RUTA_URL; ?>/HomeController/guard"><button>Home</button></a>
</div>


<div>
    <table border="1" cellpadding="8" cellspacing="0">
  <thead>
    <tr>
      <th>Vi_id</th>
      <th>Vi_nombres</th>
      <th>Vi_apellidos</th>
      <th>Vi_telefono</th>
      <th>Re_fecha_entrada</th>
      <th>Re_hora_entrada</th>
      <th>Re_hora_salida</th>
      <th>Re_motivo</th>
      <th>Vi_departamento</th>
    
      <th>Pe_id</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($datos['visitors'] as $visita): ?>
      <tr>
        <td><?= htmlspecialchars($visita['Vi_id']) ?></td>
        <td><?= htmlspecialchars($visita['Vi_nombres']) ?></td>
        <td><?= htmlspecialchars($visita['Vi_apellidos']) ?></td>
        <td><?= htmlspecialchars($visita['Vi_telefono']) ?></td>
        <td><?= htmlspecialchars($visita['Re_fecha_entrada']) ?></td>
        <td><?= htmlspecialchars($visita['Re_hora_entrada']) ?></td>
        <td><?= htmlspecialchars($visita['Re_hora_salida']) ?></td>
        <td><?= htmlspecialchars($visita['Re_motivo']) ?></td>
        <td><?= htmlspecialchars($visita['Vi_departamento']) ?></td>
        
        <td><?= htmlspecialchars($visita['Pe_id']) ?></td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>

</div>
<?php require_once RUTA_APP . '/views/inc/footer-porter.php'; ?>