<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?php echo titulo?></title>
<script src="views/js/jquery.js" type="text/javascript"></script>
<script src="views/js/jquery.easySlider.js" type="text/javascript"></script>
<script src="views/js/jquery.validate.js" type="text/javascript"></script>
<script src="views/js/ui.datepicker.js" type="text/javascript" charset="utf-8"></script>                    	
<script src="views/js/select_dependientes.js" type="text/javascript"></script>
<link href="views/css/pepper-grinder/ui.all.css" rel="stylesheet" type="text/css" media="screen" title="no title" charset="utf-8">
<link href="views/css/main.css" rel="stylesheet" type="text/css">
<script type="text/javascript">
$(document).ready(function() {
	$(".topMenuAction").click( function() {
		if ($("#openCloseIdentifier").is(":hidden")) {
			$("#sliderm").animate({ 
				marginTop: "-238px"
				}, 500 );
			$("#topMenuImage").html('<img src="views/images/open.png" alt="open" />');
			$("#openCloseIdentifier").show();
		} else {
			$("#sliderm").animate({ 
				marginTop: "0px"
				}, 500 );
			$("#topMenuImage").html('<img src="views/images/close.png" alt="close" />');
			$("#openCloseIdentifier").hide();
		}
	});  
		
	$("#sliderop").easySlider({});	
	$("#frm").validate();
	
	var validator = $("#frm").validate({
		meta: "validate"
	});

	$(".btn_limpiar").click(function() {
		validator.resetForm();
	});			
});
</script>	
<script type="text/javascript">
function mainmenu(){
$(" #menusec ul ").css({display: "none"});
$(" #menusec li").hover(function(){
	$(this).find('ul:first:hidden').css({visibility: "visible",display: "none"}).slideDown(400);
	},function(){
		$(this).find('ul:first').slideUp(400);
	});
}
$(document).ready(function(){
	mainmenu();
});

</script>
<script type="text/javascript" language="javascript">

