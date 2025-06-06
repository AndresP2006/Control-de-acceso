<?php require_once RUTA_APP . '/views/inc/header-porter.php'; ?>

<div class="filtros">
  <div class="filtros_visitas">
    <form action="<?php echo RUTA_URL;?>/PorterController/FiltroCedula" method="post" class="form_filtro_cedula">
      <input 
        type="text" 
        name="cedula" 
        placeholder="Buscar por cédula"
        class="input_cedula"
      >
      <button 
        type="submit"
        class="btn_buscar"
      >Buscar</button>
    </form>
  </div>
  <div class="Siquiente2">
  <a href="<?php echo RUTA_URL; ?>/HomeController/guard"><button class="siquiente_registro">Porteria</button></a>
</div>
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
    <th>Torre</th>
    <th>Departamento</th>
    <th>Permitir Entrada</th>
  </tr>
  </thead>
  <tbody>
  <?php if (empty($datos['visitors'])): ?>
    <tr>
      <td colspan="10">No hay registros</td>
    </tr>
  <?php else: ?>
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
        <td><?= htmlspecialchars($visita['To_letra']) ?></td>
        <td><?= htmlspecialchars($visita['Ap_numero']) ?></td>
        <td><button>✅</button></td>
      </tr>
    <?php endforeach; ?>
  <?php endif; ?>
  </tbody>
</table>
<!-- ✅  -->
 <!-- 🛂 -->
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
    height: 250px;
  }
    .filtros_visitas {
      position: relative;
      left:35px;
      width: 300px;
      display: flex;
      align-items: center;
      gap: 10px;
      margin-bottom: 20px;
    }
    .form_filtro_cedula {
      display: flex;
      align-items: center;
      gap: 8px;
    }
    .input_cedula {
      padding: 8px 12px;
      border: 1px solid #b0b0b0;
      border-radius: 4px;
      font-size: 15px;
      outline: none;
    }
    .btn_buscar {
      padding: 8px 18px;
      background: #2d6cdf;
      color: #fff;
      border: none;
      border-radius: 4px;
      font-size: 15px;
      cursor: pointer;
      transition: background 0.2s;
    }
    .btn_buscar:hover {
      background: #1a4e9b;
    }
</style>