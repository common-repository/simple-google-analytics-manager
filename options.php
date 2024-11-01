<div class="wrap">
<h2>Simple GA Manager</h2>

<form method="post" action="options.php">
<?php wp_nonce_field('update-options'); ?>
<?php settings_fields('gamanager'); ?>

<table class="form-table">

<tr valign="top">
<th scope="row">GA ID:</th>
<td><input type="text" name="analytics_id" value="<?php echo get_option('analytics_id'); ?>" /></td>
</tr>

</tr>

</table>

<input type="hidden" name="action" value="update" />

<p class="submit">
<input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" />
</p>

</form>
</div>
