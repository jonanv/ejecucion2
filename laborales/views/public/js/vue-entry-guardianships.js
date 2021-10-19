const url = 'api/Api.php';
const app = new Vue({
    el: "#app-entry-guardianships",
    data: {
        form: {
            startDate: '',
            endDate: '',
            radicado: '',
        },
        submitStatus: null,
        migrateStatus: null,
        entry_guardianships_list: [],
        process_exist_list: [],
        loading: true,
    },
    validations: {
        form: {
            startDate: {
                required,
                minLength: minLength(10),
                maxLength: maxLength(10)
            },
            endDate: {
                required,
                minLength: minLength(10),
                maxLength: maxLength(10)
            },
            radicado: {

            }
        },
    },
    beforeCreate() {
        this.loading = true;
    },
    created() {
        this.getEntryGuardianships();
    },
    computed: {

    },
    methods: {
        // VALIDACIÓN
        status(validation) {
            // console.log(validation);
            return {
                error: validation.$error,
                dirty: validation.$dirty
            }
        },
        touchedVuelidate(validation) {
            validation.$touch();
        },
        // BOTONES
        btnGetProcessesInJusticia: function() {
            app.form.startDate = document.getElementById('startDate').value;
            app.form.endDate = document.getElementById('endDate').value;
            app.form.radicado = document.getElementById('radicado').value;
            
            app.getProcessesInJusticia(app.form.startDate, app.form.endDate, app.form.radicado);
        },
        btnMigrateGuardianship: function(radicado) {
            // TODO: partcionar radicado y enviar junto con partes
            // this.migrateStatus = 'PENDING';

            // setTimeout(() => {
            //     console.log('Proceso migrada');
            //     this.migrateStatus = 'OK';
            // }, 4000);

            console.log(radicado);

            axios.post(url, {option: 'getProcessInJusticia', radicado:radicado})
                .then((response) => {
                    console.log(response);
                    if (response.data) {
                        axios.post(url, {option: 'migrateGuardianship', radicado:radicado, process:response.data})
                            .then((response) => {
                                console.log(response);
                                app.getEntryGuardianships();
                            });
                    }
                    else {
                        // NO EXISTEN DATOS EN JUSTICIA XXI, NO ES POSIBLE MIGRAR TUTELA
                        // TODO: aplicar sweetAlert
                    }
                });
        },
        // PROCEDIMIENTOS
        // Listar
        getEntryGuardianships: function() {
            this.loading = true;
            axios.post(url, {option: 'getEntryGuardianships'})
                .then((response) => {
                    console.log(response);
                    app.entry_guardianships_list = response.data[1];
                    app.process_exist_list = response.data[2];
                    this.loading = false;
                    let init = this;
                    init.$nextTick(function() {
                        init.initDatetimepicker();
                        init.initDataTables();
                    });
                });
        },
        migrateGuardianship: function() {

        },
        getProcessesInJusticia: function(startDate, endDate, radicado) {
            let startDate_format = moment(startDate, 'DD/MM/YYYY').format('YYYY-MM-DD');
            let endDate_format = moment(endDate, 'DD/MM/YYYY').format('YYYY-MM-DD');;
            let radicado_format = radicado.replace(/\-/g, '');
            this.loading = true;

            this.$v.$touch();
            if (this.$v.$invalid) {
                this.submitStatus = 'ERROR';
                this.loading = false;
            } else {
                this.submitStatus = 'PENDING';

                axios.post(url, {option: 'getProcessesInJusticia', startDate:startDate_format, endDate:endDate_format, radicado:radicado_format})
                    .then((response) => {
                        console.log(response);
                        app.entry_guardianships_list = response.data[1];
                        app.process_exist_list = response.data[2];

                        this.submitStatus = 'OK';
                        this.loading = false;
                        let init = this;
                        init.$nextTick(function() {
                            init.initDataTables();
                        });
                    });
            }
        },
        // CONFIGURACIONES
        initDatetimepicker: function() {
            //Date picker
            $('#startdate_datepicker, #enddate_datepicker').datetimepicker({
                format: 'DD/MM/YYYY'
            });
        },
        initDataTables: function() {
            $("#table_datatable").DataTable({
                responsive: true,
                lengthChange: true,
                autoWidth: false,
                buttons: [
                    "copy", 
                    {
                        extend: 'csv',
                        title: 'Historial turno llamada'
                    },
                    {
                        extend: 'excel',
                        title: 'Historial turno llamada'
                    },
                    {
                        extend: 'pdf',
                        title: 'Historial turno llamada'
                    }, 
                    "print", 
                    "colvis"
                ],
                columnDefs: [
                    { responsivePriority: 1, targets: 0 },
                    { responsivePriority: 2, targets: -1 }
                ],
                destroy: true,
                searching: true,
                dom: 'Blfrtip',
                order: [[ 0, "desc" ]],
                language: {
                    "processing": "Procesando...",
                    "lengthMenu": "Mostrar _MENU_ registros",
                    "zeroRecords": "No se encontraron resultados",
                    "emptyTable": "Ningún dato disponible en esta tabla",
                    "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                    "infoFiltered": "(filtrado de un total de _MAX_ registros)",
                    "search": "Buscar:",
                    "infoThousands": ",",
                    "loadingRecords": "Cargando...",
                    "paginate": {
                        "first": "Primero",
                        "last": "Último",
                        "next": "Siguiente",
                        "previous": "Anterior"
                    },
                    "aria": {
                        "sortAscending": ": Activar para ordenar la columna de manera ascendente",
                        "sortDescending": ": Activar para ordenar la columna de manera descendente"
                    },
                    "buttons": {
                        "copy": "Copiar",
                        "colvis": "Visibilidad",
                        "collection": "Colección",
                        "colvisRestore": "Restaurar visibilidad",
                        "copyKeys": "Presione ctrl o u2318 + C para copiar los datos de la tabla al portapapeles del sistema. <br \/> <br \/> Para cancelar, haga clic en este mensaje o presione escape.",
                        "copySuccess": {
                            "1": "Copiada 1 fila al portapapeles",
                            "_": "Copiadas %d fila al portapapeles"
                        },
                        "copyTitle": "Copiar al portapapeles",
                        "csv": "CSV",
                        "excel": "Excel",
                        "pageLength": {
                            "-1": "Mostrar todas las filas",
                            "_": "Mostrar %d filas"
                        },
                        "pdf": "PDF",
                        "print": "Imprimir"
                    },
                    "autoFill": {
                        "cancel": "Cancelar",
                        "fill": "Rellene todas las celdas con <i>%d<\/i>",
                        "fillHorizontal": "Rellenar celdas horizontalmente",
                        "fillVertical": "Rellenar celdas verticalmentemente"
                    },
                    "decimal": ",",
                    "searchBuilder": {
                        "add": "Añadir condición",
                        "button": {
                            "0": "Constructor de búsqueda",
                            "_": "Constructor de búsqueda (%d)"
                        },
                        "clearAll": "Borrar todo",
                        "condition": "Condición",
                        "conditions": {
                            "date": {
                                "after": "Despues",
                                "before": "Antes",
                                "between": "Entre",
                                "empty": "Vacío",
                                "equals": "Igual a",
                                "notBetween": "No entre",
                                "notEmpty": "No Vacio",
                                "not": "Diferente de"
                            },
                            "number": {
                                "between": "Entre",
                                "empty": "Vacio",
                                "equals": "Igual a",
                                "gt": "Mayor a",
                                "gte": "Mayor o igual a",
                                "lt": "Menor que",
                                "lte": "Menor o igual que",
                                "notBetween": "No entre",
                                "notEmpty": "No vacío",
                                "not": "Diferente de"
                            },
                            "string": {
                                "contains": "Contiene",
                                "empty": "Vacío",
                                "endsWith": "Termina en",
                                "equals": "Igual a",
                                "notEmpty": "No Vacio",
                                "startsWith": "Empieza con",
                                "not": "Diferente de"
                            },
                            "array": {
                                "not": "Diferente de",
                                "equals": "Igual",
                                "empty": "Vacío",
                                "contains": "Contiene",
                                "notEmpty": "No Vacío",
                                "without": "Sin"
                            }
                        },
                        "data": "Data",
                        "deleteTitle": "Eliminar regla de filtrado",
                        "leftTitle": "Criterios anulados",
                        "logicAnd": "Y",
                        "logicOr": "O",
                        "rightTitle": "Criterios de sangría",
                        "title": {
                            "0": "Constructor de búsqueda",
                            "_": "Constructor de búsqueda (%d)"
                        },
                        "value": "Valor"
                    },
                    "searchPanes": {
                        "clearMessage": "Borrar todo",
                        "collapse": {
                            "0": "Paneles de búsqueda",
                            "_": "Paneles de búsqueda (%d)"
                        },
                        "count": "{total}",
                        "countFiltered": "{shown} ({total})",
                        "emptyPanes": "Sin paneles de búsqueda",
                        "loadMessage": "Cargando paneles de búsqueda",
                        "title": "Filtros Activos - %d"
                    },
                    "select": {
                        "cells": {
                            "1": "1 celda seleccionada",
                            "_": "$d celdas seleccionadas"
                        },
                        "columns": {
                            "1": "1 columna seleccionada",
                            "_": "%d columnas seleccionadas"
                        },
                        "rows": {
                            "1": "1 fila seleccionada",
                            "_": "%d filas seleccionadas"
                        }
                    },
                    "thousands": ".",
                    "datetime": {
                        "previous": "Anterior",
                        "next": "Proximo",
                        "hours": "Horas",
                        "minutes": "Minutos",
                        "seconds": "Segundos",
                        "unknown": "-",
                        "amPm": [
                            "AM",
                            "PM"
                        ],
                        "months": {
                            "0": "Enero",
                            "1": "Febrero",
                            "10": "Noviembre",
                            "11": "Diciembre",
                            "2": "Marzo",
                            "3": "Abril",
                            "4": "Mayo",
                            "5": "Junio",
                            "6": "Julio",
                            "7": "Agosto",
                            "8": "Septiembre",
                            "9": "Octubre"
                        },
                        "weekdays": [
                            "Dom",
                            "Lun",
                            "Mar",
                            "Mie",
                            "Jue",
                            "Vie",
                            "Sab"
                        ]
                    },
                    "editor": {
                        "close": "Cerrar",
                        "create": {
                            "button": "Nuevo",
                            "title": "Crear Nuevo Registro",
                            "submit": "Crear"
                        },
                        "edit": {
                            "button": "Editar",
                            "title": "Editar Registro",
                            "submit": "Actualizar"
                        },
                        "remove": {
                            "button": "Eliminar",
                            "title": "Eliminar Registro",
                            "submit": "Eliminar",
                            "confirm": {
                                "_": "¿Está seguro que desea eliminar %d filas?",
                                "1": "¿Está seguro que desea eliminar 1 fila?"
                            }
                        },
                        "error": {
                            "system": "Ha ocurrido un error en el sistema (<a target=\"\\\" rel=\"\\ nofollow\" href=\"\\\">Más información&lt;\\\/a&gt;).<\/a>"
                        },
                        "multi": {
                            "title": "Múltiples Valores",
                            "info": "Los elementos seleccionados contienen diferentes valores para este registro. Para editar y establecer todos los elementos de este registro con el mismo valor, hacer click o tap aquí, de lo contrario conservarán sus valores individuales.",
                            "restore": "Deshacer Cambios",
                            "noMulti": "Este registro puede ser editado individualmente, pero no como parte de un grupo."
                        }
                    },
                    "info": "Mostrando _START_ a _END_ de _TOTAL_ registros"
                },
            }).buttons().container().appendTo('#table_datatable_wrapper .col-md-6:eq(0)');
        }
    }
});