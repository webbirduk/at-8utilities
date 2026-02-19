<?php
add_action('admin_menu', function() {
    add_menu_page('AT-8 Settings', 'AT-8 Settings', 'manage_options', 'at8-settings', 'at8_settings_page', 'dashicons-admin-generic');
});

function at8_settings_page() {
    if (isset($_POST['save_at8'])) {
        update_option('at8_primary_blue', $_POST['p_blue']);
        update_option('at8_primary_yellow', $_POST['p_yellow']);
        echo '<div class="updated"><p>Settings Saved!</p></div>';
    }
    $blue = get_option('at8_primary_blue', '#1e3a8a');
    $yellow = get_option('at8_primary_yellow', '#fbbf24');
    ?>
    <div class="wrap">
        <h1>AT-8 Global Branding</h1>
        <form method="post">
            <table class="form-table">
                <tr>
                    <th>Primary Blue</th>
                    <td><input type="color" name="p_blue" value="<?php echo $blue; ?>"></td>
                </tr>
                <tr>
                    <th>Primary Yellow</th>
                    <td><input type="color" name="p_yellow" value="<?php echo $yellow; ?>"></td>
                </tr>
            </table>
            <input type="submit" name="save_at8" class="button button-primary" value="Save Changes">
        </form>
    </div>
    <?php
}