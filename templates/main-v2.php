<?php
defined( 'ABSPATH' ) || exit;

/* -----------------------------------------------------------------------
 * Data for the modern template — uses V1 helpers so all admin settings,
 * text overrides, and body-area data are shared with the Classic style.
 * --------------------------------------------------------------------- */
$atbm_font       = atb_font();
$atbm_logo_src   = atb_get_logo_url();
$atbm_home_url   = esc_url( home_url() );
$atbm_use_chrome = atb_use_theme_chrome();
$atbm_svg_dir    = ATB_PATH . 'public/svg/';

$atbm_form_plugin = atb_form_plugin();
$atbm_wpf_id      = atb_get_wpf_form_id();
$atbm_gf_id       = atb_get_form_id();

$atbm_results_pid = (int) get_option( 'atb_results_page_id', 0 );
$atbm_results_url = $atbm_results_pid ? get_permalink( $atbm_results_pid ) : '';

// Colors — mapped from modern_color settings via atb_mcolor()
$atbm_c = [
    'page_bg'     => atb_mcolor( 'm_page_bg' ),
    'card_bg'     => atb_mcolor( 'm_card_bg' ),
    'card_border' => atb_mcolor( 'm_card_border' ),
    'dark'        => atb_mcolor( 'm_dark' ),
    'text'        => atb_mcolor( 'm_text' ),
    'muted'       => atb_mcolor( 'm_muted' ),
    'accent'      => atb_mcolor( 'm_accent' ),
    'btn_bg'      => atb_mcolor( 'm_btn_bg' ),
];

// Body areas (Scalp/Upper Face remapped to 'face' view)
$atbm_areas    = atb_get_body_areas_for_modern();
$atbm_hotspots = atb_get_modern_hotspots();

// Build JS areas object keyed by area id
$atbm_js_areas = [];
foreach ( $atbm_areas as $area ) {
    $concerns = [];
    foreach ( (array) $area['concerns'] as $c ) {
        $concerns[] = [ 'id' => $c['id'], 'label' => $c['label'] ];
    }
    $atbm_js_areas[ $area['id'] ] = [
        'id'      => $area['id'],
        'gender'  => $area['gender'],
        'view'    => $area['view'],
        'header'  => $area['header'],
        'label'   => $area['section_label'],
        'concerns' => $concerns,
    ];
}

// SVG figure files
$atbm_figures = [
    'female-front' => 'female-figure-front.svg',
    'female-back'  => 'female-figure-back.svg',
    'female-face'  => 'outline-of-female-face-and-neck.svg',
    'male-front'   => 'male-front-figure.svg',
    'male-back'    => 'male-figure-back.svg',
    'male-face'    => 'outline-of-male-face-and-neck.svg',
];
?>

<style>
/* ══════════════════════════════════════════════════════════════════
 * ATB MODERN — Design system tokens + component styles
 * ══════════════════════════════════════════════════════════════════ */
:root {
    --atb2-page-bg:     <?php echo $atbm_c['page_bg']; ?>;
    --atb2-card-bg:     <?php echo $atbm_c['card_bg']; ?>;
    --atb2-card-border: <?php echo $atbm_c['card_border']; ?>;
    --atb2-dark:        <?php echo $atbm_c['dark']; ?>;
    --atb2-text:        <?php echo $atbm_c['text']; ?>;
    --atb2-muted:       <?php echo $atbm_c['muted']; ?>;
    --atb2-accent:      <?php echo $atbm_c['accent']; ?>;
    --atb2-btn-bg:      <?php echo $atbm_c['btn_bg']; ?>;
    --atb2-font:        '<?php echo esc_attr( $atbm_font ); ?>', system-ui, -apple-system, sans-serif;
    --atb2-radius:      8px;
    --atb2-shadow:      0 1px 3px rgba(0,0,0,0.08), 0 1px 2px rgba(0,0,0,0.06);
    --atb2-shadow-md:   0 4px 6px -1px rgba(0,0,0,0.1), 0 2px 4px -1px rgba(0,0,0,0.06);
}

.atb2-wrap *, .atb2-wrap *::before, .atb2-wrap *::after { box-sizing: border-box; }

/* ── THEME CHROME SUPPRESSION (PHP class applied server-side = no FOUC) ── */
<?php if ( ! $atbm_use_chrome ) : ?>
body.atb-page--modern,
body.atb2-page {
    margin: 0 !important;
    padding-top: 0 !important;
    background: var(--atb2-page-bg) !important;
    overflow-x: hidden;
}
body.atb-page--modern .site-header,
body.atb2-page .site-header,
body.atb-page--modern header.ast-site-header-wrap,
body.atb2-page header.ast-site-header-wrap,
body.atb-page--modern .ast-above-header-bar,
body.atb2-page .ast-above-header-bar,
body.atb-page--modern .ast-breadcrumbs-wrapper,
body.atb2-page .ast-breadcrumbs-wrapper,
body.atb-page--modern .entry-header,
body.atb2-page .entry-header,
body.atb-page--modern h1.entry-title,
body.atb2-page h1.entry-title,
body.atb-page--modern .page-title,
body.atb2-page .page-title,
body.atb-page--modern footer.site-footer,
body.atb2-page footer.site-footer,
body.atb-page--modern .site-footer,
body.atb2-page .site-footer { display: none !important; }
body.atb-page--modern main,
body.atb2-page main,
body.atb-page--modern .site-main,
body.atb2-page .site-main,
body.atb-page--modern #main,
body.atb2-page #main,
body.atb-page--modern #content,
body.atb2-page #content,
body.atb-page--modern .ast-container,
body.atb2-page .ast-container,
body.atb-page--modern .entry-content,
body.atb2-page .entry-content,
body.atb-page--modern .content-area,
body.atb2-page .content-area,
body.atb-page--modern article,
body.atb2-page article {
    padding: 0 !important;
    margin: 0 !important;
    max-width: 100% !important;
    width: 100% !important;
    background: transparent !important;
}
<?php endif; ?>

/* ── OUTER WRAP — breaks out of WP theme's max-width container ── */
.atb2-wrap {
    position: relative;
    width: 100vw;
    left: 50%;
    transform: translateX(-50%);
    max-width: 100vw;
    font-family: var(--atb2-font);
    color: var(--atb2-text);
    background: var(--atb2-page-bg);
    min-height: 100vh;
    display: flex;
    flex-direction: column;
    /* Prevent button/label text-transform from WP theme */
    text-transform: none !important;
}
.atb2-wrap button,
.atb2-wrap a,
.atb2-wrap label,
.atb2-wrap span,
.atb2-wrap p,
.atb2-wrap h1,
.atb2-wrap h2,
.atb2-wrap h3 {
    text-transform: none !important;
    font-family: var(--atb2-font) !important;
}

