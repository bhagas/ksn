
   var http_request = false;
   function makeRequest(url, parameters, myspani) {
      http_request = false;
      if (window.XMLHttpRequest) { // Mozilla, Safari,...
         http_request = new XMLHttpRequest();
         if (http_request.overrideMimeType) {
         	// set type accordingly to anticipated content type
            //http_request.overrideMimeType('text/xml');
            http_request.overrideMimeType('text/html');
         }
      } else if (window.ActiveXObject) { // IE
         try {
            http_request = new ActiveXObject("Msxml2.XMLHTTP");
         } catch (e) {
            try {
               http_request = new ActiveXObject("Microsoft.XMLHTTP");
            } catch (e) {}
         }
      }
      if (!http_request) {
         alert('Cannot create XMLHTTP instance');
         return false;
      }
      http_request.onreadystatechange = function() {
      	document.getElementById(myspani).innerHTML = "<span style=\"color:red;\">Please wait... processing</span>";
      	if (http_request.readyState == 4) {
      	  
         if (http_request.status == 200) {
            //alert(http_request.responseText);
            result = http_request.responseText;
            document.getElementById(myspani).innerHTML = result;            
         } else {
            //alert('There was a problem with the request.');
            alert(document.location.pathname);
         }
      }
      };
      //alert (parameters);
      http_request.open('GET', url + parameters, true);
      http_request.send(null);
   }

   function alertContents(myspan) {
   	  
      if (http_request.readyState == 4) {
         if (http_request.status == 200) {
            alert(http_request.responseText);
            result = http_request.responseText;
            document.getElementById(myspan).innerHTML = result;            
         } else {
            alert('There was a problem with the request.');
         }
      }
      return 1;
   }
   
   function get(obj, myspans) {
	  var getstr = "?Submit=ok&";
	  for (i=0; i<obj.getElementsByTagName("input").length; i++) {
			if (obj.getElementsByTagName("input")[i].type == "text") {
			   getstr += obj.getElementsByTagName("input")[i].name + "=" + 
					   obj.getElementsByTagName("input")[i].value + "&";
			}
			if (obj.getElementsByTagName("input")[i].type == "hidden") {
			   getstr += obj.getElementsByTagName("input")[i].name + "=" + 
					   obj.getElementsByTagName("input")[i].value + "&";
			}
			if (obj.getElementsByTagName("input")[i].type == "checkbox") {
			   if (obj.getElementsByTagName("input")[i].checked) {
				  getstr += obj.getElementsByTagName("input")[i].name + "=" + 
					   obj.getElementsByTagName("input")[i].value + "&";
			   } else {
				  getstr += obj.getElementsByTagName("input")[i].name + "=&";
			   }
			}
			if (obj.getElementsByTagName("input")[i].type == "radio") {
			   if (obj.getElementsByTagName("input")[i].checked) {
				  getstr += obj.getElementsByTagName("input")[i].name + "=" + 
					   obj.getElementsByTagName("input")[i].value + "&";
			   }
		 	}  
		 	if (obj.getElementsByTagName("input")[i].tagName == "SELECT") {
				var sel = obj.getElementsByTagName("input")[i];
				getstr += sel.name + "=" + sel.options[sel.selectedIndex].value + "&";
		 	}
			//alert(getstr);
	  }
	  for (i=0; i<obj.getElementsByTagName("textarea").length; i++) {
	  		if (obj.getElementsByTagName("textarea")[i].type == "textarea") {
			   getstr += obj.getElementsByTagName("textarea")[i].name + "=" + 
					   obj.getElementsByTagName("textarea")[i].value + "&";
				//alert(getstr);
			}
	  }
	  //alert(getstr);
	  makeRequest('get.php', getstr, myspans);
	  //alert(myspans);
	  
	}
	
	function toggle(toggleText) {
		var ele = document.getElementById(toggleText);
		//var text = document.getElementById("displayText");
		if(ele.style.display == "block") {
				ele.style.display = "none";
			//text.innerHTML = "disini";
		} else {
			ele.style.display = "block";
			//text.innerHTML = "disini";
		}
	}
	function toggleLeft(toggleText,toggleRight,toggleNav) {
		var ele = document.getElementById(toggleText);
		var eleRight = document.getElementById(toggleRight);
		var eleNav = document.getElementById(toggleNav);
		//var text = document.getElementById("displayText");
		if(ele.style.display == "block") {
				ele.style.display = "none";
				eleRight.style.width = "95%";
				eleRight.style.left = "2.5%";
				eleNav.style.left = "1%";
			//text.innerHTML = "disini";
		}
		else {
			ele.style.display = "block";
			eleRight.style.width = "77%";
			eleRight.style.left = "22%";
			eleNav.style.left = "20.5%";
			//text.innerHTML = "disini";
		}
	}
	
	function toggleRead(str,toggleText) {
		var ele = document.getElementById(toggleText);
		//var text = document.getElementById("displayText");
		if(ele.style.display == "block") {
				ele.style.display = "none";
			//text.innerHTML = "disini";
		} else {
			ele.style.display = "block";
			makeRequest('getRead.php', '?id_blog='+str, toggleText);
			//text.innerHTML = "disini";
		}
	}
	
	function toggleEdit(url,str,toggleText) {
		var ele = document.getElementById(toggleText);
		var ele2 = document.getElementById('mainContent');
		//var text = document.getElementById("displayText");
		//alert(ele.style.display);
		if(ele.style.display == "block") {
				ele.style.display = "none";
				ele2.style.display = "block";
			//text.innerHTML = "disini";
		} else {
			ele.style.display = "block";
			ele2.style.display = "none";
			makeRequest(url, str, toggleText);
			//text.innerHTML = "disini";
		}
	}

	function toggleEditOld(url,str,toggleText) {
		var ele = document.getElementById(toggleText);
		//var text = document.getElementById("displayText");
		if(ele.style.display == "block") {
				ele.style.display = "none";
			//text.innerHTML = "disini";
		} else {
			ele.style.display = "block";
			makeRequest(url, str, toggleText);
			//text.innerHTML = "disini";
		}
	}
	
	function toggleContent(url,str,toggleText) {
		var ele = document.getElementById(toggleText);
		
		if(ele.style.display == "none") {
				ele.style.display = "block";
		}
		makeRequest(url, str, toggleText);
	}

	function toggleDiv(div1,div2) {
		var ele = document.getElementById(div1);
		var ele2 = document.getElementById(div2);
		
		ele.style.display = "none";
		ele2.style.display = "block";
		
	}


