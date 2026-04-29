<?php
/**
 * Plugin Name: Alpine Treatment Builder
 * Plugin URI:  https://www.alpinewellnessnv.com/
 * Description: Interactive body-map treatment planner for Alpine Wellness.
 * Version:     1.0.2
 * Author:      Alpine Wellness
 * Text Domain: alpine-tb
 */

defined( 'ABSPATH' ) || exit;

define( 'ATB_VERSION', '1.0.2' );
define( 'ATB_URL',     plugin_dir_url( __FILE__ ) );
define( 'ATB_PATH',    plugin_dir_path( __FILE__ ) );

/* ===============================================================
 * AUTOMATIC UPDATES VIA GITHUB
 * How to release an update:
 *  1. Commit your changes and run `git push` — the pre-push hook
 *     auto-increments ATB_VERSION and the Version header.
 *  2. Create a GitHub Release tagged vX.Y.Z.
 * ============================================================= */
require_once ATB_PATH . 'lib/plugin-update-checker/plugin-update-checker.php';

use YahnisElsts\PluginUpdateChecker\v5\PucFactory;

$atb_updater = PucFactory::buildUpdateChecker(
    'https://github.com/cbenjamin/alpine-treatment-builder',
    __FILE__,
    'alpine-treatment-builder'
);

if ( defined( 'ATB_GITHUB_TOKEN' ) && ATB_GITHUB_TOKEN ) {
    $atb_updater->setAuthentication( ATB_GITHUB_TOKEN );
}

$atb_updater->setBranch( 'main' );
$atb_updater->getVcsApi()->enableReleaseAssets();

/* ===============================================================
 * DEFAULTS — single source of truth for colors, fonts, and text
 * ============================================================= */

function atb_defaults() {
    return [

        /* ---- Colors ---- */
        'colors' => [
            'base_bg'      => [ 'label' => 'Accent Background',  'default' => '#f1eadb', 'desc' => 'Cream panel behind the selections list' ],
            'body_text'    => [ 'label' => 'Body Text',          'default' => '#21403e', 'desc' => 'Main text color throughout the builder' ],
            'header'       => [ 'label' => 'Headings',           'default' => '#091714', 'desc' => 'Color for headings and titles' ],
            'primary'      => [ 'label' => 'Primary / CTA',      'default' => '#a3663c', 'desc' => 'Buttons, selected hotspots, hover states' ],
            'secondary'    => [ 'label' => 'Secondary',          'default' => '#666a6b', 'desc' => 'Secondary text and button color' ],
            'navbar_bg'    => [ 'label' => 'Navbar Background',  'default' => '#0d211d', 'desc' => 'Background of the top navigation bar' ],
            'navbar_link'  => [ 'label' => 'Navbar Links',       'default' => '#f7f4ef', 'desc' => 'Back / Exit link text color' ],
            'navbar_hover' => [ 'label' => 'Navbar Link Hover',  'default' => '#c97e4a', 'desc' => 'Navbar link color on hover' ],
        ],

        /* ---- Google Fonts list ---- */
        'fonts' => [
            'Inter', 'DM Sans', 'Lato', 'Montserrat', 'Nunito',
            'Open Sans', 'Plus Jakarta Sans', 'Poppins', 'Raleway',
            'Roboto', 'Source Sans 3', 'Work Sans',
        ],

        /* ---- User-facing text ---- */
        'text' => [
            // Intro screen
            'intro_heading'      => [ 'label' => 'Intro Heading',            'default' => "Welcome to your Treatment Planner! \xf0\x9f\x91\x8b", 'group' => 'Intro Screen' ],
            'intro_name'         => [ 'label' => 'Practice / Provider Name', 'default' => 'Alpine Wellness',        'group' => 'Intro Screen' ],
            'intro_privacy'      => [ 'label' => 'Intro Privacy Note',       'default' => 'All virtual submissions are confidential and will only be shared with your Alpine Wellness Provider.', 'group' => 'Intro Screen', 'type' => 'textarea' ],
            'step_1'             => [ 'label' => 'Step 1',                   'default' => 'Click on body parts to view concerns.',  'group' => 'Intro Screen' ],
            'step_2'             => [ 'label' => 'Step 2',                   'default' => 'Select your concerns.',                  'group' => 'Intro Screen' ],
            'step_3'             => [ 'label' => 'Step 3',                   'default' => 'Submit & receive your personalized treatment recommendations.', 'group' => 'Intro Screen', 'type' => 'textarea' ],
            'start_btn'          => [ 'label' => 'Start Button',             'default' => 'Start Consultation',     'group' => 'Intro Screen' ],
            'start_icon'         => [ 'label' => 'Desktop Start Label',      'default' => 'Click to get started!', 'group' => 'Intro Screen' ],

            // Consultation screen
            'selections_heading' => [ 'label' => 'Selections Heading',       'default' => 'Your Selections',       'group' => 'Consultation' ],
            'finish_btn'         => [ 'label' => 'Finish Button',            'default' => 'Finish Treatment Plan', 'group' => 'Consultation' ],
            'more_btn'           => [ 'label' => 'Select More Button',       'default' => 'Select More Concerns',  'group' => 'Consultation' ],
            'clear_btn'          => [ 'label' => 'Clear All Button',         'default' => 'Clear All',             'group' => 'Consultation' ],
            'empty_state'        => [ 'label' => 'Empty State Message',      'default' => "You haven't selected any concerns.",        'group' => 'Consultation' ],
            'empty_instructions' => [ 'label' => 'Empty State Instructions', 'default' => 'Start by clicking on a body part on the model.', 'group' => 'Consultation' ],

            // Form screen
            'form_heading'       => [ 'label' => 'Form Heading',             'default' => "Almost done! \xf0\x9f\x99\x8c", 'group' => 'Form Screen' ],
            'form_intro'         => [ 'label' => 'Form Intro',               'default' => 'Enter your contact information to instantly receive your customized treatment plan!', 'group' => 'Form Screen', 'type' => 'textarea' ],
            'form_privacy'       => [ 'label' => 'Form Privacy Note',        'default' => 'All of your information will be kept private and only shared with your Alpine Wellness provider.', 'group' => 'Form Screen', 'type' => 'textarea' ],

            // Popups
            'exit_heading'       => [ 'label' => 'Exit Popup Heading',       'default' => 'Leaving so soon?',      'group' => 'Popups' ],
            'exit_body'          => [ 'label' => 'Exit Popup Body',          'default' => "If you exit out of your treatment planner now, you'll lose your custom results and have to start over.", 'group' => 'Popups', 'type' => 'textarea' ],
            'exit_confirm'       => [ 'label' => 'Exit Confirm Button',      'default' => 'Exit Treatment Planner', 'group' => 'Popups' ],
            'exit_cancel'        => [ 'label' => 'Stay Button',              'default' => "Let's Keep Going!",     'group' => 'Popups' ],
            'switch_heading'     => [ 'label' => 'Gender Switch Heading',    'default' => 'Are you sure?',         'group' => 'Popups' ],
            'switch_body'        => [ 'label' => 'Gender Switch Body',       'default' => "If you switch, you'll lose any concerns you've currently chosen.", 'group' => 'Popups', 'type' => 'textarea' ],
            'switch_cancel'      => [ 'label' => 'Switch Cancel Button',     'default' => 'Go Back',               'group' => 'Popups' ],
            'switch_confirm'     => [ 'label' => 'Switch Confirm Button',    'default' => "Let's Switch",          'group' => 'Popups' ],
        ],
    ];
}

