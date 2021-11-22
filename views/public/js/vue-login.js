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
                numeric,
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
        this.getCookie();
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

                        if (response.data[1].enable_employee == 1) {
                            if (app.form.remember) {
                                app.setCookie('id_employee_login', app.form.id_employee_login);
                                app.setCookie('password_login', app.form.password_login);
                            } else {
                                app.deleteCookie('id_employee_login');
                                app.deleteCookie('password_login');
                            }
                            window.location = response.data[0];
                        } else {
                            switch (response.data[1]) {
                                case 'usuario inactivo':
                                    Swal.fire({
                                        title: "¡ERROR AL INGRESAR!",
                                        text: "¡Su usuario se encuentra inactivo!",
                                        icon: "error",
                                        confirmButtonText: "Cerrar",
                                        confirmButtonColor: "#3085d6",
                                        allowOutsideClick: false,
                                        showCloseButton: false
                                    });
                                    break;
                                case 'no coinciden credenciales':
                                    Swal.fire({
                                        title: "¡ERROR AL INGRESAR!",
                                        text: "¡Por favor revise que el usuario o la contraseña coincida con la registrada!",
                                        icon: "error",
                                        confirmButtonText: "Cerrar",
                                        confirmButtonColor: "#3085d6",
                                        allowOutsideClick: false,
                                        showCloseButton: false
                                    });
                                    break;
                                case 'caracteres especiales':
                                    Swal.fire({
                                        title: "¡ERROR!",
                                        text: "¡Error al ingresar al sistema, no se permiten caracteres especiales!",
                                        icon: "error",
                                        confirmButtonText: "Cerrar",
                                        confirmButtonColor: "#3085d6",
                                        allowOutsideClick: false,
                                        showCloseButton: false
                                    });
                                    break;
                            }
                        }
                        this.submitStatus = 'OK';
                    });
            }
        },
        getCookie: function() {
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
        setCookie: function(cookie_name, cookie_value) {
            const date = new Date();
            date.setTime(date.getTime() + (60 * 60 * 24 * 30));
            let expires = "Expires="+ date.toUTCString();
            document.cookie = cookie_name + "=" + cookie_value + ";" + expires;
        },
        deleteCookie: function(cookie_name) {
            document.cookie = cookie_name +'=;expires=Thu, 01 Jan 1970';
        }
        // CONFIGURACIONES
    },
});