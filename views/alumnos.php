<?php
    include_once '../models/bd.php';
    $conexionBD=Conectar::crearInstancia();
    
    //Validación de campos
    $id=isset($_POST['id'])?$_POST['id']:'';
    $nombre=isset($_POST['nombre'])?$_POST['nombre']:'';
    $apellidos=isset($_POST['apellidos'])?$_POST['apellidos']:'';
    
    $cursos=isset($_POST['cursos'])?$_POST['cursos']:'';
    $accion=isset($_POST['accion'])?$_POST['accion']:'';
    
    
    
    if($accion!=""){
        
        //Switch CRUD
        switch($accion){
            
            //Agregar
            case 'agregar':
    
                $sql="INSERT INTO alumnos (id, nombre, apellidos) VALUES (NULL,:nombre,:apellidos)";
                $consulta=$conexionBD->prepare($sql);
                $consulta->bindParam(':nombre',$nombre);
                $consulta->bindParam(':apellidos',$apellidos);
                $consulta->execute();
                
                $idAlumno=$conexionBD->lastInsertId();
    
                //Ingresando los cursos en los alumnos relacionados al alumno
                foreach($cursos as $curso){
                    $sql="INSERT INTO alumnos_cursos (id, idalumno, idcurso) VALUES (NULL,:idalumno,:idcurso)";
                    $consulta=$conexionBD->prepare($sql);
                    $consulta->bindParam(':idalumno',$idAlumno);
                    $consulta->bindParam(':idcurso',$curso);
                    $consulta->execute();
                }
    
            break;
            
            //Consultar
            case 'Consultar':
                $sql="SELECT * FROM alumnos WHERE id=:id";
                $consulta=$conexionBD->prepare($sql);
                $consulta->bindParam(':id',$id);
                $consulta->execute();
                $alumno=$consulta->fetch(PDO::FETCH_ASSOC);
                
                //Recuperando la info de nombre y apellidos
                $nombre=$alumno['nombre'];
                $apellidos=$alumno['apellidos'];
                
                //Recuperando la info relacionada
                //Sentencia SQL
                $sql="SELECT cursos.id FROM alumnos_cursos 
                INNER JOIN cursos ON cursos.id=alumnos_cursos.idcurso 
                WHERE alumnos_cursos.idalumno=:idalumno";

                //Realiza la consulta
                $consulta=$conexionBD->prepare($sql);
                //Envia el parametro id
                $consulta->bindParam(':idalumno',$id);
                //Ejecuta la consulta
                $consulta->execute();
                //Recupera los datos de la BD
                $cursosAlumno=$consulta->fetchAll(PDO::FETCH_ASSOC);
    
                //Recorre el arreglo de los cursos y se guarda en $arregloCursos
                foreach($cursosAlumno as $curso){
                        $arregloCursos[]=$curso['id'];
                    }
                break;
            
            //Borrar
            case "borrar":
                $sql="DELETE FROM alumnos WHERE id=:id";
                $consulta=$conexionBD->prepare($sql);
                $consulta->bindParam(':id',$id);
                $consulta->execute();
            break;
            
            //Editar
            case "editar":
                $sql="UPDATE alumnos SET nombre=:nombre, apellidos=:apellidos
                 WHERE id=:id";
                $consulta=$conexionBD->prepare($sql);
                $consulta->bindParam(':nombre',$nombre);
                $consulta->bindParam(':apellidos',$apellidos);
                $consulta->bindParam(':id',$id);
                $consulta->execute();
    
                if(isset($cursos)){
    
                    $sql="DELETE FROM alumnos_cursos WHERE idalumno=:idalumno";
                    $consulta=$conexionBD->prepare($sql);
                    $consulta->bindParam(':idalumno',$id);
                    $consulta->execute();
    
                    foreach($cursos as $curso){
    
                        $sql="INSERT INTO alumnos_cursos (id, idalumno, idcurso) 
                        VALUES (NULL,:idalumno,:idcurso)";
                        $consulta=$conexionBD->prepare($sql);
                        $consulta->bindParam(':idalumno',$id);
                        $consulta->bindParam(':idcurso',$curso);
                        $consulta->execute();
                    }
                    $arregloCursos=$cursos;
    
    
                }
        }  
    }
    
    
    //CONSULTA DE LA TABLA RELACIONADA   
    $sql="SELECT * FROM alumnos";
    $listaAlumnos=$conexionBD->query($sql);
    $alumnos=$listaAlumnos->fetchAll();
    
    foreach($alumnos as $clave => $alumno){
    
        $sql="SELECT * FROM cursos 
        WHERE id IN (SELECT idcurso FROM alumnos_cursos WHERE idalumno=:idalumno)";
    
        $consulta=$conexionBD->prepare($sql);
        $consulta->bindParam(':idalumno',$alumno['id']);
        $consulta->execute();
        $cursosAlumno=$consulta->fetchAll();
        $alumnos[$clave]['cursos']=$cursosAlumno;
    }
    
    //Mostrando listado de cursos
    $sql="SELECT * FROM cursos";
    $listaCursos=$conexionBD->query($sql);
    $cursos=$listaCursos->fetchAll();
