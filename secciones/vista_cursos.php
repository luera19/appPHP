<?php include('../templates/cabecera.php'); ?>
<?php include('../secciones/cursos.php'); ?>

<div class="row">
    <div class="col-12">
        <br />
        <div class="row">
            <div class="col-5">

                <form action="" method="post">
                    <div class="card">
                        <!--Card Header-->
                        <div class="card-header">
                            Cursos de Alumnos
                        </div>

                        <!--Card Body-->
                        <div class="card-body">

                            <!--ID-->
                            <div class="mb-3 d-none">
                                <label for="" class="form-label">ID</label>
                                <input type="text" 
                                       class="form-control" 
                                       name="id" 
                                       id="id" 
                                       value="<?= $id; ?>" 
                                       aria-describedby="helpId" 
                                       placeholder="ID">
                            </div>

                            <!--Nombre-->
                            <div class="mb-3">
                                <label for="nombre_curso" class="form-label">Nombre</label>
                                <input type="text" 
                                       class="form-control" 
                                       name="nombre_curso" 
                                       id="nombre_curso" 
                                       value="<?= $nombre_curso; ?>" 
                                       aria-describedby="helpId" 
                                       placeholder="Nombre del curso">
                            </div>

                            <div class="btn-group" role="group" aria-label="">
                                <button type="submit" name="accion" value="agregar" class="btn btn-success">Agregar</button>
                                <button type="submit" name="accion" value="editar" class="btn btn-warning">Editar</button>
                                <button type="submit" name="accion" value="borrar" class="btn btn-danger">Borrar</button>
                            </div>

                        </div>
                        <!--card body-->
                    </div>
                    <!--card-->
                </form>
            </div>
            <!--col-md-5-->


            <!--Tabla para mostrar registros-->
            <div class="col-md-7">
                <div class="table-responsive">
                    <table class="table table-light">
                        <!--table header-->
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>

                        <!--table body-->
                        <tbody>


                            <?php foreach ($listaCursos as $curso) { ?>
                                <tr>
                                    <td> <?= $curso['id']; ?> </td>
                                    <td> <?= $curso['nombre_curso']; ?> </td>
                                    <td>
                                        <form action="" method="post">
                                            <input type="hidden" name="id" id="id" value="<?= $curso['id']; ?>" />
                                            <input type="submit" value="Seleccionar" name="accion" class="btn btn-info">
                                        </form>

                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>

                    </table>
                </div>
                <!--table-->

            </div>

        </div>
    </div>

    <?php include('../templates/pie.php'); ?>