const url = 'api/Api.php';
const app = new Vue({
    el: '#app-executory',
    data: {
        form: {
            radicado: '',
        },
        form_process: {
            id_radicado: '',
            radicado: '',
            id_plaintiff: '',
            plaintiff: '',
            id_defendant: '',
            defendant : '',
            original_court: '',
            destination_court: '',
            process_class: '',
            position: '',
            additional_observation: '',
            start_date: '',
            days: '',
            end_date: '',
            assigned_to: '',
            date: '',
            user: '',
            observation: ''
        },
        loading: true,
        submitStatus: null,
        registerStatus: null,
        actions_folder_list: [],
        users: [],
        radicados_executory_list: [],
        radicados_executory: []
    },
    validations: {
        form: {
            radicado: {
                required,
                minLength: minLength(29)
            }
        },
        form_process: {
            id_radicado: {
                required
            },
            radicado: {
                required
            },
            id_plaintiff: {
                required
            },
            plaintiff: {
                required
            },
            id_defendant: {
                required
            },
            defendant: {
                required
            },
            original_court: {
                required
            },
            destination_court: {
                required
            },
            process_class: {
                required
            },
            position: {
            },
            additional_observation: {
                required
            },
            start_date: {
                required,
                minLength: minLength(10),
                maxLength: maxLength(10)
            },
            days: {
                numeric
            },
            end_date: {
                minLength: minLength(10),
                maxLength: maxLength(10)
            },
            assigned_to: {
            },
        }
    },
    beforeCreate() {
        this.loading = true;
        let init = this;
        init.$nextTick(function() {
            init.initDatetimepicker();
            init.initDataTables();
        });
    },
    created() {
        this.getAllActionsFolder();
        this.getAllUsers();
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
            app.form_process.start_date = document.getElementById('start_date').value;
            app.form_process.end_date = document.getElementById('end_date').value;

            validation.$touch();
        },
        // BOTONES
        btnAddRadicado: function() {
            // console.log(app.form_process);
            if (!this.$v.form_process.$invalid) {
                let isInArray = app.radicados_executory.includes(app.form_process.radicado);
                if (isInArray) {
                    Swal.fire({
                        title: '!El radicado ya existe!',
                        text: 'El radicado ' + app.form_process.radicado + ' ya existe en la tabla',
                        icon: 'error',
                        confirmButtonColor: '#3085d6',
                        allowOutsideClick: false
                    });
                } else {
                    app.radicados_executory_list.push(app.form_process);
                    app.radicados_executory.push(app.form_process.radicado);
                    
                    $('#table_datatable').DataTable().destroy();
                    let init = this;
                    init.$nextTick(function() {
                        init.initDataTables();
                    });
    
                    app.form_process = {
                        id_radicado: '',
                        radicado: '',
                        id_plaintiff: '',
                        plaintiff: '',
                        id_defendant: '',
                        defendant: '',
                        original_court: '',
                        destination_court: '',
                        process_class: '',
                        position: '',
                        additional_observation: '',
                        start_date: '',
                        days: '',
                        end_date: '',
                        assigned_to: '',
                        date: '',
                        user: '',
                        observation: '',
                    }
                    this.$v.form_process.$reset();
                }
            }
        },
        btnRemoveRadicado: function(index) {
            app.radicados_executory_list.splice(index, 1);
            app.radicados_executory.splice(index, 1);
                
            $('#table_datatable').DataTable().destroy();
            let init = this;
            init.$nextTick(function() {
                init.initDataTables();
            });
        },
        btnCleanForms: function() {
            app.form = {
                radicado: ''
            }
            app.form_process = {
                id_radicado: '',
                radicado: '',
                id_plaintiff: '',
                plaintiff: '',
                id_defendant: '',
                defendant: '',
                original_court: '',
                destination_court: '',
                process_class: '',
                position: '',
                additional_observation: '',
                start_date: '',
                days: '',
                end_date: '',
                assigned_to: '',
                date: '',
                user: '',
                observation: '',
            }
            this.$v.form.$reset();
            this.$v.form_process.$reset();
        },
        btnRegisterExecutory: function() {
            if (app.radicados_executory_list.length == 0) {
                this.registerStatus = 'ERROR';
                Swal.fire({
                    title: '!Error!',
                    text: 'No se ha adicionado ningún radicado a la tabla radicado',
                    icon: 'error',
                    confirmButtonColor: '#3085d6',
                    allowOutsideClick: false
                });
            } else {
                this.registerStatus = 'PENDING';
                axios.post(url, {option: 'registerExecutory', radicados_executory_list:app.radicados_executory_list})
                    .then((response) => {
                        console.log(response);
                        this.registerStatus = 'OK';
                    });
            }
        },
        // PROCEDIMIENTOS
        getAllActionsFolder: function() {
            axios.post(url, {option: 'getAllActionsFolder'})
                .then((response) => {
                    console.log(response);
                    app.actions_folder_list = response.data;
                });
        },
        getAllUsers: function() {
            axios.post(url, {option: 'getAllUsers'})
                .then((response) => {
                    // console.log(response);
                    app.users = response.data;
                });
        },
        getProcess: function() {
            let radicado_format = app.form.radicado.replace(/\-/g, '');

            this.$v.form.$touch();
            if (this.$v.form.$invalid) {
                this.submitStatus = 'ERROR';
            } else {
                this.submitStatus = 'PENDING'
                axios.post(url, {option: 'getProcess', radicado:radicado_format})
                    .then((response) => {
                        console.log(response);

                        this.$v.form_process.$touch();
                        app.form_process.id_radicado = response.data.idradicado;
                        app.form_process.radicado = response.data.radicado;
                        app.form_process.id_plaintiff = response.data.cedula_demandante;
                        app.form_process.plaintiff = response.data.demandante;
                        app.form_process.id_defendant = response.data.cedula_demandado;
                        app.form_process.defendant = response.data.demandado;
                        app.form_process.original_court = response.data.jo;
                        app.form_process.destination_court = response.data.jd;
                        app.form_process.process_class = response.data.claseproceso;
                        app.form_process.position = response.data.posicion;
                        app.form_process.start_date = new moment().format('DD/MM/YYYY');
                        app.form_process.date = response.data.fecha;
                        app.form_process.user = response.data.empleado;
                        app.form_process.observation = response.data.observacion;
                        this.submitStatus = 'OK'
                    });
            }
        },
        calculateDaysToEndDate: function() {
            if (app.form_process.start_date && Number.isInteger(parseInt(app.form_process.days))) {
                let days = app.form_process.days;
                // 0: "Sunday"
                // 1: "Monday"
                // 2: "Tuesday"
                // 3: "Wednesday"
                // 4: "Thursday"
                // 5: "Friday"
                // 6: "Saturday"
                let end_date = '';
                for (let day = 1; day <= days; day++) {
                    let date = moment(app.form_process.start_date, 'DD/MM/YYYY');
                    end_date = date.add(parseInt(day), 'days');
                    // console.log(end_date.format('DD/MM/YYYY'));
    
                    let dayWeek = end_date.day();
                    // console.log(dayWeek);
                    if (dayWeek === 0 || dayWeek === 6 || this.isHoliday(end_date)) {
                        days++;
                    }
                }
                app.form_process.end_date = end_date.format('DD/MM/YYYY');
            } else if (app.form_process.days === '') {
                app.form_process.end_date = '';
            }
        },
        isHoliday: function(end_date) {
            let date = end_date.format('YYYY-MM-DD');
            // let date = '2021-08-16';
            // console.log(date);
            let year = end_date.format('YYYY');
            // console.log(year);

            // Dias festivos en Colombia
            let holidays = this.getColombiaHolidaysByYear(year);
            // console.log(holidays);

            let isColombiaHoliday = false;
            for (let holiday in holidays) {
                // console.log(holidays[holiday].holiday);
                if (holidays[holiday].holiday == date) {
                    app.holidayCelebration = holidays[holiday].celebration;
                    isColombiaHoliday = true;
                }
            }
            return isColombiaHoliday;
        },
        // Metodos para los dias festivos de acuerdo al año
        getColombiaHolidaysByYear: function(year) {
            if (!year) {
                throw 'No year provided'
            } else {
                year = year.toString();
                if (!year.match(/^\d*$/g)) {
                    throw 'The year is not a number'
                } else if (year < 1970 || year > 99999) {
                    throw 'The year should be greater to 1969 and smaller to 100000'
                } else {
                    var normalHolidays = HOLIDAYS.map((element, index, array) => {
                        return {
                            holiday: this.nextDay(year.toString().concat('-').concat(element.day), element.daysToSum),
                            celebrationDay: year.toString().concat('-').concat(element.day),
                            celebration: element.celebration
                        };
                    });
                    var sunday = new Date(this.butcherAlgorithm(year));
                    var easterWeekHolidays = EASTER_WEEK_HOLIDAYS.map((element, index, array) => {
                        var day = new Date(sunday.getTime() + element.day * MILLISECONDS_DAY);
                        return {
                            holiday: this.nextDay(this.getFormattedDate(day.getUTCFullYear(), day.getUTCMonth() + 1, day.getUTCDate()), element.daysToSum),
                            celebrationDay: this.getFormattedDate(day.getUTCFullYear(), day.getUTCMonth() + 1, day.getUTCDate()),
                            celebration: element.celebration
                        };
                    });
                    return normalHolidays.concat(easterWeekHolidays).sort((a, b) => {
                        return new Date(a.holiday) - new Date(b.holiday);
                    });
                    ;
                }
            }
        },
        butcherAlgorithm: function(year) {
            var year = parseInt(year);
            var A = year % 19;
            var B = Math.floor(year / 100);
            var C = year % 100;
            var D = Math.floor(B / 4);
            var E = B % 4;
            var F = Math.floor((B + 8) / 25);
            var G = Math.floor((B - F + 1) / 3);
            var H = (19 * A + B - D - G + 15) % 30;
            var I = Math.floor(C / 4);
            var K = C % 4;
            var L = (32 + 2 * E + 2 * I - H - K) % 7;
            var M = Math.floor((A + 11 * H + 22 * L) / 451);
            var N = H + L - 7 * M + 114;
            var month = Math.floor(N / 31);
            var day = 1 + (N % 31);
            return this.getFormattedDate(year, month, day);
        },
        nextDay: function(day, sum) {
            var date = new Date(day);
            var newDate = (sum === 7 ? date : new Date(date.getTime() + (((7 + sum) - date.getUTCDay()) % 7) * MILLISECONDS_DAY));
            return this.getFormattedDate(newDate.getUTCFullYear(), newDate.getUTCMonth() + 1, newDate.getUTCDate());
        },
        addZero: function(number) {
            number = number.toString();
            if (number > 0 && number < 10 && !number.startsWith('0')) {
                return '0'.concat(number);
            } else {
                return number;
            }
        },
        getFormattedDate: function(year, month, day) {
            return year.toString().concat('-').concat(this.addZero(month)).concat('-').concat(this.addZero(day));
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
    },
});