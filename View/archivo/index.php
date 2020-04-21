<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
<h1 class="page-header">Pruebas B2bTic</h1>
<div class="justify-content-center">

    <div id="col-md-12">
        <div class="well well-lg text-right" style="width: 100%;">

            <a class="btn btn-primary" href="?c=archivo&a=obtenerSoapArchivo">Obtener Archivos</a>
            <a class="btn btn-warning" href="index.php">Ver Archivos</a>
            <a class="btn btn-success" id="ReporteTodo" >Mostrar desde XML A HTML</a>
            <a class="btn btn-danger"  id="ReporteCantidadxExtension">Cantidad por extension</a>
        </div>
        <div class="alert alert-danger hidden" id="error"></div>
        <div id="main">
                <table  class="table table-striped" id="tablaMAin">
                    <thead>
                    <tr>
                        <th >Id</th>
                        <th >Nombre</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach($this->model->Listar() as $r): ?>
                        <tr>
                            <td><?php echo $r->Id; ?></td>
                            <td><?php echo $r->Nombre; ?></td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

    </div>

</div>


