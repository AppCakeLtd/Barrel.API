<?php
/**
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

$cakeDescription = __d('cake_dev', 'CakePHP: the rapid development php framework');
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <title><?php echo $title_for_layout?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Barrel, the Wine port manager for Mac OS X. Play Windows games on your Mac OS X without Virtualization or Bootcamp">
    <meta name="author" content="Thanos Siopoudis">
    <meta property="og:description" content="Barrel, the Wine port manager for Mac OS X. Play Windows games on your Mac OS X without Virtualization or Bootcamp"> 
	<meta property="og:title" content="Barrel - The Wine port manager for OS X">


    <!-- Le styles -->
    <link href="/css/cake.generic.css" rel="stylesheet">
    <link href="/css/bootstrap.css" rel="stylesheet">
    <style>
      body {
        padding-top: 60px; /* 60px to make the container go all the way to the bottom of the topbar */
      }
    </style>
    <link href="/css/bootstrap-responsive.css" rel="stylesheet">
    <link href="/css/style.css" rel="stylesheet">

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="../assets/js/html5shiv.js"></script>
    <![endif]-->

    <!-- Fav and touch icons -->
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="/ico/apple-touch-icon-114-precomposed.png">
      <link rel="apple-touch-icon-precomposed" sizes="72x72" href="/ico/apple-touch-icon-72-precomposed.png">
                    <link rel="apple-touch-icon-precomposed" href="/ico/apple-touch-icon-57-precomposed.png">
                                   <link rel="shortcut icon" href="/ico/favicon.png">
                                   
	  <script type="text/javascript">

		  var _gaq = _gaq || [];
		  _gaq.push(['_setAccount', 'UA-42006641-1']);
		  _gaq.push(['_trackPageview']);
		
		  (function() {
		    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
		    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
		    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
		  })();
		
		</script>
</head>
<body>
	<div class="navbar navbar-inverse navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
          <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="brand" href="#">Barrel</a>
          <div class="nav-collapse collapse">
            <ul class="nav">
              <li><a data-nav="home" href="http://barrelapp.co.uk">Home</a></li>
              <li><a data-nav="features" href="http://barrelapp.co.uk#features">Features</a></li>
              <li><a onClick="_gaq.push(['_trackEvent', 'Downloads', '0.9.2', 'Barrel Download']);" href="http://barrelapp.co.uk/updater/releases/0.9Beta2/Barrel-0.9B2.zip">Download</a></li>
              <li><a href="https://github.com/ThanosSiopoudis/BarrelApp/issues?state=open">Issues</a></li>
              <li><a href="https://github.com/ThanosSiopoudis/BarrelApp/issues/new">Report a Bug</a></li>
              <li class="active"><a href="http://api.barrelapp.co.uk/Games/Database">Game Compatibility DB</a></li>
            </ul>
          </div><!--/.nav-collapse -->
        </div>
      </div>
      <a class="github-ribbon" href="https://github.com/ThanosSiopoudis/BarrelApp"><img src="/img/fork-me-right-grey@2x.png" alt="Fork me on GitHub"></a>
    </div>

    <div class="container" id="home">
		<div class="span12 logo">
			<a href="http://barrelapp.co.uk">
		    	<img src="/img/Barrel_512x512x32.png" width="50" height="50" />
		    	<span class="logocopy">Barrel</span>
			</a>
		</div>
		<div class="span12 logomoto">
			<span>The Wine port manager for OS X.</span><br />
			<h4><small>Play your favourite windows games on Mac</small></h4>
		</div>
		<div class="span12 content">
			<?php echo $this->Session->flash(); ?>
			<?php echo $this->fetch('content'); ?>
		</div>
    </div> <!-- /container -->

    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="/js/jquery.js"></script>
    <script src="/js/bootstrap.min.js"></script>
    <script src="/js/core.js"></script>
</body>
</html>
