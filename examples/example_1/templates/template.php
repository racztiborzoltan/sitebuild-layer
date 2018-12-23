<?php
/**
 * @var \Z\SiteBuildLayer\PhpFileSiteBuildLayer $this
 *
 * @var string $hello_name
 * @var string $global_hello_name
 * @var \Z\SiteBuildLayer\PhpFileSiteBuildLayer $content
 */

$_VARIABLES = get_defined_vars();
?>
<html>
	<head>
		<title>small sitebuild layer example</title>
	</head>
	<body>
		<header>
            <nav>
            	<a href="?language=en">english page</a>
            	|
            	<a href="?language=hu">hungarian page</a>
            </nav>
    		<h1>
            	hello world
            	<span class="name">
            		<?php echo isset($hello_name) ? $hello_name : ''?>
            	</span>
            	!
    		</h1>
            <h2>
            	global hello world
            	<span class="name">
            		<?php echo isset($global_hello_name) ? $global_hello_name : ''?>
            	</span>
            	!
            </h2>
		</header>
		<main>
			<?php echo $content?>
		</main>
		<footer>
			<pre><?php var_export($_VARIABLES);?></pre>
		</footer>
	</body>
</html>




