const url = 'api/Api.php';
const app = new Vue({
    el: '#app-login',
    data: {
        form: {
            id_employee_login: '',
            password_login: ''
        },
        submitStatus: null
    },
    validations: {
        form: {
            id_employee_login: {
                required,
                minLength: minLength(6)
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

            this.$v.$touch();
            // if (this.$v.$invalid) {
            //     this.submitStatus = 'ERROR';
            // } else {
            //     this.submitStatus = 'PENDING';

            //     axios.post(url, {option: 'getLogin', id_employee_login:id_employee_login, password_login:password_login})
            //         .then((response) => {
            //             console.log(response);
            //             this.submitStatus = 'OK';
            //         });
            // }
        }
        // CONFIGURACIONES
    },
});