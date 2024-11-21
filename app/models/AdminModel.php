<?php
class AdminModel{
    private $db;

    public function __construct()
    {
        $this->db = new Base;
    }
    public function addUser($datos)
    {
    try {
        // Iniciar una transacción
        $this->db->beginTransaction();

        // 1. Verificar si la Cedula ya existe como Us_id
        $this->db->query('SELECT Us_id FROM usuario WHERE Us_id = :Cedula');
        $this->db->bind(':Cedula', $datos['Cedula']);
        $this->db->execute();

        // Si la Cedula ya existe, lanzar un error
        if ($this->db->rowCount() > 0) {
            throw new Exception("El usuario con la cédula {$datos['Cedula']} ya existe.");
        }

        // 2. Insertar en la tabla 'usuario' usando Cedula como Us_id
        $this->db->query('INSERT INTO usuario (Us_id, Us_usuario, Us_contrasena, Us_correo, Ro_id) VALUES(:Cedula, :Usuario, :Contrasena, :Correo, :Rol)');
        $this->db->bind(':Cedula', $datos['Cedula']); // Usar Cedula como Us_id
        $this->db->bind(':Usuario', $datos['Nombre']);
        $this->db->bind(':Contrasena', $datos['Contrasena']); // Cifrar la contraseña
        $this->db->bind(':Correo', $datos['Gmail']);
        $this->db->bind(':Rol', $datos['Rol']);

        // Ejecutar la inserción en la tabla 'usuario'
        $this->db->execute();

        // 3. Insertar en la tabla 'persona' usando el mismo Us_id (Cedula) y los otros datos
        $this->db->query('INSERT INTO persona (Pe_id, Pe_nombre, Pe_apellidos, Pe_telefono, Ap_id, Us_id) VALUES(:Cedula, :Nombre, :Apellidos, :Telefono, :Departamento, :Cedula)');
        $this->db->bind(':Cedula', $datos['Cedula']);
        $this->db->bind(':Nombre', $datos['Nombre']);
        $this->db->bind(':Apellidos', $datos['Apellidos']);
        $this->db->bind(':Telefono', $datos['Telefono']);
        $this->db->bind(':Departamento', $datos['Departamento']);
        $this->db->bind(':Cedula', $datos['Cedula']); // Usar Cedula como Us_id también en persona

        // Ejecutar la inserción en la tabla 'persona'
        $this->db->execute();

        // Confirmar la transacción si todo fue exitoso
        $this->db->commit();
        return true;
    } catch (Exception $e) {
        // Deshacer la transacción en caso de error
        $this->db->rollBack();
        echo "Error: " . $e->getMessage();
        return false;
    }
}

public function eliminarRegistro($id) {
    try {
        // Iniciar una transacción
        $this->db->beginTransaction();

        // Eliminar el registro de la tabla 'persona' primero
        $sql2 = "DELETE FROM persona WHERE Us_id = :id";
        $this->db->query($sql2);
        $this->db->bind(':id', $id);
        $this->db->execute();

        // Luego eliminar el registro de la tabla 'usuario'
        $sql1 = "DELETE FROM usuario WHERE Us_id = :id";
        $this->db->query($sql1);
        $this->db->bind(':id', $id);
        $this->db->execute();

        // Confirmar la transacción si ambas consultas fueron exitosas
        $this->db->commit();

        return true; // Indica que la eliminación fue exitosa
    } catch (Exception $e) {
        // Si hay un error, revertir la transacción
        $this->db->rollBack();
        echo "Error: " . $e->getMessage(); // Esto mostrará el error exacto
        return false; // Indica que ocurrió un error
    }
}




}
