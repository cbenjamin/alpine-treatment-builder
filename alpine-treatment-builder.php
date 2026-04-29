<?php
/**
 * Plugin Name: Alpine Treatment Builder
 * Plugin URI:  https://www.alpinewellnessnv.com/
 * Description: Interactive body-map treatment planner for Alpine Wellness.
 * Version:     1.0.1
 * Author:      Alpine Wellness
 * Text Domain: alpine-tb
 */

defined( 'ABSPATH' ) || exit;

define( 'ATB_VERSION', '1.0.1' );
define( 'ATB_URL',     plugin_dir_url( __FILE__ ) );
define( 'ATB_PATH',    plugin_dir_path( __FILE__ ) );

/* ===============================================================
 * AUTOMATIC UPDATES VIA GITHUB
 * Uses: https://github.com/YahnisElsts/plugin-update-checker
 *
 * How to release an update:
 *  1. Bump ATB_VERSION above and the "Version:" header at the top.
 *  2. Commit + push to GitHub.
 *  3. Create a GitHub Release tagged vX.Y.Z — WordPress sites will
 *     see the update prompt within 12 hours (or "Check Again" now).
 * ============================================================= */
require_once ATB_PATH . 'lib/plugin-update-checker/plugin-update-checker.php';

use YahnisElsts\PluginUpdateChecker\v5\PucFactory;

$atb_updater = PucFactory::buildUpdateChecker(
    'https://github.com/cbenjamin/alpine-treatment-builder',
    __FILE__,
    'alpine-treatment-builder'
);

// If the GitHub repo is private, supply a personal access token here
// (read:repo scope is enough — store it in wp-config.php as a constant
//  rather than hard-coding it):
//   define( 'ATB_GITHUB_TOKEN', 'ghp_xxxxxxxxxxxx' );
if ( defined( 'ATB_GITHUB_TOKEN' ) && ATB_GITHUB_TOKEN ) {
    $atb_updater->setAuthentication( ATB_GITHUB_TOKEN );
}

// Pull version info from GitHub Releases (tags), not branch heads
$atb_updater->setBranch( 'main' );
$atb_updater->getVcsApi()->enableReleaseAssets();

/* ===============================================================
 * HELPERS
 * ============================================================= */

/** Is Gravity Forms active? */
function atb_gf_active() {
    return class_exists( 'GFForms' );
}

/** Gravity Form ID for the treatment builder (set on the settings page). */
function atb_get_form_id() {
    return (int) apply_filters( 'atb_gravity_form_id', get_option( 'atb_gravity_form_id', 0 ) );
}

/**
 * Logo URL — priority: plugin setting → theme custom logo → bundled image.
 * Returns an already-escaped URL ready for HTML output.
 */
function atb_get_logo_url() {
    $override = get_option( 'atb_logo_url', '' );
    if ( $override ) {
        return esc_url( $override );
    }

    // Theme custom logo (Customizer → Site Identity)
    $theme_logo_id = get_theme_mod( 'custom_logo' );
    if ( $theme_logo_id ) {
        $src = wp_get_attachment_image_url( $theme_logo_id, 'full' );
        if ( $src ) {
            return esc_url( $src );
        }
    }

    // Bundled fallback
    return esc_url( ATB_URL . 'public/images/alpine-logo.png' );
}

/** Should the page show the theme's native header and footer? */
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

/** Register settings page under Settings menu. */
add_action( 'admin_menu', function () {
    add_options_page(
        __( 'Treatment Builder Settings', 'alpine-tb' ),
        __( 'Treatment Builder', 'alpine-tb' ),
        'manage_options',
        'alpine-treatment-builder',
        'atb_render_settings_page'
    );
} );

/** Register individual options with sanitisation. */
add_action( 'admin_init', function () {
    register_setting( 'atb_settings', 'atb_gravity_form_id', [
        'type'              => 'integer',
        'sanitize_callback' => 'absint',
        'default'           => 0,
    ] );
    register_setting( 'atb_settings', 'atb_logo_url', [
        'type'              => 'string',
        'sanitize_callback' => 'esc_url_raw',
        'default'           => '',
    ] );
    register_setting( 'atb_settings', 'atb_use_theme_chrome', [
        'type'              => 'boolean',
        'sanitize_callback' => function ( $v ) { return (bool) $v ? '1' : '0'; },
        'default'           => '0',
    ] );
} );

