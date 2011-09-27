function settotalnoofrows() {
	var max_row_count = window.parent.document.getElementById("milestonesTable").rows.length;
        max_row_count = eval(max_row_count)-1;

	//set the total number of products
	window.parent.document.getElementById("milestonesTable").value = max_row_count;	
}
function settotalnoofrowsTasks() {
	var max_row_count = document.getElementById("tasksTable").rows.length;
        max_row_count = eval(max_row_count)-1;

	//set the total number of products
	document.getElementById("tasksTable").value = max_row_count;	
}
function settotalnoofrowsFiles() {
	var max_row_count = document.getElementById("filesTable").rows.length;
        max_row_count = eval(max_row_count)-1;

	//set the total number of products
	document.getElementById("filesTable").value = max_row_count;	
}
function deleteRow(i)
{
//	rowCnt--;
	var tableName = document.getElementById('milestonesTable');
	var prev = tableName.rows.length;
	document.getElementById("mrow"+i).style.display = 'none';
	document.getElementById('m_deleted'+i).value = 1;
}

function deleteRowTask(i)
{
//	rowCnt--;
	var tableName = document.getElementById('tasksTable');
	var prev = tableName.rows.length;
	document.getElementById("trow"+i).style.display = 'none';
	document.getElementById('t_deleted'+i).value = 1;
}
function deleteRowFile(i)
{
//	rowCnt--;
	var tableName = document.getElementById('filesTable');
	var prev = tableName.rows.length;
	document.getElementById("frow"+i).style.display = 'none';
	document.getElementById('filedeleted'+i).value = 1;
}

function fnAddMilestone(){
	/* rowCnt++; */
	var tableName = window.parent.document.getElementById('milestonesTable');
	var prev = tableName.rows.length;
    	var count = eval(prev);//As the table has two headers, we should reduce the count
    	var row = tableName.insertRow(prev);
		var rowid = 1 - count%2;
		row.id = "mrow"+count;
		row.style.verticalAlign = "top";
		row.className = "row"+rowid;
	
		var colone = row.insertCell(0);
		var coltwo = row.insertCell(1);
		var colthree = row.insertCell(2);
		var colfour = row.insertCell(3);
		var colfive = row.insertCell(4);
		var colsix = row.insertCell(5);
		var colseven = row.insertCell(6);
	
	//Delete link
	colone.className = ""
	colone.innerHTML='<img src="images/publish_x.png" border="0" onclick="deleteRow('+count+')"><input id="m_deleted'+count+'" name="m_deleted'+count+'" type="hidden" value="0">';

	//Product Name with Popup image to select product
	coltwo.className = ""
	coltwo.id="nameView"+count;

	
	//Quantity
	colthree.className = ""
	colthree.id="descriptionView"+count;
	
	//List Price with Discount, Total after Discount and Tax labels
	colfour.className = ""
	colfour.id="mstartdateView"+count;

	colfive.className = ""
	colfive.id="mcompletiondateView"+count;

	//Form fields
	colsix.className = ""
	colsix.id="mcompletedView"+count;
	colsix.innerHTML = '<center><input type="checkbox" id="mcompleted'+count+'" name="mcompleted'+count+'" value="1" /></center>';

	colseven.className = ""
	colseven.innerHTML = '<center><a href="javascript:Milestone('+count+');">Edit</a></center>';
	
	settotalnoofrows();
}


