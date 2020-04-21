            <div class="row">
                <div class="col-xs-12">

                </div>
            </div>
        </div>

        <script src="assets/js/jquery-1.11.2.min.js"></script>
        <script src="assets/js/bootstrap.min.js"></script>
        <script src="assets/js/jquery-ui/jquery-ui.min.js"></script>
        <script src="assets/js/ini.js"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
        <script src="assets/js/jquery.anexsoft-validator.js"></script>
            <script type="text/javascript">

                    $('#tablaMAin').DataTable();

                $("#ReporteTodo").click(function () {
                    $.ajax(
                        'index.php?c=archivo&a=ReporteTodo',
                        {
                            success: function(data) {
                                var  data = JSON.parse(data);
                                if(data.success){
                                    $("#main").empty();
                                    $("#main").html(data.html);
                                    $('#table2').DataTable();
                                    $("#error").addClass('hidden');
                                }
                                else{
                                    $("#error").removeClass('hidden');
                                    $("#error").text('No hay archivos disponibles');
                                }
                            },
                            error: function() {
                                alert('There was some error performing the AJAX call!');
                            }
                        }
                    );
                })
                $("#ReporteCantidadxExtension").click(function () {
                    $.ajax(
                        'index.php?c=archivo&a=ReporteCantidadxExtension',
                        {
                            success: function(data) {
                                var  data = JSON.parse(data);
                                if(data.success){
                                    $("#main").empty();
                                    $("#main").html(data.html);
                                    $('#table3').DataTable();
                                    $("#error").addClass('hidden');
                                }
                                else{
                                    $("#error").removeClass('hidden');
                                    $("#error").text('No hay extensions disponibles');
                                }
                            },
                            error: function() {
                                alert('There was some error performing the AJAX call!');
                            }
                        }
                    );
                })
            </script>
    </body>
</html>
