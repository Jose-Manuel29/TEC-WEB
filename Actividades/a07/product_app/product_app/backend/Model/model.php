<?php
    namespace TECWEB\MYAPI;

    use TECWEB\MYAPI\DataBase as DataBase;

    require_once __DIR__ . '/DataBase.php';

    class Model extends DataBase {

        private $data = NULL; //arreglo
        //1. Constructor
        public function __construct($db, $user='root', $pass='290105.') {
            $this->data = array();
            parent:: __construct($user, $pass, $db);
        }
        //2. Función para la lista de productos
        public function list() {
            $this->data = array();

            if ( $result = $this->conexion->query("SELECT * FROM productos WHERE eliminado = 0") ) {
                $rows = $result->fetch_all(MYSQLI_ASSOC);
                if(!is_null($rows)) {
                    foreach($rows as $num => $row) {
                        foreach($row as $key => $value) {
                            $this->data[$num][$key] = ($value);
                        }
                    }
                }
                $result->free();
            } else {
                die('Query Error: '.mysqli_error($this->conexion));
            }
            $this->conexion->close();
        }
        //3.- Función para búsqueda de productos
        public function search($search) {
            $sql = "SELECT * FROM productos 
                    WHERE (id = '{$search}' 
                    OR nombre LIKE '%{$search}%' 
                    OR marca LIKE '%{$search}%' 
                    OR detalles LIKE '%{$search}%') 
                    AND eliminado = 0";
        
            if ($result = $this->conexion->query($sql)) {
                $rows = $result->fetch_all(MYSQLI_ASSOC);
        
                if (!is_null($rows)) {
                    foreach ($rows as $num => $row) {
                        foreach ($row as $key => $value) {
                            $this->data[$num][$key] = $value;
                        }
                    }
                }
        
                $result->free();
            } else {
                $this->data = [
                    'status' => 'error',
                    'message' => 'Error en la búsqueda: ' . mysqli_error($this->conexion)
                ];
            }
        
            $this->conexion->close();
        }

        public function getData() {
            //4. Devuelve el contenido del atributo privado data y lo convierte a JSON.
            return json_encode($this->data, JSON_PRETTY_PRINT);
        }

        //5. Función para inserción de productos
        public function add($jsonOBJ) {
            if (!isset($jsonOBJ->nombre)) {
                $this->data = [
                    'status' => 'error',
                    'message' => 'Datos incompletos o JSON inválido'
                ];
                return;
            }
        
            $sql = "SELECT * FROM productos WHERE nombre = '{$jsonOBJ->nombre}' AND eliminado = 0";
            $result = $this->conexion->query($sql);
        
            if ($result->num_rows == 0) {
                $this->conexion->set_charset("utf8");
        
                $sql = "INSERT INTO productos VALUES (
                    null, 
                    '{$jsonOBJ->nombre}', 
                    '{$jsonOBJ->marca}', 
                    '{$jsonOBJ->modelo}', 
                    {$jsonOBJ->precio}, 
                    '{$jsonOBJ->detalles}', 
                    {$jsonOBJ->unidades}, 
                    '{$jsonOBJ->imagen}', 
                    0
                )";
        
                if ($this->conexion->query($sql)) {
                    $this->data = [
                        'status' => 'success',
                        'message' => 'Producto agregado'
                    ];
                } else {
                    $this->data = [
                        'status' => 'error',
                        'message' => 'Error en la inserción: ' . mysqli_error($this->conexion)
                    ];
                }
            } else {
                $this->data = [
                    'status' => 'error',
                    'message' => 'Ya existe un producto con ese nombre'
                ];
            }
        
            $result->free();
            $this->conexion->close();
        }
        //6. Función para eliminar productos
        public function delete($id) {
            if (!$id) {
                $this->data = [
                    'status' => 'error',
                    'message' => 'ID no proporcionado'
                ];
                return;
            }
            $sql = "UPDATE productos SET eliminado = 1 WHERE id = {$id}";
            if ($this->conexion->query($sql)) {
                $this->data = [
                    'status' => 'success',
                    'message' => 'Producto eliminado'
                ];
            } else {
                $this->data = [
                    'status' => 'error',
                    'message' => "ERROR: No se ejecutó $sql. " . mysqli_error($this->conexion)
                ];
            }

            $this->conexion->close();
        }
        //7. Función para editar productos
        public function edit($jsonOBJ) {
            if (!isset($jsonOBJ->id)) {
                $this->data = [
                    'status' => 'error',
                    'message' => 'ID no proporcionado'
                ];
                return;
            }
        
            $this->conexion->set_charset("utf8");
        
            $sql  = "UPDATE productos SET ";
            $sql .= "nombre='{$jsonOBJ->nombre}', ";
            $sql .= "marca='{$jsonOBJ->marca}', ";
            $sql .= "modelo='{$jsonOBJ->modelo}', ";
            $sql .= "precio={$jsonOBJ->precio}, ";
            $sql .= "detalles='{$jsonOBJ->detalles}', ";
            $sql .= "unidades={$jsonOBJ->unidades}, ";
            $sql .= "imagen='{$jsonOBJ->imagen}' ";
            $sql .= "WHERE id={$jsonOBJ->id}";
        
            if ($this->conexion->query($sql)) {
                $this->data = [
                    'status' => 'success',
                    'message' => 'Producto actualizado'
                ];
            } else {
                $this->data = [
                    'status' => 'error',
                    'message' => "ERROR: No se ejecutó $sql. " . mysqli_error($this->conexion)
                ];
            }
        
            $this->conexion->close();
        }
        //8. Función para buscar por nombre los productos
        public function name($nombre) {
            if (!$nombre) {
                $this->data = [
                    'status' => 'error',
                    'message' => 'Nombre no proporcionado'
                ];
                return;
            }
        
            $nombre = $this->conexion->real_escape_string($nombre);
        
            $sql = "SELECT id FROM productos WHERE nombre = '$nombre' AND eliminado = 0";
            $result = $this->conexion->query($sql);
        
            $this->data = ['existe' => false];
        
            if ($result && $result->num_rows > 0) {
                $this->data['existe'] = true;
            }
        
            $result && $result->free();
            $this->conexion->close();
        }
        //9. Función para buscar por id
        public function single($id) {
            if (!$id) {
                $this->data = [
                    'status' => 'error',
                    'message' => 'ID no proporcionado'
                ];
                return;
            }

            $sql = "SELECT * FROM productos WHERE id = {$id}";

            if ($result = $this->conexion->query($sql)) {
                $row = $result->fetch_assoc();

                if (!is_null($row)) {
                    foreach ($row as $key => $value) {
                        $this->data[$key] = $value;
                    }
                }

                $result->free();
            } else {
                $this->data = [
                    'status' => 'error',
                    'message' => 'Error en la consulta: ' . mysqli_error($this->conexion)
                ];
            }

            $this->conexion->close();
        }
        //10. Búsqueda del producto por nombre en lugar de ID
        public function singleByName($name) {
            if (!$name) {
                $this->data = [
                    'status' => 'error',
                    'message' => 'Nombre no proporcionado'
                ];
                return;
            }
        
            $this->conexion->set_charset("utf8");
        
            $sql = "SELECT * FROM productos WHERE nombre = '{$name}'";
        
            if ($result = $this->conexion->query($sql)) {
                $row = $result->fetch_assoc();
        
                if (!is_null($row)) {
                    foreach ($row as $key => $value) {
                        $this->data[$key] = $value;
                    }
                } else {
                    $this->data = [
                        'status' => 'error',
                        'message' => 'Producto no encontrado'
                    ];
                }
        
                $result->free();
            } else {
                $this->data = [
                    'status' => 'error',
                    'message' => 'Error en la consulta: ' . mysqli_error($this->conexion)
                ];
            }
        
            $this->conexion->close();
        }        
    }
?>