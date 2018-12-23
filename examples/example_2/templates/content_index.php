<?php
/**
 * @var \Z\SiteBuildLayer\PhpFileSiteBuildLayer $this
 *
 * @var string $global_hello_name
 * @var array $table_data
 */
?>
<hr />
<h2>
	global hello world (<?php echo basename(__FILE__)?>)
	<span class="name">
		<?php echo isset($global_hello_name) ? $global_hello_name : ''?>
	</span>
	!
</h2>
<table>
	<thead>
		<tr>
    		<th>
    			Title
			</tn>
    		<th>
    			Director
			</tn>
    		<th>
    			Year
			</tn>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($table_data as $row_data):?>
        	<tr>
    	    	<?php foreach ($row_data as $cell_data):?>
            		<td>
            			<?php echo $cell_data;?>
            		</td>
        		<?php endforeach;?>
        	</tr>
		<?php endforeach;?>
	</tbody>
</table>
<hr />
