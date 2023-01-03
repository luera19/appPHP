<?php include('../templates/header.php'); ?>
<?php include('../views/alumnos.php'); ?>

<br />
<div class="row">
    
    <div class="col-5">
        <form action="" method="post">
            <div class="card">
                <div class="card-header">
                    Alumnos
                </div>
                <div class="card-body">

                    <!--ID-->
                    <!--class d-none para que no muestre el ID-->
                    <div class="mb-3 d-none">
                        <label for="id" class="form-label">ID</label>
                        <input type="text" 
                                class="form-control" 
                                name="id" value="<?=$id; ?>" 
                                id="id" 
                                aria-describedby="helpId" 
                                placeholder="ID">
                    </div>

                    <!--Nombre-->
                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre</label>
                        <input type="text" 
                                class="form-control" 
                                name="nombre" 
                                value="<?= $nombre; ?>" 
                                id="nombre" 
                                aria-describedby="helpId" 
                                placeholder="Escriba el nombre">
                    </div>
                    
                    <!--Apellidos-->
                    <div class="mb-3">
                        <label for="apellidos" class="form-label">Apellidos</label>
                        <input type="text" 
                                class="form-control" 
                                name="apellidos" 
                                value="<?= $apellidos; ?>" 
                                id="apellidos" 
                                aria-describedby="helpId" 
                                placeholder="Escriba los apellidos">
                    </div>

                    <!--Lista de Cursos de Alumnos-->
                    <div class="mb-3">
                        <label for="" class="form-label">Cursos del alumno:</label>

                        <select multiple class="form-control" 
                                name="cursos[]" 
                                id="listaCursos"
                                placeholder="Seleccione una opción">
                            
                            <?php foreach ($cursos as $curso) { ?>
                                <!--Recuperando el arreglo de los cursos-->
                                <option
                                    <?php
                                        if(!empty($arregloCursos)) :
                                            if (in_array($curso['id'], $arregloCursos)) :
                                                echo 'selected';
                                            endif;
                                        endif;
                                    ?> 
                                        
                                        value="<?= $curso['id']; ?>">
                                        
                                        <?= $curso['id']; ?> - <?= $curso['nombre_curso']; ?>
                                
                                </option>
                            <?php  } ?>
                        </select>
                    
                    </div>

                    <!--Botones-->
                    <div class="btn-group" role="group" aria-label="">
                        <button type="submit" name="accion" value="agregar" class="btn btn-success">Agregar</button>
                        <button type="submit" name="accion" value="editar" class="btn btn-warning">Editar</button>
                        <button type="submit" name="accion" value="borrar" class="btn btn-danger">Borrar</button>
                    </div>


                </div><!--card-body-->

            </div><!--card-->
        </form>
    </div><!--col-5-->
    
    <!--Tabla de datos-->
    <div class="col-7">
        <table class="table table-light">
            <!--table head-->
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            
            <!--table body-->
            <tbody>

                <?php foreach ($alumnos as $alumno) : ?>
                    <tr>
                        <td><?= $alumno['id']; ?></td>

                        <td><?= $alumno['nombre']; ?> <?= $alumno['apellidos']; ?>
                            <br/>
                            <!--Recupero la lista de cursos-->
                            <?php foreach ($alumno["cursos"] as $curso) { ?>
                                <!--Redireccionando a certificado.php--> 
                                <a href="certificado.php?idcurso=<?= $curso['id'];?>&idalumno=<?= $alumno["id"];?>">
                                    <i class="bi bi-filetype-pdf text-danger"></i> <?= $curso['nombre_curso']; ?>
                                </a>
                                <br/>
                            <?php  } ?>
                        </td>

                        <!--btn Seleccionar-->        
                        <td>
                            <form action="" method="post">
                                <input  type="hidden" 
                                        name="id" 
                                        value="<?= $alumno['id']; ?>">
                                <input  type="submit" 
                                        value="Consultar" 
                                        name="accion" 
                                        class="btn btn-info">
                            </form>
                        </td>

                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div><!--col-7-->
</div><!--row-->


<!--Librerías TomSelect-->
<link href="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/css/tom-select.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/js/tom-select.complete.min.js"></script>

<!--SCRIPT TomSelect-->
<script>

    new TomSelect('#listaCursos');

</script>

<!--Importando el pie-->
<?php include('../templates/footer.php'); ?>