<?php
defined( 'ABSPATH' ) || exit;

/* -----------------------------------------------------------------------
 * Data: concern panels (term_id → label, header, concerns[id => label])
 * --------------------------------------------------------------------- */
$atb_concerns = [
	50 => [ 'header' => 'General Body Concerns', 'section_label' => 'General Body', 'concerns' => [
		'man_general-1004' => 'Eczema', 'man_general-1003' => 'Prolonged Recovery After Exercise',
		'man_general-1005' => 'Dry Skin', 'man_general-999' => 'Fatigue',
		'man_general-997' => 'Fine Lines and Wrinkles', 'man_general-996' => 'Frequent Illness',
		'man_general-960' => 'Tendonitis', 'man_general-969' => 'Crepey Skin',
		'man_general-968' => 'Soft Tissue Injury', 'man_general-966' => 'Stress',
		'man_general-964' => 'Struggling to Fall Asleep', 'man_general-963' => 'Brain Fog',
		'man_general-962' => 'Struggling to Stay Asleep', 'man_general-970' => 'Sagging Skin',
		'man_general-959' => 'Acne', 'man_general-957' => 'Catastrophic Thinking',
		'man_general-955' => 'Rage', 'man_general-953' => 'Weight Gain',
		'man_general-954' => 'Depression', 'man_general-952' => 'Anxiety',
		'man_general-951' => 'Wrinkles', 'man_general-987' => 'Irritability',
		'man_general-986' => 'Decreased Muscle Mass', 'man_general-985' => 'Impaired Memory',
		'man_general-984' => 'Joint Pain', 'man_general-983' => 'Loose Skin',
		'man_general-978' => 'Decreased Physical Endurance', 'man_general-977' => 'Loss of Focus',
		'man_general-975' => 'Poor Sleep', 'man_general-971' => 'Decreased Mental Clarity',
	]],
	51 => [ 'header' => 'General Body Concerns', 'section_label' => 'General Body', 'concerns' => [
		'woman_general-1004' => 'Eczema', 'woman_general-1012' => 'Anxiety',
		'woman_general-1005' => 'Dry Skin', 'woman_general-1013' => 'Brain Fog',
		'woman_general-998' => 'Feeling Cold', 'woman_general-997' => 'Fine Lines and Wrinkles',
		'woman_general-996' => 'Frequent Illness', 'woman_general-994' => 'Hot Flashes',
		'woman_general-1024' => 'Irritability', 'woman_general-1033' => 'Weight Gain',
		'woman_general-1032' => 'Struggling to Stay Asleep', 'woman_general-1031' => 'Struggling to Fall Asleep',
		'woman_general-1030' => 'Stress', 'woman_general-1029' => 'Rage',
		'woman_general-1028' => 'Prolonged Recovery After Exercise', 'woman_general-1027' => 'Poor Sleep',
		'woman_general-1026' => 'Loss of Focus', 'woman_general-1025' => 'Joint Pain',
		'woman_general-1023' => 'Fatigue', 'woman_general-1022' => 'Depression',
		'woman_general-1020' => 'Decreased Physical Endurance', 'woman_general-1019' => 'Decreased Muscle Mass',
		'woman_general-1018' => 'Decreased Mental Clarity', 'woman_general-1016' => 'Catastrophic Thinking',
		'woman_general-960' => 'Tendonitis', 'woman_general-969' => 'Crepey Skin',
		'woman_general-968' => 'Soft Tissue Injury', 'woman_general-970' => 'Sagging Skin',
		'woman_general-951' => 'Wrinkles', 'woman_general-991' => 'Infertility',
		'woman_general-985' => 'Impaired Memory', 'woman_general-983' => 'Loose Skin',
		'woman_general-981' => 'Night Sweats',
	]],
	16 => [ 'header' => 'Back Concerns', 'section_label' => 'Back', 'concerns' => [
		'woman_back-1011' => 'Acne', 'woman_back-1025' => 'Joint Pain',
	]],
	19 => [ 'header' => 'Intimate Concerns', 'section_label' => 'Intimate', 'concerns' => [
		'woman_intimate-1010' => 'Decreased Vaginal Sensitivity',
		'woman_intimate-1007' => 'Decreased Vaginal Lubrication',
		'woman_intimate-992'  => 'Female Incontinence',
		'woman_intimate-1021' => 'Decreased Sexual Pleasure',
		'woman_intimate-1017' => 'Decreased Libido',
		'woman_intimate-958'  => 'Vaginal Dryness',
		'woman_intimate-956'  => 'Vaginal Laxity',
		'woman_intimate-979'  => 'Painful Intercourse',
		'woman_intimate-991'  => 'Infertility',
		'woman_intimate-950'  => 'Abnormal Menstrual Cycle',
		'woman_intimate-973'  => 'Decreased Clitoral Sensitivity',
		'woman_intimate-974'  => 'Pregnancy Loss',
	]],
	11 => [ 'header' => 'Abdomen Concerns', 'section_label' => 'Abdomen', 'concerns' => [
		'woman_abdomen-1009' => 'Diarrhea', 'woman_abdomen-1033' => 'Weight Gain',
		'woman_abdomen-967'  => 'Constipated', 'woman_abdomen-972'  => 'Reflux',
	]],
	29 => [ 'header' => 'Abdomen Concerns', 'section_label' => 'Abdomen', 'concerns' => [
		'man_abdomen-1009' => 'Diarrhea', 'man_abdomen-967' => 'Constipated',
		'man_abdomen-953'  => 'Weight Gain', 'man_abdomen-972' => 'Reflux',
	]],
	23 => [ 'header' => 'Upper Face Concerns', 'section_label' => 'Upper Face', 'concerns' => [
		'man_upper_face-1008' => 'Dry Eyes',
	]],
	4  => [ 'header' => 'Scalp Concerns', 'section_label' => 'Scalp', 'concerns' => [
		'woman_scalp-1006' => 'Brittle Hair', 'woman_scalp-995' => 'Hair Loss',
	]],
	22 => [ 'header' => 'Scalp Concerns', 'section_label' => 'Scalp', 'concerns' => [
		'man_scalp-1006' => 'Brittle Hair', 'man_scalp-995' => 'Hair Loss',
	]],
	37 => [ 'header' => 'Intimate Concerns', 'section_label' => 'Intimate', 'concerns' => [
		'man_intimate-1002' => 'Erectile Dysfunction',
		'man_intimate-993'  => 'Decreased Sexual Pleasure',
		'man_intimate-990'  => 'Decreased Penile Sensation',
		'man_intimate-982'  => 'Decreased Libido',
		'man_intimate-976'  => "Peyronie's Disease",
	]],
	10 => [ 'header' => 'Arms Concerns', 'section_label' => 'Arms', 'concerns' => [
		'woman_arms-1025' => 'Joint Pain',
	]],
	13 => [ 'header' => 'Lower Legs Concerns', 'section_label' => 'Lower Legs', 'concerns' => [
		'woman_lower_legs-1025' => 'Joint Pain',
	]],
	5  => [ 'header' => 'Upper Face Concerns', 'section_label' => 'Upper Face', 'concerns' => [
		'woman_upper_face-1015' => 'Dry Eyes',
	]],
	14 => [ 'header' => 'Hands Concerns', 'section_label' => 'Hands', 'concerns' => [
		'woman_hands-965' => 'Brittle Nails',
	]],
	32 => [ 'header' => 'Hands Concerns', 'section_label' => 'Hands', 'concerns' => [
		'man_hands-965' => 'Brittle Nails',
	]],
	28 => [ 'header' => 'Arms Concerns', 'section_label' => 'Arms', 'concerns' => [
		'man_arms-959' => 'Acne', 'man_arms-984' => 'Joint Pain',
	]],
	34 => [ 'header' => 'Back Concerns', 'section_label' => 'Back', 'concerns' => [
		'man_back-959' => 'Acne', 'man_back-984' => 'Joint Pain',
	]],
	36 => [ 'header' => 'Buttocks Concerns', 'section_label' => 'Buttocks', 'concerns' => [
		'man_buttocks-959' => 'Acne',
	]],
	33 => [ 'header' => 'Chest Concerns', 'section_label' => 'Chest', 'concerns' => [
		'man_chest-959' => 'Acne',
	]],
	31 => [ 'header' => 'Lower Legs Concerns', 'section_label' => 'Lower Legs', 'concerns' => [
		'man_lower_legs-984' => 'Joint Pain',
	]],
];

