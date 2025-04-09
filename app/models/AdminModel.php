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
        // Registrar los datos recibidos para depuración
        error_log("updateUser datos: " . print_r($datos, true));

        try {
            // Iniciar la transacción
            $this->db->beginTransaction();

            // 1. Actualizar los datos en la tabla 'usuario'
            $sql = "
            UPDATE usuario 
            SET 
                Us_usuario = :Usuario, 
                Us_correo = :Correo";
            if (!empty($datos['Contrasena'])) {
                $sql .= ", Us_contrasena = :Contrasena";
            }
            $sql .= " WHERE Us_id = :Cedula";

            $this->db->query($sql);
            $this->db->bind(':Cedula', $datos['Cedula']);
            $this->db->bind(':Usuario', $datos['Nombre']);
            $this->db->bind(':Correo', $datos['Gmail']);
            if (!empty($datos['Contrasena'])) {
                $this->db->bind(':Contrasena', $datos['Contrasena']);
            }
            $this->db->execute();

            // 3. Actualizar los datos en la tabla 'persona' incluyendo el Ap_id
            $this->db->query("
            UPDATE persona 
            SET 
                Pe_nombre = :Nombre, 
                Pe_apellidos = :Apellidos, 
                Pe_telefono = :Telefono,
                Ap_id = :Departamento
            WHERE Us_id = :Cedula
        ");
            $this->db->bind(':Cedula', $datos['Cedula']);
            $this->db->bind(':Nombre', $datos['Nombre']);
            $this->db->bind(':Apellidos', $datos['Apellidos']);
            $this->db->bind(':Telefono', $datos['Telefono']);
            $this->db->bind(':Departamento', $datos['Departamento']);
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




    public function insertUserUpdateRequest($datos)
    {
        try {
            // Verificar que existan todas las claves requeridas
            $requiredKeys = ['id_residente', 'nombre', 'correo_nuevo', 'telefono_nuevo', 'torre_nuevo', 'apartamento_nuevo'];
            foreach ($requiredKeys as $key) {
                if (!isset($datos[$key]) || empty(trim($datos[$key]))) {
                    throw new Exception("Falta el campo: " . $key);
                }
            }

            // Asignar variables locales
            $id_residente      = trim($datos['id_residente']);
            $nombre      = trim($datos['nombre']);
            $correo_nuevo      = trim($datos['correo_nuevo']);
            $telefono_nuevo    = trim($datos['telefono_nuevo']);
            $torre_nuevo       = trim($datos['torre_nuevo']);
            $apartamento_nuevo = trim($datos['apartamento_nuevo']);

            // Iniciar transacción
            $this->db->beginTransaction();

            // Inserción en la tabla solicitudes_actualizacion
            $query = "
            INSERT INTO solicitudes_actualizacion 
                (id_residente,nombre,correo_nuevo, telefono_nuevo, torre_nuevo, apartamento_nuevo)
            VALUES 
                (:id_residente,:nombre, :correo_nuevo, :telefono_nuevo, :torre_nuevo, :apartamento_nuevo)
        ";
            $this->db->query($query);
            $this->db->bind(':id_residente', $id_residente);
            $this->db->bind(':nombre', $nombre);
            $this->db->bind(':correo_nuevo', $correo_nuevo);
            $this->db->bind(':telefono_nuevo', $telefono_nuevo);
            $this->db->bind(':torre_nuevo', $torre_nuevo);
            $this->db->bind(':apartamento_nuevo', $apartamento_nuevo);
            $this->db->execute();

            // Confirmar transacción
            $this->db->commit();
            return true;
        } catch (Exception $e) {
            if ($this->db->inTransaction()) {
                $this->db->rollBack();
            }
            error_log("Error en insertUserUpdateRequest: " . $e->getMessage());
            return false;
        }
    }







    public function insertUserUpdate($datos)
    {
        try {
            // Iniciar una transacción
            $this->db->beginTransaction();


            // 1. Actualizar los datos en la tabla 'usuario'
            $sql = '
            UPDATE usuario 
            SET 
                Us_correo = :Correo 
        ';


            $sql .= ' WHERE Us_id = :Cedula';

            $this->db->query($sql);

            // Verificar los datos vinculados
            $this->db->bind(':Cedula', $datos['Cedula']);
            $this->db->bind(':Correo', $datos['Gmail']);

            $this->db->execute();
            // Preparar la consulta SQL para actualizar el estado
            $this->db->query("UPDATE solicitudes_actualizacion 
            SET estado = :estado 
            WHERE id = (
                SELECT id FROM (
                    SELECT id 
                    FROM solicitudes_actualizacion 
                    WHERE id_residente = :Cedula 
                    ORDER BY fecha_solicitud DESC 
                    LIMIT 1
                ) AS subquery
            )");

            // Vincular los parámetros con los valores
            $this->db->bind(':Cedula', $datos['Cedula']);
            $this->db->bind(':estado', 'aprobada');

            // Ejecutar la consulta
            $this->db->execute();

            // 2. Actualizar los datos en la tabla 'persona'
            $this->db->query('
            UPDATE persona 
            SET 
                Pe_telefono = :Telefono 
            WHERE Pe_id = :Cedula
        ');
            $this->db->bind(':Cedula', $datos['Cedula']);
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
    public function insertRechazo($datos)
    {
        try {
            // Preparar la consulta SQL para actualizar el estado
            $this->db->query("UPDATE solicitudes_actualizacion 
        SET razon_rechazo = :rechazo, estado='rechazada'
        WHERE id = (
            SELECT id FROM (
                SELECT id 
                FROM solicitudes_actualizacion 
                WHERE id_residente = :Cedula 
                ORDER BY fecha_solicitud DESC 
                LIMIT 1
            ) AS subquery
        )");

            // Vincular los parámetros con los valores
            $this->db->bind(':Cedula', $datos['Cedula']);
            $this->db->bind(':rechazo', $datos['rechazo']);

            // Ejecutar la consulta
            $this->db->execute();
            return true;
        } catch (Exception $e) {
            // Deshacer la transacción en caso de error
            $this->db->rollBack();
            echo "Error: " . $e->getMessage();
            return false;
        }
    }
    
}
