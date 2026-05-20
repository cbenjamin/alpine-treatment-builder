<?php
/**
 * Plugin Name: Alpine Treatment Builder
 * Plugin URI:  https://www.alpinewellnessnv.com/
 * Description: Interactive body-map treatment planner for Alpine Wellness.
 * Version:     1.0.5
 * Author:      Alpine Wellness
 * Text Domain: alpine-tb
 */

defined( 'ABSPATH' ) || exit;

define( 'ATB_VERSION', '1.0.5' );
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
    register_setting( 'atb_settings_general', 'atb_gravity_form_id',  [ 'sanitize_callback' => 'absint',           'default' => 0 ] );
    register_setting( 'atb_settings_general', 'atb_logo_url',         [ 'sanitize_callback' => 'esc_url_raw',      'default' => '' ] );
    register_setting( 'atb_settings_general', 'atb_use_theme_chrome', [ 'sanitize_callback' => fn($v) => $v ? '1' : '0', 'default' => '0' ] );
    register_setting( 'atb_settings_general', 'atb_results_page_id',  [ 'sanitize_callback' => 'absint',           'default' => 0 ] );

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
    $tabs = [ 'general' => 'General', 'branding' => 'Branding', 'text' => 'Text', 'areas' => 'Body Areas' ];
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

        /* ── Body Areas tab ── */
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

    <?php /* ══════════════ BODY AREAS TAB ══════════════ */ ?>
    <?php elseif ( 'areas' === $tab ) :
        $areas      = atb_get_body_areas();
        $areas_json = wp_json_encode( $areas );
        wp_nonce_field( 'atb_body_areas_nonce', 'atb_areas_nonce' );
    ?>
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
        <button type="button" id="atb-areas-save" class="button button-primary"><?php esc_html_e( 'Save All Changes', 'alpine-tb' ); ?></button>
        <span id="atb-areas-status" style="margin-left:12px;"></span>
    </div>
    </div><!-- .atb-areas-wrap -->
    <?php endif; ?>

    </div><!-- .wrap -->

    <script>
    jQuery(function($){
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

        /* ── Body Areas ── */
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

        // Save body areas
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
                    $status.css('color', 'green').text('✓ Saved successfully.');
                } else {
                    $status.css('color', 'red').text('Error: ' + (r.data || 'Unknown error'));
                }
            }).fail(function(){
                $status.css('color', 'red').text('Save failed. Please try again.');
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
        'show_in_menu' => true,
        'supports'     => [ 'title', 'editor' ],
        'menu_icon'    => 'dashicons-heart',
        'has_archive'  => false,
        'rewrite'      => false,
    ] );

    register_taxonomy( 'atb_treatment_cat', 'atb_treatment', [
        'label'        => 'Categories',
        'hierarchical' => false,
        'show_ui'      => true,
        'rewrite'      => false,
        'show_in_menu' => true,
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

    $username   = sanitize_text_field( isset( $_GET['username'] ) ? rawurldecode( $_GET['username'] ) : 'You' );
    $treatments = atb_get_treatments_for_concerns( $concern_ids );

    // Build a map of concern_id => label for display
    $concern_label_map = [];
    foreach ( atb_get_body_areas() as $area ) {
        foreach ( $area['concerns'] as $c ) {
            $concern_label_map[ $c['id'] ] = $c['label'];
        }
    }

    ob_start();
    ?>
    <div class="atb-results">
        <div class="atb-results__header">
            <h1 class="atb-results__title">OUR RECOMMENDATIONS</h1>
            <p class="atb-results__subtitle">Made for <?php echo esc_html( $username ); ?></p>
            <?php if ( ! empty( $concern_ids ) ) : ?>
            <p class="atb-results__intro">Here's a list of the best-suited treatments for you!</p>
            <div class="atb-results__selected-concerns">
                <h2>Your Selected Concerns</h2>
                <ul>
                <?php foreach ( $concern_ids as $cid ) : ?>
                    <li><?php echo esc_html( $concern_label_map[ $cid ] ?? $cid ); ?></li>
                <?php endforeach; ?>
                </ul>
            </div>
            <?php endif; ?>
        </div>

        <?php if ( empty( $treatments ) ) : ?>
        <p class="atb-results__empty">No treatment recommendations found for the selected concerns. Please contact us for a personalized consultation.</p>
        <?php else : ?>
        <div class="atb-results__treatments">
            <?php foreach ( $treatments as $treatment ) :
                $teaser    = get_post_meta( $treatment->ID, '_atb_teaser', true );
                $url       = get_post_meta( $treatment->ID, '_atb_url',    true );
                $cats      = get_the_terms( $treatment->ID, 'atb_treatment_cat' );
                $cat_name  = ( ! is_wp_error( $cats ) && ! empty( $cats ) ) ? $cats[0]->name : '';
                // Find which of the user's concerns triggered this treatment
                $treatment_concerns = get_post_meta( $treatment->ID, '_atb_concern' ); // array
                $triggered_by       = array_intersect( $concern_ids, $treatment_concerns );
                $triggered_labels   = array_map( fn( $id ) => $concern_label_map[ $id ] ?? $id, $triggered_by );
            ?>
            <div class="atb-results__treatment-card">
                <?php if ( $cat_name ) : ?>
                <span class="atb-results__cat-badge"><?php echo esc_html( $cat_name ); ?></span>
                <?php endif; ?>
                <h2 class="atb-results__treatment-name"><?php echo esc_html( $treatment->post_title ); ?></h2>
                <?php if ( $teaser ) : ?>
                <p class="atb-results__teaser"><?php echo esc_html( $teaser ); ?></p>
                <?php elseif ( $treatment->post_content ) : ?>
                <p class="atb-results__teaser"><?php echo wp_trim_words( wp_strip_all_tags( $treatment->post_content ), 40 ); ?></p>
                <?php endif; ?>
                <?php if ( ! empty( $triggered_labels ) ) : ?>
                <p class="atb-results__triggered-by">Recommended based on: <strong><?php echo esc_html( implode( ', ', $triggered_labels ) ); ?></strong></p>
                <?php endif; ?>
                <?php if ( $url ) : ?>
                <a href="<?php echo esc_url( $url ); ?>" class="atb-results__learn-more">Learn More about <?php echo esc_html( $treatment->post_title ); ?></a>
                <?php endif; ?>
            </div>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>
    </div>
    <style>
    .atb-results { max-width: 900px; margin: 0 auto; padding: 40px 20px; font-family: inherit; }
    .atb-results__header { margin-bottom: 40px; }
    .atb-results__title { font-size: 2rem; font-weight: 700; margin-bottom: 8px; }
    .atb-results__subtitle { font-size: 1.25rem; color: #666; margin-bottom: 16px; }
    .atb-results__selected-concerns { background: #f9f5ef; border-radius: 8px; padding: 16px 24px; margin-bottom: 24px; }
    .atb-results__selected-concerns h2 { font-size: 1rem; font-weight: 600; margin-bottom: 8px; }
    .atb-results__selected-concerns ul { list-style: none; padding: 0; margin: 0; display: flex; flex-wrap: wrap; gap: 8px; }
    .atb-results__selected-concerns li { background: #fff; border: 1px solid #ddd; border-radius: 20px; padding: 4px 12px; font-size: 0.9rem; }
    .atb-results__treatments { display: grid; gap: 24px; }
    .atb-results__treatment-card { border: 1px solid #e5e7eb; border-radius: 12px; padding: 28px; background: #fff; }
    .atb-results__cat-badge { display: inline-block; background: #f1eadb; color: #7a4a25; font-size: 0.75rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0.05em; padding: 3px 10px; border-radius: 12px; margin-bottom: 12px; }
    .atb-results__treatment-name { font-size: 1.5rem; font-weight: 700; margin: 0 0 12px; }
    .atb-results__teaser { color: #444; line-height: 1.6; margin-bottom: 16px; }
    .atb-results__triggered-by { font-size: 0.9rem; color: #666; margin-bottom: 16px; }
    .atb-results__triggered-by strong { color: #a3663c; }
    .atb-results__learn-more { display: inline-block; background: #a3663c; color: #fff; text-decoration: none; padding: 10px 20px; border-radius: 6px; font-weight: 600; font-size: 0.9rem; }
    .atb-results__learn-more:hover { background: #8a5230; color: #fff; }
    .atb-results__empty { text-align: center; padding: 60px 20px; color: #666; }
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
