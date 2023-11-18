<?php

    require_once ('Database.class.php');

    class Client{


        //GET
        public static function ObtenerCandidatoPorId($Iduser)
        {
            $conexion = new Conexion();

            try {
                $query = "SELECT * FROM candidato WHERE IdUsuario = :Iduser";
                $statement = $conexion->prepare($query);
                $statement->bindParam(':Iduser', $Iduser);
                $statement->execute();

                $candidato = $statement->fetch(PDO::FETCH_ASSOC);

                header('Content-Type: application/json');

                if ($candidato) {
                    // Candidato encontrado, devuelve información relevante
                    header('HTTP/1.1 201 Empresa creado correctamente');
                    echo json_encode($candidato);
                } else {
                    // Candidato no encontrado, proporciona un mensaje de error
                    header('HTTP/1.1 404 Not Found');
                    echo json_encode(array('error' => 'Candidato no encontrado'));
                }

            } catch (PDOException $e) {
                // Manejar errores de la base de datos
                header('HTTP/1.1 500 Internal Server Error');
                echo json_encode(array('error' => 'Error en la base de datos: ' . $e->getMessage()));
            }
        }

        public static function ObtenerCorreoPorId($Iduser)
        {
            $conexion = new Conexion();

            try {
                $query = "SELECT * FROM usuario WHERE ID = :Iduser";
                $statement = $conexion->prepare($query);
                $statement->bindParam(':Iduser', $Iduser);
                $statement->execute();

                $candidato = $statement->fetch(PDO::FETCH_ASSOC);

                header('Content-Type: application/json');

                if ($candidato) {
                    // Candidato encontrado, devuelve información relevante
                    header('HTTP/1.1 201');
                    echo json_encode($candidato);
                } else {
                    // Candidato no encontrado, proporciona un mensaje de error
                    header('HTTP/1.1 404 Not Found');
                    echo json_encode(array('error' => 'Candidato no encontrado'));
                }

            } catch (PDOException $e) {
                // Manejar errores de la base de datos
                header('HTTP/1.1 500 Internal Server Error');
                echo json_encode(array('error' => 'Error en la base de datos: ' . $e->getMessage()));
            }
        }

        
        
        
        //POST
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
                    echo json_encode([ 'userId' => $usuarioId]);//devuelve el id para que este se inserte en idusuario del candidato
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
            //eliminar clase ya se realiza en otra funcion
        /*public static function validarCredenciales($correo, $contrasena, $accountType)
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
        }*/


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

        public static function InsertarComentarios($experiencia, $motivos)
        {
            $conexion = new Conexion();

            
                $query = "INSERT INTO comentarios (Experiencia, Motivos) VALUES (:experiencia, :motivos)";
                $statement = $conexion->prepare($query);
                $statement->bindParam(':experiencia', $experiencia);
                $statement->bindParam(':motivos', $motivos);
                $statement->execute();

                if ($statement->rowCount() > 0) {
                    $success = true;
                    header('HTTP/1.1 201 Comentarios insertados correctamente');
                    echo json_encode($success);
                    
                } else {
                    $success = false;
                    header('HTTP/1.1 404 Error al insertar comentarios');
                    echo json_encode($success);
                }
         
        
        }
        
        //metodo DELETE
        public static function EliminarCandidato($Iduser)
        {
            $conexion = new Conexion();

           
                $query = "DELETE FROM candidato WHERE IdCandidato = :Iduser";
                $statement = $conexion->prepare($query);
                $statement->bindParam(':Iduser', $Iduser);
                $statement->execute();

                if ($statement->rowCount() > 0) {
                    $success = true;
                    header('HTTP/1.1 200 Candidato Eliminado');
                    echo json_encode($success);
                } else {
                    $success = false;
                    header('HTTP/1.1 404 Error en la elminacion');
                    echo json_encode($success);
                }
           
        }

        public static function EliminarCorreo($Iduser)
        {
            $conexion = new Conexion();

           
                $query = "DELETE FROM usuario WHERE ID = :Iduser";
                $statement = $conexion->prepare($query);
                $statement->bindParam(':Iduser', $Iduser);
                $statement->execute();

                if ($statement->rowCount() > 0) {
                    $success = true;
                    header('HTTP/1.1 200 Correo Eliminado');
                    echo json_encode($success);
                } else {
                    $success = false;
                    header('HTTP/1.1 404 Error en la elminacion');
                    echo json_encode($success);
                }
           
        }

        //PUT
        public static function ActualizarCandidato($nombre, $apellido_materno, $apellido_paterno, $genero, $telefono, $calle, $colonia, $num_int, $num_ext, $codigoPostal, $experiencia, $educacion, $habilidades, $fecha_nacimiento, $curriculumContent, $constanciaContent, $disponibilidad, $salario, $Iduser)
        {
            $conexion = new Conexion();
        
            try {
            $query = "UPDATE candidato
            SET Nombre = :nombre,
                ApellidoPaterno = :apellido_paterno,
                ApellidoMaterno = :apellido_materno,
                Género = :genero,
                Teléfono = :telefono,
                Calle = :calle,
                Colonia = :colonia,
                NumInt = :num_int,
                NumExt = :num_ext,
                CódigoPostal = :codigoPostal,
                ExperienciaLaboral = :experiencia,
                Educación = :educacion,
                Habilidades = :habilidades,
                FechaNacimiento = :fecha_nacimiento,
                CurriculumVitae = :curriculum,
                Constancia = :contancia,
                Disponibilidad = :disponibilidad,
                Salario = :salario
            WHERE IdCandidato = :Iduser;
            ";
        
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
            $statement->bindParam(':Iduser', $Iduser);
        
            $statement->execute();
        
            if ($statement->rowCount() > 0) {
                $success = true;
                header('HTTP/1.1 201 Candidato actualizado correctamente');
                echo json_encode($success);
            } else {
                $success = false;
                header('HTTP/1.1 404 Candidato no actualizado correctamente');
                echo json_encode($success);
            }

        } catch (PDOException $e) {
            // Manejar errores de la base de datos
            header('HTTP/1.1 500 Internal Server Error');
            echo json_encode(['error' => 'Error en la base de datos: ' . $e->getMessage()]);
        }
            
        }

        public static function ActualizarUsuario($correo, $contrasena, $Iduser)
        {
            $conexion = new Conexion();

            try {
                $query = "UPDATE usuario
                SET Correo = :correo, 
                Contraseña = :contrasena
                WHERE ID = :Iduser;
                ";
                $statement = $conexion->prepare($query);
                $statement->bindParam(':correo', $correo);
                $statement->bindParam(':contrasena', $contrasena);
                $statement->bindParam(':Iduser', $Iduser);
                $statement->execute();

                if ($statement->rowCount() > 0) {
                    // Usuario creado correctamente
                    $usuarioId = $conexion->lastInsertId(); // Obtener el ID del usuario recién insertado
                    $success = true;
                    header('HTTP/1.1 201 Usuario creado correctamente');
                    echo json_encode($success);//devuelve el id para que este se inserte en idusuario del candidato
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



    }

?>