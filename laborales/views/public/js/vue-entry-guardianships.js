const url = 'api/Api.php';

Vue.use(window.vuelidate.default);
const { required, minLength } = window.validators;

const app = new Vue({
    el: "#app-entry-guardianships",
    data: {
        startDate: ''
    },
    validations: {
        startDate: {
            required,
            minLength: minLength(5)
        }
    },
    created() {
        
    },
    computed: {

    },
    methods: {
        status(validation) {
            console.log(validation);
            return {
                error: validation.$error,
                dirty: validation.$dirty
            }
        },
        // BOTONES
        btnConsultRadicado: function() {
            console.log(app.startDate);
        }
        // PROCEDIMIENTOS
    }
});