/* ===============================================================
 * HELPERS
 * ============================================================= */

/** Resolved color — saved option → default. */
function atb_color( $key ) {
    $defaults = atb_defaults();
    $default  = $defaults['colors'][ $key ]['default'] ?? '#000000';
    $saved    = get_option( 'atb_color_' . $key, '' );
    return sanitize_hex_color( $saved ) ?: $default;
}

/** Resolved font family name. */
function atb_font() {
    return get_option( 'atb_font_family', 'Inter' );
}

/** Resolved text — saved option → default. */
function atb_text( $key ) {
    $defaults = atb_defaults();
    $default  = $defaults['text'][ $key ]['default'] ?? '';
    $saved    = get_option( 'atb_text_' . $key, '' );
    return $saved !== '' ? $saved : $default;
}

/** Is Gravity Forms active? */
function atb_gf_active() {
    return class_exists( 'GFForms' );
}

/** Gravity Form ID for the treatment builder. */
function atb_get_form_id() {
    return (int) apply_filters( 'atb_gravity_form_id', get_option( 'atb_gravity_form_id', 0 ) );
}

/** Logo URL — plugin setting → theme custom_logo → bundled fallback. */
function atb_get_logo_url() {
    $override = get_option( 'atb_logo_url', '' );
    if ( $override ) return esc_url( $override );

    $theme_logo_id = get_theme_mod( 'custom_logo' );
    if ( $theme_logo_id ) {
        $src = wp_get_attachment_image_url( $theme_logo_id, 'full' );
        if ( $src ) return esc_url( $src );
    }

    return esc_url( ATB_URL . 'public/images/alpine-logo.png' );
}

/** Should the page show the theme header and footer? */
function atb_use_theme_chrome() {
    return (bool) get_option( 'atb_use_theme_chrome', false );
}

/* ===============================================================
 * GRAVITY FORMS DEPENDENCY CHECK
 * ============================================================= */

add_action( 'admin_notices', function () {
    if ( ! atb_gf_active() ) {
        echo '<div class="notice notice-error"><p>'
            . '<strong>Alpine Treatment Builder</strong> requires '
            . '<a href="https://www.gravityforms.com/" target="_blank">Gravity Forms</a> '
            . 'to be installed and activated.</p></div>';
    }
} );

/* ===============================================================
 * PLUGIN SETTINGS PAGE
 * ============================================================= */

