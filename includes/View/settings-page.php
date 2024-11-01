<?php

namespace SREL_Calculator_Lib\Includes\View;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class SettingsPage {

	protected $settings;
	protected $assets_path;
	protected $is_premium_version_active;
	protected $cta_buttons = array(
		'CTA Button 1' => 'cta_button_one',
		'CTA Button 2' => 'cta_button_two',
		'CTA Button 3' => 'cta_button_three',
	);
	public function __construct( $settings ) {
		$this->is_premium_version_active = defined( 'SREL_MORTGAGE_CALCULATOR_PREMIUM_VERSION' );
		$this->settings                  = $settings;
		$this->assets_path               = $this->is_premium_version_active ? SREL_MORTGAGE_CALCULATOR_PREMIUM_ASSETS : SREL_MORTGAGE_CALCULATOR_ASSETS;
		$this->render_page();
	}

	private function render_page() {
		$is_premium_version_active = $this->is_premium_version_active;
		$assets_path               = $this->assets_path;
		?>
		<div class="m-3 main srel-container">
			<?php
			wp_localize_script( 'srel-backend-js', 'pageSettings', array( 'nonce' => wp_create_nonce( 'settings-page' ) ) );
			settings_fields( 'srel_settings_page_options' );
			$settings = json_decode( $this->settings, true );
			?>
			<h3 class="mb-4 mt-4"><b>Settings:</b> Rental Property Calculator</h3>
			<form id="settings">
				<div class="accordion mt-2" id="settings-page-accordion">
					<?php
					$frontend_form_settings  = array(
						'name'   => 'Frontend Form Settings',
						'fields' => array(
							'frontend_form_settings_body',
						),
					);
					$autofill_settings       = array(
						'name'   => 'Autofill Settings',
						'fields' => array(
							'autofill_settings_body',
						),
					);
					$brand_settings          = array(
						'name'   => 'Brand Settings',
						'fields' => array(
							'brand_settings_body',
						),
						'allow_on_free_version' => true,
					);
					$email_settings          = array(
						'name'   => 'Email Settings',
						'fields' => array(
							'email_settings_body',
						),
					);
					$webhook_settings        = array(
						'name'   => 'Webhook',
						'fields' => array(
							'webhook_settings_body',
						),
					);
					$thank_you_page_settings = array(
						'name'   => 'Thank You Page',
						'fields' => array(
							'thank_you_page_settings_body',
						),
					);
					$settings_items_order    = array(
						$frontend_form_settings,
						$autofill_settings,
						$brand_settings,
						$email_settings,
						$webhook_settings,
						$thank_you_page_settings,
					);
					foreach ( $settings_items_order as $key => $settings ) {
						$this->output_settings_header( $settings );
					}
					?>
				</div>
				<button id="srel-save-settings" class="button button-primary cta-btn"> Save Changes</button>
			</form>
		</div>
		<script>
			document.addEventListener('DOMContentLoaded', function() {
				const tooltipTriggerList = document.querySelectorAll('[data-toggle="tooltip"]')
				const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))
				const helpIconTooltips = document.querySelectorAll('[data-tooltip-key]')
				helpIconTooltips.forEach(helpIcon => {
					srcApplyTooltip(helpIcon)
				})
			});
			const tooltipContentRepo = {
				'interest-rate': 'The interest rate you expect to pay on your mortgage. The interest rate is the annual cost of borrowing money from your lender. The lower the interest rate, the less you will pay for the total loan. The interest rate is the percentage of the loan you pay for borrowing the money.',
				'loan-term': 'Duration or length of time over which you will repay your mortgage loan. It is typically measured in years. Choosing a shorter loan term can result in higher monthly payments but lower overall interest costs, while opting for a longer loan term can lower monthly payments but increase the total interest paid over time',
				'vacancy-rate': 'Measure used in real estate to determine the percentage of unoccupied rental properties in a specific area or market. It reflects the balance between supply and demand in the rental market. A low vacancy rate suggests a high demand for rentals and a competitive market, while a high vacancy rate indicates an oversupply of rental properties. Monitoring vacancy rates helps landlords, investors, and policymakers assess market conditions and make informed decisions about rental pricing and investment opportunities.',
				'cost-to-sell': 'Expenses associated with selling a property. It includes various costs incurred during the process of listing, marketing, and transferring ownership of the property. These costs typically include real estate agent commissions, closing costs, home staging, repairs or renovations, marketing expenses, and other fees or charges. The Cost to Sell is an important factor for homeowners to consider when estimating their potential proceeds from a property sale. It helps in determining the net profit or loss after accounting for the expenses associated with the sale.',
				'closing-cost': "Fees and expenses incurred during the process of transferring ownership of a property from the seller to the buyer. These costs typically include various fees such as loan origination fees, appraisal fees, title search and insurance fees, attorney fees, and other administrative expenses. Closing costs are typically paid by both the buyer and the seller, and they can vary based on the property value, location, and local regulations. It's important for buyers and sellers to consider closing costs when budgeting for a real estate transaction.",
				'property-tax': "Recurring tax imposed by the local government on the value of a property. Property taxes are typically assessed annually and are based on the assessed value of the property. The funds generated from property taxes are used to support local services such as schools, roads, public safety, and other community infrastructure. The amount of property tax owed is determined by applying a tax rate to the assessed value of the property. Property tax is an important factor for homeowners to consider as it contributes to the overall cost of owning and maintaining a property.",
				'maintenance': "Ongoing upkeep and repairs necessary to keep a property in good condition. It includes routine tasks such as cleaning, landscaping, and minor repairs, as well as more significant repairs and replacements over time. Regular maintenance helps preserve the value of the property and ensures its functionality and aesthetic appeal. The cost of maintenance can vary depending on factors such as the size of the property, age of the building, and specific maintenance needs. It is important for property owners to budget for maintenance expenses to ensure the property remains in optimal condition.",
				'insurance': "Refers to a policy that provides financial protection against potential losses or damages to the property. Property insurance typically covers events such as fire, theft, natural disasters, and liability for accidents that may occur on the property. The cost of insurance premiums can vary based on factors such as the location of the property, its value, the type of coverage selected, and the insurance provider. Having property insurance is essential for homeowners to mitigate potential risks and ensure financial protection in case of unforeseen events.",
				'phone-number': "<img class='p-1 tooltip-image'  style='object-fit: contain;' src='<?php echo esc_url( $assets_path . '/images/tooltip/infographics-phone.png' ); ?>' alt=''/><br/><h4 class='p-1 tooltip-title'>Phone Number</h4><div class='p-1 tooltip-body'>Show phone number in Reveal My Result form</div>",
				'comment-box': "<img class='p-1 tooltip-image'  style='object-fit: contain;' src='<?php echo esc_url( $assets_path . '/images/tooltip/infographics-Comment.png' ); ?>' alt=''/><br/><h4 class='p-1 tooltip-title'>Comment Box</h4><div class='p-1 tooltip-body'>Show comment box in Reveal My Result form</div>",
				'rating-show-frontend': "Show property rating on frontend.",
				'rating-show-email': "Show Property Rating in Insights Email.",
				'logo': "<img class='p-1 tooltip-image'  style='object-fit: contain;' src='<?php echo esc_url( $assets_path . '/images/tooltip/infographics-Logo.png' ); ?>' alt=''/><br/><h4 class='p-1 tooltip-title'>Email Header Logo</h4><div class='p-1 tooltip-body'>Show logo in email header</div>",
				'primary-color': "<img class='p-1 tooltip-image'  style='object-fit: contain;' src='<?php echo esc_url( $assets_path . '/images/tooltip/infographics-cta-primary-color.png' ); ?>' alt=''/><br/><h4 class='p-1 tooltip-title'>Email Primary Color</h4><div class='p-1 tooltip-body'>Primary color of email</div>",
				'sec-color': "<img class='p-1 tooltip-image'  style='object-fit: contain;' src='<?php echo esc_url( $assets_path . '/images/tooltip/infographics-bg-color.png' ); ?>' alt=''/><br/><h4 class='p-1 tooltip-title'>Email Secondary Color</h4><div class='p-1 tooltip-body'>Secondary color of email</div>",
				'primary-text-color': "<img class='p-1 tooltip-image'  style='object-fit: contain;' src='<?php echo esc_url( $assets_path . '/images/tooltip/infographics-color-text.png' ); ?>' alt=''/><br/><h4 class='p-1 tooltip-title'>Primary Text Color</h4><div class='p-1 tooltip-body'>Primary text color of email</div>",
				'email-bg-color': "<img class='p-1 tooltip-image'  style='object-fit: contain;' src='<?php echo esc_url( $assets_path . '/images/tooltip/infographics-bg-color.png' ); ?>' alt=''/><br/><h4 class='p-1 tooltip-title'>Email Background Color</h4><div class='p-1 tooltip-body'>Background color of email</div>",
				'email-to': "The email address you want the Insights Email to be sent from. This email address will also be used to get a copy of the email.",
				'email-subject': "Subject to add in email",
				'email-from': "Email from",
				'email-cc': "Cc to add in email",
				'email-bcc': "Bcc to add in email",
				'webhook': "Webhook to send data to",
				'thank-page': "Url of page to redirect after submitting email form",
				'footer-title': "<img class='p-1 tooltip-image'  style='object-fit: contain;' src='<?php echo esc_url( $assets_path . '/images/tooltip/infographics-footer-title.png' ); ?>' alt=''/><br/><h4 class='p-1 tooltip-title'>Footer Title</h4><div class='p-1 tooltip-body'>Title of footer in email.</div>",
				'email-heading': "<img class='p-1 tooltip-image'  style='object-fit: contain;' src='<?php echo esc_url( $assets_path . '/images/tooltip/infographics-eamil-heading.png' ); ?>' alt=''/><br/><h4 class='p-1 tooltip-title'>Email Heading</h4><div class='p-1 tooltip-body'>Title heading of email</div>",
				'email-body': "<img class='p-1 tooltip-image'  style='object-fit: contain;' src='<?php echo esc_url( $assets_path . '/images/tooltip/infographics-email-body.png' ); ?>' alt=''/><br/><h4 class='p-1 tooltip-title'>Email Body</h4><div class='p-1 tooltip-body'>Boy of email</div>",
				'realtor-image': "<img class='p-1 tooltip-image'  style='object-fit: contain;' src='<?php echo esc_url( $assets_path . '/images/tooltip/infographics-realtor-image.png' ); ?>' alt=''/><br/><h4 class='p-1 tooltip-title'>Realtor Image</h4><div class='p-1 tooltip-body'>Show relator image in email footer.</div>",
				'realtor-footer-message': "<img class='p-1 tooltip-image'  style='object-fit: contain;' src='<?php echo esc_url( $assets_path . '/images/tooltip/infographics-realtor-message.png' ); ?>' alt=''/><br/><h4 class='p-1 tooltip-title'>Realtor Footer Message</h4><div class='p-1 tooltip-body'>Show realtor footer message in email</div>",
				'cta-title': "<img class='p-1 tooltip-image'  style='object-fit: contain;' src='<?php echo esc_url( $assets_path . '/images/tooltip/infographics-cta-title.png' ); ?>' alt=''/><br/><h4 class='p-1 tooltip-title'>CTA Title</h4><div class='p-1 tooltip-body'>Title of CTA button</div>",
				'cta-text': "<img class='p-1 tooltip-image'  style='object-fit: contain;' src='<?php echo esc_url( $assets_path . '/images/tooltip/infographics-cta-text.png' ); ?>' alt=''/><br/><h4 class='p-1 tooltip-title'>CTA Text</h4><div class='p-1 tooltip-body'>Text in the CTA button</div>",
				'cta-text-color': "<img class='p-1 tooltip-image'  style='object-fit: contain;' src='<?php echo esc_url( $assets_path . '/images/tooltip/infographics-cta-text-color.png' ); ?>' alt=''/><br/><h4 class='p-1 tooltip-title'>CTA Text Color</h4><div class='p-1 tooltip-body'>Color of CTA button text</div>",
				'cta-link': "<img class='p-1 tooltip-image'  style='object-fit: contain;' src='<?php echo esc_url( $assets_path . '/images/tooltip/infographics-cta-text.png' ); ?>' alt=''/><br/><h4 class='p-1 tooltip-title'>CTA Link</h4><div class='p-1 tooltip-body'>CTA button link</div>",
				'force-user-to-submit-email': "When enabled user will submit a form to get the calculation on email otherwise results will be shown instantly",
				'title-and-text-color': "Title and text color for frontend",
				'cta-button-animation-tt': "Select the animation style for your Call to action buttons",
				'annual-rent-increase': "Annual increase in rent",
				'annual-expense-increase': "Annual increase in expenses",
			}


			function srcApplyTooltip(helpIcon) {
				const tooltipKey = helpIcon.getAttribute('data-tooltip-key')
				const tooltipContent = tooltipContentRepo[tooltipKey]
				new bootstrap.Tooltip(helpIcon, {
					delay: {
						hide: 300
					},
					title: tooltipContent,
					trigger: 'hover focus',
					html: true,
					placement: 'right',
				})
			}

			function toggleShortCodes() {
				if (jQuery('#email_form_short_codes_section').css('display') === 'none') {
					jQuery('#email_form_short_codes_section').css('display', 'block')
				} else {
					jQuery('#email_form_short_codes_section').css('display', 'none')
				}
			}
		</script>
		<style>
		</style>
		<?php
	}

	private function field_frontend_form_settings_body() {
		$settings = json_decode( $this->settings, true );
		?>
		<div class="settings-section-wrapper">
			<div class="srel-form-body">
				<div class="row">
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 plr-0">
						<label for="force" class="form-label">Force Email to View Results (lead generation)</label>
						<span class="srel-icn-wrapper" data-tooltip-key="force-user-to-submit-email">
							<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-help-circle">
								<circle cx="12" cy="12" r="10"></circle>
								<path d="M9.09 9a3 3 0 015.83 1c0 2-3 3-3 3M12 17h.01"></path>
							</svg>
						</span>
						<br />
						<label class="switch mt-1">
							<input type="checkbox" class="form-control" name="force" value="1" <?php ( isset( $settings['force'] ) && 1 === intval( $settings['force'] ) ) ? print 'checked' : ''; ?>>
							<span class="slider round"></span>
						</label>
					</div>
				</div>
			</div>
			<h4 class="mt-4">Custom Fields</h4>
			<hr class="srel-calc-settings-hr">
			<div class="row mt-3">
				<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
					<label for="phone_number" class="form-label">Phone Number</label>
					<span class="srel-icn-wrapper" data-tooltip-key="phone-number" data-html="true">
						<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-help-circle">
							<circle cx="12" cy="12" r="10"></circle>
							<path d="M9.09 9a3 3 0 015.83 1c0 2-3 3-3 3M12 17h.01"></path>
						</svg>
					</span>
					<br />
					<label class="switch mt-1">
						<input type="checkbox" name="phone_number" value="1" <?php ( isset( $settings['phone_number'] ) && 1 === ( $settings['phone_number'] ) ) ? print 'checked' : ''; ?>>
						<span class="slider round"></span>
					</label>
				</div>
				<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
					<label for="comment_box" class="form-label">Comment Box</label>
					<span class="srel-icn-wrapper" data-tooltip-key="comment-box">
						<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-help-circle">
							<circle cx="12" cy="12" r="10"></circle>
							<path d="M9.09 9a3 3 0 015.83 1c0 2-3 3-3 3M12 17h.01"></path>
						</svg>
					</span>

					<br />
					<label class="switch mt-1">
						<input type="checkbox" name="comment_box" value="1" <?php ( isset( $settings['comment_box'] ) && 1 === intval( $settings['comment_box'] ) ) ? print 'checked' : ''; ?>>
						<span class="slider round"></span>
					</label>
				</div>
			</div>
			<h4 class="mt-4">Property Rating</h4>
			<hr class="srel-calc-settings-hr">
			<div class="row mt-3">
				<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
					<label for="rating_show_frontend" class="form-label">Show in Frontend</label>
					<span class="srel-icn-wrapper" data-tooltip-key="rating-show-frontend" data-html="true">
						<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-help-circle">
							<circle cx="12" cy="12" r="10"></circle>
							<path d="M9.09 9a3 3 0 015.83 1c0 2-3 3-3 3M12 17h.01"></path>
						</svg>
					</span>
					<br />
					<label class="switch mt-1">
						<input type="checkbox" name="rating_show_frontend" value="1" <?php ( isset( $settings['rating_show_frontend'] ) && 1 === intval( $settings['rating_show_frontend'] ) ) ? print 'checked' : ''; ?>>
						<span class="slider round"></span>
					</label>
				</div>
				<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
					<label for="rating_show_email" class="form-label">Show in Insights Email </label>
					<span class="srel-icn-wrapper" data-tooltip-key="rating-show-email">
						<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-help-circle">
							<circle cx="12" cy="12" r="10"></circle>
							<path d="M9.09 9a3 3 0 015.83 1c0 2-3 3-3 3M12 17h.01"></path>
						</svg>
					</span>
					<br />
					<label class="switch mt-1">
						<input type="checkbox" name="rating_show_email" value="1" <?php ( isset( $settings['rating_show_email'] ) && 1 === intval( $settings['rating_show_email'] ) ) ? print 'checked' : ''; ?>>
						<span class="slider round"></span>
					</label>
				</div>
			</div>
		</div>
		<?php
	}

	private function field_autofill_settings_body() {
		$settings = json_decode( $this->settings, true );
		?>
		<div class="settings-section-wrapper">
			<p>Modify the auto-fill settings to streamline users' Rental Property Form completion. Input the current market averages for the fields below to facilitate quicker property calculations.</p>
			<div class="srel-form-body">
				<div class="row mt-2">
					<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
						<label for="interest_rate" class="form-label">Mortgage Interest Rate (%)</label>
						<span class="srel-icn-wrapper" data-tooltip-key="interest-rate">
							<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-help-circle">
								<circle cx="12" cy="12" r="10"></circle>
								<path d="M9.09 9a3 3 0 015.83 1c0 2-3 3-3 3M12 17h.01"></path>
							</svg>
						</span>
						<input type="text" id="interest_rate" class="form-control" name="interest_rate" value="<?php isset( $settings['interest_rate'] ) && ! empty( $settings['interest_rate'] ) ? print esc_attr( $settings['interest_rate'] ) : ''; ?>">
					</div>
					<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
						<label for="loan_term" class="form-label">Mortgage Loan Term (years)</label>
						<span class="srel-icn-wrapper" data-tooltip-key="loan-term">
							<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-help-circle">
								<circle cx="12" cy="12" r="10"></circle>
								<path d="M9.09 9a3 3 0 015.83 1c0 2-3 3-3 3M12 17h.01"></path>
							</svg>
						</span>
						<input type="text" id="loan_term" class="form-control" name="loan_term" value="<?php isset( $settings['loan_term'] ) && ! empty( $settings['loan_term'] ) ? print esc_attr( $settings['loan_term'] ) : ''; ?>">

					</div>
				</div>
				<div class="row mt-2">
					<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
						<label for="property_tax" class="form-label">Annual Property Tax (%)</label>
						<span class="srel-icn-wrapper" data-tooltip-key="property-tax">
							<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-help-circle">
								<circle cx="12" cy="12" r="10"></circle>
								<path d="M9.09 9a3 3 0 015.83 1c0 2-3 3-3 3M12 17h.01"></path>
							</svg>
						</span>
						<input type="text" id="property_tax" class="form-control" name="property_tax" value="<?php isset( $settings['property_tax'] ) && ! empty( $settings['property_tax'] ) ? print esc_attr( $settings['property_tax'] ) : ''; ?>">
					</div>
					<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
						<label for="vacancy_rate " class="form-label">Annual Vacancy Rate (%)</label>
						<span class="srel-icn-wrapper" data-tooltip-key="vacancy-rate">
							<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-help-circle">
								<circle cx="12" cy="12" r="10"></circle>
								<path d="M9.09 9a3 3 0 015.83 1c0 2-3 3-3 3M12 17h.01"></path>
							</svg>
						</span>
						<input type="text" id="vacancy_rate" class="form-control" name="vacancy_rate" value="<?php isset( $settings['vacancy_rate'] ) && ! empty( $settings['vacancy_rate'] ) ? print esc_attr( $settings['vacancy_rate'] ) : ''; ?>">
					</div>
				</div>
				<div class="row mt-2">
					<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
						<label for="maintenance " class="form-label">Annual Maintenance (%)</label>
						<span class="srel-icn-wrapper" data-tooltip-key="maintenance">
							<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-help-circle">
								<circle cx="12" cy="12" r="10"></circle>
								<path d="M9.09 9a3 3 0 015.83 1c0 2-3 3-3 3M12 17h.01"></path>
							</svg>
						</span>
						<input type="text" id="maintenance" class="form-control" name="maintenance" value="<?php isset( $settings['maintenance'] ) && ! empty( $settings['maintenance'] ) ? print esc_attr( $settings['maintenance'] ) : ''; ?>">
					</div>
					<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
						<label for="insurance" class="form-label">Annual Home Insurance Cost (%)</label>
						<span class="srel-icn-wrapper" data-tooltip-key="insurance">
							<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-help-circle">
								<circle cx="12" cy="12" r="10"></circle>
								<path d="M9.09 9a3 3 0 015.83 1c0 2-3 3-3 3M12 17h.01"></path>
							</svg>
						</span>
						<input type="text" id="insurance" class="form-control" name="insurance" value="<?php isset( $settings['insurance'] ) && ! empty( $settings['insurance'] ) ? print esc_attr( $settings['insurance'] ) : ''; ?>">
					</div>
				</div>
				<div class="row mt-2">
					<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
						<label for="cost_to_sell" class="form-label">Cost to Sell (one time fee) (%)</label>
						<span class="srel-icn-wrapper" data-tooltip-key="cost-to-sell">
							<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-help-circle">
								<circle cx="12" cy="12" r="10"></circle>
								<path d="M9.09 9a3 3 0 015.83 1c0 2-3 3-3 3M12 17h.01"></path>
							</svg>
						</span>
						<input type="text" id="cost_to_sell" class="form-control" name="cost_to_sell" value="<?php isset( $settings['cost_to_sell'] ) && ! empty( $settings['cost_to_sell'] ) ? print esc_attr( $settings['cost_to_sell'] ) : ''; ?>">
					</div>
					<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
						<label for="closing-cost" class="form-label">Closing Cost (%)</label>
						<span class="srel-icn-wrapper" data-tooltip-key="closing-cost">
							<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-help-circle">
								<circle cx="12" cy="12" r="10"></circle>
								<path d="M9.09 9a3 3 0 015.83 1c0 2-3 3-3 3M12 17h.01"></path>
							</svg>
						</span>
						<input type="text" id="closing-cost" class="form-control" name="closing_cost" value="<?php isset( $settings['closing_cost'] ) && ! empty( $settings['closing_cost'] ) ? print esc_attr( $settings['closing_cost'] ) : ''; ?>">
					</div>
				</div>
				<div class="row mt-2">
					<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
						<label for="cost_to_sell" class="form-label">Annual Rent Increase (%)</label>
						<span class="srel-icn-wrapper" data-tooltip-key="annual-rent-increase">
							<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-help-circle">
								<circle cx="12" cy="12" r="10"></circle>
								<path d="M9.09 9a3 3 0 015.83 1c0 2-3 3-3 3M12 17h.01"></path>
							</svg>
						</span>
						<input type="text" id="annual_rent_increase" class="form-control" name="annual_rent_increase" value="<?php isset( $settings['annual_rent_increase'] ) && ! empty( $settings['annual_rent_increase'] ) ? print esc_attr( $settings['annual_rent_increase'] ) : ''; ?>">
					</div>
					<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
						<label for="closing-cost" class="form-label">Annual Expense Increase (%)</label>
						<span class="srel-icn-wrapper" data-tooltip-key="annual-expense-increase">
							<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-help-circle">
								<circle cx="12" cy="12" r="10"></circle>
								<path d="M9.09 9a3 3 0 015.83 1c0 2-3 3-3 3M12 17h.01"></path>
							</svg>
						</span>
						<input type="text" id="annual_expense_increase" class="form-control" name="annual_expense_increase" value="<?php isset( $settings['annual_expense_increase'] ) && ! empty( $settings['annual_expense_increase'] ) ? print esc_attr( $settings['annual_expense_increase'] ) : ''; ?>">
					</div>
				</div>
			</div>
		</div>
		<?php
	}
	private function field_brand_settings_body() {
		$assets_path = $this->assets_path;
		$settings    = json_decode( $this->settings, true );
		$is_premium_version_active = $this->is_premium_version_active;
		?>
		<div class="settings-section-wrapper">
			<div class="srel-form-body">
				<div class="row mt-2">
					<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
						<label for="logo" class="form-label">Logo</label>
						<span class="srel-icn-wrapper" data-tooltip-key="logo">
							<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-help-circle">
								<circle cx="12" cy="12" r="10"></circle>
								<path d="M9.09 9a3 3 0 015.83 1c0 2-3 3-3 3M12 17h.01"></path>
							</svg>
						</span>
						<div class="input-group mb-3">
							<div class="input-group-prepend">
								<button class="upload-btn" data-id="logo"><img src="<?php echo esc_url( $assets_path . '/images/attachment.png' ); ?>"></button>
							</div>
							<input type="text" id="logo" class="form-control" name="logo" value="<?php isset( $settings['logo'] ) && ! empty( $settings['logo'] ) ? print esc_attr( $settings['logo'] ) : ''; ?>">
						</div>
					</div>
					<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
						<label for="primary_color " class="form-label">Primary Color</label>
						<span class="srel-icn-wrapper" data-tooltip-key="primary-color">
							<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-help-circle">
								<circle cx="12" cy="12" r="10"></circle>
								<path d="M9.09 9a3 3 0 015.83 1c0 2-3 3-3 3M12 17h.01"></path>
							</svg>
						</span>
						<br />
						<input type="text" id="primary_color" class="form-control srel-color-field mt-2" name="primary_color" value="<?php isset( $settings['primary_color'] ) && ! empty( $settings['primary_color'] ) ? print esc_attr( $settings['primary_color'] ) : ''; ?>">
					</div>
				</div>
				<div class="row mt-3">
					<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
						<label for="primary_email_text_color" class="form-label">Primary Text Color (Email)</label>
						<span class="srel-icn-wrapper" data-tooltip-key="primary-text-color">
							<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-help-circle">
								<circle cx="12" cy="12" r="10"></circle>
								<path d="M9.09 9a3 3 0 015.83 1c0 2-3 3-3 3M12 17h.01"></path>
							</svg>
						</span>
						<br />
						<input type="text" id="primary_email_text_color" class="form-control srel-color-field mt-2 mt-2" name="primary_email_text_color" value="<?php isset( $settings['primary_email_text_color'] ) && ! empty( $settings['primary_email_text_color'] ) ? print esc_attr( $settings['primary_email_text_color'] ) : ''; ?>">
					</div>
					<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
						<label for="email_background_color" class="form-label">Email Background Color</label>
						<span class="srel-icn-wrapper" data-tooltip-key="email-bg-color">
							<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-help-circle">
								<circle cx="12" cy="12" r="10"></circle>
								<path d="M9.09 9a3 3 0 015.83 1c0 2-3 3-3 3M12 17h.01"></path>
							</svg>
						</span>
						<br />
						<input type="text" id="email_background_color" class="form-control srel-color-field mt-2" name="email_background_color" value="<?php isset( $settings['email_background_color'] ) && ! empty( $settings['email_background_color'] ) ? print esc_attr( $settings['email_background_color'] ) : ''; ?>">
					</div>
					<div class="row mt-3">
						<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
							<label for="title_and_text_color" class="form-label">Title & Button Text Color</label>
							<span class="srel-icn-wrapper" data-tooltip-key="title-and-text-color">
								<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-help-circle">
									<circle cx="12" cy="12" r="10"></circle>
									<path d="M9.09 9a3 3 0 015.83 1c0 2-3 3-3 3M12 17h.01"></path>
								</svg>
							</span>
							<br />
							<input type="text" id="title_and_text_color" class="form-control srel-color-field mt-2" name="title_and_text_color" value="<?php isset( $settings['title_and_text_color'] ) && ! empty( $settings['title_and_text_color'] ) ? print esc_attr( $settings['title_and_text_color'] ) : ''; ?>">
						</div>
					</div>
					<div class="row mt-3 <?php echo $is_premium_version_active ? '' : 'disabled-overlay pt-3 pb-5'; ?>">
						<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
							<label for="cta_button_animation" class="form-label">Animated CTA Buttons</label>
							<span class="srel-icn-wrapper" data-tooltip-key="cta-button-animation-tt">
								<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-help-circle">
									<circle cx="12" cy="12" r="10"></circle>
									<path d="M9.09 9a3 3 0 015.83 1c0 2-3 3-3 3M12 17h.01"></path>
								</svg>
							</span>
							<br />
						
							<select id="cta_button_animation" class="form-control mt-2" name="cta_button_animation" id="" placeholder="Select style">
								<option value="">Select style</option>
								<option value="style_1" <?php echo ( isset( $settings['cta_button_animation'] ) && $is_premium_version_active && $settings['cta_button_animation'] == 'style_1' ) ? 'selected' : ''; ?>>Style 1</option>
								<option value="style_2" <?php echo ( isset( $settings['cta_button_animation'] ) && $is_premium_version_active && $settings['cta_button_animation'] == 'style_2' ) ? 'selected' : ''; ?>>Style 2</option>
							</select>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php
	}
	private function field_email_settings_body() {
		$settings                  = json_decode( $this->settings, true );
		$admin_email               = get_option( 'admin_email' );
		$is_premium_version_active = $this->is_premium_version_active;
		$assets_path               = $this->assets_path;
		?>
		<div class="settings-section-wrapper">
			<div class="row mt-2 text-lg-end">
				<div class="text-primary mb-0 w-100" role="button" onclick="toggleShortCodes()">Shortcodes</div>
			</div>
			<div id="email_form_short_codes_section" style="display: none; background: rgb(221, 223, 248); padding: 20px; margin-bottom: 10px;">
				<strong>
					<p>NOTE: Use these shortcodes to customize your email body to your customers.</p>
				</strong>
				<p>Customer's Name &lt;user-first-name&gt;</p>
				<p>Customer Phone &lt;user-phone-number&gt;</p>
				<p>Customer Email &lt;user-email&gt;</p>
				<p>First House Address &lt;user-first-house-addr&gt;</p>
				<p>First House Rating &lt;user-first-house-rating&gt;</p>
			</div>
			<div class="srel-form-body">
				<div class="row mt-2">
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
						<label class="form-label">Subject</label>
						<span class="srel-icn-wrapper" data-tooltip-key="email-subject">
							<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-help-circle">
								<circle cx="12" cy="12" r="10"></circle>
								<path d="M9.09 9a3 3 0 015.83 1c0 2-3 3-3 3M12 17h.01"></path>
							</svg>
						</span>
						<input type="text" class="form-control" name="subject" value="<?php isset( $settings['subject'] ) && ! empty( $settings['subject'] ) ? print esc_attr( $settings['subject'] ) : ''; ?>">
					</div>
					<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
						<label class="form-label">From</label>
						<span class="srel-icn-wrapper" data-tooltip-key="email-to">
							<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-help-circle">
								<circle cx="12" cy="12" r="10"></circle>
								<path d="M9.09 9a3 3 0 015.83 1c0 2-3 3-3 3M12 17h.01"></path>
							</svg>
						</span>
						<input type="text" class="form-control" name="to" value="<?php isset( $settings['to'] ) && ! empty( $settings['to'] ) ? print esc_attr( $settings['to'] ) : print $admin_email; ?>">
					</div>
				</div>
				<div class="row mt-2">
					<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
						<label class="form-label">Cc</label>
						<span class="srel-icn-wrapper" data-tooltip-key="email-cc">
							<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-help-circle">
								<circle cx="12" cy="12" r="10"></circle>
								<path d="M9.09 9a3 3 0 015.83 1c0 2-3 3-3 3M12 17h.01"></path>
							</svg>
						</span>
						<input type="text" class="form-control" name="cc" value="<?php isset( $settings['cc'] ) && ! empty( $settings['cc'] ) ? print esc_attr( $settings['cc'] ) : ''; ?>">
					</div>
					<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
						<label class="form-label">Bcc</label>
						<span class="srel-icn-wrapper" data-tooltip-key="email-bcc">
							<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-help-circle">
								<circle cx="12" cy="12" r="10"></circle>
								<path d="M9.09 9a3 3 0 015.83 1c0 2-3 3-3 3M12 17h.01"></path>
							</svg>
						</span>
						<input type="text" class="form-control" name="bcc" value="<?php isset( $settings['bcc'] ) && ! empty( $settings['bcc'] ) ? print esc_attr( $settings['bcc'] ) : ''; ?>">
					</div>
				</div>
				<h4 class="mt-4">Email Body</h4>
				<div class="row mt-2">
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
						<label class="form-label">Email Heading</label>
						<span class="srel-icn-wrapper" data-tooltip-key="email-heading">
							<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-help-circle">
								<circle cx="12" cy="12" r="10"></circle>
								<path d="M9.09 9a3 3 0 015.83 1c0 2-3 3-3 3M12 17h.01"></path>
							</svg>
						</span>
						<?php
						$content = isset( $settings['email_heading'] ) && ! empty( $settings['email_heading'] ) ? wp_kses_post( $settings['email_heading'] ) : '';
						if ( $is_premium_version_active ) {
							wp_editor( $content, 'email_heading' ); // Display the wp_editor field
						}
						?>
					</div>
				</div>
				<div class="row mt-2">
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
						<label class="form-label">Body</label>
						<span class="srel-icn-wrapper" data-tooltip-key="email-body">
							<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-help-circle">
								<circle cx="12" cy="12" r="10"></circle>
								<path d="M9.09 9a3 3 0 015.83 1c0 2-3 3-3 3M12 17h.01"></path>
							</svg>
						</span>
						<?php
						$content = isset( $settings['email_body'] ) && ! empty( $settings['email_body'] ) ? wp_kses_post( $settings['email_body'] ) : '';
						wp_editor( $content, 'email_body' ); // Display the wp_editor field
						?>
					</div>
				</div>
				<h4 class="mt-4">Footer</h4>
				<hr class="srel-calc-settings-hr">
				<div class="row mt-3">
					<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
						<label for="title" class="form-label">Footer Title</label>
						<span class="srel-icn-wrapper" data-tooltip-key="footer-title">
							<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-help-circle">
								<circle cx="12" cy="12" r="10"></circle>
								<path d="M9.09 9a3 3 0 015.83 1c0 2-3 3-3 3M12 17h.01"></path>
							</svg>
						</span>
						<input type="text" id="v" class="form-control" name="title" value="<?php isset( $settings['title'] ) && ! empty( $settings['title'] ) ? print esc_attr( $settings['title'] ) : ''; ?>">
					</div>
					<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
						<label for="realtor_image" class="form-label">Realtor Image</label>
						<span class="srel-icn-wrapper" data-tooltip-key="realtor-image">
							<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-help-circle">
								<circle cx="12" cy="12" r="10"></circle>
								<path d="M9.09 9a3 3 0 015.83 1c0 2-3 3-3 3M12 17h.01"></path>
							</svg>
						</span>
						<div class="input-group mb-3">
							<div class="input-group-prepend">
								<button class="upload-btn" data-id="realtor_image"><img src="<?php echo esc_url( $assets_path . '/images/attachment.png' ); ?>"></button>
							</div>
							<input type="text" id="realtor_image" class="form-control" name="realtor_image" value="<?php isset( $settings['realtor_image'] ) && ! empty( $settings['realtor_image'] ) ? print esc_attr( $settings['realtor_image'] ) : ''; ?>">
						</div>
					</div>
				</div>
				<div class="row mt-2">
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
						<label for="realtor_footer_message" class="form-label">Realtor Footer Message</label>
						<span class="srel-icn-wrapper" data-tooltip-key="realtor-footer-message">
							<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-help-circle">
								<circle cx="12" cy="12" r="10"></circle>
								<path d="M9.09 9a3 3 0 015.83 1c0 2-3 3-3 3M12 17h.01"></path>
							</svg>
						</span>
						<?php
						$content = isset( $settings['realtor_footer_message'] ) && ! empty( $settings['realtor_footer_message'] ) ? wp_kses_post( $settings['realtor_footer_message'] ) : '';
						wp_editor( $content, 'realtor_footer_message' ); // Display the wp_editor field
						?>
					</div>
				</div>
				<hr class="srel-calc-settings-hr">
				<div class="srel-form-body">
					<div class="accordion">
						<?php
						foreach ( $this->cta_buttons as $index => $button ) {
							?>
							<div class="row">
								<button class="accordion-button bg-white collapsed p-1 pt-3 pb-3 " type="button" data-bs-toggle="collapse" data-bs-target="#<?php echo $button; ?>" aria-expanded="true">
									<h3 class="srel-subtitle p-0"><?php echo $index; ?></h3>
								</button>
							</div>
							<hr class="srel-calc-settings-hr">
							<div id="<?php echo $button; ?>" class="accordion-collapse collapse <?php echo $is_premium_version_active ? '' : 'disabled-overlay'; ?>">
								<div class="accordion-body p-1 pt-3 pb-3">
									<div class="row mt-3">
										<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
											<label for="title" class="form-label">Title</label>
											<span class="srel-icn-wrapper" data-tooltip-key="cta-title">
												<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-help-circle">
													<circle cx="12" cy="12" r="10"></circle>
													<path d="M9.09 9a3 3 0 015.83 1c0 2-3 3-3 3M12 17h.01"></path>
												</svg>
											</span>
											<input type="text" id="title" class="form-control" name="<?php echo $button; ?>[title]" value="<?php isset( $settings[ $button ]['title'] ) && ! empty( $settings[ $button ]['title'] ) ? print esc_attr( $settings[ $button ]['title'] ) : ''; ?>" abc="<?php echo $settings[ $button ]['title']; ?>">
										</div>
										<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
											<label for="text_color" class="form-label">Text color</label>
											<span class="srel-icn-wrapper" data-tooltip-key="cta-text-color">
												<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-help-circle">
													<circle cx="12" cy="12" r="10"></circle>
													<path d="M9.09 9a3 3 0 015.83 1c0 2-3 3-3 3M12 17h.01"></path>
												</svg>
											</span>
											<input type="text" id="page" class="form-control srel-color-field" name="<?php echo $button; ?>[text_color]" value="<?php isset( $settings[ $button ]['text_color'] ) && ! empty( $settings[ $button ]['text_color'] ) ? print esc_attr( $settings[ $button ]['text_color'] ) : ''; ?>">
										</div>
									</div>
									<div class="row mt-3">
										<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
											<label for="text" class="form-label">Text</label>
											<span class="srel-icn-wrapper" data-tooltip-key="cta-text">
												<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-help-circle">
													<circle cx="12" cy="12" r="10"></circle>
													<path d="M9.09 9a3 3 0 015.83 1c0 2-3 3-3 3M12 17h.01"></path>
												</svg>
											</span>
											<input type="text" id="text" class="form-control" name="<?php echo $button; ?>[text]" value="<?php isset( $settings[ $button ]['text'] ) && ! empty( $settings[ $button ]['text'] ) ? print esc_attr( $settings[ $button ]['text'] ) : ''; ?>">
										</div>
										<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
											<label for="link" class="form-label">Link</label>
											<span class="srel-icn-wrapper" data-tooltip-key="cta-link">
												<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-help-circle">
													<circle cx="12" cy="12" r="10"></circle>
													<path d="M9.09 9a3 3 0 015.83 1c0 2-3 3-3 3M12 17h.01"></path>
												</svg>
											</span>
											<input type="text" id="page" class="form-control" name="<?php echo $button; ?>[link]" value="<?php isset( $settings[ $button ]['link'] ) && ! empty( $settings[ $button ]['link'] ) ? print esc_attr( $settings[ $button ]['link'] ) : ''; ?>">
										</div>
									</div>
								</div>
							</div>

							<?php
						}
						?>
					</div>
				</div>
			</div>
		</div>
		<?php
	}
	private function field_webhook_settings_body() {
		$settings = json_decode( $this->settings, true );
		?>
		<div class="settings-section-wrapper">
			<div class="srel-form-body">
				<div class="row mt-3">
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
						<label for="webhook" class="form-label">Webhook</label>
						<span class="srel-icn-wrapper" data-tooltip-key="webhook">
							<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-help-circle">
								<circle cx="12" cy="12" r="10"></circle>
								<path d="M9.09 9a3 3 0 015.83 1c0 2-3 3-3 3M12 17h.01"></path>
							</svg>
						</span>
						<input type="text" id="webhook" class="form-control" name="webhook_url" value="<?php isset( $settings['webhook_url'] ) && ! empty( $settings['webhook_url'] ) ? print esc_attr( $settings['webhook_url'] ) : ''; ?>">
					</div>
				</div>
			</div>
		</div>
		<?php
	}
	private function field_thank_you_page_settings_body() {
		$settings = json_decode( $this->settings, true );
		?>
		<div class="settings-section-wrapper">
			<div class="srel-form-body">
				<div class="row mt-3">
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
						<label for="page" class="form-label">Page</label>
						<span class="srel-icn-wrapper" data-tooltip-key="thank-page">
							<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-help-circle">
								<circle cx="12" cy="12" r="10"></circle>
								<path d="M9.09 9a3 3 0 015.83 1c0 2-3 3-3 3M12 17h.01"></path>
							</svg>
						</span>
						<input type="text" id="page" class="form-control" name="thank_you_page" value="<?php isset( $settings['thank_you_page'] ) && ! empty( $settings['thank_you_page'] ) ? print esc_attr( $settings['thank_you_page'] ) : ''; ?>">
					</div>
				</div>
			</div>
		</div>
		<?php
	}

	private function output_settings_header( $card_props ) {
		$settings_slug = preg_replace( '~[^\pL\d]+~u', '_', $card_props['name'] );
		$settings_slug = trim( $settings_slug, '_' );
		$settings_slug = strtolower( $settings_slug );
		$allowed_on_free_version = isset( $card_props['allow_on_free_version'] ) && $card_props['allow_on_free_version'];
		$accordion_classes = $this->is_premium_version_active || $allowed_on_free_version ? '' : 'disabled-overlay';
		?>
		<div class="accordion-item" style="max-width: 55rem;">
			<h2 class="accordion-header">
				<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#accordion-<?php echo esc_attr( $settings_slug ); ?>" aria-expanded="true" aria-controls="<?php echo 'accordion-' . esc_attr( $settings_slug ); ?>">
					<?php
					echo esc_attr( $card_props['name'] );
					echo isset( $card_props['helpdesk_link'] ) ? ' ' . scc_get_kses_extended_ruleset( $card_props['helpdesk_link'] ) : '';
					?>
				</button>
			</h2>
			<div id="<?php echo 'accordion-' . esc_attr( $settings_slug ); ?>" class="accordion-collapse collapse" data-bs-parent="#settings-page-accordion">
				<div class="accordion-body <?php echo $accordion_classes; ?>">
					<?php if ( isset( $card_props['hasShortcodes'] ) && $card_props['hasShortcodes'] ) : ?>
						<div class="text-primary mb-0" role="button" onclick="toggleShortCodes()">Shortcodes</div>
					<?php endif ?>
					<?php
					for ( $i = 0; $i < count( $card_props['fields'] ); $i++ ) {
						call_user_func( array( $this, 'field_' . $card_props['fields'][ $i ] ) );
					}
					?>
					<?php if ( isset( $card_props['notes'] ) ) : ?>
						<p><?php echo esc_attr( $card_props['notes'] ); ?></p>
					<?php endif; ?>
					<?php if ( isset( $card_props['action_btn'] ) && $card_props['action_cb'] ) : ?>
						<div class="d-flex w-100 justify-content-between">
							<p class="mb-0 notice-text"></p>
							<button type="button" class="btn btn-primary btn-lg" id="<?php echo $settings_slug; ?>" onclick="<?php echo esc_attr( $card_props['action_cb'] ); ?>"><?php echo esc_attr( $card_props['action_btn'] ); ?></button>
						</div>
					<?php endif; ?>
					<?php
					if ( isset( $card_props['extra_fragment'] ) ) :
						call_user_func( array( $this, 'extra_fragment_' . $card_props['extra_fragment'] ) );
					endif;
					?>
				</div>
			</div>
		</div>
		<?php
	}
}
new SettingsPage( $settings );
?>