/** Enqueue WP media uploader only on the ATB settings page. */
add_action( 'admin_enqueue_scripts', function ( $hook ) {
    if ( 'settings_page_alpine-treatment-builder' !== $hook ) {
        return;
    }
    wp_enqueue_media();
} );

/** Render the settings page HTML. */
function atb_render_settings_page() {
    if ( ! current_user_can( 'manage_options' ) ) {
        return;
    }

    $form_id          = atb_get_form_id();
    $logo_url         = get_option( 'atb_logo_url', '' );
    $use_theme_chrome = get_option( 'atb_use_theme_chrome', '0' );

    // Build GF form list for the dropdown (if GF is active)
    $gf_forms = [];
    if ( atb_gf_active() ) {
        $gf_forms = GFAPI::get_forms();
    }
    ?>
    <div class="wrap">
        <h1><?php esc_html_e( 'Treatment Builder Settings', 'alpine-tb' ); ?></h1>
        <form method="post" action="options.php">
            <?php settings_fields( 'atb_settings' ); ?>

            <!-- ── Gravity Forms ────────────────────────────────────────── -->
            <h2 class="title"><?php esc_html_e( 'Gravity Forms', 'alpine-tb' ); ?></h2>
            <p><?php esc_html_e( 'Select the Gravity Form that collects patient contact information. Add a Hidden field to that form and set its CSS Class to "atb-concerns" — the plugin will populate it automatically with the patient\'s body-map selections before submission.', 'alpine-tb' ); ?></p>
            <table class="form-table" role="presentation">
                <tr>
                    <th scope="row">
                        <label for="atb_gravity_form_id"><?php esc_html_e( 'Contact Form', 'alpine-tb' ); ?></label>
                    </th>
                    <td>
                        <?php if ( ! atb_gf_active() ) : ?>
                            <p class="description" style="color:#d63638;">
                                <?php esc_html_e( 'Gravity Forms is not active. Please install and activate it first.', 'alpine-tb' ); ?>
                            </p>
                        <?php elseif ( empty( $gf_forms ) ) : ?>
                            <p class="description" style="color:#d63638;">
                                <?php esc_html_e( 'No Gravity Forms found. Create a form in Gravity Forms first.', 'alpine-tb' ); ?>
                            </p>
                            <input type="hidden" name="atb_gravity_form_id" value="0">
                        <?php else : ?>
                            <select name="atb_gravity_form_id" id="atb_gravity_form_id">
                                <option value="0"><?php esc_html_e( '— Select a form —', 'alpine-tb' ); ?></option>
                                <?php foreach ( $gf_forms as $gf_form ) : ?>
                                    <option value="<?php echo absint( $gf_form['id'] ); ?>"
                                        <?php selected( $form_id, (int) $gf_form['id'] ); ?>>
                                        <?php echo esc_html( $gf_form['title'] ); ?> (ID: <?php echo absint( $gf_form['id'] ); ?>)
                                    </option>
                                <?php endforeach; ?>
                            </select>
                            <?php if ( $form_id > 0 ) : ?>
                                <p class="description">
                                    <a href="<?php echo esc_url( admin_url( 'admin.php?page=gf_edit_forms&id=' . $form_id ) ); ?>" target="_blank">
                                        <?php esc_html_e( 'Edit this form in Gravity Forms →', 'alpine-tb' ); ?>
                                    </a>
                                </p>
                            <?php endif; ?>
                        <?php endif; ?>
                    </td>
                </tr>
            </table>

            <!-- ── Branding ─────────────────────────────────────────────── -->
            <h2 class="title"><?php esc_html_e( 'Branding', 'alpine-tb' ); ?></h2>
            <p><?php esc_html_e( 'The logo displayed in the treatment builder navbar. Leave blank to use the logo set in your theme\'s Customizer (Site Identity → Logo). If neither is set, a bundled Alpine Wellness logo is used as a fallback.', 'alpine-tb' ); ?></p>
            <table class="form-table" role="presentation">
                <tr>
                    <th scope="row">
                        <label for="atb_logo_url"><?php esc_html_e( 'Custom Logo', 'alpine-tb' ); ?></label>
                    </th>
                    <td>
                        <input type="hidden" name="atb_logo_url" id="atb_logo_url"
                            value="<?php echo esc_attr( $logo_url ); ?>">

                        <?php if ( $logo_url ) : ?>
                            <img id="atb-logo-preview" src="<?php echo esc_url( $logo_url ); ?>"
                                style="display:block;max-height:80px;max-width:300px;margin-bottom:8px;border:1px solid #ddd;padding:4px;background:#fff;">
                        <?php else : ?>
                            <img id="atb-logo-preview" src=""
                                style="display:none;max-height:80px;max-width:300px;margin-bottom:8px;border:1px solid #ddd;padding:4px;background:#fff;">
                        <?php endif; ?>

                        <button type="button" id="atb-logo-choose" class="button">
                            <?php echo $logo_url ? esc_html__( 'Change Logo', 'alpine-tb' ) : esc_html__( 'Choose Logo', 'alpine-tb' ); ?>
                        </button>
                        <button type="button" id="atb-logo-remove" class="button button-link-delete"
                            style="margin-left:8px;<?php echo $logo_url ? '' : 'display:none;'; ?>">
                            <?php esc_html_e( 'Remove', 'alpine-tb' ); ?>
                        </button>

                        <p class="description" style="margin-top:8px;">
                            <?php esc_html_e( 'Recommended: SVG or PNG with transparent background, at least 200px wide.', 'alpine-tb' ); ?>
                        </p>

                        <?php
                        // Show the logo that will actually be used (resolved priority)
                        $resolved = atb_get_logo_url();
                        if ( ! $logo_url ) :
                        ?>
                            <p class="description">
                                <?php esc_html_e( 'Currently using:', 'alpine-tb' ); ?>
                                <a href="<?php echo esc_url( $resolved ); ?>" target="_blank"><?php echo esc_url( $resolved ); ?></a>
                            </p>
                        <?php endif; ?>
                    </td>
                </tr>
            </table>

            <!-- ── Layout ───────────────────────────────────────────────── -->
            <h2 class="title"><?php esc_html_e( 'Layout', 'alpine-tb' ); ?></h2>
            <table class="form-table" role="presentation">
                <tr>
                    <th scope="row"><?php esc_html_e( 'Theme Header &amp; Footer', 'alpine-tb' ); ?></th>
                    <td>
                        <label>
                            <?php /* Hidden field ensures a value is always submitted when the checkbox is unchecked */ ?>
                            <input type="hidden" name="atb_use_theme_chrome" value="0">
                            <input type="checkbox" name="atb_use_theme_chrome" value="1"
                                <?php checked( $use_theme_chrome, '1' ); ?>>
                            <?php esc_html_e( 'Show the theme\'s header and footer on the treatment builder page', 'alpine-tb' ); ?>
                        </label>
                        <p class="description">
                            <?php esc_html_e( 'When unchecked (default), the treatment builder runs full-screen — the theme header, footer, and page title are hidden so the experience is distraction-free. Enable this to keep them visible.', 'alpine-tb' ); ?>
                        </p>
                    </td>
                </tr>
            </table>

            <?php submit_button(); ?>
        </form>
    </div>

    <script>
    (function($){
        var frame;

        $(document).on('click', '#atb-logo-choose', function(e){
            e.preventDefault();
            if ( frame ) { frame.open(); return; }
            frame = wp.media({
                title: 'Choose Logo',
                button: { text: 'Use this image' },
                multiple: false,
                library: { type: 'image' }
            });
            frame.on('select', function(){
                var att = frame.state().get('selection').first().toJSON();
                $('#atb_logo_url').val( att.url );
                $('#atb-logo-preview').attr( 'src', att.url ).show();
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
    })(jQuery);
    </script>
    <?php
}

/* ===============================================================
 * GRAVITY FORMS: enrich admin notification with concerns list
 * ============================================================= */

add_filter( 'gform_notification', function ( $notification, $form, $entry ) {
    if ( (int) $form['id'] !== atb_get_form_id() ) {
        return $notification;
    }

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
 * PAGE DETECTION
 * ============================================================= */

function atb_page_has_shortcode() {
    global $post;
    return is_a( $post, 'WP_Post' ) && has_shortcode( $post->post_content, 'alpine_treatment_builder' );
}

add_filter( 'body_class', function ( $classes ) {
    if ( atb_page_has_shortcode() ) {
        $classes[] = 'atb-page';
        if ( atb_use_theme_chrome() ) {
            $classes[] = 'atb-page--with-chrome';
        }
    }
    return $classes;
} );

/* ===============================================================
 * ASSETS
 * ============================================================= */

add_action( 'wp_enqueue_scripts', function () {
    wp_enqueue_style(
        'inter-font',
        'https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap',
        [],
        null
    );
    wp_enqueue_style(
        'atb-styles',
        ATB_URL . 'public/css/alpine-tb.css',
        [ 'inter-font' ],
        ATB_VERSION
    );

    // ── Brand tokens + layout overrides ────────────────────────────────────
    $inline_css = '
        :root {
            --llvcBaseBackground:              #f1eadb;
            --llvcHeader:                      #091714;
            --llvcBodyText:                    #21403e;
            --llvcPrimary:                     #a3663c;
            --llvcSecondaryButtons:            #666a6b;
            --llvcMisc:                        #9aa0a0;
            --llvcMisc2:                       #a1a7a8;
            --llvcCardText:                    #21403e;
            --llvcBodyOutlineGradientTop:      #21403e;
            --llvcBodyOutlineGradientBottom:   #21403e;
            --llvcNavbarBackground:            #0d211d;
            --llvcNavbarLink:                  #f7f4ef;
            --llvcNavbarLinkHover:             #c97e4a;
            --llvcShadow:                      rgba(0,0,0,0.24);
            --llvcTopOffset:                   calc(var(--wp-admin--admin-bar--height, 0px) + 58px);
        }

        /* ---- Icon sizing ---- */
        .llvc .icon, .llvc-navbar .icon {
            display: inline-block;
            height: 1em;
            width: 1em;
            fill: currentColor;
            stroke: currentColor;
            stroke-width: 0;
            vertical-align: -10%;
            overflow: hidden;
        }

        /* ---- Global button reset (Astra sets padding/bg/color on all buttons) ---- */
        .llvc button, .llvc-navbar button {
            padding: 0 !important;
            margin: 0 !important;
            min-width: 0 !important;
            min-height: 0 !important;
            line-height: normal !important;
            font-family: inherit !important;
            font-size: inherit !important;
            cursor: pointer !important;
            background-color: transparent !important;
            color: inherit !important;
            border: none !important;
            box-shadow: none !important;
        }
        /* Re-apply styles for real CTA buttons */
        .llvc .llvc__button {
            padding: 14px 24px !important;
            background-color: var(--llvcBodyText) !important;
            color: #fff !important;
            font-weight: 600 !important;
            text-align: center !important;
            border-radius: 4px !important;
        }

        /* ---- Gradient definition SVG — hidden, zero-size, out of flow ---- */
        .llvc__body-outline-svg {
            position: absolute !important;
            visibility: hidden !important;
            width: 0 !important;
            height: 0 !important;
            overflow: hidden !important;
            pointer-events: none !important;
        }

        /* ---- Hotspot circles ---- */
        .llvc--concerns .llvc__body .llvc__concern-area .llvc__concern-area__circle {
            height: 24px !important;
            width: 24px !important;
            min-height: 0 !important;
            border-radius: 50% !important;
            background-color: #fff !important;
            box-shadow: 0 2px 8px var(--llvcShadow) !important;
        }
        /* Face/mouth toggles */
        .llvc--concerns .llvc__body .llvc__face-toggle--main,
        .llvc--concerns .llvc__body .llvc__mouth-toggle--main {
            height: 24px !important;
            width: 24px !important;
            min-height: 0 !important;
            border-radius: 50% !important;
            background-color: #fff !important;
        }
        /* Turn buttons */
        .llvc--concerns .llvc__turn {
            height: 48px !important;
            width: 48px !important;
            min-height: 0 !important;
            border-radius: 50% !important;
            background-color: #fff !important;
            box-shadow: 0 4px 12px var(--llvcShadow) !important;
            color: var(--llvcBodyText) !important;
        }

        /* ---- Gravity Forms field list reset ---- */
        .llvc__form .gform_fields {
            list-style: none !important;
            padding: 0 !important;
            margin: 0 !important;
        }
        .llvc__form .gform_fields .gfield {
            margin-bottom: 16px !important;
        }

        /* ---- Left column white background ---- */
        .llvc--concerns .llvc__body-column {
            background-color: #fff !important;
        }

        /* ---- Body nav (How to Use / Gender switch): remove Astra bullet points ---- */
        .llvc--concerns .llvc__body__nav {
            list-style: none !important;
            padding-left: 0 !important;
            margin-left: 0 !important;
        }

        /* ---- How to Use toggle + Gender switch: match font size.
                Astra font-size:inherit overrides the plugin 14px rule via our button reset ---- */
        .llvc--concerns .llvc__body__nav .llvc__how-to-use__toggle,
        .llvc--concerns .llvc__body__nav .llvc__gender-choice {
            font-size: 14px !important;
        }

        /* ---- Intro & how-to-use step numbers: hide default Astra list-item marker
                so the custom ::before counter is the only number shown ---- */
        .llvc__content ol,
        .llvc__how-to-use ol {
            list-style: none !important;
        }

        /* ---- Hotspot hover tooltip ---- */
        .llvc--concerns .llvc__body .llvc__concern-area.is-hovering {
            transform: translate(-50%, -50%) scale(1.3) !important;
        }
        .llvc--concerns .llvc__body .llvc__concern-area.is-hovering .llvc__concern-area__title {
            visibility: visible !important;
            opacity: 1 !important;
            transform: translateX(-50%) !important;
        }
        .llvc--concerns .llvc__body .llvc__concern-area.is-hovering .llvc__concern-area__circle {
            background-color: var(--llvcPrimary) !important;
            color: #fff !important;
        }

        /* ---- Finish Treatment Plan button — hidden until a concern is selected ---- */
        .llvc__concerns__footer .llvc__finish-consultation {
            display: none;
        }
        .llvc__concerns__footer .llvc__finish-consultation.has-concerns {
            display: inline-block;
        }

        /* ---- "Your Selections" heading size fix ---- */
        .llvc .llvc__heading.llvc__heading--concerns {
            font-size: 18px !important;
            line-height: 1.3 !important;
            font-weight: 700 !important;
        }

    ';

    // ── Full-screen mode (no theme chrome) — scoped to body.atb-page:not(.atb-page--with-chrome)
    // Always output; the body class controls which rules apply.
    $inline_css .= '

        /* ── FULL-SCREEN MODE (default, no theme chrome) ─────────────────── */

        /* Active screens — full-viewport fixed overlay */
        body.atb-page:not(.atb-page--with-chrome) .llvc--concerns .llvc__screen.is-active {
            position: fixed !important;
            top: var(--llvcTopOffset) !important;
            left: 0 !important;
            width: 100% !important;
            height: calc(100vh - var(--llvcTopOffset)) !important;
            overflow-y: auto !important;
            overflow-x: hidden !important;
            z-index: 9990 !important;
            background-color: #fff !important;
        }
        /* Full-screen body — white base; concerns column paints its own cream via :before */
        body.atb-page:not(.atb-page--with-chrome) {
            overflow: hidden;
            background-color: #fff !important;
            background-image: none !important;
        }
        /* Intro screen: override the cream hardcoded in alpine-tb.css */
        body.atb-page:not(.atb-page--with-chrome) .llvc__intro {
            background-color: #fff !important;
        }
        /* Kill any page-builder / theme row backgrounds */
        body.atb-page:not(.atb-page--with-chrome) .fl-row,
        body.atb-page:not(.atb-page--with-chrome) .fl-row-content,
        body.atb-page:not(.atb-page--with-chrome) .fl-col,
        body.atb-page:not(.atb-page--with-chrome) .fl-module-content,
        body.atb-page:not(.atb-page--with-chrome) [class*="ast-container"],
        body.atb-page:not(.atb-page--with-chrome) .site-content,
        body.atb-page:not(.atb-page--with-chrome) #content {
            background: transparent !important;
            background-image: none !important;
        }
        /* Hide theme header, footer, page title */
        body.atb-page:not(.atb-page--with-chrome) header:not(.llvc-navbar),
        body.atb-page:not(.atb-page--with-chrome) .site-header,
        body.atb-page:not(.atb-page--with-chrome) .navbar,
        body.atb-page:not(.atb-page--with-chrome) footer,
        body.atb-page:not(.atb-page--with-chrome) .site-footer,
        body.atb-page:not(.atb-page--with-chrome) .entry-header,
        body.atb-page:not(.atb-page--with-chrome) h1.entry-title,
        body.atb-page:not(.atb-page--with-chrome) .page-title,
        body.atb-page:not(.atb-page--with-chrome) .site-main > .page-header {
            display: none !important;
        }
        /* Remove inner padding/margin from theme content wrappers */
        body.atb-page:not(.atb-page--with-chrome) main,
        body.atb-page:not(.atb-page--with-chrome) .site-main,
        body.atb-page:not(.atb-page--with-chrome) .entry-content,
        body.atb-page:not(.atb-page--with-chrome) .content-area,
        body.atb-page:not(.atb-page--with-chrome) .wrap,
        body.atb-page:not(.atb-page--with-chrome) .container:not(.llvc__container) {
            padding: 0 !important;
            margin: 0 !important;
            max-width: 100% !important;
            width: 100% !important;
        }

        /* ── WITH-CHROME MODE (theme header/footer visible) ──────────────── */

        /* Plugin navbar: flow with the page instead of fixed on the viewport */
        body.atb-page--with-chrome .llvc-navbar {
            position: sticky !important;
            top: 0 !important;
            z-index: 100 !important;
        }
        body.atb-page--with-chrome.logged-in.admin-bar .llvc-navbar {
            top: var(--wp-admin--admin-bar--height, 32px) !important;
        }

        /* Recalculate top offset: sticky navbar height only (no viewport-fixed offset needed) */
        body.atb-page--with-chrome {
            --llvcTopOffset: 0px;
        }

        /* Intro screen: override the hardcoded position:fixed in alpine-tb.css */
        body.atb-page--with-chrome .llvc__intro {
            position: relative !important;
            top: auto !important;
            left: auto !important;
            width: 100% !important;
            height: auto !important;
            min-height: 70vh !important;
            overflow: visible !important;
            z-index: auto !important;
        }

        /* Concerns / form screens: inline, no fixed overlay */
        body.atb-page--with-chrome .llvc--concerns .llvc__screen.is-active {
            position: relative !important;
            top: auto !important;
            left: auto !important;
            width: 100% !important;
            height: auto !important;
            min-height: 70vh !important;
            overflow: visible !important;
            z-index: auto !important;
            background-color: #fff !important;
        }

        /* Plugin wrapper fills the theme content column */
        body.atb-page--with-chrome .llvc,
        body.atb-page--with-chrome .llvc--concerns {
            width: 100% !important;
            max-width: 100% !important;
            box-sizing: border-box !important;
        }

        /* Stretch theme content wrappers so the builder fills them edge-to-edge */
        body.atb-page--with-chrome .entry-content,
        body.atb-page--with-chrome .site-main,
        body.atb-page--with-chrome main,
        body.atb-page--with-chrome .content-area {
            width: 100% !important;
            max-width: 100% !important;
            padding-left: 0 !important;
            padding-right: 0 !important;
        }

        /* Hide just the post/page title — keep theme header/footer */
        body.atb-page--with-chrome .entry-header,
        body.atb-page--with-chrome h1.entry-title,
        body.atb-page--with-chrome .page-title,
        body.atb-page--with-chrome .site-main > .page-header {
            display: none !important;
        }
    ';

    wp_add_inline_style( 'atb-styles', $inline_css );

    wp_enqueue_script(
        'atb-script',
        ATB_URL . 'public/js/alpine-tb.js',
        [ 'jquery' ],
        ATB_VERSION,
        true
    );
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
 * No custom AJAX handler is needed.
 * ============================================================= */
