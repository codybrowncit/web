
	<link rel="stylesheet" type="text/css" href="style.css" />
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.9.1/themes/base/jquery-ui.css" />
	<script type="text/javascript" src="jquery.hoverintent.js"></script>
    <script src="http://code.jquery.com/jquery-1.8.2.js"></script>
    <script src="http://code.jquery.com/ui/1.9.1/jquery-ui.js"></script>
	<script type="text/javascript" src="jquery.cycle.all.js"></script>
	<script>
	$('.pics').cycle('fade');
    $(function() {
        $( "#datepicker" ).datepicker();
    });
	$(function() {
        $( document ).tooltip();
    });
	var timeout    = 500;
var closetimer = 0;
var ddmenuitem = 0;

function jsddm_open()
{  jsddm_canceltimer();
   jsddm_close();
   ddmenuitem = $(this).find('ul').css('visibility', 'visible');}

function jsddm_close()
{  if(ddmenuitem) ddmenuitem.css('visibility', 'hidden');}

function jsddm_timer()
{  closetimer = window.setTimeout(jsddm_close, timeout);}

function jsddm_canceltimer()
{  if(closetimer)
   {  window.clearTimeout(closetimer);
      closetimer = null;}}
      
$(document).ready(function()
{  $('#jsddm > li').bind('mouseover', jsddm_open)
   $('#jsddm > li').bind('mouseout',  jsddm_timer)});

document.onclick = jsddm_close;
    </script>
	<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-36802676-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
   
</head>

<body>
    <div id="wrapper">
        <div id="header">	
            <ul id="jsddm">
    <li><a href="index.php">Home</a></li>
    <li><a href="aboutus.php">About Us</a></li>
    <li><a href="contactus.php">Contact Us</a></li>
	<li><a href="#">Products</a>
        <ul class="subnav">
            <li><a href="signwrite.php">Sign Writing and Laser Cutting</a></li>
            <li><a href="safty.php">Safety Signage</a></li>
			<li><a href="decals.php">Vehicle Decals & Wraps</a></li>
        </ul>
    </li>
</ul>
        </div>
  <div id="container">
        	<div id="content">