add_action( 'admin_menu', function () {
    add_options_page(
        __( 'Treatment Builder Settings', 'alpine-tb' ),
        __( 'Treatment Builder', 'alpine-tb' ),
        'manage_options',
        'alpine-treatment-builder',
        'atb_render_settings_page'
    );
} );

add_action( 'admin_init', function () {
    $d = atb_defaults();

    // ── General ─────────────────────────────────────────────────────────────
    register_setting( 'atb_settings_general', 'atb_gravity_form_id', [ 'sanitize_callback' => 'absint',           'default' => 0 ] );
    register_setting( 'atb_settings_general', 'atb_logo_url',        [ 'sanitize_callback' => 'esc_url_raw',      'default' => '' ] );
    register_setting( 'atb_settings_general', 'atb_use_theme_chrome',[ 'sanitize_callback' => fn($v) => $v ? '1' : '0', 'default' => '0' ] );

    // ── Branding ─────────────────────────────────────────────────────────────
    foreach ( $d['colors'] as $key => $info ) {
        register_setting( 'atb_settings_branding', 'atb_color_' . $key, [ 'sanitize_callback' => 'sanitize_hex_color', 'default' => $info['default'] ] );
    }
    register_setting( 'atb_settings_branding', 'atb_font_family', [ 'sanitize_callback' => 'sanitize_text_field', 'default' => 'Inter' ] );

    // ── Text ─────────────────────────────────────────────────────────────────
    foreach ( $d['text'] as $key => $info ) {
        register_setting( 'atb_settings_text', 'atb_text_' . $key, [ 'sanitize_callback' => 'sanitize_text_field', 'default' => '' ] );
    }
} );

add_action( 'admin_enqueue_scripts', function ( $hook ) {
    if ( 'settings_page_alpine-treatment-builder' !== $hook ) return;
    wp_enqueue_media();
    wp_enqueue_style( 'wp-color-picker' );
    wp_enqueue_script( 'wp-color-picker' );
} );

