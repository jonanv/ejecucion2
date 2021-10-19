const url = 'api/Api.php';
const app = new Vue({
    el: '#app-login',
    data: {
        form: {
            id_employee_login: '',
            password_login: ''
        }
    },
    validations: {
        form: {
            id_employee_login: {
                required
            },
            password_login: {
                required
            }
        }
    },
    beforeCreate() {
        
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
        btnLogin: function() {
            app.form.id_employee_login = document.getElementById('id_employee_login').value;
            app.form.password_login = document.getElementById('password_login').value;
            
            app.login(app.form.id_employee_login, app.form.password_login);
        },
        // PROCEDIMIENTOS
        login: function(id_employee_login, password_login) {
            console.log(id_employee_login);
            console.log(password_login);
        }
        // CONFIGURACIONES
    },
});