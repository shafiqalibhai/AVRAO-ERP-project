function getObj(n,d) {

  var p,i,x; 

  if(!d)

      d=document;

   
   if(n != undefined)
   {
	   if((p=n.indexOf("?"))>0&&parent.frames.length) {

		   d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);

	   }
   }
  if(!(x=d[n])&&d.all)

      x=d.all[n];
	  
  for(i=0;!x&&i<d.forms.length;i++)

      x=d.forms[i][n];

  for(i=0;!x&&d.layers&&i<d.layers.length;i++)

      x=getObj(n,d.layers[i].document);

  if(!x && d.getElementById)

      x=d.getElementById(n);

  return x;

}
function settotalnoofrows() {
	var max_row_count = document.getElementById('serviceTable').rows.length;
        max_row_count = eval(max_row_count)-1;

	//set the total number of products
	document.getElementById('totalProductCount').value = max_row_count;	
}
function deleteRow(i)
{
//	rowCnt--;
	var tableName = document.getElementById('serviceTable');
	var prev = tableName.rows.length;
//	document.getElementById('serviceTable').deleteRow(i);
	document.getElementById("row"+i).style.display = 'none';
	document.getElementById("serviceid"+i).value = "";
	//document.getElementById("service"+i).value = "";
	document.getElementById('deleted'+i).value = 1;
	calcTotal()
}

function fnAddProductRow(){
	/* rowCnt++; */
	var tableName = document.getElementById('serviceTable');
	var prev = tableName.rows.length;
    	var count = eval(prev);//As the table has two headers, we should reduce the count
    	var row = tableName.insertRow(prev);
		var rowid = 1 - count%2;
		row.id = "row"+count;
		row.style.verticalAlign = "top";
		row.className = "row"+rowid;
	
	var colone = row.insertCell(0);
	var coltwo = row.insertCell(1);

		var colfour = row.insertCell(2);
		var colfive = row.insertCell(3);
		var colsix = row.insertCell(4);
	
	//Delete link
	colone.className = ""
	colone.innerHTML='<img src="components/com_jaccounts/images/publish_x.png" border="0" onclick="deleteRow('+count+')"><input id="deleted'+count+'" name="deleted'+count+'" type="hidden" value="0">';

	//Product Name with Popup image to select product
	coltwo.className = ""
	coltwo.innerHTML= '<table border="0" cellpadding="1" cellspacing="0" width="100%"><tr><td style="border: none;"><input id="serviceid'+count+'" name="serviceid'+count+'" type="hidden"><input id="service'+count+'" name="service'+count+'" style="width: 350px;" value="" readonly="readonly" type="text"></td></tr><tr><td style="border: none;" id="setComment'+count+'"><textarea id="comment" name="comment'+count+'" style="width:350px;height:40px"></textarea><br>[<a href="javascript:;" onclick="getObj(\'comment'+count+'\').value=\'\'";>Clear Comment</a>]</td></tr></tbody></table>';	

	//Quantity
	colfour.className = ""
	colfour.innerHTML='<input id="quantity'+count+'" name="quantity'+count+'" type="text" style="width:50px" onfocus="this.className=\'detailedViewTextBoxOn\'" onBlur="settotalnoofrows(); calcTotal();" value=""/>';
	
	//List Price with Discount, Total after Discount and Tax labels
	colfive.className = ""
	colfive.innerHTML='<input id="listprice'+count+'" name="listprice'+count+'" value="0.00" type="text" style="width:70px" onBlur="calcTotal();"/>';

	//Total and Discount, Total after Discount and Tax details
	colsix.className = "productTotal"
	colsix.id = "productTotal"+count;
	colsix.innerHTML = '0.00';
}

function calcTotal() {
	var max_row_count = document.getElementById('serviceTable').rows.length;
	max_row_count = eval(max_row_count)-1;//Because the table has two header rows. so we will reduce two from row length
	var netprice = 0.00;
	var i = 1;
	for(i;i<=max_row_count;i++)
	{
		rowId = i;
		if(document.getElementById('deleted'+rowId).value == 0)
		{
			var total=eval(getObj("quantity"+rowId).value*getObj("listprice"+rowId).value);
			getObj("productTotal"+rowId).innerHTML=roundValue(total.toString())
		}
	}
	calcGrandTotal()
}

