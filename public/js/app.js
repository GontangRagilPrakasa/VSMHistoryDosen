var MonthNamesShort		= moment.monthsShort();
var MonthNames			= moment.months();
var MonthNumber12		= new Array();
var MonthNumber11		= new Array();

for(i=0; i<=11; i++){
	MonthNumber11[i] = i;
	MonthNumber12[i] = i+1;
}

var WeekNamesShort		= moment.weekdaysShort();
var WeekNames			= moment.weekdays();

var postData = {};
var csrfToken = $('meta[name="csrf-token"]').attr('content');

$.fn.select2.defaults.set("theme", "bootstrap");
$.fn.select2.defaults.set("width", null);
//$.fn.select2.defaults.set("containerCssClass", ':all:');

var modalShowOption		= {
	backdrop	: 'static',
	keyboard	: false
};

function formatSelection(state) {
    return state.text;
}

function formatResult(state) {
    if (!state.id) return state.text; // optgroup
    if( $(state.element).parent().val().length==0 ) state.selected = false;
    return "<input type='checkbox' class='select2-checkbox' onclick='return false;' "+(state.selected?"checked":"")+"> <label>"+state.text+"</label>";
}

$(document).ready(function(){
	$('input[id]:not([name])', '.main-content').attr('name', function(){ 
		if( this.id != undefined ){ return this.id; }
	});
	$('input[type=checkbox][id]:not([name]), input[type=radio][id]:not([name])', '.main-content').attr('name', function(){ 
		if( this.id != undefined ){ return this.id; }
	});
	$('select[id]:not([name])', '.main-content').attr('name', function(){ 
		if( this.id != undefined ){ return this.id; }
	});
	$('textarea[id]:not([name])', '.main-content').attr('name', function(){ 
		if( this.id != undefined ){ return this.id; }
	});
	
	$('.form-horizontal .form-group .control-label:not(.control-value)', 'section.content').append('<div class="form-label-separator"></div>');
	

	$('.modal').modal({
		backdrop: 'static',
		keyboard: false,
		show: false,
	});	
	
	$('.select2').select2();

	$('.select2-auto-width').select2({
		dropdownAutoWidth : true,
	});
	
	$('.select2multi').select2({
		multiple: true,
        closeOnSelect:false,
        allowHtml: true,
        allowClear: true,
        tags: true,
        templateResult: formatResult,
        templateSelection: formatSelection,
        escapeMarkup: function (m) {
            return m;
        },
	}).on('select2:select', function(e){
        elData = e.params.data;
        $('#'+elData._resultId).find(':checkbox').prop('checked', true)
    }).on('select2:unselect', function(e){
        elData = e.params.data;
        $('#'+elData._resultId).find(':checkbox').prop('checked', false)
    });
	
	$(':input').keypress(function(){
		alertBox('hide');
	});
	
	$('.datepicker').datepicker({
		format: 'dd-mm-yyyy',
		autoclose: true,
		clearBtn: true,
		todayHighlight: true,
	});

	$('.monthpicker').datepicker({
		format: 'M - yyyy',
		startView: "months",
		minViewMode: "months",
		autoclose: true,
		clearBtn: true,
	});

	var date = new Date();
	var firstDay = new Date(date.getFullYear(), date.getMonth(), 1);
	//var lastDay = new Date(date.getFullYear(), date.getMonth() + 1, 0);
	var lastDay = new Date();
	$('.datepicker_current_month').datepicker({
		format: 'dd-mm-yyyy',
		autoclose: true,
		clearBtn: true,
		todayHighlight: true,
		startDate: firstDay,
		endDate: lastDay
	});	

	$('.datepicker_current_date').datepicker({
		format: 'dd-mm-yyyy',
		autoclose: true,
		clearBtn: true,
		todayHighlight: true,
		endDate: lastDay
	});	
	
	$('.yearpicker').datepicker({
		format: "yyyy",
	    viewMode: "years", 
	    minViewMode: "years",
	    autoclose: true,
		clearBtn: true,
		todayHighlight: true,
	});
	
	$('.input-number').keypress(function(e){
		var code = e.keyCode || e.which;
		if( (code >= 48 && code <= 57) || e.keyCode == 37 || e.keyCode == 39 || code == 8 || code == 9 || e.keyCode == 35 || e.keyCode == 36 || code == 190 ){
		}else{
			e.preventDefault();
		}
	});	
	
	$('.money-format', '.main-content').keyup(function (e){ moneyEntry(this); });
	$('.money-format', '.main-content').blur(function (e){ this.value=this.value==''?0:this.value; });
	$('.money-format', '.main-content').focus(function (e){ 
		this.value=this.value==='0'?'':this.value;
	});
	
	$('[data-toggle="tooltip"]').tooltip();
	
    $('input[type="checkbox"].icheck, input[type="radio"].icheck').iCheck({
		checkboxClass: 'icheckbox_minimal-blue',
		radioClass   : 'iradio_minimal-blue'
    });
});