function opcionesciudad(id){

var m= document.getElementById("departamento_f"+id).value;


//var selectbox = document.getElementById("ciudad"+id);
var ciudad_select= document.getElementById("ciudad_f"+id);
ciudad_select.options.length = 0;

if(m==1)
{
ciudades   = new Array("AGUADAS","ANSERMA","ARANZAZU","BELALCAZAR","CHINCHINA","FILADELFIA","LA DORADA","LA MERCED","MANIZALES","MANZANARES","MARMATO","MARQUETALIA","MARULANDA","NEIRA","NORCASIA","PACORA","PALESTINA","PENSILVANIA","RIOSUCIO","RISARALDA","SALAMINA","SAMANA","SAN JOSE","SUPIA","VICTORIA","VILLAMARIA","VITERBO");
idciudades = new Array("12","44","53","94","204","340","469","479","546","548","556","557","559","611","618","643","653","679","779","780","800","807","845","972","1076","1087","1100");
}
if(m==2)
{
ciudades = new Array("ALMEIDA","AQUITANIA","ARCABUCO","BELEN","BERBEO","BETEITIVA","BOAVITA","BOYACA","BRICEÑO","BUENAVISTA","BUSBANZA","CALDAS","CAMPOHERMOSO","CERINZA","CHINAVITA","CHIQUINQUIRA","CHIQUIZA","CHISCAS","CHITA","CHITARAQUE","CHIVATA","CHIVOR","CIENEGA","COMBITA","COPER","CORRALES","COVARACHIA","CUBARA","CUCAITA","CUITIVA","DUITAMA","EL COCUY","EL ESPINO","FIRAVITOBA","FLORESTA","GACHANTIVA","GAMEZA","GARAGOA","GsICAN","GUACAMAYAS","GUATEQUE","GUAYATA","IZA","JENESANO","JERICO","LA CAPILLA","LA UVITA","LA VICTORIA","LABRANZAGRANDE","MACANAL","MARIPI","MIRAFLORES","MONGUA","MONGUI","MONIQUIRA","MOTAVITA","MUZO","NOBSA","NUEVO COLON","OICATA","OTANCHE","PACHAVITA","PAEZ","PAIPA","PAJARITO","PANQUEBA","PAUNA","PAYA","PAZ DE RIO","PESCA","PISBA","PUERTO BOYACA","QUIPAMA","RAMIRIQUI","RAQUIRA","RONDON","SABOYA","SACHICA","SAMACA","SAN EDUARDO","SAN JOSE DE PARE","SAN LUIS DE GACENO","SAN MATEO","SAN MIGUEL DE SEMA","SAN PABLO DE BORBUR","SANTA MARIA","SANTA ROSA DE VITERBO","SANTA SOFIA","SANTANA","SATIVANORTE","SATIVASUR","SIACHOQUE","SOATA","SOCHA","SOCOTA","SOGAMOSO","SOMONDOCO","SORA","SORACA","SOTAQUIRA","SUSACON","SUTAMARCHAN","SUTATENZA","TASCO","TENZA","TIBANA","TIBASOSA","TINJACA","TIPACOQUE","TOCA","TOGsI","TOPAGA","TOTA","TUNJA","TUNUNGUA","TURMEQUE","TUTA","TUTAZA","UMBITA","VENTAQUEMADA","VILLA DE LEYVA","VIRACACHA","ZETAQUIRA");
idciudades = new Array("27","51","61","96","102","104","108","117","119","125","131","149","159","185","203","208","209","211","212","214","215","216","222","235","247","254","257","262","264","268","284","301","308","342","346","366","374","375","391","393","416","421","446","450","452","463","499","502","507","529","554","571","581","582","583","598","603","616","622","629","638","640","646","650","651","665","672","673","675","682","692","720","754","757","758","785","795","797","806","833","848","862","869","872","876","901","908","911","914","926","927","931","944","945","947","948","952","957","958","959","975","976","978","993","1000","1005","1006","1013","1014","1017","1020","1025","1029","1035","1036","1041","1042","1043","1047","1071","1080","1098","1117");
}
if(m==3)
{
ciudades = new Array("ABEJORRAL","ABRIAQUI","ALEJANDRIA","AMAGA","AMALFI","ANDES","ANGELOPOLIS","ANGOSTURA","ANORI","ANZA","APARTADO","ARBOLETES","ARGELIA","ARMENIA","BARBOSA","BELLO","BELMIRA","BETANIA","BETULIA","BRICEÑO","BURITICA","CACERES","CAICEDO","CALDAS","CAMPAMENTO","CAÑASGORDAS","CARACOLI","CARAMANTA","CAREPA","CAROLINA","CAUCASIA","CHIGORODO","CISNEROS","CIUDAD BOLIVAR","COCORNA","CONCEPCION","CONCORDIA","COPACABANA","DABEIBA","DON MATIAS","EBEJICO","EL BAGRE","EL CARMEN DE VIBORAL","EL SANTUARIO","ENTRERRIOS","ENVIGADO","FREDONIA","FRONTINO","GIRALDO","GIRARDOTA","GOMEZ PLATA","GRANADA","GUADALUPE","GUARNE","GUATAPE","HELICONIA","HISPANIA","ITAGUI","ITUANGO","JARDIN","JERICO","LA CEJA","LA ESTRELLA","LA PINTADA","LA UNION","LIBORINA","MACEO","MARINILLA","MEDELLIN","MONTEBELLO","MURINDO","MUTATA","NARIÑO","NECHI","NECOCLI","OLAYA","PEÐOL","PEQUE","PUEBLORRICO","PUERTO BERRIO","PUERTO NARE","PUERTO TRIUNFO","REMEDIOS","RETIRO","RIONEGRO","SABANALARGA","SABANETA","SALGAR","SAN ANDRES DE CUERQUIA","SAN CARLOS","SAN FRANCISCO","SAN JERONIMO","SAN JOSE DE LA MONTAÑA","SAN JUAN DE URABA","SAN LUIS","SAN PEDRO","SAN PEDRO DE URABA","SAN RAFAEL","SAN ROQUE","SAN VICENTE","SANTA BARBARA","SANTA ROSA DE OSOS","SANTAFE DE ANTIOQUIA","SANTO DOMINGO","SEGOVIA","SONSON","SOPETRAN","TAMESIS","TARAZA","TARSO","TITIRIBI","TOLEDO","TURBO","URAMITA","URRAO","VALDIVIA","VALPARAISO","VEGACHI","VENECIA","VIGIA DEL FUERTE","YALI","YARUMAL","YOLOMBO","YONDO","ZARAGOZA");
idciudades = new Array("1","3","23","33","34","39","40","41","43","46","48","60","65","69","85","99","100","103","105","118","130","136","140","150","156","161","168","169","171","175","182","198","225","226","228","236","239","246","277","282","286","288","297","326","335","336","355","357","380","382","384","389","400","411","413","428","431","444","445","449","451","464","471","487","495","517","531","553","561","585","600","601","604","609","610","630","676","680","712","719","732","742","761","766","776","792","794","805","814","826","838","843","846","855","861","879","881","883","884","887","894","907","913","919","928","953","954","985","990","992","1016","1022","1040","1051","1054","1058","1065","1066","1070","1077","1104","1105","1107","1108","1115");
}
if(m==4)
{
ciudades = new Array("BARANOA","BARRANQUILLA","CAMPO DE LA CRUZ","CANDELARIA","GALAPA","JUAN DE ACOSTA","LURUACO","MALAMBO","MANATI","PALMAR DE VARELA","PIOJO","POLONUEVO","PONEDERA","PUERTO COLOMBIA","REPELON","SABANAGRANDE","SABANALARGA","SANTA LUCIA","SANTO TOMAS","SOLEDAD","SUAN","TUBARA","USIACURI");
idciudades = new Array("81","92","157","162","369","456","528","540","542","656","691","700","701","724","763","789","791","900","920","950","962","1033","1056");
} 
if(m==5)
{
ciudades = new Array("BOGOTA, D.C.");
idciudades = new Array("110");
} 
if(m==6)
{
ciudades = new Array("ACHI","ALTOS DEL ROSARIO","ARENAL","ARJONA","ARROYOHONDO","BARRANCO DE LOBA","CALAMAR","CANTAGALLO","CARTAGENA","CICUCO","CLEMENCIA","CORDOBA","EL CARMEN DE BOLIVAR","EL GUAMO","EL PEÑON","HATILLO DE LOBA","MAGANGUE","MAHATES","MARGARITA","MARIA LA BAJA","MOMPOS","MONTECRISTO","MORALES","NOROSI","PINILLOS","REGIDOR","RIO VIEJO","SAN CRISTOBAL","SAN ESTANISLAO","SAN FERNANDO","SAN JACINTO","SAN JACINTO DEL CAUCA","SAN JUAN NEPOMUCENO","SAN MARTIN DE LOBA","SAN PABLO","SANTA CATALINA","SANTA ROSA","SANTA ROSA DEL SUR","SIMITI","SOPLAVIENTO","TALAIGUA NUEVO","TIQUISIO","TURBACO","TURBANA","VILLANUEVA","ZAMBRANO");
idciudades = new Array("7","31","62","67","71","90","146","164","176","219","227","250","295","310","318","424","534","536","551","552","580","586","591","619","690","760","772","831","834","836","841","842","857","868","875","897","905","909","939","955","981","1015","1038","1039","1091","1112");
} 
if(m==7)
{
ciudades = new Array("ALBANIA","BELEN DE LOS ANDAQUIES","CARTAGENA DEL CHAIRA","CURILLO","EL DONCELLO","EL PAUJIL","FLORENCIA","LA MONTAÑITA","MILAN","MORELIA","PUERTO RICO","SAN JOSE DEL FRAGUA","SAN VICENTE DEL CAGUAN","SOLANO","SOLITA","VALPARAISO");
idciudades = new Array("19","97","177","274","304","314","344","481","569","593","735","849","889","949","951","1064");
} 
if(m==8)
{
ciudades = new Array("ALMAGUER","ARGELIA","BALBOA","BOLIVAR","BUENOS AIRES","CAJIBIO","CALDONO","CALOTO","CORINTO","EL TAMBO","FLORENCIA","GUACHENE","GUAPI","INZA","JAMBALO","LA SIERRA","LA VEGA","LOPEZ","MERCADERES","MIRANDA","MORALES","PADILLA","PAEZ","PATIA","PIAMONTE","PIENDAMO","POPAYAN","PUERTO TEJADA","PURACE","ROSAS","SAN SEBASTIAN","SANTA ROSA","SANTANDER DE QUILICHAO","SILVIA","SOTARA","SUAREZ","SUCRE","TIMBIO","TIMBIQUI","TORIBIO","TOTORO","VILLA RICA");
idciudades = new Array("26","63","80","115","127","144","151","155","251","328","345","395","408","439","447","492","501","520","567","572","592","644","645","671","683","686","702","741","746","786","885","904","915","936","960","964","967","1011","1012","1027","1030","1083");
} 
if(m==9)
{
ciudades = new Array("AGUACHICA","AGUSTIN CODAZZI","ASTREA","BECERRIL","BOSCONIA","CHIMICHAGUA","CHIRIGUANA","CURUMANI","EL COPEY","EL PASO","GAMARRA","GONZALEZ","LA GLORIA","LA JAGUA DE IBIRICO","LA PAZ","MANAURE","PAILITAS","PELAYA","PUEBLO BELLO","RIO DE ORO","SAN ALBERTO","SAN DIEGO","SAN MARTIN","TAMALAMEQUE","VALLEDUPAR");
idciudades = new Array("10","14","72","93","116","201","210","276","303","313","372","385","473","475","483","544","648","678","709","769","811","832","866","982","1063");
} 
if(m==10)
{
ciudades = new Array("AYAPEL","BUENAVISTA","CANALETE","CERETE","CHIMA","CHINU","CIENAGA DE ORO","COTORRA","LA APARTADA","LORICA","LOS CORDOBAS","MOMIL","MOÑITOS","MONTELIBANO","MONTERIA","PLANETA RICA","PUEBLO NUEVO","PUERTO ESCONDIDO","PUERTO LIBERTADOR","PURISIMA","SAHAGUN","SAN ANDRES SOTAVENTO","SAN ANTERO","SAN BERNARDO DEL VIENTO","SAN CARLOS","SAN PELAYO","TIERRALTA","VALENCIA");
idciudades = new Array("75","124","160","184","199","205","221","256","459","521","523","579","584","587","589","697","710","726","729","748","798","816","817","824","827","882","1009","1059");
} 
if(m==11)
{
ciudades = new Array("AGUA DE DIOS","ALBAN","ANAPOIMA","ANOLAIMA","APULO","ARBELAEZ","BELTRAN","BITUIMA","BOJACA","CABRERA","CACHIPAY","CAJICA","CAPARRAPI","CAQUEZA","CARMEN DE CARUPA","CHAGUANI","CHIA","CHIPAQUE","CHOACHI","CHOCONTA","COGUA","COTA","CUCUNUBA","EL COLEGIO","EL PEÑON","EL ROSAL","FACATATIVA","FOMEQUE","FOSCA","FUNZA","FUQUENE","FUSAGASUGA","GACHALA","GACHANCIPA","GACHETA","GAMA","GIRARDOT","GRANADA","GUACHETA","GUADUAS","GUASCA","GUATAQUI","GUATAVITA","GUAYABAL DE SIQUIMA","GUAYABETAL","GUTIERREZ","JERUSALEN","JUNIN","LA CALERA","LA MESA","LA PALMA","LA PEÑA","LA VEGA","LENGUAZAQUE","MACHETA","MADRID","MANTA","MEDINA","MOSQUERA","NARIÑO","NEMOCON","NILO","NIMAIMA","NOCAIMA","PACHO","PAIME","PANDI","PARATEBUENO","PASCA","PUERTO SALGAR","PULI","QUEBRADANEGRA","QUETAME","QUIPILE","RICAURTE","SAN ANTONIO DEL TEQUENDAMA","SAN BERNARDO","SAN CAYETANO","SAN FRANCISCO","SAN JUAN DE RIO SECO","SASAIMA","SESQUILE","SIBATE","SILVANIA","SIMIJACA","SOACHA","SOPO","SUBACHOQUE","SUESCA","SUPATA","SUSA","SUTATAUSA","TABIO","TAUSA","TENA","TENJO","TIBACUY","TIBIRITA","TOCAIMA","TOCANCIPA","TOPAIPI","UBALA","UBAQUE","UNE","UTICA","VENECIA","VERGARA","VIANI","VILLA DE SAN DIEGO DE UBATE","VILLAGOMEZ","VILLAPINZON","VILLETA","VIOTA","YACOPI","ZIPACON","ZIPAQUIRA");
idciudades = new Array("9","16","36","42","50","57","101","107","111","133","137","145","165","167","173","190","196","206","217","218","230","255","265","302","316","324","338","350","353","361","362","363","364","365","367","371","381","388","396","402","412","414","415","419","420","422","453","457","462","480","482","486","500","513","532","533","547","562","596","605","613","614","615","617","641","649","664","668","669","738","744","749","750","755","767","819","822","829","839","854","925","929","932","935","938","943","956","966","970","971","974","977","979","995","997","999","1004","1007","1018","1019","1026","1044","1045","1048","1057","1069","1072","1075","1081","1085","1092","1096","1097","1101","1118","1119");
} 
if(m==12)
{
ciudades = new Array("ACANDI","ALTO BAUDO","ATRATO","BAGADO","BAHIA SOLANO","BAJO BAUDO","BOJAYA","CARMEN DEL DARIEN","CERTEGUI","CONDOTO","EL CANTON DEL SAN PABLO","EL CARMEN DE ATRATO","EL LITORAL DEL SAN JUAN","ISTMINA","JURADO","LLORO","MEDIO ATRATO","MEDIO BAUDO","MEDIO SAN JUAN","NOVITA","NUQUI","QUIBDO","RIO IRO","RIO QUITO","RIOSUCIO","SAN JOSE DEL PALMAR","SIPI","TADO","UNGUIA","UNION PANAMERICANA");
idciudades = new Array("5","30","74","76","77","78","112","174","188","240","292","294","311","443","458","519","563","564","565","620","624","751","770","771","778","851","941","980","1049","1050");
} 
if(m==13)
{
ciudades = new Array("ACEVEDO","AGRADO","AIPE","ALGECIRAS","ALTAMIRA","BARAYA","CAMPOALEGRE","COLOMBIA","ELIAS","GARZON","GIGANTE","GUADALUPE","HOBO","IQUIRA","ISNOS","LA ARGENTINA","LA PLATA","NATAGA","NEIVA","OPORAPA","PAICOL","PALERMO","PALESTINA","PITAL","PITALITO","RIVERA","SALADOBLANCO","SAN AGUSTIN","SANTA MARIA","SUAZA","TARQUI","TELLO","TERUEL","TESALIA","TIMANA","VILLAVIEJA","YAGUARA");
idciudades = new Array("6","8","15","25","29","82","158","231","332","376","378","401","432","441","442","460","488","607","612","633","647","652","654","693","694","781","799","810","902","965","991","996","1002","1003","1010","1095","1103");
}  
if(m==14)
{
ciudades = new Array("ALBANIA","BARRANCAS","DIBULLA","DISTRACCION","EL MOLINO","FONSECA","HATONUEVO","LA JAGUA DEL PILAR","MAICAO","MANAURE","RIOHACHA","SAN JUAN DEL CESAR","URIBIA","URUMITA","VILLANUEVA");
idciudades = new Array("20","89","279","280","312","351","427","476","537","543","775","856","1053","1055","1089");
}  
if(m==15)
{
ciudades = new Array("ALGARROBO","ARACATACA","ARIGUANI","CERRO SAN ANTONIO","CHIBOLO","CIENAGA","CONCORDIA","EL BANCO","EL PIÑON","EL RETEN","FUNDACION","GUAMAL","NUEVA GRANADA","PEDRAZA","PIJIÑO DEL CARMEN","PIVIJAY","PLATO","PUEBLOVIEJO","REMOLINO","SABANAS DE SAN ANGEL","SALAMINA","SAN SEBASTIAN DE BUENAVISTA","SAN ZENON","SANTA ANA","SANTA BARBARA DE PINTO","SANTA MARTA","SITIONUEVO","TENERIFE","ZAPAYAN","ZONA BANANERA");
idciudades = new Array("24","52","66","187","197","220","238","289","319","321","359","405","621","677","688","695","698","713","762","793","801","886","890","892","896","903","942","998","1114","1120");
}
if(m==16)
{
ciudades = new Array("ACACIAS","BARRANCA DE UPIA","CABUYARO","CASTILLA LA NUEVA","CUBARRAL","CUMARAL","EL CALVARIO","EL CASTILLO","EL DORADO","FUENTE DE ORO","GRANADA","GUAMAL","LA MACARENA","LEJANIAS","MAPIRIPAN","MESETAS","PUERTO CONCORDIA","PUERTO GAITAN","PUERTO LLERAS","PUERTO LOPEZ","PUERTO RICO","RESTREPO","SAN CARLOS DE GUAROA","SAN JUAN DE ARAMA","SAN JUANITO","SAN MARTIN","URIBE","VILLAVICENCIO","VISTAHERMOSA");
idciudades = new Array("4","87","134","181","263","269","291","298","305","358","387","406","478","512","549","568","725","727","730","731","736","765","828","852","858","867","1052","1094","1099");
} 
if(m==17)
{
ciudades = new Array("ALBAN","ALDANA","ANCUYA","ARBOLEDA","BARBACOAS","BELEN","BUESACO","CHACHAGsI","COLON","CONSACA","CONTADERO","CORDOBA","CUASPUD","CUMBAL","CUMBITARA","EL CHARCO","EL PEÑOL","EL ROSARIO","EL TABLON DE GOMEZ","EL TAMBO","FRANCISCO PIZARRO","FUNES","GUACHUCAL","GUAITARILLA","GUALMATAN","ILES","IMUES","IPIALES","LA CRUZ","LA FLORIDA","LA LLANADA","LA TOLA","LA UNION","LEIVA","LINARES","LOS ANDES","MAGsI","MALLAMA","MOSQUERA","NARIÑO","OLAYA HERRERA","OSPINA","PASTO","POLICARPA","POTOSI","PROVIDENCIA","PUERRES","PUPIALES","RICAURTE","ROBERTO PAYAN","SAMANIEGO","SAN ANDRES DE TUMACO","SAN BERNARDO","SAN LORENZO","SAN PABLO","SAN PEDRO DE CARTAGO","SANDONA","SANTA BARBARA","SANTACRUZ","SAPUYES","TAMINANGO","TANGUA","TUQUERRES","YACUANQUER");
idciudades = new Array("17","22","37","58","83","95","128","189","233","242","243","248","261","271","272","300","315","325","327","329","354","360","397","403","404","436","437","440","467","472","477","494","496","511","518","522","535","541","597","606","631","637","670","699","704","707","715","745","768","782","808","815","823","859","874","880","891","895","912","922","986","987","1037","1102");
}
if(m==18)
{
ciudades = new Array("ABREGO","ARBOLEDAS","BOCHALEMA","BUCARASICA","CACHIRA","CACOTA","CHINACOTA","CHITAGA","CONVENCION","CUCUTA","CUCUTILLA","DURANIA","EL CARMEN","EL TARRA","EL ZULIA","GRAMALOTE","HACARI","HERRAN","LA ESPERANZA","LA PLAYA","LABATECA","LOS PATIOS","LOURDES","MUTISCUA","OCAÑA","PAMPLONA","PAMPLONITA","PUERTO SANTANDER","RAGONVALIA","SALAZAR","SAN CALIXTO","SAN CAYETANO","SANTIAGO","SARDINATA","SILOS","TEORAMA","TIBU","TOLEDO","VILLA CARO","VILLA DEL ROSARIO");
idciudades = new Array("2","59","109","121","138","139","202","213","245","266","267","285","293","330","331","386","423","429","470","489","506","525","527","602","627","661","662","740","756","802","825","830","916","924","934","1001","1008","1021","1079","1082");
}
if(m==19)
{
ciudades = new Array("ARMENIA","BUENAVISTA","CALARCA","CIRCASIA","CORDOBA","FILANDIA","GENOVA","LA TEBAIDA","MONTENEGRO","PIJAO","QUIMBAYA","SALENTO");
idciudades = new Array("68","123","148","224","249","341","377","493","588","687","752","804");
}
if(m==20)
{
ciudades = new Array("APIA","BALBOA","BELEN DE UMBRIA","DOSQUEBRADAS","GUATICA","LA CELIA","LA VIRGINIA","MARSELLA","MISTRATO","PEREIRA","PUEBLO RICO","QUINCHIA","SANTA ROSA DE CABAL","SANTUARIO");
idciudades = new Array("49","79","98","283","417","465","505","558","574","681","711","753","906","921");
}
if(m==21)
{
ciudades = new Array("AGUADA","ALBANIA","ARATOCA","BARBOSA","BARICHARA","BARRANCABERMEJA","BETULIA","BOLIVAR","BUCARAMANGA","CABRERA","CALIFORNIA","CAPITANEJO","CARCASI","CEPITA","CERRITO","CHARALA","CHARTA","CHIMA","CHIPATA","CIMITARRA","CONCEPCION","CONFINES","CONTRATACION","COROMORO","CURITI","EL CARMEN DE CHUCURI","EL GUACAMAYO","EL PEÑON","EL PLAYON","ENCINO","ENCISO","FLORIAN","FLORIDABLANCA","GALAN","GAMBITA","GIRON","GsEPSA","GUACA","GUADALUPE","GUAPOTA","GUAVATA","HATO","JESUS MARIA","JORDAN","LA BELLEZA","LA PAZ","LANDAZURI","LEBRIJA","LOS SANTOS","MACARAVITA","MALAGA","MATANZA","MOGOTES","MOLAGAVITA","OCAMONTE","OIBA","ONZAGA","PALMAR","PALMAS DEL SOCORRO","PARAMO","PIEDECUESTA","PINCHOTE","PUENTE NACIONAL","PUERTO PARRA","PUERTO WILCHES","RIONEGRO","SABANA DE TORRES","SAN ANDRES","SAN BENITO","SAN GIL","SAN JOAQUIN","SAN JOSE DE MIRANDA","SAN MIGUEL","SAN VICENTE DE CHUCURI","SANTA BARBARA","SANTA HELENA DEL OPON","SIMACOTA","SOCORRO","SUAITA","SUCRE","SURATA","TONA","VALLE DE SAN JOSE","VELEZ","VETAS","VILLANUEVA","ZAPATOCA");
idciudades = new Array("11","18","54","84","86","88","106","113","120","132","153","166","170","183","186","194","195","200","207","223","237","241","244","252","275","296","309","317","320","333","334","347","349","368","373","383","390","392","399","409","418","425","454","455","461","484","508","509","526","530","539","560","577","578","626","628","632","655","657","667","684","689","714","734","743","777","788","812","820","840","844","847","871","888","893","898","937","946","961","968","973","1024","1060","1067","1074","1088","1113");
}
if(m==22)
{
ciudades = new Array("BUENAVISTA","CAIMITO","CHALAN","COLOSO","COROZAL","COVEÑAS","EL ROBLE","GALERAS","GUARANDA","LA UNION","LOS PALMITOS","MAJAGUAL","MORROA","OVEJAS","PALMITO","SAMPUES","SAN BENITO ABAD","SAN JUAN DE BETULIA","SAN LUIS DE SINCE","SAN MARCOS","SAN ONOFRE","SAN PEDRO","SANTIAGO DE TOLU","SINCELEJO","SUCRE","TOLU VIEJO");
idciudades = new Array("126","142","191","234","253","258","323","370","410","498","524","538","595","639","659","809","821","853","864","865","873","878","918","940","969","1023");
} 
if(m==23)
{
ciudades = new Array("ALPUJARRA","ALVARADO","AMBALEMA","ANZOATEGUI","ARMERO","ATACO","CAJAMARCA","CARMEN DE APICALA","CASABIANCA","CHAPARRAL","COELLO","COYAIMA","CUNDAY","DOLORES","ESPINAL","FALAN","FLANDES","FRESNO","GUAMO","HERVEO","HONDA","IBAGUE","ICONONZO","LERIDA","LIBANO","MARIQUITA","MELGAR","MURILLO","NATAGAIMA","ORTEGA","PALOCABILDO","PIEDRAS","PLANADAS","PRADO","PURIFICACION","RIOBLANCO","RONCESVALLES","ROVIRA","SALDAÑA","SAN ANTONIO","SAN LUIS","SANTA ISABEL","SUAREZ","VALLE DE SAN JUAN","VENADILLO","VILLAHERMOSA","VILLARRICA");
idciudades = new Array("28","32","35","47","70","73","143","172","180","193","229","259","273","281","337","339","343","356","407","430","433","434","435","514","516","555","566","599","608","636","660","685","696","706","747","773","784","787","803","818","860","899","963","1061","1068","1086","1093");
}
if(m==24)
{
ciudades = new Array("ALCALA","ANDALUCIA","ANSERMANUEVO","ARGELIA","BOLIVAR","BUENAVENTURA","BUGALAGRANDE","CAICEDONIA","CALI","CALIMA","CANDELARIA","CARTAGO","DAGUA","EL AGUILA","EL CAIRO","EL CERRITO","EL DOVIO","FLORIDA","GINEBRA","GUACARI","GUADALAJARA DE BUGA","JAMUNDI","LA CUMBRE","LA UNION","LA VICTORIA","OBANDO","PALMIRA","PRADERA","RESTREPO","RIOFRIO","ROLDANILLO","SAN PEDRO","SEVILLA","TORO","TRUJILLO","TULUA","ULLOA","VERSALLES","VIJES","YOTOCO","YUMBO","ZARZAL");
idciudades = new Array("21","38","45","64","114","122","129","141","152","154","163","178","278","287","290","299","306","348","379","394","398","448","468","497","504","625","658","705","764","774","783","877","930","1028","1032","1034","1046","1073","1078","1110","1111","1116");
}
if(m==25)
{
ciudades = new Array("ARAUCA","ARAUQUITA","CRAVO NORTE","FORTUL","PUERTO RONDON","SARAVENA","TAME");
idciudades = new Array("55","56","260","352","737","923","984");
}
if(m==26)
{
ciudades = new Array("AGUAZUL","CHAMEZA","HATO COROZAL","LA SALINA","MANI","MONTERREY","NUNCHIA","OROCUE","PAZ DE ARIPORO","PORE","RECETOR","SABANALARGA","SACAMA","SAN LUIS DE PALENQUE","TAMARA","TAURAMENA","TRINIDAD","VILLANUEVA","YOPAL");
idciudades = new Array("13","192","426","491","545","590","623","635","674","703","759","790","796","863","983","994","1031","1090","1109");
}
if(m==27)
{
ciudades = new Array("COLON","LEGUIZAMO","MOCOA","ORITO","PUERTO ASIS","PUERTO CAICEDO","PUERTO GUZMAN","SAN FRANCISCO","SAN MIGUEL","SANTIAGO","SIBUNDOY","VALLE DEL GUAMUEZ","VILLAGARZON");
idciudades = new Array("232","510","576","634","718","721","728","837","870","917","933","1062","1084");
}
if(m==28)
{
ciudades = new Array("PROVIDENCIA","SAN ANDRES");
idciudades = new Array("708","813");
}
if(m==29)
{
ciudades = new Array("EL ENCANTO","LA CHORRERA","LA PEDRERA","LA VICTORIA","LETICIA","MIRITI - PARANA","PUERTO ALEGRIA","PUERTO ARICA","PUERTO NARIÑO","PUERTO SANTANDER","TARAPACA");
idciudades = new Array("307","466","485","503","515","573","716","717","733","739","989");
}
if(m==30)
{
ciudades = new Array("BARRANCO MINAS","CACAHUAL","INIRIDA","LA GUADALUPE","MAPIRIPANA","MORICHAL","PANA PANA","PUERTO COLOMBIA","SAN FELIPE");
idciudades = new Array("91","135","438","474","550","594","663","723","835");
}
if(m==31)
{
ciudades = new Array("CALAMAR","EL RETORNO","MIRAFLORES","SAN JOSE DEL GUAVIARE");
idciudades = new Array("147","322","570","850");
}
if(m==32)
{
ciudades = new Array("CARURU","MITU","PACOA","PAPUNAUA","TARAIRA","YAVARATE");
idciudades = new Array("179","575","642","666","988","1106");
}

if(m==33)
{
ciudades = new Array("CUMARIBO","LA PRIMAVERA","PUERTO CARREÑO","SANTA ROSALIA");
idciudades = new Array("270","490","722","910");
}


kk= ciudades.length;
   
   for(var i=0;i<kk;i++){ 
        ciudad_select.options[i] = new Option(ciudades[i]);
		ciudad_select.options[i].value = idciudades[i]  ;
		}


}
function habilitar(frm,id){
var opcion = document.getElementById("selecciona_parte"+id).checked;
if(opcion == true)
 {
  document.getElementById("oficio_telegrama_f"+id).disabled = false;
  document.getElementById("oficio_telegrama_fb"+id).disabled = false;
  document.getElementById("numero_oficio_telegrama_f"+id).disabled = false;
  document.getElementById("actuacion_f"+id).disabled = false;
  document.getElementById("direccion_f"+id).disabled = false;
  document.getElementById("departamento_f"+id).disabled = false;
  document.getElementById("ciudad_f"+id).disabled = false;
  document.getElementById("medio_f"+id).disabled = false;
  document.getElementById("notificado_f"+id).disabled = false;
  document.getElementById("notificado_fb"+id).disabled = false;
  document.getElementById("fecha_f"+id).disabled = false;
  
    
 }
 else
 {
  document.getElementById("oficio_telegrama_f"+id).disabled = true;
  document.getElementById("oficio_telegrama_fb"+id).disabled = true;
  document.getElementById("numero_oficio_telegrama_f"+id).disabled = true;
  document.getElementById("actuacion_f"+id).disabled = true;
  document.getElementById("direccion_f"+id).disabled = true;
  document.getElementById("departamento_f"+id).disabled = true;
  document.getElementById("ciudad_f"+id).disabled = true;  
  document.getElementById("medio_f"+id).disabled = true;
  document.getElementById("notificado_f"+id).disabled = true;
  document.getElementById("notificado_fb"+id).disabled = true;
  document.getElementById("fecha_f"+id).disabled = true;  
 }
}




