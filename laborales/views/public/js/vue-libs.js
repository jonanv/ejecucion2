// Init vuelidate
Vue.use(window.vuelidate.default);
const { required, minLength, maxLength, numeric } = window.validators;

// init v-mask
Vue.use(VueMask.VueMaskPlugin);