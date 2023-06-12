$(document).ready(function() {
    // DataTable
    $('#table').DataTable({
        "paging":   false,
        "ordering": false,
        "info":     false,
      language: {
        "decimal":        "",
    "emptyTable":     "No hay datos",
    "info":           "Mostrando _START_ a _END_ de _TOTAL_ registros",
    "infoEmpty":      "Mostrando 0 a 0 de 0 registros",
    "infoFiltered":   "(Filtro de _MAX_ total registros)",
    "infoPostFix":    "",
    "thousands":      ",",
    "lengthMenu":     "Mostrar _MENU_ registros",
    "loadingRecords": "Cargando...",
    "processing":     "Procesando...",
    "search":         "Buscar:",
    "zeroRecords":    "No se encontraron coincidencias",
    "paginate": {
        "first":      "Primero",
        "last":       "Ultimo",
        "next":       "Próximo",
        "previous":   "Anterior"
    },
    "aria": {
        "sortAscending":  ": Activar orden de columna ascendente",
        "sortDescending": ": Activar orden de columna desendente"
    }
      },
        initComplete: function () {

            //Apply select search
            this.api().columns('.dt-filter-select').every(function () {
                var column = this;
                var select = $('<select class="form-control"><option value="">Ver todos</option></select>')
                    .appendTo($(column.header()).empty())
                    .on('change', function () {
                        var val = $.fn.dataTable.util.escapeRegex(
                            $(this).val()
                        );
                        column
                            .search( val ? '^'+val+'$' : '', true, false)
                            .draw();
                    });
                column.data().unique().sort().each(function (d,j) {
                    select.append('<option value="'+d+'">'+d+'</option>')
                });
            });

            //Apply text search
            this.api().columns('.dt-filter-text').every(function () {
                var title = $(this.header()).text();
                $(this.header()).html('<input type="text" class="form-control" placeholder="Buscar en: '+title+'" />');
                var that = this;
                $('input',this.header()).on('keyup change', function () {
                    if (that.header() !== this.value) {
                        that
                            .search(this.value)
                            .draw();
                    }
                });
            });
        }
    });
});