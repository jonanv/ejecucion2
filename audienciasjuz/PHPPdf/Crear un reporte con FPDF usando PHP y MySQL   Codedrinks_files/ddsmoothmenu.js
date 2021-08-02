
var ddsmoothmenu={arrowimages:{down:['downarrowclass','http://localhost/wordpress/wp-content/themes/codedrink/imagenes/down.png',10],right:['rightarrowclass','http://localhost/wordpress/wp-content/themes/codedrink/imagenes/right.png']},transition:{overtime:200,outtime:200},shadow:{enable:false,offsetx:5,offsety:5},detectwebkit:navigator.userAgent.toLowerCase().indexOf("applewebkit")!=-1,detectie6:document.all&&!window.XMLHttpRequest,getajaxmenu:function($,setting){var $menucontainer=$('#'+setting.contentsource[0])
$menucontainer.html("Loading Menu...")
$.ajax({url:setting.contentsource[1],async:true,error:function(ajaxrequest){$menucontainer.html('Error fetching content. Server Response: '+ajaxrequest.responseText)},success:function(content){$menucontainer.html(content)
ddsmoothmenu.buildmenu($,setting)}})},buildmenu:function($,setting){var smoothmenu=ddsmoothmenu
var $mainmenu=$("#"+setting.mainmenuid+">ul")
$mainmenu.parent().get(0).className=setting.classname||"ddsmoothmenu"
var $headers=$mainmenu.find("ul").parent()
$headers.hover(function(e){$(this).children('a:eq(0)').addClass('selected')},function(e){$(this).children('a:eq(0)').removeClass('selected')})
$headers.each(function(i){var $curobj=$(this).css({zIndex:100-i})
var $subul=$(this).find('ul:eq(0)').css({display:'block'})
this._dimensions={w:this.offsetWidth,h:this.offsetHeight,subulw:$subul.outerWidth(),subulh:$subul.outerHeight()}
this.istopheader=$curobj.parents("ul").length==1?true:false
$subul.css({top:this.istopheader&&setting.orientation!='v'?this._dimensions.h+"px":0})
$curobj.children("a:eq(0)").css(this.istopheader?{paddingRight:smoothmenu.arrowimages.down[2]}:{}).append('<img src="'+(this.istopheader&&setting.orientation!='v'?smoothmenu.arrowimages.down[1]:smoothmenu.arrowimages.right[1])
+'" class="'+(this.istopheader&&setting.orientation!='v'?smoothmenu.arrowimages.down[0]:smoothmenu.arrowimages.right[0])
+'" style="border:0;'+(this.istopheader&&setting.orientation!='v'?'margin-left : 20px;':"float:right;")+'"  />')
if(smoothmenu.shadow.enable){this._shadowoffset={x:(this.istopheader?$subul.offset().left+smoothmenu.shadow.offsetx:this._dimensions.w),y:(this.istopheader?$subul.offset().top+smoothmenu.shadow.offsety:$curobj.position().top)}
if(this.istopheader)
$parentshadow=$(document.body)
else{var $parentLi=$curobj.parents("li:eq(0)")
$parentshadow=$parentLi.get(0).$shadow}
this.$shadow=$('<div class="ddshadow'+(this.istopheader?' toplevelshadow':'')+'"></div>').prependTo($parentshadow).css({left:this._shadowoffset.x+'px',top:this._shadowoffset.y+'px'})}
$curobj.hover(function(e){var $targetul=$(this).children("ul:eq(0)")
this._offsets={left:$(this).offset().left,top:$(this).offset().top}
var menuleft=this.istopheader&&setting.orientation!='v'?0:this._dimensions.w
menuleft=(this._offsets.left+menuleft+this._dimensions.subulw>$(window).width())?(this.istopheader&&setting.orientation!='v'?-this._dimensions.subulw+this._dimensions.w:-this._dimensions.w):menuleft
if($targetul.queue().length<=1){$targetul.css({left:menuleft+"px",width:this._dimensions.subulw+'px'}).animate({height:'show',opacity:'show'},ddsmoothmenu.transition.overtime)
if(smoothmenu.shadow.enable){var shadowleft=this.istopheader?$targetul.offset().left+ddsmoothmenu.shadow.offsetx:menuleft
var shadowtop=this.istopheader?$targetul.offset().top+smoothmenu.shadow.offsety:this._shadowoffset.y
if(!this.istopheader&&ddsmoothmenu.detectwebkit){this.$shadow.css({opacity:1})}
this.$shadow.css({overflow:'',width:this._dimensions.subulw+'px',left:shadowleft+'px',top:shadowtop+'px'}).animate({height:this._dimensions.subulh+'px'},ddsmoothmenu.transition.overtime)}}},function(e){var $targetul=$(this).children("ul:eq(0)")
$targetul.animate({height:'hide',opacity:'hide'},ddsmoothmenu.transition.outtime)
if(smoothmenu.shadow.enable){if(ddsmoothmenu.detectwebkit){this.$shadow.children('div:eq(0)').css({opacity:0})}
this.$shadow.css({overflow:'hidden'}).animate({height:0},ddsmoothmenu.transition.outtime)}})})
$mainmenu.find("ul").css({display:'none',visibility:'visible'})},init:function(setting){if(typeof setting.customtheme=="object"&&setting.customtheme.length==2){var mainmenuid='#'+setting.mainmenuid
var mainselector=(setting.orientation=="v")?mainmenuid:mainmenuid+', '+mainmenuid
document.write('<style type="text/css">\n'
+mainselector+' ul li a {background:'+setting.customtheme[0]+';}\n'
+mainmenuid+' ul li a:hover {background:'+setting.customtheme[1]+';}\n'
+'</style>')}
this.shadow.enable=(document.all&&!window.XMLHttpRequest)?false:this.shadow.enable
jQuery(document).ready(function($){if(typeof setting.contentsource=="object"){ddsmoothmenu.getajaxmenu($,setting)}
else{ddsmoothmenu.buildmenu($,setting)}})}}