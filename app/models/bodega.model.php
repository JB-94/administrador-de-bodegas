<?php
require_once "../config/conexion.php";

class bodega extends CConexion
{
  public static function mostrarDatos()
  {
    try {
      $sql = "SELECT bodega.id_bodega, id_comuna, nombre_bodega, direccion_bodega, dotacion_bodega,CONCAT(usuario.nombre_usuario,  ' ', usuario.primer_apellido_usuario, ' ', usuario.segundo_apellido_usuario) Encargado , fecha_creacion_bodega,
        CASE WHEN estado_bodega = '1' THEN 'activo' ELSE 'desactivado' END AS estado
        FROM bodega INNER JOIN usuario on usuario.id_bodega = bodega.id_bodega";
      $stmt = CConexion::ConexionDB()->prepare($sql);
      $stmt->execute();
      $result = $stmt->fetchAll();
      return $result;
    } catch (PDOException $th) {
      echo $th->getMessage();
    }
  }

  public static function mostrarComunas()
  {
    try {
      $sql = "SELECT * FROM comuna";
      $stmt = CConexion::ConexionDB()->prepare($sql);
      $stmt->execute();
      $result = $stmt->fetchAll();
      return $result;
    } catch (PDOException $th) {
      echo $th->getMessage();
    }
  }

  public static function mostrarEstado()
  {
    try {
      $sql = "SELECT * FROM bodega";
      $stmt = CConexion::ConexionDB()->prepare($sql);
      $stmt->execute();
      $result = $stmt->fetchAll();
      return $result;
    } catch (PDOException $th) {
      echo $th->getMessage();
    }
  }

  public static function mostrarUsuarios()
  {
    try {
      $sql = "SELECT * FROM usuario";
      $stmt = CConexion::ConexionDB()->prepare($sql);
      $stmt->execute();
      $result = $stmt->fetchAll();
      return $result;
    } catch (PDOException $th) {
      echo $th->getMessage();
    }
  }

  public static function obtenerDatosId($id)
{
  try {
    $sql = "SELECT nombre_bodega, id_comuna, direccion_bodega, dotacion_bodega, estado_bodega FROM bodega WHERE id_bodega = :id";
    $stmt = CConexion::ConexionDB()->prepare($sql);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $result = $stmt->fetch();
    return $result;
  } catch (PDOException $th) {
    echo $th->getMessage();
  }
}


  public static function guardarDato($data)
  {
    try {
      $fecha_creacion = date('Y-m-d H:i:s');
      $sql = "INSERT INTO bodega (id_bodega, id_comuna, nombre_bodega, direccion_bodega, dotacion_bodega, estado_bodega, fecha_creacion_bodega) VALUES (:id_bodega, :id_comuna, :nombre_bodega, :direccion_bodega, :dotacion_bodega, :estado_bodega, :fecha_creacion_bodega)";
      $stmt = CConexion::ConexionDB()->prepare($sql);
      $stmt->bindParam(':id_bodega', $data['id_bodega']);
      $stmt->bindParam(':id_comuna', $data['id_comuna']);
      $stmt->bindParam(':nombre_bodega', $data['nombre_bodega']);
      $stmt->bindParam(':direccion_bodega', $data['direccion_bodega']);
      $stmt->bindParam(':dotacion_bodega', $data['dotacion_bodega']);
      $estado_bodega = 1; // Se establece el estado a 1 (activo)
      $stmt->bindParam(':estado_bodega', $estado_bodega);
      $stmt->bindParam(':fecha_creacion_bodega', $fecha_creacion);
      $stmt->execute();

      $id_bodega = CConexion::ConexionDB()->lastInsertId();

      // Actualizar la tabla USUARIO
      $encargados = $_POST['encargados']; // Obtener los valores seleccionados del array
      
      if (!empty($encargados)) {
        $sqlUpdate = "UPDATE usuario SET id_bodega = :id_bodega WHERE id_usuario = :id_usuario";
        $stmtUpdate = CConexion::ConexionDB()->prepare($sqlUpdate);

        foreach ($encargados as $usuarioId) {
          $stmtUpdate->bindParam(':id_bodega', $id_bodega);
          $stmtUpdate->bindParam(':id_usuario', $usuarioId);
          $stmtUpdate->execute();
        }
      }
      return true;
    } catch (PDOException $th) {
      echo $th->getMessage();
    }
  }


  public static function actualizarDato($data)
  {
    try {
      $sql = "UPDATE bodega SET id_bodega = :id_bodega, id_comuna = :id_comuna, nombre_bodega = :nombre_bodega, direccion_bodega = :direccion_bodega, dotacion_bodega = :dotacion_bodega, estado_bodega = :estado_bodega, fecha_creacion_bodega = :fecha_creacion_bodega WHERE id_bodega = :id_bodega";
      $stmt = CConexion::ConexionDB()->prepare($sql);
      $stmt->bindParam(':id_bodega', $data['id_bodega']);
      $stmt->bindParam(':id_comuna', $data['id_comuna']);
      $stmt->bindParam(':nombre_bodega', $data['nombre_bodega']);
      $stmt->bindParam(':direccion_bodega', $data['direccion_bodega']);
      $stmt->bindParam(':dotacion_bodega', $data['dotacion_bodega']);
      $stmt->bindParam(':estado_bodega', $data['estado_bodega']);
      $stmt->bindParam(':fecha_creacion_bodega', $data['fecha_creacion_bodega']);
      $stmt->bindParam(':id_bodega', $data['id_bodega']);
      $stmt->execute();
      return true;
    } catch (PDOException $th) {
      echo $th->getMessage();
    }
  }

  public static function EliminarDato($id)
  {
    try {
      $sql = "DELETE FROM bodega WHERE id_bodega = :id";
      $stmt = CConexion::ConexionDB()->prepare($sql);
      $stmt->bindParam(':id', $id);
      $stmt->execute();
      return true;
    } catch (PDOException $th) {
      echo $th->getMessage();
    }
  }
}