function calcGrandTotal() {
	var netTotal = 0.0, grandTotal = 0.0;
	var tax = document.getElementById("taxrate").value;
	var currency = document.getElementById("currency").value;
	tax = tax/100;

	var max_row_count = document.getElementById('serviceTable').rows.length;
	max_row_count = eval(max_row_count)-1;//Because the table has two header rows. so we will reduce two from row length

	for (var i=1;i<=max_row_count;i++) 
	{
		if(document.getElementById('deleted'+i).value == 0)
		{
			
			if (document.getElementById("productTotal"+i).innerHTML=="") 
				document.getElementById("productTotal"+i).innerHTML = 0.00
			if (!isNaN(document.getElementById("productTotal"+i).innerHTML))
				netTotal += parseFloat(document.getElementById("productTotal"+i).innerHTML)
		}
	}
	grandTotal = netTotal*tax + netTotal;
	document.getElementById("subTotal").innerHTML = currency+" "+netTotal;
	document.getElementById("subtotal").value = netTotal;
	document.getElementById("grandTotalDisplay").innerHTML = currency+" "+grandTotal;
	document.getElementById("total").value = grandTotal;

}


function roundValue(val) {
   val = parseFloat(val);
   val = Math.round(val*100)/100;
   val = val.toString();
   
   if (val.indexOf(".")<0) {
      val+=".00"
   } else {
      var dec=val.substring(val.indexOf(".")+1,val.length)
      if (dec.length>2)
         val=val.substring(0,val.indexOf("."))+"."+dec.substring(0,2)
      else if (dec.length==1)
         val=val+"0"
   }
   
   return val;
} 

window.addEvent('domready', function(){ new Accordion($$('.panel h3.jpane-toggler'), $$('.panel div.jpane-slider'), {onActive: function(toggler, i) { toggler.addClass('jpane-toggler-down'); toggler.removeClass('jpane-toggler'); },onBackground: function(toggler, i) { toggler.addClass('jpane-toggler'); toggler.removeClass('jpane-toggler-down'); },duration: 300,opacity: false}); });

function alphaFilter ( selectedtype )
{
  document.adminForm.alpha.value = selectedtype ;
  document.adminForm.submit() ;
}
function checkElement(field) {
	var value = document.adminForm.getElementById(field).value;
	if (value == "") {
		document.getElementById(field+"_label").className="fieldNameRequired";
	} else {
		document.getElementById(field+"_label").className="fieldNameRequiredActive";
	}
}

function getManagerList(){

	var gid = document.getElementById("gid").value;

	var ajaxRequest;  // The variable that makes Ajax possible!
	
	try{
		// Opera 8.0+, Firefox, Safari
		ajaxRequest = new XMLHttpRequest();
	} catch (e){
		// Internet Explorer Browsers
		try{
			ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
		} catch (e) {
			try{
				ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
			} catch (e){
				// Something went wrong
				alert("Your browser broke!");
				return false;
			}
		}
	}
	
	// Create a function that will receive data sent from the server
	ajaxRequest.onreadystatechange = function(){
		
		if(ajaxRequest.readyState == 4){
			document.getElementById("managerList").innerHTML = ajaxRequest.responseText;
		} else {
			document.getElementById("managerList").innerHTML = "<img src='components/com_jaccounts/images/loader.gif'>";
		}
	}
	
	var queryString = "&task=managerList&gid=" + gid ;
	ajaxRequest.open("GET", "index.php?option=com_jaccounts&tmpl=component" + queryString, true);
	ajaxRequest.send(null); 
}
//Calendar
// Calendar: a Javascript class for Mootools that adds accessible and unobtrusive date pickers to your form elements <http://electricprism.com/aeron/calendar>
// Calendar RC4, Copyright (c) 2007 Aeron Glemann <http://electricprism.com/aeron>, MIT Style License.

