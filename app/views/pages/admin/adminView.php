<?php
$conn = new mysqli('localhost', 'root', '', 'cda');

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Consulta base (para mostrar todos los datos inicialmente)
$sql = "SELECT persona.*, usuario.Ro_id, usuario.Us_correo 
        FROM persona 
        LEFT JOIN usuario ON persona.Pe_id = usuario.Us_id";

// Verificar si se ha enviado un filtro
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['select_id']) && $_POST['select_id'] !== "") {
    $tipo = intval($_POST['select_id']); 

    // Si el filtro es distinto de 0 (que indica "Todos"), aplicamos el filtro
    if ($tipo !== 0) {
        $sql .= " WHERE usuario.Ro_id = $tipo";
    }
}

$result = $conn->query($sql);

$registros = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $registros[] = $row;
    }
}

$conn->close();
?>

<?php require_once RUTA_APP . '/views/inc/header-admin.php'; ?>

<div class="controls">
    <div class="control-group">
        <button class="add-btn" id="nuevo_registro">➕ Agregar Nuevo Registro</button>
        <form action="" method="POST">
            <select name="select_id" class="filter-select" onchange="this.form.submit()">
                <option value="">Filtrar por Tipo</option>
                <option value="1" <?php echo isset($_POST['select_id']) && $_POST['select_id'] == 1 ? 'selected' : ''; ?>>Administrador</option>
                <option value="2" <?php echo isset($_POST['select_id']) && $_POST['select_id'] == 2 ? 'selected' : ''; ?>>Guardia</option>
                <option value="3" <?php echo isset($_POST['select_id']) && $_POST['select_id'] == 3 ? 'selected' : ''; ?>>Residente</option>
            </select>
        </form>
    </div>
    <div class="control-group">
        <input type="text" class="search-bar" placeholder="🔍 Buscar registros...">
    </div>
</div>

<div class="table-container">
    <div class="table-wrapper">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Contraseña</th>
                    <th>Telefono</th>
                    <th>Correo</th>
                    <th>Departamento</th>
                    <th>Tipo de usuario</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (!empty($registros)) {
                    foreach ($registros as $registro) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($registro['Pe_id']) . "</td>";
                        echo "<td>" . htmlspecialchars($registro['Pe_nombre']) . " " . htmlspecialchars($registro['Pe_apellidos']) . "</td>";
                        echo "<td>*****</td>"; // Campo oculto para la contraseña
                        echo "<td>" . htmlspecialchars($registro['Pe_telefono']) . "</td>";
                        echo "<td>" . htmlspecialchars($registro['Us_correo']) . "</td>";
                        echo "<td>" . htmlspecialchars($registro['Ap_id']) . "</td>";
                        echo "<td>" . htmlspecialchars($registro['Ro_id']) . "</td>";
                        echo "<td>
                                <button class='edit-btn' id='nuevo_registro'>✏️</button>
                                <form action='" . RUTA_URL . "/UserController/DeleteUser' method='POST' style='display:inline;'>
                        <input type='hidden' name='delete_id' value='" . htmlspecialchars($registro['Pe_id']) . "'>
                        <button type='submit' name='deletebtn' class='delete-btn'>🗑️</button>
                    </form>
                                </td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='6'>No hay registros disponibles</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
    <div class="action-buttons">
        <button class="action-btn">Botón 1</button>
        <button class="action-btn">Botón 2</button>
        <button class="action-btn">Botón 3</button>
    </div>
</div>
<div id="myModal" class="modal">
    <div class="modal-content">
        <div class="cerrado">
            <h3 class="titulo-form">Nuevo registro</h3>
            <span class="close" id="close">&times;</span>
        </div>
        <form id="myForm" action="<?php echo RUTA_URL; ?>/PorterController/createGuest" method="post">
            <h4>Cedula: <input type="text" id="u_id" name="u_id" /></h4>
            <h4>Nombre: <input type="text" id="U_Nombre" name="U_Nombre" /></h4>
            <h4>Apellido: <input type="text" id="U_Apellido" name="U_Apellido" /></h4>
            <h4>Telefono: <input type="text" id="U_Telefono" name="U_Telefono" /></h4>
            <h4>Motivo de visita: <input type="text" id="U_Motivo" name="U_Motivo" /></h4>
            <h4>Numero de apartameto: <input type="text" id="U_Departamento" name="U_Departamento" /></h4>
            <center>
                <input type="submit" value="Enviar" class="Enviar" name="Visitantes" />
            </center>
        </form>
    </div>
</div>

<?php require_once RUTA_APP . '/views/inc/footer-admin.php'; ?>