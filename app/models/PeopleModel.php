<?php

class PeopleModel
{
    private $db;

    public function __construct()
    {
        $this->db = new Base;
    }

    public function getPeopleByApart($numberApart)
    {
        $this->db->query("SELECT Pe_id FROM persona p  WHERE  p.Ap_id = $numberApart");

        return $this->db->registro();
    }
    public function documentPers($document)
    {
        $this->db->query("SELECT Pe_id FROM persona p  WHERE  p.Pe_id = $document");

        return $this->db->registro();
    }

    public function getNumberGuest()
    {

        $this->db->query("SELECT count(*) as total FROM registro WHERE Re_hora_salida = '00:00:00';");

        return $this->db->registro();
    }
    public function getGuestById($idGuest)
    {
        $this->db->query("UPDATE registro SET Re_hora_salida = CURRENT_TIME() WHERE Vi_id ='$idGuest'");

        return $this->db->registro();
    }

    public function getVisitas()
    {
        // $this->db->query("SELECT v.*,h.Re_motivo,h.Re_fecha_entrada,h.Re_hora_entrada,h.Re_hora_salida FROM visitantes v , registro h ");
        $this->db->query("SELECT DISTINCT *  FROM visitantes");
        return $this->db->showTables();
    }


    public function getPersonaById($id)
    {
        $this->db->query('SELECT persona.*, usuario.Ro_id, usuario.Us_correo, r.Ro_tipo, usuario.Us_contrasena, a.Ap_numero, t.To_letra,t.To_id FROM persona LEFT JOIN usuario ON persona.Pe_id = usuario.Us_id LEFT JOIN rol r ON usuario.Ro_id = r.Ro_id LEFT JOIN apartamento a ON persona.Ap_id = a.Ap_id LEFT JOIN torre t ON a.To_id = t.To_id   WHERE Pe_id = :id');
        $this->db->bind(':id', $id);
        return $this->db->registro(); // Devuelve un solo registro
    }

    public function getAllRegistro($id)
    {
        $this->db->query("SELECT * FROM registro WHERE Vi_id = :id");
        $this->db->bind(':id', $id); // Usa parámetros para evitar inyección SQL
        $result = $this->db->registros(); // Asegúrate de usar 'registros()' para obtener múltiples resultados

        return $result ?: false; // Devuelve false si no hay resultados
    }





    public function PeopleID($id)
    {
        $this->db->query(
            "SELECT p.*, COUNT(a.Pa_Id) AS Total_paquetes, a.Pa_estado, a.Pa_fecha, a.Pa_descripcion FROM persona p LEFT JOIN paquete a ON p.Pe_id = a.Pe_id WHERE p.Pe_id = $id AND a.Pa_estado != 'Entregado' GROUP BY p.Pe_id;
"
        );
        return $this->db->registro();
    }
    public function showRegistro()
    {
        $this->db->query("SELECT v.Vi_nombres,r.*,v.Vi_departamento from visitantes v , registro r where v.Vi_id=r.Vi_id");
        return $this->db->showTables();
    }