function blockUI(selectorObj, block, msg, width){
	block = (block == undefined?true:block);
	msg = '<div class="blockUI-ajax-loading"></div><div class="blockUI-text-loading">'+(msg == undefined?'Please wait':msg)+' ...</div>';
	width = (width == undefined?'185px':width);
	
	var obj = $(selectorObj);
	if( block ){
		obj.block({ 
			message	: msg,
			css		: {
				border				: '3px solid #3C354E',
				padding				: '10px',
				textAlign			: 'left',
				color				: '#3C354E',
				'border-radius'		: '3px',
				width				: width,
				backgroundColor		: '#EFF3F6'
			},
		});				
		
	}else{
		obj.unblock();
	}
}

function alertBox(mode, property){
	/*
		selectorAlert : 
		header : true/false
		title :
		msg : { msg:, focus: } langsung isi pesan, array isi pesan, dengan objek {msg: ..., focus: ...}, dengan array objek
		mode : warning, danger, info, success
		boxStyle : optional
	*/
	
	if( property == undefined ){ property = new Object(); }
	if( property.selectorAlert == undefined ){ property.selectorAlert = '#mainAlert'; }
	if( property.header == undefined ){ property.header = false; }
	
	if( mode == 'show' ){
		if( $.isArray(property.msg) ){
			property.message = '';
			$.each(property.msg, function( key, value ) {
				/*
				if( $.isPlainObject(value) ){
					property.message += '<a href="javascript: void(0);" onClick="$(\'#'+value.focus+'\').focus();">'+value.msg+'</a><br />';
				}else{
					property.message += value.msg+'<br />';
				}
				*/
				property.message += value+'<br />';
			});
		}else{
			if( $.isPlainObject(property.msg) ){
				property.message = '<a href="javascript: void(0);" onClick="$(\'#'+property.msg.focus+'\').focus();">'+property.msg.msg+'</a>';
			}else{
				property.message = property.msg;
			}
		}
		if( property.mode == undefined ){ property.mode = "danger"; }
		
		var boxClass='alert-warning';
		var boxIcon='fa-warning';

		switch(property.mode){
			case 'warning':
				boxClass='alert-warning';
				boxIcon='fa-warning';			
				break;
			case 'danger':
				boxClass='alert-danger';
				boxIcon='fa-ban';
				break;			
			case 'info':
				boxClass='alert-info';
				boxIcon='fa-info';
				break;			
			case 'success':
				boxClass='alert-success';
				boxIcon='fa-check';
				break;			
		}
		
		if( property.header ){
			property.title = (property.title == undefined?'Please correct all errors below':property.title);
		}
		
		var boxHeader = '\
			<div class="alert-header">\
				<button aria-hidden="true" data-dismiss="alert" class="close" type="button">&#215</button>\
				'+(property.header?'<i class="icon fa '+boxIcon+'"></i>'+property.title:'')+'\
			</div>\
		';		
		$(property.selectorAlert).html('\
			<div class="alert '+boxClass+' alert-dismissible" '+(property.boxStyle==undefined?'':'style="'+property.boxStyle+'"')+'>\
				'+(property.header?boxHeader:'')+'\
				<div class="alert-content">'+(property.header?'':'<i class="icon fa '+boxIcon+'"></i>')+property.message+(property.header?'':'<button aria-hidden="true" data-dismiss="alert" class="close" type="button">&#215</button>')+'</div>\
			</div>\
		');
        $(property.selectorAlert).show();        
	}else{
        $(property.selectorAlert).hide();
		$(property.selectorAlert).empty();
	}
}

