<?php

    require_once ('Database.class.php');

    class Client{

        public static function insertarEmpresa($nombre, $contrasena)
        {
            $conexion = new Conexion();

            
                $query = "INSERT INTO empresa (Nombre, Contraseña) VALUES (:nombre, :contrasena)";
                $statement = $conexion->prepare($query);
                $statement->bindParam(':nombre', $nombre);
                $statement->bindParam(':contrasena', $contrasena);
                $statement->execute();

                if ($statement->rowCount() > 0) {
                    $success = true;
                    header('HTTP/1.1 201 Empresa creado correctamente');
                    echo json_encode($success);
                    
                } else {
                    $success = false;
                    header('HTTP/1.1 404 Empresa no creado correctamente');
                    echo json_encode($success);
                }
         
        
        }

        /*public static function insertarUsuario($correo, $contrasena)
        {
            $conexion = new Conexion();

            
                $query = "INSERT INTO usuario (Correo, Contraseña) VALUES (:correo, :contrasena)";
                $statement = $conexion->prepare($query);
                $statement->bindParam(':correo', $correo);
                $statement->bindParam(':contrasena', $contrasena);
                $statement->execute();
        
                if ($statement->rowCount() > 0) {
                    $success = true;
                    header('HTTP/1.1 201 Usuario creado correctamente');
                    echo json_encode($success);
                } else {
                    $success = false;
                    header('HTTP/1.1 404 Usuario no creado correctamente');
                    echo json_encode($success);
                }
            
        }*/

        public static function insertarUsuario($correo, $contrasena)
{
    $conexion = new Conexion();

    try {
        $query = "INSERT INTO usuario (Correo, Contraseña) VALUES (:correo, :contrasena)";
        $statement = $conexion->prepare($query);
        $statement->bindParam(':correo', $correo);
        $statement->bindParam(':contrasena', $contrasena);
        $statement->execute();

        if ($statement->rowCount() > 0) {
            // Usuario creado correctamente
            $usuarioId = $conexion->lastInsertId(); // Obtener el ID del usuario recién insertado
            $success = true;
            header('HTTP/1.1 201 Usuario creado correctamente');
            echo json_encode([ 'userId' => $usuarioId]);
        } else {
            // Error al crear el usuario
            $success = false;
            header('HTTP/1.1 404 Usuario no creado correctamente');
            echo json_encode(['success' => $success]);
        }
    } catch (PDOException $e) {
        // Manejar errores de la base de datos
        header('HTTP/1.1 500 Internal Server Error');
        echo json_encode(['error' => 'Error en la base de datos: ' . $e->getMessage()]);
    }
}



        public static function insertarAreaPost($nombre, $descripcion)
        {
            $conexion = new Conexion();


                $query = "INSERT INTO areapostulacion (Nombre, Descripcion) VALUES (:nombre, :descripcion)";
                $statement = $conexion->prepare($query);
                $statement->bindParam(':nombre', $nombre);
                $statement->bindParam(':descripcion', $descripcion);
                $statement->execute();
        
                if ($statement->rowCount() > 0) {
                    $success = true;
                    header('HTTP/1.1 201 Area creada correctamente');
                    echo json_encode($success);
                } else {
                    $success = false;
                    header('HTTP/1.1 404 Area no creada correctamente');
                    echo json_encode($success);
                }
            
        }
            //eliminar clase
        public static function validarCredenciales($correo, $contrasena, $accountType)
        {
            $conexion = new Conexion();

            try {
                if ($accountType == 2) {
                    $query = "SELECT * FROM empresa WHERE Nombre = :correo AND Contraseña = :contrasena";
                } else if ($accountType == 1) {
                    $query = "SELECT * FROM usuario WHERE Correo = :correo AND Contraseña = :contrasena";
                }

                $statement = $conexion->prepare($query);
                $statement->bindParam(':correo', $correo);
                $statement->bindParam(':contrasena', $contrasena);
                $statement->execute();

                if ($statement->rowCount() > 0) {
                    $success = true;
                    header('HTTP/1.1 200 OK');
                    echo json_encode($success);
                } else {
                    $success = false;
                    header('HTTP/1.1 404 No autorizado desde api');
                    echo json_encode($success);
                }
            } catch (PDOException $e) {
                header('HTTP/1.1 500 Internal Server Error');
                echo json_encode(array('error' => 'Error en la base de datos: ' . $e->getMessage()));
            }
        }


        public static function InsertarCandidato($nombre, $apellido_materno, $apellido_paterno, $genero, $telefono, $calle, $colonia, $num_int, $num_ext, $codigoPostal, $experiencia, $educacion, $habilidades, $fecha_nacimiento, $curriculumContent, $constanciaContent, $disponibilidad, $salario, $idusuario)
        {
            $conexion = new Conexion();
        
            $query = "INSERT INTO candidato (Nombre, ApellidoPaterno, ApellidoMaterno, Género, Teléfono, Calle, Colonia, NumInt, NumExt, CódigoPostal, ExperienciaLaboral, Educación, Habilidades, FechaNacimiento, CurriculumVitae, Constancia, Disponibilidad, Salario, IdUsuario) VALUES (:nombre, :apellido_materno, :apellido_paterno, :genero, :telefono, :calle, :colonia, :num_int, :num_ext, :codigoPostal, :experiencia, :educacion, :habilidades, :fecha_nacimiento, :curriculum, :contancia, :disponibilidad, :salario, :idusuario)";
        
            $statement = $conexion->prepare($query);
            $statement->bindParam(':nombre', $nombre);
            $statement->bindParam(':apellido_paterno', $apellido_paterno);
            $statement->bindParam(':apellido_materno', $apellido_materno);
            $statement->bindParam(':genero', $genero);
            $statement->bindParam(':telefono', $telefono);
            $statement->bindParam(':calle', $calle);
            $statement->bindParam(':colonia', $colonia);
            $statement->bindParam(':num_int', $num_int);
            $statement->bindParam(':num_ext', $num_ext);
            $statement->bindParam(':codigoPostal', $codigoPostal);
            $statement->bindParam(':experiencia', $experiencia);
            $statement->bindParam(':educacion', $educacion);
            $statement->bindParam(':habilidades', $habilidades);
            $statement->bindParam(':fecha_nacimiento', $fecha_nacimiento);
            $statement->bindParam(':curriculum', $curriculumContent, PDO::PARAM_LOB);
            $statement->bindParam(':contancia', $constanciaContent, PDO::PARAM_LOB);
            $statement->bindParam(':disponibilidad', $disponibilidad);
            $statement->bindParam(':salario', $salario);
            $statement->bindParam(':idusuario', $idusuario);
        
            $statement->execute();
        
            if ($statement->rowCount() > 0) {
                $success = true;
                header('HTTP/1.1 201 Candidato creada correctamente');
                echo json_encode($success);
            } else {
                $success = false;
                header('HTTP/1.1 404 Candidato no creada correctamente');
                echo json_encode($success);
            }
        }
        
        




    }

?>