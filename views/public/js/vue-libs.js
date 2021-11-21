// Init vuelidate
Vue.use(window.vuelidate.default);
const { required, minLength, maxLength, numeric } = window.validators;

// init v-mask
Vue.use(VueMask.VueMaskPlugin);

const NEXT_DAY = {
    SUNDAY: 0,
    MONDAY: 1,
    TUESDAY: 2,
    WEDNESDAY: 3,
    THURSDAY: 4,
    FRIDAY: 5,
    SATURDAY: 6,
    NONE: 7
}
const EASTER_WEEK_HOLIDAYS = [
    // Días para la Rama Judicial
    { day: -7, daysToSum: NEXT_DAY.NONE, celebration: 'Domingo Santo' },
    { day: -6, daysToSum: NEXT_DAY.NONE, celebration: 'Lunes Santo' },
    { day: -5, daysToSum: NEXT_DAY.NONE, celebration: 'Martes Santo' },
    { day: -4, daysToSum: NEXT_DAY.NONE, celebration: 'Miercoles Santo' },
    { day: -1, daysToSum: NEXT_DAY.NONE, celebration: 'Sabado Santo' },
    // Días por defecto
    { day: -3, daysToSum: NEXT_DAY.NONE, celebration: 'Jueves Santo' },
    { day: -2, daysToSum: NEXT_DAY.NONE, celebration: 'Viernes Santo' },
    { day: 39, daysToSum: NEXT_DAY.MONDAY, celebration: 'Ascensión del Señor' },
    { day: 60, daysToSum: NEXT_DAY.MONDAY, celebration: 'Corphus Christi' },
    { day: 68, daysToSum: NEXT_DAY.MONDAY, celebration: 'Sagrado Corazón de Jesús' }
];
const HOLIDAYS = [
    // Días por defecto
    { day: '01-01', daysToSum: NEXT_DAY.NONE, celebration: 'Año Nuevo' },
    { day: '05-01', daysToSum: NEXT_DAY.NONE, celebration: 'Día del Trabajo' },
    { day: '07-20', daysToSum: NEXT_DAY.NONE, celebration: 'Día de la Independencia' },
    { day: '08-07', daysToSum: NEXT_DAY.NONE, celebration: 'Batalla de Boyacá' },
    { day: '12-08', daysToSum: NEXT_DAY.NONE, celebration: 'Día de la Inmaculada Concepción' },
    { day: '12-25', daysToSum: NEXT_DAY.NONE, celebration: 'Día de Navidad' },
    { day: '01-06', daysToSum: NEXT_DAY.MONDAY, celebration: 'Día de los Reyes Magos' },
    { day: '03-19', daysToSum: NEXT_DAY.MONDAY, celebration: 'Día de San José' },
    { day: '06-29', daysToSum: NEXT_DAY.MONDAY, celebration: 'San Pedro y San Pablo' },
    { day: '08-15', daysToSum: NEXT_DAY.MONDAY, celebration: 'La Asunción de la Virgen' },
    { day: '10-12', daysToSum: NEXT_DAY.MONDAY, celebration: 'Día de la Raza' },
    { day: '11-01', daysToSum: NEXT_DAY.MONDAY, celebration: 'Todos los Santos' },
    { day: '11-11', daysToSum: NEXT_DAY.MONDAY, celebration: 'Independencia de Cartagena' },
    // Días para la Rama Judicial
    { day: '12-17', daysToSum: NEXT_DAY.NONE, celebration: 'Día de la Rama Judicial' },
    { day: '12-20', daysToSum: NEXT_DAY.NONE, celebration: 'Vacaciones de la Rama Judicial' },
    { day: '12-21', daysToSum: NEXT_DAY.NONE, celebration: 'Vacaciones de la Rama Judicial' },
    { day: '12-22', daysToSum: NEXT_DAY.NONE, celebration: 'Vacaciones de la Rama Judicial' },
    { day: '12-23', daysToSum: NEXT_DAY.NONE, celebration: 'Vacaciones de la Rama Judicial' },
    { day: '12-24', daysToSum: NEXT_DAY.NONE, celebration: 'Vacaciones de la Rama Judicial' },
    { day: '12-26', daysToSum: NEXT_DAY.NONE, celebration: 'Vacaciones de la Rama Judicial' },
    { day: '12-27', daysToSum: NEXT_DAY.NONE, celebration: 'Vacaciones de la Rama Judicial' },
    { day: '12-28', daysToSum: NEXT_DAY.NONE, celebration: 'Vacaciones de la Rama Judicial' },
    { day: '12-29', daysToSum: NEXT_DAY.NONE, celebration: 'Vacaciones de la Rama Judicial' },
    { day: '12-30', daysToSum: NEXT_DAY.NONE, celebration: 'Vacaciones de la Rama Judicial' },
    { day: '12-31', daysToSum: NEXT_DAY.NONE, celebration: 'Vacaciones de la Rama Judicial' },
    { day: '01-02', daysToSum: NEXT_DAY.NONE, celebration: 'Vacaciones de la Rama Judicial' },
    { day: '01-03', daysToSum: NEXT_DAY.NONE, celebration: 'Vacaciones de la Rama Judicial' },
    { day: '01-04', daysToSum: NEXT_DAY.NONE, celebration: 'Vacaciones de la Rama Judicial' },
    { day: '01-05', daysToSum: NEXT_DAY.NONE, celebration: 'Vacaciones de la Rama Judicial' },
    // Se agrega nuevamente el 01-06 porque siempre se celebra el lunes siguiente y cuando cae el 06 queda como dia normal
    { day: '01-06', daysToSum: NEXT_DAY.NONE, celebration: 'Vacaciones de la Rama Judicial' },
    { day: '01-07', daysToSum: NEXT_DAY.NONE, celebration: 'Vacaciones de la Rama Judicial' },
    { day: '01-08', daysToSum: NEXT_DAY.NONE, celebration: 'Vacaciones de la Rama Judicial' },
    { day: '01-09', daysToSum: NEXT_DAY.NONE, celebration: 'Vacaciones de la Rama Judicial' },
    { day: '01-10', daysToSum: NEXT_DAY.NONE, celebration: 'Vacaciones de la Rama Judicial' },
];
const MILLISECONDS_DAY = 86400000;