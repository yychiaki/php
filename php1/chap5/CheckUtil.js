var CheckUtil = function() {
	this.version = '1.0';
	this._errs = "";
}

CheckUtil.prototype = {

	getErrors : function(){
		if(this._errs!=""){
			window.alert(this._errs);
			return false;
		} else {
			return true;
		}
	},

	requiredCheck : function(value,err) {
		if(value=="" || value==undefined){
			this._errs += err + "は必須入力です \r";
		}
	},

	requiredRadioCheck : function(elm,err) {
		flag=false;
		for(i=0;i<elm.length;i++){
			if(elm[i].checked){flag=true;}
		}
		if(!flag){
			this._errs += err + "は必須入力です \r";
		}
	},

	lengthCheck : function(value,max,err) {
		if(value!="" && value!=undefined){
			if(value.length>max){
				this._errs += err + "は" + max + "桁以下で入力してください \r";
			}
		}
	},

	numberTypeCheck : function(value,err){
		if(value!="" && value!=undefined){
			if(isNaN(value)){
				this._errs += err + "は数値で入力してください \r";
			}
		}
	},

	dateTypeCheck : function(value,err){
		if(value!="" && value!=undefined){
			var reg=new RegExp("^[0-9]{4}-[0-9]{2}-[0-9]{2}$","gi");
			if(!reg.test(value)){
				this._errs += err + "は日付形式で入力してください \r";
			}else{
				var year =value.substring(0,4);
				var month=value.substring(5,7);
				var day  =value.substring(8,10);
				var dat  =new Date(year,month-1,day);
				if(year!=dat.getFullYear() || month-1!=dat.getMonth() || day!=dat.getDate()){
					this._errs += err + "は日付形式で入力してください \r";
				}
			}
		}
	},

	rangeCheck : function(value,max,min,err){
		if(value!="" && value!=undefined){
			if(isNaN(value)){
				this._errs += err + "は数値で入力してください \r";
			}else{
				val=parseInt(value,10);
				if(val<min || val>max){
					this._errs += err + "は" + min + "以上、かつ" + max + "以下で入力してください \r";
				}
			}
		}
	},

	regExCheck : function(value,ptn,err){
		if(value!="" && value!=undefined){
			var reg=new RegExp(ptn,"gi");
			if(!reg.test(value)){
				this._errs += err + "を正しい形式で入力してください \r";
			}
		}
	}

};
