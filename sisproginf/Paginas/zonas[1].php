<script language="JavaScript">
// INICIO DEL CÓDIGO ORIGINAL
// var c = new Array("00", "11", "22", "33", "44", "55", "66", "77", "88", "99", "AA", "BB", "CC", "DD", "EE", "FF");
// FINAL DEL CÓDIGO ORIGINAL
var c = new Array("E7");
x = 0;

function bg_eff()
   {
// INICIO DEL CÓDIGO ORIGINAL
// col_val = "#FFFF" + c[x];
// FINAL DEL CÓDIGO ORIGINAL
   col_val = "#E7E3" + c[x];
   document.bgColor=col_val;
   x++;
// INICIO DEL CÓDIGO ORIGINAL
// if (x == 16)
// FINAL DEL CÓDIGO ORIGINAL
if (x == 1)
      {
      clearInterval(change_bg);
      }
   }

change_bg = setInterval("bg_eff()", 250);
</script>

<div id="datacontainer" style="position:absolute;left:0px;top:0px;width:100%" onMouseover="scrollspeed=0" onMouseout="scrollspeed=cache">

<!-- ADD YOUR SCROLLER CONTENT INSIDE HERE -->
<br><br><br><br><br><script language="JavaScript">
window.onload = UpdateClocks;
var timerID ;
function tzone(tz, os, ds, cl)

{

	this.ct = new Date(0) ;		// datetime

	this.tz = tz ;		// code

	this.os = os ;		// GMT offset

	this.ds = ds ;		// has daylight savings

	this.cl = cl ;		// font color

}
function UpdateClocks()

