<?php 
    require('../librerias/fpdf/fpdf.php');
    include_once '../models/bd.php';
    $conexionBD=Conectar::crearInstancia();


    //Funcion para agregar Texto
    function agregarTexto($pdf, $texto, $x, $y, $align = 'L', $fuente, $size = 10, $r = 0, $g = 0, $b = 0){   
        //Propiedades de Fuente
        $pdf->SetFont($fuente, "", $size);
        //Propiedades de Posición
        $pdf->SetXY($x, $y);
        //Propiedades de Color
        $pdf->SetTextColor($r, $g, $b);
        //Propiedades de Alineación
        $pdf->Cell(0, 10, $texto, 0, 0, $align);
    }
    
    //Funcion para agregar Imagen
    function agregarImagen($pdf, $imagen, $x, $y){
        $pdf->Image($imagen, $x, $y, 0);
    }

    $idcurso = isset($_GET['idcurso']) ? $_GET['idcurso'] : '';
    $idalumno = isset($_GET['idalumno']) ? $_GET['idalumno'] : '';

    //Sentencia SQL
    $sql = "SELECT alumnos.nombre, alumnos.apellidos,cursos.nombre_curso 
    FROM alumnos, cursos WHERE alumnos.id=:idalumno AND cursos.id=:idcurso";

    //Conexion BD
    $consulta = $conexionBD->prepare($sql);
    
    $consulta->bindParam(':idalumno', $idalumno);
    $consulta->bindParam(':idcurso', $idcurso);
    $consulta->execute();
    $alumno = $consulta->fetch(PDO::FETCH_ASSOC); 

    
    //Generando el PDF
    $pdf = new FPDF("L", "mm", array(254, 194));
    $pdf->AddPage();
    $pdf->setFont("Arial", "B", 16);
    

    
    //Agregando imagen del certificado
    agregarImagen($pdf, "../src/certificado.jpg", 0, 0);
    
    //Agregando el texto del PDF
    //agregarTexto($pdf, $texto, $x, $y, $align = 'L', $fuente, $size = 10, $r = 0, $g = 0, $b = 0);
    //Nombre del alumno
    agregarTexto($pdf, ucwords(utf8_decode($alumno['nombre'] . " " . $alumno['apellidos'])), 60, 70, 'L', "Helvetica", 30, 0, 84, 115);
    //Nombre del curso
    agregarTexto($pdf, $alumno['nombre_curso'], -250, 115, 'C', "Helvetica", 20, 0, 84, 115);
    //Fecha
    agregarTexto($pdf, date("d/m/Y"), -350, 155, 'C', "Helvetica", 11, 0, 84, 115);
    
    //Mostrando el PDF
    $pdf->Output();
    
    //print_r($alumno['nombre'] . " " . $alumno['apellidos']);
    //print_r($alumno['nombre_curso']);

?>