/** Render the tabbed settings page. */
function atb_render_settings_page() {
    if ( ! current_user_can( 'manage_options' ) ) return;

    $tab  = isset( $_GET['tab'] ) ? sanitize_key( $_GET['tab'] ) : 'general';
    $tabs = [ 'general' => 'General', 'branding' => 'Branding', 'text' => 'Text' ];
    $base = admin_url( 'options-general.php?page=alpine-treatment-builder' );

    $d              = atb_defaults();
    $form_id        = atb_get_form_id();
    $logo_url       = get_option( 'atb_logo_url', '' );
    $use_chrome     = get_option( 'atb_use_theme_chrome', '0' );
    $current_font   = atb_font();
    $gf_forms       = atb_gf_active() ? GFAPI::get_forms() : [];
    ?>
    <div class="wrap">
    <h1><?php esc_html_e( 'Treatment Builder Settings', 'alpine-tb' ); ?></h1>

    <style>
        .atb-nav-tab-wrapper { margin-bottom: 0; }
        .atb-color-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 24px 40px; max-width: 680px; margin-top: 8px; }
        .atb-color-field label { display: block; font-weight: 600; margin-bottom: 4px; }
        .atb-color-field .description { margin-top: 4px; color: #666; font-size: 12px; }
        .atb-font-preview { margin-top: 10px; padding: 14px 18px; background: #f9f9f9; border: 1px solid #ddd; border-radius: 4px; font-size: 20px; color: #333; transition: font-family .3s; }
        .atb-text-group { margin-bottom: 36px; }
        .atb-text-group > h3 { font-size: 14px; text-transform: uppercase; letter-spacing: .05em; color: #555; margin-bottom: 0; padding-bottom: 8px; border-bottom: 1px solid #e0e0e0; }
        .atb-text-group .form-table { margin-top: 0; }
        .atb-text-group .form-table td, .atb-text-group .form-table th { padding: 10px 10px 10px 0; }
        .atb-text-group input[type="text"] { width: 100%; max-width: 480px; }
        .atb-text-group textarea { width: 100%; max-width: 480px; height: 72px; resize: vertical; }
        .atb-section-intro { color: #555; margin-bottom: 20px; max-width: 680px; }
    </style>

    <nav class="nav-tab-wrapper atb-nav-tab-wrapper">
        <?php foreach ( $tabs as $slug => $label ) : ?>
            <a href="<?php echo esc_url( $base . '&tab=' . $slug ); ?>"
               class="nav-tab <?php echo $tab === $slug ? 'nav-tab-active' : ''; ?>">
               <?php echo esc_html( $label ); ?>
            </a>
        <?php endforeach; ?>
    </nav>

    <?php /* ══════════════ GENERAL TAB ══════════════ */ ?>
    <?php if ( $tab === 'general' ) : ?>
    <form method="post" action="options.php">
        <?php settings_fields( 'atb_settings_general' ); ?>

        <h2 class="title" style="margin-top:24px;"><?php esc_html_e( 'Gravity Forms', 'alpine-tb' ); ?></h2>
        <p class="atb-section-intro"><?php esc_html_e( 'Select the form that collects patient contact info. Add a Hidden field to it with CSS Class "atb-concerns" — the plugin populates it automatically with the body-map selections.', 'alpine-tb' ); ?></p>
        <table class="form-table" role="presentation">
            <tr>
                <th><label for="atb_gravity_form_id"><?php esc_html_e( 'Contact Form', 'alpine-tb' ); ?></label></th>
                <td>
                    <?php if ( ! atb_gf_active() ) : ?>
                        <p class="description" style="color:#d63638;"><?php esc_html_e( 'Gravity Forms is not active.', 'alpine-tb' ); ?></p>
                    <?php elseif ( empty( $gf_forms ) ) : ?>
                        <p class="description" style="color:#d63638;"><?php esc_html_e( 'No forms found. Create a form in Gravity Forms first.', 'alpine-tb' ); ?></p>
                        <input type="hidden" name="atb_gravity_form_id" value="0">
                    <?php else : ?>
                        <select name="atb_gravity_form_id" id="atb_gravity_form_id">
                            <option value="0"><?php esc_html_e( '— Select a form —', 'alpine-tb' ); ?></option>
                            <?php foreach ( $gf_forms as $gf_form ) : ?>
                                <option value="<?php echo absint( $gf_form['id'] ); ?>" <?php selected( $form_id, (int) $gf_form['id'] ); ?>>
                                    <?php echo esc_html( $gf_form['title'] ); ?> (ID: <?php echo absint( $gf_form['id'] ); ?>)
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <?php if ( $form_id > 0 ) : ?>
                            <p class="description"><a href="<?php echo esc_url( admin_url( 'admin.php?page=gf_edit_forms&id=' . $form_id ) ); ?>" target="_blank"><?php esc_html_e( 'Edit this form in Gravity Forms →', 'alpine-tb' ); ?></a></p>
                        <?php endif; ?>
                    <?php endif; ?>
                </td>
            </tr>
        </table>

        <h2 class="title"><?php esc_html_e( 'Logo', 'alpine-tb' ); ?></h2>
        <p class="atb-section-intro"><?php esc_html_e( 'Shown in the treatment builder navbar. Falls back to your theme Customizer logo, then a bundled image.', 'alpine-tb' ); ?></p>
        <table class="form-table" role="presentation">
            <tr>
                <th><label for="atb_logo_url"><?php esc_html_e( 'Custom Logo', 'alpine-tb' ); ?></label></th>
                <td>
                    <input type="hidden" name="atb_logo_url" id="atb_logo_url" value="<?php echo esc_attr( $logo_url ); ?>">
                    <?php if ( $logo_url ) : ?>
                        <img id="atb-logo-preview" src="<?php echo esc_url( $logo_url ); ?>" style="display:block;max-height:80px;max-width:300px;margin-bottom:8px;border:1px solid #ddd;padding:4px;background:#fff;">
                    <?php else : ?>
                        <img id="atb-logo-preview" src="" style="display:none;max-height:80px;max-width:300px;margin-bottom:8px;border:1px solid #ddd;padding:4px;background:#fff;">
                    <?php endif; ?>
                    <button type="button" id="atb-logo-choose" class="button"><?php echo $logo_url ? esc_html__( 'Change Logo', 'alpine-tb' ) : esc_html__( 'Choose Logo', 'alpine-tb' ); ?></button>
                    <button type="button" id="atb-logo-remove" class="button button-link-delete" style="margin-left:8px;<?php echo $logo_url ? '' : 'display:none;'; ?>"><?php esc_html_e( 'Remove', 'alpine-tb' ); ?></button>
                    <?php if ( ! $logo_url ) : ?>
                        <p class="description"><?php esc_html_e( 'Currently using:', 'alpine-tb' ); ?> <a href="<?php echo esc_url( atb_get_logo_url() ); ?>" target="_blank"><?php echo esc_url( atb_get_logo_url() ); ?></a></p>
                    <?php endif; ?>
                </td>
            </tr>
        </table>

        <h2 class="title"><?php esc_html_e( 'Layout', 'alpine-tb' ); ?></h2>
        <table class="form-table" role="presentation">
            <tr>
                <th><?php esc_html_e( 'Theme Header & Footer', 'alpine-tb' ); ?></th>
                <td>
                    <label>
                        <input type="hidden" name="atb_use_theme_chrome" value="0">
                        <input type="checkbox" name="atb_use_theme_chrome" value="1" <?php checked( $use_chrome, '1' ); ?>>
                        <?php esc_html_e( 'Show the theme header and footer on the treatment builder page', 'alpine-tb' ); ?>
                    </label>
                    <p class="description"><?php esc_html_e( 'When unchecked, the builder runs full-screen. When checked, it is embedded within the page layout.', 'alpine-tb' ); ?></p>
                </td>
            </tr>
        </table>

        <?php submit_button(); ?>
    </form>

    <?php /* ══════════════ BRANDING TAB ══════════════ */ ?>
    <?php elseif ( $tab === 'branding' ) : ?>
    <form method="post" action="options.php">
        <?php settings_fields( 'atb_settings_branding' ); ?>

        <h2 class="title" style="margin-top:24px;"><?php esc_html_e( 'Colors', 'alpine-tb' ); ?></h2>
        <p class="atb-section-intro"><?php esc_html_e( 'These colors are applied as CSS custom properties throughout the treatment builder. Changes take effect immediately on save.', 'alpine-tb' ); ?></p>

        <div class="atb-color-grid">
            <?php foreach ( $d['colors'] as $key => $info ) :
                $option_name  = 'atb_color_' . $key;
                $saved        = get_option( $option_name, '' );
                $value        = sanitize_hex_color( $saved ) ?: $info['default'];
            ?>
            <div class="atb-color-field">
                <label for="<?php echo esc_attr( $option_name ); ?>"><?php echo esc_html( $info['label'] ); ?></label>
                <input type="text"
                       name="<?php echo esc_attr( $option_name ); ?>"
                       id="<?php echo esc_attr( $option_name ); ?>"
                       value="<?php echo esc_attr( $value ); ?>"
                       class="atb-color-picker"
                       data-default-color="<?php echo esc_attr( $info['default'] ); ?>">
                <p class="description"><?php echo esc_html( $info['desc'] ); ?></p>
            </div>
            <?php endforeach; ?>
        </div>

        <h2 class="title" style="margin-top:36px;"><?php esc_html_e( 'Typography', 'alpine-tb' ); ?></h2>
        <p class="atb-section-intro"><?php esc_html_e( 'Choose a Google Font for the treatment builder. The selected font is loaded automatically.', 'alpine-tb' ); ?></p>

        <table class="form-table" role="presentation">
            <tr>
                <th><label for="atb_font_family"><?php esc_html_e( 'Font Family', 'alpine-tb' ); ?></label></th>
                <td>
                    <select name="atb_font_family" id="atb_font_family">
                        <?php foreach ( $d['fonts'] as $font ) : ?>
                            <option value="<?php echo esc_attr( $font ); ?>" <?php selected( $current_font, $font ); ?>><?php echo esc_html( $font ); ?></option>
                        <?php endforeach; ?>
                    </select>
                    <p id="atb-font-preview" class="atb-font-preview">
                        The quick brown fox jumps over the lazy dog — 0123456789
                    </p>
                </td>
            </tr>
        </table>

        <?php submit_button(); ?>
    </form>

    <?php /* ══════════════ TEXT TAB ══════════════ */ ?>
    <?php elseif ( $tab === 'text' ) : ?>
    <form method="post" action="options.php">
        <?php settings_fields( 'atb_settings_text' ); ?>
        <p class="atb-section-intro" style="margin-top:16px;"><?php esc_html_e( 'Override any text shown in the treatment builder. Leave a field blank to keep the default, which is shown as placeholder text.', 'alpine-tb' ); ?></p>

        <?php
        $groups = [];
        foreach ( $d['text'] as $key => $info ) {
            $groups[ $info['group'] ][ $key ] = $info;
        }
        foreach ( $groups as $group_name => $fields ) : ?>
        <div class="atb-text-group">
            <h3><?php echo esc_html( $group_name ); ?></h3>
            <table class="form-table" role="presentation">
                <?php foreach ( $fields as $key => $info ) :
                    $option_name = 'atb_text_' . $key;
                    $saved       = get_option( $option_name, '' );
                    $is_textarea = ! empty( $info['type'] ) && $info['type'] === 'textarea';
                ?>
                <tr>
                    <th><label for="<?php echo esc_attr( $option_name ); ?>"><?php echo esc_html( $info['label'] ); ?></label></th>
                    <td>
                        <?php if ( $is_textarea ) : ?>
                            <textarea name="<?php echo esc_attr( $option_name ); ?>"
                                      id="<?php echo esc_attr( $option_name ); ?>"
                                      placeholder="<?php echo esc_attr( $info['default'] ); ?>"
                                      rows="3"><?php echo esc_textarea( $saved ); ?></textarea>
                        <?php else : ?>
                            <input type="text"
                                   name="<?php echo esc_attr( $option_name ); ?>"
                                   id="<?php echo esc_attr( $option_name ); ?>"
                                   value="<?php echo esc_attr( $saved ); ?>"
                                   placeholder="<?php echo esc_attr( $info['default'] ); ?>">
                        <?php endif; ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </table>
        </div>
        <?php endforeach; ?>

        <?php submit_button(); ?>
    </form>
    <?php endif; ?>

    </div><!-- .wrap -->

    <script>
    (function($){
        /* ── Color pickers ── */
        $('.atb-color-picker').each(function(){
            $(this).wpColorPicker({ defaultColor: $(this).data('default-color') });
        });

        /* ── Logo media picker ── */
        var frame;
        $(document).on('click', '#atb-logo-choose', function(e){
            e.preventDefault();
            if ( frame ) { frame.open(); return; }
            frame = wp.media({ title: 'Choose Logo', button: { text: 'Use this image' }, multiple: false, library: { type: 'image' } });
            frame.on('select', function(){
                var att = frame.state().get('selection').first().toJSON();
                $('#atb_logo_url').val( att.url );
                $('#atb-logo-preview').attr('src', att.url).show();
                $('#atb-logo-remove').show();
                $('#atb-logo-choose').text('Change Logo');
            });
            frame.open();
        });
        $(document).on('click', '#atb-logo-remove', function(e){
            e.preventDefault();
            $('#atb_logo_url').val('');
            $('#atb-logo-preview').attr('src','').hide();
            $(this).hide();
            $('#atb-logo-choose').text('Choose Logo');
        });

        /* ── Font preview ── */
        var $fontSelect   = $('#atb_font_family');
        var $fontPreview  = $('#atb-font-preview');
        var loadedFonts   = {};

        function loadFont( font ) {
            if ( loadedFonts[font] ) { applyFont( font ); return; }
            var link  = document.createElement('link');
            link.rel  = 'stylesheet';
            link.href = 'https://fonts.googleapis.com/css2?family=' + encodeURIComponent(font).replace(/%20/g,'+') + ':wght@400;600&display=swap';
            document.head.appendChild( link );
            loadedFonts[font] = true;
            applyFont( font );
        }

        function applyFont( font ) {
            $fontPreview.css('font-family', "'" + font + "', sans-serif");
        }

        $fontSelect.on('change', function(){ loadFont( $(this).val() ); });
        if ( $fontSelect.length ) loadFont( $fontSelect.val() );

    })(jQuery);
    </script>
    <?php
}

/* ===============================================================
 * GRAVITY FORMS: append concerns list to admin notification
 * ============================================================= */

add_filter( 'gform_notification', function ( $notification, $form, $entry ) {
    if ( (int) $form['id'] !== atb_get_form_id() ) return $notification;

    $concerns_value = '';
    foreach ( $form['fields'] as $field ) {
        if ( strpos( $field->cssClass ?? '', 'atb-concerns' ) !== false ) {
            $concerns_value = rgar( $entry, (string) $field->id );
            break;
        }
    }

    if ( $concerns_value ) {
        $items = json_decode( $concerns_value, true );
        if ( is_array( $items ) && ! empty( $items ) ) {
            $list = implode( "\n", array_map( fn( $i ) => '  • ' . $i, $items ) );
            $notification['message'] .= "\n\nSelected Treatment Areas:\n" . $list;
        }
    }

    return $notification;
}, 10, 3 );

/* ===============================================================
 * PAGE DETECTION + BODY CLASS
 * ============================================================= */

function atb_page_has_shortcode() {
    global $post;
    return is_a( $post, 'WP_Post' ) && has_shortcode( $post->post_content, 'alpine_treatment_builder' );
}

add_filter( 'body_class', function ( $classes ) {
    if ( atb_page_has_shortcode() ) {
        $classes[] = 'atb-page';
        if ( atb_use_theme_chrome() ) $classes[] = 'atb-page--with-chrome';
    }
    return $classes;
} );

/* ===============================================================
 * ASSETS
 * ============================================================= */

add_action( 'wp_enqueue_scripts', function () {

    // ── Font ─────────────────────────────────────────────────────────────────
    $font       = atb_font();
    $font_param = str_replace( ' ', '+', $font );
    wp_enqueue_style( 'atb-font', "https://fonts.googleapis.com/css2?family={$font_param}:wght@400;500;600;700&display=swap", [], null );

    wp_enqueue_style( 'atb-styles', ATB_URL . 'public/css/alpine-tb.css', [ 'atb-font' ], ATB_VERSION );

    // ── Dynamic CSS ───────────────────────────────────────────────────────────
    $inline_css = '
        :root {
            --llvcBaseBackground:              ' . atb_color('base_bg')      . ';
            --llvcHeader:                      ' . atb_color('header')       . ';
            --llvcBodyText:                    ' . atb_color('body_text')    . ';
            --llvcPrimary:                     ' . atb_color('primary')      . ';
            --llvcSecondaryButtons:            ' . atb_color('secondary')    . ';
            --llvcMisc:                        ' . atb_color('secondary')    . ';
            --llvcMisc2:                       ' . atb_color('secondary')    . ';
            --llvcCardText:                    ' . atb_color('body_text')    . ';
            --llvcBodyOutlineGradientTop:      ' . atb_color('body_text')    . ';
            --llvcBodyOutlineGradientBottom:   ' . atb_color('body_text')    . ';
            --llvcNavbarBackground:            ' . atb_color('navbar_bg')    . ';
            --llvcNavbarLink:                  ' . atb_color('navbar_link')  . ';
            --llvcNavbarLinkHover:             ' . atb_color('navbar_hover') . ';
            --llvcShadow:                      rgba(0,0,0,0.24);
            --llvcTopOffset:                   calc(var(--wp-admin--admin-bar--height, 0px) + 58px);
        }

        /* ---- Font override ---- */
        .llvc, .llvc--results, .llvc-navbar {
            font-family: \'' . esc_attr( $font ) . '\', sans-serif !important;
        }

        /* ---- Icon sizing ---- */
        .llvc .icon, .llvc-navbar .icon {
            display: inline-block; height: 1em; width: 1em;
            fill: currentColor; stroke: currentColor; stroke-width: 0;
            vertical-align: -10%; overflow: hidden;
        }

        /* ---- Global button reset (Astra overrides) ---- */
        .llvc button, .llvc-navbar button {
            padding: 0 !important; margin: 0 !important;
            min-width: 0 !important; min-height: 0 !important;
            line-height: normal !important; font-family: inherit !important;
            font-size: inherit !important; cursor: pointer !important;
            background-color: transparent !important; color: inherit !important;
            border: none !important; box-shadow: none !important;
        }
        .llvc .llvc__button {
            padding: 14px 24px !important;
            background-color: var(--llvcBodyText) !important;
            color: #fff !important; font-weight: 600 !important;
            text-align: center !important; border-radius: 4px !important;
        }

        /* ---- Gradient SVG — hidden ---- */
        .llvc__body-outline-svg {
            position: absolute !important; visibility: hidden !important;
            width: 0 !important; height: 0 !important;
            overflow: hidden !important; pointer-events: none !important;
        }

        /* ---- Hotspot circles ---- */
        .llvc--concerns .llvc__body .llvc__concern-area .llvc__concern-area__circle {
            height: 24px !important; width: 24px !important;
            min-height: 0 !important; border-radius: 50% !important;
            background-color: #fff !important;
            box-shadow: 0 2px 8px var(--llvcShadow) !important;
        }
        .llvc--concerns .llvc__body .llvc__face-toggle--main,
        .llvc--concerns .llvc__body .llvc__mouth-toggle--main {
            height: 24px !important; width: 24px !important;
            min-height: 0 !important; border-radius: 50% !important;
            background-color: #fff !important;
        }
        .llvc--concerns .llvc__turn {
            height: 48px !important; width: 48px !important;
            min-height: 0 !important; border-radius: 50% !important;
            background-color: #fff !important;
            box-shadow: 0 4px 12px var(--llvcShadow) !important;
            color: var(--llvcBodyText) !important;
        }

        /* ---- Gravity Forms field list reset ---- */
        .llvc__form .gform_fields {
            list-style: none !important; padding: 0 !important; margin: 0 !important;
        }
        .llvc__form .gform_fields .gfield { margin-bottom: 16px !important; }

        /* ---- Left column white background ---- */
        .llvc--concerns .llvc__body-column { background-color: #fff !important; }

        /* ---- Body nav: remove Astra bullets ---- */
        .llvc--concerns .llvc__body__nav {
            list-style: none !important; padding-left: 0 !important; margin-left: 0 !important;
        }

        /* ---- How to Use + Gender switch: fix font size ---- */
        .llvc--concerns .llvc__body__nav .llvc__how-to-use__toggle,
        .llvc--concerns .llvc__body__nav .llvc__gender-choice {
            font-size: 14px !important;
        }

        /* ---- Step number lists: hide Astra default marker ---- */
        .llvc__content ol, .llvc__how-to-use ol { list-style: none !important; }

        /* ---- Hotspot hover tooltip ---- */
        .llvc--concerns .llvc__body .llvc__concern-area.is-hovering {
            transform: translate(-50%, -50%) scale(1.3) !important;
        }
        .llvc--concerns .llvc__body .llvc__concern-area.is-hovering .llvc__concern-area__title {
            visibility: visible !important; opacity: 1 !important;
            transform: translateX(-50%) !important;
        }
        .llvc--concerns .llvc__body .llvc__concern-area.is-hovering .llvc__concern-area__circle {
            background-color: var(--llvcPrimary) !important; color: #fff !important;
        }

        /* ---- Finish button — hidden until a concern is selected ---- */
        .llvc__concerns__footer .llvc__finish-consultation { display: none; }
        .llvc__concerns__footer .llvc__finish-consultation.has-concerns { display: inline-block; }

        /* ---- Your Selections heading size ---- */
        .llvc .llvc__heading.llvc__heading--concerns {
            font-size: 18px !important; line-height: 1.3 !important; font-weight: 700 !important;
        }
    ';

    // ── Full-screen mode ──────────────────────────────────────────────────────
    $inline_css .= '

        /* ── FULL-SCREEN (no theme chrome) ── */
        body.atb-page:not(.atb-page--with-chrome) .llvc--concerns .llvc__screen.is-active {
            position: fixed !important; top: var(--llvcTopOffset) !important;
            left: 0 !important; width: 100% !important;
            height: calc(100vh - var(--llvcTopOffset)) !important;
            overflow-y: auto !important; overflow-x: hidden !important;
            z-index: 9990 !important; background-color: #fff !important;
        }
        body.atb-page:not(.atb-page--with-chrome) {
            overflow: hidden; background-color: #fff !important; background-image: none !important;
        }
        body.atb-page:not(.atb-page--with-chrome) .llvc__intro {
            background-color: #fff !important;
        }
        body.atb-page:not(.atb-page--with-chrome) .fl-row,
        body.atb-page:not(.atb-page--with-chrome) .fl-row-content,
        body.atb-page:not(.atb-page--with-chrome) .fl-col,
        body.atb-page:not(.atb-page--with-chrome) .fl-module-content,
        body.atb-page:not(.atb-page--with-chrome) [class*="ast-container"],
        body.atb-page:not(.atb-page--with-chrome) .site-content,
        body.atb-page:not(.atb-page--with-chrome) #content {
            background: transparent !important; background-image: none !important;
        }
        body.atb-page:not(.atb-page--with-chrome) header:not(.llvc-navbar),
        body.atb-page:not(.atb-page--with-chrome) .site-header,
        body.atb-page:not(.atb-page--with-chrome) .navbar,
        body.atb-page:not(.atb-page--with-chrome) footer,
        body.atb-page:not(.atb-page--with-chrome) .site-footer,
        body.atb-page:not(.atb-page--with-chrome) .entry-header,
        body.atb-page:not(.atb-page--with-chrome) h1.entry-title,
        body.atb-page:not(.atb-page--with-chrome) .page-title,
        body.atb-page:not(.atb-page--with-chrome) .site-main > .page-header { display: none !important; }
        body.atb-page:not(.atb-page--with-chrome) main,
        body.atb-page:not(.atb-page--with-chrome) .site-main,
        body.atb-page:not(.atb-page--with-chrome) .entry-content,
        body.atb-page:not(.atb-page--with-chrome) .content-area,
        body.atb-page:not(.atb-page--with-chrome) .wrap,
        body.atb-page:not(.atb-page--with-chrome) .container:not(.llvc__container) {
            padding: 0 !important; margin: 0 !important;
            max-width: 100% !important; width: 100% !important;
        }

        /* ── WITH-CHROME (theme header/footer visible) ── */
        body.atb-page--with-chrome .llvc-navbar {
            position: sticky !important; top: 0 !important; z-index: 100 !important;
        }
        body.atb-page--with-chrome.logged-in.admin-bar .llvc-navbar {
            top: var(--wp-admin--admin-bar--height, 32px) !important;
        }
        body.atb-page--with-chrome { --llvcTopOffset: 0px; }
        body.atb-page--with-chrome .llvc__intro {
            position: relative !important; top: auto !important; left: auto !important;
            width: 100% !important; height: auto !important; min-height: 70vh !important;
            overflow: visible !important; z-index: auto !important;
        }
        body.atb-page--with-chrome .llvc--concerns .llvc__screen.is-active {
            position: relative !important; top: auto !important; left: auto !important;
            width: 100% !important; height: auto !important; min-height: 70vh !important;
            overflow: visible !important; z-index: auto !important;
            background-color: #fff !important;
        }
        body.atb-page--with-chrome .llvc,
        body.atb-page--with-chrome .llvc--concerns {
            width: 100% !important; max-width: 100% !important; box-sizing: border-box !important;
        }
        body.atb-page--with-chrome .entry-content,
        body.atb-page--with-chrome .site-main,
        body.atb-page--with-chrome main,
        body.atb-page--with-chrome .content-area {
            width: 100% !important; max-width: 100% !important;
            padding-left: 0 !important; padding-right: 0 !important;
        }
        body.atb-page--with-chrome .entry-header,
        body.atb-page--with-chrome h1.entry-title,
        body.atb-page--with-chrome .page-title,
        body.atb-page--with-chrome .site-main > .page-header { display: none !important; }
    ';

    wp_add_inline_style( 'atb-styles', $inline_css );

    wp_enqueue_script( 'atb-script', ATB_URL . 'public/js/alpine-tb.js', [ 'jquery' ], ATB_VERSION, true );
    wp_localize_script( 'atb-script', 'atbConfig', [
        'ajaxUrl' => admin_url( 'admin-ajax.php' ),
        'nonce'   => wp_create_nonce( 'atb_nonce' ),
        'homeUrl' => esc_url( home_url() ),
        'svgUrl'  => ATB_URL . 'public/svg/',
    ] );
} );

/* ===============================================================
 * SHORTCODE  [alpine_treatment_builder]
 * ============================================================= */

add_shortcode( 'alpine_treatment_builder', function () {
    ob_start();
    include ATB_PATH . 'templates/main.php';
    return ob_get_clean();
} );

/* ===============================================================
 * Form submission is handled entirely by Gravity Forms.
 * ============================================================= */