{
	var ct = new Array(

		new tzone('GMT / UTC', 0, 0, '#990000'),

		new tzone('Argentina<br>(Buenos Aires)', -3, 0, '#213452'),

		new tzone('Bolivia<br>(La Paz)', -4, 0, '#990000'),

		new tzone('Chile<br>(Santiago)', -4, 0, '#213452'),

		new tzone('Colombia<br>(Bogotá)', -5, 0, '#990000'),

		new tzone('Costa Rica<br>(San José)', -6, 0, '#213452'),

		new tzone('Cuba<br>(La Habana)',  -5, 1, '#990000'),

		new tzone('Ecuador<br>(Quito)', -5, 0, '#213452'),

		new tzone('El Salvador<br>(San Salvador)', -6, 0, '#990000'),
		
		new tzone('España<br>(Madrid)', +1, 1, '#213452'),
		
		new tzone('Guatemala<br>(Guatemala)', -6, 0, '#990000'),
		
		new tzone('Guinea Ecuatorial<br>(Malabo)', +1, 0, '#213452'),
		
		new tzone('Honduras<br>(Tegucigalpa)', -6, 0, '#990000'),
		
		new tzone('México<br>(México)', -6, 1, '#213452'),
		
		new tzone('Nicaragua<br>(Managua)', -6, 0, '#990000'),
		
		new tzone('Panamá<br>(Panamá)', -5, 0, '#213452'),
		
		new tzone('Paraguay<br>(Asunción)', -4, 0, '#990000'),
		
		new tzone('Perú<br>(Lima)', -5, 0, '#213452'),
		
		new tzone('Puerto Rico<br>(San Juan)', -4, 0, '#990000'),
		
		new tzone('Rep. Dominicana<br>(Sto. Domingo)', -4, 0, '#213452'),
		
		new tzone('Uruguay<br>(Montevideo)', -3, 0, '#990000'),
		
		new tzone('Venezuela<br>(Caracas)', -4, 0, '#213452')

	) ;



	var dt = new Date() ;	// [GMT] time according to machine clock



	var startDST = new Date(dt.getFullYear(), 3, 1) ;

	while (startDST.getDay() != 0)

		startDST.setDate(startDST.getDate() + 1) ;



	var endDST = new Date(dt.getFullYear(), 9, 31) ;

	while (endDST.getDay() != 0)

		endDST.setDate(endDST.getDate() - 1) ;



	var ds_active ;		// DS currently active

	if (startDST < dt && dt < endDST)

		ds_active = 1 ;

	else

		ds_active = 0 ;



	// Adjust each clock offset if that clock has DS and in DS.

	for(n=0 ; n<ct.length ; n++)

		if (ct[n].ds == 1 && ds_active == 1) ct[n].os++ ;



	// compensate time zones

	gmdt = new Date() ;

	for (n=0 ; n<ct.length ; n++)

		ct[n].ct = new Date(gmdt.getTime() + ct[n].os * 3600 * 1000) ;



	document.all.Clock0.innerHTML =

		'<font color="' + ct[0].cl + '">' + ct[0].tz + '<br>' + ClockString(ct[0].ct) + '<br><br></font>' ;



	document.all.Clock1.innerHTML =

		'<font color="' + ct[1].cl + '">' + ct[1].tz + '<br>' + ClockString(ct[1].ct) + '<br><br></font>' ;



	document.all.Clock2.innerHTML =

		'<font color="' + ct[2].cl + '">' + ct[2].tz + '<br>' + ClockString(ct[2].ct) + '<br><br></font>' ;



	document.all.Clock3.innerHTML =

		'<font color="' + ct[3].cl + '">' + ct[3].tz + '<br>' + ClockString(ct[3].ct) + '<br><br></font>' ;



	document.all.Clock4.innerHTML =

		'<font color="' + ct[4].cl + '">' + ct[4].tz + '<br>' + ClockString(ct[4].ct) + '<br><br></font>' ;



	document.all.Clock5.innerHTML =

		'<font color="' + ct[5].cl + '">' + ct[5].tz + '<br>' + ClockString(ct[5].ct) + '<br><br></font>' ;



	document.all.Clock6.innerHTML =

		'<font color="' + ct[6].cl + '">' + ct[6].tz + '<br>' + ClockString(ct[6].ct) + '<br><br></font>' ;



	document.all.Clock7.innerHTML =

		'<font color="' + ct[7].cl + '">' + ct[7].tz + '<br>' + ClockString(ct[7].ct) + '<br><br></font>' ;
		
		
		
	document.all.Clock8.innerHTML =

		'<font color="' + ct[8].cl + '">' + ct[8].tz + '<br>' + ClockString(ct[8].ct) + '<br><br></font>' ;
		
		
		
	document.all.Clock9.innerHTML =

		'<font color="' + ct[9].cl + '">' + ct[9].tz + '<br>' + ClockString(ct[9].ct) + '<br><br></font>' ;
		
		
		
	document.all.Clock10.innerHTML =

		'<font color="' + ct[10].cl + '">' + ct[10].tz + '<br>' + ClockString(ct[10].ct) + '<br><br></font>' ;
		
		
		
	document.all.Clock11.innerHTML =

		'<font color="' + ct[11].cl + '">' + ct[11].tz + '<br>' + ClockString(ct[11].ct) + '<br><br></font>' ;
		
		
		
	document.all.Clock12.innerHTML =

		'<font color="' + ct[12].cl + '">' + ct[12].tz + '<br>' + ClockString(ct[12].ct) + '<br><br></font>' ;
		
		
		
	document.all.Clock13.innerHTML =

		'<font color="' + ct[13].cl + '">' + ct[13].tz + '<br>' + ClockString(ct[13].ct) + '<br><br></font>' ;
		
		
		
	document.all.Clock14.innerHTML =

		'<font color="' + ct[14].cl + '">' + ct[14].tz + '<br>' + ClockString(ct[14].ct) + '<br><br></font>' ;
		
		
		
	document.all.Clock15.innerHTML =

		'<font color="' + ct[15].cl + '">' + ct[15].tz + '<br>' + ClockString(ct[15].ct) + '<br><br></font>' ;
		
		
		
	document.all.Clock16.innerHTML =

		'<font color="' + ct[16].cl + '">' + ct[16].tz + '<br>' + ClockString(ct[16].ct) + '<br><br></font>' ;
		
		
		
	document.all.Clock17.innerHTML =

		'<font color="' + ct[17].cl + '">' + ct[17].tz + '<br>' + ClockString(ct[17].ct) + '<br><br></font>' ;
		
		
		
	document.all.Clock18.innerHTML =

		'<font color="' + ct[18].cl + '">' + ct[18].tz + '<br>' + ClockString(ct[18].ct) + '<br><br></font>' ;
		
		
		
	document.all.Clock19.innerHTML =

		'<font color="' + ct[19].cl + '">' + ct[19].tz + '<br>' + ClockString(ct[19].ct) + '<br><br></font>' ;
		
		
		
	document.all.Clock20.innerHTML =

		'<font color="' + ct[20].cl + '">' + ct[20].tz + '<br>' + ClockString(ct[20].ct) + '<br><br></font>' ;
		
		
		
	document.all.Clock21.innerHTML =

		'<font color="' + ct[21].cl + '">' + ct[21].tz + '<br>' + ClockString(ct[21].ct) + '<br><br></font>' ;



	timerID = window.setTimeout("UpdateClocks()", 1001) ;

}



function ClockString(dt)