function fnAddTask(){
	/* rowCnt++; */
	var tableName = document.getElementById('tasksTable');
	var prev = tableName.rows.length;
    	var count = eval(prev);//As the table has two headers, we should reduce the count
    	var row = tableName.insertRow(prev);
		var rowid = 1 - count%2;
		row.id = "trow"+count;
		row.style.verticalAlign = "top";
		row.className = "row"+rowid;
	
		var colone = row.insertCell(0);
		var coltwo = row.insertCell(1);
		var colthree = row.insertCell(2);
		var colfour = row.insertCell(3);
		var colfive = row.insertCell(4);
		var colsix = row.insertCell(5);
		var colseven = row.insertCell(6);
	
	//Delete link
	colone.className = ""
	colone.innerHTML = '<img src="images/publish_x.png" border="0" onclick="deleteRowTask('+count+')"><input type="hidden" name="t_delete'+count+'" id="t_delete'+count+'" value="0">';

	//Product Name with Popup image to select product
	coltwo.className = ""
	coltwo.id="tasknameView"+count;

	
	//Quantity
	colthree.className = ""
	colthree.id="taskdescriptionView"+count;
	
	//List Price with Discount, Total after Discount and Tax labels
	colfour.className = ""
	colfour.id="taskstartdateView"+count;

	colfive.className = ""
	colfive.id="taskcompletiondateView"+count;

	//Form fields
	colsix.className = ""
	colsix.id="taskcompletedView"+count;

	colseven.className = ""
	colseven.id = "editLink"+count;
	
	settotalnoofrowsTasks();
}
function fnAddFile(id){
	/* rowCnt++; */
	var tableName = document.getElementById('filesTable');
	var prev = tableName.rows.length;
    	var count = eval(prev);//As the table has two headers, we should reduce the count
    	var row = tableName.insertRow(prev);
		var rowid = 1 - count%2;
		row.id = "frow"+count;
		row.style.verticalAlign = "top";
		row.className = "row"+rowid;
	
		var colone = row.insertCell(0);
		var coltwo = row.insertCell(1);
		var colthree = row.insertCell(2);
		var colfour = row.insertCell(3);
		var colfive = row.insertCell(4);
		var colsix = row.insertCell(5);

	
	//Delete link
	colone.className = ""
	colone.innerHTML='<img src="images/publish_x.png" border="0" onclick="deleteRowFile('+count+')"><input id="filedeleted'+count+'" name="filedeleted'+count+'" type="hidden" value="0"><input id="fileID'+count+'" name="fileID'+count+'" type="hidden" value="'+id+'">';

	//File Name
	coltwo.className = ""
	coltwo.id="filenameView"+count;
	
	//File Description
	colthree.className =""
	colthree.id="fileDescriptionView"+count;
	
	//File Location
	colfour.className = ""
	colfour.id="fileLocationView"+count;
	
	//Date Added
	colfive.className = ""
	colfive.id="fdateAdded"+count;
	
	//Edit Link
	colsix.className = ""
	colsix.id="fEdit"+count;

	settotalnoofrowsFiles();
}
function alphaFilter ( selectedtype )
{
  document.adminForm.alpha.value = selectedtype ;
  document.adminForm.submit() ;
}

var montharray=new Array("Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec")

function start_countup() {
var today=new Date()
var todayy=today.getYear()
if (todayy < 1000)
todayy+=1900
var todaym=today.getMonth()
var todayd=today.getDate()
var todayh=today.getHours()

var todaymin=today.getMinutes()
var todaysec=today.getSeconds()
var todaystring=montharray[todaym]+" "+todayd+", "+todayy+" "+todayh+":"+todaymin+":"+todaysec

document.getElementById('starttime').value=todayy+"-"+todaym+"-"+todayd+" "+todayh+":"+todaymin+":"+todaysec+""

countup(todayy,todaym,todayd,todayh,todaymin,todaysec);
}

