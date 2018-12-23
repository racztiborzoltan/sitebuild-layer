<?php
/**
 * @var \Z\SiteBuildLayer\PhpFileSiteBuildLayer $this
 *
 * @var string $global_hello_name
 * @var string $name
 * @var string $phone
 * @var string $email
 */
?>
<hr />
<h2>
	Contact page content
</h2>
<p>
	Name:
	<span class="name"><?php echo $name?></span>
</p>
<p>
	Phone:
	<a href="tel:<?php echo $phone?>" class="phone"><?php echo $phone?></a>
</p>
<p>
	Email:
	<a href="mailto:<?php echo $email?>" class="phone"><?php echo $email?></a>
</p>
<hr />