function hide(toggleText) {
var ele = document.getElementById(toggleText);
ele.style.display = "none";
}

function toggleLeftPanel() {
	$('#leftPanel').toggle('fast');
}


//setInterval(function(){ hide('indexSpot');}, 3000);

var gAutoPrint = true;
function processPrint(id,title){
	if (document.getElementById != null){
		var html = '<HTML>\n<HEAD>\n';
	if (document.getElementsByTagName != null){
		var headTags = document.getElementsByTagName("head");
	if (headTags.length > 0) html += headTags[0].innerHTML;
	}

	html += '\n</HE' + 'AD>\n<BODY>\n';
	html += '<h1>'+title+'</h1>';
	html += '<center><table align=\"center\" width=\"100%\" border=\"1\"><tr><td align=\"center\">';
	var printReadyElem = document.getElementById(id);
	var s = printReadyElem.innerHTML.replace(/\[Option\]/g,"");
	//s = s.replace(/\[Option\]/g,"");
	s = s.replace(/\[Edit\]/g,"");
	s = s.replace(/\[Detail\]/g,"");
	//s = s.replace(/bgcolor=\"white\" align=\"center\">\[/g,"");
	//s = s.replace(/\]/g,"");
	if (printReadyElem != null) html += s;
	else{
		alert("Error, no contents."+id);
return;
}
html += '</td></tr></table></center>';
html += '\n</BO' + 'DY>\n</HT' + 'ML>';
if (window.ActiveXObject) { //IE
	var originalContents = document.body.innerHTML;
	document.body.innerHTML = html;
	window.print();
	document.body.innerHTML = originalContents;
} else {
	var printWin = window.open("","processPrint");
	printWin.document.open();
	printWin.document.write(html);
	printWin.document.close();
	if (gAutoPrint) printWin.print();
}
} else alert("Browser not supported.");
}

/*
function processPrint(id,title) {
     var printContents = document.getElementById('list_content').innerHTML;
     var originalContents = document.body.innerHTML;

     document.body.innerHTML = printContents;
	 
	 var myContent = document.body.innerHTML;
	 
	 //var printWin = window.open("","processPrint");
	 //printWin.document.open();
	 //printWin.document.write(printContents);
	 //printWin.print();
     window.print();

     document.body.innerHTML = originalContents;
}
*/	

function hilangtahun()
{
	var i=0;
	var selectBox = document.getElementById("selectBox");
	var selectedValue = selectBox.options[selectBox.selectedIndex].value;
	if(selectedValue!='')
	{
			document.getElementById("listtahun").selectedIndex=0;
			for(i=1; i<30;i++)
			{
				document.getElementById("tahun"+i).style.display='none';
			}
	}
	else 
	{
		for(i=1; i<6;i++)
			{
				document.getElementById("tahun"+i).style.display='block';
			}
	}
}

function validateNumber(evt) {
    var e = evt || window.event;
    var key = e.keyCode || e.which;

    if (!e.shiftKey && !e.altKey && !e.ctrlKey &&
    // numbers   
    key >= 48 && key <= 57 ||
    // Numeric keypad
    key >= 96 && key <= 105 ||
    // Backspace and Tab and Enter
    key == 8 || key == 9 || key == 13 ||
    // Home and End
    key == 35 || key == 36 ||
    // left and right arrows
    key == 37 || key == 39 ||
    // Del and Ins
    key == 46 || key == 45 ||
    // comma, period and minus, . on keypad
	key == 190 || key == 188 || key == 109 || key == 110) {
        // input is VALID
    }
    else {
        // input is INVALID
        e.returnValue = false;
        if (e.preventDefault) e.preventDefault();
    }
}