/* ── NAVBAR ── */
.atb2-nav {
    background: var(--atb2-dark);
    position: sticky;
    top: var(--wp-admin--admin-bar--height, 0px);
    z-index: 50;
    height: 64px;
    flex-shrink: 0;
    width: 100%;
}
.atb2-nav__inner {
    max-width: 1280px;
    margin: 0 auto;
    height: 100%;
    display: grid;
    grid-template-columns: 1fr auto 1fr;
    align-items: center;
    gap: 12px;
    padding: 0 24px;
}
.atb2-nav__back,
.atb2-nav__exit {
    background: none !important;
    border: none !important;
    color: #f7f4ef !important;
    font-size: 14px !important;
    font-family: var(--atb2-font) !important;
    font-weight: 500 !important;
    cursor: pointer !important;
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 6px 10px !important;
    border-radius: 6px !important;
    transition: background 0.15s;
    text-decoration: none !important;
    text-transform: none !important;
    box-shadow: none !important;
    line-height: 1.4 !important;
}
.atb2-nav__back:hover,
.atb2-nav__exit:hover { background: rgba(255,255,255,0.1) !important; color: #f7f4ef !important; }
.atb2-nav__exit { margin-left: auto; }
.atb2-nav__logo { max-height: 40px; max-width: 160px; display: block; margin: 0 auto; object-fit: contain; }
/* Hide back button on intro screen */
.atb2-nav__back.is-hidden { visibility: hidden; pointer-events: none; }

/* ── PAGE BODY ── */
.atb2-page-body { flex: 1; overflow-y: auto; }
.atb2-inner { max-width: 1280px; margin: 0 auto; padding: 24px 24px 48px; }

/* ── SCREENS ── */
.atb2-screen { display: none; }
.atb2-screen.is-active { display: block; }

/* ══════════════════════════════════════════════════════════════════
 * INTRO SCREEN
 * ══════════════════════════════════════════════════════════════════ */
.atb2-intro-inner { padding: 40px 24px 60px; }
.atb2-intro-grid {
    display: grid;
    grid-template-columns: 1fr;
    gap: 40px;
    align-items: center;
    max-width: 1100px;
    margin: 0 auto;
}
@media (min-width: 860px) {
    .atb2-intro-grid { grid-template-columns: 1fr 340px; }
}
.atb2-intro-brand {
    font-size: 11px !important;
    font-weight: 700 !important;
    letter-spacing: 0.14em;
    text-transform: uppercase !important;
    color: var(--atb2-muted) !important;
    margin: 0 0 16px !important;
}
.atb2-intro-heading {
    font-size: 34px !important;
    font-weight: 700 !important;
    color: var(--atb2-dark) !important;
    line-height: 1.2 !important;
    margin: 0 0 12px !important;
}
.atb2-intro-subtitle {
    font-size: 16px !important;
    color: var(--atb2-muted) !important;
    margin: 0 0 20px !important;
    line-height: 1.5 !important;
}
.atb2-intro-privacy {
    border-left: 3px solid var(--atb2-accent);
    padding-left: 14px;
    margin: 0 0 28px;
}
.atb2-intro-privacy p {
    font-size: 14px !important;
    color: var(--atb2-muted) !important;
    margin: 0 !important;
    line-height: 1.6 !important;
}
.atb2-intro-steps {
    display: flex;
    flex-direction: column;
    gap: 10px;
    margin: 0 0 32px;
}
.atb2-step-card {
    background: var(--atb2-card-bg);
    border: 1px solid var(--atb2-card-border);
    border-radius: var(--atb2-radius);
    padding: 14px 16px;
    display: flex;
    align-items: flex-start;
    gap: 14px;
    box-shadow: var(--atb2-shadow);
}
.atb2-step-num {
    font-size: 12px !important;
    font-weight: 700 !important;
    color: var(--atb2-accent) !important;
    min-width: 26px;
    letter-spacing: 0.06em;
    flex-shrink: 0;
    margin-top: 2px;
    font-family: var(--atb2-font) !important;
}
.atb2-step-card p {
    font-size: 14px !important;
    color: var(--atb2-text) !important;
    margin: 0 !important;
    line-height: 1.5 !important;
}
.atb2-intro-actions {
    display: flex;
    flex-direction: column;
    gap: 12px;
    align-items: flex-start;
}
.atb2-start-btn {
    background: var(--atb2-dark) !important;
    color: #fff !important;
    border: none !important;
    border-radius: var(--atb2-radius) !important;
    padding: 14px 36px !important;
    font-family: var(--atb2-font) !important;
    font-size: 15px !important;
    font-weight: 700 !important;
    cursor: pointer !important;
    transition: background 0.2s !important;
    text-transform: none !important;
    box-shadow: none !important;
    line-height: 1.4 !important;
    display: inline-block;
}
.atb2-start-btn:hover { background: var(--atb2-btn-bg) !important; }
.atb2-visit-link {
    font-size: 14px !important;
    color: var(--atb2-muted) !important;
    text-decoration: underline !important;
    cursor: pointer;
    background: none !important;
    border: none !important;
    font-family: var(--atb2-font) !important;
    padding: 0 !important;
    display: inline-block;
}
.atb2-visit-link:hover { color: var(--atb2-text) !important; }
.atb2-intro-figure-card {
    background: var(--atb2-card-bg);
    border: 1px solid var(--atb2-card-border);
    border-radius: var(--atb2-radius);
    overflow: hidden;
    display: flex;
    align-items: center;
    justify-content: center;
    min-height: 300px;
    box-shadow: var(--atb2-shadow);
}
.atb2-intro-figure-card svg,
.atb2-intro-figure-card img {
    width: 100%;
    max-height: 480px;
    object-fit: contain;
    display: block;
    padding: 16px;
}

/* ══════════════════════════════════════════════════════════════════
 * BUILDER SCREEN
 * ══════════════════════════════════════════════════════════════════ */

/* ── CONTROLS ROW ── */
.atb2-controls {
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    justify-content: space-between;
    gap: 12px;
    background: var(--atb2-card-bg);
    border: 1px solid var(--atb2-card-border);
    border-radius: var(--atb2-radius);
    padding: 12px 16px;
    margin-bottom: 16px;
    box-shadow: var(--atb2-shadow);
}

/* ── SEGMENTED CONTROL ── */
.atb2-seg {
    display: inline-flex;
    background: #ede8e0;
    border-radius: 6px;
    padding: 3px;
    gap: 2px;
}
.atb2-seg__btn {
    background: none !important;
    border: none !important;
    padding: 7px 16px !important;
    border-radius: 4px !important;
    font-family: var(--atb2-font) !important;
    font-size: 13px !important;
    font-weight: 600 !important;
    color: var(--atb2-muted) !important;
    cursor: pointer !important;
    transition: all 0.15s !important;
    white-space: nowrap;
    text-transform: none !important;
    box-shadow: none !important;
    line-height: 1.4 !important;
}
.atb2-seg__btn.is-active {
    background: var(--atb2-dark) !important;
    color: #fff !important;
    box-shadow: 0 1px 3px rgba(0,0,0,0.18), 0 1px 2px rgba(0,0,0,0.12) !important;
}
.atb2-seg__btn:hover:not(.is-active) { color: var(--atb2-text) !important; }

/* ── MAIN GRID ── */
.atb2-grid { display: grid; gap: 16px; align-items: start; }
@media (min-width: 1024px) { .atb2-grid { grid-template-columns: 1fr 360px; } }

/* ── CARD ── */
.atb2-card {
    background: var(--atb2-card-bg);
    border: 1px solid var(--atb2-card-border);
    border-radius: var(--atb2-radius);
    box-shadow: var(--atb2-shadow);
    overflow: hidden;
}

/* ── BODY MAP CARD ── */
.atb2-map-card { padding: 16px; }
.atb2-map-grid { display: grid; gap: 16px; }
@media (min-width: 700px) {
    .atb2-map-grid { grid-template-columns: minmax(240px, 380px) 1fr; align-items: start; }
}

/* ── BODY STAGE ── */
.atb2-body-stage {
    position: relative;
    border: 1px solid var(--atb2-card-border);
    border-radius: var(--atb2-radius);
    background: var(--atb2-card-bg);
    overflow: hidden;
}
.atb2-body-view { display: none; }
.atb2-body-view.is-active { display: block; position: relative; }
.atb2-body-view svg, .atb2-body-view img {
    display: block;
    width: 100%;
    height: auto;
    max-height: 520px;
    object-fit: contain;
}

/* ── HOTSPOT ── */
.atb2-hotspot {
    position: absolute;
    transform: translate(-50%, -50%);
    display: grid;
    place-items: center;
    cursor: pointer;
    background: none !important;
    border: none !important;
    padding: 0 !important;
    z-index: 10;
    box-shadow: none !important;
    line-height: 1 !important;
}
.atb2-hotspot__dot {
    width: 28px;
    height: 28px;
    background: rgba(255,255,255,0.92);
    border-radius: 50%;
    border: 2px solid rgba(255,255,255,0.6);
    box-shadow: 0 2px 8px rgba(0,0,0,0.22);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 16px;
    font-weight: 700;
    color: var(--atb2-dark);
    line-height: 1;
    transition: transform 0.15s, box-shadow 0.15s;
    font-family: var(--atb2-font) !important;
    text-transform: none !important;
}
.atb2-hotspot:hover .atb2-hotspot__dot,
.atb2-hotspot.is-active .atb2-hotspot__dot {
    transform: scale(1.15);
    box-shadow: 0 4px 12px rgba(0,0,0,0.28);
}
.atb2-hotspot.has-selections .atb2-hotspot__dot {
    background: var(--atb2-dark);
    color: #fff;
}
.atb2-hotspot__label {
    position: absolute;
    bottom: calc(100% + 4px);
    left: 50%;
    transform: translateX(-50%);
    background: var(--atb2-dark);
    color: #fff;
    font-size: 11px;
    font-family: var(--atb2-font) !important;
    font-weight: 600;
    white-space: nowrap;
    padding: 3px 8px;
    border-radius: 4px;
    pointer-events: none;
    opacity: 0;
    transition: opacity 0.15s;
    text-transform: none !important;
}
.atb2-hotspot:hover .atb2-hotspot__label,
.atb2-hotspot:focus .atb2-hotspot__label { opacity: 1; }
.atb2-hotspot--nav .atb2-hotspot__dot {
    background: rgba(255,255,255,0.75);
    color: var(--atb2-muted);
    width: 24px;
    height: 24px;
    font-size: 12px;
}

/* ── RIGHT PANEL (concern panel + empty state + area buttons) ── */
.atb2-map-right {
    display: flex;
    flex-direction: column;
    gap: 16px;
    min-height: 200px;
}

/* ── CONCERN PANEL ── */
.atb2-concern-panel { display: none; }
.atb2-concern-panel.is-active { display: block; }
.atb2-panel-back {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    background: none !important;
    border: none !important;
    color: var(--atb2-muted) !important;
    font-family: var(--atb2-font) !important;
    font-size: 13px !important;
    font-weight: 500 !important;
    cursor: pointer !important;
    padding: 0 !important;
    margin-bottom: 12px;
    transition: color 0.15s;
    box-shadow: none !important;
    text-transform: none !important;
}
.atb2-panel-back:hover { color: var(--atb2-text) !important; }
.atb2-concern-heading {
    font-size: 18px !important;
    font-weight: 700 !important;
    color: var(--atb2-dark) !important;
    margin: 0 0 14px !important;
}
.atb2-concern-list {
    display: flex;
    flex-direction: column;
    gap: 8px;
    max-height: 360px;
    overflow-y: auto;
    padding-right: 4px;
    margin-bottom: 14px;
}
.atb2-concern-item {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 10px 12px;
    border: 1px solid var(--atb2-card-border);
    border-radius: var(--atb2-radius);
    background: #fff;
    cursor: pointer;
    transition: border-color 0.15s, background 0.15s, transform 0.12s;
}
.atb2-concern-item:hover { border-color: var(--atb2-accent); transform: translateY(-1px); box-shadow: var(--atb2-shadow-md); }
.atb2-concern-item.is-checked { border-color: var(--atb2-accent); background: #fff9f5; }
.atb2-concern-item input[type="checkbox"] {
    width: 18px !important; height: 18px !important; min-width: 18px !important;
    accent-color: var(--atb2-accent);
    cursor: pointer;
    flex-shrink: 0;
}
.atb2-concern-item label {
    font-size: 14px !important;
    font-weight: 500 !important;
    color: var(--atb2-text) !important;
    cursor: pointer;
    flex: 1;
    text-transform: none !important;
}

/* ── EMPTY STATE ── */
.atb2-empty { display: none; }
.atb2-empty.is-active {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    text-align: center;
    padding: 32px 24px 20px;
    min-height: 180px;
}
.atb2-empty__chevron {
    color: var(--atb2-muted);
    margin-bottom: 12px;
    opacity: 0.6;
}
.atb2-empty__title {
    font-size: 17px !important;
    font-weight: 700 !important;
    color: var(--atb2-dark) !important;
    margin-bottom: 8px !important;
}
.atb2-empty__desc {
    font-size: 14px !important;
    color: var(--atb2-muted) !important;
    max-width: 300px;
    line-height: 1.5 !important;
}

/* ── ACCESSIBLE AREA BUTTONS ── */
.atb2-area-btns {
    display: flex;
    flex-wrap: wrap;
    gap: 8px;
    padding-top: 4px;
}
.atb2-area-btns.is-hidden { display: none; }
.atb2-area-btn {
    background: none !important;
    border: 1px solid var(--atb2-card-border) !important;
    border-radius: 999px !important;
    padding: 6px 14px !important;
    font-family: var(--atb2-font) !important;
    font-size: 13px !important;
    font-weight: 600 !important;
    color: var(--atb2-text) !important;
    cursor: pointer !important;
    transition: background 0.15s, border-color 0.15s !important;
    text-transform: none !important;
    box-shadow: none !important;
    line-height: 1.4 !important;
}
.atb2-area-btn:hover { background: #f0ece6 !important; border-color: var(--atb2-muted) !important; }
.atb2-area-btn.has-selections { background: var(--atb2-dark) !important; color: #fff !important; border-color: var(--atb2-dark) !important; }
.atb2-area-btn--nav { color: var(--atb2-muted) !important; font-style: italic; }

/* ── ADD BUTTON ── */
.atb2-add-btn {
    display: block;
    width: 100%;
    padding: 12px 20px !important;
    background: var(--atb2-btn-bg) !important;
    color: #fff !important;
    border: none !important;
    border-radius: var(--atb2-radius) !important;
    font-family: var(--atb2-font) !important;
    font-size: 15px !important;
    font-weight: 700 !important;
    cursor: pointer !important;
    transition: background 0.2s !important;
    text-transform: none !important;
    box-shadow: none !important;
    line-height: 1.4 !important;
}
.atb2-add-btn:hover { background: var(--atb2-accent) !important; }
.atb2-add-btn:disabled { opacity: 0.5; cursor: default !important; }

/* ── SELECTIONS SIDEBAR ── */
.atb2-sel-card { padding: 16px; }
@media (min-width: 1024px) { .atb2-sel-card { position: sticky; top: calc(var(--wp-admin--admin-bar--height, 0px) + 80px); } }
.atb2-sel-header { display: flex; align-items: center; justify-content: space-between; margin-bottom: 12px; }
.atb2-sel-title {
    font-size: 16px !important;
    font-weight: 700 !important;
    color: var(--atb2-dark) !important;
    font-family: var(--atb2-font) !important;
}
.atb2-clear-btn {
    background: none !important;
    border: none !important;
    font-family: var(--atb2-font) !important;
    font-size: 13px !important;
    color: var(--atb2-accent) !important;
    cursor: pointer !important;
    font-weight: 600 !important;
    padding: 0 !important;
    display: none;
    text-transform: none !important;
    box-shadow: none !important;
}
.atb2-clear-btn.is-visible { display: block; }
.atb2-clear-btn:hover { text-decoration: underline; }
.atb2-sel-list { max-height: 45vh; overflow-y: auto; padding-right: 2px; margin-bottom: 12px; }
.atb2-sel-area { margin-bottom: 12px; }
.atb2-sel-area__label {
    font-size: 11px !important;
    font-weight: 700 !important;
    color: var(--atb2-muted) !important;
    text-transform: uppercase !important;
    letter-spacing: 0.06em;
    margin-bottom: 6px;
    font-family: var(--atb2-font) !important;
}
.atb2-sel-concerns { display: flex; flex-direction: column; gap: 6px; }
.atb2-sel-item {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 8px;
    padding: 7px 10px;
    border: 1px solid var(--atb2-card-border);
    border-radius: 6px;
    background: #fff;
    font-size: 13px !important;
    color: var(--atb2-text) !important;
    font-family: var(--atb2-font) !important;
}
.atb2-sel-item__remove {
    background: none !important;
    border: none !important;
    color: var(--atb2-muted) !important;
    cursor: pointer !important;
    font-size: 16px !important;
    padding: 0 2px !important;
    line-height: 1 !important;
    flex-shrink: 0;
    transition: color 0.15s;
    box-shadow: none !important;
}
.atb2-sel-item__remove:hover { color: #c00 !important; }
.atb2-sel-empty { text-align: center; padding: 20px 16px; color: var(--atb2-muted); }
.atb2-sel-empty__title {
    font-size: 14px !important;
    font-weight: 600 !important;
    color: var(--atb2-text) !important;
    margin-bottom: 4px;
    font-family: var(--atb2-font) !important;
}
.atb2-sel-empty p {
    font-size: 13px !important;
    color: var(--atb2-muted) !important;
    margin: 0 !important;
    font-family: var(--atb2-font) !important;
}
.atb2-sel-actions { display: flex; flex-direction: column; gap: 8px; margin-top: 4px; }

/* Finish button — always visible; disabled when no selections */
.atb2-finish-btn {
    display: block;
    width: 100%;
    padding: 13px 20px !important;
    background: var(--atb2-btn-bg) !important;
    color: #fff !important;
    border: none !important;
    border-radius: var(--atb2-radius) !important;
    font-family: var(--atb2-font) !important;
    font-size: 15px !important;
    font-weight: 700 !important;
    cursor: pointer !important;
    transition: background 0.2s !important;
    text-transform: none !important;
    box-shadow: none !important;
    line-height: 1.4 !important;
}
.atb2-finish-btn:hover:not(:disabled) { background: var(--atb2-accent) !important; }
.atb2-finish-btn:disabled {
    background: #b5b0a8 !important;
    cursor: default !important;
    opacity: 1 !important;
}

/* More/Select More button — always visible in sidebar */
.atb2-more-btn {
    display: block;
    width: 100%;
    padding: 11px 20px !important;
    background: transparent !important;
    color: var(--atb2-dark) !important;
    border: 1.5px solid var(--atb2-card-border) !important;
    border-radius: var(--atb2-radius) !important;
    font-family: var(--atb2-font) !important;
    font-size: 14px !important;
    font-weight: 600 !important;
    cursor: pointer !important;
    transition: border-color 0.15s, background 0.15s !important;
    text-transform: none !important;
    box-shadow: none !important;
    line-height: 1.4 !important;
}
.atb2-more-btn:hover { border-color: var(--atb2-muted) !important; background: var(--atb2-page-bg) !important; }

/* ══════════════════════════════════════════════════════════════════
 * FORM SCREEN
 * ══════════════════════════════════════════════════════════════════ */
.atb2-form-screen .atb2-inner { max-width: 680px; }
.atb2-form-header { margin-bottom: 24px; }
.atb2-form-title {
    font-size: 28px !important;
    font-weight: 700 !important;
    color: var(--atb2-dark) !important;
    margin: 0 0 8px !important;
}
.atb2-form-intro {
    font-size: 15px !important;
    color: var(--atb2-muted) !important;
    margin: 0 0 8px !important;
}
.atb2-form-privacy {
    font-size: 13px !important;
    color: var(--atb2-muted) !important;
    margin: 0 0 20px !important;
    font-style: italic;
}
.atb2-form-selections {
    background: var(--atb2-card-bg);
    border: 1px solid var(--atb2-card-border);
    border-radius: var(--atb2-radius);
    padding: 14px 16px;
    margin-bottom: 24px;
}
.atb2-form-selections h3 {
    font-size: 12px !important;
    font-weight: 700 !important;
    color: var(--atb2-muted) !important;
    text-transform: uppercase !important;
    letter-spacing: 0.06em;
    margin: 0 0 10px !important;
}
.atb2-form-sel-tags { display: flex; flex-wrap: wrap; gap: 6px; }
.atb2-form-sel-tag {
    background: #f6f0e4;
    border: 1px solid #c9c0ae;
    border-radius: 999px;
    padding: 3px 12px;
    font-size: 13px !important;
    color: var(--atb2-text) !important;
    font-weight: 500 !important;
    font-family: var(--atb2-font) !important;
}
/* Form field overrides */
.atb2-form-wrap input[type="text"],
.atb2-form-wrap input[type="email"],
.atb2-form-wrap input[type="tel"],
.atb2-form-wrap input[type="number"],
.atb2-form-wrap input[type="url"],
.atb2-form-wrap select,
.atb2-form-wrap textarea {
    display: block !important; width: 100% !important; box-sizing: border-box !important;
    height: 52px !important; padding: 0 16px !important;
    background: #fff !important; border: 1.5px solid var(--atb2-card-border) !important;
    border-radius: var(--atb2-radius) !important; font-size: 15px !important;
    font-family: var(--atb2-font) !important; color: var(--atb2-text) !important;
    box-shadow: none !important; outline: none !important;
    transition: border-color 0.2s !important; -webkit-appearance: none !important;
    text-transform: none !important;
}
.atb2-form-wrap textarea { height: auto !important; min-height: 100px !important; padding: 12px 16px !important; resize: vertical !important; }
.atb2-form-wrap input:focus, .atb2-form-wrap select:focus, .atb2-form-wrap textarea:focus {
    border-color: var(--atb2-accent) !important;
    box-shadow: 0 0 0 3px rgba(161,96,62,0.12) !important;
}
.atb2-form-wrap input[type="checkbox"], .atb2-form-wrap input[type="radio"] {
    width: 18px !important; height: 18px !important; min-width: 0 !important;
    flex-shrink: 0 !important; cursor: pointer !important; accent-color: var(--atb2-accent) !important;
}
.atb2-form-wrap input.wpforms-field-small,
.atb2-form-wrap input.wpforms-field-medium,
.atb2-form-wrap input.wpforms-field-large,
.atb2-form-wrap select.wpforms-field-small,
.atb2-form-wrap select.wpforms-field-medium,
.atb2-form-wrap select.wpforms-field-large,
.atb2-form-wrap textarea.wpforms-field-small,
.atb2-form-wrap textarea.wpforms-field-medium,
.atb2-form-wrap textarea.wpforms-field-large { width: 100% !important; max-width: 100% !important; box-sizing: border-box !important; }
.atb2-form-wrap input[type="submit"], .atb2-form-wrap button[type="submit"],
.atb2-form-wrap .gform_button, .atb2-form-wrap .wpforms-submit {
    display: block !important; width: 100% !important;
    height: 56px !important; padding: 0 24px !important;
    background: var(--atb2-btn-bg) !important; color: #fff !important; border: none !important;
    border-radius: var(--atb2-radius) !important; font-size: 17px !important; font-weight: 700 !important;
    font-family: var(--atb2-font) !important; cursor: pointer !important;
    transition: background 0.2s !important; text-transform: none !important;
}
.atb2-form-wrap input[type="submit"]:hover, .atb2-form-wrap button[type="submit"]:hover,
.atb2-form-wrap .gform_button:hover, .atb2-form-wrap .wpforms-submit:hover { background: var(--atb2-accent) !important; }
.atb2-form-wrap label {
    font-weight: 600 !important; color: var(--atb2-text) !important;
    font-size: 14px !important; margin-bottom: 6px !important;
    display: block !important; text-transform: none !important;
    font-family: var(--atb2-font) !important;
}
.atb2-form-wrap .gform_wrapper, .atb2-form-wrap .gform_body { padding: 0 !important; margin: 0 !important; }
.atb2-form-wrap .wpforms-field { margin-bottom: 18px !important; }

/* Form back link */
.atb2-form-back-link {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    font-size: 14px !important;
    color: var(--atb2-muted) !important;
    text-decoration: none !important;
    font-weight: 500 !important;
    margin-top: 16px;
    cursor: pointer;
    background: none !important;
    border: none !important;
    padding: 0 !important;
    font-family: var(--atb2-font) !important;
    text-transform: none !important;
    box-shadow: none !important;
}
.atb2-form-back-link:hover { color: var(--atb2-text) !important; text-decoration: underline !important; }

/* ── EXIT / GENDER MODAL ── */
.atb2-modal-bg {
    display: none;
    position: fixed; inset: 0; z-index: 9999;
    background: rgba(0,0,0,0.5);
    align-items: center;
    justify-content: center;
}
.atb2-modal-bg.is-open { display: flex; }
.atb2-modal {
    background: var(--atb2-card-bg);
    border-radius: 12px;
    padding: 32px 28px;
    max-width: 440px;
    width: 90%;
    box-shadow: 0 20px 60px rgba(0,0,0,0.25);
}
.atb2-modal h2 {
    font-size: 22px !important;
    font-weight: 700 !important;
    color: var(--atb2-dark) !important;
    margin: 0 0 10px !important;
    text-transform: none !important;
}
.atb2-modal p {
    font-size: 14px !important;
    color: var(--atb2-muted) !important;
    margin: 0 0 24px !important;
    text-transform: none !important;
}
.atb2-modal-btns { display: flex; gap: 10px; flex-direction: column; }
.atb2-modal-confirm {
    padding: 12px !important;
    background: var(--atb2-btn-bg) !important;
    color: #fff !important;
    border: none !important;
    border-radius: var(--atb2-radius) !important;
    font-family: var(--atb2-font) !important;
    font-size: 15px !important;
    font-weight: 600 !important;
    cursor: pointer !important;
    transition: background 0.2s !important;
    text-align: center;
    text-transform: none !important;
    box-shadow: none !important;
}
.atb2-modal-confirm:hover { background: var(--atb2-accent) !important; }
.atb2-modal-cancel {
    padding: 12px !important;
    background: transparent !important;
    color: var(--atb2-text) !important;
    border: 1.5px solid var(--atb2-card-border) !important;
    border-radius: var(--atb2-radius) !important;
    font-family: var(--atb2-font) !important;
    font-size: 15px !important;
    font-weight: 600 !important;
    cursor: pointer !important;
    transition: background 0.15s !important;
    text-transform: none !important;
    box-shadow: none !important;
}
.atb2-modal-cancel:hover { background: #f0ece6 !important; }

/* ── ANIMATION ── */
@keyframes atb2-rise-in { from { opacity: 0; transform: translateY(6px); } to { opacity: 1; transform: translateY(0); } }
.atb2-concern-item { animation: atb2-rise-in 0.18s ease-out both; }

/* ── SCROLLBAR ── */
.atb2-concern-list::-webkit-scrollbar, .atb2-sel-list::-webkit-scrollbar { width: 4px; }
.atb2-concern-list::-webkit-scrollbar-track, .atb2-sel-list::-webkit-scrollbar-track { background: transparent; }
.atb2-concern-list::-webkit-scrollbar-thumb, .atb2-sel-list::-webkit-scrollbar-thumb { background: var(--atb2-card-border); border-radius: 4px; }

/* ── RESPONSIVE ── */
@media (max-width: 600px) {
    .atb2-nav__inner { padding: 0 16px; }
    .atb2-inner, .atb2-intro-inner { padding: 16px 16px 40px; }
    .atb2-controls { flex-direction: column; align-items: flex-start; }
    .atb2-intro-heading { font-size: 26px !important; }
}
</style>

<div class="atb2-wrap" id="atb2-wrap">

  <!-- NAVBAR -->
  <nav class="atb2-nav" role="banner">
    <div class="atb2-nav__inner">
      <div>
        <button class="atb2-nav__back is-hidden" id="atb2-nav-back" type="button">&#8592; Back</button>
      </div>
      <a href="<?php echo $atbm_home_url; ?>" tabindex="-1" aria-label="Home">
        <img class="atb2-nav__logo" src="<?php echo $atbm_logo_src; ?>" alt="">
      </a>
      <div>
        <a href="<?php echo $atbm_home_url; ?>" class="atb2-nav__exit" id="atb2-nav-exit">Exit &#8594;</a>
      </div>
    </div>
  </nav>

  <div class="atb2-page-body">

    <!-- ═══════════════════════════════════════════════════════════════
         INTRO SCREEN (shown first)
         ═══════════════════════════════════════════════════════════ -->
    <div class="atb2-screen is-active" id="atb2-intro">
      <div class="atb2-intro-inner">
        <div class="atb2-intro-grid">

          <!-- Left: content -->
          <div class="atb2-intro-left">
            <p class="atb2-intro-brand"><?php echo esc_html( atb_text( 'intro_name' ) ); ?></p>
            <h1 class="atb2-intro-heading"><?php echo esc_html( atb_text( 'intro_heading' ) ); ?></h1>
            <p class="atb2-intro-subtitle">A private, guided way to share your goals before your visit.</p>
            <div class="atb2-intro-privacy">
              <p><?php echo esc_html( atb_text( 'intro_privacy' ) ); ?></p>
            </div>
            <div class="atb2-intro-steps">
              <div class="atb2-step-card">
                <span class="atb2-step-num">01</span>
                <p><?php echo esc_html( atb_text( 'step_1' ) ); ?></p>
              </div>
              <div class="atb2-step-card">
                <span class="atb2-step-num">02</span>
                <p><?php echo esc_html( atb_text( 'step_2' ) ); ?></p>
              </div>
              <div class="atb2-step-card">
                <span class="atb2-step-num">03</span>
                <p><?php echo esc_html( atb_text( 'step_3' ) ); ?></p>
              </div>
            </div>
            <div class="atb2-intro-actions">
              <button class="atb2-start-btn" id="atb2-start-btn" type="button">
                <?php echo esc_html( atb_text( 'start_btn' ) ); ?>
              </button>
              <a href="<?php echo $atbm_home_url; ?>" class="atb2-visit-link">
                Visit <?php echo esc_html( atb_text( 'intro_name' ) ); ?>
              </a>
            </div>
          </div><!-- /intro-left -->

          <!-- Right: body figure -->
          <div class="atb2-intro-right">
            <div class="atb2-intro-figure-card">
              <?php
              $intro_svg_path = $atbm_svg_dir . $atbm_figures['female-front'];
              if ( file_exists( $intro_svg_path ) ) {
                  // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                  echo file_get_contents( $intro_svg_path );
              }
              ?>
            </div>
          </div><!-- /intro-right -->

        </div><!-- /intro-grid -->
      </div><!-- /intro-inner -->
    </div><!-- /intro screen -->

    <!-- ═══════════════════════════════════════════════════════════════
         BUILDER SCREEN
         ═══════════════════════════════════════════════════════════ -->
    <div class="atb2-screen" id="atb2-builder">
      <div class="atb2-inner">

        <!-- Controls: gender + view toggles -->
        <div class="atb2-controls">
          <div class="atb2-seg" role="group" aria-label="Select gender">
            <button class="atb2-seg__btn is-active" type="button" data-atb2-gender="female">Female</button>
            <button class="atb2-seg__btn" type="button" data-atb2-gender="male">Male</button>
          </div>
          <div class="atb2-seg" role="group" aria-label="Select view">
            <button class="atb2-seg__btn is-active" type="button" data-atb2-view="front">Full Body</button>
            <button class="atb2-seg__btn" type="button" data-atb2-view="back">Back</button>
            <button class="atb2-seg__btn" type="button" data-atb2-view="face">Face &amp; Neck</button>
          </div>
        </div>

        <!-- Main grid -->
        <div class="atb2-grid">

          <!-- Left: map card -->
          <div>
            <div class="atb2-card atb2-map-card">
              <div class="atb2-map-grid">

                <!-- Body stage (SVG + hotspots) -->
                <div class="atb2-body-stage" id="atb2-body-stage">
                  <?php
                  foreach ( $atbm_figures as $view_key => $svg_file ) :
                      $is_active = ( 'female-front' === $view_key );
                      $svg_path  = $atbm_svg_dir . $svg_file;
                      $hs_list   = $atbm_hotspots[ $view_key ] ?? [];
                  ?>
                  <div class="atb2-body-view<?php echo $is_active ? ' is-active' : ''; ?>" data-view="<?php echo esc_attr( $view_key ); ?>">
                    <?php
                    if ( file_exists( $svg_path ) ) {
                        // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                        echo file_get_contents( $svg_path );
                    }
                    foreach ( $hs_list as $hs ) :
                        $hs_is_nav    = isset( $hs['nav'] );
                        $hs_nav_attr  = $hs_is_nav ? ' data-atb2-nav-view="' . esc_attr( $hs['nav'] ) . '"' : '';
                        $hs_area_attr = ! $hs_is_nav ? ' data-atb2-area-id="' . esc_attr( $hs['id'] ) . '"' : '';
                    ?>
                    <button class="atb2-hotspot<?php echo $hs_is_nav ? ' atb2-hotspot--nav' : ''; ?>"
                            type="button"
                            style="top:<?php echo esc_attr( $hs['top'] ); ?>%;left:<?php echo esc_attr( $hs['left'] ); ?>%"
                            <?php echo $hs_area_attr . $hs_nav_attr; // phpcs:ignore ?>
                            aria-label="<?php echo esc_attr( $hs['label'] ); ?> concerns">
                      <span class="atb2-hotspot__dot">+</span>
                      <span class="atb2-hotspot__label"><?php echo esc_html( $hs['label'] ); ?></span>
                    </button>
                    <?php endforeach; ?>
                  </div>
                  <?php endforeach; ?>
                </div><!-- /body-stage -->

                <!-- Right side: empty state OR concern panel + area buttons -->
                <div class="atb2-map-right">

                  <!-- Empty state -->
                  <div class="atb2-empty is-active" id="atb2-empty">
                    <div class="atb2-empty__chevron">
                      <svg width="22" height="14" viewBox="0 0 22 14" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                        <path d="M1 1L11 12L21 1" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"/>
                      </svg>
                    </div>
                    <div class="atb2-empty__title">Choose a body area</div>
                    <div class="atb2-empty__desc">Use the map or the accessible list below to view concern checklists.</div>
                  </div>

                  <!-- Concern panel (shown when area is selected) -->
                  <div class="atb2-concern-panel" id="atb2-concern-panel">
                    <button class="atb2-panel-back" id="atb2-panel-back" type="button">&#8592; Choose a body area</button>
                    <h2 class="atb2-concern-heading" id="atb2-concern-heading">Concerns</h2>
                    <div class="atb2-concern-list" id="atb2-concern-list"></div>
                    <button class="atb2-add-btn" id="atb2-add-btn" type="button" disabled>
                      <?php echo esc_html( atb_text( 'more_btn' ) ); ?> (0)
                    </button>
                  </div>

                  <!-- Accessible area buttons (inside right panel) -->
                  <div class="atb2-area-btns" id="atb2-area-btns" role="group" aria-label="Select a body area"></div>

                </div><!-- /map-right -->

              </div><!-- /map-grid -->
            </div><!-- /map-card -->
          </div><!-- /left col -->

          <!-- Right: Selections sidebar -->
          <aside>
            <div class="atb2-card atb2-sel-card">
              <div class="atb2-sel-header">
                <span class="atb2-sel-title"><?php echo esc_html( atb_text( 'selections_heading' ) ); ?> (<span id="atb2-sel-count">0</span>)</span>
                <button class="atb2-clear-btn" id="atb2-clear-all" type="button"><?php echo esc_html( atb_text( 'clear_btn' ) ); ?></button>
              </div>
              <div class="atb2-sel-list" id="atb2-sel-list">
                <div class="atb2-sel-empty" id="atb2-sel-empty">
                  <div class="atb2-sel-empty__title"><?php echo esc_html( atb_text( 'empty_state' ) ); ?></div>
                  <p><?php echo esc_html( atb_text( 'empty_instructions' ) ); ?></p>
                </div>
              </div>
              <div class="atb2-sel-actions">
                <button class="atb2-finish-btn" id="atb2-finish-btn" type="button" disabled>
                  <?php echo esc_html( atb_text( 'finish_btn' ) ); ?>
                </button>
                <button class="atb2-more-btn" id="atb2-more-btn" type="button">
                  <?php echo esc_html( atb_text( 'more_btn' ) ); ?>
                </button>
              </div>
            </div>
          </aside><!-- /sidebar -->

        </div><!-- /grid -->
      </div><!-- /inner -->
    </div><!-- /builder screen -->

    <!-- ═══════════════════════════════════════════════════════════════
         FORM SCREEN
         ═══════════════════════════════════════════════════════════ -->
    <div class="atb2-screen atb2-form-screen" id="atb2-form-screen">
      <div class="atb2-inner">
        <div class="atb2-form-header">
          <h1 class="atb2-form-title"><?php echo esc_html( atb_text( 'form_heading' ) ); ?></h1>
          <p class="atb2-form-intro"><?php echo esc_html( atb_text( 'form_intro' ) ); ?></p>
          <p class="atb2-form-privacy"><?php echo esc_html( atb_text( 'form_privacy' ) ); ?></p>
        </div>
        <div class="atb2-form-selections">
          <h3><?php echo esc_html( atb_text( 'selections_heading' ) ); ?></h3>
          <div class="atb2-form-sel-tags" id="atb2-form-sel-tags"></div>
        </div>
        <div class="atb2-form-wrap" id="atb2-form-wrap">
          <?php
          if ( 'wpforms' === $atbm_form_plugin ) :
              if ( atb_wpf_active() && $atbm_wpf_id > 0 ) :
                  echo do_shortcode( '[wpforms id="' . $atbm_wpf_id . '"]' );
              else : ?>
                  <p style="color:#c00;padding:16px;background:#fff3f3;border-radius:8px;border:1px solid #fcc;">
                    No WPForms form configured. Go to <a href="<?php echo esc_url( admin_url( 'admin.php?page=alpine-treatment-builder' ) ); ?>">Treatment Builder &rarr; Settings</a>.
                  </p>
              <?php endif;
          else : // gravity_forms
              if ( atb_gf_active() && $atbm_gf_id > 0 ) :
                  gravity_form( $atbm_gf_id, false, false, false, null, true, 1, true );
              else : ?>
                  <p style="color:#c00;padding:16px;background:#fff3f3;border-radius:8px;border:1px solid #fcc;">
                    No Gravity Form configured. Go to <a href="<?php echo esc_url( admin_url( 'admin.php?page=alpine-treatment-builder' ) ); ?>">Treatment Builder &rarr; Settings</a>.
                  </p>
              <?php endif;
          endif; ?>
        </div>
        <button class="atb2-form-back-link" id="atb2-form-back-btn" type="button">
          &#8592; <?php echo esc_html( atb_text( 'more_btn' ) ); ?>
        </button>
      </div>
    </div><!-- /form screen -->

  </div><!-- /page-body -->

</div><!-- /atb2-wrap -->

<!-- EXIT MODAL -->
<div class="atb2-modal-bg" id="atb2-exit-modal" role="dialog" aria-modal="true" aria-labelledby="atb2-exit-title">
  <div class="atb2-modal">
    <h2 id="atb2-exit-title"><?php echo esc_html( atb_text( 'exit_heading' ) ); ?></h2>
    <p><?php echo esc_html( atb_text( 'exit_body' ) ); ?></p>
    <div class="atb2-modal-btns">
      <button class="atb2-modal-confirm" id="atb2-exit-confirm" type="button"><?php echo esc_html( atb_text( 'exit_confirm' ) ); ?></button>
      <button class="atb2-modal-cancel" id="atb2-exit-cancel" type="button"><?php echo esc_html( atb_text( 'exit_cancel' ) ); ?></button>
    </div>
  </div>
</div>

<!-- GENDER SWITCH MODAL -->
<div class="atb2-modal-bg" id="atb2-switch-modal" role="dialog" aria-modal="true" aria-labelledby="atb2-switch-title">
  <div class="atb2-modal">
    <h2 id="atb2-switch-title"><?php echo esc_html( atb_text( 'switch_heading' ) ); ?></h2>
    <p><?php echo esc_html( atb_text( 'switch_body' ) ); ?></p>
    <div class="atb2-modal-btns">
      <button class="atb2-modal-confirm" id="atb2-switch-confirm" type="button"><?php echo esc_html( atb_text( 'switch_confirm' ) ); ?></button>
      <button class="atb2-modal-cancel" id="atb2-switch-cancel" type="button"><?php echo esc_html( atb_text( 'switch_cancel' ) ); ?></button>
    </div>
  </div>
</div>

<script>
(function(){
'use strict';

/* ── DATA ── */
var AREAS        = <?php echo wp_json_encode( $atbm_js_areas ); ?>;
var RESULTS_URL  = <?php echo wp_json_encode( $atbm_results_url ); ?>;
var FORM_PLUGIN  = <?php echo wp_json_encode( $atbm_form_plugin ); ?>;
var HOME_URL     = <?php echo wp_json_encode( $atbm_home_url ); ?>;
var ADD_BTN_TEXT = <?php echo wp_json_encode( atb_text( 'more_btn' ) ); ?>;

/* ── STATE ── */
var state = {
    gender: 'female',
    view:   'front',
    activeAreaId:  null,
    pendingGender: null,
    currentScreen: 'intro', // 'intro' | 'builder' | 'form'
    selections: {},  // { areaId: { label: '', concerns: [{id, label}] } }
};

/* ── HELPERS ── */
function totalCount() {
    var n = 0;
    Object.values(state.selections).forEach(function(a){ n += a.concerns.length; });
    return n;
}

function getAreasForView() {
    var g = state.gender, v = state.view;
    return Object.values(AREAS).filter(function(a){ return a.gender === g && a.view === v; });
}

function getArea(id) { return AREAS[id] || null; }

/* ── DOM ── */
var $ = function(sel){ return document.querySelector(sel); };

var elBodies       = document.querySelectorAll('.atb2-body-view');
var elEmpty        = $('#atb2-empty');
var elPanel        = $('#atb2-concern-panel');
var elPanelBack    = $('#atb2-panel-back');
var elHeading      = $('#atb2-concern-heading');
var elList         = $('#atb2-concern-list');
var elAddBtn       = $('#atb2-add-btn');
var elAreaBtns     = $('#atb2-area-btns');
var elSelList      = $('#atb2-sel-list');
var elSelEmpty     = $('#atb2-sel-empty');
var elSelCount     = $('#atb2-sel-count');
var elClearBtn     = $('#atb2-clear-all');
var elFinishBtn    = $('#atb2-finish-btn');
var elMoreBtn      = $('#atb2-more-btn');
var elFormBackBtn  = $('#atb2-form-back-btn');
var elNavBack      = $('#atb2-nav-back');
var elIntro        = $('#atb2-intro');
var elBuilder      = $('#atb2-builder');
var elFormScreen   = $('#atb2-form-screen');
var elFormTags     = $('#atb2-form-sel-tags');

/* ── SCREEN NAVIGATION ── */
function showScreen(name) {
    state.currentScreen = name;
    elIntro.classList.toggle('is-active', name === 'intro');
    elBuilder.classList.toggle('is-active', name === 'builder');
    elFormScreen.classList.toggle('is-active', name === 'form');
    // Nav back button: hidden on intro, visible on builder/form
    elNavBack.classList.toggle('is-hidden', name === 'intro');
}

/* ── BODY VIEW SWITCH ── */
function showView(gender, view) {
    var key = gender + '-' + view;
    elBodies.forEach(function(el){ el.classList.toggle('is-active', el.dataset.view === key); });
    renderAreaBtns();
}

/* ── AREA BUTTONS (accessible list) ── */
function renderAreaBtns() {
    var areas = getAreasForView();
    var isPanelOpen = elPanel.classList.contains('is-active');

    elAreaBtns.innerHTML = '';
    elAreaBtns.classList.toggle('is-hidden', isPanelOpen);

    if (state.view !== 'face') {
        var navBtn = document.createElement('button');
        navBtn.className = 'atb2-area-btn atb2-area-btn--nav';
        navBtn.type = 'button';
        navBtn.textContent = 'Head & Face';
        navBtn.addEventListener('click', function(){ switchView(state.gender, 'face'); });
        elAreaBtns.appendChild(navBtn);
    }
    areas.forEach(function(area) {
        var btn = document.createElement('button');
        btn.className = 'atb2-area-btn';
        btn.type = 'button';
        btn.textContent = area.label;
        btn.dataset.areaId = area.id;
        if (state.selections[area.id] && state.selections[area.id].concerns.length > 0) {
            btn.classList.add('has-selections');
        }
        btn.addEventListener('click', function(){ openArea(area.id); });
        elAreaBtns.appendChild(btn);
    });
}

/* ── OPEN AREA ── */
function openArea(areaId) {
    var area = getArea(areaId);
    if (!area) return;
    state.activeAreaId = areaId;
    elEmpty.classList.remove('is-active');
    elPanel.classList.add('is-active');
    elAreaBtns.classList.add('is-hidden');
    elHeading.textContent = area.header;
    renderConcernList(area);
    updateAddBtn();
    if (area.view !== state.view) {
        switchView(state.gender, area.view);
    }
}

/* ── RENDER CONCERN LIST ── */
function renderConcernList(area) {
    elList.innerHTML = '';
    var selected    = (state.selections[area.id] || {}).concerns || [];
    var selectedIds = selected.map(function(c){ return c.id; });

    area.concerns.forEach(function(c, i) {
        var item = document.createElement('div');
        item.className = 'atb2-concern-item';
        item.style.animationDelay = (i * 0.02) + 's';
        var checked = selectedIds.indexOf(c.id) !== -1;
        if (checked) item.classList.add('is-checked');

        var cb = document.createElement('input');
        cb.type = 'checkbox';
        cb.id = 'atb2-cb-' + c.id;
        cb.checked = checked;
        cb.dataset.concernId = c.id;
        cb.dataset.concernLabel = c.label;

        var lbl = document.createElement('label');
        lbl.htmlFor = 'atb2-cb-' + c.id;
        lbl.textContent = c.label;

        item.appendChild(cb);
        item.appendChild(lbl);

        item.addEventListener('click', function(e) {
            if (e.target === cb) return;
            cb.checked = !cb.checked;
            item.classList.toggle('is-checked', cb.checked);
            updateAddBtn();
        });
        cb.addEventListener('change', function() {
            item.classList.toggle('is-checked', cb.checked);
            updateAddBtn();
        });

        elList.appendChild(item);
    });
}

/* ── UPDATE ADD BUTTON ── */
function updateAddBtn() {
    var checked = elList.querySelectorAll('input[type="checkbox"]:checked').length;
    elAddBtn.textContent = ADD_BTN_TEXT + ' (' + checked + ')';
    elAddBtn.disabled = (checked === 0);
}

/* ── ADD TO PLAN ── */
elAddBtn.addEventListener('click', function() {
    if (!state.activeAreaId) return;
    var area = getArea(state.activeAreaId);
    if (!area) return;
    var checked = elList.querySelectorAll('input[type="checkbox"]:checked');
    var concerns = [];
    checked.forEach(function(cb) {
        concerns.push({ id: cb.dataset.concernId, label: cb.dataset.concernLabel });
    });
    if (concerns.length === 0) return;
    state.selections[state.activeAreaId] = { label: area.label, concerns: concerns };
    closePanel();
    renderSelections();
});

/* ── CLOSE PANEL ── */
function closePanel() {
    state.activeAreaId = null;
    elPanel.classList.remove('is-active');
    elEmpty.classList.add('is-active');
    renderAreaBtns();
}

elPanelBack.addEventListener('click', closePanel);

/* ── RENDER SELECTIONS ── */
function renderSelections() {
    var total = totalCount();
    elSelCount.textContent = total;
    elClearBtn.classList.toggle('is-visible', total > 0);
    // Enable/disable Finish button
    elFinishBtn.disabled = (total === 0);

    elSelList.querySelectorAll('.atb2-sel-area').forEach(function(el){ el.remove(); });

    if (total === 0) {
        elSelEmpty.style.display = '';
        return;
    }
    elSelEmpty.style.display = 'none';

    Object.values(state.selections).forEach(function(areaData) {
        if (areaData.concerns.length === 0) return;
        var group = document.createElement('div');
        group.className = 'atb2-sel-area';
        var heading = document.createElement('div');
        heading.className = 'atb2-sel-area__label';
        heading.textContent = areaData.label;
        group.appendChild(heading);
        var concerns = document.createElement('div');
        concerns.className = 'atb2-sel-concerns';
        areaData.concerns.forEach(function(c) {
            var item = document.createElement('div');
            item.className = 'atb2-sel-item';
            var name = document.createElement('span');
            name.textContent = c.label;
            var removeBtn = document.createElement('button');
            removeBtn.className = 'atb2-sel-item__remove';
            removeBtn.type = 'button';
            removeBtn.innerHTML = '&times;';
            removeBtn.setAttribute('aria-label', 'Remove ' + c.label);
            removeBtn.addEventListener('click', function() {
                removeConcern(areaData, c.id);
            });
            item.appendChild(name);
            item.appendChild(removeBtn);
            concerns.appendChild(item);
        });
        group.appendChild(concerns);
        elSelList.appendChild(group);
    });

    updateHotspots();
}

function removeConcern(areaData, concernId) {
    Object.keys(state.selections).forEach(function(aId) {
        if (state.selections[aId].label === areaData.label) {
            state.selections[aId].concerns = state.selections[aId].concerns.filter(function(c){ return c.id !== concernId; });
            if (state.selections[aId].concerns.length === 0) delete state.selections[aId];
        }
    });
    renderSelections();
    renderAreaBtns();
    if (state.activeAreaId && getArea(state.activeAreaId) && getArea(state.activeAreaId).label === areaData.label) {
        openArea(state.activeAreaId);
    }
}

/* ── UPDATE HOTSPOT STATES ── */
function updateHotspots() {
    document.querySelectorAll('.atb2-hotspot[data-atb2-area-id]').forEach(function(btn) {
        var id = parseInt(btn.dataset.atb2AreaId, 10);
        var has = state.selections[id] && state.selections[id].concerns.length > 0;
        btn.classList.toggle('has-selections', has);
    });
}

/* ── CLEAR ALL ── */
elClearBtn.addEventListener('click', function() {
    state.selections = {};
    renderSelections();
    renderAreaBtns();
    if (elPanel.classList.contains('is-active')) closePanel();
});

/* ── GENDER SWITCH ── */
document.querySelectorAll('[data-atb2-gender]').forEach(function(btn) {
    btn.addEventListener('click', function() {
        var g = btn.dataset.atb2Gender;
        if (g === state.gender) return;
        if (totalCount() > 0) {
            state.pendingGender = g;
            $('#atb2-switch-modal').classList.add('is-open');
        } else {
            applyGender(g);
        }
    });
});

function applyGender(g) {
    state.gender = g;
    document.querySelectorAll('[data-atb2-gender]').forEach(function(b){ b.classList.toggle('is-active', b.dataset.atb2Gender === g); });
    if (elPanel.classList.contains('is-active')) closePanel();
    showView(state.gender, state.view);
}

$('#atb2-switch-confirm').addEventListener('click', function() {
    state.selections = {};
    renderSelections();
    $('#atb2-switch-modal').classList.remove('is-open');
    applyGender(state.pendingGender);
    state.pendingGender = null;
});
$('#atb2-switch-cancel').addEventListener('click', function() {
    state.pendingGender = null;
    $('#atb2-switch-modal').classList.remove('is-open');
});

/* ── VIEW SWITCH ── */
document.querySelectorAll('[data-atb2-view]').forEach(function(btn) {
    btn.addEventListener('click', function() {
        switchView(state.gender, btn.dataset.atb2View);
    });
});

function switchView(gender, view) {
    state.view = view;
    document.querySelectorAll('[data-atb2-view]').forEach(function(b){ b.classList.toggle('is-active', b.dataset.atb2View === view); });
    if (elPanel.classList.contains('is-active')) closePanel();
    showView(gender, view);
}

/* ── HOTSPOT CLICKS ── */
document.querySelectorAll('.atb2-hotspot[data-atb2-area-id]').forEach(function(btn) {
    btn.addEventListener('click', function() {
        openArea(parseInt(btn.dataset.atb2AreaId, 10));
    });
});
document.querySelectorAll('.atb2-hotspot[data-atb2-nav-view]').forEach(function(btn) {
    btn.addEventListener('click', function() {
        switchView(state.gender, btn.dataset.atb2NavView);
    });
});

/* ── INTRO → BUILDER ── */
$('#atb2-start-btn').addEventListener('click', function() {
    showScreen('builder');
});

/* ── FINISH PLAN ── */
elFinishBtn.addEventListener('click', function() {
    if (totalCount() > 0) showFormScreen();
});

function showFormScreen() {
    showScreen('form');

    // Populate concern tags
    elFormTags.innerHTML = '';
    Object.values(state.selections).forEach(function(area) {
        area.concerns.forEach(function(c) {
            var tag = document.createElement('span');
            tag.className = 'atb2-form-sel-tag';
            tag.textContent = c.label;
            elFormTags.appendChild(tag);
        });
    });

    // Build concern IDs array and concerns object
    var concernIds = [];
    var concernsObj = {};
    Object.values(state.selections).forEach(function(area) {
        area.concerns.forEach(function(c) {
            concernIds.push(c.id);
            concernsObj[c.id] = 1;
        });
    });

    // Store for WPForms redirect handler
    try { sessionStorage.setItem('atb_pending_concerns', JSON.stringify(concernIds)); } catch(ex) {}

    // Inject concerns into Gravity Forms hidden field
    var concernsJson = JSON.stringify(concernsObj);
    var gfHidden = document.querySelector('.atb2-form-wrap .gfield.atb-concerns input[type="hidden"]');
    if (gfHidden) gfHidden.value = concernsJson;
    document.querySelectorAll('.atb2-form-wrap input.atb-concerns').forEach(function(el){ el.value = concernsJson; });
}

/* ── SELECT MORE (sidebar) ── */
elMoreBtn.addEventListener('click', function() {
    // Scroll to body stage so user can interact with the map
    var stage = $('#atb2-body-stage');
    if (stage) stage.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
});

/* ── FORM BACK ── */
elFormBackBtn.addEventListener('click', function() {
    showScreen('builder');
});

/* ── NAV BACK ── */
elNavBack.addEventListener('click', function() {
    if (state.currentScreen === 'form') {
        showScreen('builder');
    } else if (state.currentScreen === 'builder') {
        if (elPanel.classList.contains('is-active')) {
            closePanel();
        } else {
            showScreen('intro');
        }
    } else {
        window.history.back();
    }
});

/* ── EXIT ── */
$('#atb2-nav-exit').addEventListener('click', function(e) {
    if (totalCount() > 0) {
        e.preventDefault();
        $('#atb2-exit-modal').classList.add('is-open');
    }
});
$('#atb2-exit-confirm').addEventListener('click', function() {
    window.location.href = HOME_URL;
});
$('#atb2-exit-cancel').addEventListener('click', function() {
    $('#atb2-exit-modal').classList.remove('is-open');
});

/* ── MODAL BACKDROP CLOSE ── */
document.querySelectorAll('.atb2-modal-bg').forEach(function(bg) {
    bg.addEventListener('click', function(e) {
        if (e.target === bg) bg.classList.remove('is-open');
    });
});

/* ── BODY CLASS (hide theme chrome) ── */
<?php if ( ! $atbm_use_chrome ) : ?>
document.body.classList.add('atb2-page');
<?php endif; ?>

/* ── INIT ── */
showScreen('intro');
renderAreaBtns();
renderSelections();

})();
</script>

<?php if ( 'wpforms' === $atbm_form_plugin && $atbm_results_url ) : ?>
<script>
/* WPForms redirect handler for modern template (atb-script not loaded in modern mode) */
jQuery(function($) {
    var resultsUrl = <?php echo wp_json_encode( $atbm_results_url ); ?>;
    if (!resultsUrl) return;

    function atbGetFirstName() {
        var $native = $('.wpforms-form .wpforms-field-name-first input');
        if ($native.length && $native.val().trim()) return $native.val().trim().split(' ')[0];
        var $auto = $('.wpforms-form input[autocomplete="given-name"]');
        if ($auto.length && $auto.val().trim()) return $auto.val().trim().split(' ')[0];
        var fname = '';
        $('.wpforms-form .wpforms-field').each(function() {
            var label = $(this).find('label').first().text().trim().toLowerCase();
            if (label.indexOf('first') !== -1) {
                var val = $(this).find('input[type="text"]').first().val().trim();
                if (val) { fname = val.split(' ')[0]; return false; }
            }
        });
        if (fname) return fname;
        var $first = $('.wpforms-form input[type="text"]').first();
        return $first.length ? ($first.val().trim().split(' ')[0] || '') : '';
    }

    $(document).on('input change', '.wpforms-form input[type="text"]', function() {
        var $field = $(this).closest('.wpforms-field');
        var label  = $field.find('label').first().text().trim().toLowerCase();
        var isFirst = label.indexOf('first') !== -1 || $('.wpforms-form input[type="text"]').first().is(this);
        if (isFirst) {
            var fname = $(this).val().trim().split(' ')[0] || '';
            try { sessionStorage.setItem('atb_pending_username', fname); } catch(ex) {}
        }
    });

    function handleSuccess(e, res) {
        if (res && (!res.success || (res.data && (res.data.errors || res.data.is_error)))) return;
        var concerns = [];
        try { concerns = JSON.parse(sessionStorage.getItem('atb_pending_concerns') || '[]'); } catch(ex) {}
        var username = atbGetFirstName() || sessionStorage.getItem('atb_pending_username') || 'You';
        sessionStorage.removeItem('atb_pending_concerns');
        sessionStorage.removeItem('atb_pending_username');
        if (!concerns.length) return;
        var sep = resultsUrl.indexOf('?') !== -1 ? '&' : '?';
        var url = resultsUrl + sep
            + 'concerns=' + encodeURIComponent(JSON.stringify(concerns))
            + '&username=' + encodeURIComponent(username);
        setTimeout(function() { window.location.href = url; }, 300);
    }

    $(document).on('wpformsAjaxSubmitSuccess',  handleSuccess);
    $(document).on('wpformsAjaxRequestSuccess', handleSuccess);
});
</script>
<?php endif; ?>
