<?php
defined( 'ABSPATH' ) || exit;

/* -----------------------------------------------------------------------
 * Data: concern panels (term_id → label, header, concerns[id => label])
 * --------------------------------------------------------------------- */
$atb_concerns = atb_concerns_map();

/* -----------------------------------------------------------------------
 * Hotspot button positions per figure view
 * --------------------------------------------------------------------- */
$atb_hotspots = atb_get_hotspots();

/* -----------------------------------------------------------------------
 * Helper: render one hotspot button
 * --------------------------------------------------------------------- */
function atb_hotspot( $btn, $extra_class = '' ) {
	$id    = (int) $btn['id'];
	$label = esc_html( $btn['label'] );
	$style = esc_attr( $btn['style'] );
	$cls   = isset( $btn['class'] ) ? ' ' . esc_attr( $btn['class'] ) : '';
	if ( $extra_class ) {
		$cls .= ' ' . esc_attr( $extra_class );
	}
	echo <<<HTML
<div class="llvc__concern-area{$cls}" data-ll-tooltip style="{$style}">
  <div role="tooltip" class="llvc__concern-area__title" id="label-{$id}">
    <span class="visually-hidden">Select </span>{$label}<span class="visually-hidden"> concerns</span>
  </div>
  <button type="button" class="llvc__concern-area__circle"
    id="concern-btn-{$id}"
    data-ll-tooltip-trigger
    data-term-id="{$id}"
    aria-labelledby="label-{$id}">
    <svg class="icon icon-llvc-add" aria-hidden="true"><use xlink:href="#icon-llvc-add"></use></svg>
  </button>
</div>
HTML;
}

$home_url   = esc_url( home_url() );
$svg_dir    = ATB_PATH . 'public/svg/';
$logo_src   = atb_get_logo_url(); // plugin setting → theme custom_logo → bundled fallback
?>

