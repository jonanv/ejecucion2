const url = 'api/Api.php';
const app = new Vue({
    el: '#app-executory',
    data: {
        form: {
            radicado: '',
        },
        form_process: {
            idradicado: '',
            radicado: '',
            id_plaintiff: '',
            plaintiff: '',
            id_defendant: '',
            defendant : '',
            original_court: '',
            destination_court: '',
            process_class: '',
            position: '',
            observation: '',
            additional_observation: '',
            start_date: '',
            days: '',
            end_date: '',
            assigned_to: ''
        },
        loading: true,
        submitStatus: null,
    },
    validations: {
        form: {
            radicado: {
                required,
                minLength: minLength(29)
            }
        },
        form_process: {
            idradicado: {
                required
            },
            radicado: {
                required
            },
            cedula_demandante: {
                required
            },
            demandante: {
                required
            },
            cedula_demandado: {
                required
            },
            demandado: {
                required
            },
            jo: {
                required
            },
            jd: {
                required
            },
            claseproceso: {
                required
            },
            posicion: {
                required
            },
            start_date: {
                required
            },
            days: {
                required
            },
            end_date: {
                required
            },
            assigned_to: {
                required
            },

        }
    },
    beforeCreate() {
        this.loading = true;
    },
    created() {
        
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
        btnGetProcess: function() {
            app.form.radicado = document.getElementById('radicado').value;

            app.getProcess(app.form.radicado);
        },
        btnRegisterExecutory: function() {
            this.$v.form_process.$touch();
        },
        // PROCEDIMIENTOS
        getProcess: function(radicado) {
            let radicado_format = radicado.replace(/\-/g, '');

            this.$v.form.$touch();
            if (this.$v.form.$invalid) {
                this.submitStatus = 'ERROR';
            } else {
                this.submitStatus = 'PENDING'
                axios.post(url, {option: 'getProcess', radicado:radicado_format})
                    .then((response) => {
                        console.log(response);

                        this.$v.form_process.$touch();
                        app.form_process = response.data;
                        // TODO: Organizar nombres de acuerdo a la respuesta o como estan definidos en el form
                        this.submitStatus = 'OK'
                    });
            }
        }
        // CONFIGURACIONES
    },
});