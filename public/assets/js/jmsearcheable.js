!function(t){t.fn.jmSearcheable=function(e){var n=t(this);settings=t.extend({url:"#",urlWithID:!1,idSeparator:"?",idField:"id",delay:50,format:"",containerWrapper:"#searchResultContainer",fadeIn:"fast",fadeOut:"fast",keyEvent:"keyup",fields:[""],fieldTag:"div"},e),t(settings.containerWrapper).hide(),beginSearch=function(){t.ajax({url:settings.url,type:"GET",data:{src:n.val(),output:"json"},beforeSend:function(){toggleContainer(),t(settings.containerWrapper).html("Searching..")},success:function(t){setTimeout(function(){displayContent(t)},settings.delay)}})},toggleContainer=function(){return n.val().length>0?t(settings.containerWrapper).fadeIn(settings.fadeIn):t(settings.containerWrapper).fadeOut(settings.fadeOut),!0},displayContent=function(e){var n="";"object"==typeof e?(t.each(e,function(t,e){"object"==typeof e?settings.format.length>0&&(n+=doFormat(e)):(console.log("Not an object"),console.log(e),n+=e)}),t(settings.containerWrapper).html(n)):t(settings.containerWrapper).html(e)},doFormat=function(t){for(var e="",n="<"+settings.fieldTag+' class="searchItem">',i="<"+settings.fieldTag+"/>",s=settings.format,a=s.split(":").length-1,r=a;r>=0;r--)s=s.replace(":"," ");var o=new RegExp(Object.keys(t).join("|"),"gi");if(s=s.replace(o,function(e){return t[e]}),settings.urlWithID===!0){var g='<a href="'+settings.url+getURI(t)+'">',l="</a>";e+=n+g+s+l+i}else e+=n+s+i;return e},getURI=function(t){var e;return void 0===t[settings.idField]&&console.log("The data doesn't exists. "),("?"==settings.idSeparator||"&"==settings.idSeparator)&&(e=settings.idSeparator+settings.idField+"="+t[settings.idField]),"/"==settings.idSeparator&&(e=settings.idSeparator+t[settings.idField]),e},n.on(settings.keyEvent,function(){beginSearch()})}}(jQuery);