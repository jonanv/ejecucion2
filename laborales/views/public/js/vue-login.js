const url = 'api/Api.php';
const app = new Vue({
    el: '#app-login',
    data: {
        form: {
            id_employee_login: '',
            password_login: '',
            remember: ''
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
                required,
                minLength: minLength(5)
            },
            remember: {

            }
        }
    },
    beforeCreate() {
        
    },
    created() {
        let cookies_list = [];
        let cookies = document.cookie.split('; ');
        cookies.forEach(cookie => {
            let temp = cookie.split('=');
            cookies_list[temp[0]] = temp[1];
        });
        // console.log(cookies_list);
        this.form.id_employee_login = cookies_list.id_employee_login;
        this.form.password_login = cookies_list.password_login;
        this.form.remember = cookies_list.id_employee_login ? true : false;
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
        // PROCEDIMIENTOS
        getLogin: function() {
            // console.log(app.form.id_employee_login);
            // console.log(app.form.password_login);
            // console.log(app.form.remember);

            this.$v.$touch();
            if (this.$v.$invalid) {
                this.submitStatus = 'ERROR';
            } else {
                this.submitStatus = 'PENDING';

                axios.post(url, {option: 'getLogin', id_employee_login:app.form.id_employee_login, password_login:app.form.password_login, remember:app.form.remember})
                    .then((response) => {
                        console.log(response);
                        app.setCookie('id_employee_login', app.form.id_employee_login);
                        app.setCookie('password_login', app.form.password_login);

                        app.deleteCookie('id_employee_login');
                        app.deleteCookie('password_login');
                        
                        this.submitStatus = 'OK';
                    });
            }
        },
        setCookie(cookie_name, cookie_value) {
            const date = new Date();
            date.setTime(date.getTime() + (60 * 60 * 24 * 30));
            let expires = "Expires="+ date.toUTCString();
            document.cookie = cookie_name + "=" + cookie_value + ";" + expires;
        },
        deleteCookie(cookie_name) {
            document.cookie = cookie_name +'=;expires=Thu, 01 Jan 1970';
        }
        // CONFIGURACIONES
    },
});