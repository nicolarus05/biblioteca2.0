<?php
require_once 'modelo.php';
    class Libro extends Modelo {
        
        /**
         * Constructor
         * Llama al constructor del padre.
         */
        public function __construct(){
            parent::__construct('libros');
        }

        /**
         * Inserta un nuevo libro.
         * @param string $titulo Título del libro.
         * @param string $genero Género del libro.
         * @param int $autor ID del autor del libro.
         * @param int $nPaginas Número de páginas del libro.
         * @param int $nEjemplares Número de ejemplares disponibles del libro.
         */
        public function insertar($titulo, $genero,$autor,$nPaginas,$nEjemplares){
            $sql = "INSERT INTO $this->tabla (titulo, genero, idAutor, numPaginas, nEjemplaresDisponibles) VALUES (:titulo, :genero, :autor, :nPaginas, :nEjemplares)";    
            $stmt = $this->conexion->prepare($sql);
            $stmt->bindParam(':titulo', $titulo);  
            $stmt->bindParam(':genero', $genero);
            $stmt->bindParam(':autor', $autor);
            $stmt->bindParam(':nPaginas', $nPaginas);
            $stmt->bindParam(':nEjemplares', $nEjemplares);
            try{
                $stmt->execute();
            }catch(PDOException $e){
                echo "Error al insertar el libro: " . $e->getMessage();
            }
            return $this->conexion->lastInsertId();
        }

        /**
         * Actualiza un libro.
         * @param int $id ID del libro.
         * @param string $titulo Título del libro.
         * @param string $genero Género del libro.
         * @param int $autor ID del autor del libro.
         * @param int $nPaginas Número de páginas del libro.
         * @param int $nEjemplares Número de ejemplares disponibles del libro.
         */
        public function actualizar($id, $titulo, $genero,$autor,$nPaginas,$nEjemplares){
            $sql = "UPDATE  $this->tabla SET titulo = :titulo, genero = :genero, idAutor = :autor, numPaginas = :nPaginas, nEjemplaresDisponibles = :nEjemplares WHERE id = :id";
            $stmt = $this->conexion->prepare($sql);
            $stmt->bindParam(':titulo', $titulo);
            $stmt->bindParam(':genero', $genero);
            $stmt->bindParam(':autor', $autor);
            $stmt->bindParam(':nPaginas', $nPaginas);
            $stmt->bindParam(':nEjemplares', $nEjemplares);
            $stmt->bindParam(':id', $id);
            try{
                $stmt->execute();
            }catch(PDOException $e){
                echo "Error al actualizar el libro: " . $e->getMessage();
            }
        }

    }
?>