<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
?>

<div class="m-3 bg">
	<div class="row mt-5">
		<div class="col-6" style="max-width: 1200px;">
		<p>Stylish Real Estate Leads offers a variety of calculator forms designed to assist buyers, sellers, and rental property investors in making informed real estate decisions. Choose a calculator form below to embed on your website, drive traffic, and capture valuable lead information.</p>
		</div>
	</div>
	<div class="row mt-5">
		<?php foreach ( $calculators as $calculator ) {
			if ( ! $this->is_premium_version_active && empty( $calculator->shortcode ) ) {
				continue;
			}
			?>
			<div class="col-6 mt-3" style="max-width: 600px;">
				<div class="container form">
					<div class="row mb-2">
						<div class="col text-center">
							<h4 class="title"><?php echo wp_kses_post( $calculator->name ); ?></h4>
						</div>
					</div>
					<div class="row mb-2">
						<div class="col text-center">
							<p class="custom-short-code-p-tag" style="background: #F8F9FF;padding:10px;border-radius: 6px;">
								<strong><?php empty( $calculator->shortcode ) ? print 'Comming soon ...' : print 'Shortcode is [' . sanitize_text_field( $calculator->shortcode ) . ']'; ?></strong>
							</p>
						</div>
					</div>
					<div class="row">
						<div class="col text-center">
							<?php
							if ( isset( $calculator->shortcode ) && ! empty( $calculator->shortcode ) ) {
								$edit_url = "?page=srel-settings-page&id=" . esc_attr( $calculator->id );
								$view_url = $this->is_premium_version_active ? "?page=srel-quote-management-screen&id=" . esc_attr( $calculator->id ) : '#';
								$view_class = $this->is_premium_version_active ? '' : 'use-premium-tooltip';
								?>
								<a href="<?php echo esc_url( $edit_url ); ?>" class="btn btn-primary">Edit</a>
								<a href="<?php echo esc_url( $view_url ); ?>" class="btn opt-secondary <?php echo esc_attr( $view_class ); ?>">View Quotes</a>
								<?php
							} else {
								?>
									<a href="" class="btn btn-primary disabled" >Edit</a>
									<a href="" class="btn opt-secondary disabled">View Quotes</a>
								<?php
							}
							?>
						</div>
					</div>
				</div>
			</div>
			<?php
		}
		?>
	</div>
</div>
