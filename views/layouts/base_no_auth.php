<!Doctype>
<html>
	<head>
		<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
		<meta charset="utf-8" />
		<title>OpenQuery</title>
		<link rel="stylesheet" href="<?php echo SITEURL?>/css/main.css" type="text/css" media="all" />
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
		<script src="<?php echo SITEURL?>/js/jquery.min.js"></script>
		<script type="text/javascript" src="<?php echo SITEURL?>/js/time.js"></script>

	</head>
	<body>
		<div>
			<div id="oq-head">
				<a id="logo-text" href="<?php echo SITEURL?>">OpenQuery<sup>Alpha</sup></a>
				<div id="userpanel">
					<a href="<?php echo SITEURL?>/user/login">Вход</a> |
					<a href="<?php echo SITEURL?>/user/register">Регистрация</a>
				</div>
				<div class="clearfix"></div>
			</div>
			
			<div id="center-main">
				<div id="search">
					<input type="text" placeholder="Искать в OpenQuery"/>
				</div>
				<div id="content">
					<?php
						include($contentPage);
					?>
				</div>
				<div id="footer">
				В рамках курсовой по СУБД Джамиев Н-М. / Page generated time: <?php echo GENTIME ?> sec.
				</div>
			</div>
		</div>
	</body>
</html>