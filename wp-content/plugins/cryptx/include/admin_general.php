<?php
/**
 * CryptX option page "General"-Tab
 */
function rw_cryptx_settings_tab_content_general() {
	global $cryptX_var, $rw_cryptx_active_tab;
	if ( 'general' != $rw_cryptx_active_tab )
		return;
	?>

	<h4><?php _e( "General",'cryptx' ); ?></h4>
    <table>
        <tr>
            <th scope="row"><?php _e("Apply CryptX to...",'cryptx'); ?></th>
            <td>
                <input name="cryptX_var[the_content]"    type="checkbox" value="1" <?php checked( $cryptX_var['the_content'],    1 ); ?> />&nbsp;&nbsp;<?php _e("Content",'cryptx'); ?> <?php _e("(<i>this can be disabled per Post by an Option</i>)",'cryptx'); ?><br/>
                <input name="cryptX_var[the_meta_key]"    type="checkbox" value="1" <?php checked( $cryptX_var['the_meta_key'],    1 ); ?> />&nbsp;&nbsp;<?php _e("Custom fields (<strong>works only with the_meta()!</strong>)",'cryptx'); ?><br/>
                <input name="cryptX_var[the_excerpt]"    type="checkbox" value="1" <?php checked( $cryptX_var['the_excerpt'],    1 ); ?> />&nbsp;&nbsp;<?php _e("Excerpt",'cryptx'); ?><br/>
                <input name="cryptX_var[comment_text]"    type="checkbox" value="1" <?php checked( $cryptX_var['comment_text'],    1 ); ?> />&nbsp;&nbsp;<?php _e("Comments",'cryptx'); ?><br/>
                <input name="cryptX_var[widget_text]"    type="checkbox" value="1" <?php checked( $cryptX_var['widget_text'],    1 ); ?> />&nbsp;&nbsp;<?php _e("Widgets",'cryptx'); ?> <?php _e("(<i>works only on all widgets, not on a single widget</i>!)",'cryptx'); ?>
            </td>
        </tr>

        <tr class="spacer">
            <td colspan="3"><hr></td>
        </tr>

        <tr>
            <th scope="row"><?php _e("Excluded ID's...",'cryptx'); ?></th>
            <td><input name="cryptX_var[excludedIDs]" value="<?php echo $cryptX_var['excludedIDs']; ?>" type="text" class="regular-text" />
            <br/><span class="setting-description"><?php _e("Enter all Page/Post ID's to exclude from CryptX as comma seperated list.",'cryptx'); ?></span>
            <br/><input name="cryptX_var[metaBox]" type="checkbox" value="1" <?php checked( $cryptX_var['metaBox'], 1 ); ?> />&nbsp;&nbsp;<?php _e("Enable the CryptX Widget on editing a post or page.",'cryptx'); ?></td>
        </tr>

        <tr class="spacer">
            <td colspan="3"><hr></td>
        </tr>

        <tr>
            <th scope="row"><?php _e("Type of decryption",'cryptx'); ?></th>
            <td><input name="cryptX_var[java]" type="radio" value="1" <?php checked( $cryptX_var['java'], 1 ); ?>/>&nbsp;&nbsp;<?php _e("Use javascript to hide the Email-Link.",'cryptx'); ?><br/>
                <input name="cryptX_var[java]" type="radio" value="0" <?php checked( $cryptX_var['java'], 0 ); ?>/>&nbsp;&nbsp;<?php _e("Use Unicode to hide the Email-Link.",'cryptx'); ?></td>
        </tr>

        <tr class="spacer">
            <td colspan="3"><hr></td>
        </tr>

        <tr>
            <th scope="row"><?php _e("Where to load the needed javascript...",'cryptx'); ?></th>
            <td><input name="cryptX_var[load_java]" type="radio" value="0"  <?php checked( $cryptX_var['load_java'], 0 ); ?>/>&nbsp;&nbsp;<?php _e("Load the javascript in the <b>header</b> of the page.",'cryptx'); ?><br/>
                <input name="cryptX_var[load_java]" type="radio" value="1"  <?php checked( $cryptX_var['load_java'], 1 ); ?>/>&nbsp;&nbsp;<?php _e("Load the javascript in the <b>footer</b> of the page.",'cryptx'); ?></td>
        </tr>

        <tr class="spacer">
            <td colspan="3"><hr></td>
        </tr>

        <tr>
            <th scope="row" colspan="2"><input name="cryptX_var[autolink]" type="checkbox" value="1"  <?php checked( $cryptX_var['autolink'], 1 ); ?>/>&nbsp;&nbsp;<?php _e("Add mailto to all unlinked email addresses",'cryptx'); ?></th>
        </tr>

        <tr class="spacer">
            <td colspan="3"><hr></td>
        </tr>

        <tr>
            <th scope="row"><?php _e("Whitelist of extensions",'cryptx'); ?></th>
            <td><input name="cryptX_var[whiteList]" value="<?php echo $cryptX_var['whiteList']; ?>" type="text" class="regular-text" />
            <br/><span class="setting-description"><?php _e("<strong>This is a workaround for the 'retina issue'.</strong><br/>You can provide a comma seperated list of extensions like 'jpeg,jpg,png,gif' which will be ignored by CryptX.",'cryptx'); ?></span>
        </tr>

        <tr class="spacer">
            <td colspan="3"><hr></td>
        </tr>

        <tr>
            <th scope="row" colspan="2" class="warning"><input name="cryptX_var_reset" type="checkbox" value="1"/>&nbsp;&nbsp;<?php _e("Reset CryptX options to defaults. Use it carefully and at your own risk. All changes will be deleted!",'cryptx'); ?></th>
        </tr>
    </table>
    <input type='hidden' name='cryptX_save_general_settings' value='true'>
    <?php submit_button(); ?>
	<?php
}
add_action( 'rw_cryptx_settings_content', 'rw_cryptx_settings_tab_content_general' );