<?php
/**
 * Plugin Name: Alpine Treatment Builder
 * Plugin URI:  https://www.alpinewellnessnv.com/
 * Description: Interactive body-map treatment planner for Alpine Wellness.
 * Version:     1.0.12
 * Author:      Alpine Wellness
 * Text Domain: alpine-tb
 */

defined( 'ABSPATH' ) || exit;

define( 'ATB_VERSION', '1.0.12' );
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
            'btn_bg'       => [ 'label' => 'Button Background',   'default' => '#21403e', 'desc' => 'Default background color for submit / CTA buttons' ],
            'primary'      => [ 'label' => 'Primary / CTA',      'default' => '#a3663c', 'desc' => 'Hover color for buttons, selected hotspots' ],
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

/** Which form plugin is selected: 'gravity_forms' | 'wpforms'. */
function atb_form_plugin() {
    return get_option( 'atb_form_plugin', 'gravity_forms' );
}

/** Is WPForms active? */
function atb_wpf_active() {
    return defined( 'WPFORMS_VERSION' ) || class_exists( 'WPForms\WPForms' );
}

/** Gravity Form ID for the treatment builder. */
function atb_get_form_id() {
    return (int) apply_filters( 'atb_gravity_form_id', get_option( 'atb_gravity_form_id', 0 ) );
}