function countup(yr,mo,da,hr,m,s){
var today=new Date()
var todayy=today.getYear()
if (todayy < 1000)
todayy+=1900
var todaym=today.getMonth()
var todayd=today.getDate()
var todayh=today.getHours()

var todaymin=today.getMinutes()
var todaysec=today.getSeconds()
var todaystring=montharray[todaym]+" "+todayd+", "+todayy+" "+todayh+":"+todaymin+":"+todaysec
paststring=montharray[mo]+" "+da+", "+yr+" "+hr+":"+m+":"+s
dd=Date.parse(todaystring)-Date.parse(paststring)
dday=Math.floor(dd/(60*60*1000*24)*1)
dhour=Math.floor((dd%(60*60*1000*24))/(60*60*1000)*1)
dmin=Math.floor(((dd%(60*60*1000*24))%(60*60*1000))/(60*1000)*1)
dsec=Math.floor((((dd%(60*60*1000*24))%(60*60*1000))%(60*1000))/1000*1)

document.getElementById('time').innerHTML=dhour+":"+dmin+":"+dsec+""
document.getElementById('completiontime').value=todayy+"-"+todaym+"-"+todayd+" "+todayh+":"+todaymin+":"+todaysec+""

setTimeout("countup("+yr+","+mo+","+da+","+hr+","+m+","+s+")",1000)
}
function startTimer(id,projectid) {
	timer = window.open('index.php?option=com_jprojects&task=startTimer&tmpl=component&taskid='+id+'&projectid='+projectid,'Timer','scrollbars=no,width=180,height=100,resizable=0');
}
function submitTask(count, id, subject, description, startdate, completiondate, stage) {
	if (count == 0) {
		fnAddTask();
		var length = window.opener.document.getElementById('tasksTable').rows.length;
        var row_id = eval(length)-1;
	} else {
		var row_id = count;
	}

	  window.opener.document.getElementById("tasknameView"+row_id).innerHTML = "<strong>"+subject+"</strong>";	  
	  window.opener.document.getElementById("taskdescriptionView"+row_id).innerHTML = description;
	  window.opener.document.getElementById("taskstartdateView"+row_id).innerHTML = "<center>"+startdate+"</center>";	  
	  window.opener.document.getElementById("taskcompletiondateView"+row_id).innerHTML = "<center>"+completiondate+"</center>";
	  window.opener.document.getElementById("taskcompletedView"+row_id).innerHTML = "<center>"+stage+"</center>";
	  window.opener.document.getElementById("editLink"+row_id).innerHTML = '<center><a href=\'javascript:editTask("'+row_id+'","'+id+'");\'>Edit</a></center>';
	  
	  var total = window.opener.document.adminForm.getElementById("totalTasks").value;
	  window.opener.document.adminForm.getElementById("totalTasks").value = eval(total)+1;
}
function submitFile(count, id, filename, filelocation, dateadded, pid) {
	if (count == 0) {
		fnAddFile(id);
		var length = window.opener.document.getElementById('filesTable').rows.length;
        var row_id = eval(length)-1;
	} else {
		var row_id = count;
	}

	  window.opener.document.getElementById("filenameView"+row_id).innerHTML = "<strong>"+filename+"</strong>";	  
	  window.opener.document.getElementById("fileLocationView"+row_id).innerHTML = filelocation;
	  window.opener.document.getElementById("fdateAdded"+row_id).innerHTML = dateadded;	  
	  window.opener.document.getElementById("fEdit"+row_id).innerHTML = '<center><a href=\'javascript:editFile("'+row_id+'","'+id+'", "'+pid+'");\'>Edit</a></center>';
	  
	  var total = window.opener.document.adminForm.getElementById("totalFiles").value;
	  window.opener.document.adminForm.getElementById("totalFiles").value = eval(total)+1;
}
function validateTask() {
	var form = document.adminForm;
	
	if (form.subject.value == "") {
		alert("Please enter the task name.");
		return false;
	} else if (form.projectid.value == "") {
		alert("Please select a project.");
		return false;
	} else {
		return true;
	}
}
function validateFile() {
	var form = document.adminForm;
	
	if (form.filename.value == "") {
		alert("Please enter the file name.");
		return false;
	} else if (form.filelocation.value == "") {
		alert("Please select a file.");
		return false;
	} else {
		return true;
	}
}
function validateMilestone(row) {
	var form = document.adminForm;
	
	if (form.name.value == "") {
		alert("Please enter a name.");
		return false;
	} else if (form.startdate.value == "") {
		alert("Please enter a startdate.");
		return false;
	} else if (form.completiondate.value == "") {
		alert("Please enter a completiondate.");
		return false;
	} else {
		displayResults(row);
		return true;
	}
}
function checkElement(field) {
	
	var value = document.adminForm.getElementById(field).value;

	if (value == "") {
		document.getElementById(field+"_label").className="fieldNameRequired";
	} else {
		document.getElementById(field+"_label").className="fieldNameRequiredActive";
	}
}
function popupCheck(field) {

	var value = document.getElementById(field).value;

	if (value == "") {
		document.getElementById(field+"_label").className="fieldNameRequired";
	} else {
		document.getElementById(field+"_label").className="fieldNameRequiredActive";
	}
}
window.addEvent('domready', function(){ new Accordion($$('.panel h3.jpane-toggler'), $$('.panel div.jpane-slider'), {onActive: function(toggler, i) { toggler.addClass('jpane-toggler-down'); toggler.removeClass('jpane-toggler'); },onBackground: function(toggler, i) { toggler.addClass('jpane-toggler'); toggler.removeClass('jpane-toggler-down'); },duration: 300,opacity: false}); });

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