numf=0;

function crearForm(form,frm) {

//alert('entre');
  numf++;
  
  fi = document.getElementById('fiel2'); // 1
  contenedor = document.createElement('div'); // 2
  contenedor.id = 'div'+numf; // 3
  fi.appendChild(contenedor); // 4
  
  ele = document.createElement('hr');
   ele.id='br'; 
  contenedor.appendChild(ele); 


   
  contenedor.appendChild(ele); // 7
  ele = document.createElement('input'); 
  ele.type = '<label>'; 
  ele.name = 'TAccionante'+numf; 
  ele.value= 'Accionante';
  ele.id= 'txt_input78';
  ele.disabled= 'true';
  contenedor.appendChild(ele); 
  
  ele = document.createElement('input'); 
  ele.type = 'radio'; 
  ele.name = 'accionante_accionado_vinculado'+numf; 
  ele.id = 'accionante_accionado_vinculado'+numf; 
  ele.value = 'Accionante';
  ele.className = 'required';
  ele.checked ='checked';
  contenedor.appendChild(ele);  
  
  
  ele = document.createElement('input'); 
  ele.type = '<label>';
   ele.name = 'TAccionado'+numf;  
  ele.value= 'Accionado';
  ele.id= 'txt_input78';
  ele.disabled= 'true';
  contenedor.appendChild(ele); 
  
  ele = document.createElement('input'); // 5
  ele.type = 'radio'; // 6
  ele.name = 'accionante_accionado_vinculado'+numf; // 6
  ele.id = 'accionante_accionado_vinculado'+numf; // 6
  ele.value = 'Accionado';
  ele.className = 'required';
  contenedor.appendChild(ele); // 7
  
  
  ele = document.createElement('input'); 
  ele.type = '<label>'; 
  ele.name = 'TVinculado'+numf; 
  ele.value= 'Vinculado';
  ele.id= 'txt_input78';
  ele.disabled= 'true';
  contenedor.appendChild(ele); 
  
  ele = document.createElement('input'); // 5
  ele.type = 'radio'; // 6
  ele.name = 'accionante_accionado_vinculado'+numf; // 6
  ele.id = 'accionante_accionado_vinculado'+numf; // 6
  ele.value = 'Vinculado';
  ele.className = 'required';
  contenedor.appendChild(ele); // 7
  
  ele = document.createElement('input'); 
  ele.type = 'text'; 
  ele.name = 'accionante_accionado_vinculado_texto'+numf; 
  ele.id= 'txt_input80';
  ele.className= 'required';
  contenedor.appendChild(ele); 
  
  ele = document.createElement('br'); 
  contenedor.appendChild(ele); 
  ele = document.createElement('br'); 
  contenedor.appendChild(ele); 

  
  ele = document.createElement('input'); 
  ele.type = '<label>'; 
  ele.name = 'OficioTexto'+numf; 
  ele.value= 'Oficio';
  ele.id= 'txt_input78';
  ele.disabled= 'true';
  contenedor.appendChild(ele); 
  
  ele = document.createElement('input'); // 5
  ele.type = 'radio'; // 6
  ele.name = 'esOficio_Telegrama'+numf; // 6
  ele.id = 'esOficio_Telegrama'+numf; // 6
  ele.value = 'Oficio';
  ele.className = 'required';
  ele.checked ='checked'
  contenedor.appendChild(ele); // 7
  
  ele = document.createElement('input'); 
  ele.type = '<label>'; 
  ele.name = 'apellido1'+numf; 
  ele.value= 'Telegrama';
  ele.id= 'txt_input78';
  ele.disabled= 'true';
  contenedor.appendChild(ele); 
  
  ele = document.createElement('input'); 
  ele.type = 'radio'; // 6
  ele.name = 'esOficio_Telegrama'+numf; 
  ele.id = 'esOficio_Telegrama'+numf; 
  ele.value = 'Telegrama';
  ele.className = 'required';
  contenedor.appendChild(ele);
  
  ele = document.createElement('input'); 
  ele.type = '<label>'; 
  ele.name = 'apellido1'+numf; 
  ele.value= 'Número: ';
  ele.id= 'txt_input79';
  ele.disabled= 'true';
  contenedor.appendChild(ele); 
  
  ele = document.createElement('input'); 
  ele.type = 'text'; 
  ele.name = 'oficio_telegrama_numero'+numf; 
  ele.id= 'txt_input80';
  ele.className= 'required';
  contenedor.appendChild(ele); 
  
  ele = document.createElement('br'); 
  contenedor.appendChild(ele); 
  ele = document.createElement('br'); 
  contenedor.appendChild(ele); 
  
  ele = document.createElement('input'); 
  ele.type = '<label>'; 
  ele.name = 'apellido1'+numf; 
  ele.value= 'Dirección: ';
  ele.id= 'txt_input78';
  ele.disabled= 'true';
  contenedor.appendChild(ele); 
  
  ele = document.createElement('input'); 
  ele.type = 'text'; 
  ele.name = 'direccion'+numf; 
  ele.id= 'txt_input';
  ele.className= 'required';
  contenedor.appendChild(ele); 
  
  ele = document.createElement('br'); 
  contenedor.appendChild(ele); 
  ele = document.createElement('br'); 
  contenedor.appendChild(ele); 
  

  ele = document.createElement('select'); 
  departamento=ele;
  ele.name = 'departamento'+numf; 
  ele.id = 'departamento'+numf; 
  ele.className = 'required';
  departamentos = new Array("AMAZONAS","ANTIOQUIA","ARAUCA","ATLANTICO","BOGOTA","BOLIVAR","CALDAS","CAQUETA","CASANARE","CAUCA","CESAR","CHOCO","CORDOBA","CUNDINAMARCA","GUAINIA","GUAVIARE","HUILA","LA GUAJIRA","MAGDALENA","META","N. DE SANTANDER","NARIÑO","PUERTO BOYACA","PUTUMAYO","QUINDIO","RISARALDA","SAN ANDRES","SANTANDER","SUCRE","TOLIMA","VALLE DEL CAUCA","VAUPES","VICHADA");
  departamentosid = new Array("29","3","25","4","5","6","1","7","26","8","9","12","10","11","30","31","13","14","15","16","18","17","2","27","19","20","28","21","22","23","24","32","33");
  
  k= departamentos.length;
  
   ele.options[0] = new Option("Seleccione un departamento: ");
   ele.options[0].value ="";
   for(var i=0;i<k;i++){
        var j = i+1; 
        ele.options[j] = new Option(departamentos[i]);
		ele.options[j].value =departamentosid[i] ;
		}
  contenedor.appendChild(ele);
  
  ele = document.createElement('select'); 
  ciudad=ele;
  ele.name = 'ciudad'+numf;  
  ciudad_id=ele.id = 'ciudad'+numf;  
  ciudad=ele;
  ele.className = 'required';
  ele.options[0] = new Option("Seleccione una ciudad: ");
  ele.options[0].value ="";
  contenedor.appendChild(ele);
  departamento.onchange = function () {ciudadForm(this.name,ciudad,ciudad_id);}
  
  ele = document.createElement('br'); 
  contenedor.appendChild(ele); 
  ele = document.createElement('br'); 
  contenedor.appendChild(ele); 
  
  
  ele = document.createElement('input'); 
  ele.type = '<label>'; 
  ele.name = 'medio'+numf; 
  ele.value= 'Medio Notificación: ';
  ele.id= 'estilo_medio';
  ele.disabled= 'true';
  contenedor.appendChild(ele); 
  
 
  ele = document.createElement('select'); 
  ele.name = 'medio'+numf; 
  ele.id = 'sl_input'; 
  ele.className = 'required';
  ele.options[0] = new Option("Fax");
  ele.options[0].value =1; 
  ele.options[1] = new Option("Correo");
  ele.options[1].value =2; 
  ele.options[2] = new Option("Correo Electronico");
  ele.options[2].value =3; 
  ele.options[3] = new Option("Fax - Correo");
  ele.options[3].value =4;  
  ele.options[4] = new Option("Fax-Correo-Correo Electronico");
  ele.options[4].value =5;  
  ele.options[5] = new Option("Personal");
  ele.options[5].value =6;  
  contenedor.appendChild(ele);
  
  ele = document.createElement('br'); 
  contenedor.appendChild(ele); 
  ele = document.createElement('br'); 
  contenedor.appendChild(ele); 
  
  ele = document.createElement('input'); 
  ele.type = '<label>'; 
  ele.name = 'medio'+numf; 
  ele.value= 'Se hizo notificación?';
  ele.id= 'estilo_radio';
  ele.disabled= 'true';
  contenedor.appendChild(ele); 
  
  ele = document.createElement('input'); 
  ele.type = '<label>'; 
  ele.name = 'notificado_textoSi'+numf; 
  ele.value= 'Si';
  ele.id= 'txt_input78';
  ele.disabled= 'true';
  contenedor.appendChild(ele); 
  
  
  ele = document.createElement('input'); 
  ele.type = 'radio'; 
  ele.name = 'notificado'+numf; 
  ele.value = 'Si';
  ele.className = 'required';
  ele.checked ='checked'
  contenedor.appendChild(ele); 
  
   ele = document.createElement('input'); 
  ele.type = '<label>'; 
  ele.name = 'notificado_textoNO'+numf; 
  ele.value= 'No';
  ele.id= 'txt_input78';
  ele.disabled= 'true';
  contenedor.appendChild(ele); 
  
  
  ele = document.createElement('input'); 
  ele.type = 'radio'; 
  ele.name = 'notificado'+numf; 
  ele.value = 'No';
  ele.className = 'required';
  contenedor.appendChild(ele); 
  
  ele = document.createElement('br'); 
  contenedor.appendChild(ele); 
  ele = document.createElement('br'); 
  contenedor.appendChild(ele); 
  
  ele = document.createElement('input'); 
  ele.type = '<label>'; 
  ele.name = 'medio'+numf; 
  ele.value= 'Fecha Envio: ';
  ele.id= 'txt_input81';
  ele.disabled= 'true';
  contenedor.appendChild(ele); 
  
  ele = document.createElement('input'); 
  ele.type = 'text'; 
  ele.name = 'fecha_envio'+numf; 
  ele.id= 'txt_input80';
  ele.className= 'required tinicio';
  contenedor.appendChild(ele); 
    jQuery(document).ready(function()
			{
			  jQuery(".tinicio").datepicker({ changeFirstDay: false	});
			});
			
  ele = document.createElement('br'); 
  contenedor.appendChild(ele); 
  ele = document.createElement('br'); 
  contenedor.appendChild(ele); 		
  
  ele = document.createElement('select'); 
  ele.name = 'idactuacion'+numf; 
  ele.id = 'sl_input'; 
  ele.className = 'required';
  ele.options[0] = new Option("Seleccione la actuación");
  ele.options[0].value =0;
  actuaciones = new Array("Archivo","Ausencia de Objeto","Avoca Conocimiento","Citación a declarar","Citación Audiencia","Confirmación fallo","Confirmación parcial","Desistimiento","Envio a la Corte Costitucional","Envio por competencia","Fallo 1° Instancia","Fallo 2° Instancia","Hecho Superado","Improcedente","Impugnación","Inadmisión","Medida previa","Niega pruebas","No aplica","Pone en conocimiento","Pruebas","Rechazo","Remisión expediente","Remite Tutela","Requerimiento","Respuesta Oficio","Solicitud de información","vinculación");
  idactuaciones = new Array("1","2","3","4","5","6","7","8","9","10","11","12","13","14","15","16","17","18","19","20","21","22","23","24","25","26","27","28");
  for(var i=0;i<k;i++){
        var j = i+1; 
        ele.options[j] = new Option(actuaciones[i]);
		ele.options[j].value =idactuaciones[i] ;
		}
  contenedor.appendChild(ele);
 
 

  ele = document.createElement('input'); // 5
  ele.type = 'button'; // 6
  ele.value = 'Borrar'; // 8
  ele.id = 'btn_input'; // 8
  ele.name = 'div'+numf; // 8
  ele.onclick = function () {borrarForm(this.name);} // 9
  contenedor.appendChild(ele); // 7
//  array[num]="";
  frm.cantidad_detalles.value=numf;


  
}
function borrarForm(obj) {
  fi = document.getElementById('fiel2'); // 1 
  fi.removeChild(document.getElementById(obj)); // 10
  //num= num-1;
  
}
function ciudadForm(obj,ciudad,ciudad_id) {

var m = document.getElementById(obj).value;
//alert(m);

if(m==1)
{
ciudades   = new Array("AGUADAS","ANSERMA","ARANZAZU","BELALCAZAR","CHINCHINA","FILADELFIA","LA DORADA","LA MERCED","MANIZALES","MANZANARES","MARMATO","MARQUETALIA","MARULANDA","NEIRA","NORCASIA","PACORA","PALESTINA","PENSILVANIA","RIOSUCIO","RISARALDA","SALAMINA","SAMANA","SAN JOSE","SUPIA","VICTORIA","VILLAMARIA","VITERBO");
idciudades = new Array("12","44","53","94","204","340","469","479","546","548","556","557","559","611","618","643","653","679","779","780","800","807","845","972","1076","1087","1100");
}
if(m==2)
{
ciudades = new Array("ALMEIDA","AQUITANIA","ARCABUCO","BELEN","BERBEO","BETEITIVA","BOAVITA","BOYACA","BRICEÑO","BUENAVISTA","BUSBANZA","CALDAS","CAMPOHERMOSO","CERINZA","CHINAVITA","CHIQUINQUIRA","CHIQUIZA","CHISCAS","CHITA","CHITARAQUE","CHIVATA","CHIVOR","CIENEGA","COMBITA","COPER","CORRALES","COVARACHIA","CUBARA","CUCAITA","CUITIVA","DUITAMA","EL COCUY","EL ESPINO","FIRAVITOBA","FLORESTA","GACHANTIVA","GAMEZA","GARAGOA","GsICAN","GUACAMAYAS","GUATEQUE","GUAYATA","IZA","JENESANO","JERICO","LA CAPILLA","LA UVITA","LA VICTORIA","LABRANZAGRANDE","MACANAL","MARIPI","MIRAFLORES","MONGUA","MONGUI","MONIQUIRA","MOTAVITA","MUZO","NOBSA","NUEVO COLON","OICATA","OTANCHE","PACHAVITA","PAEZ","PAIPA","PAJARITO","PANQUEBA","PAUNA","PAYA","PAZ DE RIO","PESCA","PISBA","PUERTO BOYACA","QUIPAMA","RAMIRIQUI","RAQUIRA","RONDON","SABOYA","SACHICA","SAMACA","SAN EDUARDO","SAN JOSE DE PARE","SAN LUIS DE GACENO","SAN MATEO","SAN MIGUEL DE SEMA","SAN PABLO DE BORBUR","SANTA MARIA","SANTA ROSA DE VITERBO","SANTA SOFIA","SANTANA","SATIVANORTE","SATIVASUR","SIACHOQUE","SOATA","SOCHA","SOCOTA","SOGAMOSO","SOMONDOCO","SORA","SORACA","SOTAQUIRA","SUSACON","SUTAMARCHAN","SUTATENZA","TASCO","TENZA","TIBANA","TIBASOSA","TINJACA","TIPACOQUE","TOCA","TOGsI","TOPAGA","TOTA","TUNJA","TUNUNGUA","TURMEQUE","TUTA","TUTAZA","UMBITA","VENTAQUEMADA","VILLA DE LEYVA","VIRACACHA","ZETAQUIRA");
idciudades = new Array("27","51","61","96","102","104","108","117","119","125","131","149","159","185","203","208","209","211","212","214","215","216","222","235","247","254","257","262","264","268","284","301","308","342","346","366","374","375","391","393","416","421","446","450","452","463","499","502","507","529","554","571","581","582","583","598","603","616","622","629","638","640","646","650","651","665","672","673","675","682","692","720","754","757","758","785","795","797","806","833","848","862","869","872","876","901","908","911","914","926","927","931","944","945","947","948","952","957","958","959","975","976","978","993","1000","1005","1006","1013","1014","1017","1020","1025","1029","1035","1036","1041","1042","1043","1047","1071","1080","1098","1117");
}
if(m==3)
{
ciudades = new Array("ABEJORRAL","ABRIAQUI","ALEJANDRIA","AMAGA","AMALFI","ANDES","ANGELOPOLIS","ANGOSTURA","ANORI","ANZA","APARTADO","ARBOLETES","ARGELIA","ARMENIA","BARBOSA","BELLO","BELMIRA","BETANIA","BETULIA","BRICEÑO","BURITICA","CACERES","CAICEDO","CALDAS","CAMPAMENTO","CAÑASGORDAS","CARACOLI","CARAMANTA","CAREPA","CAROLINA","CAUCASIA","CHIGORODO","CISNEROS","CIUDAD BOLIVAR","COCORNA","CONCEPCION","CONCORDIA","COPACABANA","DABEIBA","DON MATIAS","EBEJICO","EL BAGRE","EL CARMEN DE VIBORAL","EL SANTUARIO","ENTRERRIOS","ENVIGADO","FREDONIA","FRONTINO","GIRALDO","GIRARDOTA","GOMEZ PLATA","GRANADA","GUADALUPE","GUARNE","GUATAPE","HELICONIA","HISPANIA","ITAGUI","ITUANGO","JARDIN","JERICO","LA CEJA","LA ESTRELLA","LA PINTADA","LA UNION","LIBORINA","MACEO","MARINILLA","MEDELLIN","MONTEBELLO","MURINDO","MUTATA","NARIÑO","NECHI","NECOCLI","OLAYA","PEÐOL","PEQUE","PUEBLORRICO","PUERTO BERRIO","PUERTO NARE","PUERTO TRIUNFO","REMEDIOS","RETIRO","RIONEGRO","SABANALARGA","SABANETA","SALGAR","SAN ANDRES DE CUERQUIA","SAN CARLOS","SAN FRANCISCO","SAN JERONIMO","SAN JOSE DE LA MONTAÑA","SAN JUAN DE URABA","SAN LUIS","SAN PEDRO","SAN PEDRO DE URABA","SAN RAFAEL","SAN ROQUE","SAN VICENTE","SANTA BARBARA","SANTA ROSA DE OSOS","SANTAFE DE ANTIOQUIA","SANTO DOMINGO","SEGOVIA","SONSON","SOPETRAN","TAMESIS","TARAZA","TARSO","TITIRIBI","TOLEDO","TURBO","URAMITA","URRAO","VALDIVIA","VALPARAISO","VEGACHI","VENECIA","VIGIA DEL FUERTE","YALI","YARUMAL","YOLOMBO","YONDO","ZARAGOZA");
idciudades = new Array("1","3","23","33","34","39","40","41","43","46","48","60","65","69","85","99","100","103","105","118","130","136","140","150","156","161","168","169","171","175","182","198","225","226","228","236","239","246","277","282","286","288","297","326","335","336","355","357","380","382","384","389","400","411","413","428","431","444","445","449","451","464","471","487","495","517","531","553","561","585","600","601","604","609","610","630","676","680","712","719","732","742","761","766","776","792","794","805","814","826","838","843","846","855","861","879","881","883","884","887","894","907","913","919","928","953","954","985","990","992","1016","1022","1040","1051","1054","1058","1065","1066","1070","1077","1104","1105","1107","1108","1115");
}
if(m==4)
{
ciudades = new Array("BARANOA","BARRANQUILLA","CAMPO DE LA CRUZ","CANDELARIA","GALAPA","JUAN DE ACOSTA","LURUACO","MALAMBO","MANATI","PALMAR DE VARELA","PIOJO","POLONUEVO","PONEDERA","PUERTO COLOMBIA","REPELON","SABANAGRANDE","SABANALARGA","SANTA LUCIA","SANTO TOMAS","SOLEDAD","SUAN","TUBARA","USIACURI");
idciudades = new Array("81","92","157","162","369","456","528","540","542","656","691","700","701","724","763","789","791","900","920","950","962","1033","1056");
} 
if(m==5)
{
ciudades = new Array("BOGOTA, D.C.");
idciudades = new Array("110");
} 
if(m==6)
{
ciudades = new Array("ACHI","ALTOS DEL ROSARIO","ARENAL","ARJONA","ARROYOHONDO","BARRANCO DE LOBA","CALAMAR","CANTAGALLO","CARTAGENA","CICUCO","CLEMENCIA","CORDOBA","EL CARMEN DE BOLIVAR","EL GUAMO","EL PEÑON","HATILLO DE LOBA","MAGANGUE","MAHATES","MARGARITA","MARIA LA BAJA","MOMPOS","MONTECRISTO","MORALES","NOROSI","PINILLOS","REGIDOR","RIO VIEJO","SAN CRISTOBAL","SAN ESTANISLAO","SAN FERNANDO","SAN JACINTO","SAN JACINTO DEL CAUCA","SAN JUAN NEPOMUCENO","SAN MARTIN DE LOBA","SAN PABLO","SANTA CATALINA","SANTA ROSA","SANTA ROSA DEL SUR","SIMITI","SOPLAVIENTO","TALAIGUA NUEVO","TIQUISIO","TURBACO","TURBANA","VILLANUEVA","ZAMBRANO");
idciudades = new Array("7","31","62","67","71","90","146","164","176","219","227","250","295","310","318","424","534","536","551","552","580","586","591","619","690","760","772","831","834","836","841","842","857","868","875","897","905","909","939","955","981","1015","1038","1039","1091","1112");
} 
if(m==7)
{
ciudades = new Array("ALBANIA","BELEN DE LOS ANDAQUIES","CARTAGENA DEL CHAIRA","CURILLO","EL DONCELLO","EL PAUJIL","FLORENCIA","LA MONTAÑITA","MILAN","MORELIA","PUERTO RICO","SAN JOSE DEL FRAGUA","SAN VICENTE DEL CAGUAN","SOLANO","SOLITA","VALPARAISO");
idciudades = new Array("19","97","177","274","304","314","344","481","569","593","735","849","889","949","951","1064");
} 
if(m==8)
{
ciudades = new Array("ALMAGUER","ARGELIA","BALBOA","BOLIVAR","BUENOS AIRES","CAJIBIO","CALDONO","CALOTO","CORINTO","EL TAMBO","FLORENCIA","GUACHENE","GUAPI","INZA","JAMBALO","LA SIERRA","LA VEGA","LOPEZ","MERCADERES","MIRANDA","MORALES","PADILLA","PAEZ","PATIA","PIAMONTE","PIENDAMO","POPAYAN","PUERTO TEJADA","PURACE","ROSAS","SAN SEBASTIAN","SANTA ROSA","SANTANDER DE QUILICHAO","SILVIA","SOTARA","SUAREZ","SUCRE","TIMBIO","TIMBIQUI","TORIBIO","TOTORO","VILLA RICA");
idciudades = new Array("26","63","80","115","127","144","151","155","251","328","345","395","408","439","447","492","501","520","567","572","592","644","645","671","683","686","702","741","746","786","885","904","915","936","960","964","967","1011","1012","1027","1030","1083");
} 
if(m==9)
{
ciudades = new Array("AGUACHICA","AGUSTIN CODAZZI","ASTREA","BECERRIL","BOSCONIA","CHIMICHAGUA","CHIRIGUANA","CURUMANI","EL COPEY","EL PASO","GAMARRA","GONZALEZ","LA GLORIA","LA JAGUA DE IBIRICO","LA PAZ","MANAURE","PAILITAS","PELAYA","PUEBLO BELLO","RIO DE ORO","SAN ALBERTO","SAN DIEGO","SAN MARTIN","TAMALAMEQUE","VALLEDUPAR");
idciudades = new Array("10","14","72","93","116","201","210","276","303","313","372","385","473","475","483","544","648","678","709","769","811","832","866","982","1063");
} 
if(m==10)
{
ciudades = new Array("AYAPEL","BUENAVISTA","CANALETE","CERETE","CHIMA","CHINU","CIENAGA DE ORO","COTORRA","LA APARTADA","LORICA","LOS CORDOBAS","MOMIL","MOÑITOS","MONTELIBANO","MONTERIA","PLANETA RICA","PUEBLO NUEVO","PUERTO ESCONDIDO","PUERTO LIBERTADOR","PURISIMA","SAHAGUN","SAN ANDRES SOTAVENTO","SAN ANTERO","SAN BERNARDO DEL VIENTO","SAN CARLOS","SAN PELAYO","TIERRALTA","VALENCIA");
idciudades = new Array("75","124","160","184","199","205","221","256","459","521","523","579","584","587","589","697","710","726","729","748","798","816","817","824","827","882","1009","1059");
} 
if(m==11)
{
ciudades = new Array("AGUA DE DIOS","ALBAN","ANAPOIMA","ANOLAIMA","APULO","ARBELAEZ","BELTRAN","BITUIMA","BOJACA","CABRERA","CACHIPAY","CAJICA","CAPARRAPI","CAQUEZA","CARMEN DE CARUPA","CHAGUANI","CHIA","CHIPAQUE","CHOACHI","CHOCONTA","COGUA","COTA","CUCUNUBA","EL COLEGIO","EL PEÑON","EL ROSAL","FACATATIVA","FOMEQUE","FOSCA","FUNZA","FUQUENE","FUSAGASUGA","GACHALA","GACHANCIPA","GACHETA","GAMA","GIRARDOT","GRANADA","GUACHETA","GUADUAS","GUASCA","GUATAQUI","GUATAVITA","GUAYABAL DE SIQUIMA","GUAYABETAL","GUTIERREZ","JERUSALEN","JUNIN","LA CALERA","LA MESA","LA PALMA","LA PEÑA","LA VEGA","LENGUAZAQUE","MACHETA","MADRID","MANTA","MEDINA","MOSQUERA","NARIÑO","NEMOCON","NILO","NIMAIMA","NOCAIMA","PACHO","PAIME","PANDI","PARATEBUENO","PASCA","PUERTO SALGAR","PULI","QUEBRADANEGRA","QUETAME","QUIPILE","RICAURTE","SAN ANTONIO DEL TEQUENDAMA","SAN BERNARDO","SAN CAYETANO","SAN FRANCISCO","SAN JUAN DE RIO SECO","SASAIMA","SESQUILE","SIBATE","SILVANIA","SIMIJACA","SOACHA","SOPO","SUBACHOQUE","SUESCA","SUPATA","SUSA","SUTATAUSA","TABIO","TAUSA","TENA","TENJO","TIBACUY","TIBIRITA","TOCAIMA","TOCANCIPA","TOPAIPI","UBALA","UBAQUE","UNE","UTICA","VENECIA","VERGARA","VIANI","VILLA DE SAN DIEGO DE UBATE","VILLAGOMEZ","VILLAPINZON","VILLETA","VIOTA","YACOPI","ZIPACON","ZIPAQUIRA");
idciudades = new Array("9","16","36","42","50","57","101","107","111","133","137","145","165","167","173","190","196","206","217","218","230","255","265","302","316","324","338","350","353","361","362","363","364","365","367","371","381","388","396","402","412","414","415","419","420","422","453","457","462","480","482","486","500","513","532","533","547","562","596","605","613","614","615","617","641","649","664","668","669","738","744","749","750","755","767","819","822","829","839","854","925","929","932","935","938","943","956","966","970","971","974","977","979","995","997","999","1004","1007","1018","1019","1026","1044","1045","1048","1057","1069","1072","1075","1081","1085","1092","1096","1097","1101","1118","1119");
} 
if(m==12)
{
ciudades = new Array("ACANDI","ALTO BAUDO","ATRATO","BAGADO","BAHIA SOLANO","BAJO BAUDO","BOJAYA","CARMEN DEL DARIEN","CERTEGUI","CONDOTO","EL CANTON DEL SAN PABLO","EL CARMEN DE ATRATO","EL LITORAL DEL SAN JUAN","ISTMINA","JURADO","LLORO","MEDIO ATRATO","MEDIO BAUDO","MEDIO SAN JUAN","NOVITA","NUQUI","QUIBDO","RIO IRO","RIO QUITO","RIOSUCIO","SAN JOSE DEL PALMAR","SIPI","TADO","UNGUIA","UNION PANAMERICANA");
idciudades = new Array("5","30","74","76","77","78","112","174","188","240","292","294","311","443","458","519","563","564","565","620","624","751","770","771","778","851","941","980","1049","1050");
} 
if(m==13)
{
ciudades = new Array("ACEVEDO","AGRADO","AIPE","ALGECIRAS","ALTAMIRA","BARAYA","CAMPOALEGRE","COLOMBIA","ELIAS","GARZON","GIGANTE","GUADALUPE","HOBO","IQUIRA","ISNOS","LA ARGENTINA","LA PLATA","NATAGA","NEIVA","OPORAPA","PAICOL","PALERMO","PALESTINA","PITAL","PITALITO","RIVERA","SALADOBLANCO","SAN AGUSTIN","SANTA MARIA","SUAZA","TARQUI","TELLO","TERUEL","TESALIA","TIMANA","VILLAVIEJA","YAGUARA");
idciudades = new Array("6","8","15","25","29","82","158","231","332","376","378","401","432","441","442","460","488","607","612","633","647","652","654","693","694","781","799","810","902","965","991","996","1002","1003","1010","1095","1103");
}  
if(m==14)
{
ciudades = new Array("ALBANIA","BARRANCAS","DIBULLA","DISTRACCION","EL MOLINO","FONSECA","HATONUEVO","LA JAGUA DEL PILAR","MAICAO","MANAURE","RIOHACHA","SAN JUAN DEL CESAR","URIBIA","URUMITA","VILLANUEVA");
idciudades = new Array("20","89","279","280","312","351","427","476","537","543","775","856","1053","1055","1089");
}  
if(m==15)
{
ciudades = new Array("ALGARROBO","ARACATACA","ARIGUANI","CERRO SAN ANTONIO","CHIBOLO","CIENAGA","CONCORDIA","EL BANCO","EL PIÑON","EL RETEN","FUNDACION","GUAMAL","NUEVA GRANADA","PEDRAZA","PIJIÑO DEL CARMEN","PIVIJAY","PLATO","PUEBLOVIEJO","REMOLINO","SABANAS DE SAN ANGEL","SALAMINA","SAN SEBASTIAN DE BUENAVISTA","SAN ZENON","SANTA ANA","SANTA BARBARA DE PINTO","SANTA MARTA","SITIONUEVO","TENERIFE","ZAPAYAN","ZONA BANANERA");
idciudades = new Array("24","52","66","187","197","220","238","289","319","321","359","405","621","677","688","695","698","713","762","793","801","886","890","892","896","903","942","998","1114","1120");
}
if(m==16)
{
ciudades = new Array("ACACIAS","BARRANCA DE UPIA","CABUYARO","CASTILLA LA NUEVA","CUBARRAL","CUMARAL","EL CALVARIO","EL CASTILLO","EL DORADO","FUENTE DE ORO","GRANADA","GUAMAL","LA MACARENA","LEJANIAS","MAPIRIPAN","MESETAS","PUERTO CONCORDIA","PUERTO GAITAN","PUERTO LLERAS","PUERTO LOPEZ","PUERTO RICO","RESTREPO","SAN CARLOS DE GUAROA","SAN JUAN DE ARAMA","SAN JUANITO","SAN MARTIN","URIBE","VILLAVICENCIO","VISTAHERMOSA");
idciudades = new Array("4","87","134","181","263","269","291","298","305","358","387","406","478","512","549","568","725","727","730","731","736","765","828","852","858","867","1052","1094","1099");
} 
if(m==17)
{
ciudades = new Array("ALBAN","ALDANA","ANCUYA","ARBOLEDA","BARBACOAS","BELEN","BUESACO","CHACHAGsI","COLON","CONSACA","CONTADERO","CORDOBA","CUASPUD","CUMBAL","CUMBITARA","EL CHARCO","EL PEÑOL","EL ROSARIO","EL TABLON DE GOMEZ","EL TAMBO","FRANCISCO PIZARRO","FUNES","GUACHUCAL","GUAITARILLA","GUALMATAN","ILES","IMUES","IPIALES","LA CRUZ","LA FLORIDA","LA LLANADA","LA TOLA","LA UNION","LEIVA","LINARES","LOS ANDES","MAGsI","MALLAMA","MOSQUERA","NARIÑO","OLAYA HERRERA","OSPINA","PASTO","POLICARPA","POTOSI","PROVIDENCIA","PUERRES","PUPIALES","RICAURTE","ROBERTO PAYAN","SAMANIEGO","SAN ANDRES DE TUMACO","SAN BERNARDO","SAN LORENZO","SAN PABLO","SAN PEDRO DE CARTAGO","SANDONA","SANTA BARBARA","SANTACRUZ","SAPUYES","TAMINANGO","TANGUA","TUQUERRES","YACUANQUER");
idciudades = new Array("17","22","37","58","83","95","128","189","233","242","243","248","261","271","272","300","315","325","327","329","354","360","397","403","404","436","437","440","467","472","477","494","496","511","518","522","535","541","597","606","631","637","670","699","704","707","715","745","768","782","808","815","823","859","874","880","891","895","912","922","986","987","1037","1102");
}
if(m==18)
{
ciudades = new Array("ABREGO","ARBOLEDAS","BOCHALEMA","BUCARASICA","CACHIRA","CACOTA","CHINACOTA","CHITAGA","CONVENCION","CUCUTA","CUCUTILLA","DURANIA","EL CARMEN","EL TARRA","EL ZULIA","GRAMALOTE","HACARI","HERRAN","LA ESPERANZA","LA PLAYA","LABATECA","LOS PATIOS","LOURDES","MUTISCUA","OCAÑA","PAMPLONA","PAMPLONITA","PUERTO SANTANDER","RAGONVALIA","SALAZAR","SAN CALIXTO","SAN CAYETANO","SANTIAGO","SARDINATA","SILOS","TEORAMA","TIBU","TOLEDO","VILLA CARO","VILLA DEL ROSARIO");
idciudades = new Array("2","59","109","121","138","139","202","213","245","266","267","285","293","330","331","386","423","429","470","489","506","525","527","602","627","661","662","740","756","802","825","830","916","924","934","1001","1008","1021","1079","1082");
}
if(m==19)
{
ciudades = new Array("ARMENIA","BUENAVISTA","CALARCA","CIRCASIA","CORDOBA","FILANDIA","GENOVA","LA TEBAIDA","MONTENEGRO","PIJAO","QUIMBAYA","SALENTO");
idciudades = new Array("68","123","148","224","249","341","377","493","588","687","752","804");
}
if(m==20)
{
ciudades = new Array("APIA","BALBOA","BELEN DE UMBRIA","DOSQUEBRADAS","GUATICA","LA CELIA","LA VIRGINIA","MARSELLA","MISTRATO","PEREIRA","PUEBLO RICO","QUINCHIA","SANTA ROSA DE CABAL","SANTUARIO");
idciudades = new Array("49","79","98","283","417","465","505","558","574","681","711","753","906","921");
}
if(m==21)
{
ciudades = new Array("AGUADA","ALBANIA","ARATOCA","BARBOSA","BARICHARA","BARRANCABERMEJA","BETULIA","BOLIVAR","BUCARAMANGA","CABRERA","CALIFORNIA","CAPITANEJO","CARCASI","CEPITA","CERRITO","CHARALA","CHARTA","CHIMA","CHIPATA","CIMITARRA","CONCEPCION","CONFINES","CONTRATACION","COROMORO","CURITI","EL CARMEN DE CHUCURI","EL GUACAMAYO","EL PEÑON","EL PLAYON","ENCINO","ENCISO","FLORIAN","FLORIDABLANCA","GALAN","GAMBITA","GIRON","GsEPSA","GUACA","GUADALUPE","GUAPOTA","GUAVATA","HATO","JESUS MARIA","JORDAN","LA BELLEZA","LA PAZ","LANDAZURI","LEBRIJA","LOS SANTOS","MACARAVITA","MALAGA","MATANZA","MOGOTES","MOLAGAVITA","OCAMONTE","OIBA","ONZAGA","PALMAR","PALMAS DEL SOCORRO","PARAMO","PIEDECUESTA","PINCHOTE","PUENTE NACIONAL","PUERTO PARRA","PUERTO WILCHES","RIONEGRO","SABANA DE TORRES","SAN ANDRES","SAN BENITO","SAN GIL","SAN JOAQUIN","SAN JOSE DE MIRANDA","SAN MIGUEL","SAN VICENTE DE CHUCURI","SANTA BARBARA","SANTA HELENA DEL OPON","SIMACOTA","SOCORRO","SUAITA","SUCRE","SURATA","TONA","VALLE DE SAN JOSE","VELEZ","VETAS","VILLANUEVA","ZAPATOCA");
idciudades = new Array("11","18","54","84","86","88","106","113","120","132","153","166","170","183","186","194","195","200","207","223","237","241","244","252","275","296","309","317","320","333","334","347","349","368","373","383","390","392","399","409","418","425","454","455","461","484","508","509","526","530","539","560","577","578","626","628","632","655","657","667","684","689","714","734","743","777","788","812","820","840","844","847","871","888","893","898","937","946","961","968","973","1024","1060","1067","1074","1088","1113");
}
if(m==22)
{
ciudades = new Array("BUENAVISTA","CAIMITO","CHALAN","COLOSO","COROZAL","COVEÑAS","EL ROBLE","GALERAS","GUARANDA","LA UNION","LOS PALMITOS","MAJAGUAL","MORROA","OVEJAS","PALMITO","SAMPUES","SAN BENITO ABAD","SAN JUAN DE BETULIA","SAN LUIS DE SINCE","SAN MARCOS","SAN ONOFRE","SAN PEDRO","SANTIAGO DE TOLU","SINCELEJO","SUCRE","TOLU VIEJO");
idciudades = new Array("126","142","191","234","253","258","323","370","410","498","524","538","595","639","659","809","821","853","864","865","873","878","918","940","969","1023");
} 
if(m==23)
{
ciudades = new Array("ALPUJARRA","ALVARADO","AMBALEMA","ANZOATEGUI","ARMERO","ATACO","CAJAMARCA","CARMEN DE APICALA","CASABIANCA","CHAPARRAL","COELLO","COYAIMA","CUNDAY","DOLORES","ESPINAL","FALAN","FLANDES","FRESNO","GUAMO","HERVEO","HONDA","IBAGUE","ICONONZO","LERIDA","LIBANO","MARIQUITA","MELGAR","MURILLO","NATAGAIMA","ORTEGA","PALOCABILDO","PIEDRAS","PLANADAS","PRADO","PURIFICACION","RIOBLANCO","RONCESVALLES","ROVIRA","SALDAÑA","SAN ANTONIO","SAN LUIS","SANTA ISABEL","SUAREZ","VALLE DE SAN JUAN","VENADILLO","VILLAHERMOSA","VILLARRICA");
idciudades = new Array("28","32","35","47","70","73","143","172","180","193","229","259","273","281","337","339","343","356","407","430","433","434","435","514","516","555","566","599","608","636","660","685","696","706","747","773","784","787","803","818","860","899","963","1061","1068","1086","1093");
}
if(m==24)
{
ciudades = new Array("ALCALA","ANDALUCIA","ANSERMANUEVO","ARGELIA","BOLIVAR","BUENAVENTURA","BUGALAGRANDE","CAICEDONIA","CALI","CALIMA","CANDELARIA","CARTAGO","DAGUA","EL AGUILA","EL CAIRO","EL CERRITO","EL DOVIO","FLORIDA","GINEBRA","GUACARI","GUADALAJARA DE BUGA","JAMUNDI","LA CUMBRE","LA UNION","LA VICTORIA","OBANDO","PALMIRA","PRADERA","RESTREPO","RIOFRIO","ROLDANILLO","SAN PEDRO","SEVILLA","TORO","TRUJILLO","TULUA","ULLOA","VERSALLES","VIJES","YOTOCO","YUMBO","ZARZAL");
idciudades = new Array("21","38","45","64","114","122","129","141","152","154","163","178","278","287","290","299","306","348","379","394","398","448","468","497","504","625","658","705","764","774","783","877","930","1028","1032","1034","1046","1073","1078","1110","1111","1116");
}
if(m==25)
{
ciudades = new Array("ARAUCA","ARAUQUITA","CRAVO NORTE","FORTUL","PUERTO RONDON","SARAVENA","TAME");
idciudades = new Array("55","56","260","352","737","923","984");
}
if(m==26)
{
ciudades = new Array("AGUAZUL","CHAMEZA","HATO COROZAL","LA SALINA","MANI","MONTERREY","NUNCHIA","OROCUE","PAZ DE ARIPORO","PORE","RECETOR","SABANALARGA","SACAMA","SAN LUIS DE PALENQUE","TAMARA","TAURAMENA","TRINIDAD","VILLANUEVA","YOPAL");
idciudades = new Array("13","192","426","491","545","590","623","635","674","703","759","790","796","863","983","994","1031","1090","1109");
}
if(m==27)
{
ciudades = new Array("COLON","LEGUIZAMO","MOCOA","ORITO","PUERTO ASIS","PUERTO CAICEDO","PUERTO GUZMAN","SAN FRANCISCO","SAN MIGUEL","SANTIAGO","SIBUNDOY","VALLE DEL GUAMUEZ","VILLAGARZON");
idciudades = new Array("232","510","576","634","718","721","728","837","870","917","933","1062","1084");
}
if(m==28)
{
ciudades = new Array("PROVIDENCIA","SAN ANDRES");
idciudades = new Array("708","813");
}
if(m==29)
{
ciudades = new Array("EL ENCANTO","LA CHORRERA","LA PEDRERA","LA VICTORIA","LETICIA","MIRITI - PARANA","PUERTO ALEGRIA","PUERTO ARICA","PUERTO NARIÑO","PUERTO SANTANDER","TARAPACA");
idciudades = new Array("307","466","485","503","515","573","716","717","733","739","989");
}
if(m==30)
{
ciudades = new Array("BARRANCO MINAS","CACAHUAL","INIRIDA","LA GUADALUPE","MAPIRIPANA","MORICHAL","PANA PANA","PUERTO COLOMBIA","SAN FELIPE");
idciudades = new Array("91","135","438","474","550","594","663","723","835");
}
if(m==31)
{
ciudades = new Array("CALAMAR","EL RETORNO","MIRAFLORES","SAN JOSE DEL GUAVIARE");
idciudades = new Array("147","322","570","850");
}
if(m==32)
{
ciudades = new Array("CARURU","MITU","PACOA","PAPUNAUA","TARAIRA","YAVARATE");
idciudades = new Array("179","575","642","666","988","1106");
}

if(m==33)
{
ciudades = new Array("CUMARIBO","LA PRIMAVERA","PUERTO CARREÑO","SANTA ROSALIA");
idciudades = new Array("270","490","722","910");
}

   kk= ciudades.length;
   
   document.getElementById(ciudad_id).innerHTML = "";
  
   for(var i=0;i<kk;i++){ 
        ciudad.options[i] = new Option(ciudades[i]);
		ciudad.options[i].value = idciudades[i]  ;
		}
  contenedor.appendChild(ele);
 
}