/** WPForms form ID for the treatment builder. */
function atb_get_wpf_form_id() {
    return (int) get_option( 'atb_wpf_form_id', 0 );
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
 * BODY AREAS DATA LAYER
 * ============================================================= */

/** Default body areas with concerns, transcribed from the original hardcoded arrays. */
function atb_body_areas_defaults() {
    return [
        // ── Female ───────────────────────────────────────────────────────────
        [
            'id' => 51, 'gender' => 'female', 'view' => 'front',
            'header' => 'General Body Concerns', 'section_label' => 'General Body',
            'concerns' => [
                [ 'id' => 'woman_general-1004', 'label' => 'Eczema' ],
                [ 'id' => 'woman_general-1012', 'label' => 'Anxiety' ],
                [ 'id' => 'woman_general-1005', 'label' => 'Dry Skin' ],
                [ 'id' => 'woman_general-1013', 'label' => 'Brain Fog' ],
                [ 'id' => 'woman_general-998',  'label' => 'Feeling Cold' ],
                [ 'id' => 'woman_general-997',  'label' => 'Fine Lines and Wrinkles' ],
                [ 'id' => 'woman_general-996',  'label' => 'Frequent Illness' ],
                [ 'id' => 'woman_general-994',  'label' => 'Hot Flashes' ],
                [ 'id' => 'woman_general-1024', 'label' => 'Irritability' ],
                [ 'id' => 'woman_general-1033', 'label' => 'Weight Gain' ],
                [ 'id' => 'woman_general-1032', 'label' => 'Struggling to Stay Asleep' ],
                [ 'id' => 'woman_general-1031', 'label' => 'Struggling to Fall Asleep' ],
                [ 'id' => 'woman_general-1030', 'label' => 'Stress' ],
                [ 'id' => 'woman_general-1029', 'label' => 'Rage' ],
                [ 'id' => 'woman_general-1028', 'label' => 'Prolonged Recovery After Exercise' ],
                [ 'id' => 'woman_general-1027', 'label' => 'Poor Sleep' ],
                [ 'id' => 'woman_general-1026', 'label' => 'Loss of Focus' ],
                [ 'id' => 'woman_general-1025', 'label' => 'Joint Pain' ],
                [ 'id' => 'woman_general-1023', 'label' => 'Fatigue' ],
                [ 'id' => 'woman_general-1022', 'label' => 'Depression' ],
                [ 'id' => 'woman_general-1020', 'label' => 'Decreased Physical Endurance' ],
                [ 'id' => 'woman_general-1019', 'label' => 'Decreased Muscle Mass' ],
                [ 'id' => 'woman_general-1018', 'label' => 'Decreased Mental Clarity' ],
                [ 'id' => 'woman_general-1016', 'label' => 'Catastrophic Thinking' ],
                [ 'id' => 'woman_general-960',  'label' => 'Tendonitis' ],
                [ 'id' => 'woman_general-969',  'label' => 'Crepey Skin' ],
                [ 'id' => 'woman_general-968',  'label' => 'Soft Tissue Injury' ],
                [ 'id' => 'woman_general-970',  'label' => 'Sagging Skin' ],
                [ 'id' => 'woman_general-951',  'label' => 'Wrinkles' ],
                [ 'id' => 'woman_general-991',  'label' => 'Infertility' ],
                [ 'id' => 'woman_general-985',  'label' => 'Impaired Memory' ],
                [ 'id' => 'woman_general-983',  'label' => 'Loose Skin' ],
                [ 'id' => 'woman_general-981',  'label' => 'Night Sweats' ],
            ],
        ],
        [
            'id' => 16, 'gender' => 'female', 'view' => 'back',
            'header' => 'Back Concerns', 'section_label' => 'Back',
            'concerns' => [
                [ 'id' => 'woman_back-1011', 'label' => 'Acne' ],
                [ 'id' => 'woman_back-1025', 'label' => 'Joint Pain' ],
            ],
        ],
        [
            'id' => 19, 'gender' => 'female', 'view' => 'front',
            'header' => 'Intimate Concerns', 'section_label' => 'Intimate',
            'concerns' => [
                [ 'id' => 'woman_intimate-1010', 'label' => 'Decreased Vaginal Sensitivity' ],
                [ 'id' => 'woman_intimate-1007', 'label' => 'Decreased Vaginal Lubrication' ],
                [ 'id' => 'woman_intimate-992',  'label' => 'Female Incontinence' ],
                [ 'id' => 'woman_intimate-1021', 'label' => 'Decreased Sexual Pleasure' ],
                [ 'id' => 'woman_intimate-1017', 'label' => 'Decreased Libido' ],
                [ 'id' => 'woman_intimate-958',  'label' => 'Vaginal Dryness' ],
                [ 'id' => 'woman_intimate-956',  'label' => 'Vaginal Laxity' ],
                [ 'id' => 'woman_intimate-979',  'label' => 'Painful Intercourse' ],
                [ 'id' => 'woman_intimate-991',  'label' => 'Infertility' ],
                [ 'id' => 'woman_intimate-950',  'label' => 'Abnormal Menstrual Cycle' ],
                [ 'id' => 'woman_intimate-973',  'label' => 'Decreased Clitoral Sensitivity' ],
                [ 'id' => 'woman_intimate-974',  'label' => 'Pregnancy Loss' ],
            ],
        ],
        [
            'id' => 11, 'gender' => 'female', 'view' => 'front',
            'header' => 'Abdomen Concerns', 'section_label' => 'Abdomen',
            'concerns' => [
                [ 'id' => 'woman_abdomen-1009', 'label' => 'Diarrhea' ],
                [ 'id' => 'woman_abdomen-1033', 'label' => 'Weight Gain' ],
                [ 'id' => 'woman_abdomen-967',  'label' => 'Constipated' ],
                [ 'id' => 'woman_abdomen-972',  'label' => 'Reflux' ],
            ],
        ],
        [
            'id' => 4, 'gender' => 'female', 'view' => 'back',
            'header' => 'Scalp Concerns', 'section_label' => 'Scalp',
            'concerns' => [
                [ 'id' => 'woman_scalp-1006', 'label' => 'Brittle Hair' ],
                [ 'id' => 'woman_scalp-995',  'label' => 'Hair Loss' ],
            ],
        ],
        [
            'id' => 5, 'gender' => 'female', 'view' => 'back',
            'header' => 'Upper Face Concerns', 'section_label' => 'Upper Face',
            'concerns' => [
                [ 'id' => 'woman_upper_face-1015', 'label' => 'Dry Eyes' ],
            ],
        ],
        [
            'id' => 10, 'gender' => 'female', 'view' => 'front',
            'header' => 'Arms Concerns', 'section_label' => 'Arms',
            'concerns' => [
                [ 'id' => 'woman_arms-1025', 'label' => 'Joint Pain' ],
            ],
        ],
        [
            'id' => 13, 'gender' => 'female', 'view' => 'front',
            'header' => 'Lower Legs Concerns', 'section_label' => 'Lower Legs',
            'concerns' => [
                [ 'id' => 'woman_lower_legs-1025', 'label' => 'Joint Pain' ],
            ],
        ],
        [
            'id' => 14, 'gender' => 'female', 'view' => 'front',
            'header' => 'Hands Concerns', 'section_label' => 'Hands',
            'concerns' => [
                [ 'id' => 'woman_hands-965', 'label' => 'Brittle Nails' ],
            ],
        ],

        // ── Male ─────────────────────────────────────────────────────────────
        [
            'id' => 50, 'gender' => 'male', 'view' => 'front',
            'header' => 'General Body Concerns', 'section_label' => 'General Body',
            'concerns' => [
                [ 'id' => 'man_general-1004', 'label' => 'Eczema' ],
                [ 'id' => 'man_general-1003', 'label' => 'Prolonged Recovery After Exercise' ],
                [ 'id' => 'man_general-1005', 'label' => 'Dry Skin' ],
                [ 'id' => 'man_general-999',  'label' => 'Fatigue' ],
                [ 'id' => 'man_general-997',  'label' => 'Fine Lines and Wrinkles' ],
                [ 'id' => 'man_general-996',  'label' => 'Frequent Illness' ],
                [ 'id' => 'man_general-960',  'label' => 'Tendonitis' ],
                [ 'id' => 'man_general-969',  'label' => 'Crepey Skin' ],
                [ 'id' => 'man_general-968',  'label' => 'Soft Tissue Injury' ],
                [ 'id' => 'man_general-966',  'label' => 'Stress' ],
                [ 'id' => 'man_general-964',  'label' => 'Struggling to Fall Asleep' ],
                [ 'id' => 'man_general-963',  'label' => 'Brain Fog' ],
                [ 'id' => 'man_general-962',  'label' => 'Struggling to Stay Asleep' ],
                [ 'id' => 'man_general-970',  'label' => 'Sagging Skin' ],
                [ 'id' => 'man_general-959',  'label' => 'Acne' ],
                [ 'id' => 'man_general-957',  'label' => 'Catastrophic Thinking' ],
                [ 'id' => 'man_general-955',  'label' => 'Rage' ],
                [ 'id' => 'man_general-953',  'label' => 'Weight Gain' ],
                [ 'id' => 'man_general-954',  'label' => 'Depression' ],
                [ 'id' => 'man_general-952',  'label' => 'Anxiety' ],
                [ 'id' => 'man_general-951',  'label' => 'Wrinkles' ],
                [ 'id' => 'man_general-987',  'label' => 'Irritability' ],
                [ 'id' => 'man_general-986',  'label' => 'Decreased Muscle Mass' ],
                [ 'id' => 'man_general-985',  'label' => 'Impaired Memory' ],
                [ 'id' => 'man_general-984',  'label' => 'Joint Pain' ],
                [ 'id' => 'man_general-983',  'label' => 'Loose Skin' ],
                [ 'id' => 'man_general-978',  'label' => 'Decreased Physical Endurance' ],
                [ 'id' => 'man_general-977',  'label' => 'Loss of Focus' ],
                [ 'id' => 'man_general-975',  'label' => 'Poor Sleep' ],
                [ 'id' => 'man_general-971',  'label' => 'Decreased Mental Clarity' ],
            ],
        ],
        [
            'id' => 29, 'gender' => 'male', 'view' => 'front',
            'header' => 'Abdomen Concerns', 'section_label' => 'Abdomen',
            'concerns' => [
                [ 'id' => 'man_abdomen-1009', 'label' => 'Diarrhea' ],
                [ 'id' => 'man_abdomen-967',  'label' => 'Constipated' ],
                [ 'id' => 'man_abdomen-953',  'label' => 'Weight Gain' ],
                [ 'id' => 'man_abdomen-972',  'label' => 'Reflux' ],
            ],
        ],
        [
            'id' => 23, 'gender' => 'male', 'view' => 'back',
            'header' => 'Upper Face Concerns', 'section_label' => 'Upper Face',
            'concerns' => [
                [ 'id' => 'man_upper_face-1008', 'label' => 'Dry Eyes' ],
            ],
        ],
        [
            'id' => 22, 'gender' => 'male', 'view' => 'back',
            'header' => 'Scalp Concerns', 'section_label' => 'Scalp',
            'concerns' => [
                [ 'id' => 'man_scalp-1006', 'label' => 'Brittle Hair' ],
                [ 'id' => 'man_scalp-995',  'label' => 'Hair Loss' ],
            ],
        ],
        [
            'id' => 37, 'gender' => 'male', 'view' => 'front',
            'header' => 'Intimate Concerns', 'section_label' => 'Intimate',
            'concerns' => [
                [ 'id' => 'man_intimate-1002', 'label' => 'Erectile Dysfunction' ],
                [ 'id' => 'man_intimate-993',  'label' => 'Decreased Sexual Pleasure' ],
                [ 'id' => 'man_intimate-990',  'label' => 'Decreased Penile Sensation' ],
                [ 'id' => 'man_intimate-982',  'label' => 'Decreased Libido' ],
                [ 'id' => 'man_intimate-976',  'label' => "Peyronie's Disease" ],
            ],
        ],
        [
            'id' => 28, 'gender' => 'male', 'view' => 'front',
            'header' => 'Arms Concerns', 'section_label' => 'Arms',
            'concerns' => [
                [ 'id' => 'man_arms-959', 'label' => 'Acne' ],
                [ 'id' => 'man_arms-984', 'label' => 'Joint Pain' ],
            ],
        ],
        [
            'id' => 34, 'gender' => 'male', 'view' => 'back',
            'header' => 'Back Concerns', 'section_label' => 'Back',
            'concerns' => [
                [ 'id' => 'man_back-959', 'label' => 'Acne' ],
                [ 'id' => 'man_back-984', 'label' => 'Joint Pain' ],
            ],
        ],
        [
            'id' => 36, 'gender' => 'male', 'view' => 'back',
            'header' => 'Buttocks Concerns', 'section_label' => 'Buttocks',
            'concerns' => [
                [ 'id' => 'man_buttocks-959', 'label' => 'Acne' ],
            ],
        ],
        [
            'id' => 33, 'gender' => 'male', 'view' => 'front',
            'header' => 'Chest Concerns', 'section_label' => 'Chest',
            'concerns' => [
                [ 'id' => 'man_chest-959', 'label' => 'Acne' ],
            ],
        ],
        [
            'id' => 32, 'gender' => 'male', 'view' => 'front',
            'header' => 'Hands Concerns', 'section_label' => 'Hands',
            'concerns' => [
                [ 'id' => 'man_hands-965', 'label' => 'Brittle Nails' ],
            ],
        ],
        [
            'id' => 31, 'gender' => 'male', 'view' => 'front',
            'header' => 'Lower Legs Concerns', 'section_label' => 'Lower Legs',
            'concerns' => [
                [ 'id' => 'man_lower_legs-984', 'label' => 'Joint Pain' ],
            ],
        ],
    ];
}

/**
 * Get body areas from DB, seeding defaults on first run.
 *
 * @return array
 */
function atb_get_body_areas() {
    $areas = get_option( 'atb_body_areas', null );
    if ( null === $areas ) {
        $areas = atb_body_areas_defaults();
        update_option( 'atb_body_areas', $areas );
    }
    return (array) $areas;
}

/**
 * Convert body areas to the format expected by templates/main.php:
 *   [ term_id => [ 'header'=>..., 'section_label'=>..., 'concerns'=>[ id => label, ... ] ] ]
 *
 * @return array
 */
function atb_concerns_map() {
    $map = [];
    foreach ( atb_get_body_areas() as $area ) {
        $concerns = [];
        foreach ( (array) $area['concerns'] as $c ) {
            $concerns[ $c['id'] ] = $c['label'];
        }
        $map[ (int) $area['id'] ] = [
            'header'        => $area['header'],
            'section_label' => $area['section_label'],
            'concerns'      => $concerns,
        ];
    }
    return $map;
}

/**
 * Hardcoded hotspot positions (moved from templates/main.php).
 *
 * @return array
 */
function atb_get_hotspots() {
    return [
        'female-front' => [
            [ 'id' => 51, 'label' => 'General Body', 'style' => 'top:8.62%;left:5.67%',   'class' => 'is-female' ],
            [ 'id' => 11, 'label' => 'Abdomen',       'style' => 'top:35.19%;left:59.57%', 'class' => 'is-female' ],
            [ 'id' => 10, 'label' => 'Arms',           'style' => 'top:23.26%;left:89.82%', 'class' => 'is-female' ],
            [ 'id' => 14, 'label' => 'Hands',          'style' => 'top:49.19%;left:90.78%', 'class' => 'is-female' ],
            [ 'id' => 19, 'label' => 'Intimate',       'style' => 'top:42.91%;left:34.04%', 'class' => 'is-female' ],
            [ 'id' => 13, 'label' => 'Lower Legs',     'style' => 'top:79.17%;left:61.70%', 'class' => 'is-female' ],
        ],
        'female-back' => [
            [ 'id' => 16, 'label' => 'Back',       'style' => 'top:32.80%;left:62.07%' ],
            [ 'id' =>  4, 'label' => 'Scalp',      'style' => 'top:5.68%;left:34.90%' ],
            [ 'id' =>  5, 'label' => 'Upper Face', 'style' => 'top:21.05%;left:65.77%' ],
        ],
        'male-front' => [
            [ 'id' => 50, 'label' => 'General Body', 'style' => 'top:8.06%;left:6.90%',   'class' => 'is-male' ],
            [ 'id' => 29, 'label' => 'Abdomen',       'style' => 'top:35.19%;left:59.57%', 'class' => 'is-male' ],
            [ 'id' => 28, 'label' => 'Arms',           'style' => 'top:23.26%;left:89.82%', 'class' => 'is-male' ],
            [ 'id' => 33, 'label' => 'Chest',          'style' => 'top:22.44%;left:25.53%', 'class' => 'is-male' ],
            [ 'id' => 32, 'label' => 'Hands',          'style' => 'top:49.19%;left:90.78%', 'class' => 'is-male' ],
            [ 'id' => 37, 'label' => 'Intimate',       'style' => 'top:44.91%;left:37.04%', 'class' => 'is-male' ],
            [ 'id' => 31, 'label' => 'Lower Legs',     'style' => 'top:79.17%;left:61.70%', 'class' => 'is-male' ],
        ],
        'male-back' => [
            [ 'id' => 34, 'label' => 'Back',       'style' => 'top:32.80%;left:62.07%' ],
            [ 'id' => 36, 'label' => 'Buttocks',   'style' => 'top:45.73%;left:30.21%' ],
            [ 'id' => 22, 'label' => 'Scalp',      'style' => 'top:5.68%;left:34.90%' ],
            [ 'id' => 23, 'label' => 'Upper Face', 'style' => 'top:21.05%;left:65.77%' ],
        ],
    ];
}

/* ===============================================================
 * GRAVITY FORMS DEPENDENCY CHECK
 * ============================================================= */

add_action( 'admin_notices', function () {
    $plugin = atb_form_plugin();
    if ( 'gravity_forms' === $plugin && ! atb_gf_active() ) {
        echo '<div class="notice notice-error"><p>'
            . '<strong>Alpine Treatment Builder</strong> is set to use Gravity Forms, but it is not active. '
            . '<a href="' . esc_url( admin_url( 'options-general.php?page=alpine-treatment-builder' ) ) . '">Switch to WPForms</a> or install Gravity Forms.</p></div>';
    } elseif ( 'wpforms' === $plugin && ! atb_wpf_active() ) {
        echo '<div class="notice notice-error"><p>'
            . '<strong>Alpine Treatment Builder</strong> is set to use WPForms, but it is not active. '
            . '<a href="' . esc_url( admin_url( 'options-general.php?page=alpine-treatment-builder' ) ) . '">Switch to Gravity Forms</a> or install WPForms.</p></div>';
    }
} );

/* ===============================================================
 * PLUGIN SETTINGS PAGE
 * ============================================================= */

add_action( 'admin_menu', function () {
    // Top-level Treatment Builder menu
    add_menu_page(
        __( 'Treatment Builder', 'alpine-tb' ),
        __( 'Treatment Builder', 'alpine-tb' ),
        'manage_options',
        'alpine-treatment-builder',
        'atb_render_settings_page',
        'dashicons-clipboard',
        25
    );

    // Rename the auto-generated first submenu from "Treatment Builder" to "Settings"
    add_submenu_page(
        'alpine-treatment-builder',
        __( 'Treatment Builder Settings', 'alpine-tb' ),
        __( 'Settings', 'alpine-tb' ),
        'manage_options',
        'alpine-treatment-builder',
        'atb_render_settings_page'
    );

    // Body Area Concerns submenu
    add_submenu_page(
        'alpine-treatment-builder',
        __( 'Body Area Concerns', 'alpine-tb' ),
        __( 'Body Area Concerns', 'alpine-tb' ),
        'manage_options',
        'atb-body-areas',
        'atb_render_body_areas_page'
    );
}, 10 );

// Reorder submenus: Treatments → Body Area Concerns → Settings
// Runs late (priority 999) so all items are already registered.
add_action( 'admin_menu', function () {
    global $submenu;
    $parent = 'alpine-treatment-builder';
    if ( empty( $submenu[ $parent ] ) ) return;

    $settings   = [];
    $body_areas = [];
    $rest       = []; // Treatments, Add New, Treatment Categories, etc.

    foreach ( $submenu[ $parent ] as $item ) {
        if ( $item[2] === 'alpine-treatment-builder' ) {
            $settings[] = $item;
        } elseif ( $item[2] === 'atb-body-areas' ) {
            $body_areas[] = $item;
        } else {
            $rest[] = $item;
        }
    }

    $submenu[ $parent ] = array_values( array_merge( $rest, $body_areas, $settings ) );
}, 999 );

add_action( 'admin_init', function () {
    $d = atb_defaults();

    // ── General ─────────────────────────────────────────────────────────────
    register_setting( 'atb_settings_general', 'atb_form_plugin',      [ 'sanitize_callback' => 'sanitize_text_field', 'default' => 'gravity_forms' ] );
    register_setting( 'atb_settings_general', 'atb_gravity_form_id', [ 'sanitize_callback' => 'absint',           'default' => 0 ] );
    register_setting( 'atb_settings_general', 'atb_wpf_form_id',     [ 'sanitize_callback' => 'absint',           'default' => 0 ] );
    register_setting( 'atb_settings_general', 'atb_logo_url',        [ 'sanitize_callback' => 'esc_url_raw',      'default' => '' ] );
    register_setting( 'atb_settings_general', 'atb_use_theme_chrome',[ 'sanitize_callback' => fn($v) => $v ? '1' : '0', 'default' => '0' ] );
    register_setting( 'atb_settings_general', 'atb_results_page_id', [ 'sanitize_callback' => 'absint',           'default' => 0 ] );

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
    // Matches both toplevel_page_* (add_menu_page) and settings_page_* (add_options_page) slugs.
    if ( false === strpos( $hook, 'alpine-treatment-builder' ) && false === strpos( $hook, 'atb-body-areas' ) ) return;
    wp_enqueue_media();
    wp_enqueue_style( 'wp-color-picker' );
    wp_enqueue_script( 'wp-color-picker' );
} );

/** Render the tabbed settings page. */
function atb_render_settings_page() {
    if ( ! current_user_can( 'manage_options' ) ) return;

    $tab  = isset( $_GET['tab'] ) ? sanitize_key( $_GET['tab'] ) : 'general';
    $tabs = [ 'general' => 'General', 'branding' => 'Branding', 'text' => 'Text' ];
    $base = admin_url( 'admin.php?page=alpine-treatment-builder' );

    $d              = atb_defaults();
    $current_plugin = atb_form_plugin();
    $form_id        = atb_get_form_id();
    $wpf_form_id    = atb_get_wpf_form_id();
    $logo_url       = get_option( 'atb_logo_url', '' );
    $use_chrome     = get_option( 'atb_use_theme_chrome', '0' );
    $current_font   = atb_font();
    $gf_forms       = atb_gf_active() ? GFAPI::get_forms() : [];
    $wpf_forms      = atb_wpf_active() ? get_posts( [ 'post_type' => 'wpforms', 'post_status' => 'publish', 'numberposts' => -1, 'orderby' => 'title', 'order' => 'ASC' ] ) : [];
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

        <h2 class="title" style="margin-top:24px;"><?php esc_html_e( 'Contact Form', 'alpine-tb' ); ?></h2>
        <p class="atb-section-intro"><?php esc_html_e( 'Choose your form plugin, then select the form that collects patient contact info. Add a Hidden field to the form with CSS Class "atb-concerns" — the plugin populates it automatically with the body-map selections.', 'alpine-tb' ); ?></p>
        <table class="form-table" role="presentation">
            <tr>
                <th><?php esc_html_e( 'Form Plugin', 'alpine-tb' ); ?></th>
                <td>
                    <label style="margin-right:20px;">
                        <input type="radio" name="atb_form_plugin" value="gravity_forms" <?php checked( $current_plugin, 'gravity_forms' ); ?>>
                        <?php esc_html_e( 'Gravity Forms', 'alpine-tb' ); ?>
                        <?php if ( ! atb_gf_active() ) : ?><span style="color:#d63638;font-size:12px;"> (not active)</span><?php endif; ?>
                    </label>
                    <label>
                        <input type="radio" name="atb_form_plugin" value="wpforms" <?php checked( $current_plugin, 'wpforms' ); ?>>
                        <?php esc_html_e( 'WPForms', 'alpine-tb' ); ?>
                        <?php if ( ! atb_wpf_active() ) : ?><span style="color:#d63638;font-size:12px;"> (not active)</span><?php endif; ?>
                    </label>
                </td>
            </tr>
            <tr id="atb-gf-row" <?php echo 'gravity_forms' !== $current_plugin ? 'style="display:none"' : ''; ?>>
                <th><label for="atb_gravity_form_id"><?php esc_html_e( 'Gravity Form', 'alpine-tb' ); ?></label></th>
                <td>
                    <?php if ( ! atb_gf_active() ) : ?>
                        <p class="description" style="color:#d63638;"><?php esc_html_e( 'Gravity Forms is not active.', 'alpine-tb' ); ?></p>
                        <input type="hidden" name="atb_gravity_form_id" value="<?php echo absint( $form_id ); ?>">
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
            <tr id="atb-wpf-row" <?php echo 'wpforms' !== $current_plugin ? 'style="display:none"' : ''; ?>>
                <th><label for="atb_wpf_form_id"><?php esc_html_e( 'WPForms Form', 'alpine-tb' ); ?></label></th>
                <td>
                    <?php if ( ! atb_wpf_active() ) : ?>
                        <p class="description" style="color:#d63638;"><?php esc_html_e( 'WPForms is not active.', 'alpine-tb' ); ?></p>
                        <input type="hidden" name="atb_wpf_form_id" value="<?php echo absint( $wpf_form_id ); ?>">
                    <?php elseif ( empty( $wpf_forms ) ) : ?>
                        <p class="description" style="color:#d63638;"><?php esc_html_e( 'No WPForms forms found. Create a form in WPForms first.', 'alpine-tb' ); ?></p>
                        <input type="hidden" name="atb_wpf_form_id" value="0">
                    <?php else : ?>
                        <select name="atb_wpf_form_id" id="atb_wpf_form_id">
                            <option value="0"><?php esc_html_e( '— Select a form —', 'alpine-tb' ); ?></option>
                            <?php foreach ( $wpf_forms as $wpf ) : ?>
                                <option value="<?php echo absint( $wpf->ID ); ?>" <?php selected( $wpf_form_id, (int) $wpf->ID ); ?>>
                                    <?php echo esc_html( $wpf->post_title ); ?> (ID: <?php echo absint( $wpf->ID ); ?>)
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <?php if ( $wpf_form_id > 0 ) : ?>
                            <p class="description"><a href="<?php echo esc_url( admin_url( 'admin.php?page=wpforms-builder&view=fields&form_id=' . $wpf_form_id ) ); ?>" target="_blank"><?php esc_html_e( 'Edit this form in WPForms →', 'alpine-tb' ); ?></a></p>
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

        <h2 class="title"><?php esc_html_e( 'Results Page', 'alpine-tb' ); ?></h2>
        <p class="atb-section-intro"><?php esc_html_e( 'Users will be redirected here after form submission.', 'alpine-tb' ); ?></p>
        <table class="form-table" role="presentation">
            <tr>
                <th><label for="atb_results_page_id"><?php esc_html_e( 'Results Page', 'alpine-tb' ); ?></label></th>
                <td>
                    <?php
                    $results_page_id = (int) get_option( 'atb_results_page_id', 0 );
                    $all_pages       = get_pages( [ 'post_status' => 'publish' ] );
                    ?>
                    <select name="atb_results_page_id" id="atb_results_page_id">
                        <option value="0"><?php esc_html_e( '— Select a page —', 'alpine-tb' ); ?></option>
                        <?php foreach ( $all_pages as $p ) : ?>
                            <option value="<?php echo absint( $p->ID ); ?>" <?php selected( $results_page_id, $p->ID ); ?>>
                                <?php echo esc_html( $p->post_title ); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <p class="description"><?php esc_html_e( 'Add the [atb_results] shortcode to this page.', 'alpine-tb' ); ?></p>
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

    <?php endif; /* end tab conditionals */ ?>

    </div><!-- .wrap -->

    <script>
    jQuery(function($){
        /* ── Form plugin toggle ── */
        $('input[name="atb_form_plugin"]').on('change', function(){
            var val = $(this).val();
            $('#atb-gf-row').toggle( val === 'gravity_forms' );
            $('#atb-wpf-row').toggle( val === 'wpforms' );
        });

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

    });
    </script>
    <?php
}

/* ===============================================================
 * BODY AREA CONCERNS — ADMIN PAGE
 * ============================================================= */

function atb_render_body_areas_page() {
    if ( ! current_user_can( 'manage_options' ) ) return;
    $areas = atb_get_body_areas();
    ?>
    <div class="wrap">
    <h1><?php esc_html_e( 'Body Area Concerns', 'alpine-tb' ); ?></h1>
    <style>
        .atb-section-intro { color: #555; margin-bottom: 20px; max-width: 680px; }
        .atb-gender-tabs { display:flex; gap:0; margin-bottom:16px; border-bottom:2px solid #ddd; }
        .atb-gender-tab { background:none; border:none; padding:8px 20px; cursor:pointer; font-size:14px; font-weight:600; color:#666; border-bottom:3px solid transparent; margin-bottom:-2px; }
        .atb-gender-tab.atb-active { color:#2271b1; border-bottom-color:#2271b1; }
        .atb-area-row { border:1px solid #e0e0e0; border-radius:6px; margin-bottom:8px; overflow:hidden; background:#fff; }
        .atb-area-header { display:flex; align-items:center; gap:12px; padding:12px 16px; cursor:pointer; user-select:none; }
        .atb-area-header:hover { background:#f6f7f7; }
        .atb-area-chevron { font-size:10px; color:#999; transition:transform .2s; display:inline-block; }
        .atb-area-row.atb-open .atb-area-chevron { transform:rotate(90deg); }
        .atb-view-badge { background:#e8f0fe; color:#1a56db; font-size:11px; font-weight:600; padding:2px 8px; border-radius:10px; text-transform:uppercase; }
        .atb-concern-count { color:#999; font-size:12px; margin-left:auto; }
        .atb-area-body { padding:12px 16px; border-top:1px solid #f0f0f0; background:#fafafa; }
        .atb-concerns-list { list-style:none; margin:0 0 12px; padding:0; }
        .atb-concerns-list li { display:flex; align-items:center; padding:6px 0; border-bottom:1px solid #eee; }
        .atb-concerns-list li:last-child { border-bottom:none; }
        .atb-concern-label { flex:1; font-size:13px; }
        .atb-remove-concern { background:none; border:none; color:#c00; cursor:pointer; font-size:18px; padding:0 4px; line-height:1; }
        .atb-remove-concern:hover { color:#900; }
        .atb-add-concern { display:flex; gap:8px; margin-top:8px; }
        .atb-new-concern-label { flex:1; }
        .atb-areas-footer { margin-top:20px; padding-top:16px; border-top:1px solid #ddd; }
    </style>

    <div class="atb-areas-wrap" style="margin-top:24px;">
    <p class="atb-section-intro"><?php esc_html_e( 'Add or remove concerns for each body area. Hotspot positions on the body image are fixed and cannot be changed here.', 'alpine-tb' ); ?></p>
    <div class="atb-gender-tabs">
        <button class="atb-gender-tab atb-active" data-gender="female"><?php esc_html_e( 'Female', 'alpine-tb' ); ?></button>
        <button class="atb-gender-tab" data-gender="male"><?php esc_html_e( 'Male', 'alpine-tb' ); ?></button>
    </div>
    <div id="atb-areas-list">
    <?php foreach ( [ 'female', 'male' ] as $gender ) : ?>
        <div class="atb-gender-section" data-gender="<?php echo esc_attr( $gender ); ?>"<?php echo 'female' !== $gender ? ' style="display:none"' : ''; ?>>
        <?php foreach ( $areas as $area ) :
            if ( $area['gender'] !== $gender ) continue;
        ?>
            <div class="atb-area-row"
                 data-area-id="<?php echo (int) $area['id']; ?>"
                 data-gender="<?php echo esc_attr( $area['gender'] ); ?>"
                 data-view="<?php echo esc_attr( $area['view'] ); ?>"
                 data-header="<?php echo esc_attr( $area['header'] ); ?>"
                 data-section-label="<?php echo esc_attr( $area['section_label'] ); ?>">
                <div class="atb-area-header">
                    <span class="atb-area-chevron">&#9658;</span>
                    <strong><?php echo esc_html( $area['section_label'] ); ?></strong>
                    <span class="atb-view-badge"><?php echo esc_html( ucfirst( $area['view'] ) ); ?></span>
                    <span class="atb-concern-count"><?php echo count( $area['concerns'] ); ?> <?php esc_html_e( 'concerns', 'alpine-tb' ); ?></span>
                </div>
                <div class="atb-area-body" style="display:none;">
                    <ul class="atb-concerns-list">
                    <?php foreach ( $area['concerns'] as $c ) : ?>
                        <li data-id="<?php echo esc_attr( $c['id'] ); ?>">
                            <span class="atb-concern-label"><?php echo esc_html( $c['label'] ); ?></span>
                            <button type="button" class="atb-remove-concern" title="<?php esc_attr_e( 'Remove', 'alpine-tb' ); ?>">&times;</button>
                        </li>
                    <?php endforeach; ?>
                    </ul>
                    <div class="atb-add-concern">
                        <input type="text" class="atb-new-concern-label" placeholder="<?php esc_attr_e( 'Concern name...', 'alpine-tb' ); ?>">
                        <button type="button" class="button atb-add-concern-btn"><?php esc_html_e( '+ Add', 'alpine-tb' ); ?></button>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
        </div>
    <?php endforeach; ?>
    </div><!-- #atb-areas-list -->
    <div class="atb-areas-footer">
        <?php wp_nonce_field( 'atb_body_areas_nonce', 'atb_areas_nonce' ); ?>
        <button type="button" id="atb-areas-save" class="button button-primary"><?php esc_html_e( 'Save All Changes', 'alpine-tb' ); ?></button>
        <span id="atb-areas-status" style="margin-left:12px;"></span>
    </div>
    </div><!-- .atb-areas-wrap -->
    </div><!-- .wrap -->

    <script>
    jQuery(function($){
        // Gender tab switching
        $('.atb-gender-tab').on('click', function(){
            $('.atb-gender-tab').removeClass('atb-active');
            $(this).addClass('atb-active');
            var g = $(this).data('gender');
            $('.atb-gender-section').hide();
            $('.atb-gender-section[data-gender="' + g + '"]').show();
        });

        // Area accordion
        $(document).on('click', '.atb-area-header', function(){
            var $row  = $(this).closest('.atb-area-row');
            var $body = $row.find('.atb-area-body');
            $row.toggleClass('atb-open');
            $body.slideToggle(200);
            $row.find('.atb-concern-count').text($row.find('.atb-concerns-list li').length + ' concerns');
        });

        // Add concern
        $(document).on('click', '.atb-add-concern-btn', function(){
            var $wrap  = $(this).closest('.atb-area-body');
            var $input = $wrap.find('.atb-new-concern-label');
            var label  = $.trim($input.val());
            if (!label) return;
            var areaId = $(this).closest('.atb-area-row').data('area-id');
            var newId  = 'area' + areaId + '-' + Date.now();
            var $li    = $('<li>').attr('data-id', newId)
                .append($('<span class="atb-concern-label">').text(label))
                .append($('<button type="button" class="atb-remove-concern" title="Remove">').text('×'));
            $wrap.find('.atb-concerns-list').append($li);
            $input.val('').focus();
            $(this).closest('.atb-area-row').find('.atb-concern-count').text($wrap.find('.atb-concerns-list li').length + ' concerns');
        });

        // Remove concern
        $(document).on('click', '.atb-remove-concern', function(){
            var $row = $(this).closest('.atb-area-row');
            $(this).closest('li').remove();
            $row.find('.atb-concern-count').text($row.find('.atb-concerns-list li').length + ' concerns');
        });

        // Save body areas via AJAX
        $('#atb-areas-save').on('click', function(){
            var $btn    = $(this);
            var $status = $('#atb-areas-status');
            var areas   = [];
            $('.atb-area-row').each(function(){
                var $row     = $(this);
                var concerns = [];
                $row.find('.atb-concerns-list li').each(function(){
                    concerns.push({ id: $(this).data('id'), label: $(this).find('.atb-concern-label').text() });
                });
                areas.push({
                    id:            $row.data('area-id'),
                    gender:        $row.data('gender'),
                    view:          $row.data('view'),
                    header:        $row.data('header'),
                    section_label: $row.data('section-label'),
                    concerns:      concerns
                });
            });
            $btn.prop('disabled', true).text('Saving…');
            $status.text('');
            $.post(ajaxurl, {
                action: 'atb_save_body_areas',
                nonce:  $('#atb_areas_nonce').val(),
                areas:  JSON.stringify(areas)
            }).done(function(r){
                if (r.success) {
                    $status.css('color','green').text('✓ Saved successfully.');
                } else {
                    $status.css('color','red').text('Error: ' + (r.data || 'Unknown error'));
                }
            }).fail(function(){
                $status.css('color','red').text('Save failed. Please try again.');
            }).always(function(){
                $btn.prop('disabled', false).text('Save All Changes');
            });
        });
    });
    </script>
    <?php
}

/* ===============================================================
 * BODY AREAS — AJAX SAVE HANDLER
 * ============================================================= */

add_action( 'wp_ajax_atb_save_body_areas', function () {
    check_ajax_referer( 'atb_body_areas_nonce', 'nonce' );
    if ( ! current_user_can( 'manage_options' ) ) wp_die( 'Forbidden' );

    $areas = json_decode( stripslashes( $_POST['areas'] ?? '' ), true );
    if ( ! is_array( $areas ) ) wp_send_json_error( 'Invalid data' );

    $clean = [];
    foreach ( $areas as $area ) {
        $concerns = [];
        foreach ( (array) ( $area['concerns'] ?? [] ) as $c ) {
            $concerns[] = [
                'id'    => sanitize_text_field( $c['id'] ?? '' ),
                'label' => sanitize_text_field( $c['label'] ?? '' ),
            ];
        }
        $clean[] = [
            'id'            => (int) ( $area['id'] ?? 0 ),
            'gender'        => sanitize_text_field( $area['gender'] ?? 'female' ),
            'view'          => sanitize_text_field( $area['view'] ?? 'front' ),
            'header'        => sanitize_text_field( $area['header'] ?? '' ),
            'section_label' => sanitize_text_field( $area['section_label'] ?? '' ),
            'concerns'      => $concerns,
        ];
    }

    update_option( 'atb_body_areas', $clean );
    wp_send_json_success( 'Saved' );
} );

/* ===============================================================
 * TREATMENTS — CUSTOM POST TYPE
 * ============================================================= */

add_action( 'init', function () {
    register_post_type( 'atb_treatment', [
        'label'       => 'Treatments',
        'labels'      => [
            'name'          => 'Treatments',
            'singular_name' => 'Treatment',
            'add_new_item'  => 'Add New Treatment',
            'edit_item'     => 'Edit Treatment',
        ],
        'public'       => false,
        'show_ui'      => true,
        'show_in_menu' => 'alpine-treatment-builder',
        'supports'     => [ 'title', 'editor' ],
        'menu_icon'    => 'dashicons-heart',
        'has_archive'  => false,
        'rewrite'      => false,
    ] );

    register_taxonomy( 'atb_treatment_cat', 'atb_treatment', [
        'label'              => 'Treatment Category',
        'labels'             => [
            'name'          => 'Treatment Categories',
            'singular_name' => 'Treatment Category',
            'add_new_item'  => 'Add New Category',
            'new_item_name' => 'New Category Name',
        ],
        'hierarchical'       => false,
        'show_ui'            => true,
        'show_admin_column'  => true,  /* show category column in treatments list */
        'rewrite'            => false,
        'show_in_menu'       => true,
        'show_in_rest'       => true,  /* block editor support */
    ] );
} );

// Meta boxes
add_action( 'add_meta_boxes', function () {
    add_meta_box( 'atb_treatment_details',  'Treatment Details',    'atb_render_treatment_details_meta',  'atb_treatment', 'normal', 'high' );
    add_meta_box( 'atb_treatment_concerns', 'Applies to Concerns',  'atb_render_treatment_concerns_meta', 'atb_treatment', 'side',   'default' );
} );

function atb_render_treatment_details_meta( $post ) {
    wp_nonce_field( 'atb_treatment_meta', 'atb_treatment_meta_nonce' );
    $teaser = get_post_meta( $post->ID, '_atb_teaser', true );
    $url    = get_post_meta( $post->ID, '_atb_url',    true );
    echo '<p><label><strong>Short Teaser Text</strong><br>';
    echo '<textarea name="atb_teaser" rows="3" style="width:100%;">' . esc_textarea( $teaser ) . '</textarea></label></p>';
    echo '<p><label><strong>Learn More URL</strong><br>';
    echo '<input type="url" name="atb_url" value="' . esc_attr( $url ) . '" style="width:100%;" placeholder="https://"></label></p>';
}

function atb_render_treatment_concerns_meta( $post ) {
    $saved  = get_post_meta( $post->ID, '_atb_concern' ); // returns array of all values
    $areas  = atb_get_body_areas();
    $output = '<div style="max-height:400px;overflow-y:auto;">';
    foreach ( [ 'female', 'male' ] as $gender ) {
        $output .= '<p style="font-weight:600;margin:8px 0 4px;text-transform:capitalize;">' . esc_html( $gender ) . '</p>';
        foreach ( $areas as $area ) {
            if ( $area['gender'] !== $gender ) continue;
            $output .= '<p style="margin:6px 0 2px;font-weight:500;font-size:11px;color:#666;text-transform:uppercase;">' . esc_html( $area['section_label'] ) . '</p>';
            foreach ( $area['concerns'] as $c ) {
                $checked  = in_array( $c['id'], (array) $saved, true ) ? ' checked' : '';
                $output  .= '<label style="display:block;margin:2px 0;font-size:12px;"><input type="checkbox" name="atb_concerns[]" value="' . esc_attr( $c['id'] ) . '"' . $checked . '> ' . esc_html( $c['label'] ) . '</label>';
            }
        }
    }
    $output .= '</div>';
    echo $output; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
}

add_action( 'save_post_atb_treatment', function ( $post_id ) {
    if ( ! isset( $_POST['atb_treatment_meta_nonce'] ) ) return;
    if ( ! wp_verify_nonce( $_POST['atb_treatment_meta_nonce'], 'atb_treatment_meta' ) ) return;
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
    if ( ! current_user_can( 'edit_post', $post_id ) ) return;

    update_post_meta( $post_id, '_atb_teaser', sanitize_textarea_field( $_POST['atb_teaser'] ?? '' ) );
    update_post_meta( $post_id, '_atb_url',    esc_url_raw( $_POST['atb_url'] ?? '' ) );

    // Delete all existing concerns then re-add selected ones
    delete_post_meta( $post_id, '_atb_concern' );
    foreach ( (array) ( $_POST['atb_concerns'] ?? [] ) as $concern_id ) {
        add_post_meta( $post_id, '_atb_concern', sanitize_text_field( $concern_id ), false );
    }
} );

/* ===============================================================
 * GRAVITY FORMS: append concerns list to admin notification
 * ============================================================= */

add_filter( 'gform_notification', function ( $notification, $form, $entry ) {
    if ( 'gravity_forms' !== atb_form_plugin() ) return $notification;
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

add_filter( 'gform_confirmation', function ( $confirmation, $form, $entry, $ajax ) {
    if ( 'gravity_forms' !== atb_form_plugin() ) return $confirmation;
    if ( (int) $form['id'] !== atb_get_form_id() ) return $confirmation;

    $results_page_id = (int) get_option( 'atb_results_page_id', 0 );
    if ( ! $results_page_id ) return $confirmation;

    // Extract concern IDs from the concerns_json hidden field
    $concerns_json = '';
    foreach ( $form['fields'] as $field ) {
        if ( strpos( $field->cssClass ?? '', 'atb-concerns' ) !== false ) {
            $concerns_json = rgar( $entry, (string) $field->id );
            break;
        }
    }

    $concern_ids = [];
    if ( $concerns_json ) {
        $decoded = json_decode( $concerns_json, true );
        if ( is_array( $decoded ) ) $concern_ids = array_keys( $decoded );
    }

    // Get first name from entry for personalisation
    $first_name = '';
    foreach ( $form['fields'] as $field ) {
        if ( in_array( $field->type, [ 'name', 'text' ], true ) && stripos( $field->label, 'name' ) !== false ) {
            $val = rgar( $entry, (string) $field->id );
            if ( $val ) { $first_name = trim( explode( ' ', $val )[0] ); break; }
        }
    }

    $results_url = add_query_arg( [
        'concerns' => rawurlencode( json_encode( $concern_ids ) ),
        'username' => rawurlencode( $first_name ?: 'You' ),
    ], get_permalink( $results_page_id ) );

    return [ 'redirect' => $results_url ];
}, 10, 4 );

/* ===============================================================
 * WPFORMS: redirect to results page after submission
 * ============================================================= */

/*
 * WPForms submits via its own <form> element (AJAX), which means the
 * concerns_json hidden field from the treatment builder's <form> is NOT
 * included in the WPForms submission. Server-side extraction is therefore
 * not possible without adding a WPForms-managed hidden field.
 *
 * Instead we handle this entirely client-side:
 *   1. Before WPForms submits  → save concerns to sessionStorage
 *   2. After WPForms succeeds  → redirect to results page with those concerns
 *
 * The inline script is injected in wp_enqueue_scripts (see ASSETS section).
 */

/* ===============================================================
 * PAGE DETECTION + BODY CLASS
 * ============================================================= */

function atb_page_has_shortcode() {
    global $post;
    return is_a( $post, 'WP_Post' ) && has_shortcode( $post->post_content, 'alpine_treatment_builder' );
}

function atb_page_has_results_shortcode() {
    global $post;
    return is_a( $post, 'WP_Post' ) && has_shortcode( $post->post_content, 'atb_results' );
}

add_filter( 'body_class', function ( $classes ) {
    if ( atb_page_has_shortcode() ) {
        $classes[] = 'atb-page';
        if ( atb_use_theme_chrome() ) $classes[] = 'atb-page--with-chrome';
    }
    if ( atb_page_has_results_shortcode() ) {
        $classes[] = 'atb-results-page';
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
            --llvcButtonBg:                    ' . atb_color('btn_bg')       . ';
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

        /* ---- Navbar: constrain inner content to max 1270px ---- */
        /* Applies to both builder (.container child) and results (.llvc-navbar__flex child) */
        .llvc-navbar > .container,
        .llvc-navbar > .container > .llvc-navbar__flex,
        .llvc-navbar > .llvc-navbar__flex {
            max-width: 1270px !important;
            margin-left: auto !important;
            margin-right: auto !important;
            padding-left: 50px !important;
            padding-right: 50px !important;
            box-sizing: border-box !important;
            width: 100% !important;
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

        /* ================================================================
           FORM STYLES — applies to both WPForms and Gravity Forms
           inside .llvc__form (step vc-3 of the treatment builder)
           ================================================================ */

        /* ---- Form step background (cream) — reinforced by the .is-active rule above ---- */
        .llvc__form {
            background-color: var(--llvcBaseBackground, #f1eadb) !important;
        }

        /* ---- Form content width — widen from compiled 370px ---- */
        .llvc__form .llvc__form-content {
            max-width: 480px !important;
            padding-left: 24px !important;
            padding-right: 24px !important;
            box-sizing: border-box !important;
        }

        /* ---- Field spacing ---- */
        .llvc__form .gform_fields {
            list-style: none !important; padding: 0 !important; margin: 0 !important;
        }
        .llvc__form .gform_fields .gfield,
        .llvc__form .wpforms-field {
            margin-bottom: 20px !important;
            padding: 0 !important;
        }

        /* ---- Labels ---- */
        .llvc__form .gfield_label,
        .llvc__form .wpforms-field-label {
            display: block !important;
            font-size: 15px !important;
            font-weight: 600 !important;
            color: var(--llvcHeader, #091714) !important;
            margin-bottom: 8px !important;
            font-family: inherit !important;
        }

        /* ---- Required asterisk ---- */
        .llvc__form .gfield_required,
        .llvc__form .wpforms-required-label {
            color: #c0392b !important;
            margin-left: 4px !important;
        }

        /* ---- GF / WPF containers — force full width so inputs match the button ---- */
        .llvc__form .ginput_container,
        .llvc__form .ginput_container_text,
        .llvc__form .ginput_container_email,
        .llvc__form .ginput_container_phone,
        .llvc__form .ginput_container_select,
        .llvc__form .ginput_container_textarea,
        .llvc__form .wpforms-field-container {
            width: 100% !important;
            max-width: 100% !important;
        }
        /* GF size classes (small / medium / large) often set explicit pixel widths */
        .llvc__form input.small,
        .llvc__form input.medium,
        .llvc__form input.large,
        .llvc__form select.small,
        .llvc__form select.medium,
        .llvc__form select.large,
        .llvc__form .gfield input,
        .llvc__form .gfield select,
        .llvc__form .gfield textarea {
            width: 100% !important;
            max-width: 100% !important;
            box-sizing: border-box !important;
        }
        /* WPForms size classes applied directly on <input> — override max-width: 60% / 25% etc */
        .llvc__form input.wpforms-field-small,
        .llvc__form input.wpforms-field-medium,
        .llvc__form input.wpforms-field-large,
        .llvc__form select.wpforms-field-small,
        .llvc__form select.wpforms-field-medium,
        .llvc__form select.wpforms-field-large,
        .llvc__form textarea.wpforms-field-small,
        .llvc__form textarea.wpforms-field-medium,
        .llvc__form textarea.wpforms-field-large {
            width: 100% !important;
            max-width: 100% !important;
            box-sizing: border-box !important;
        }

        /* ---- Text / email / tel / number inputs & textarea ---- */
        .llvc__form input[type="text"],
        .llvc__form input[type="email"],
        .llvc__form input[type="tel"],
        .llvc__form input[type="number"],
        .llvc__form input[type="url"],
        .llvc__form input[type="password"],
        .llvc__form select,
        .llvc__form textarea {
            display: block !important;
            width: 100% !important;
            box-sizing: border-box !important;
            height: 58px !important;
            padding: 0 18px !important;
            background: #fff !important;
            border: 1.5px solid #d9d9d9 !important;
            border-radius: 8px !important;
            font-size: 16px !important;
            font-family: inherit !important;
            color: var(--llvcHeader, #091714) !important;
            box-shadow: none !important;
            outline: none !important;
            transition: border-color 0.2s !important;
            -webkit-appearance: none !important;
        }
        .llvc__form textarea {
            height: auto !important;
            min-height: 120px !important;
            padding: 14px 18px !important;
            resize: vertical !important;
        }
        .llvc__form input[type="text"]:focus,
        .llvc__form input[type="email"]:focus,
        .llvc__form input[type="tel"]:focus,
        .llvc__form input[type="number"]:focus,
        .llvc__form input[type="url"]:focus,
        .llvc__form select:focus,
        .llvc__form textarea:focus {
            border-color: var(--llvcPrimary, #a3663c) !important;
            box-shadow: 0 0 0 3px rgba(163,102,60,0.12) !important;
        }
        .llvc__form input::placeholder,
        .llvc__form textarea::placeholder {
            color: #b0b0b0 !important;
            opacity: 1 !important;
        }

        /* ---- Checkbox & radio ---- */
        .llvc__form input[type="checkbox"],
        .llvc__form input[type="radio"] {
            width: 18px !important;
            height: 18px !important;
            min-width: 0 !important;
            min-height: 0 !important;
            border: 1.5px solid #d9d9d9 !important;
            border-radius: 4px !important;
            background: #fff !important;
            box-shadow: none !important;
            cursor: pointer !important;
            flex-shrink: 0 !important;
            vertical-align: middle !important;
            margin: 0 8px 0 0 !important;
            padding: 0 !important;
        }
        .llvc__form .gfield--type-checkbox .gfield_label,
        .llvc__form .gfield--type-radio .gfield_label,
        .llvc__form .wpforms-field-checkbox .wpforms-field-label,
        .llvc__form .wpforms-field-radio .wpforms-field-label {
            font-weight: 400 !important;
        }
        .llvc__form .gfield_checkbox label,
        .llvc__form .gfield_radio label,
        .llvc__form .wpforms-field-checkbox label,
        .llvc__form .wpforms-field-radio label {
            display: inline-flex !important;
            align-items: center !important;
            font-size: 15px !important;
            color: var(--llvcBodyText, #21403e) !important;
            font-weight: 400 !important;
            cursor: pointer !important;
        }

        /* ---- Submit button ---- */
        .llvc__form input[type="submit"],
        .llvc__form button[type="submit"],
        .llvc__form .gform_button,
        .llvc__form .wpforms-submit {
            display: block !important;
            width: 100% !important;
            height: 62px !important;
            padding: 0 24px !important;
            margin-top: 8px !important;
            background: var(--llvcButtonBg, #21403e) !important;
            color: #fff !important;
            border: none !important;
            border-radius: 8px !important;
            font-size: 18px !important;
            font-weight: 700 !important;
            font-family: inherit !important;
            letter-spacing: 0.01em !important;
            cursor: pointer !important;
            box-shadow: none !important;
            transition: background 0.2s !important;
        }
        .llvc__form input[type="submit"]:hover,
        .llvc__form button[type="submit"]:hover,
        .llvc__form .gform_button:hover,
        .llvc__form .wpforms-submit:hover {
            background: var(--llvcPrimary, #a3663c) !important;
        }

        /* ---- Hide WPForms / GF chrome not needed ---- */
        .llvc__form .wpforms-page-indicator,
        .llvc__form .gform_page_footer .gf_progressbar_wrapper { display: none !important; }

        /* ---- GF: remove default padding on wrapper ---- */
        .llvc__form .gform_wrapper,
        .llvc__form .gform_body { padding: 0 !important; margin: 0 !important; }

        /* ---- WPForms: remove default bottom padding ---- */
        .llvc__form .wpforms-form .wpforms-field:last-child { margin-bottom: 0 !important; }

        /* ---- Sublabels (WPForms name field split) ---- */
        .llvc__form .wpforms-field-sublabel {
            font-size: 12px !important;
            color: #999 !important;
            margin-top: 4px !important;
        }

        /* ---- Validation / error states ---- */
        .llvc__form input.wpforms-error,
        .llvc__form .gfield_error input,
        .llvc__form .gfield_error select,
        .llvc__form .gfield_error textarea {
            border-color: #c0392b !important;
        }
        .llvc__form .wpforms-error-container,
        .llvc__form label.wpforms-error,
        .llvc__form .gfield_description.validation_message {
            font-size: 13px !important;
            color: #c0392b !important;
            margin-top: 4px !important;
        }

        /* ---- Left column white background ---- */
        .llvc--concerns .llvc__body-column { background-color: #fff !important; }

        /* ---- Body nav: remove Astra bullets ---- */
        .llvc--concerns .llvc__body__nav {
            list-style: none !important; padding-left: 0 !important; margin-left: 0 !important;
        }

        /* ---- Selections (chosen concerns) list: hide bullets ---- */
        .llvc__chosen-concern-list,
        .llvc__chosen-concern-list li {
            list-style: none !important;
            padding-left: 0 !important;
            margin-left: 0 !important;
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

        /* ================================================================
           CONCERNS COLUMN LAYOUT — nested flex columns so every level
           adapts its height rather than using fixed calc() values.
           This keeps the Finish button pinned at the bottom AND keeps
           the Add button visible inside the concern area panel.
           ================================================================ */

        /* 1. Column becomes a flex column */
        .llvc--concerns .llvc__concerns-column {
            display: flex !important;
            flex-direction: column !important;
        }

        /* 2. Container grows to fill column minus the footer */
        .llvc--concerns .llvc__concerns-container {
            flex: 1 1 auto !important;
            min-height: 0 !important;
            overflow: hidden !important;
            display: flex !important;
            flex-direction: column !important;
        }

        /* 3. The form fills the container */
        .llvc--concerns .llvc__concerns-form {
            flex: 1 1 auto !important;
            min-height: 0 !important;
            overflow: hidden !important;
            display: flex !important;
            flex-direction: column !important;
        }

        /* 4. Active area / main fill the form — height now adapts to
              available space instead of using calc(100vh - topOffset - 80px) */
        .llvc--concerns .llvc__concerns__area.is-active,
        .llvc--concerns .llvc__concerns__main.is-active {
            flex: 1 1 auto !important;
            min-height: 0 !important;
            height: auto !important;
            max-height: none !important;
            overflow-y: auto !important;
        }

        /* 5. Inside the area: list scrolls, Add button stays at bottom */
        .llvc__concerns__area .llvc__concerns__area-list {
            flex: 1 1 0 !important;
            min-height: 0 !important;
            overflow-y: auto !important;
        }

        /* 6. Footer: Finish button pinned at the bottom */
        .llvc--concerns .llvc__concerns__footer {
            flex: 0 0 auto !important;
            display: flex !important;
            align-items: center !important;
            padding: 12px 0 !important;
        }
        .llvc--concerns .llvc__concerns__footer .llvc__finish-consultation--desktop {
            width: 100% !important;
        }

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
        /* Form step (vc-3) gets the cream background instead of white */
        body.atb-page:not(.atb-page--with-chrome) .llvc--concerns .llvc__form.is-active {
            background-color: var(--llvcBaseBackground, #f1eadb) !important;
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

        /* ── RESULTS PAGE full-screen ── */
        body.atb-results-page {
            overflow-x: hidden !important;
            background-color: var(--llvcBaseBackground, #f1eadb) !important;
            background-image: none !important;
        }
        /* Hide theme chrome */
        body.atb-results-page header:not(.llvc-navbar),
        body.atb-results-page .site-header,
        body.atb-results-page .navbar:not(.llvc-navbar),
        body.atb-results-page footer,
        body.atb-results-page .site-footer,
        body.atb-results-page .entry-header,
        body.atb-results-page h1.entry-title,
        body.atb-results-page .page-title,
        body.atb-results-page .site-main > .page-header,
        body.atb-results-page .ast-breadcrumbs-wrapper { display: none !important; }
        /* Strip Astra/theme containers */
        body.atb-results-page main,
        body.atb-results-page #main,
        body.atb-results-page .site-main,
        body.atb-results-page #primary,
        body.atb-results-page #content,
        body.atb-results-page .entry-content,
        body.atb-results-page .content-area,
        body.atb-results-page .wrap,
        body.atb-results-page [class*="ast-container"],
        body.atb-results-page .ast-grid-row,
        body.atb-results-page .ast-article-single,
        body.atb-results-page [class*="ast-article"],
        body.atb-results-page .fl-row,
        body.atb-results-page .fl-row-content,
        body.atb-results-page .container:not(.llvc__container) {
            padding: 0 !important; margin: 0 !important;
            max-width: 100% !important; width: 100% !important;
            background: transparent !important;
            border: none !important; box-shadow: none !important;
        }
        /* Navbar: full-width + z-index. Override Astra block-layout max-width rule
           (.entry-content[data-ast-blocks-layout] > * { max-width: site-width }) */
        body.atb-results-page .llvc-navbar,
        body.atb-results-page .entry-content > .llvc-navbar,
        body.atb-results-page .entry-content > .llvc--results {
            max-width: none !important;
            width: 100% !important;
            z-index: 9999 !important;
        }
        /* Heading overrides — beat Astra H1/H2/H3 rules */
        body.atb-results-page .llvc__heading--xs {
            font-size: 12px !important;
            font-weight: 500 !important;
            color: #666a6b !important;
            letter-spacing: 0.08em !important;
            text-transform: uppercase !important;
            margin: 0 0 8px !important;
            display: block !important;
            line-height: 1.4 !important;
        }
        body.atb-results-page .llvc__heading--xl {
            font-size: 32px !important;
            font-weight: 600 !important;
            color: var(--llvcHeader, #091714) !important;
            margin: 0 0 20px !important;
            line-height: 1.2 !important;
            display: block !important;
        }
        body.atb-results-page .llvc__results-concern__name {
            font-size: 20px !important;
            font-weight: 700 !important;
            color: var(--llvcHeader, #091714) !important;
            margin: 0 0 20px !important;
        }
        body.atb-results-page .llvc__procedure-card__title {
            font-size: 20px !important;
            font-weight: 700 !important;
            color: var(--llvcHeader, #091714) !important;
            margin: 0 0 12px !important;
            line-height: 1.3 !important;
        }
        /* Results wrapper: account for fixed navbar */
        body.atb-results-page .llvc--results {
            padding-top: calc(var(--wp-admin--admin-bar--height, 0px) + 58px + 56px) !important;
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

        /* ---- Navbar container: responsive padding ---- */
        @media (max-width: 768px) {
            .llvc-navbar > .container,
            .llvc-navbar > .container > .llvc-navbar__flex,
            .llvc-navbar > .llvc-navbar__flex {
                padding-left: 24px !important;
                padding-right: 24px !important;
            }
        }
        @media (max-width: 600px) {
            .llvc-navbar > .container,
            .llvc-navbar > .container > .llvc-navbar__flex,
            .llvc-navbar > .llvc-navbar__flex {
                padding-left: 20px !important;
                padding-right: 20px !important;
            }
        }
    ';

    wp_add_inline_style( 'atb-styles', $inline_css );

    wp_enqueue_script( 'atb-script', ATB_URL . 'public/js/alpine-tb.js', [ 'jquery' ], ATB_VERSION, true );
    wp_localize_script( 'atb-script', 'atbConfig', [
        'ajaxUrl' => admin_url( 'admin-ajax.php' ),
        'nonce'   => wp_create_nonce( 'atb_nonce' ),
        'homeUrl' => esc_url( home_url() ),
        'svgUrl'  => ATB_URL . 'public/svg/',
    ] );

    // ── WPForms redirect (client-side) ────────────────────────────────────────
    // Pass results URL and form info to JS so the redirect can be handled
    // entirely in the browser after WPForms' AJAX submission completes.
    if ( 'wpforms' === atb_form_plugin() ) {
        $results_pid = (int) get_option( 'atb_results_page_id', 0 );
        wp_add_inline_script( 'atb-script', sprintf(
            'var atbFormData = %s;',
            wp_json_encode( [
                'formPlugin' => 'wpforms',
                'wpfFormId'  => atb_get_wpf_form_id(),
                'resultsUrl' => $results_pid ? get_permalink( $results_pid ) : '',
            ] )
        ), 'before' );

        wp_add_inline_script( 'atb-script', <<<'JSCODE'
jQuery( function ( $ ) {
    if ( ! window.atbFormData || ! atbFormData.resultsUrl ) return;

    /* Helper: find the "first name" value in the WPForms form.
     * Works with WPForms' native Name field (wpforms-field-name-first)
     * AND with plain text fields whose label contains "first name" or "first". */
    function atbGetFirstName() {
        /* Native WPForms split-name first-name sub-field */
        var $native = $( '.wpforms-form .wpforms-field-name-first input' );
        if ( $native.length && $native.val().trim() ) return $native.val().trim().split( ' ' )[0];

        /* autocomplete hint */
        var $auto = $( '.wpforms-form input[autocomplete="given-name"]' );
        if ( $auto.length && $auto.val().trim() ) return $auto.val().trim().split( ' ' )[0];

        /* Plain text field whose label contains "first name" */
        var fname = '';
        $( '.wpforms-form .wpforms-field' ).each( function () {
            var label = $( this ).find( 'label' ).first().text().trim().toLowerCase();
            if ( label.indexOf( 'first' ) !== -1 ) {
                var val = $( this ).find( 'input[type="text"]' ).first().val().trim();
                if ( val ) { fname = val.split( ' ' )[0]; return false; }
            }
        } );
        if ( fname ) return fname;

        /* Fallback: first text input in the form */
        var $first = $( '.wpforms-form input[type="text"]' ).first();
        return $first.length ? ( $first.val().trim().split( ' ' )[0] || '' ) : '';
    }

    /* Keep sessionStorage username fresh as the user types. */
    $( document ).on( 'input change', '.wpforms-form input[type="text"]', function () {
        var $field = $( this ).closest( '.wpforms-field' );
        var label  = $field.find( 'label' ).first().text().trim().toLowerCase();
        /* Update whenever the label mentions "first" or this is the first text input */
        var isFirst = label.indexOf( 'first' ) !== -1
            || $( '.wpforms-form input[type="text"]' ).first().is( this );
        if ( isFirst ) {
            var fname = $( this ).val().trim().split( ' ' )[0] || '';
            try { sessionStorage.setItem( 'atb_pending_username', fname ); } catch ( ex ) {}
        }
    } );

    /* After WPForms AJAX succeeds: redirect to results page.
     *
     * wpformsAjaxSubmitSuccess fires BEFORE WPForms replaces the form with
     * its confirmation message, so we can still read field values from the DOM.
     *
     * WPForms 1.8+ fires "wpformsAjaxSubmitSuccess" on the <form> element,
     * which bubbles up to document. Older versions used "wpformsAjaxRequestSuccess".
     * We listen for both to cover all installed versions. */
    function atbHandleWpformsSuccess( e, res ) {
        /* wpformsAjaxSubmitSuccess fires only on success (WPForms already checked),
         * but wpformsAjaxRequestSuccess needs an extra guard. */
        if ( res && ( ! res.success || ( res.data && ( res.data.errors || res.data.is_error ) ) ) ) return;

        var concerns = [];
        try { concerns = JSON.parse( sessionStorage.getItem( 'atb_pending_concerns' ) || '[]' ); } catch ( ex ) {}

        /* Read the first name directly from the form DOM (still available at
         * this moment), fall back to whatever we stored during typing. */
        var username = atbGetFirstName()
            || sessionStorage.getItem( 'atb_pending_username' )
            || 'You';

        sessionStorage.removeItem( 'atb_pending_concerns' );
        sessionStorage.removeItem( 'atb_pending_username' );

        if ( ! concerns.length ) return;

        var sep = atbFormData.resultsUrl.indexOf( '?' ) !== -1 ? '&' : '?';
        var url = atbFormData.resultsUrl + sep
            + 'concerns=' + encodeURIComponent( JSON.stringify( concerns ) )
            + '&username=' + encodeURIComponent( username );

        /* Small delay lets WPForms finish its own DOM updates before we navigate. */
        setTimeout( function () { window.location.href = url; }, 300 );
    }

    $( document ).on( 'wpformsAjaxSubmitSuccess',  atbHandleWpformsSuccess );
    $( document ).on( 'wpformsAjaxRequestSuccess', atbHandleWpformsSuccess );
} );
JSCODE
        );
    }
} );

/* ===============================================================
 * RESULTS PAGE  [atb_results]
 * ============================================================= */

add_shortcode( 'atb_results', 'atb_render_results_page' );

function atb_get_treatments_for_concerns( array $concern_ids ) {
    if ( empty( $concern_ids ) ) return [];
    $meta_query = [ 'relation' => 'OR' ];
    foreach ( $concern_ids as $id ) {
        $meta_query[] = [ 'key' => '_atb_concern', 'value' => sanitize_text_field( $id ), 'compare' => '=' ];
    }
    return get_posts( [
        'post_type'      => 'atb_treatment',
        'posts_per_page' => -1,
        'post_status'    => 'publish',
        'meta_query'     => $meta_query,
    ] );
}

function atb_render_results_page() {
    $raw_concerns = isset( $_GET['concerns'] ) ? wp_unslash( $_GET['concerns'] ) : '[]';
    $concern_ids  = json_decode( rawurldecode( $raw_concerns ), true );
    if ( ! is_array( $concern_ids ) ) $concern_ids = [];

    $username = sanitize_text_field( isset( $_GET['username'] ) ? rawurldecode( $_GET['username'] ) : 'You' );

    // Build concern label + body-area lookup
    $concern_label_map = [];
    $concern_area_map  = []; // concern_id => section_label
    foreach ( atb_get_body_areas() as $area ) {
        foreach ( $area['concerns'] as $c ) {
            $concern_label_map[ $c['id'] ] = $c['label'];
            $concern_area_map[ $c['id'] ]  = $area['section_label'];
        }
    }

    // Get all matching treatments, then group by concern
    $all_treatments     = atb_get_treatments_for_concerns( $concern_ids );
    $concern_treatments = [];
    foreach ( $concern_ids as $cid ) {
        $concern_treatments[ $cid ] = [];
    }
    foreach ( $all_treatments as $treatment ) {
        $t_concerns = get_post_meta( $treatment->ID, '_atb_concern' ); // array of IDs
        foreach ( $concern_ids as $cid ) {
            if ( in_array( $cid, $t_concerns, true ) ) {
                $concern_treatments[ $cid ][] = $treatment;
            }
        }
    }
    // Drop concerns that matched no treatments
    $concern_treatments = array_filter( $concern_treatments );

    // Collect unique body-area labels for the intro sentence
    $area_labels = array_values( array_unique( array_filter(
        array_map( fn( $cid ) => $concern_area_map[ $cid ] ?? '', $concern_ids )
    ) ) );

    // Logo — same lookup as the main builder template
    $logo_src = atb_get_logo_url();

    ob_start();
    ?>
    <!-- ── Results Navbar ─────────────────────────────────────────── -->
    <header class="llvc-navbar">
        <div class="llvc-navbar__flex">
            <div class="llvc-navbar__spacer-col"></div>
            <a class="llvc-navbar__logo-link" href="<?php echo esc_url( home_url( '/' ) ); ?>">
                <img class="llvc-navbar__logo" src="<?php echo esc_url( $logo_src ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>">
            </a>
            <div class="llvc-navbar__exit-col">
                <a class="llvc-navbar__exit" href="javascript:history.back()">
                    Exit
                    <svg class="icon" viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" style="margin-left:6px;vertical-align:-2px"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
                </a>
            </div>
        </div>
    </header>

    <!-- ── Results Content ───────────────────────────────────────── -->
    <div class="llvc--results">
        <div class="llvc__container">

            <!-- Intro block -->
            <div class="llvc__results__intro-wrapper">
                <button class="llvc__results-print" onclick="window.print()">
                    <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M6 9V2h12v7M6 18H4a2 2 0 01-2-2v-5a2 2 0 012-2h16a2 2 0 012 2v5a2 2 0 01-2 2h-2M6 14h12v8H6z"/></svg>
                    Print a Copy
                </button>
                <div class="llvc__results__intro">
                    <div class="llvc__content">
                        <h1 class="llvc__heading--xs">OUR RECOMMENDATIONS</h1>
                        <p class="llvc__heading--xl">Made for <?php echo esc_html( $username ); ?></p>
                        <?php if ( ! empty( $area_labels ) ) : ?>
                        <p>Your recommendation is based on your goals to focus on the
                            <?php
                            $n = count( $area_labels );
                            foreach ( $area_labels as $i => $lbl ) {
                                echo '<span class="llvc__feature-text">' . esc_html( $lbl ) . '</span>';
                                if ( $i < $n - 2 ) echo ', ';
                                elseif ( $i < $n - 1 ) echo ' and ';
                            }
                            ?>.
                        </p>
                        <?php endif; ?>
                        <p class="llvc__wysiwyg">Here's a list of the best-suited treatments for you!</p>
                    </div>
                </div>
            </div>

            <?php if ( empty( $concern_treatments ) ) : ?>
            <div class="llvc__results-empty">
                <p>No treatment recommendations found for the selected concerns. Please contact us for a personalized consultation.</p>
            </div>
            <?php else : ?>

            <?php foreach ( $concern_treatments as $cid => $treatments ) :
                $concern_label = $concern_label_map[ $cid ] ?? $cid;
                $area_label    = $concern_area_map[ $cid ] ?? '';
            ?>
            <div class="llvc__results-concern">
                <div class="llvc__results-concern__inner">

                    <!-- Left: concern info -->
                    <div class="llvc__results-concern__intro">
                        <h2 class="llvc__results-concern__name"><?php echo esc_html( $concern_label ); ?></h2>
                        <p>These are the treatments we recommend.</p>
                        <?php if ( $area_label ) : ?>
                        <ul class="llvc__results-concern__areas">
                            <li><span class="llvc__feature-text"><?php echo esc_html( $area_label ); ?></span></li>
                        </ul>
                        <?php endif; ?>
                    </div>

                    <!-- Right: treatment cards -->
                    <div class="llvc__results-concern__procedures">
                        <div class="llvc__results-concern__procedures-cards">
                            <?php foreach ( $treatments as $treatment ) :
                                $teaser   = get_post_meta( $treatment->ID, '_atb_teaser', true );
                                $url      = get_post_meta( $treatment->ID, '_atb_url',    true );
                                $cats     = get_the_terms( $treatment->ID, 'atb_treatment_cat' );
                                $cat_name = ( ! is_wp_error( $cats ) && ! empty( $cats ) ) ? $cats[0]->name : '';
                                $desc     = $teaser ?: wp_trim_words( wp_strip_all_tags( $treatment->post_content ), 50 );

                                // Build full list of concern labels for the drawer
                                $t_all_concern_ids = get_post_meta( $treatment->ID, '_atb_concern' );
                                $t_concern_labels  = [];
                                foreach ( $t_all_concern_ids as $acid ) {
                                    $lbl = $concern_label_map[ $acid ] ?? null;
                                    if ( $lbl && ! in_array( $lbl, $t_concern_labels, true ) ) {
                                        $t_concern_labels[] = $lbl;
                                    }
                                }
                                sort( $t_concern_labels );

                                $drawer_data = wp_json_encode( [
                                    'title'       => $treatment->post_title,
                                    'description' => wp_strip_all_tags( $treatment->post_content ) ?: $desc,
                                    'concern'     => $concern_label_map[ $cid ] ?? $cid,
                                    'allConcerns' => $t_concern_labels,
                                    'url'         => $url ?: '',
                                ] );
                            ?>
                            <div class="llvc__procedure-card__wrapper">
                                <div class="llvc__procedure-card">
                                    <div class="llvc__procedure-card__body">
                                        <div class="llvc__procedure-card__content">
                                            <?php if ( $cat_name ) : ?>
                                            <span class="llvc__procedure-card__tag"><?php echo esc_html( $cat_name ); ?></span>
                                            <?php endif; ?>
                                            <h3 class="llvc__procedure-card__title"><?php echo esc_html( $treatment->post_title ); ?></h3>
                                            <?php if ( $desc ) : ?>
                                            <p><?php echo esc_html( $desc ); ?></p>
                                            <?php endif; ?>
                                        </div>
                                        <div class="llvc__procedure-card__learn-more">
                                            <button class="llvc__procedure-card__learn-more-button"
                                                    data-atb-drawer="<?php echo esc_attr( $drawer_data ); ?>">
                                                Learn More
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>

                </div>
            </div>
            <?php endforeach; ?>

            <?php endif; ?>
        </div>
    </div>

    <!-- ── Treatment Drawer ─────────────────────────────────────── -->
    <div class="llvc-drawer__overlay" id="llvc-drawer-overlay" aria-hidden="true"></div>
    <aside class="llvc-drawer" id="llvc-drawer" role="dialog" aria-modal="true" aria-hidden="true" aria-labelledby="llvc-drawer-header-title">
        <div class="llvc-drawer__header">
            <button class="llvc-drawer__back" id="llvc-drawer-close" aria-label="Close">
                <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" style="margin-right:6px;vertical-align:-2px"><path d="M19 12H5M11 6l-6 6 6 6"/></svg>
                Back
            </button>
            <span class="llvc-drawer__header-title" id="llvc-drawer-header-title"></span>
            <span class="llvc-drawer__header-spacer"></span>
        </div>
        <div class="llvc-drawer__body">
            <div class="llvc-drawer__card">
                <h2 class="llvc-drawer__title" id="llvc-drawer-title"></h2>
                <p class="llvc-drawer__description" id="llvc-drawer-description"></p>
                <p class="llvc-drawer__recommended">
                    Recommended based on your unique concern:
                    <strong class="llvc-drawer__primary-concern" id="llvc-drawer-concern"></strong>
                </p>
                <div class="llvc-drawer__also" id="llvc-drawer-also">
                    <h3 class="llvc-drawer__also-heading">In Addition it Treats</h3>
                    <ul class="llvc-drawer__also-list" id="llvc-drawer-also-list"></ul>
                </div>
                <div class="llvc-drawer__cta" id="llvc-drawer-cta" style="display:none">
                    <a class="llvc-drawer__cta-btn" id="llvc-drawer-cta-btn" href="#" target="_blank" rel="noopener">Learn More</a>
                </div>
            </div>
        </div>
    </aside>

    <script>
    (function () {
        var drawer  = document.getElementById( 'llvc-drawer' );
        var overlay = document.getElementById( 'llvc-drawer-overlay' );
        var closeBtn= document.getElementById( 'llvc-drawer-close' );
        var _lastFocus = null;

        /* Move overlay & drawer to <body> so they escape any parent stacking
           context (e.g. the theme's #page div with position:relative) and can
           sit above the fixed navbar / WP admin bar. */
        document.body.appendChild( overlay );
        document.body.appendChild( drawer );

        function openDrawer( data ) {
            document.getElementById( 'llvc-drawer-header-title' ).textContent = data.title || '';
            document.getElementById( 'llvc-drawer-title' ).textContent        = data.title || '';
            document.getElementById( 'llvc-drawer-description' ).textContent  = data.description || '';
            document.getElementById( 'llvc-drawer-concern' ).textContent      = data.concern || '';

            var list = document.getElementById( 'llvc-drawer-also-list' );
            list.innerHTML = '';
            var concerns = data.allConcerns || [];
            var also = document.getElementById( 'llvc-drawer-also' );
            if ( concerns.length ) {
                concerns.forEach( function ( c ) {
                    var li = document.createElement( 'li' );
                    li.className = 'llvc-drawer__also-item';
                    li.textContent = c;
                    list.appendChild( li );
                } );
                also.style.display = '';
            } else {
                also.style.display = 'none';
            }

            var cta    = document.getElementById( 'llvc-drawer-cta' );
            var ctaBtn = document.getElementById( 'llvc-drawer-cta-btn' );
            if ( data.url ) {
                ctaBtn.href = data.url;
                cta.style.display = '';
            } else {
                cta.style.display = 'none';
            }

            _lastFocus = document.activeElement;
            drawer.setAttribute(  'aria-hidden', 'false' );
            overlay.setAttribute( 'aria-hidden', 'false' );
            drawer.classList.add(  'is-open' );
            overlay.classList.add( 'is-open' );
            document.body.classList.add( 'llvc-drawer--open' );
            closeBtn.focus();
        }

        function closeDrawer() {
            drawer.classList.remove(  'is-open' );
            overlay.classList.remove( 'is-open' );
            drawer.setAttribute(  'aria-hidden', 'true' );
            overlay.setAttribute( 'aria-hidden', 'true' );
            document.body.classList.remove( 'llvc-drawer--open' );
            if ( _lastFocus ) { _lastFocus.focus(); _lastFocus = null; }
        }

        document.addEventListener( 'click', function ( e ) {
            var btn = e.target.closest( '[data-atb-drawer]' );
            if ( btn ) {
                e.preventDefault();
                try { openDrawer( JSON.parse( btn.getAttribute( 'data-atb-drawer' ) ) ); } catch ( err ) {}
            }
        } );

        closeBtn.addEventListener( 'click', closeDrawer );
        overlay.addEventListener(  'click', closeDrawer );
        document.addEventListener( 'keydown', function ( e ) {
            if ( e.key === 'Escape' && drawer.classList.contains( 'is-open' ) ) closeDrawer();
        } );
    })();
    </script>

    <style>
    /* ── Results: Page wrapper ────────────────────────────────── */
    .llvc--results {
        background-color: var(--llvcBaseBackground, #f1eadb);
        padding-top: calc(var(--wp-admin--admin-bar--height, 0px) + 58px + 56px);
        padding-bottom: 80px;
        min-height: 100vh;
        color: var(--llvcBodyText, #21403e);
        font-family: inherit;
        box-sizing: border-box;
    }
    .llvc--results .llvc__container {
        max-width: 1270px;
        margin: 0 auto;
        padding: 0 50px;
        box-sizing: border-box;
    }

    /* ── Results: Navbar inner container ─────────────────────── */
    body.atb-results-page .llvc-navbar__flex {
        max-width: 1270px;
        margin-left: auto;
        margin-right: auto;
        padding: 0 50px;
        box-sizing: border-box;
        width: 100%;
    }

    /* ── Results: Intro ───────────────────────────────────────── */
    .llvc__results__intro-wrapper {
        position: relative;
        margin-bottom: 96px;
    }
    .llvc__results-print {
        position: absolute;
        right: 0;
        top: 0;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        font-size: 14px;
        color: #666a6b;
        background: none !important;
        border: none !important;
        box-shadow: none !important;
        cursor: pointer;
        padding: 0 !important;
        min-width: 0 !important;
        min-height: 0 !important;
    }
    .llvc__results__intro {
        max-width: 570px;
        margin: 0 auto;
        text-align: center;
    }
    .llvc__heading--xs {
        font-size: 12px;
        font-weight: 500;
        color: #666a6b;
        letter-spacing: 0.08em;
        text-transform: uppercase;
        margin: 0 0 8px;
        display: block;
    }
    .llvc__heading--xl {
        font-size: 32px;
        font-weight: 600;
        color: var(--llvcHeader, #091714);
        margin: 0 0 20px;
        line-height: 1.2;
        display: block;
    }
    .llvc__results__intro .llvc__content > p {
        font-size: 16px;
        color: var(--llvcBodyText, #21403e);
        line-height: 1.6;
        margin: 0 0 20px;
    }
    .llvc__wysiwyg { margin-bottom: 20px; }
    .llvc__feature-text {
        font-weight: 600;
        color: var(--llvcBodyText, #21403e);
    }

    /* ── Results: Concern group row ───────────────────────────── */
    .llvc__results-concern {
        margin-bottom: 48px;
        padding-bottom: 48px;
        border-bottom: 1px solid #cccccc;
    }
    .llvc__results-concern:last-child {
        border-bottom: none;
        margin-bottom: 0;
    }
    .llvc__results-concern__inner {
        display: flex;
        margin: 0 -16px;
    }
    .llvc__results-concern__intro {
        flex: 0 0 25%;
        padding: 0 16px;
        box-sizing: border-box;
    }
    .llvc__results-concern__name {
        font-size: 20px;
        font-weight: 700;
        color: var(--llvcHeader, #091714);
        margin: 0 0 20px;
    }
    .llvc__results-concern__intro > p {
        font-size: 16px;
        color: var(--llvcBodyText, #21403e);
        margin: 0 0 16px;
        line-height: 1.5;
    }
    .llvc__results-concern__areas {
        list-style: none;
        padding: 0;
        margin: 0;
    }
    .llvc__results-concern__areas li {
        margin-bottom: 4px;
    }
    .llvc__results-concern__procedures {
        flex: 0 0 75%;
        padding: 0 16px;
        box-sizing: border-box;
    }
    .llvc__results-concern__procedures-cards {
        display: flex;
        flex-wrap: wrap;
        margin: 0 -16px;
    }

    /* ── Results: Treatment card ──────────────────────────────── */
    .llvc__procedure-card__wrapper {
        flex: 0 0 calc(33.333%);
        max-width: calc(33.333%);
        padding: 0 16px;
        margin-bottom: 32px;
        box-sizing: border-box;
    }
    .llvc__procedure-card {
        border: 1px solid #9c9c9c;
        border-radius: 12px;
        overflow: hidden;
        height: 100%;
        display: flex;
        flex-direction: column;
    }
    .llvc__procedure-card__body {
        background: #ffffff;
        padding: 24px;
        display: flex;
        flex-direction: column;
        flex: 1;
    }
    .llvc__procedure-card__content {
        flex: 1;
        margin-bottom: 20px;
    }
    .llvc__procedure-card__tag {
        display: inline-block;
        background: var(--llvcBaseBackground, #f1eadb);
        border: 1px solid #9c9c9c;
        color: var(--llvcBodyText, #21403e);
        font-size: 14px;
        padding: 4px 16px;
        border-radius: 100px;
        margin-bottom: 12px;
    }
    .llvc__procedure-card__title {
        font-size: 20px;
        font-weight: 700;
        color: var(--llvcHeader, #091714);
        margin: 0 0 12px;
        line-height: 1.3;
    }
    .llvc__procedure-card__content > p {
        font-size: 16px;
        color: var(--llvcBodyText, #21403e);
        line-height: 1.6;
        margin: 0;
    }
    .llvc__procedure-card__learn-more {
        margin-top: auto;
        padding-top: 16px;
    }
    .llvc__procedure-card__learn-more-button {
        font-size: 14px !important;
        color: var(--llvcBodyText, #21403e) !important;
        text-decoration: underline !important;
        text-underline-offset: 2px !important;
        background: none !important;
        border: none !important;
        box-shadow: none !important;
        padding: 0 !important;
        cursor: pointer !important;
        text-decoration-color: currentColor !important;
        border-radius: 0 !important;
        transition: none !important;
    }
    .llvc__procedure-card__learn-more-button:hover,
    .llvc__procedure-card__learn-more-button:focus,
    .llvc__procedure-card__learn-more-button:active {
        color: var(--llvcBodyText, #21403e) !important;
        background: none !important;
        box-shadow: none !important;
        border: none !important;
        text-decoration: underline !important;
    }
    /* ── Results: Empty state ─────────────────────────────────── */
    .llvc__results-empty {
        text-align: center;
        padding: 80px 20px;
        color: var(--llvcBodyText, #21403e);
        font-size: 18px;
    }

    /* ── Responsive ───────────────────────────────────────────── */
    @media (max-width: 1200px) {
        .llvc__procedure-card__wrapper { flex: 0 0 50%; max-width: 50%; }
    }
    @media (max-width: 900px) {
        .llvc__results-concern__inner { flex-direction: column; margin: 0; }
        .llvc__results-concern__intro { flex: none; width: 100%; padding: 0; margin-bottom: 24px; }
        .llvc__results-concern__procedures { flex: none; width: 100%; padding: 0; }
        .llvc__results-concern__procedures-cards { margin: 0 -8px; }
        .llvc__procedure-card__wrapper { padding: 0 8px; margin-bottom: 16px; }
    }
    @media (max-width: 768px) {
        .llvc--results .llvc__container,
        body.atb-results-page .llvc-navbar__flex { padding: 0 24px; }
    }
    @media (max-width: 600px) {
        .llvc--results .llvc__container,
        body.atb-results-page .llvc-navbar__flex { padding: 0 20px; }
        .llvc__heading--xl { font-size: 24px; }
        .llvc__results__intro-wrapper { margin-bottom: 48px; }
        .llvc__results-print { position: static; margin-bottom: 16px; }
        .llvc__procedure-card__wrapper { flex: 0 0 100%; max-width: 100%; }
    }
    @media print {
        body.atb-results-page .llvc-navbar { position: static; }
        .llvc__results-print { display: none; }
        .llvc-drawer, .llvc-drawer__overlay { display: none !important; }
    }

    /* ── Drawer: overlay ──────────────────────────────────────── */
    .llvc-drawer__overlay {
        position: fixed;
        inset: 0;
        background: rgba(0, 0, 0, 0.45);
        z-index: 999990;
        opacity: 0;
        pointer-events: none;
        transition: opacity 0.3s ease;
    }
    .llvc-drawer__overlay.is-open {
        opacity: 1;
        pointer-events: auto;
    }

    /* ── Drawer: panel ────────────────────────────────────────── */
    .llvc-drawer {
        position: fixed;
        top: var(--wp-admin--admin-bar--height, 0px);
        right: 0;
        bottom: 0;
        width: 62%;
        max-width: 900px;
        min-width: 320px;
        background: #fff;
        z-index: 999991;
        display: flex;
        flex-direction: column;
        transform: translateX(100%);
        transition: transform 0.35s cubic-bezier(0.4, 0, 0.2, 1);
        box-shadow: -4px 0 32px rgba(0, 0, 0, 0.12);
        overflow: hidden;
    }
    .llvc-drawer.is-open {
        transform: translateX(0);
    }
    /* Prevent body scroll while drawer is open */
    body.llvc-drawer--open {
        overflow: hidden !important;
    }

    /* ── Drawer: header bar ───────────────────────────────────── */
    .llvc-drawer__header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 0 28px;
        height: 56px;
        border-bottom: 1px solid #e8e8e8;
        flex-shrink: 0;
        background: #fff;
    }
    .llvc-drawer__back {
        display: inline-flex !important;
        align-items: center !important;
        background: none !important;
        border: none !important;
        box-shadow: none !important;
        padding: 0 !important;
        min-width: 0 !important;
        min-height: 0 !important;
        font-size: 14px !important;
        color: var(--llvcBodyText, #21403e) !important;
        cursor: pointer !important;
        font-weight: 500 !important;
        white-space: nowrap !important;
        border-radius: 0 !important;
        transition: none !important;
    }
    .llvc-drawer__back:hover {
        color: var(--llvcPrimary, #a3663c) !important;
    }
    .llvc-drawer__header-title {
        font-size: 15px;
        font-weight: 600;
        color: var(--llvcHeader, #091714);
        text-align: center;
        flex: 1;
        padding: 0 12px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
    .llvc-drawer__header-spacer {
        /* Mirrors the "Back" button width to keep the title centered */
        width: 64px;
        flex-shrink: 0;
    }

    /* ── Drawer: scrollable body ──────────────────────────────── */
    .llvc-drawer__body {
        flex: 1;
        overflow-y: auto;
        padding: 40px 40px 60px;
        background: var(--llvcBaseBackground, #f1eadb);
    }

    /* ── Drawer: white card ───────────────────────────────────── */
    .llvc-drawer__card {
        background: #fff;
        border-radius: 16px;
        padding: 40px;
    }
    .llvc-drawer__title {
        font-size: 32px;
        font-weight: 700;
        color: var(--llvcHeader, #091714);
        margin: 0 0 20px;
        line-height: 1.2;
    }
    .llvc-drawer__description {
        font-size: 16px;
        color: var(--llvcBodyText, #21403e);
        line-height: 1.7;
        margin: 0 0 32px;
    }
    .llvc-drawer__recommended {
        font-size: 16px;
        font-weight: 600;
        color: var(--llvcHeader, #091714);
        margin: 0 0 32px;
        padding-top: 28px;
        border-top: 1px solid #e8e8e8;
    }
    .llvc-drawer__primary-concern {
        color: var(--llvcPrimary, #a3663c);
        font-weight: 700;
    }

    /* ── Drawer: also treats ──────────────────────────────────── */
    .llvc-drawer__also {
        padding-top: 28px;
        border-top: 1px solid #e8e8e8;
    }
    .llvc-drawer__also-heading {
        font-size: 20px;
        font-weight: 700;
        color: var(--llvcHeader, #091714);
        margin: 0 0 20px;
    }
    .llvc-drawer__also-list {
        list-style: none;
        padding: 0;
        margin: 0;
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 0;
    }
    .llvc-drawer__also-item {
        font-size: 15px;
        font-weight: 600;
        color: var(--llvcHeader, #091714);
        padding: 14px 12px 14px 0;
        border-bottom: 1px solid #e0e0e0;
    }

    /* ── Drawer: CTA button ───────────────────────────────────── */
    .llvc-drawer__cta {
        padding-top: 32px;
        margin-top: 28px;
        border-top: 1px solid #e8e8e8;
    }
    .llvc-drawer__cta-btn {
        display: inline-block;
        background: var(--llvcHeader, #091714);
        color: #fff !important;
        text-decoration: none !important;
        padding: 14px 32px;
        border-radius: 100px;
        font-size: 15px;
        font-weight: 600;
        letter-spacing: 0.02em;
        transition: background 0.2s;
    }
    .llvc-drawer__cta-btn:hover {
        background: var(--llvcPrimary, #a3663c);
    }

    /* ── Drawer: responsive ───────────────────────────────────── */
    @media (max-width: 900px) {
        .llvc-drawer { width: 85%; }
        .llvc-drawer__body { padding: 24px 20px 40px; }
        .llvc-drawer__card { padding: 24px; }
        .llvc-drawer__title { font-size: 24px; }
        .llvc-drawer__also-list { grid-template-columns: repeat(2, 1fr); }
    }
    @media (max-width: 600px) {
        .llvc-drawer { width: 100%; min-width: 0; }
        .llvc-drawer__also-list { grid-template-columns: 1fr; }
    }
    </style>
    <?php
    return ob_get_clean();
}

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
