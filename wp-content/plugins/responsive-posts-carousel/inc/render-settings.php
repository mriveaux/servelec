<div class="rpc-wrap">
	<nav class="rpc-tabs">
		<div class="selector"></div>
		<?php foreach ($tabs as $tab) { ?>
    			<a href="#rpc-tab-<?php echo $tab['name']; ?>"> <?php echo $tab['icon']; ?> <?php echo $tab['label']; ?></a>
		<?php } ?>
	</nav>
	<div class="rpc-contents">
		<?php foreach ($tabs as $tab) { ?>
			<div class="rpc-tabcontent" id="rpc-tab-<?php echo $tab['name']; ?>">
				<table class="rpc-list-table widefat fixed">
					<?php foreach ($fields as $field) {
						if ($field['tab'] == $tab['name']) { ?>
							<tr id="wrap_<?php echo (is_array($field['key'])) ? $field['key'][0].'_'.$field['key'][1] : $field['key'] ; ?>">
								<td><label><?php echo $field['title']; ?></label></td>
								<td class="td_<?php echo (is_array($field['key'])) ? $field['key'][0].'_'.$field['key'][1] : $field['key'] ; ?>">
									<?php $this->render_input_field($field, $carousel_meta); ?>
									<p class="description"><?php echo $field['help']; ?></p>
								</td>
							</tr>
						<?php }
					} ?>		
				</table>
			</div>
		<?php } ?>
	</div>
</div>
