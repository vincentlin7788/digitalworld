<!DOCTYPE HTML>
<html>
  <head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
	<meta charset="utf-8" />
    <title>Google Pie Chart Study Programm for Digital Worlddfss</title>

    <meta name="description" content="login page " />

    <meta name="keywords" content="Google Pie Chart,Study Programm" />


<script>
function getParameterByName(name, url) {
    if (!url) {
      url = window.location.href;
    }
    name = name.replace(/[\[\]]/g, "\\$&");
    var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
        results = regex.exec(url);
    if (!results) return null;
    if (!results[2]) return '';
    return decodeURIComponent(results[2].replace(/\+/g, " "));
}


  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  

  ga('create', 'UA-81452102-2', 'auto');
  
  ga('create', 'UA-81452102-3', 'auto','anotherTracker');
 
  
    ga('set',{
    campaignName:getParameterByName('utm_campaign'),
    campaignSource:getParameterByName('utm_source'),
    campaignMedium:getParameterByName('utm_medium'),
    
});
  ga('set', 'userId', '<?php echo $_POST["firstname"]; ?>'); // Set the user ID using signed-in user_id.
  ga('send', 'pageview');

      ga('anotherTracker.set',{
    campaignName:getParameterByName('utm_campaign'),
    campaignSource:getParameterByName('utm_source'),
    campaignMedium:getParameterByName('utm_medium'),
});
  ga('anotherTracker.send', 'pageview');
  
</script>
<script type="text/javascript" src="jquery-3.1.0.min.js"></script>
  </head>
<body>

Welcome <?php echo $_POST["firstname"]; ?><br>
Your Last Name address is: <?php echo $_POST["lastname"]; ?>

</body>
</html>