var Calendar=new Class({options:{blocked:[],classes:[],days:['Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday'],direction:0,draggable:true,months:['January','February','March','April','May','June','July','August','September','October','November','December'],navigation:1,offset:0,onHideStart:Class.empty,onHideComplete:Class.empty,onShowStart:Class.empty,onShowComplete:Class.empty,pad:1,tweak:{x:0,y:0}},initialize:function(obj,options){if(!obj){return false;}
this.setOptions(options);var keys=['calendar','prev','next','month','year','today','invalid','valid','inactive','active','hover','hilite'];var values=keys.map(function(key,i){if(this.options.classes[i]){if(this.options.classes[i].length){key=this.options.classes[i];}}
return key;},this);this.classes=values.associate(keys);this.calendar=new Element('div',{'styles':{left:'-1000px',opacity:0,position:'absolute',top:'-1000px',zIndex:1000}}).addClass(this.classes.calendar).injectInside(document.body);this.calendar.coord=this.calendar.getCoordinates();if(window.ie6){this.iframe=new Element('iframe',{'styles':{height:this.calendar.coord.height+'px',left:'-1000px',position:'absolute',top:'-1000px',width:this.calendar.coord.width+'px',zIndex:999}}).injectInside(document.body);this.iframe.style.filter='progid:DXImageTransform.Microsoft.Alpha(style=0,opacity=0)';}
this.fx=this.calendar.effect('opacity',{onStart:function(){if(this.calendar.getStyle('opacity')==0){if(window.ie6){this.iframe.setStyle('display','block');}
this.calendar.setStyle('display','block');this.fireEvent('onShowStart',this.element);}
else{this.fireEvent('onHideStart',this.element);}}.bind(this),onComplete:function(){if(this.calendar.getStyle('opacity')==0){this.calendar.setStyle('display','none');if(window.ie6){this.iframe.setStyle('display','none');}
this.fireEvent('onHideComplete',this.element);}
else{this.fireEvent('onShowComplete',this.element);}}.bind(this)});if(window.Drag&&this.options.draggable){this.drag=new Drag.Move(this.calendar,{onDrag:function(){if(window.ie6){this.iframe.setStyles({left:this.calendar.style.left,top:this.calendar.style.top});}}.bind(this)});}
this.calendars=[];var id=0;var d=new Date();d.setDate(d.getDate()+this.options.direction.toInt());for(var i in obj){var cal={button:new Element('button',{'type':'button'}),el:$(i),els:[],id:id++,month:d.getMonth(),visible:false,year:d.getFullYear()};if(!this.element(i,obj[i],cal)){continue;}
cal.el.addClass(this.classes.calendar);cal.button.addClass(this.classes.calendar).addEvent('click',function(cal){this.toggle(cal);}.pass(cal,this)).injectAfter(cal.el);cal.val=this.read(cal);$extend(cal,this.bounds(cal));$extend(cal,this.values(cal));this.rebuild(cal);this.calendars.push(cal);}},blocked:function(cal){var blocked=[];var offset=new Date(cal.year,cal.month,1).getDay();var last=new Date(cal.year,cal.month+1,0).getDate();this.options.blocked.each(function(date){var values=date.split(' ');for(var i=0;i<3;i++){if(!values[i]){values[i]='*';}
values[i]=values[i].contains(',')?values[i].split(','):new Array(values[i]);}
if(values[2].contains(cal.year+'')||values[2].contains('*')){if(values[1].contains(cal.month+1+'')||values[1].contains('*')){values[0].each(function(val){if(val>0){blocked.push(val.toInt());}});if(values[3]){values[3]=values[3].contains(',')?values[3].split(','):new Array(values[3]);for(var i=0;i<last;i++){var day=(i+offset)%7;if(values[3].contains(day+'')){blocked.push(i+1);}}}}}},this);return blocked;},bounds:function(cal){var start=new Date(1000,0,1);var end=new Date(2999,11,31);var date=new Date().getDate()+this.options.direction.toInt();if(this.options.direction>0){start=new Date();start.setDate(date+this.options.pad*cal.id);}
if(this.options.direction<0){end=new Date();end.setDate(date-this.options.pad*(this.calendars.length-cal.id-1));}
cal.els.each(function(el){if(el.getTag()=='select'){if(el.format.test('(y|Y)')){var years=[];el.getChildren().each(function(option){var values=this.unformat(option.value,el.format);if(!years.contains(values[0])){years.push(values[0]);}},this);years.sort(this.sort);if(years[0]>start.getFullYear()){d=new Date(years[0],start.getMonth()+1,0);if(start.getDate()>d.getDate()){start.setDate(d.getDate());}
start.setYear(years[0]);}
if(years.getLast()<end.getFullYear()){d=new Date(years.getLast(),end.getMonth()+1,0);if(end.getDate()>d.getDate()){end.setDate(d.getDate());}
end.setYear(years.getLast());}}
if(el.format.test('(F|m|M|n)')){var months_start=[];var months_end=[];el.getChildren().each(function(option){var values=this.unformat(option.value,el.format);if($type(values[0])!='number'||values[0]==years[0]){if(!months_start.contains(values[1])){months_start.push(values[1]);}}
if($type(values[0])!='number'||values[0]==years.getLast()){if(!months_end.contains(values[1])){months_end.push(values[1]);}}},this);months_start.sort(this.sort);months_end.sort(this.sort);if(months_start[0]>start.getMonth()){d=new Date(start.getFullYear(),months_start[0]+1,0);if(start.getDate()>d.getDate()){start.setDate(d.getDate());}
start.setMonth(months_start[0]);}
if(months_end.getLast()<end.getMonth()){d=new Date(start.getFullYear(),months_end.getLast()+1,0);if(end.getDate()>d.getDate()){end.setDate(d.getDate());}
end.setMonth(months_end.getLast());}}}},this);return{'start':start,'end':end};},caption:function(cal){var navigation={prev:{'month':true,'year':true},next:{'month':true,'year':true}};if(cal.year==cal.start.getFullYear()){navigation.prev.year=false;if(cal.month==cal.start.getMonth()&&this.options.navigation==1){navigation.prev.month=false;}}
if(cal.year==cal.end.getFullYear()){navigation.next.year=false;if(cal.month==cal.end.getMonth()&&this.options.navigation==1){navigation.next.month=false;}}
if($type(cal.months)=='array'){if(cal.months.length==1&&this.options.navigation==2){navigation.prev.month=navigation.next.month=false;}}
var caption=new Element('caption');var prev=new Element('a').addClass(this.classes.prev).appendText('\x3c');var next=new Element('a').addClass(this.classes.next).appendText('\x3e');if(this.options.navigation==2){var month=new Element('span').addClass(this.classes.month).injectInside(caption);if(navigation.prev.month){prev.clone().addEvent('click',function(cal){this.navigate(cal,'m',-1);}.pass(cal,this)).injectInside(month);}
month.adopt(new Element('span').appendText(this.options.months[cal.month]));if(navigation.next.month){next.clone().addEvent('click',function(cal){this.navigate(cal,'m',1);}.pass(cal,this)).injectInside(month);}
var year=new Element('span').addClass(this.classes.year).injectInside(caption);if(navigation.prev.year){prev.clone().addEvent('click',function(cal){this.navigate(cal,'y',-1);}.pass(cal,this)).injectInside(year);}
year.adopt(new Element('span').appendText(cal.year));if(navigation.next.year){next.clone().addEvent('click',function(cal){this.navigate(cal,'y',1);}.pass(cal,this)).injectInside(year);}}
else{if(navigation.prev.month&&this.options.navigation){prev.clone().addEvent('click',function(cal){this.navigate(cal,'m',-1);}.pass(cal,this)).injectInside(caption);}
caption.adopt(new Element('span').addClass(this.classes.month).appendText(this.options.months[cal.month]));caption.adopt(new Element('span').addClass(this.classes.year).appendText(cal.year));if(navigation.next.month&&this.options.navigation){next.clone().addEvent('click',function(cal){this.navigate(cal,'m',1);}.pass(cal,this)).injectInside(caption);}}
return caption;},changed:function(cal){cal.val=this.read(cal);$extend(cal,this.values(cal));this.rebuild(cal);if(!cal.val){return;}
if(cal.val.getDate()<cal.days[0]){cal.val.setDate(cal.days[0]);}
if(cal.val.getDate()>cal.days.getLast()){cal.val.setDate(cal.days.getLast());}
cal.els.each(function(el){el.value=this.format(cal.val,el.format);},this);this.check(cal);this.calendars.each(function(kal){if(kal.visible){this.display(kal);}},this);},check:function(cal){this.calendars.each(function(kal,i){if(kal.val){var change=false;if(i<cal.id){var bound=new Date(Date.parse(cal.val));bound.setDate(bound.getDate()-(this.options.pad*(cal.id-i)));if(bound<kal.val){change=true;}}
if(i>cal.id){var bound=new Date(Date.parse(cal.val));bound.setDate(bound.getDate()+(this.options.pad*(i-cal.id)));if(bound>kal.val){change=true;}}
if(change){if(kal.start>bound){bound=kal.start;}
if(kal.end<bound){bound=kal.end;}
kal.month=bound.getMonth();kal.year=bound.getFullYear();$extend(kal,this.values(kal));kal.val=kal.days.contains(bound.getDate())?bound:null;this.write(kal);if(kal.visible){this.display(kal);}}}},this);},clicked:function(td,day,cal){cal.val=(this.value(cal)==day)?null:new Date(cal.year,cal.month,day);this.write(cal);if(!cal.val){cal.val=this.read(cal);}
if(cal.val){this.check(cal);this.toggle(cal);}
else{td.addClass(this.classes.valid);td.removeClass(this.classes.active);}},display:function(cal){this.calendar.empty();this.calendar.className=this.classes.calendar+' '+this.options.months[cal.month].toLowerCase();var div=new Element('div').injectInside(this.calendar);var table=new Element('table').injectInside(div).adopt(this.caption(cal));var thead=new Element('thead').injectInside(table);var tr=new Element('tr').injectInside(thead);for(var i=0;i<=6;i++){var th=this.options.days[(i+this.options.offset)%7];tr.adopt(new Element('th',{'title':th}).appendText(th.substr(0,1)));}
var tbody=new Element('tbody').injectInside(table);var tr=new Element('tr').injectInside(tbody);var d=new Date(cal.year,cal.month,1);var offset=((d.getDay()-this.options.offset)+7)%7;var last=new Date(cal.year,cal.month+1,0).getDate();var prev=new Date(cal.year,cal.month,0).getDate();var active=this.value(cal);var valid=cal.days;var inactive=[];var hilited=[];this.calendars.each(function(kal,i){if(kal!=cal&&kal.val){if(cal.year==kal.val.getFullYear()&&cal.month==kal.val.getMonth()){inactive.push(kal.val.getDate());}
if(cal.val){for(var day=1;day<=last;day++){d.setDate(day);if((i<cal.id&&d>kal.val&&d<cal.val)||(i>cal.id&&d>cal.val&&d<kal.val)){if(!hilited.contains(day)){hilited.push(day);}}}}}},this);var d=new Date();var today=new Date(d.getFullYear(),d.getMonth(),d.getDate()).getTime();for(var i=1;i<43;i++){if((i-1)%7==0){tr=new Element('tr').injectInside(tbody);}
var td=new Element('td').injectInside(tr);var day=i-offset;var date=new Date(cal.year,cal.month,day);var cls='';if(day===active){cls=this.classes.active;}
else if(inactive.contains(day)){cls=this.classes.inactive;}
else if(valid.contains(day)){cls=this.classes.valid;}
else if(day>=1&&day<=last){cls=this.classes.invalid;}
if(date.getTime()==today){cls=cls+' '+this.classes.today;}
if(hilited.contains(day)){cls=cls+' '+this.classes.hilite;}
td.addClass(cls);if(valid.contains(day)){td.setProperty('title',this.format(date,'D M jS Y'));td.addEvents({'click':function(td,day,cal){this.clicked(td,day,cal);}.pass([td,day,cal],this),'mouseover':function(td,cls){td.addClass(cls);}.pass([td,this.classes.hover]),'mouseout':function(td,cls){td.removeClass(cls);}.pass([td,this.classes.hover])});}
if(day<1){day=prev+day;}
else if(day>last){day=day-last;}
td.appendText(day);}},element:function(el,f,cal){if($type(f)=='object'){for(var i in f){if(!this.element(i,f[i],cal)){return false;}}
return true;}
el=$(el);if(!el){return false;}
el.format=f;if(el.getTag()=='select'){el.addEvent('change',function(cal){this.changed(cal);}.pass(cal,this));}
else{el.readOnly=true;el.addEvent('focus',function(cal){this.toggle(cal);}.pass(cal,this));}
cal.els.push(el);return true;},format:function(date,f){var g='';if(date){var d=date.getDate();var day=this.options.days[date.getDay()];var m=date.getMonth()+1;var month=this.options.months[date.getMonth()];var y=date.getFullYear()+'';for(var i=0;i<f.length;i++){var c=f.charAt(i);switch(c){case'y':y=y.substr(2);case'Y':g+=y;break;case'm':if(m<10){m='0'+m;}
case'n':g+=m;break;case'M':month=month.substr(0,3);case'F':g+=month;break;case'd':if(d<10){d='0'+d;}
case'j':g+=d;break;case'D':day=day.substr(0,3);case'l':g+=day;break;case'S':if(d%10==1&&d!='11'){g+='st';}
else if(d%10==2&&d!='12'){g+='nd';}
else if(d%10==3&&d!='13'){g+='rd';}
else{g+='th';}
break;default:g+=c;}}}
return g;},navigate:function(cal,type,n){switch(type){case'm':if($type(cal.months)=='array'){var i=cal.months.indexOf(cal.month)+n;if(i<0||i==cal.months.length){if(this.options.navigation==1){this.navigate(cal,'y',n);}
i=(i<0)?cal.months.length-1:0;}
cal.month=cal.months[i];}
else{var i=cal.month+n;if(i<0||i==12){if(this.options.navigation==1){this.navigate(cal,'y',n);}
i=(i<0)?11:0;}
cal.month=i;}
break;case'y':if($type(cal.years)=='array'){var i=cal.years.indexOf(cal.year)+n;cal.year=cal.years[i];}
else{cal.year+=n;}
break;}
$extend(cal,this.values(cal));if($type(cal.months)=='array'){var i=cal.months.indexOf(cal.month);if(i<0){cal.month=cal.months[0];}}
this.display(cal);},read:function(cal){var arr=[null,null,null];cal.els.each(function(el){var values=this.unformat(el.value,el.format);values.each(function(val,i){if($type(val)=='number'){arr[i]=val;}});},this);if($type(arr[0])=='number'){cal.year=arr[0];}
if($type(arr[1])=='number'){cal.month=arr[1];}
var val=null;if(arr.every(function(i){return $type(i)=='number';})){var last=new Date(arr[0],arr[1]+1,0).getDate();if(arr[2]>last){arr[2]=last;}
val=new Date(arr[0],arr[1],arr[2]);}
return(cal.val==val)?null:val;},rebuild:function(cal){cal.els.each(function(el){if(el.getTag()=='select'&&el.format.test('^(d|j)$')){var d=this.value(cal);if(!d){d=el.value.toInt();}
el.empty();cal.days.each(function(day){var option=new Element('option',{'selected':(d==day),'value':((el.format=='d'&&day<10)?'0'+day:day)}).appendText(day).injectInside(el);},this);}},this);},sort:function(a,b){return a-b;},toggle:function(cal){document.removeEvent('mousedown',this.fn);if(cal.visible){cal.visible=false;cal.button.removeClass(this.classes.active);this.fx.start(1,0);}
else{this.fn=function(e,cal){var e=new Event(e);var el=e.target;var stop=false;while(el!=document.body&&el.nodeType==1){if(el==this.calendar){stop=true;}
this.calendars.each(function(kal){if(kal.button==el||kal.els.contains(el)){stop=true;}});if(stop){e.stop();return false;}
else{el=el.parentNode;}}
this.toggle(cal);}.create({'arguments':cal,'bind':this,'event':true});document.addEvent('mousedown',this.fn);this.calendars.each(function(kal){if(kal==cal){kal.visible=true;kal.button.addClass(this.classes.active);}
else{kal.visible=false;kal.button.removeClass(this.classes.active);}},this);var size=window.getSize().scrollSize;var coord=cal.button.getCoordinates();var x=coord.right+this.options.tweak.x;var y=coord.top+this.options.tweak.y;if(x+this.calendar.coord.width>size.x){x-=(x+this.calendar.coord.width-size.x);}
if(y+this.calendar.coord.height>size.y){y-=(y+this.calendar.coord.height-size.y);}
this.calendar.setStyles({left:x+'px',top:y+'px'});if(window.ie6){this.iframe.setStyles({left:x+'px',top:y+'px'});}
this.display(cal);this.fx.start(0,1);}},unformat:function(val,f){f=f.escapeRegExp();var re={d:'([0-9]{2})',j:'([0-9]{1,2})',D:'('+this.options.days.map(function(day){return day.substr(0,3);}).join('|')+')',l:'('+this.options.days.join('|')+')',S:'(st|nd|rd|th)',F:'('+this.options.months.join('|')+')',m:'([0-9]{2})',M:'('+this.options.months.map(function(month){return month.substr(0,3);}).join('|')+')',n:'([0-9]{1,2})',Y:'([0-9]{4})',y:'([0-9]{2})'}
var arr=[];var g='';for(var i=0;i<f.length;i++){var c=f.charAt(i);if(re[c]){arr.push(c);g+=re[c];}
else{g+=c;}}
var matches=val.match('^'+g+'$');var dates=new Array(3);if(matches){matches=matches.slice(1);arr.each(function(c,i){i=matches[i];switch(c){case'y':i='19'+i;case'Y':dates[0]=i.toInt();break;case'F':i=i.substr(0,3);case'M':i=this.options.months.map(function(month){return month.substr(0,3);}).indexOf(i)+1;case'm':case'n':dates[1]=i.toInt()-1;break;case'd':case'j':dates[2]=i.toInt();break;}},this);}
return dates;},value:function(cal){var day=null;if(cal.val){if(cal.year==cal.val.getFullYear()&&cal.month==cal.val.getMonth()){day=cal.val.getDate();}}
return day;},values:function(cal){var years,months,days;cal.els.each(function(el){if(el.getTag()=='select'){if(el.format.test('(y|Y)')){years=[];el.getChildren().each(function(option){var values=this.unformat(option.value,el.format);if(!years.contains(values[0])){years.push(values[0]);}},this);years.sort(this.sort);}
if(el.format.test('(F|m|M|n)')){months=[];el.getChildren().each(function(option){var values=this.unformat(option.value,el.format);if($type(values[0])!='number'||values[0]==cal.year){if(!months.contains(values[1])){months.push(values[1]);}}},this);months.sort(this.sort);}
if(el.format.test('(d|j)')&&!el.format.test('^(d|j)$')){days=[];el.getChildren().each(function(option){var values=this.unformat(option.value,el.format);if(values[0]==cal.year&&values[1]==cal.month){if(!days.contains(values[2])){days.push(values[2]);}}},this);}}},this);var first=1;var last=new Date(cal.year,cal.month+1,0).getDate();if(cal.year==cal.start.getFullYear()){if(months==null&&this.options.navigation==2){months=[];for(var i=0;i<12;i++){if(i>=cal.start.getMonth()){months.push(i);}}}
if(cal.month==cal.start.getMonth()){first=cal.start.getDate();}}
if(cal.year==cal.end.getFullYear()){if(months==null&&this.options.navigation==2){months=[];for(var i=0;i<12;i++){if(i<=cal.end.getMonth()){months.push(i);}}}
if(cal.month==cal.end.getMonth()){last=cal.end.getDate();}}
var blocked=this.blocked(cal);if($type(days)=='array'){days=days.filter(function(day){if(day>=first&&day<=last&&!blocked.contains(day)){return day;}});}
else{days=[];for(var i=first;i<=last;i++){if(!blocked.contains(i)){days.push(i);}}}
days.sort(this.sort);return{'days':days,'months':months,'years':years};},write:function(cal){this.rebuild(cal);cal.els.each(function(el){el.value=this.format(cal.val,el.format);},this);}});Calendar.implement(new Events,new Options);