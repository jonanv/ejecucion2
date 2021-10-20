const url = 'api/Api.php';
const app = new Vue({
    el: '#app-executory',
    data: {
        form: {
            radicado: '',
        },
        form_process: {
            id: '',
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
            startDate: '',
            days: '',
            endDate: '',
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
                        // $('#id').val(response.data.idradicado);
                        // $('#id').text(response.data.idradicado);
                        document.getElementById('id').innerHTML(response.data.idradicado);
                        this.submitStatus = 'OK'
                    });
            }
        }
        // CONFIGURACIONES
    },
});