<?php
class AdminModel
{
    private $db;
    private $id;

    public function __construct()
    {
        $this->db = new Base;
    }
    public function addUser($datos)
{
    try {
        $this->db->beginTransaction();

        // Verificar si la cédula ya existe
        $this->db->query('SELECT Us_id FROM usuario WHERE Us_id = :Cedula');
        $this->db->bind(':Cedula', $datos['Cedula']);
        $this->db->execute();

        if ($this->db->rowCount() > 0) {
            return false; // Usuario ya existe
        }

        // Insertar en tabla 'usuario'
        $this->db->query('INSERT INTO usuario (Us_id, Us_usuario, Us_contrasena, Us_correo, Ro_id) VALUES (:Cedula, :Usuario, :Contrasena, :Correo, :Rol)');
        $this->db->bind(':Cedula', $datos['Cedula']);
        $this->db->bind(':Usuario', $datos['Nombre']);
        $this->db->bind(':Contrasena', $datos['Contrasena']); // Cifrar contraseña
        $this->db->bind(':Correo', $datos['Gmail']);
        $this->db->bind(':Rol', $datos['Rol']);
        $this->db->execute();

        // Insertar en tabla 'persona'
        $this->db->query('INSERT INTO persona (Pe_id, Pe_nombre, Pe_apellidos, Pe_telefono, Ap_id, Us_id) VALUES (:Cedula, :Nombre, :Apellidos, :Telefono, :Departamento, :Cedula)');
        $this->db->bind(':Cedula', $datos['Cedula']);
        $this->db->bind(':Nombre', $datos['Nombre']);
        $this->db->bind(':Apellidos', $datos['Apellidos']);
        $this->db->bind(':Telefono', $datos['Telefono']);
        $this->db->bind(':Departamento', $datos['Departamento']);
        $this->db->execute();

        $this->db->commit();
        return true;
    } catch (Exception $e) {
        $this->db->rollBack();
        error_log("Error al registrar usuario: " . $e->getMessage());
        return false;
    }
}

    public function eliminarRegistro($id)
    {
        try {
            // Iniciar una transacción
            $this->db->beginTransaction();

            // Eliminar el registro de la tabla 'persona' primero
            $sql2 = "DELETE FROM persona WHERE Pe_id = :id";
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

    public function updateUser($datos)
{
    try {
        // Iniciar una transacción
        $this->db->beginTransaction();


        // 1. Actualizar los datos en la tabla 'usuario'
        $sql = '
            UPDATE usuario 
            SET 
                Us_usuario = :Usuario, 
                Us_correo = :Correo 
        ';

        // Solo agregar la contraseña si es proporcionada
        if (!empty($datos['Contrasena'])) {
            $sql .= ', Us_contrasena = :Contrasena';
        }

        $sql .= ' WHERE Us_id = :Cedula';

        $this->db->query($sql);
        
        // Verificar los datos vinculados
        $this->db->bind(':Cedula', $datos['Cedula']);
        $this->db->bind(':Usuario', $datos['Nombre']);
        $this->db->bind(':Correo', $datos['Gmail']);

        // Si se ha proporcionado una nueva contraseña, la vinculamos
        if (!empty($datos['Contrasena'])) {
            $this->db->bind(':Contrasena', $datos['Contrasena']);
        }

        $this->db->execute();

        // 2. Actualizar los datos en la tabla 'persona'
        $this->db->query('
            UPDATE persona 
            SET 
                Pe_nombre = :Nombre, 
                Pe_apellidos = :Apellidos, 
                Pe_telefono = :Telefono 
            WHERE Pe_id = :Cedula
        ');
        $this->db->bind(':Cedula', $datos['Cedula']);
        $this->db->bind(':Nombre', $datos['Nombre']);
        $this->db->bind(':Apellidos', $datos['Apellidos']);
        $this->db->bind(':Telefono', $datos['Telefono']);
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

public function updateUserPartial($datos)
    {
        try {
            // Verificar que existan todas las claves
            $requiredKeys = ['Cedula', 'Gmail', 'Telefono', 'Torre', 'Apartamento'];
            foreach ($requiredKeys as $key) {
                if (!isset($datos[$key]) || empty(trim($datos[$key]))) {
                    throw new Exception("Falta el campo: " . $key);
                }
            }

            // Variables locales
            $cedula      = trim($datos['Cedula']);
            $correo      = trim($datos['Gmail']);
            $telefono    = trim($datos['Telefono']);
            $torre       = trim($datos['Torre']);
            $apartamento = trim($datos['Apartamento']);

            // Depuración
            error_log("updateUserPartial => Cedula=$cedula, Gmail=$correo, Telefono=$telefono, Torre=$torre, Ap=$apartamento");

            // Iniciar transacción
            $this->db->beginTransaction();

            // 1. Actualizar correo en 'usuario'
            $this->db->query("UPDATE usuario SET Us_correo = :Correo WHERE Us_id = :Cedula");
            $this->db->bind(':Correo', $correo);
            $this->db->bind(':Cedula', $cedula);
            $this->db->execute();

            // 2. Actualizar teléfono en 'persona'
            $this->db->query("UPDATE persona SET Pe_telefono = :Telefono WHERE Pe_id = :Cedula");
            $this->db->bind(':Telefono', $telefono);
            $this->db->bind(':Cedula', $cedula);
            $this->db->execute();

            // 3. Actualizar torre y apartamento
            //    Asumiendo que 'persona' tiene Ap_id
            //    y que en 'apartamento' se busca Ap_id para setear To_id y Ap_numero
            $this->db->query("
                UPDATE apartamento
                SET To_id = (
                    SELECT t.To_id FROM torre t WHERE t.To_letra = :Torre LIMIT 1
                ),
                    Ap_numero = :Ap_numero
                WHERE Ap_id = (
                    SELECT p.Ap_id FROM persona p WHERE p.Pe_id = :Cedula LIMIT 1
                )
            ");
            $this->db->bind(':Torre', $torre);
            $this->db->bind(':Ap_numero', $apartamento);
            $this->db->bind(':Cedula', $cedula);
            $this->db->execute();

            // Confirmar transacción
            $this->db->commit();
            return true;
        } catch (Exception $e) {
            if ($this->db->inTransaction()) {
                $this->db->rollBack();
            }
            error_log("Error en updateUserPartial: " . $e->getMessage());
            return false;
        }
    }









}
