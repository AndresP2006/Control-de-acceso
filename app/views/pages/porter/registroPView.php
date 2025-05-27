<?php require_once RUTA_APP . '/views/inc/header-porter.php'; ?>

<div style="position: relative;left: 85%;width: 50px; ">
  <a href="<?php echo RUTA_URL; ?>/HomeController/guard"><button>Home</button></a>
</div>

<div class="content_table">
  <table border="1" cellpadding="8" cellspacing="0">
  <thead>
  <tr>
    <th>Cedula</th>
    <th>Nombres</th>
    <th>Apellidos</th>
    <th>Teléfono</th>
    <th>Fecha Entrada</th>
    <th>Hora Entrada</th>
    <th>Hora Salida</th>
    <th>Motivo</th>
    <th>Departamento</th>
    <th>Cedula del residente</th>
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





<style>
  table {
    border-collapse: collapse;
    width: 95%;
    margin: 30px auto;
    background: #fff;
    box-shadow: 0 2px 8px rgba(0,0,0,0.08);
    font-family: Arial, sans-serif;
  }
  th, td {
    padding: 12px 16px;
    text-align: center;
  }
  th {
    background-color:rgb(126, 129, 134);
    color: #fff;
    font-weight: bold;
  }
  tr:nth-child(even) {
    background-color: #f2f6fc;
  }
  tr:hover {
    background-color: #e6f0ff;
  }
  thead {
    border-bottom: 2px solid #2d6cdf;
  }
  td {
    border-bottom: 1px solid #e0e0e0;
  }
  .content_table{
    overflow-x: auto;
    height: 165px;
  }
  
</style>