    //No tocar este metodo
    public function getAllUsuario($roleId = null)
    {
        if ($roleId) {
            // Consulta con filtro por Rol
            $this->db->query('
            SELECT persona.*, usuario.Ro_id, usuario.Us_correo, r.Ro_tipo, usuario.Us_contrasena, a.Ap_numero, t.To_letra, t.To_id 
            FROM persona 
            LEFT JOIN usuario ON persona.Pe_id = usuario.Us_id 
            LEFT JOIN rol r ON usuario.Ro_id = r.Ro_id 
            LEFT JOIN apartamento a ON persona.Ap_id = a.Ap_id 
            LEFT JOIN torre t ON a.To_id = t.To_id 
            WHERE usuario.Ro_id = :roleId
        ');
            $this->db->bind(':roleId', $roleId);
        } else {
            // Consulta sin filtro por Rol
            $this->db->query('
            SELECT persona.*, usuario.Ro_id, usuario.Us_correo, r.Ro_tipo, usuario.Us_contrasena, a.Ap_numero, t.To_letra, t.To_id 
            FROM persona 
            LEFT JOIN usuario ON persona.Pe_id = usuario.Us_id 
            LEFT JOIN rol r ON usuario.Ro_id = r.Ro_id 
            LEFT JOIN apartamento a ON persona.Ap_id = a.Ap_id 
            LEFT JOIN torre t ON a.To_id = t.To_id
        ');
        }

        return $this->db->registros(); // Devuelve todos los registros
    }

    public function getPackeges()
    {
        $this->db->query("select a.Pe_id,a.Pe_nombre,p.* from paquete p , persona a where a.Pe_id=p.Pe_id;");
        return $this->db->showTables();
    }
    // public function searchVisitor($cedula)
    // {
    //     $this->db->query('SELECT * FROM visitantes WHERE Vi_id = :Cedula');
    //     $this->db->bind(':Cedula', $cedula);
    //     return $this->db->registros(); 
    // }

    public function actualizarPaquete($paqueteId, $nuevoEstado)
    {
        $sql = "UPDATE paquete SET Pa_estado = :estado WHERE Pa_id = :id";
        $this->db->query($sql);
        $this->db->bind(':estado', $nuevoEstado);
        $this->db->bind(':id', $paqueteId);

        return $this->db->execute();
    }

    // pagina de registro y verificaciones del form de torre y de apartamentos

    public function torres()
    {
        $this->db->query("SELECT * FROM torre");
        return $this->db->showTables();
    }
    public function apartamentos()
    {
        $this->db->query("SELECT t.* , a.Ap_numero from torre t,apartamento a where a.To_id=t.To_id;");
        return $this->db->showTables();
    }

    // funciones de torre 
    public function IngresarTorre($id, $letra) {
        if ($this->existTorre($id, $letra)) {
            return "El ID o la letra de la torre ya existe. No se puede guardar.";
        }
    
        $this->db->query('INSERT INTO torre (To_id, To_letra) VALUES (:id, :letra)');
        $this->db->bind(':id', $id);
        $this->db->bind(':letra', $letra);
        return $this->db->execute() ? "Torre guardada correctamente." : "Error al guardar la torre.";
    }
    
    public function existTorre($id, $letra = null) {
        $this->db->query('SELECT COUNT(*) as count FROM torre WHERE To_id = :id OR To_letra = :letra');
        $this->db->bind(':id', $id);
        $this->db->bind(':letra', $letra);
        $row = $this->db->registro();
        return $row->count > 0;
    }
    
    public function isTorreInUse($id) {
        // Verificar si existen apartamentos asociados a esta torre
        $this->db->query('SELECT COUNT(*) as count FROM apartamento WHERE To_id = :id');
        $this->db->bind(':id', $id);
        $row = $this->db->registro(); // Obtiene un objeto stdClass
        return $row->count > 0; // Verificar si hay apartamentos asociados
    }

    public function DeleteTorre($id) {
        // Primero verificamos si la torre está en uso
        if ($this->isTorreInUse($id)) {
            return "No se puede eliminar la torre, ya que tiene departamentos asociados.";
        }
    
        // Si no está en uso, procedemos a eliminarla
        // Iniciar una transacción
        $this->db->beginTransaction();
    
        try {
            // Eliminar primero los apartamentos relacionados con la torre
            $this->db->query('DELETE FROM apartamento WHERE To_id = :id');
            $this->db->bind(':id', $id);
            $this->db->execute();
    
            // Luego eliminar la torre
            $this->db->query('DELETE FROM torre WHERE To_id = :id');
            $this->db->bind(':id', $id);
            $this->db->execute();
    
            // Hacer commit si todo sale bien
            $this->db->commit();
            return "Torre y apartamentos eliminados correctamente.";
        } catch (Exception $e) {
            // En caso de error, revertir la transacción
            $this->db->rollBack();
            return "Error al eliminar la torre y los apartamentos: " . $e->getMessage();
        }
    }
    

    
    // funciones de apartamento


    public function IngresarApartamento($torreInput, $apartamento) {
        $torreId = $this->getTorreByIdOrLetra($torreInput);
    
        if (!$torreId) {
            return "Torre no encontrada. Verifique el número o letra de la torre.";
        }
    
        if ($this->existsApartamento($torreId, $apartamento)) {
            return "El apartamento ya existe en la torre indicada.";
        }
    
        $this->db->query('INSERT INTO apartamento (To_id, Ap_numero) VALUES (:torreId, :apartamento)');
        $this->db->bind(':torreId', $torreId);
        $this->db->bind(':apartamento', $apartamento);
        return $this->db->execute() ? "Apartamento guardado correctamente." : "Error al guardar el apartamento.";
    }
    
    

    public function existsApartamento($torreId, $apartamento) {
        $this->db->query('SELECT COUNT(*) as count FROM apartamento WHERE To_id = :torreId AND Ap_numero = :apartamento');
        $this->db->bind(':torreId', $torreId);
        $this->db->bind(':apartamento', $apartamento);
        $row = $this->db->registro();
        return $row->count > 0;
    }
    
    

    public function DeleteApartamento($torre, $apartamento) {
        $this->db->query('DELETE FROM apartamento WHERE To_id = :torre AND Ap_numero = :apartamento');
        $this->db->bind(':torre', $torre);
        $this->db->bind(':apartamento', $apartamento);
        return $this->db->registro();
    }

    public function getTorreByIdOrLetra($torre) {
        $this->db->query('SELECT To_id FROM torre WHERE To_id = :torre OR To_letra = :torre');
        $this->db->bind(':torre', $torre);
        $row = $this->db->registro();
        return $row ? $row->To_id : null; 
    }
    
    
}
