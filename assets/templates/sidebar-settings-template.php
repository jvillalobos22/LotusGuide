<div class="dk_optionspage">
    <h1>Sidebar Options</h1>
    <?php settings_errors(); ?>
    <form method="post" action="options.php">
        <?php settings_fields( 'dk-sidebar-settings-group' ); ?>
        <?php do_settings_sections( 'dk_sidebar_options' ); ?>
        <?php do_settings_sections( 'dk-default-sidebar-options' ); ?>
        <?php do_settings_sections( 'dk-featured-event-options' ); ?>
        <?php submit_button(); ?>
    </form>
</div>