$.fn.serializeObject = function(){
	var o 			= {};
	var a			= this.serializeArray();
	
	$.each(a, function() {
		var value = this.value || '';
		
		if (o[this.name] !== undefined) {
			if (!o[this.name].push) {
				o[this.name] = [o[this.name]];
			}
			o[this.name].push(value);
		} else {
			o[this.name] = value;
		}
	});
	return o;
};

function ajax(ajaxProperty){
	/*
		ajaxProperty
			url				: required
			postData 		: optional
			dataType		: optional (default: json)
			selectorBlock	: required
			selectorAlert	: optional (default: mainAlert)
			success			: required
			beforeSend		: optional (additional function)
			error			: optional (additional function)
	*/
	ajaxProperty.dataType	= (ajaxProperty.dataType == undefined?'json':ajaxProperty.dataType);
	ajaxProperty.selectorAlert	= (ajaxProperty.selectorAlert == undefined?'#mainAlert':ajaxProperty.selectorAlert);		
	ajaxProperty.selectorBlock	= (ajaxProperty.selectorBlock == undefined?'body':ajaxProperty.selectorBlock);		
	if( ajaxProperty.postData == undefined ){ ajaxProperty.postData = new Object(); }
	
	obj = {};
	
	obj = {
		type		: 'post',
		url			: ajaxProperty.url,
		data		: ajaxProperty.postData,
		dataType	: ajaxProperty.dataType,
		contentType : ajaxProperty.contentType,
		beforeSend	: function(xhr){ 
			xhr.setRequestHeader("X-CSRF-TOKEN", csrfToken);
			blockUI(ajaxProperty.selectorBlock);
			if( ajaxProperty.beforeSend != undefined ){ ajaxProperty.beforeSend(xhr); }
		},
		success		: function(ret){
			if(ret.expired != undefined){
				window.scrollTo(0, 0);
				var timeout=5;
				setTimeout(function(){ clearInterval(); location.reload(); }, 5000);
				alertBox('show', {selectorAlert: ajaxProperty.selectorAlert, msg: ret.msg+' ( <u><i><label id="lblTimeout">5</label> second</i></u> )'});
				
				$('#lblTimeout').html(timeout);
				setInterval(function(){ 
					timeout -= 1;
					$('#lblTimeout').html(timeout);
				}, 1000);
				return;
			}
			if(ret.result != undefined){
				if(ret.result == false){
					window.scrollTo(0, 0);
					if (ret.msg.includes('SQLSTATE[23000]: Integrity constraint violation: 1062 Duplicate entry')) {
						ret.msg = 'Kode Sudah Terdaftar'
					}

					if (ret.msg.includes('SQLSTATE[23000]: Integrity constraint violation: 1451')) {
						ret.msg = 'Kode Tidak Bisa Dirubah'
					}

					alertBox('show', {selectorAlert: ajaxProperty.selectorAlert, header: true, title: 'Alert!', msg: ret.msg});
					if( ajaxProperty.error != undefined ){
						ajaxProperty.error(ret);
					}
					return;
				}
			}
			ajaxProperty.success(ret);
		}, 
		error		: function(jqXHR, textStatus, errorThrown){
			switch(jqXHR.status){
				case 302:
					location.reload();
					break;
			}
			window.scrollTo(0, 0);
			alertBox('show', {selectorAlert: ajaxProperty.selectorAlert, header: true, title: 'Alert!', msg: 'Err No. : ' + jqXHR.status + ' - ' + errorThrown});
		}, 
		complete	: function(jqXHR, textStatus){ blockUI(ajaxProperty.selectorBlock, false); },
	};
	
	if( ajaxProperty.contentType == undefined ){
		delete obj.contentType;
	}else{
		obj.contentType = ajaxProperty.contentType;
	}
	
	$.ajax(obj);
}

function xssDecode(val){
	return $("<div/>").html(val).text();
}

function escapeRegExp(str) {
  return str.replace(/[\-\[\]\/\{\}\(\)\*\+\?\.\\\^\$\|]/g, '\\$&');
}

function replaceAll(find, replace, str) {
	if( str == null ){
		return '';
	}else{
		return str.replace(new RegExp(escapeRegExp(find), 'g'), replace);	  
	}
}