</script>


</head>

<body>
<!---->
<?php require 'header.php'; ?>
<!---->
<?php require 'secc_correspondencia.php'; ?>
<!---->
<table border="0" cellspacing="0" cellpadding="0" align="center">
  <tr>
    <td><img src="views/images/crm_fondo_top.png" width="954" height="40" /></td>
  </tr>
  <tr>
    <td style="background:url(views/images/crm_fondo_body.png) repeat-y;"><div id="contenido">
      <form id="frm" name="frm" method="post" enctype="multipart/form-data" action="">
        <div id="titulo_frm">Registrar Incidente</div>
        <table border="0" cellspacing="0" cellpadding="0" id="frm_editar" class="tablesorter">
          <tr>
            <td width="173">Radicado:</td>
            <td width="499"><label>
              <input type="text" name="radicado" id="txt_input" value="<?php echo $_GET['nombre'];?>" readonly="readonly" />
            </label></td>
          </tr>
          <tr>
            <td>Fecha: <?php 
			date_default_timezone_set('America/Bogota'); 

      $fecha=date('Y-m-d');?></td>
            <td><input type="text" name="fecha" id="txt_input" class="required" value="<?php echo $fecha;?>" readonly="readonly"/></td>
          </tr>
          <tr>
            <td>Juzgado:</td>
            <?php  while($field = $datos_juzgado->fetch()){
 ?>
            <td> <input type="text" name="txt_input" id="txt_input" value="<?php echo $field[nombre];?>" readonly="readonly" />
            <input name="juzgado" type="hidden" value="<?php echo $field[id];?>" />
            
             <?php }?></td>
          </tr>
          
              <?php $k=0;
 while($fielda = $datos_actuacion->fetch()){
 
 $actuacion[$k][nombre]= $fielda[nombre];
 $actuacion[$k][id]= $fielda[id];
 $k = $k+1;
 }
 $cont = count($actuacion);
 
 $dep=0;
