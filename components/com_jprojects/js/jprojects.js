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
	colone.innerHTML='<img src="images/publish_x.png" border="0" onclick="deleteRow('+count+')"><input id="deleted'+count+'" name="deleted'+count+'" type="hidden" value="0">';

	//Product Name with Popup image to select product
	coltwo.className = ""
	coltwo.innerHTML= '<table border="0" cellpadding="1" cellspacing="0" width="100%"><tr><td style="border: none;"><input id="serviceid'+count+'" name="serviceid'+count+'" type="hidden"><input id="service'+count+'" name="service'+count+'" style="width: 350px;" value="" readonly="readonly" type="text"><img src="components/com_jaccounts/images/service_lookup.png" style="cursor: pointer;" onclick="javascript:Popup('+count+')" align="absmiddle"></td></tr><tr><td style="border: none;" id="setComment'+count+'"><textarea id="comment" name="comment'+count+'" style="width:350px;height:40px"></textarea><br>[<a href="javascript:;" onclick="getObj(\'comment'+count+'\').value=\'\'";>Clear Comment</a>]</td></tr></tbody></table>';	

	
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

	var max_row_count = document.getElementById('serviceTable').rows.length;
	max_row_count = eval(max_row_count)-1;//Because the table has two header rows. so we will reduce two from row length

	for (var i=1;i<=max_row_count;i++) 
	{
		if(document.getElementById('deleted'+i).value == 0)
		{
			
			if (document.getElementById("productTotal"+i).innerHTML=="") 
				document.getElementById("productTotal"+i).innerHTML = 0.0
			if (!isNaN(document.getElementById("productTotal"+i).innerHTML))
				netTotal += parseFloat(document.getElementById("productTotal"+i).innerHTML)
		}
	}
//	alert(netTotal);
	document.getElementById("netTotal").innerHTML = netTotal;
	document.getElementById("total").value = netTotal;

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
function popupCheck(field) {

	var value = document.getElementById(field).value;

	if (value == "") {
		document.getElementById(field+"_label").className="fieldNameRequired";
	} else {
		document.getElementById(field+"_label").className="fieldNameRequiredActive";
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