function emptyOptions(){$("#_applicants_department_id, #_applicants_position_id").empty(),$("#_applicants_department_row, #_applicants_position_row").hide()}var departmentsURL=_globalObj._baseURL+"/departments/departmentsByCompany",positionsURL=_globalObj._baseURL+"/positions/positionsByDepartment";"undefined"!=typeof _applicants_oldStageProcess&&(hrApp.getSelectOptions(_globalObj._baseURL+"/stageprocesses",0,"stage_process",_applicants_oldStageProcess),hrApp.getCheckBox(_globalObj._baseURL+"/requirements",1,"_applicants_InterviewRequirementsContainer","requirement_id[]",_applicants_oldRequirements,"requirement"),hrApp.getCheckBox(_globalObj._baseURL+"/requirements",2,"_applicants_OrientationRequirementsContainer","requirement_id[]",_applicants_oldRequirements,"requirement")),$("#_applicants_department_row, #_applicants_position_row").hide(),$("#_applicants_submit").on("click",function(){var e=$(this),t=$("#_applicants_clear"),a=$("#_applicants_submitload"),i=_globalObj._baseURL+"/img/loading.gif";e.fadeOut(200),t.fadeOut(200),a.html('Sending.. &nbsp; &nbsp;<img src="'+i+'" class="loading">'),setTimeout(function(){e.fadeIn(200),t.fadeIn(200),a.html("")},5e3)}),$("#_applicants_company_id").change(function(){var e=$(this).find(":selected").val(),t=$("#_applicants_position_id"),a=$("#_applicants_employment_status"),i=$("#_applicants_department_row"),n=$("#_applicants_department_id");emptyOptions(),0==e?(console.log("Please select a company"),t.prop("disabled",!0),a.prop("disabled",!0)):(i.show(),hrApp.getSelectOptions(departmentsURL,e,"_applicants_department_id",_applicants_oldDepartment),_applicants_oldDepartment>0&&n.trigger("change"),t.prop("disabled",!1),a.prop("disabled",!1))}),$("#_applicants_department_id").change(function(){var e=$(this).find(":selected").val();$("#_applicants_position_row").show(),hrApp.getSelectOptions(positionsURL,e,"_applicants_position_id",_applicants_oldPosition)}),$("#_applicants_company_id").triggerHandler("change"),$(".date").datetimepicker({pickTime:!1}),$("._applicant_show_requirement").on("click",function(e){e.stopPropagation();var t=$(this).closest("li").data("requirement_id"),a=$(this).closest("li").data("applicant_id"),i=$(this).closest("li").data("type"),n=$(this).closest("li").data("document");$("#modal_body_content").html(i),$("#myModalLabel").html("Employee Requirement"),$("#itemtype").html(n),$("#myModal").modal("show"),$("#modal_save").on("click",function(e){e.stopPropagation();var n=$(".requirement_date").val();$.ajax({type:"POST",url:_globalObj._baseURL+"/applicants/requirements",data:{process_type:i,employee_id:a,requirement_id:t,_token:_globalObj._token,date:n},success:function(e){jsonData=JSON.parse(e),"created"==jsonData.status&&location.reload()}})})});
function ordinal_suffix_of(e){var a=e%10,o=e%100;return 1==a&&11!=o?e+"st":2==a&&12!=o?e+"nd":3==a&&13!=o?e+"rd":e+"th"}function _searchEmployee(e,a,o){console.log("searching..."),void 0==o&&(o=0),$.ajax({type:"GET",url:_globalObj._baseURL+"/employees",data:{src:e,output:"json"},beforeSend:function(){$("#employee_loader").html('<img src="'+_globalObj.loaderImage+'" class="loading" >')},success:function(e){$("#employee_loader").html(""),$(".employee_loader").html("");var o,t,n="",i="";if(console.log("Length of data found:"+e.length),e.length>1){e.length<__rowsToDisplay&&(__rowsToDisplay=e.length);for(var l=0;__rowsToDisplay>l;l++)o=hrApp.personName(e[l]),t=e[l].employee_work_id,n=0==l?"active":"",i+='<div class="resultItem '+n+'" data-index="'+l+'"  data-employee_name="'+o+'" data-employee_id="'+t+'"><a href="?reload=true&employee_id='+t+"#employee="+t+'"> <span class="id-container">'+t+"</span>  "+o+"  </div></a>";a?($(".resultContainer").remove(),a.after('<div class="resultContainer" style="width: 330px;">'+i+"</div>"),_togglePanels(__panelsToToggle,"hide")):(resultContainer.html(i),resultContainer.show(),_togglePanels(__panelsToToggle,"hide"))}else 1==e.length?(realID=e[0].id,t=e[0].employee_work_id,o=hrApp.personName(e[0]),date_hired=e[0].date_hired,position=e.hasOwnProperty("position")?e[0].position.name:"Unassigned",a||(window.location="#employee="+t,$("#employee_name").html(o),$("#date_hired").html(date_hired),$("#position").html(position),$(".sss_id").html(e[0].sss_id),hiddenID.val(realID),$("#work_id").val(t),console.log(realID),_togglePanels(__panelsToToggle,"show"))):(a?$(".resultContainer").html('<span class="text-center">No data found</span>'):resultContainer.hide(),_togglePanels(__panelsToToggle,"hide"),$("#employee_loader").html('<span class="label label-danger">No data found</span>'))}})}function _togglePanels(e,a){$.each(e,function(e,o){"hide"==a?(console.log(o),$(o).hide()):$(o).show()})}function _emptyFields(){}$(".resultContainer").hide(),hrApp.hasHash()&&(__employee=hrApp.getHash("employee"),$("#employee_work_id").val(hrApp.getHash("employee")),_searchEmployee(__employee)),_togglePanels(__panelsToToggle,"hide"),$("#employee_work_id").keyup(function(e){e.preventDefault();var a=$(this).val();13==e.which&&(_searchEmployee(a),console.log("hello"))}),$(document).on("click",".resultItem a",function(e){if(redirect===!1){var a=$(this).parent().data("employee_id"),o=$(this).parent().data("employee_name"),t=$(this).parent().parent().siblings("input.searcheable");$(".resultName").remove(),t.val(a),t.next().remove(),t.parent().find(".input-group-addon").remove(),t.after('<span class="input-group-addon"><span class="label label-info">'+o+"</span></span>"),$(".resultContainer").remove(),e.preventDefault()}}),$(document).on("keyup",".searcheable",function(e){if($(this).val().length>1)if(40==e.which){{var a=$(".resultContainer .resultItem");$(".resultContainer .resultItem .active")}if(a.hasClass("active")){var o=$(".resultItem.active").data("index");a.eq(o).removeClass("active"),a.eq(o+1).addClass("active"),console.log(o)}}else if(38==e.which){{var a=$(".resultContainer .resultItem");$(".resultContainer .resultItem .active")}if(a.hasClass("active")){var o=$(".resultItem.active").data("index");a.eq(o).removeClass("active"),a.eq(o-1).addClass("active"),console.log(o)}}else{if(13==e.which){var a=$(".resultContainer .resultItem");return a.each(function(){if($(this).hasClass("active")){var e=$(this).data("employee_id"),e=$(this).data("employee_id"),a=$(this).data("employee_name"),o=$(this).parent().siblings("input.searcheable");$(".resultName").remove(),o.val(e),o.next().remove(),o.parent().find(".input-group-addon").remove(),o.after('<span class="input-group-addon"><span class="label label-info">'+a+"</span></span>"),$(".resultContainer").remove()}}),e.preventDefault(),!1}_searchEmployee($(this).val(),$(this))}else $(".resultContainer").remove();console.log(e.which)}),function(){$("#violation_date").on("dp.change",function(e){$("#violation_effectivity_date").data("DateTimePicker").setMinDate(e.date)}),$("#violation_effectivity_date").on("dp.change",function(e){$("#violation_date").data("DateTimePicker").setMaxDate(e.date)});var e=function(e,o,t){e===!0&&(console.log(o===!0),t===!0?a(!0):a(!1),o===!0?$("#violation_effectivity_date").prop("disabled",!0):$("#violation_effectivity_date").prop("disabled",!1))},a=function(e){e===!0?($("#violation_effectivity_date").prop("disabled",!0),$("#violation_date").prop("disabled",!0),$("#buttons").hide()):($("#violation_effectivity_date").prop("disabled",!1),$("#violation_date").prop("disabled",!1),$("#buttons").show())};$("#violation_decription_container").hide(),$("#violation_id").on("change",function(){var a=$(this).val(),o=$(".hiddenID").val();return console.log(a),0==a||-1==a?!1:($.ajax({type:"GET",url:_globalObj._baseURL+"/violations",data:{src:a,output:"json",field:"id",employee_id:o},success:function(a){console.log(a);var o=!1;if(a){var t=$(".violation_decription").html(a.description).text();$(".violation_decription").html("<br><br>"+t);var n="<ul>";n+="<br>";for(var i=0;i<a.offenses.length;i++)n+="<li>",a.times_committed-1==i&&(n+='<span class="label label-danger">'),a.offenses[i].days_of_suspension?(n+=ordinal_suffix_of(a.offenses[i].offense_number)+" offense ("+a.offenses[i].punishment_type+" for "+a.offenses[i].days_of_suspension+" days)",o=!0):(n+=ordinal_suffix_of(a.offenses[i].offense_number)+" offense ("+a.offenses[i].punishment_type+")",o=!1),a.times_committed-1==i&&(n+="</span>"),n+="</li>";if(n+="</ul>",void 0===typeof l)var l=!0;if(l===!0)e(!0,a.is_next_a_warning,a.is_last);else{var s=$(".old_violation_id").val(),r=$("#violation_id").val();s==r?e(!0,a.is_current_a_warning,!1):e(!0,a.is_current_a_warning,a.is_last)}console.log(a),$(".penalty").html(n),$("#violation_decription_container").show()}else $(".violation_decription").hide(),$("#violation_decription_container").hide()}}),void 0)})}(),function(){0!=$("#violation_id").val()&&setTimeout(function(){$("#violation_id").trigger("change")},1500),$("#duration_in_months, #loan_amount").on("keyup",function(){var e=parseInt($("#duration_in_months").val()),a=parseFloat($("#loan_amount").val()),o=Math.round(a/e*1.1*100)/100;isNaN(o)&&(o=0),$("#monthly_amortization").val(o)})}();
var __accumulatedURIPermission={},__deletedURI=[];if($(".form-field-error").hide(),oldURIdata.length>0){var parsedJSON=JSON.parse(oldURIdata);__accumulatedURIPermission=parsedJSON,$.each(parsedJSON,function(s,a){$.isArray(a)===!1&&(a=a.split("|")),text='<span data-uri="'+s+'"> <strong>'+s+"</strong></span>  -  "+a.join(",");var e='<div class="alert alert-success alert-dismissable"><button type="button" class="close remove-uri" data-dismiss="alert" aria-hidden="true">&times;</button>'+text+"</div>";$(".addedURIContainer").append('<div class="col-sm-7">'+e+"</div>")})}$("._checkboxButton").on("click",function(){{var s=$(this).html();$(this).find(".chkbox").val()}$(this).find("span").length>=1?$(this).children("span").remove():$(this).html(s+'  <span class="glyphicon glyphicon-ok"></span>')}),$(document).on("click",".remove-uri",function(){var s=$(this).parent().find("span").data("uri");delete __accumulatedURIPermission[s],__deletedURI.push(s),$("#__deletedURI").val(JSON.stringify(__deletedURI)),$("#formHiddenData").val(JSON.stringify(__accumulatedURIPermission))}),$("#_roles_add_uri").on("click",function(){var s=[],a=$("#uri").val();if($(".chkbox:checked").each(function(){s.push($(this).data("value"))}),__accumulatedURIPermission.hasOwnProperty(a)||""==a){var e=""==a?"Please fill a valid URI":"URI already exists.";return $("#uri").closest('div[class^="form-group"]').addClass("has-warning").focus(),$("#uri").closest('div[class^="form-group"]').find(".form-field-error").html(e).fadeIn(250),!1}if(0==s.length)return $("#uri").closest('div[class^="form-group"]').addClass("has-warning").focus(),$("#__act_permission").closest('div[class^="form-group"]').find(".form-field-error").html("No permissions specified.").fadeIn(250),!1;$("#uri").closest('div[class^="form-group"]').removeClass("has-warning"),$(".form-field-error").fadeOut(250),__accumulatedURIPermission[a]=s,text='<span data-uri="'+a+'"> <strong>'+a+"</strong></span>  -  "+s.join(",");var i='<div class="alert alert-success alert-dismissable"><button type="button" class="close remove-uri" data-dismiss="alert" aria-hidden="true">&times;</button>'+text+"</div>";$(".addedURIContainer").append('<div class="col-sm-7">'+i+"</div>"),$("#formHiddenData").val(JSON.stringify(__accumulatedURIPermission))});
!function(e){"use strict";e.fn.jmFileUpload=function(o){function r(e){var r=!1;return n(e,o.allowedTypes)===!0&&(r=!0),r}function t(n){e(o.progressbarContainer).show(),e(o.infoContainer).append("<div> <strong>[3]</strong> Uploading file... </div>");var r=new XMLHttpRequest;r.open(o.type,o.url),r.onload=function(){200===r.status?console.log("all done: "+r.status):console.log("Something went terribly wrong...")},r.upload.onprogress=function(n){if(n.lengthComputable){var r=n.loaded/n.total*100|0;e(o.progressbar).css("width",r+"%").html(r+"%"),100==r&&setTimeout(function(){e(o.progressbarContainer).hide()},2e3)}},r.onload=function(){var n=r.response;n||e(o.errorContainer).html("Failed to process uploaded file."),e(o.infoContainer).append("<div> <strong>[4]</strong> Fetched uploaded file data. </div>"),n=JSON.parse(n),e(o.responseContainer).val(n.file_path).change(),e(o.imageContainer).attr("src",n.file_loc)},r.send(n)}var a={allowedTypes:["image/jpeg","image/png"],progressbarContainer:".progress",progressbar:".progress-bar",xhrReponseContainer:".result",type:"POST",url:"?a=upload",customData:{},infoContainer:".upload-info",errorContainer:".upload-error",responseContainer:".upload-done",imageContainer:".image"};return o=e.extend({},a,o),e(o.progressbarContainer).hide(),this.on("change",function(n){var a=n.target.files[0].type,i=e(this).prop("files")[0],s=new FormData;return e(o.infoContainer).html("<div><strong>[1]</strong> Validating file...</div>"),r(a)===!1?(console.log(a),e(o.errorContainer).html("File does not pass from the required file types."),e(o.infoContainer).append('<br><span class="glyphicon glyphicon-remove"></span> File does not pass from the required file types.'),!1):(e(o.progressbar).css("width","0%").html("0%"),e(o.infoContainer).append("<strong>[2]</strong> Assigning variables..."),s.append("file",i),e.each(o.customData,function(e,n){s.append(e,n)}),t(s),void 0)}),this};var n=function(e,n){for(var o=!1,r=n.length-1;r>=0;r--)n[r]==e&&(o=!0);return o}}(jQuery,document,window);
!function(t){t.fn.jmSearcheable=function(e){var n=t(this);settings=t.extend({url:"#",urlWithID:!1,idSeparator:"?",idField:"id",delay:50,format:"",containerWrapper:"#searchResultContainer",fadeIn:"fast",fadeOut:"fast",keyEvent:"keyup",fields:[""],fieldTag:"div"},e),t(settings.containerWrapper).hide(),beginSearch=function(){t.ajax({url:settings.url,type:"GET",data:{src:n.val(),output:"json"},beforeSend:function(){toggleContainer(),t(settings.containerWrapper).html("Searching..")},success:function(t){setTimeout(function(){displayContent(t)},settings.delay)}})},toggleContainer=function(){return n.val().length>0?t(settings.containerWrapper).fadeIn(settings.fadeIn):t(settings.containerWrapper).fadeOut(settings.fadeOut),!0},displayContent=function(e){var n="";"object"==typeof e?(t.each(e,function(t,e){"object"==typeof e?settings.format.length>0&&(n+=doFormat(e)):(console.log("Not an object"),console.log(e),n+=e)}),t(settings.containerWrapper).html(n)):t(settings.containerWrapper).html(e)},doFormat=function(t){for(var e="",n="<"+settings.fieldTag+' class="searchItem">',i="<"+settings.fieldTag+"/>",s=settings.format,a=s.split(":").length-1,r=a;r>=0;r--)s=s.replace(":"," ");var o=new RegExp(Object.keys(t).join("|"),"gi");if(s=s.replace(o,function(e){return t[e]}),settings.urlWithID===!0){var g='<a href="'+settings.url+getURI(t)+'">',l="</a>";e+=n+g+s+l+i}else e+=n+s+i;return e},getURI=function(t){var e;return void 0===t[settings.idField]&&console.log("The data doesn't exists. "),("?"==settings.idSeparator||"&"==settings.idSeparator)&&(e=settings.idSeparator+settings.idField+"="+t[settings.idField]),"/"==settings.idSeparator&&(e=settings.idSeparator+t[settings.idField]),e},n.on(settings.keyEvent,function(){beginSearch()})}}(jQuery);
!function(n){"use strict";var o={init:function(o){var e={top:"auto",autoOpen:!1,overlayOpacity:.5,overlayColor:"#000",overlayClose:!0,overlayParent:"body",closeOnEscape:!0,closeButtonClass:".close",transitionIn:"",transitionOut:"",onOpen:!1,onClose:!1,zIndex:function(){return function(n){return n===-1/0?0:n+1}(Math.max.apply(Math,n.makeArray(n("*").map(function(){return n(this).css("z-index")}).filter(function(){return n.isNumeric(this)}).map(function(){return parseInt(this,10)}))))},updateZIndexOnOpen:!0};return o=n.extend(e,o),this.each(function(){var e=o,t=n('<div class="lean-overlay"></div>'),i=n(this);t.css({display:"none",position:"fixed","z-index":e.updateZIndexOnOpen?0:e.zIndex(),top:0,left:0,height:"100%",width:"100%",background:e.overlayColor,opacity:e.overlayOpacity,overflow:"auto"}).appendTo(e.overlayParent),i.css({display:"none",position:"fixed","z-index":e.updateZIndexOnOpen?0:e.zIndex()+1,left:"50%",top:parseInt(e.top,10)>-1?e.top+"px":"50%"}),i.bind("openModal",function(){var n=e.updateZIndexOnOpen?e.zIndex():parseInt(t.css("z-index"),10),o=n+1;""!==e.transitionIn&&""!==e.transitionOut&&i.removeClass(e.transitionOut).addClass(e.transitionIn),i.css({display:"block","margin-left":-(i.outerWidth()/2)+"px","margin-top":(parseInt(e.top,10)>-1?0:-(i.outerHeight()/2))+"px","z-index":o}),t.css({"z-index":n,display:"block"}),e.onOpen&&"function"==typeof e.onOpen&&e.onOpen(i[0])}),i.bind("closeModal",function(){""!==e.transitionIn&&""!==e.transitionOut?(i.removeClass(e.transitionIn).addClass(e.transitionOut),i.one("webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend",function(){i.css("display","none"),t.css("display","none")})):(i.css("display","none"),t.css("display","none")),e.onClose&&"function"==typeof e.onClose&&e.onClose(i[0])}),t.click(function(){e.overlayClose&&i.trigger("closeModal")}),n(document).keydown(function(n){e.closeOnEscape&&27===n.keyCode&&i.trigger("closeModal")}),i.on("click",e.closeButtonClass,function(n){i.trigger("closeModal"),n.preventDefault()}),e.autoOpen&&i.trigger("openModal")})}};n.fn.easyModal=function(e){return o[e]?o[e].apply(this,Array.prototype.slice.call(arguments,1)):"object"!=typeof e&&e?(n.error("Method "+e+" does not exist on jQuery.easyModal"),void 0):o.init.apply(this,arguments)}}(jQuery);
!function(e){e("#main_search_result").hide(),e("#header_search").keyup(function(a){var t=e(this).val();13==a.which,t.length>0?e("#main_search_result").fadeIn("fast"):e("#main_search_result").fadeOut("fast"),console.log(employeeLink),e.ajax({type:"GET",url:employeeLink,data:{searchTerm:t,output:"json"},beforeSend:function(){e("#main_search_result").html("Searching for "+t+"..")},success:function(a){if(a.length>0){for(var t="",n=a.length-1;n>=0;n--)t+=' <div class="searchResultItem"><a href="'+employeeLink+a[n].employee_work_id+'">'+a[n].employee_work_id+" - "+a[n].lastname+"</a></div>";setTimeout(function(){e("#main_search_result").html(t)},250)}else e("#main_search_result").html("No employees found.")}})}),e(".clickableRow").click(function(){console.log("wa"),window.document.location=e(this).attr("href")})}(jQuery);
function escapeRegExp(e){return e.replace(/([.*+?^=!:${}()|\[\]\/\\])/g,"\\$1")}function replaceAll(e,t,a){return e.replace(new RegExp(escapeRegExp(t),"g"),a)}function __parseTime(e){var t=e.match(/(\d+):(\d+)(?: )?(am|pm)?/i);if(null==t)return!1;var a=parseInt(t[1],10),n=parseInt(t[2],10),i=t[3]?t[3].toUpperCase():null;return"AM"===i&&12==a&&(a=0),"PM"===i&&12!=a&&(a+=12),{hh:a,mm:n}}function __getHour(e){var t=e,a=t/1e3/60/60;t-=1e3*a*60*60;var n=Math.floor(t/1e3/60);t-=1e3*n*60;var i=Math.floor(t/1e3);return t-=1e3*i,a}function calculateTotalHours(e,t,a,n,i){var o=0,m=0,l=0;time_in_am=__parseTime(e),time_out_am=__parseTime(t),time_in_pm=__parseTime(a),time_out_pm=__parseTime(n);var r=new Date(2e3,0,1,time_in_am.hh,time_in_am.mm),s=new Date(2e3,0,1,time_out_am.hh,time_out_am.mm),c=new Date(2e3,0,1,time_in_pm.hh,time_in_pm.mm),u=new Date(2e3,0,1,time_out_pm.hh,time_out_pm.mm),d=__getHour(s-r),_=__getHour(u-c);return"ns"==i&&(o=getNightPemium_10_03(a,n,e,t)),total=_+d,total>8&&(l=total-8),{total:total,np_10_03:o,np_03_06:m,overtime:l}}function arrayHasOwnIndex(e,t){return e.hasOwnProperty(t)&&/^0$|^[1-9]\d*$/.test(t)&&4294967294>=t}function getNightPemium_10_03(e,t,a,n){var i=moment("22:00","HH:mm"),o=moment(t,"HH:mm"),m=o.diff(i),l=moment(a,"HH:mm"),r=moment("03:00","HH:mm"),s=moment(n,"HH:mm");if(__parseTime(n).hh<3)var c=s.diff(l);else var c=r.diff(l);return __getHour(m)+__getHour(c)}function getJSONdata(e,t){return mapped=jQuery.map(e,function(e,a){return a==t?e:void 0}),mapped.length>0?mapped[0]:void 0}function addRow_pe(e,t){var a=document.getElementById(e),n=a.rows.length,i=a.insertRow(n),o=[],m=[],l=[],r=[];$.ajax({async:!1,type:"GET",url:_globalObj._baseURL+"/syncdata?get=medical_findings",success:function(e){o=e}}),$.ajax({async:!1,type:"GET",url:_globalObj._baseURL+"/syncdata?get=recommendations",success:function(e){l=e}});for(key in o)arrayHasOwnIndex(o,key)&&(m[key]=o[key]);for(key in l)arrayHasOwnIndex(l,key)&&(r[key]=l[key]);m.push("None");for(var s=["employee_work_id","medical_findings","recommendation","remarks"],c=0;t-1>=c;c++){i=a.insertRow(c);for(var u=0;u<=s.length-1;++u){var d=i.insertCell(u);if("medical_findings"==s[u])for(var _=document.createElement("select"),p=0;p<=m.length-1;p++)void 0!=m[p]&&(opt=document.createElement("option"),opt.value=p,"None"==m[p]&&(opt.value="None"),opt.text=m[p],_.appendChild(opt),"None"==m[p]&&(opt.selected=!0));else if("recommendation"==s[u])for(var _=document.createElement("select"),p=0;p<=r.length-1;p++)void 0!=r[p]&&(opt=document.createElement("option"),opt.value=r[p],opt.text=r[p],_.appendChild(opt));else{var _=document.createElement("input");_.type="text","employee_work_id"==s[u]&&(_.className=_.className+"searcheable")}_.name=s[u],_.dataset.name=s[u],_.classList.add("form-control"),d.appendChild(_)}}$(".rowcount").html(""+n)}function fillBlankTable(e,t,a,n){"undefined"==typeof a&&(a="id"),"undefined"==typeof n&&(n="pe");var i=t;if(i.length>0){var o=i.length,m=document.getElementById(e),l=(m.rows.length,m.rows);"pe"==n&&addRow_pe(e,i.length,[]),console.log(i);for(var r=0;o>r;++r)if(l[r].cells.length>0)for(var s=0;s<l[r].cells.length;s++)if(l[r].dataset.id=i[r][a],element=l[r].cells[s].getElementsByTagName("input"),void 0!=element[0]&&(elementName=element[0].getAttribute("name"),element[0].value=i[r][elementName]),select=l[r].cells[s].getElementsByTagName("select"),void 0!=select[0]){if(elementName=select[0].getAttribute("name"),"undefined"==typeof i[r][elementName]||!i[r][elementName])continue;select[0].value=i[r][elementName]}}}function OpenInNewTab(e){window.open(e,"_blank")}var myApp=function(e){this.mainURL=e,this.ucfirst=function(e){return e.charAt(0).toUpperCase()+e.slice(1)},this.hasHash=function(){var e=location.hash;return hashValue=e.split("=",2),2==hashValue.length?!0:!1},this.getHash=function(e){var t=location.hash;return hashValue=t.split("=",2),2==hashValue.length?"#"+e==hashValue[0]?hashValue[1]:!1:void 0},this.personName=function(e,t){return"lastname_first"==t?this.fullNameStartLastname(e.firstname,e.lastname,e.middlename):this.fullname(e.firstname,e.lastname,e.middlename)},this.fullname=function(e,t,a){return e+" "+a+" "+t},this.fullNameStartLastname=function(e,t,a){return t+", "+e+" "+a[0]+"."},this.dateToString=function(e){e.getMonth(),e.getFullYear(),e.getDate()},this.getSelectOptions=function(e,t,a,n){$.ajax({type:"GET",url:e,data:{id:t,output:"json",select:"true"},success:function(e){console.log(e);var t="";$.each(e,function(e,a){t+=n==e?'<option value="'+e+'" selected>'+a+"</option>":'<option value="'+e+'">'+a+"</option>"}),$("#"+a).html(t).trigger("change")}})},this.getCheckBox=function(e,t,a,n,i,o){$.ajax({type:"GET",url:e,data:{id:t,output:"json",select:"true"},success:function(e){var m="";$.each(e,function(e,a){if(m+='<div class="form-group">',m+='<label for="'+a+'" class="col-sm-2">'+a+"</label>",m+='<div class="col-sm-1">',null!=i){checked=!1;for(var l=i.length-1;l>=0;l--)i[l]==e&&(checked=!0);m+=checked===!0?'<input type="checkbox" data-parent="'+t+'" class="'+o+'" name="'+n+'" value="'+e+'" checked>':'<input type="checkbox" data-parent="'+t+'" class="'+o+'" name="'+n+'" value="'+e+'">'}else m+='<input type="checkbox" data-parent="'+t+'" class="'+o+'" name="'+n+'" value="'+e+'">';m+="</div></div>"}),console.log(m),$("#"+a).html(m).trigger("change"),$("."+a).html(m).trigger("change")}})}},__in_array=function(e,t){for(var a=!1,n=t.length-1;n>=0;n--)t[n]==e&&(a=!0);return a},__hasClass=function(e,t){var a="/"+t+"/";return e.className.match(a)?!0:!1},__indexOf=function(e){return indexOf="function"==typeof Array.prototype.indexOf?Array.prototype.indexOf:function(e){var t=-1,a=-1;for(t=0;t<this.length;t++)if(this[t]===e){a=t;break}return a},indexOf.call(this,e)};$(document).ready(function(){$("#_applicants_date_hired, #_applicants_birthdate, #date_conducted, .text-date").datetimepicker({pickTime:!1}),$("#birth_date").datetimepicker({maxDate:"12/31/1998",defaultDate:"1998-01-01",pickTime:!1});var e=void 0;$(".filter-item").on("click",function(){{var t=($(this).data("category"),$(this).data("fieldvalue"),$(this).closest("ul"));t.data("limit")}void 0!=typeof e&&clearTimeout(e);var a=(t.find(":checkbox:checked").length,{});$(".filter-list").each(function(){var e=[];$(this).find("li :checkbox:checked").each(function(){e.push($(this).data("fieldvalue"))}),e.length>0&&(a[$(this).data("category")]=e)}),e=setTimeout(function(){window.location.href=encodeURI("?filterby="+JSON.stringify(a))},3500)}),$(document).on("click","._deleteItem",function(e){e.preventDefault();var t=$(this),a=t.data("employee_id"),n=t.data("url");$.ajax({type:"DELETE",url:n,data:{id:a},success:function(e){"1"==e&&t.closest("tr").fadeOut(255)}})})});var dtrModule=function(){this.getTableData=function(e){for(var t={},a={},n=value="",i=0;i<e.rows.length;i++){t={},t.id=e.rows[i].dataset.id;for(var o=0;o<e.rows[i].cells.length;o++)console.log(e.rows[i].cells[o].children[0].dataset.name),"input"==e.rows[i].cells[o].children[0].tagName.toLowerCase()?(n=e.rows[i].cells[o].children[0].dataset.name,value=e.rows[i].cells[o].children[0].value):void 0!=e.rows[i].cells[o].children[0].children[0]&&(n=e.rows[i].cells[o].children[0].children[0].dataset.name,value=e.rows[i].cells[o].children[0].children[0].value),t[n]=value;void 0!=t.employee_work_id&&(console.log(t.employee_work_id),""!=t.employee_work_id&&(a[i]=t))}return a},this.calculateTotalHours=function(e,t,a,n,i){var o=0,m=0,l=0;time_in_am=__parseTime(e),time_out_am=__parseTime(t),time_in_pm=__parseTime(a),time_out_pm=__parseTime(n);var r=new Date(2e3,0,1,time_in_am.hh,time_in_am.mm),s=new Date(2e3,0,1,time_out_am.hh,time_out_am.mm),c=new Date(2e3,0,1,time_in_pm.hh,time_in_pm.mm),u=new Date(2e3,0,1,time_out_pm.hh,time_out_pm.mm),d=__getHour(s-r),_=__getHour(u-c);return"ns"==i&&(o=getNightPemium_10_03(a,n,e,t)),total=_+d,total>8&&(l=total-8),{total:total,np_10_03:o,np_03_06:m,overtime:l}},this.getNightPemium_10_03=function(e,t,a,n){var i=moment("22:00","HH:mm"),o=moment(t,"HH:mm"),m=o.diff(i),l=moment(a,"HH:mm"),r=moment("03:00","HH:mm"),s=moment(n,"HH:mm");if(__parseTime(n).hh<3)var c=s.diff(l);else var c=r.diff(l);return __getHour(m)+__getHour(c)},this.changeShift=function(e,t,a){console.log(a),console.log("from Module"),"ds"==e?(console.log("Day shift"),$("#def_timeout_am").val("11:00"),$("._am").text("Time out AM"),$("#def_timein_pm").val("12:00"),$("._pm").text("Time in PM"),$(t+" tr").each(function(){var e=$(this).find('input[name="time_in_am"]'),t=$(this).find('input[name="time_out_am"]'),a=$(this).find('input[name="time_in_pm"]'),n=$(this).find('input[name="time_out_pm"]');time_in_am_clone=e.clone(!0),time_out_am_clone=t.clone(!0),time_in_pm_clone=a.clone(!0),time_out_pm_clone=n.clone(!0),a.replaceWith(time_in_am_clone),e.replaceWith(time_in_pm_clone),t.replaceWith(time_out_pm_clone),n.replaceWith(time_out_am_clone)}),$("._amth").html("AM"),$("._pmth").html("PM")):"ns"==e&&(console.log("Night shift"),$("#def_timeout_am").val("00:00"),$("._am").text("Time in AM"),$("#def_timein_pm").val("23:00"),$("._pm").text("Time out PM"),$(t+" tr").each(function(){var e=$(this).find('input[name="time_in_am"]'),t=$(this).find('input[name="time_out_am"]'),a=$(this).find('input[name="time_in_pm"]'),n=$(this).find('input[name="time_out_pm"]');time_in_am_clone=e.clone(!0),time_out_am_clone=t.clone(!0),time_in_pm_clone=a.clone(!0),time_out_pm_clone=n.clone(!0),a.replaceWith(time_in_am_clone),e.replaceWith(time_in_pm_clone),t.replaceWith(time_out_pm_clone),n.replaceWith(time_out_am_clone)}),$("._amth").html("PM"),$("._pmth").html("AM"))},this.initializer=function(e){$("#department_id").val(e.oldDepartment),0!=e.oldDepartment&&(hrApp.getSelectOptions(_globalObj._baseURL+"/positions/positionsByDepartment",e.oldDepartment,"position_id",e.oldPosition),"ns"==e.oldShift&&_dtrModule.changeShift(e.oldShift))},this.handlers=function(){$(".shift_label").on("click",function(){var e=$("#shift").parent();e.is(":visible")?e.hide():e.show()}),$("#department_id").change(function(){var e=$(this).find(":selected").val(),t=null;$("#position_id").parent().parent().show(),hrApp.getSelectOptions(_globalObj._baseURL+"/positions/positionsByDepartment",e,"position_id",t)}),$("#shift").on("change",function(){var e=$(this).val(),t="";_dtrModule.changeShift(e,"#medical_examination_information_table"),t="ds"==e?'<span class="label label-warning">Day shift</span>':'<span class="label label-info">Night shift</span>',$(".shift_label").html(t)}),$("#def_timeout_am").on("change",function(){var e=$("#shift").val();if("ds"==e){var t=$('input[name="time_out_am"]'),a=$(this).val();$.each(t,function(){$(this).val(a)})}else if("ns"==e){var t=$('input[name="time_in_am"]'),a=$(this).val();$.each(t,function(){$(this).val(a)})}}),$("#def_timein_pm").on("change",function(){var e=$("#shift").val();if("ds"==e){var t=$('input[name="time_in_pm"]'),a=$(this).val();$.each(t,function(){$(this).val(a)})}else if("ns"==e){var n=$('input[name="time_out_pm"]'),a=$(this).val();$.each(n,function(){$(this).val(a)})}}),$('input[name="show_full_dtr"]').on("change",function(){var e=$('input[name="time_out_am"]'),t=$('input[name="time_in_pm"]'),a=$('input[name="time_in_am"]'),n=$('input[name="time_out_pm"]');if(1==$(this).prop("checked"))show_full_dtr=!0,$.each(e,function(){$(this).parent().parent().fadeIn()}),$.each(t,function(){$(this).parent().parent().fadeIn()}),$.each(a,function(){$(this).parent().parent().fadeIn()}),$.each(n,function(){$(this).parent().parent().fadeIn()}),$("#header_timeout_am").fadeIn(250),$("#header_timein_pm").fadeIn(250),$(".timelabel").fadeIn();else{show_full_dtr=!1;var i=$("#shift").val();"ds"==i?($("#header_timeout_am").fadeOut(250),$("#header_timein_pm").fadeOut(250),$(".timelabel").fadeOut(),$.each(e,function(){var e=$(this),t=e.parent().parent().parent().find('input[name="time_in_pm"]').val(),a=e.parent().parent().parent().find('input[name="time_out_pm"]').val();console.log(a),"00:00"==t&&"00:00"==a?e.parent().parent().parent().find('input[name="time_out_pm"]').parent().parent().fadeOut():e.parent().parent().fadeOut()}),$.each(t,function(){var e=$(this),t=e.parent().parent().parent().find('input[name="time_in_am"]').val(),a=e.parent().parent().parent().find('input[name="time_out_am"]').val();console.log(a),"00:00"==t&&"00:00"==a?e.parent().parent().parent().find('input[name="time_in_am"]').parent().parent().fadeOut():e.parent().parent().fadeOut()})):"ns"==i&&($("#header_timeout_am").fadeOut(250),$("#header_timein_pm").fadeOut(250),$(".timelabel").fadeOut(),$.each(n,function(){var e=$(this);e.parent().parent().fadeOut()}),$.each(a,function(){var e=$(this);e.parent().parent().fadeOut()}))}})}};$(".ajax-modal").on("click",function(e){var t=$(this).attr("href"),a=$(this).data("title"),n=$(this).data();$("#ajax-modal-form #ajax-modal-save").data("href",t),$.ajax({type:"GET",url:t,data:n,beforeSend:function(){$("#ajax-modal-form #ajax-modal-save").html("Fetching View...").prop("disabled",!0)},success:function(e){$("#ajax-modal-form #ajax-modal-save").html("Accept").prop("disabled",!1),$("#ajax-modal-form .modal-title").html(a),$("#ajax-modal-form .modal-body").html(e)}}),$("#ajax-modal-form").modal("show"),e.preventDefault()}),$("#ajax-modal-form #ajax-modal-save").on("click",function(){var e=$("#ajax-modal-form #ajax-modal-save");e.html("Processing...").prop("disabled",!0);var t=$(this).data("href"),a={},n=$("#ajax-modal-form .modal-body input");$.each(n,function(){a[$(this).attr("name")]=$(this).val()}),console.log(a),$.ajax({type:"POST",data:a,url:t,beforeSend:function(){},success:function(t){var a=JSON.parse(t);void 0!=a.request_type?($("#ajax-modal-form .modal-body").html("File is downloading. If download does not start, please try again. <br><br> If file does not download at all after trying several times, please contact the web developer."),e.html("Preparing..."),setTimeout(function(){location.href=a.path,e.html("Downloading...").prop("disabled",!0)},1800)):$("#ajax-modal-form .modal-body").html(t)}})}),jQuery.fn.extend({disable:function(e){return this.each(function(){this.disabled=e})}}),!function(e){e.fn.classes=function(t){var a=[];if(e.each(this,function(e,t){var n=t.className.split(/\s+/);for(var i in n){var o=n[i];-1===a.indexOf(o)&&a.push(o)}}),"function"==typeof t)for(var n in a)t(a[n]);return a}}(jQuery);
!function(){console.log("Sub-script loaded."),$(document).on("change","#system_default",function(){$("#name").prop("disabled",!0),$("#date_hired").prop("disabled",!0),$("#department_id").prop("disabled",!0),$("#position_id").prop("disabled",!0)})}();