<div class="llvc llvc--concerns">

  <?php /* ---- Icon Sprite ---- */ ?>
  <?php echo file_get_contents( $svg_dir . 'icon-sprite.svg' ); // phpcs:ignore ?>

  <div class="visually-hidden llvc__alert" aria-live="polite"></div>

  <?php /* ============================================================
   * NAVBAR
   * ========================================================== */ ?>
  <header class="llvc-navbar" role="banner">
    <div class="container">
      <div class="llvc-navbar__flex">
        <div class="llvc-navbar__spacer-col">
          <button class="llvc-navbar__back">
            <svg class="icon icon-llvc-left-arrow"><use xlink:href="#icon-llvc-left-arrow"></use></svg>Back
          </button>
        </div>
        <a class="llvc-navbar__logo-link" href="<?php echo $home_url; ?>">
          <img class="llvc-navbar__logo" src="<?php echo $logo_src; ?>" alt="Alpine Wellness">
        </a>
        <div class="llvc-navbar__exit-col">
          <a href="<?php echo $home_url; ?>" class="llvc-navbar__exit">
            Exit<svg class="icon icon-llvc-exit"><use xlink:href="#icon-llvc-exit"></use></svg>
          </a>
        </div>
      </div>
    </div>
  </header>

  <?php /* ============================================================
   * STEP 1 — INTRO
   * ========================================================== */ ?>
  <div class="llvc__intro is-active llvc__step" data-step="vc-1">
    <div class="llvc__columns">
      <div class="llvc__content-column">
        <div class="llvc__content">
          <div class="llvc__intro__main">
            <div class="llvc__heading--lg"><h2><?php echo esc_html( atb_text( 'intro_heading' ) ); ?></h2></div>

            <div class="llvc__intro__profile-image">
              <div class="llvc-fit-image object-cover object-center">
                <img width="1000" height="667"
                     src="<?php echo esc_url( ATB_URL . 'public/images/1M6A8643.jpg' ); ?>"
                     class="object-cover object-center"
                     alt="" decoding="async">
              </div>
            </div>

            <p class="llvc__intro__profile-name"><?php echo esc_html( atb_text( 'intro_name' ) ); ?></p>
            <p><?php echo esc_html( atb_text( 'intro_privacy' ) ); ?></p>
          </div>
          <ol>
            <li><?php echo esc_html( atb_text( 'step_1' ) ); ?></li>
            <li><?php echo esc_html( atb_text( 'step_2' ) ); ?></li>
            <li><?php echo esc_html( atb_text( 'step_3' ) ); ?></li>
          </ol>
          <p class="llvc__mobile-start">
            <button class="llvc__mobile-start-button llvc__button llvc__start-btn" type="button"><?php echo esc_html( atb_text( 'start_btn' ) ); ?></button>
          </p>
        </div>
      </div>
      <div class="llvc__start-column">
        <button class="llvc__start llvc__start-btn" type="button">
          <span class="llvc__start-icon-wrapper">
            <svg class="icon icon-llvc-cursor" aria-hidden="true"><use xlink:href="#icon-llvc-cursor"></use></svg>
          </span>
          <span class="llvc__start-text"><?php echo esc_html( atb_text( 'start_icon' ) ); ?></span>
        </button>
      </div>
    </div>
  </div><!-- /intro -->

  <?php /* ============================================================
   * STEP 2 — MAIN CONSULTATION
   * ========================================================== */ ?>
  <div class="llvc__concerns llvc__screen llvc__step" data-step="vc-2" inert>
    <div class="llvc__container">
      <div class="llvc__columns">

        <?php /* ---- Body Column (left) ---- */ ?>
        <div class="llvc__body-column">

          <ul class="llvc__body__nav">
            <li class="llvc__how-to-use__wrapper">
              <div class="llvc__how-to-use"
                data-ll-modal
                data-ll-modal-outside="true"
                data-ll-modal-trigger=".llvc__how-to-use__toggle"
                data-ll-modal-escape=".llvc__how-to-use__close">
                <button class="llvc__how-to-use__close">
                  <svg class="icon icon-llvc-cancel"><use xlink:href="#icon-llvc-cancel"></use></svg>
                </button>
                <h2 class="llvc__how-to-use__header">How to Use</h2>
                <ol>
                  <li><?php echo esc_html( atb_text( 'step_1' ) ); ?></li>
                  <li><?php echo esc_html( atb_text( 'step_2' ) ); ?></li>
                  <li><?php echo esc_html( atb_text( 'step_3' ) ); ?></li>
                </ol>
              </div>
              <button class="llvc__how-to-use__toggle">
                <svg class="icon icon-llvc-info" aria-hidden="true"><use xlink:href="#icon-llvc-info"></use></svg>
                How to Use
              </button>
            </li>
            <li>
              <button class="relative llvc__gender-choice">
                <svg class="icon icon-llvc-male" aria-hidden="true"><use xlink:href="#icon-llvc-male"></use></svg>
                <svg class="icon icon-llvc-female"><use xlink:href="#icon-llvc-female"></use></svg>
                <span class="llvc__gender-choice-text">Switch to Male</span>
              </button>
            </li>
          </ul>

          <!-- Gradient definition for body outline stroke -->
          <svg class="absolute invisible llvc__body-outline-svg" aria-hidden="true" version="1.1" xmlns="http://www.w3.org/2000/svg">
            <defs>
              <linearGradient id="llvc-body-outline-gradient" x1="0" x2="0" y1="0" y2="1">
                <stop offset="0%" stop-color="var(--llvcBodyOutlineGradientTop, #21403e)"></stop>
                <stop offset="100%" stop-color="var(--llvcBodyOutlineGradientBottom, #21403e)"></stop>
              </linearGradient>
            </defs>
          </svg>

          <!-- Turn (flip front/back) buttons — female -->
          <button class="llvc__turn llvc__turn-female llvc__turn--left is-active">
            <svg class="icon icon-llvc-turn-left" aria-hidden="true"><use xlink:href="#icon-llvc-turn-left"></use></svg>
            <span class="llvc__turn-text visually-hidden">View back concern areas</span>
          </button>
          <!-- Turn buttons — male -->
          <button class="llvc__turn llvc__turn-male llvc__turn--left">
            <svg class="icon icon-llvc-turn-left" aria-hidden="true"><use xlink:href="#icon-llvc-turn-left"></use></svg>
            <span class="llvc__turn-text visually-hidden">View back concern areas</span>
          </button>

          <?php /* =========== FEMALE BODY =========== */ ?>
          <div class="llvc__body llvc__body--female is-active">

            <!-- Face toggle -->
            <button class="llvc__face-toggle llvc__face-toggle--main">
              <span class="visually-hidden">View Face Concerns</span>
              <svg class="icon icon-llvc-expand" aria-hidden="true"><use xlink:href="#icon-llvc-expand"></use></svg>
            </button>

            <!-- Female Front -->
            <div class="llvc__body__front llvc__body__main llvc__body__front--female is-active">
              <?php echo file_get_contents( $svg_dir . 'female-figure-front.svg' ); // phpcs:ignore ?>
              <?php foreach ( $atb_hotspots['female-front'] as $btn ) atb_hotspot( $btn ); ?>
            </div>

            <!-- Female Back -->
            <div class="llvc__body__back llvc__body__main llvc__body__back--female">
              <?php echo file_get_contents( $svg_dir . 'female-figure-back.svg' ); // phpcs:ignore ?>
              <?php foreach ( $atb_hotspots['female-back'] as $btn ) atb_hotspot( $btn ); ?>
            </div>

            <!-- Female Face -->
            <div class="llvc__body__face llvc__body__face--female">
              <button class="llvc__face-toggle llvc__face-toggle--back">
                <svg class="icon icon-llvc-left-arrow" aria-hidden="true"><use xlink:href="#icon-llvc-left-arrow"></use></svg>
                <span class="visually-hidden">View Full Body</span>
              </button>
              <?php echo file_get_contents( $svg_dir . 'outline-of-female-face-and-neck.svg' ); // phpcs:ignore ?>
              <div class="llvc__concern-area" data-ll-tooltip style="top:5.68%;left:34.90%">
                <div role="tooltip" class="llvc__concern-area__title" id="label-4f">
                  <span class="visually-hidden">Select </span>Scalp<span class="visually-hidden"> concerns</span>
                </div>
                <button type="button" class="llvc__concern-area__circle" id="concern-btn-4" data-ll-tooltip-trigger data-term-id="4" aria-labelledby="label-4f">
                  <svg class="icon icon-llvc-add" aria-hidden="true"><use xlink:href="#icon-llvc-add"></use></svg>
                </button>
              </div>
              <div class="llvc__concern-area" data-ll-tooltip style="top:21.05%;left:65.77%">
                <div role="tooltip" class="llvc__concern-area__title" id="label-5f">
                  <span class="visually-hidden">Select </span>Upper Face<span class="visually-hidden"> concerns</span>
                </div>
                <button type="button" class="llvc__concern-area__circle" id="concern-btn-5" data-ll-tooltip-trigger data-term-id="5" aria-labelledby="label-5f">
                  <svg class="icon icon-llvc-add" aria-hidden="true"><use xlink:href="#icon-llvc-add"></use></svg>
                </button>
              </div>
            </div>

          </div><!-- /female body -->

          <?php /* =========== MALE BODY =========== */ ?>
          <div class="llvc__body llvc__body--male">

            <!-- Face toggle -->
            <button class="llvc__face-toggle llvc__face-toggle--main">
              <span class="visually-hidden">View Face Concerns</span>
              <svg class="icon icon-llvc-expand" aria-hidden="true"><use xlink:href="#icon-llvc-expand"></use></svg>
            </button>

            <!-- Male Front -->
            <div class="llvc__body__front llvc__body__main llvc__body__front--male is-active">
              <?php echo file_get_contents( $svg_dir . 'male-front-figure.svg' ); // phpcs:ignore ?>
              <?php foreach ( $atb_hotspots['male-front'] as $btn ) atb_hotspot( $btn ); ?>
            </div>

            <!-- Male Back -->
            <div class="llvc__body__back llvc__body__main llvc__body__back--male">
              <?php echo file_get_contents( $svg_dir . 'male-figure-back.svg' ); // phpcs:ignore ?>
              <?php foreach ( $atb_hotspots['male-back'] as $btn ) atb_hotspot( $btn ); ?>
            </div>

            <!-- Male Face -->
            <div class="llvc__body__face llvc__body__face--male">
              <button class="llvc__face-toggle llvc__face-toggle--back">
                <svg class="icon icon-llvc-left-arrow" aria-hidden="true"><use xlink:href="#icon-llvc-left-arrow"></use></svg>
                <span class="visually-hidden">View Full Body</span>
              </button>
              <?php echo file_get_contents( $svg_dir . 'outline-of-male-face-and-neck.svg' ); // phpcs:ignore ?>
              <div class="llvc__concern-area" data-ll-tooltip style="top:5.68%;left:34.90%">
                <div role="tooltip" class="llvc__concern-area__title" id="label-22m">
                  <span class="visually-hidden">Select </span>Scalp<span class="visually-hidden"> concerns</span>
                </div>
                <button type="button" class="llvc__concern-area__circle" id="concern-btn-22" data-ll-tooltip-trigger data-term-id="22" aria-labelledby="label-22m">
                  <svg class="icon icon-llvc-add" aria-hidden="true"><use xlink:href="#icon-llvc-add"></use></svg>
                </button>
              </div>
              <div class="llvc__concern-area" data-ll-tooltip style="top:21.05%;left:65.77%">
                <div role="tooltip" class="llvc__concern-area__title" id="label-23m">
                  <span class="visually-hidden">Select </span>Upper Face<span class="visually-hidden"> concerns</span>
                </div>
                <button type="button" class="llvc__concern-area__circle" id="concern-btn-23" data-ll-tooltip-trigger data-term-id="23" aria-labelledby="label-23m">
                  <svg class="icon icon-llvc-add" aria-hidden="true"><use xlink:href="#icon-llvc-add"></use></svg>
                </button>
              </div>
            </div>

          </div><!-- /male body -->

          <!-- Turn right buttons (back→front) -->
          <button class="llvc__turn llvc__turn-female llvc__turn--right is-active">
            <svg class="icon icon-llvc-turn-right" aria-hidden="true"><use xlink:href="#icon-llvc-turn-right"></use></svg>
            <span class="llvc__turn-text visually-hidden">View back concern areas</span>
          </button>
          <button class="llvc__turn llvc__turn-male llvc__turn--right">
            <svg class="icon icon-llvc-turn-right" aria-hidden="true"><use xlink:href="#icon-llvc-turn-right"></use></svg>
            <span class="llvc__turn-text visually-hidden">View back concern areas</span>
          </button>

        </div><!-- /body-column -->

        <?php /* ---- Concerns Column (right) ---- */ ?>
        <div class="llvc__concerns-column">

          <!-- Expand trigger (mobile) -->
          <button type="button" class="llvc__concerns__open-form" aria-controls="chosen" aria-expanded="false">
            <span class="sr-only">Expand Concerns Form</span>
          </button>

          <div class="llvc__concerns-container" aria-labelledby="concerns-heading" tabindex="-1" role="group">

            <form class="llvc__content llvc__concerns-form">

              <?php /* ---- Main selections view ---- */ ?>
              <div class="llvc__concerns__main is-active">
                <div class="llvc__concerns__heading-row">
                  <h2 class="llvc__heading llvc__heading--concerns" id="concerns-heading">
                    <?php echo esc_html( atb_text( 'selections_heading' ) ); ?> <span class="llvc__total-selections">(0)</span>
                  </h2>
                  <button class="llvc__concerns__clear" type="button" style="display:none;">
                    <svg class="icon icon-llvc-clear" aria-hidden="true"><use xlink:href="#icon-llvc-clear"></use></svg>
                    <?php echo esc_html( atb_text( 'clear_btn' ) ); ?>
                  </button>
                </div>

                <button class="llvc__button llvc__finish-consultation llvc__finish-consultation--mobile" type="submit">
                  <?php echo esc_html( atb_text( 'finish_btn' ) ); ?>
                </button>

                <div class="llvc__concerns-list--empty">
                  <p><?php echo esc_html( atb_text( 'empty_state' ) ); ?></p>
                </div>

                <div class="llvc__concerns-chosen--container" id="chosen">
                  <p class="llvc__concerns-list--empty__instructions"><?php echo esc_html( atb_text( 'empty_instructions' ) ); ?></p>
                  <div class="llvc__concerns-chosen">

                    <?php /* ---- Chosen concern sections (one per term_id) ---- */ ?>
                    <?php foreach ( $atb_concerns as $term_id => $data ) : ?>
                    <div class="llvc__chosen-concern-area" data-term-id="<?php echo (int) $term_id; ?>" style="display:none;">
                      <h2 class="llvc__heading--sm llvc__heading--section"><?php echo esc_html( $data['section_label'] ); ?></h2>
                      <ul class="llvc__chosen-concern-list">
                        <?php foreach ( $data['concerns'] as $concern_id => $concern_label ) : ?>
                        <li>
                          <div class="llvc__chosen-concern" data-term="<?php echo esc_attr( $concern_id ); ?>">
                            <?php echo esc_html( $concern_label ); ?>
                            <button class="llvc__clear-concern" type="button">
                              <svg class="icon icon-llvc-cancel" aria-hidden="true"><use xlink:href="#icon-llvc-cancel"></use></svg>
                              <span class="visually-hidden">Remove Concern</span>
                            </button>
                          </div>
                        </li>
                        <?php endforeach; ?>
                      </ul>
                    </div>
                    <?php endforeach; ?>

                  </div><!-- /concerns-chosen -->
                </div><!-- /chosen -->

                <!-- Mobile: select more / finish -->
                <div class="llvc__mobile-actions">
                  <button class="llvc__button llvc__select-more-concerns" type="button"><?php echo esc_html( atb_text( 'more_btn' ) ); ?></button>
                  <button class="llvc__button llvc__finish-consultation" type="submit"><?php echo esc_html( atb_text( 'finish_btn' ) ); ?></button>
                </div>

              </div><!-- /concerns__main -->

              <?php /* ---- Concern area panels (shown on body part click) ---- */ ?>
              <?php foreach ( $atb_concerns as $term_id => $data ) : ?>
              <div class="llvc__concerns__area"
                data-term-id="<?php echo (int) $term_id; ?>"
                data-ll-modal
                data-ll-modal-outside="true"
                data-ll-modal-trigger="#concern-btn-<?php echo (int) $term_id; ?>"
                data-ll-modal-escape=".llvc__all-concerns-toggle">

                <button class="llvc__all-concerns-toggle" type="button">
                  <svg class="icon icon-llvc-left-arrow" aria-hidden="true"><use xlink:href="#icon-llvc-left-arrow"></use></svg>
                  <span class="visually-hidden">Back To</span> Your Selections
                </button>

                <h2 class="llvc__heading llvc__heading--area"><?php echo esc_html( $data['header'] ); ?></h2>

                <ul class="llvc__concerns__area-list">
                  <?php foreach ( $data['concerns'] as $concern_id => $concern_label ) : ?>
                  <li>
                    <input type="checkbox"
                      id="<?php echo esc_attr( $concern_id ); ?>"
                      name="<?php echo esc_attr( $concern_id ); ?>"
                      value="<?php echo esc_attr( $concern_id ); ?>"
                      data-concern="<?php echo esc_attr( $concern_label ); ?>">
                    <label for="<?php echo esc_attr( $concern_id ); ?>"><?php echo esc_html( $concern_label ); ?></label>
                  </li>
                  <?php endforeach; ?>
                </ul>

                <button class="llvc__add-concerns llvc__button" type="button">
                  Add to Treatment Plan (<span class="llvc__area-selections">0</span>)
                </button>

              </div><!-- /concerns__area -->
              <?php endforeach; ?>

              <!-- Hidden concerns JSON field (populated by JS before submit) -->
              <div class="llvc-concerns-input" style="display:none;">
                <input type="hidden" name="concerns_json" value="">
              </div>

            </form><!-- /concerns-form -->
          </div><!-- /concerns-container -->

          <!-- Desktop finish button (outside the scrolling area) -->
          <div class="llvc__concerns__footer">
            <button class="llvc__button llvc__finish-consultation llvc__finish-consultation--desktop"
              form="" type="button" id="atb-finish-desktop">
              <?php echo esc_html( atb_text( 'finish_btn' ) ); ?>
            </button>
          </div>

        </div><!-- /concerns-column -->

      </div><!-- /columns -->
    </div><!-- /container -->
  </div><!-- /step vc-2 -->

  <?php /* ============================================================
   * STEP 3 — CONTACT FORM
   * ========================================================== */ ?>
  <div class="llvc__form llvc__screen llvc__step" data-step="vc-3" inert>
    <div class="llvc__container">
      <div class="llvc__form-content" aria-labelledby="form-heading" tabindex="-1" role="group">
        <div class="llvc__content">
          <h2 class="llvc__heading--lg" id="form-heading"><?php echo esc_html( atb_text( 'form_heading' ) ); ?></h2>
          <p><?php echo esc_html( atb_text( 'form_intro' ) ); ?></p>
          <p><?php echo esc_html( atb_text( 'form_privacy' ) ); ?></p>
        </div>

        <?php
        $atb_form_plugin = atb_form_plugin();
        if ( 'wpforms' === $atb_form_plugin ) :
            if ( atb_wpf_active() ) :
                $atb_wpf_id = atb_get_wpf_form_id();
                if ( $atb_wpf_id > 0 ) :
                    wpforms_display( $atb_wpf_id, false, false );
                else : ?>
                    <p class="atb-notice atb-notice--warning">
                        No WPForms form is configured for the Treatment Builder.<br>
                        Go to <strong>Settings &rarr; Treatment Builder &rarr; General</strong> and select a form.
                    </p>
                <?php endif; else : ?>
                    <p class="atb-notice atb-notice--error">
                        <strong>WPForms is required</strong> to use the Treatment Builder.<br>
                        Please install and activate <a href="https://wpforms.com/" target="_blank">WPForms</a>.
                    </p>
            <?php endif;
        else : // gravity_forms (default)
            if ( atb_gf_active() ) :
                $atb_form_id = atb_get_form_id();
                if ( $atb_form_id > 0 ) :
                    // Display GF form: ( id, display_title, display_description, display_inactive, field_values, ajax, tabindex, echo )
                    gravity_form( $atb_form_id, false, false, false, null, true, 1, true );
                else : ?>
                    <p class="atb-notice atb-notice--warning">
                        No Gravity Form is configured for the Treatment Builder.<br>
                        Go to <strong>Settings &rarr; Treatment Builder &rarr; General</strong> and select a form.
                    </p>
                <?php endif; else : ?>
                    <p class="atb-notice atb-notice--error">
                        <strong>Gravity Forms is required</strong> but is not active.<br>
                        Switch to WPForms in <strong>Settings &rarr; Treatment Builder &rarr; General</strong>,
                        or install <a href="https://www.gravityforms.com/" target="_blank">Gravity Forms</a>.
                    </p>
            <?php endif;
        endif; ?>

      </div><!-- /form-content -->
    </div><!-- /container -->
  </div><!-- /step vc-3 -->

  <?php /* ============================================================
   * POPUPS
   * ========================================================== */ ?>

  <!-- Exit confirmation -->
  <div class="llvc__popup" id="llvc__popup--leaving"
    role="alertdialog" aria-modal="true" aria-labelledby="exit-vc-title"
    data-ll-modal
    data-ll-modal-trigger=".llvc-navbar__exit"
    data-ll-modal-escape=".llvc__popup-close">
    <div class="llvc__popup-inner">
      <div class="llvc__content">
        <h2 class="llvc__heading--lg" id="exit-vc-title"><?php echo esc_html( atb_text( 'exit_heading' ) ); ?></h2>
        <p><?php echo esc_html( atb_text( 'exit_body' ) ); ?></p>
        <div class="llvc__popup__buttons">
          <a href="<?php echo $home_url; ?>" class="llvc__button--ghost llvc__popup-exit-vc"><?php echo esc_html( atb_text( 'exit_confirm' ) ); ?></a>
          <button class="llvc__button llvc__popup-close"><?php echo esc_html( atb_text( 'exit_cancel' ) ); ?></button>
        </div>
      </div>
    </div>
  </div>

  <!-- Gender switch confirmation -->
  <div class="llvc__popup" id="llvc__popup--switch"
    role="alertdialog" aria-modal="true" aria-labelledby="switch-title"
    data-ll-modal
    data-ll-modal-trigger=".llvc__gender-choice"
    data-ll-modal-escape=".llvc__popup-close-escape"
    data-ll-modal-close=".llvc__popup__switch-genders">
    <div class="llvc__popup-inner">
      <div class="llvc__content">
        <h2 class="llvc__heading--lg" id="switch-title"><?php echo esc_html( atb_text( 'switch_heading' ) ); ?></h2>
        <p><?php echo esc_html( atb_text( 'switch_body' ) ); ?></p>
        <div class="llvc__popup__buttons">
          <button class="llvc__button--ghost llvc__popup-close llvc__popup-close-escape"><?php echo esc_html( atb_text( 'switch_cancel' ) ); ?></button>
          <button class="llvc__button llvc__popup__switch-genders llvc__popup-close"><?php echo esc_html( atb_text( 'switch_confirm' ) ); ?></button>
        </div>
      </div>
    </div>
  </div>

</div><!-- /.llvc.llvc--concerns -->