function showMoney(strNumber){
	//strNumber	= (isNaN(strNumber) || strNumber=="") ? 0 : strNumber;
	strNumber	= strNumber==undefined ? 0 : strNumber;
	strNumber	= strNumber=="" ? 0 : strNumber;
    strNumber	= strNumber.toString().replace(/[\\A-Za-z!"?$%^&*+_={}; ()\:'/@#~,?\<>?|`?\]\[]/g,'');
	strNumber	= strNumber.toString().replace('-', '');
	
    arrKoma		= strNumber.split('.');
	arrMinus	= arrKoma[0].split('-');
	if( arrMinus[1] == undefined ){
		nilai = arrKoma[0].replace(/[\\A-Za-z!"?$%^&*+_={}; ()\:'/@#~,?\<>?|`?\]\[]/g,'');
	}else{
    	nilai = arrMinus[1].replace(/[\\A-Za-z!"?$%^&*+_={}; ()\:'/@#~,?\<>?|`?\]\[]/g,'');
	}
	nilai = parseFloat(nilai).toString();
	nilai = isNaN(nilai)?0:nilai;
	
    panjang	= nilai.length;
    output	= '';
    j = 0;
    for (i = panjang; i > 0; i--) {
        j = j + 1;
        if (((j % 3) == 1) && (j != 1)) {
            output = nilai.substr(i-1,1) + ',' + output;
        } else {
            output = nilai.substr(i-1,1) + output;
        }
    }
    if(arrKoma[1] == undefined){
        //objText.value = output;
    }else{
        //objText.value = output + "." +arrvalue[1];
		arrKoma[1]=replaceAll('-', '', arrKoma[1]);
		output = output + '.' +arrKoma[1].substring(0, 4);
    }
	if( arrMinus[1] == undefined ){
		return output;
    }else{
        return '-'+output;
    }
}

function moneyEntry(objInput) {
	objInput.value = showMoney(objInput.value);
	
	if( parseFloat(convertMoney(objInput.value))>99999999999999 ){ //99.999.999.999.999
		validation = convertMoney(objInput.value);
		var arrKoma		= validation.split('.');
		validation = arrKoma[0].substring(0, validation.length-1);
		if(arrKoma[1] != undefined){
			validation += arrKoma[1];
		}
		objInput.value = showMoney(validation);
	}
}

function convertMoney(strNumber){
	objReplace=replaceAll(',', '', strNumber);
	if( objReplace=="" ){
		objReplace=0;
	}

    return objReplace;
}

function formatNumber(x) {
    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}

function checkTimeData(strTime){
	if( strTime == undefined ){
		return false;
	}else{
		if( strTime === null ){
			return false;
		}else{
		
			var arrTime = strTime.split(":");
			if(arrTime.length > 1){
				return true;
			}else{
				return false;
			}
		}
	}	
}

function convertMergedDate(strDate){
	if( strDate == undefined ){
		return '';
	}else{
		if( strDate === null ){
			return '';
		}else{
			if( strDate.length == 8 ){
				return strDate.substr(0, 4)+"-"+strDate.substr(4, 2)+"-"+strDate.substr(6, 2);
			}else{
				return '';
			}
			return '';
		}
	}	
}

function showTime(strTime){
	if( strTime == undefined ){
		return '';
	}else{
		if( strTime === null ){
			return '';
		}else{
			var arrTime = strTime.split(" ");
			if(arrTime.length == 1){
				if( checkTimeData(strTime) ){
					return strTime.substr(0, 8);
				}else{
					return '';
				}
			}else if(arrTime.length == 2){
				if( checkTimeData(arrTime[0]) ){
					return arrTime[0].substr(0, 8);
				}else if( checkTimeData(arrTime[1]) ){
					return arrTime[1].substr(0, 5);				
				}else{
					return '';
				}
				
			}else{
				return '';
			}
		}	
	}
}

function showDate(strDate){
	if( strDate == undefined ){
		return '';
	}else{
		if( strDate === null ){
			return '';			
		}else{
			var arrDateTime = strDate.split(" ");
			var strTime = '';
			if( arrDateTime.length==2 ){
				var strTime = " "+showTime(arrDateTime[1]);
				strDate = arrDateTime[0];
			}
			
			var arrDate = strDate.split("-");
			if( arrDate.length == 3 && parseInt(arrDate[1]) > 0 ){
				arrDate[1] = MonthNamesShort[parseInt(arrDate[1])-1];
				return arrDate[2]+"-"+arrDate[1]+"-"+arrDate[0]+strTime;
			}else{
				return '';
			}
			return '';			
		}
	}	
}

function showDateEl(strDate){
	if( strDate == undefined ){
		return '';
	}else{
		if( strDate === null ){
			return '';			
		}else{
			var arrDateTime = strDate.split(" ");
			var strTime = '';
			if( arrDateTime.length==2 ){
				var strTime = " "+showTime(arrDateTime[1]);
				strDate = arrDateTime[0];
			}
			
			var arrDate = strDate.split("-");
			if( arrDate.length == 3 && parseInt(arrDate[1]) > 0 ){
				return arrDate[2]+"-"+arrDate[1]+"-"+arrDate[0]+strTime;
			}else{
				return '';
			}
			return '';			
		}
	}
}

function comboAjax(idCombo, ajaxProperty, allowNull, objNull){
	/*
		idCombo			: require
		ajaxProperty	: require
			url			: require
			postData		: optional (default: null)
			selectorAlert: optional (default: #mainAlert)
		allowNull		: optional (default: true)
	*/
	ajaxProperty.selectorAlert	= (ajaxProperty.selectorAlert == undefined?'#mainAlert':ajaxProperty.selectorAlert);
	ajaxProperty.selectorBlock	= (ajaxProperty.selectorBlock == undefined?$('#'+idCombo).parent():ajaxProperty.selectorBlock);
	ajaxProperty.selectedParent = (ajaxProperty.selectedParent == undefined?null:ajaxProperty.selectedParent);
	ajaxProperty.selectedParent_0 = (ajaxProperty.selectedParent_0 == undefined?false:ajaxProperty.selectedParent_0);
	
	allowNull	= (allowNull == undefined?false:allowNull);
	objNull		= (objNull == undefined?(allowNull?{id: '', text: 'Pilih ...'}:null):objNull);

	var sData		= new Array();
	var defSelected	= 0;
	var i			= 0;
	if( allowNull ){ sData.push(objNull); }
	$('#'+idCombo).empty();
	
	var setCombo = function(sData){
		if( $('#'+idCombo).hasClass('select2-auto-width') ){
			$('#'+idCombo).select2({ 			
				dropdownAutoWidth : true,
				data: sData, 
			});				
		}else if( $('#'+idCombo).hasClass('select2-material') ){
			$('#'+idCombo).select2({
				containerCssClass : "custom-material-select",
				dropdownCssClass: "custom-material-select",
				data: sData, 
			});
		}else if( $('#'+idCombo).hasClass('select2-auto-width-material') ){
			$('#'+idCombo).select2({
				containerCssClass : "custom-material-select",
				dropdownCssClass: "custom-material-select",
				dropdownAutoWidth : true,
				data: sData, 
			});
		}else{
			$('#'+idCombo).select2({ 
				data: sData, 
			});
		}		
	}
	
	if( ajaxProperty.selectedParent==null || ajaxProperty.selectedParent!=0 || (ajaxProperty.selectedParent==0 && ajaxProperty.selectedParent_0==true) ){
		ajax({
			url			: ajaxProperty.url, 
			postData	: postData, 
			selectorAlert: ajaxProperty.selectorAlert,
			selectorBlock: ajaxProperty.selectorBlock, 
			success		: function(ret){
				var arrData = ret.data;

				if( arrData.length==1 ){
					if( allowNull ) sData.splice(0);
				}				
				
				if( arrData.length > 0 ){
					defSelected = (! allowNull && i == 0?arrData[0].id:defSelected);
					$.each(arrData, function(x, y){ sData.push(y); });
				}
				
				setCombo(sData);

				if( arrData.length==1 ){
					$('#'+idCombo).val(arrData[0].id).trigger("change").trigger("select2:select");
				}else{
					$('#'+idCombo).val(defSelected).trigger('change').trigger("select2:select");
				}
				
				if( ajaxProperty.success != undefined){ ajaxProperty.success(ret); }
			}, 
		});
	}else{
		setCombo(sData);
		$('#'+idCombo).val(defSelected).trigger('change').trigger("select2:select");			
	}
}

function jsDateToStr(objDate){
	if(objDate instanceof Date && !isNaN(objDate.valueOf())){
		var day		= objDate.getDate();
		day			= (day.toString().length==1?'0'+day:day);
		var month	= objDate.getMonth();
		month		+= 1;
		month		= (month.toString().length==1?'0'+month:month);
		var year	= objDate.getFullYear();
		
		return year+'-'+month+'-'+day;
	}else{
		return '';
	}
}

