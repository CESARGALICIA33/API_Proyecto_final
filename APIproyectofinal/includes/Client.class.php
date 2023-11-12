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

        public static function insertarUsuario($correo, $contrasena)
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


    }

?>