while($fieldd = $datos_departamentos->fetch()){
 
 $departamento[$dep][nombre]= $fieldd[nombre];
 $departamento[$dep][id]= $fieldd[id];
 $dep = $dep+1;
 }
 $contdep = count($departamento);
 $med=0;
while($fieldm = $datos_medio->fetch()){
 
 $medio[$med][nombre]= $fieldm[nombre];
 $medio[$med][id]= $fieldm[id];
 $med = $med+1;
 }
 $contmed = count($medio);
 
 
//print_r($medio); 
 ?>
          
       <?php
	   $j=1;
	   $cont_partes=0;
 while($field = $datos_nombres->fetch()){
 $v=0;
 $d=0;
 $m=0;

  
 ?>      
          <tr>
            <td>Seleccionar Parte Incidente:</td>
            <td>
              <input type="checkbox" name="<?php echo "selecciona_parte".$j?>" id="<?php echo "selecciona_parte".$j?>" value="Si" onclick="habilitar(frm,<?php echo $j;?>)" />
         
              <input name="<?php echo "nombre_parte".$j?>" type="text" id="txt_input81" value="<?php echo $field[nombre];?>" readonly="readonly" />
              
             <label>&nbsp; Tipo Parte:&nbsp;  </label>   <input name="<?php echo "tipo_parte".$j?>" type="text" id="txt_input81" value="<?php echo $field[tipoacc];?>" readonly="readonly" />       </td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td><label>
              <input name="<?php echo "oficio_telegrama_f".$j?>" type="radio" id="<?php echo "oficio_telegrama_f".$j?>" value="Oficio" checked="checked" disabled="disabled" />
            Oficio 
            &nbsp;<input type="radio" name="<?php echo "oficio_telegrama_f".$j?>" id="<?php echo "oficio_telegrama_fb".$j?>" value="Telegrama" disabled="disabled" />
Telegrama </label></td>
          </tr>
          <tr>
            <td>N&uacute;mero Oficio/Telegrama</td>
            <td><input type="text" name="<?php echo "numero_oficio_telegrama_f".$j?>" id="<?php echo "numero_oficio_telegrama_f".$j?>" class="required" disabled="disabled" /></td>
          </tr>
          <tr>
            <td>Actuaci&oacute;n</td>
            <td><select name="<?php echo "actuacion_f".$j?>" class="required" id="<?php echo "actuacion_f".$j?>" disabled="disabled">
              <option value="" selected="selected">Seleccione una actuaci&oacute;n</option>
              <?php
 while($v<$cont){
 
  
 ?>
              <option value="<?php echo $actuacion[$v][id];?>" ><?php echo $actuacion[$v][nombre] ?></option>
              <?php
			  
			  $v = $v+1;
			   }?>
            </select></td>
          </tr>
          <tr>
            <td>Direcci&oacute;n:</td>
            <td><label>
              <input type="text" name="<?php echo "direccion_f".$j?>" id="<?php echo "direccion_f".$j?>" disabled="disabled" class="required" />
            </label></td>
          </tr>
          <tr>
            <td>Departamento:</td>
            <td><select name="<?php echo "departamento_f".$j?>" class="required" id="<?php echo "departamento_f".$j?>" disabled="disabled" onchange="opcionesciudad(<?php echo $j;?>)">
              <option value="" selected="selected">Seleccione un departamento</option>
              <?php
 while($d<$contdep){
 
  
 ?>
              <option value="<?php echo $departamento[$d][id];?>" ><?php echo $departamento[$d][nombre] ?></option>
              <?php
			  
			  $d = $d+1;
			   }?>
            </select></td>
          </tr>
          <tr>
            <td>Ciudad:</td>
            <td><label>
              <select name="<?php echo "ciudad_f".$j?>" id="<?php echo "ciudad_f".$j?>" disabled="disabled" class="required">
                <option value="" selected="selected">Seleccione una ciudad</option> 
              </select>
            </label></td>
          </tr>
          <tr>
            <td>Medio Notificaci&oacute;n:</td>
            <td><select name="<?php echo "medio_f".$j?>" class="required" id="<?php echo "medio_f".$j?>" disabled="disabled">
              <option value="" selected="selected">Seleccione una medio de notificaci&oacute;n</option>
              <?php
 while($m<$contmed){
 
  
 ?>
              <option value="<?php echo $medio[$m][id];?>" ><?php echo $medio[$m][nombre] ?></option>
              <?php
			  
			  $m = $m+1;
			   }?>
            </select></td>
          </tr>
          <tr>
            <td>Se hizo notificaci&oacute;n?</td>
            <td>Si 
           
              <input name="<?php echo "notificado_f".$j?>" type="radio" id="<?php echo "notificado_f".$j?>" value="Si" checked="checked" disabled="disabled" />
              &nbsp;No
              <input type="radio" name="<?php echo "notificado_f".$j?>" id="<?php echo "notificado_fb".$j?>" value="No" disabled="disabled" />
             </td>
          </tr>
          <tr>
            <td>Fecha Envio:</td>
            <td><input name="<?php echo "fecha_f".$j?>" type="text" class="required tinicio" id="<?php echo "fecha_f".$j?>" readonly="readonly" disabled="disabled"/>
	<script type="text/javascript" charset="utf-8">
			jQuery(document).ready(function()
			{
			  jQuery(".tinicio").datepicker({ changeFirstDay: false	});
			});
	</script>	</td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td></td>
          </tr>
           <?php $j =$j+1; $cont_partes = $cont_partes+1;}?>
          <tr>
            <td>&nbsp;</td>
            <td><fieldset id="fiel2">
            <input type="button" name="btn_input" id="btn_input_accion" value="Adicionar: Accionante, Accionado ó Vinculado"  onclick="crearForm(this,frm)" />
            </fieldset></td>
          </tr>
         
          <tr>
            <td>&nbsp;</td>
            <td><label>
              <input type="hidden" name="contador_partes" id="temp" value="<?php echo $cont_partes;?>" />
              <input type="hidden" name="cantidad_detalles" id="temp2" value="0" />
            </label></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td><input type="submit" name="Submit" value="Registrar" id="btn_input">
                  <input type="reset" name="Submit2" value="Restablecer" id="btn_input" class="btn_limpiar"/></td>
          </tr>
        </table>
      </form>
    </div></td>
  </tr>
  <tr>
    <td><img src="views/images/crm_fondo_foot.png" width="954" height="40" /></td>
  </tr>
</table>
<iframe src="about:blank" name="main" id="main" width="0" height="0" frameborder="0"></iframe>
</body>
</html>
