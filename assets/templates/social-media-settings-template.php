<div class="dk_optionspage">
    <h1>Social Media Options</h1>
    <?php settings_errors(); ?>
    <form method="post" action="options.php">
        <?php settings_fields( 'dk-social-settings-group' ); ?>
        <?php do_settings_sections( 'dk_social_options' ); ?>
        <?php submit_button(); ?>
    </form>
</div>