{

	var stemp, ampm ;



	var dt_year = dt.getUTCFullYear() ;

	var dt_month = dt.getUTCMonth() + 1 ;

	var dt_day = dt.getUTCDate() ;

	var dt_hour = dt.getUTCHours() ;

	var dt_minute = dt.getUTCMinutes() ;

	var dt_second = dt.getUTCSeconds() ;

	

	dt_year = dt_year.toString() ;

	if (0 <= dt_hour && dt_hour < 12)

	{

		ampm = 'AM' ;

		if (dt_hour == 0) dt_hour = 12 ;		

	} else {

		ampm = 'PM' ;

		dt_hour = dt_hour - 12 ;

		if (dt_hour == 0) dt_hour = 12 ;		

	}

	

	if (dt_minute < 10)

		dt_minute = '0' + dt_minute ;

	

	if (dt_second < 10)

		dt_second = '0' + dt_second ;



	stemp = dt_day + '-' + dt_month + '-' + dt_year.substr(2,2) ;

	stemp = stemp + ' / ' + dt_hour + ":" + dt_minute + ":" + dt_second + ' ' + ampm ;

	return stemp ;

}
</script>
<div align="center">
  <center>
  <table border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse; font-family: Verdana; font-size: 10px; font-weight: bold" bordercolor="#111111" id="AutoNumber1">
    <tr>
      <td ID="Clock0" style="font-family: Verdana; font-size: 10px; font-weight: bold" align="center"> </td>
    </tr>
    <tr>
      <td ID="Clock1" style="font-family: Verdana; font-size: 10px; font-weight: bold" align="center"> </td>
    </tr>
    <tr>
      <td ID="Clock2" style="font-family: Verdana; font-size: 10px; font-weight: bold" align="center"> </td>
    </tr>
    <tr>
      <td ID="Clock3" style="font-family: Verdana; font-size: 10px; font-weight: bold" align="center"> </td>
    </tr>
    <tr>
      <td ID="Clock4" style="font-family: Verdana; font-size: 10px; font-weight: bold" align="center"> </td>
    </tr>
    <tr>
      <td ID="Clock5" style="font-family: Verdana; font-size: 10px; font-weight: bold" align="center"> </td>
    </tr>
    <tr>
      <td ID="Clock6" style="font-family: Verdana; font-size: 10px; font-weight: bold" align="center"> </td>
    </tr>
    <tr>
      <td ID="Clock7" style="font-family: Verdana; font-size: 10px; font-weight: bold" align="center"> </td>
    </tr>
    <tr>
      <td ID="Clock8" style="font-family: Verdana; font-size: 10px; font-weight: bold" align="center"> </td>
    </tr>
    <tr>
      <td ID="Clock9" style="font-family: Verdana; font-size: 10px; font-weight: bold" align="center"> </td>
    </tr>
    <tr>
      <td ID="Clock10" style="font-family: Verdana; font-size: 10px; font-weight: bold" align="center"> </td>
    </tr>
    <tr>
      <td ID="Clock11" style="font-family: Verdana; font-size: 10px; font-weight: bold" align="center"> </td>
    </tr>
    <tr>
      <td ID="Clock12" style="font-family: Verdana; font-size: 10px; font-weight: bold" align="center"> </td>
    </tr>
    <tr>
      <td ID="Clock13" style="font-family: Verdana; font-size: 10px; font-weight: bold" align="center"> </td>
    </tr>
    <tr>
      <td ID="Clock14" style="font-family: Verdana; font-size: 10px; font-weight: bold" align="center"> </td>
    </tr>
    <tr>
      <td ID="Clock15" style="font-family: Verdana; font-size: 10px; font-weight: bold" align="center"> </td>
    </tr>
    <tr>
      <td ID="Clock16" style="font-family: Verdana; font-size: 10px; font-weight: bold" align="center"> </td>
    </tr>
    <tr>
      <td ID="Clock17" style="font-family: Verdana; font-size: 10px; font-weight: bold" align="center"> </td>
    </tr>
    <tr>
      <td ID="Clock18" style="font-family: Verdana; font-size: 10px; font-weight: bold" align="center"> </td>
    </tr>
    <tr>
      <td ID="Clock19" style="font-family: Verdana; font-size: 10px; font-weight: bold" align="center"> </td>
    </tr>
    <tr>
      <td ID="Clock20" style="font-family: Verdana; font-size: 10px; font-weight: bold" align="center"> </td>
    </tr>
    <tr>
      <td ID="Clock21" style="font-family: Verdana; font-size: 10px; font-weight: bold" align="center"> </td>
    </tr>
  </table>
  </center>
</div>

<!-- END SCROLLER CONTENT -->

</div>

<script type="text/javascript">

//Specify speed of scroll. Larger=faster (ie: 5)
var scrollspeed=cache=1

//Specify intial delay before scroller starts scrolling (in miliseconds):
var initialdelay=2000

function initializeScroller(){
dataobj=document.all? document.all.datacontainer : document.getElementById("datacontainer")
dataobj.style.top="5px"
setTimeout("getdataheight()", initialdelay)
}

function getdataheight(){
thelength=dataobj.offsetHeight
if (thelength==0)
setTimeout("getdataheight()",10)
else
scrollDiv()
}

function scrollDiv(){
dataobj.style.top=parseInt(dataobj.style.top)-scrollspeed+"px"
if (parseInt(dataobj.style.top)<thelength*(-1))
dataobj.style.top="5px"
setTimeout("scrollDiv()",40)
}

if (window.addEventListener)
window.addEventListener("load", initializeScroller, false)
else if (window.attachEvent)
window.attachEvent("onload", initializeScroller)
else
window.onload=initializeScroller

</script>