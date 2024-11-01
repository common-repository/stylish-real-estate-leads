<?php if ( ! defined( 'ABSPATH' ) ) {
	exit;}
$header_menus = apply_filters(
	'srel_header_menus',
	array(
		array(
			'menu_name' => 'Lead Form',
			'menu_icon' => 'fas fa-plus',
			'menu_slug' => 'srel-view-forms',
		),
		array(
			'menu_name' => 'Help',
			'menu_icon' => 'far fa-edit',
			'menu_slug' => 'srel-help',
		),
		array(
			'menu_name' => 'Settings',
			'menu_icon' => 'far fa-edit',
			'menu_slug' => 'srel-help',
		),
	)
);
?>

<div class="row align-items-center bg-white justify-content-center w-100 header">
	<div class="row align-items-center mx-auto w-100">
		<div class="col-6 col-md-6 col-lg-6">
			<div class="scc-custom-version-info align-middle">
				<a href="https://stylishcostcalculator.com/" class="scc-header">
					<img src="<?php echo esc_url( SREL_MORTGAGE_CALCULATOR_ASSETS . '/images/srel-logo.png' ); ?>" class="img-responsive1" style="max-width: 240px;height: 36px;" alt="Image">
				</a>
				<span class="scc_plug_ver">
									</span>
			</div>
		</div>
		<div class="col-6 col-md-6 col-lg-6 srel-navbar">
			<div class="srel-top-nav-container">
				<ul class="srel-edit-nav-items">
					<?php if ( ! defined( 'SREL_MORTGAGE_CALCULATOR_PREMIUM_VERSION' ) ) { ?>
					<li><span class="free_version">
							<a class="highlighted scc-nav-with-icons" href="https://stylishrealestateleads.com/?utm_source=inside-plugin&utm_medium=wordpress&utm_content=buy-premium-header-cta-btn" target="_blank"><i class="far fa-gem"></i>Buy Premium</a></span>
					</li>
					<?php } ?>
					<?php foreach ( $header_menus as $menu_index => $menu ) { ?>
						<li><a class="scc-nav-with-icons" href="<?php echo esc_url( '?page=' . $menu['menu_slug'] ); ?>"><i class="<?php echo esc_attr( $menu['menu_icon'] ); ?>"></i><?php echo esc_attr( $menu['menu_name'] ); ?></a></li>
					<?php } ?>
				</ul>
			</div>
		</div>
	</div>
</div>