/* -----------------------------------------------------------------------
 * Hotspot button positions per figure view
 * --------------------------------------------------------------------- */
$atb_hotspots = [
	'female-front' => [
		[ 'id' => 51, 'label' => 'General Body', 'style' => 'top:8.62%;left:5.67%',  'class' => 'is-female' ],
		[ 'id' => 11, 'label' => 'Abdomen',      'style' => 'top:35.19%;left:59.57%','class' => 'is-female' ],
		[ 'id' => 10, 'label' => 'Arms',          'style' => 'top:23.26%;left:89.82%','class' => 'is-female' ],
		[ 'id' => 14, 'label' => 'Hands',         'style' => 'top:49.19%;left:90.78%','class' => 'is-female' ],
		[ 'id' => 19, 'label' => 'Intimate',      'style' => 'top:42.91%;left:34.04%','class' => 'is-female' ],
		[ 'id' => 13, 'label' => 'Lower Legs',    'style' => 'top:79.17%;left:61.70%','class' => 'is-female' ],
	],
	'female-back' => [
		[ 'id' => 16, 'label' => 'Back',       'style' => 'top:32.80%;left:62.07%' ],
		[ 'id' =>  4, 'label' => 'Scalp',      'style' => 'top:5.68%;left:34.90%' ],
		[ 'id' =>  5, 'label' => 'Upper Face', 'style' => 'top:21.05%;left:65.77%' ],
	],
	'male-front' => [
		[ 'id' => 50, 'label' => 'General Body', 'style' => 'top:8.06%;left:6.90%',  'class' => 'is-male' ],
		[ 'id' => 29, 'label' => 'Abdomen',      'style' => 'top:35.19%;left:59.57%','class' => 'is-male' ],
		[ 'id' => 28, 'label' => 'Arms',          'style' => 'top:23.26%;left:89.82%','class' => 'is-male' ],
		[ 'id' => 33, 'label' => 'Chest',         'style' => 'top:22.44%;left:25.53%','class' => 'is-male' ],
		[ 'id' => 32, 'label' => 'Hands',         'style' => 'top:49.19%;left:90.78%','class' => 'is-male' ],
		[ 'id' => 37, 'label' => 'Intimate',      'style' => 'top:44.91%;left:37.04%','class' => 'is-male' ],
		[ 'id' => 31, 'label' => 'Lower Legs',    'style' => 'top:79.17%;left:61.70%','class' => 'is-male' ],
	],
	'male-back' => [
		[ 'id' => 34, 'label' => 'Back',       'style' => 'top:32.80%;left:62.07%' ],
		[ 'id' => 36, 'label' => 'Buttocks',   'style' => 'top:45.73%;left:30.21%' ],
		[ 'id' => 22, 'label' => 'Scalp',      'style' => 'top:5.68%;left:34.90%' ],
		[ 'id' => 23, 'label' => 'Upper Face', 'style' => 'top:21.05%;left:65.77%' ],
	],
];

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

        <?php if ( atb_gf_active() ) :
            $atb_form_id = atb_get_form_id();
            if ( $atb_form_id > 0 ) :
                // Display GF form: ( id, display_title, display_description, display_inactive, field_values, ajax, tabindex, echo )
                gravity_form( $atb_form_id, false, false, false, null, true, 1, true );
            else : ?>
                <p class="atb-notice atb-notice--warning">
                    No Gravity Form is configured for the Treatment Builder.<br>
                    Set the <code>atb_gravity_form_id</code> WordPress option to your form&apos;s ID.
                </p>
            <?php endif; else : ?>
                <p class="atb-notice atb-notice--error">
                    <strong>Gravity Forms is required</strong> to use the Treatment Builder.<br>
                    Please install and activate <a href="https://www.gravityforms.com/" target="_blank">Gravity Forms</a>.
                </p>
        <?php endif; ?>

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
