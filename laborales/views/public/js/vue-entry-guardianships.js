const url = 'api/Api.php';

Vue.use(window.vuelidate.default);
const { required, minLength, maxLength } = window.validators;

const app = new Vue({
    el: "#app-entry-guardianships",
    data: {
        startDate: '',
        submitStatus: null,
    },
    validations: {
        startDate: {
            required,
            minLength: minLength(10),
            maxLength: maxLength(10)
        }
    },
    created() {
        
    },
    computed: {

    },
    methods: {
        // VALIDACIÓN
        status(validation) {
            console.log(validation);
            return {
                error: validation.$error,
                dirty: validation.$dirty
            }
        },
        touchedVuevalidate(validation) {
            app.startDate = document.getElementById('startDate').value;
            validation.$touch();
        },
        // BOTONES
        btnConsultRadicado: function() {
            app.startDate = document.getElementById('startDate').value;

            console.log('submit!');
            console.log(app.startDate);
            this.$v.$touch();
            if (this.$v.$invalid) {
                this.submitStatus = 'ERROR';
            } else {
                this.submitStatus = 'PENDING';
                setTimeout(() => {
                    this.submitStatus = 'OK';
                }, 4000);
            }
        }
        // PROCEDIMIENTOS
    }
});