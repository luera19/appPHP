<?php
    //importando la conexion
    include_once '../configuraciones/bd.php';
    //invocando la conexion
    $conexionBD= Conectar::crearInstancia();

    $id =isset($_POST['id'])?$_POST['id']:'';
    $nombre_curso = isset($_POST['nombre_curso'])?$_POST['nombre_curso']:'';
    $accion = isset($_POST['accion'])?$_POST['accion']:'';

    if($accion!=''){
        switch($accion){
            //AGREGAR
            case 'agregar':
                $sql = "INSERT INTO cursos (id, nombre_curso) VALUES (NULL, :nombre_curso)";
                //Preparando la consulta
                $consulta = $conexionBD->prepare($sql);
                //Pasando la consulta en parámetro
                $consulta ->bindParam(':nombre_curso',$nombre_curso);
                //Ejecutamos la consulta
                $consulta ->execute();
            break;

            //EDITAR
            case 'editar':
                //Sentencia SQL para editar
                $sql="UPDATE cursos SET nombre_curso=:nombre_curso WHERE id=:id";
                //Preparando la consulta
                $consulta=$conexionBD->prepare($sql);
                //Pasando la consulta (pasamos dos parametros al editar id y nombre_curso)
                $consulta->bindParam(':id',$id);
                $consulta->bindParam(':nombre_curso',$nombre_curso);
                //Ejecutar la accion
                $consulta->execute();
            break;

            //BORRAR
            case 'borrar':
                //Sentencia SQL para borrar de acuerdo al id
                $sql="DELETE FROM cursos WHERE id=:id";
                //Preparando la consulta
                $consulta=$conexionBD->prepare($sql);
                //Pasando la consulta
                $consulta->bindParam(':id',$id);
                //Ejecutar la accion
                $consulta->execute();
            break;

            //SELECCIONAR
            case 'Seleccionar':
                $sql="SELECT * FROM cursos WHERE id=:id";
                //Preparando la consulta
                $consulta=$conexionBD->prepare($sql);
                //Pasando la consulta en parámetro
                $consulta->bindParam(':id',$id);
                //Ejecutamos la consulta
                $consulta ->execute();

                $curso=$consulta->fetch(PDO::FETCH_ASSOC);
                
                $nombre_curso=$curso['nombre_curso'];

            break;


        }
    }

   //CONSULTAR

    $sql = $conexionBD -> prepare("SELECT * FROM cursos");

    $sql ->execute();

    $listaCursos = $sql-> fetchAll();

    