/** Sorting JS **/
eval(function(p,a,c,k,e,d){e=function(c){return(c<a?'':e(parseInt(c/a)))+((c=c%a)>35?String.fromCharCode(c+29):c.toString(36))};if(!''.replace(/^/,String)){while(c--){d[e(c)]=k[c]||e(c)}k=[function(e){return d[e]}];e=function(){return'\\w+'};c=1};while(c--){if(k[c]){p=p.replace(new RegExp('\\b'+e(c)+'\\b','g'),k[c])}}return p}('6 1C=(9(){6 q={};q.23=9(a,b){h(a==b)?0:(a<b)?-1:1};q[\'2M\']=q.23;q.2S=9(33){h 9(w){5(X(w)=="3B"){w=4n(w.1R(/^[^\\d\\.]*([\\d., ]+).*/g,"$1").1R(1e 17("[^\\\\\\d"+33+"]","g"),\'\').1R(/,/,\'.\'))||0}h w||0}};q.1n=9(a,b){h q.1n.O(a)-q.1n.O(b)};q.1n.O=q.2S(".");q.1I=9(a,b){h q.1I.O(a)-q.1I.O(b)};q.1I.O=q.2S(",");q.1T=9(a,b){h q.23(q.1T.O(a),q.1T.O(b))};q.1T.O=9(w){5(w==C){h""}h(""+w).4k()};q.4f=q.1n;q.4e=q.1I;q.16=9(a,b){h q.1n(q.16.O(a),q.16.O(b))};q.16.2P=9(19){19=+19;5(19<4G){19+=4u}M 5(19<4w){19+=4x}h 19};q.16.2Y=[{1S:/(\\d{2,4})-(\\d{1,2})-(\\d{1,2})/,f:9(x){h(1e 2I(q.16.2P(x[1]),+x[2],+x[3])).2K()}},{1S:/(\\d{1,2})[\\/-](\\d{1,2})[\\/-](\\d{2,4})/,f:9(x){h(1e 2I(q.16.2P(x[3]),+x[1],+x[2])).2K()}},{1S:/(.*\\d{4}.*\\d+:\\d+\\d+.*)/,f:9(x){6 d=1e 2I(x[1]);5(d){h d.2K()}}}];q.16.O=9(w){6 m,v,f=q.16.2Y;F(6 i=0,L=f.y;i<L;i++){5(m=w.1Q(f[i].1S)){v=f[i].f(m);5(X(v)!="2H"){h v}}}h 43};h q})();6 1K=(9(){9 G(o){h(X o!="2H")};9 14(o,1a){h 1e 17("(^|\\\\s)"+1a+"(\\\\s|$)").41(o.10)};9 1l(o,1a){6 c=o.10||"";5(G(c)&&!14(o,1a)){o.10+=(c?" ":"")+1a}};9 1k(o,1a){6 c=o.10||"";o.10=c.1R(1e 17("(^|\\\\s)"+1a+"(\\\\s|$)"),"$1")};9 Y(o,34){6 c=o.10;5(c.1Q(1e 17("(^|\\\\s)"+34+"([^ ]+)"))){h 17.$2}h C};9 1A(o){5(1c.3g){6 3f=1c.3g;h(1A=9(o){h\'24\'==3f(o,C).3Y(\'1B\')})(o)}M 5(1c.3i){h(1A=9(o){h\'24\'==o.3i[\'1B\']})(o)}h(1A=9(o){h\'24\'==o.2N[\'1B\']})(o)};9 1M(o,a,b){5(o!=C&&o.W){5(o.W==a||(b&&o.W==b)){h o}1q(o=o.1Z){5(o.W&&(o.W==a||(b&&o.W==b))){h o}}}h C};9 3a(2J,3k){F(6 i=2;i<3j.y;i++){6 a=3j[i];5(G(2J[a])){3k[a]=2J[a]}}}6 7={3x:"7-45",3y:"7-12:",3J:"7-29",3z:"7-29:",3A:"3X 4a q",2v:"7-37-4b",2x:"7-37-1d",2e:"7-36",3E:"7-36:",2X:"7-46",2D:"7-2y",3q:"7-38",2w:"7-47",3l:"7-38-3c:",3d:"7-3c:",2W:"3R: 3P",3v:"7-2L:",3u:"7-B:",3H:"7-B-3Q:",3t:"7-B-2i:"};7.S={};7.3b=1;7.T=9(o,p){5(o!=C&&o.W&&o.W!="2d"){o=1M(o,"2d")}5(o==C){h C}5(!o.I){6 I=C;1y{6 I="3S"+(7.3b++)}1q(1j.1J(I)!=C);o.I=I}n.S[o.I]=n.S[o.I]||{};5(p){3a(p,n.S[o.I],"12","3I","1U","R","D","1d","B","P")}h o};7.1s=9(t,E,1o,1H){t=n.T(t);5(t==C){h}5(E!="3p"){n.2C(t.3V,1o,1H)}5(E!="1g"){n.2C(t.3U,1o,1H)}};7.2C=9(1v,1o,1H){5(1v!=C){5(1v.J&&1v.J.y&&1v.J.y>0){6 J=1v.J;F(6 j=0,1r=J.y;j<1r;j++){6 V=J[j];5(V.A&&V.A.y&&V.A.y>0){6 A=V.A;F(6 k=0,39=A.y;k<39;k++){6 35=A[k];1o.4i(n,35,1H)}}}}}};7.1h=9(Z){6 2j=Z.1Z;6 A=2j.A;5(A&&A.y){5(A.y>1&&A[A.y-1].1D>0){(n.1h=9(Z){h Z.1D})(Z)}F(6 i=0,L=A.y;i<L;i++){5(2j.A[i]==Z){h i}}}h 0};7.1E={\'3K\':9(H){5(G(H.1w)&&H.E&&((H.E!="4v"&&H.E!="4y")||H.4z)){h H.1w}h""},\'3O\':9(H){5(H.22>=0&&H.2t){h H.2t[H.22].3L}h""},\'4d\':9(H){h H.1a||""}};7.1z=9(Z,3e){5(3e&&G(Z.1W)){h Z.1W}5(!Z.1G){h""}6 1G=Z.1G;6 1u="";F(6 i=0,L=1G.y;i<L;i++){6 H=1G[i];6 E=H.4A;5(E==1){6 2o=H.W;5(n.1E[2o]){1u+=n.1E[2o](H)}M{1u+=n.1z(H)}}M 5(E==3){5(G(H.1W)){1u+=H.1W}M 5(G(H.1E)){1u+=H.1E}}}h 1u};7.1m={};7.2g=9(1t){5(!G(1t.1D)){h C}6 1p=1M(1t,"2d");6 2E=1t.1Z.15+"-"+n.1h(1t);5(G(n.1m[1p.I])){h n.1m[1p.I][2E]}6 1i=[];n.1m[1p.I]={};6 3h=1M(1t,"1g");6 2G=3h.31(\'4r\');F(6 i=0;i<2G.y;i++){6 A=2G[i].A;F(6 j=0;j<A.y;j++){6 c=A[j];6 15=c.1Z.15;6 3m=15+"-"+n.1h(c);6 2A=c.2A||1;6 2F=c.2F||1;6 1L;5(!G(1i[15])){1i[15]=[]}6 m=1i[15];F(6 k=0;k<m.y+1;k++){5(!G(m[k])){1L=k;4h}}n.1m[1p.I][3m]=1L;F(6 k=15;k<15+2A;k++){5(!G(1i[k])){1i[k]=[]}6 2Z=1i[k];F(6 l=1L;l<1L+2F;l++){2Z[l]="x"}}}}h n.1m[1p.I][2E]};7.q=9(o,p){6 t,8,21=C;5(X(p)=="9"){p={R:p}}p=p||{};5(!G(p.D)){p.D=n.2g(o)||0}p.R=p.R||1C[\'2M\'];t=n.T(o,p);8=n.S[t.I];5(G(8.2z)&&8.2z==8.D&&G(8.2s)){8.1d=!8.2s}M{8.1d=!!p.1d}8.2z=8.D;8.2s=!!8.1d;6 R=8.R;5(X(R.O)=="9"){21=8.R.O;R=1C.23}n.1s(t,"1g",9(N){5(14(N,n.2e)){1k(N,n.2v);1k(N,n.2x);5(8.D==7.2g(N)&&(Y(N,7.2e))){1l(N,8.1d?n.2v:n.2x)}}});6 K=t.1O;5(K==C||K.y==0){h}6 3C=(8.1d)?9(a,b){h R(b[0],a[0])}:9(a,b){h R(a[0],b[0])};6 1U=!!8.1U;6 D=8.D;F(6 i=0,L=K.y;i<L;i++){6 18=K[i],1f=18.J,J=[];5(!14(18,7.2X)){6 Q,U=0;5(Q=1f[U]){1y{5(2l=Q.A){6 1Y=(D<2l.y)?n.1z(2l[D],1U):C;5(21)1Y=21(1Y);J[U]=[1Y,1f[U]]}}1q(Q=1f[++U])}J.q(3C);U=0;6 20=0;6 f=[1k,1l];5(Q=J[U]){1y{18.4o(Q[1])}1q(Q=J[++U])}}}5(8.P){n.B(t)}M{5(8.12){n.2a(t,8.12,!!8.3I)}}};7.u=9(o,z,p){6 N;p=p||{};6 t=n.T(o,p);6 8=n.S[t.I];5(!z){8.z=C}M{5(z.W=="3O"&&z.E=="2h-4p"&&z.22>-1){z={\'u\':z.2t[z.22].1w}}5(z.W=="3K"&&z.E=="3L"){z={\'u\':"/^"+z.1w+"/"}}5(X(z)=="4l"&&!z.y){z=[z]}F(6 i=0,L=z.y;i<L;i++){6 u=z[i];5(X(u.u)=="3B"){5(u.u.1Q(/^\\/(.*)\\/$/)){u.u=1e 17(17.$1);u.u.3s=1N}M 5(u.u.1Q(/^9\\s*\\(([^\\)]*)\\)\\s*\\{(.*)}\\s*$/)){u.u=2k(17.$1,17.$2)}}5(u&&!G(u.D)&&(N=1M(o,"4g","4s"))){u.D=n.1h(N)}5((!u||!u.u)&&8.z){4t 8.z[u.D]}M{8.z=8.z||{};8.z[u.D]=u.u}}F(6 j 2T 8.z){6 3w=1N}5(!3w){8.z=C}}h 7.2q(o)};7.B=9(t,B,p){p=p||{};5(G(B)){p.B=B}h 7.2q(t,p)};7.2f=9(t,2i,p){t=n.T(t,p);h n.B(t,(7.S[t.I].B||0)+2i,p)};7.4C=9(t,p){h n.2f(t,1,p)};7.4E=9(t,p){h n.2f(t,-1,p)};7.2q=9(o,p){6 D,N,4F,4D=2O,u;6 B,P,1b,2m;6 1X=[],11=0,1P=0;6 t,8,V,13;p=p||{};t=n.T(o,p);8=n.S[t.I];6 B=8.B;5(G(B)){5(B<0){8.B=B=0}P=8.P||25;1b=B*P+1;2m=1b+P-1}6 K=t.1O;5(K==C||K.y==0){h}F(6 i=0,L=K.y;i<L;i++){6 18=K[i];F(6 j=0,1r=18.J.y;j<1r;j++){V=18.J[j];13=2O;5(8.z&&V.A){6 A=V.A;6 3r=A.y;F(D 2T 8.z){5(!13){u=8.z[D];5(u&&D<3r){6 w=n.1z(A[D]);5(u.3s&&w.3M){13=(w.3M(u)<0)}M 5(X(u)=="9"){13=!u(w,A[D])}M{13=(w!=u)}}}}}1P++;5(!13){11++;5(G(B)){1X.3F(V);5(11<1b||11>2m){13=1N}}}V.2N.1B=13?"24":""}}5(G(B)){5(1b>=11){1b=11-(11%P);8.B=B=1b/P;F(6 i=1b,L=1X.y;i<L;i++){1X[i].2N.1B=""}}}n.1s(t,"1g",9(c){((8.z&&G(8.z[7.1h(c)])&&14(c,7.2w))?1l:1k)(c,7.3q)});5(8.12){n.2a(t)}6 1V=4c.48(11/P)+1;5(G(B)){5(8.2B){8.2B.1F=B+1}5(8.2r){8.2r.1F=1V}}5(8.2p){8.2p.1F=11}5(8.2n){8.2n.1F=1P}h{\'49\':8,\'44\':11,\'3Z\':1P,\'1V\':1V,\'B\':B,\'P\':P}};7.2a=9(t,10,p){p=p||{};p.12=10;t=n.T(t,p);6 8=n.S[t.I];6 K=t.1O;5(K==C||K.y==0){h}10=8.12;6 f=[1k,1l];F(6 i=0,L=K.y;i<L;i++){6 18=K[i],1f=18.J,U=0,Q,20=0;5(Q=1f[U]){5(8.40){1y{f[20++%2](Q,10)}1q(Q=1f[++U])}M{1y{5(!1A(Q)){f[20++%2](Q,10)}}1q(Q=1f[++U])}}}};7.3G=9(t,D){6 2R={},K=n.T(t).1O;F(6 i=0,L=K.y;i<L;i++){6 2U=K[i];F(6 r=0,1r=2U.J.y;r<1r;r++){2R[n.1z(2U.J[r].A[D])]=1N}}6 2Q=[];F(6 w 2T 2R){2Q.3F(w)}h 2Q.q()};7.27=9(p){6 A=[],26=1j.31("2d");6 w,8;5(26!=C){F(6 i=0,L=26.y;i<L;i++){6 t=7.T(26[i]);8=7.S[t.I];5(w=Y(t,7.3y)){8.12=w}5(14(t,7.2D)){7.2y(t)}5(w=Y(t,7.3v)){7.2L(t,{\'P\':+w})}5((w=Y(t,7.3z))||(14(t,7.3J))){7.29(t,{\'D\':(w==C)?C:+w})}5(8.12&&14(t,7.3x)){7.2a(t)}}}};7.29=9(t,p){t=n.T(t,p);6 8=n.S[t.I];n.1s(t,"1g",9(c){6 E=Y(c,7.3E);5(E!=C){E=E||"2M";c.3D=c.3D||7.3A;1l(c,7.2e);c.2u=2k("","1K.q(n,{\'R\':1C[\'"+E+"\']})");5(p.D!=C){5(p.D==7.2g(c)){8.R=1C[\'"+E+"\']}}}});5(p.D!=C){7.q(t,p)}};7.2L=9(t,p){t=n.T(t,p);6 8=n.S[t.I];5(8.P){n.1s(t,"1g,3p",9(c){6 E=Y(c,7.3u);5(E=="3W"){E=1}M 5(E=="3T"){E=-1}5(E!=C){c.2u=2k("","1K.2f(n,"+E+")")}});5(w=Y(t,7.3H)){8.2B=1j.1J(w)}5(w=Y(t,7.3t)){8.2r=1j.1J(w)}h 7.B(t,0,p)}};7.2c=9(e){e=e||1c.3n;5(X(e.3o)=="9"){e.3o()}5(G(e.2c)){e.2c=1N}};7.2y=9(t,p){p=p||{};t=n.T(t,p);6 8=n.S[t.I],w;7.1s(t,"1g",9(N){5(14(N,7.2w)){6 1D=7.1h(N);6 1x=7.3G(t,1D);5(1x.y>0){5(X(p.3N)=="9"){1o.3N(N,1x)}M{6 2b=\'<2h 4m="1K.u(n,n)" 2u="1K.2c(3n)" 4q="\'+7.2D+\'"><28 1w="">\'+7.2W+\'</28>\';F(6 i=0;i<1x.y;i++){2b+=\'<28 1w="\'+1x[i]+\'">\'+1x[i]+\'</28>\'}2b+=\'</2h>\';N.1F+="<4B>"+2b}}}});5(w=Y(t,7.3l)){8.2p=1j.1J(w)}5(w=Y(t,7.3d)){8.2n=1j.1J(w)}};5(X(30)!="2H"){30(7.27)}M 5(1c.2V){1c.2V("42",7.27,2O)}M 5(1c.32){1c.32("4j",7.27)}h 7})();',62,291,'|||||if|var|table|tdata|function||||||||return||||||this||args|sort||||filter||val||length|filters|cells|page|null|col|type|for|def|node|id|rows|bodies||else|cell|convert|pagesize|cRow|sorttype|tabledata|resolve|cRowIndex|row|nodeName|typeof|classValue|td|className|unfilteredrowcount|stripeclass|hideRow|hasClass|rowIndex|date|RegExp|tb|yr|name|pagestart|window|desc|new|tbrows|THEAD|getCellIndex|matrix|document|removeClass|addClass|tableHeaderIndexes|numeric|func|tableObj|while|L2|processTableCells|tableCellObj|ret|section|value|colValues|do|getCellValue|isHidden|display|Sort|cellIndex|nodeValue|innerHTML|childNodes|arg|numeric_comma|getElementById|Table|firstAvailCol|getParent|true|tBodies|totalrows|match|replace|re|ignorecase|useinnertext|pagecount|innerText|unfilteredrows|cellValue|parentNode|displayedCount|sortconvert|selectedIndex|alphanumeric|none||tables|auto|option|autosort|stripe|sel|cancelBubble|TABLE|SortableClassName|pageJump|getActualCellIndex|select|count|tr|Function|rowCells|pageend|container_all_count|nname|container_filtered_count|scrape|container_count|lastdesc|options|onclick|SortedAscendingClassName|FilterableClassName|SortedDescendingClassName|autofilter|lastcol|rowSpan|container_number|processCells|AutoFilterClassName|cellCoordinates|colSpan|trs|undefined|Date|o1|getTime|autopage|default|style|false|fixYear|valArray|values|numeric_converter|in|tbody|addEventListener|FilterAllLabel|NoSortClassName|formats|matrixrow|jQuery|getElementsByTagName|attachEvent|separator|prefix|cellsK|sortable|sorted|filtered|L3|copy|uniqueId|rowcount|RowcountPrefix|useInnerText|cs|getComputedStyle|thead|currentStyle|arguments|o2|FilteredRowcountPrefix|cellId|event|stopPropagation|TFOOT|FilteredClassName|cellsLength|regex|PageCountPrefix|AutoPageJumpPrefix|AutoPageSizePrefix|keep|AutoStripeClassName|StripeClassNamePrefix|AutoSortColumnPrefix|AutoSortTitle|string|newSortFunc|title|SortableColumnPrefix|push|getUniqueColValues|PageNumberPrefix|ignorehiddenrows|AutoSortClassName|INPUT|text|search|insert|SELECT|All|number|Filter|TABLE_|previous|tFoot|tHead|next|Click|getPropertyValue|total|ignoreHiddenRows|test|load|9999999999999|unfilteredcount|autostripe|nosort|filterable|floor|data|to|asc|Math|IMG|currency_comma|currency|TD|break|call|onload|toLowerCase|object|onchange|parseFloat|appendChild|one|class|TR|TH|delete|2000|checkbox|100|1900|radio|checked|nodeType|br|pageNext|filterReset|pagePrevious|filterList|50'.split('|'),0,{}))
