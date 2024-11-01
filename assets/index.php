<?php

use SREL_Calculator_Lib\Controllers\CalculatorsController;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
require dirname( __DIR__ ) . '/includes/Controllers/CalculatorsController.php';
$calculator = new CalculatorsController();
$calculator = $calculator->read( 1 );
$options    = json_decode( json_encode( $calculator->settings ), true );

$settings   = json_decode( $options, 1 );
?>
<div id="srel-container">
	<div class="srel-calculator">
		<div class="srel-wrapper">
			<div class="srel-button-wrapper srel-property-tabs">
				<button class="srel-tab-button  active"  data-id="first-property" data-tab-title="1">First Property</button>
			</div>
			<div class="srel-content-wrapper srel-property-content">
				<div class="first-property compared active content" id="first-property" >
					<div class="progressbar-container">
						<ul class="progressbar" data-parent="first-property">
							<li class="active">
								<div class="inner-circle"></div>
								<span>1/4</span>
							</li>
							<li class="half-active">
								<div class="inner-circle"></div>
								<span>2/4</span>
							</li>
							<li>
								<div class="inner-circle"></div>
								<span>3/4</span>
							</li>
							<li>
								<div class="inner-circle"></div>
								<span>4/4</span>
							</li>
						</ul>
					</div>
					<div class="srel-button-wrapper srel-cost-btns">
						<button class="srel-tab-button-child active" data-title="purchase" data-step="1"   data-id="purchase-i0" data-id-step="first-property">Purchase
						</button>
						<button class="srel-tab-button-child" data-title="rental-income" data-step="2"    data-id="rental-income-i0" data-id-step="first-property">Rent</button>
						<button class="srel-tab-button-child" data-title="operating-expenses" data-step="3"   data-id="operating-expenses-i0" data-id-step="first-property">Expenses
						</button>
						<button class="srel-tab-button-child" data-title="sell" data-id="sell-i0" data-step="4" data-id-step="first-property">Sell
						</button>
					</div>
					<div  class="content-child active" data-title="purchase" id="purchase-i0">
						<div class="srl-input-section" data-section-id="1">
							<div class="is-inline w-100">
								<div class="srl-m-1">
									<div class="input-wrapper">
										<div class="srl-input-group">
											<div class="input-field-wrapper is-flex pr-0">
												<label for="h_address">House Address
													<span class="tooltip-container" >
													   <svg width="15" height="15" class="tooltip-trigger" title="House Address" body="Enter the complete house address.">
															<g id="surface1">
																<path style="stroke:none;fill-rule:nonzero;fill:#000;fill-opacity:1" d="M7.078 10.625h.938v-3.75h-.938ZM7.5 5.719c.145 0 .27-.047.367-.14a.48.48 0 0 0 .149-.36c0-.145-.051-.27-.149-.375a.482.482 0 0 0-.367-.157c-.145 0-.27.051-.367.157a.535.535 0 0 0-.149.375c0 .144.051.265.149.36.097.093.222.14.367.14Zm0 8.031c-.855 0-1.66-.164-2.422-.492a6.332 6.332 0 0 1-1.992-1.344 6.332 6.332 0 0 1-1.344-1.992 6.095 6.095 0 0 1-.492-2.438c0-.855.164-1.66.492-2.421a6.253 6.253 0 0 1 3.336-3.32 6.095 6.095 0 0 1 2.438-.493c.855 0 1.66.164 2.421.492a6.297 6.297 0 0 1 1.985 1.336 6.297 6.297 0 0 1 1.336 1.985c.328.761.492 1.574.492 2.437 0 .855-.164 1.66-.492 2.422a6.253 6.253 0 0 1-3.32 3.336 6.095 6.095 0 0 1-2.438.492Zm.016-.938c1.468 0 2.718-.519 3.75-1.554 1.03-1.035 1.546-2.293 1.546-3.774 0-1.468-.515-2.718-1.546-3.75C10.234 2.704 8.98 2.188 7.5 2.188c-1.469 0-2.723.515-3.758 1.546C2.707 4.766 2.188 6.02 2.188 7.5c0 1.469.519 2.723 1.554 3.758 1.035 1.035 2.293 1.555 3.774 1.555ZM7.5 7.5Zm0 0"/>
															</g>
														</svg>
													</span>
												</label>
												<div class="is-flex-row">
													<input required type="text" name="h_address" id="h_address">
												</div>
												<p class="srl-d-none srl-m0 srl-warning">Above Field Is Mandatory</p>
											</div>
										</div>
										<div class="srl-input-group">
											<div class="input-field-wrapper is-flex pr-0">
												<label for="purchase_price">Purchase Price
													<span class="tooltip-container" >
													   <svg width="15" height="15" class="tooltip-trigger" title="Purchase Price" body="Specify the purchase price of the property to accurately calculate payments and affordability.">
															<g id="surface1">
																<path style="stroke:none;fill-rule:nonzero;fill:#000;fill-opacity:1" d="M7.078 10.625h.938v-3.75h-.938ZM7.5 5.719c.145 0 .27-.047.367-.14a.48.48 0 0 0 .149-.36c0-.145-.051-.27-.149-.375a.482.482 0 0 0-.367-.157c-.145 0-.27.051-.367.157a.535.535 0 0 0-.149.375c0 .144.051.265.149.36.097.093.222.14.367.14Zm0 8.031c-.855 0-1.66-.164-2.422-.492a6.332 6.332 0 0 1-1.992-1.344 6.332 6.332 0 0 1-1.344-1.992 6.095 6.095 0 0 1-.492-2.438c0-.855.164-1.66.492-2.421a6.253 6.253 0 0 1 3.336-3.32 6.095 6.095 0 0 1 2.438-.493c.855 0 1.66.164 2.421.492a6.297 6.297 0 0 1 1.985 1.336 6.297 6.297 0 0 1 1.336 1.985c.328.761.492 1.574.492 2.437 0 .855-.164 1.66-.492 2.422a6.253 6.253 0 0 1-3.32 3.336 6.095 6.095 0 0 1-2.438.492Zm.016-.938c1.468 0 2.718-.519 3.75-1.554 1.03-1.035 1.546-2.293 1.546-3.774 0-1.468-.515-2.718-1.546-3.75C10.234 2.704 8.98 2.188 7.5 2.188c-1.469 0-2.723.515-3.758 1.546C2.707 4.766 2.188 6.02 2.188 7.5c0 1.469.519 2.723 1.554 3.758 1.035 1.035 2.293 1.555 3.774 1.555ZM7.5 7.5Zm0 0"/>
															</g>
														</svg>
													</span>
												</label>
												<div class="srel-input-group-prepend">
													<input class="btn btn-success" type="button" value="$"/>
													<input required data-numeric-input="1" type="text" name="purchase_price" id="purchase_price">
												</div>
												<p class="srl-d-none srl-m0 srl-warning">Above Field Is Mandatory</p>
											</div>
											<div class="input-field-wrapper is-flex pr-0">
												<label for="closing_cost">Closing Cost
													<span class="tooltip-container" >
													   <svg width="15" height="15" class="tooltip-trigger" title="Closing Cost" body="Include the estimated closing costs to get a comprehensive view of your total expenses when calculating.">
															<g id="surface1">
																<path style="stroke:none;fill-rule:nonzero;fill:#000;fill-opacity:1" d="M7.078 10.625h.938v-3.75h-.938ZM7.5 5.719c.145 0 .27-.047.367-.14a.48.48 0 0 0 .149-.36c0-.145-.051-.27-.149-.375a.482.482 0 0 0-.367-.157c-.145 0-.27.051-.367.157a.535.535 0 0 0-.149.375c0 .144.051.265.149.36.097.093.222.14.367.14Zm0 8.031c-.855 0-1.66-.164-2.422-.492a6.332 6.332 0 0 1-1.992-1.344 6.332 6.332 0 0 1-1.344-1.992 6.095 6.095 0 0 1-.492-2.438c0-.855.164-1.66.492-2.421a6.253 6.253 0 0 1 3.336-3.32 6.095 6.095 0 0 1 2.438-.493c.855 0 1.66.164 2.421.492a6.297 6.297 0 0 1 1.985 1.336 6.297 6.297 0 0 1 1.336 1.985c.328.761.492 1.574.492 2.437 0 .855-.164 1.66-.492 2.422a6.253 6.253 0 0 1-3.32 3.336 6.095 6.095 0 0 1-2.438.492Zm.016-.938c1.468 0 2.718-.519 3.75-1.554 1.03-1.035 1.546-2.293 1.546-3.774 0-1.468-.515-2.718-1.546-3.75C10.234 2.704 8.98 2.188 7.5 2.188c-1.469 0-2.723.515-3.758 1.546C2.707 4.766 2.188 6.02 2.188 7.5c0 1.469.519 2.723 1.554 3.758 1.035 1.035 2.293 1.555 3.774 1.555ZM7.5 7.5Zm0 0"/>
															</g>
														</svg>
													</span>
												</label>
												<div class="srel-input-group-prepend">
													<input class="btn btn-success" type="button" value="$">
													<input required data-numeric-input="1" type="text" name="closing_cost" id="closing_cost">
												</div>
												<p class="srl-d-none srl-m0 srl-warning">Above Field Is Mandatory</p>
											</div>
										</div>
										<div class="srl-input-group">
											<div class="input-field-wrapper is-flex pr-0">
												<label for="interest">Mortgage Interest Rate
													<span class="tooltip-container" >
													   <svg width="15" height="15" class="tooltip-trigger" title="Mortage Interest Rate (yearly)" body="Specify the interest rate on your mortgage loan (yearly) to accurately calculate mortgage payments and understand the impact on your overall loan cost.">
															<g id="surface1">
																<path style="stroke:none;fill-rule:nonzero;fill:#000;fill-opacity:1" d="M7.078 10.625h.938v-3.75h-.938ZM7.5 5.719c.145 0 .27-.047.367-.14a.48.48 0 0 0 .149-.36c0-.145-.051-.27-.149-.375a.482.482 0 0 0-.367-.157c-.145 0-.27.051-.367.157a.535.535 0 0 0-.149.375c0 .144.051.265.149.36.097.093.222.14.367.14Zm0 8.031c-.855 0-1.66-.164-2.422-.492a6.332 6.332 0 0 1-1.992-1.344 6.332 6.332 0 0 1-1.344-1.992 6.095 6.095 0 0 1-.492-2.438c0-.855.164-1.66.492-2.421a6.253 6.253 0 0 1 3.336-3.32 6.095 6.095 0 0 1 2.438-.493c.855 0 1.66.164 2.421.492a6.297 6.297 0 0 1 1.985 1.336 6.297 6.297 0 0 1 1.336 1.985c.328.761.492 1.574.492 2.437 0 .855-.164 1.66-.492 2.422a6.253 6.253 0 0 1-3.32 3.336 6.095 6.095 0 0 1-2.438.492Zm.016-.938c1.468 0 2.718-.519 3.75-1.554 1.03-1.035 1.546-2.293 1.546-3.774 0-1.468-.515-2.718-1.546-3.75C10.234 2.704 8.98 2.188 7.5 2.188c-1.469 0-2.723.515-3.758 1.546C2.707 4.766 2.188 6.02 2.188 7.5c0 1.469.519 2.723 1.554 3.758 1.035 1.035 2.293 1.555 3.774 1.555ZM7.5 7.5Zm0 0"/>
															</g>
														</svg>
													</span>
												</label>
												<div class="srel-input-group-prepend">
													<input class="btn btn-success" type="button" value="%">
													<input required type="text" name="interest" id="interest">
												</div>
												<p class="srl-d-none srl-m0 srl-warning">Above Field Is Mandatory</p>
											</div>
											<div class="input-field-wrapper is-flex pr-0">
												<label for="years">Mortgage Loan Term
													<span class="tooltip-container" >
													   <svg width="15" height="15" class="tooltip-trigger" title="Mortgage Loan Term" body="Enter the loan term in years to determine the duration of your mortgage and estimate monthly payments accordingly.">
															<g id="surface1">
																<path style="stroke:none;fill-rule:nonzero;fill:#000;fill-opacity:1" d="M7.078 10.625h.938v-3.75h-.938ZM7.5 5.719c.145 0 .27-.047.367-.14a.48.48 0 0 0 .149-.36c0-.145-.051-.27-.149-.375a.482.482 0 0 0-.367-.157c-.145 0-.27.051-.367.157a.535.535 0 0 0-.149.375c0 .144.051.265.149.36.097.093.222.14.367.14Zm0 8.031c-.855 0-1.66-.164-2.422-.492a6.332 6.332 0 0 1-1.992-1.344 6.332 6.332 0 0 1-1.344-1.992 6.095 6.095 0 0 1-.492-2.438c0-.855.164-1.66.492-2.421a6.253 6.253 0 0 1 3.336-3.32 6.095 6.095 0 0 1 2.438-.493c.855 0 1.66.164 2.421.492a6.297 6.297 0 0 1 1.985 1.336 6.297 6.297 0 0 1 1.336 1.985c.328.761.492 1.574.492 2.437 0 .855-.164 1.66-.492 2.422a6.253 6.253 0 0 1-3.32 3.336 6.095 6.095 0 0 1-2.438.492Zm.016-.938c1.468 0 2.718-.519 3.75-1.554 1.03-1.035 1.546-2.293 1.546-3.774 0-1.468-.515-2.718-1.546-3.75C10.234 2.704 8.98 2.188 7.5 2.188c-1.469 0-2.723.515-3.758 1.546C2.707 4.766 2.188 6.02 2.188 7.5c0 1.469.519 2.723 1.554 3.758 1.035 1.035 2.293 1.555 3.774 1.555ZM7.5 7.5Zm0 0"/>
															</g>
														</svg>
													</span>
												</label>
												<div class="srel-input-group-append">
													<input required type="text" name="years" id="years">
													<input class="btn btn-success" type="button" value="years">
												</div>
												<p class="srl-d-none srl-m0 srl-warning">Above Field Is Mandatory</p>
											</div>
										</div>
										<div class="srl-input-group">
											<div class="input-field-wrapper is-flex pr-0">
												<label for="down_payment">Down Payment
													<span class="tooltip-container" >
													   <svg width="15" height="15" class="tooltip-trigger" title="Down Payment" body="Provide the down payment amount to assess your mortgage affordability and calculate accurate monthly payment estimates.">
															<g id="surface1">
																<path style="stroke:none;fill-rule:nonzero;fill:#000;fill-opacity:1" d="M7.078 10.625h.938v-3.75h-.938ZM7.5 5.719c.145 0 .27-.047.367-.14a.48.48 0 0 0 .149-.36c0-.145-.051-.27-.149-.375a.482.482 0 0 0-.367-.157c-.145 0-.27.051-.367.157a.535.535 0 0 0-.149.375c0 .144.051.265.149.36.097.093.222.14.367.14Zm0 8.031c-.855 0-1.66-.164-2.422-.492a6.332 6.332 0 0 1-1.992-1.344 6.332 6.332 0 0 1-1.344-1.992 6.095 6.095 0 0 1-.492-2.438c0-.855.164-1.66.492-2.421a6.253 6.253 0 0 1 3.336-3.32 6.095 6.095 0 0 1 2.438-.493c.855 0 1.66.164 2.421.492a6.297 6.297 0 0 1 1.985 1.336 6.297 6.297 0 0 1 1.336 1.985c.328.761.492 1.574.492 2.437 0 .855-.164 1.66-.492 2.422a6.253 6.253 0 0 1-3.32 3.336 6.095 6.095 0 0 1-2.438.492Zm.016-.938c1.468 0 2.718-.519 3.75-1.554 1.03-1.035 1.546-2.293 1.546-3.774 0-1.468-.515-2.718-1.546-3.75C10.234 2.704 8.98 2.188 7.5 2.188c-1.469 0-2.723.515-3.758 1.546C2.707 4.766 2.188 6.02 2.188 7.5c0 1.469.519 2.723 1.554 3.758 1.035 1.035 2.293 1.555 3.774 1.555ZM7.5 7.5Zm0 0"/>
															</g>
														</svg>
													</span>
												</label>
												<div class="srel-input-group-prepend">
													<input class="btn btn-success" type="button" value="%">
													<input required type="text" name="down_payment" id="down_payment">
												</div>
												<p class="srl-d-none srl-m0 srl-warning">Above Field Is Mandatory</p>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="content-child" data-title="rental-income"  id="rental-income-i0">
						<div class="srl-input-section" data-section-id="2">
							<div class="is-inline w-100">
								<div class="input-wrapper">
									<div class="srl-input-group">
										<div class="input-field-wrapper is-flex pr-0">
											<label for="monthly_rent">Monthly Rent
												<span class="tooltip-container" >
													   <svg width="15" height="15" class="tooltip-trigger" title="Monthly Rent" body="Input the monthly rent amount to compare it with your potential mortgage payment and evaluate the feasibility of property investment.">
															<g id="surface1">
																<path style="stroke:none;fill-rule:nonzero;fill:#000;fill-opacity:1" d="M7.078 10.625h.938v-3.75h-.938ZM7.5 5.719c.145 0 .27-.047.367-.14a.48.48 0 0 0 .149-.36c0-.145-.051-.27-.149-.375a.482.482 0 0 0-.367-.157c-.145 0-.27.051-.367.157a.535.535 0 0 0-.149.375c0 .144.051.265.149.36.097.093.222.14.367.14Zm0 8.031c-.855 0-1.66-.164-2.422-.492a6.332 6.332 0 0 1-1.992-1.344 6.332 6.332 0 0 1-1.344-1.992 6.095 6.095 0 0 1-.492-2.438c0-.855.164-1.66.492-2.421a6.253 6.253 0 0 1 3.336-3.32 6.095 6.095 0 0 1 2.438-.493c.855 0 1.66.164 2.421.492a6.297 6.297 0 0 1 1.985 1.336 6.297 6.297 0 0 1 1.336 1.985c.328.761.492 1.574.492 2.437 0 .855-.164 1.66-.492 2.422a6.253 6.253 0 0 1-3.32 3.336 6.095 6.095 0 0 1-2.438.492Zm.016-.938c1.468 0 2.718-.519 3.75-1.554 1.03-1.035 1.546-2.293 1.546-3.774 0-1.468-.515-2.718-1.546-3.75C10.234 2.704 8.98 2.188 7.5 2.188c-1.469 0-2.723.515-3.758 1.546C2.707 4.766 2.188 6.02 2.188 7.5c0 1.469.519 2.723 1.554 3.758 1.035 1.035 2.293 1.555 3.774 1.555ZM7.5 7.5Zm0 0"/>
															</g>
														</svg>
													</span>
											</label>
											<div class="srel-input-group-prepend">
												<input class="btn btn-success" type="button" value="$">
												<input data-numeric-input="1" type="text" name="monthly_rent" id="monthly_rent">
											</div>
											<p class="srl-d-none srl-m0 srl-warning">Above Field Is Mandatory</p>
										</div>
										<div class="input-field-wrapper is-flex pr-0">
											<label for="vacancy_rate">Vacancy Rate
												<span class="tooltip-container" >
													   <svg width="15" height="15" class="tooltip-trigger" title="Vacancy Rate" body="Include the estimated vacancy rate to account for potential rental income gaps and accurately assess your mortgage affordability.">
															<g id="surface1">
																<path style="stroke:none;fill-rule:nonzero;fill:#000;fill-opacity:1" d="M7.078 10.625h.938v-3.75h-.938ZM7.5 5.719c.145 0 .27-.047.367-.14a.48.48 0 0 0 .149-.36c0-.145-.051-.27-.149-.375a.482.482 0 0 0-.367-.157c-.145 0-.27.051-.367.157a.535.535 0 0 0-.149.375c0 .144.051.265.149.36.097.093.222.14.367.14Zm0 8.031c-.855 0-1.66-.164-2.422-.492a6.332 6.332 0 0 1-1.992-1.344 6.332 6.332 0 0 1-1.344-1.992 6.095 6.095 0 0 1-.492-2.438c0-.855.164-1.66.492-2.421a6.253 6.253 0 0 1 3.336-3.32 6.095 6.095 0 0 1 2.438-.493c.855 0 1.66.164 2.421.492a6.297 6.297 0 0 1 1.985 1.336 6.297 6.297 0 0 1 1.336 1.985c.328.761.492 1.574.492 2.437 0 .855-.164 1.66-.492 2.422a6.253 6.253 0 0 1-3.32 3.336 6.095 6.095 0 0 1-2.438.492Zm.016-.938c1.468 0 2.718-.519 3.75-1.554 1.03-1.035 1.546-2.293 1.546-3.774 0-1.468-.515-2.718-1.546-3.75C10.234 2.704 8.98 2.188 7.5 2.188c-1.469 0-2.723.515-3.758 1.546C2.707 4.766 2.188 6.02 2.188 7.5c0 1.469.519 2.723 1.554 3.758 1.035 1.035 2.293 1.555 3.774 1.555ZM7.5 7.5Zm0 0"/>
															</g>
														</svg>
													</span>
											</label>
											<div class="srel-input-group-prepend">
												<input class="btn btn-success" type="button" value="%">
												<input type="text" name="vacancy_rate" id="vacancy_rate">
											</div>
											<p class="srl-d-none srl-m0 srl-warning">Above Field Is Mandatory</p>
										</div>
									</div>
									<div class="srl-input-group">
										<div class="input-field-wrapper is-flex pr-0">
											<label for="monthly_rent">Annual Rent Increase
												<span class="tooltip-container" >
													   <svg width="15" height="15" class="tooltip-trigger" title="Monthly Rent" body="Input the monthly rent amount to compare it with your potential mortgage payment and evaluate the feasibility of property investment.">
															<g id="surface1">
																<path style="stroke:none;fill-rule:nonzero;fill:#000;fill-opacity:1" d="M7.078 10.625h.938v-3.75h-.938ZM7.5 5.719c.145 0 .27-.047.367-.14a.48.48 0 0 0 .149-.36c0-.145-.051-.27-.149-.375a.482.482 0 0 0-.367-.157c-.145 0-.27.051-.367.157a.535.535 0 0 0-.149.375c0 .144.051.265.149.36.097.093.222.14.367.14Zm0 8.031c-.855 0-1.66-.164-2.422-.492a6.332 6.332 0 0 1-1.992-1.344 6.332 6.332 0 0 1-1.344-1.992 6.095 6.095 0 0 1-.492-2.438c0-.855.164-1.66.492-2.421a6.253 6.253 0 0 1 3.336-3.32 6.095 6.095 0 0 1 2.438-.493c.855 0 1.66.164 2.421.492a6.297 6.297 0 0 1 1.985 1.336 6.297 6.297 0 0 1 1.336 1.985c.328.761.492 1.574.492 2.437 0 .855-.164 1.66-.492 2.422a6.253 6.253 0 0 1-3.32 3.336 6.095 6.095 0 0 1-2.438.492Zm.016-.938c1.468 0 2.718-.519 3.75-1.554 1.03-1.035 1.546-2.293 1.546-3.774 0-1.468-.515-2.718-1.546-3.75C10.234 2.704 8.98 2.188 7.5 2.188c-1.469 0-2.723.515-3.758 1.546C2.707 4.766 2.188 6.02 2.188 7.5c0 1.469.519 2.723 1.554 3.758 1.035 1.035 2.293 1.555 3.774 1.555ZM7.5 7.5Zm0 0"/>
															</g>
														</svg>
													</span>
											</label>
											<div class="srel-input-group-prepend">
												<input class="btn btn-success" type="button" value="%">
												<input data-numeric-input="1" type="text" name="annual_rent_increase" id="annual_rent_increase">
											</div>
											<p class="srl-d-none srl-m0 srl-warning">Above Field Is Mandatory</p>
										</div>
									</div>
									<div class="srl-input-group">
										<div class="input-field-wrapper is-flex srl-d-none pr-0" data-optional-input="1">
											<label for="other_monthly_income">Other Monthly Income
												<span class="tooltip-container" >
													   <svg width="15" height="15" class="tooltip-trigger" title="Other Monthly Income" body="Enter any additional monthly income sources to evaluate their impact on your overall financial capacity and mortgage affordability.">
															<g id="surface1">
																<path style="stroke:none;fill-rule:nonzero;fill:#000;fill-opacity:1" d="M7.078 10.625h.938v-3.75h-.938ZM7.5 5.719c.145 0 .27-.047.367-.14a.48.48 0 0 0 .149-.36c0-.145-.051-.27-.149-.375a.482.482 0 0 0-.367-.157c-.145 0-.27.051-.367.157a.535.535 0 0 0-.149.375c0 .144.051.265.149.36.097.093.222.14.367.14Zm0 8.031c-.855 0-1.66-.164-2.422-.492a6.332 6.332 0 0 1-1.992-1.344 6.332 6.332 0 0 1-1.344-1.992 6.095 6.095 0 0 1-.492-2.438c0-.855.164-1.66.492-2.421a6.253 6.253 0 0 1 3.336-3.32 6.095 6.095 0 0 1 2.438-.493c.855 0 1.66.164 2.421.492a6.297 6.297 0 0 1 1.985 1.336 6.297 6.297 0 0 1 1.336 1.985c.328.761.492 1.574.492 2.437 0 .855-.164 1.66-.492 2.422a6.253 6.253 0 0 1-3.32 3.336 6.095 6.095 0 0 1-2.438.492Zm.016-.938c1.468 0 2.718-.519 3.75-1.554 1.03-1.035 1.546-2.293 1.546-3.774 0-1.468-.515-2.718-1.546-3.75C10.234 2.704 8.98 2.188 7.5 2.188c-1.469 0-2.723.515-3.758 1.546C2.707 4.766 2.188 6.02 2.188 7.5c0 1.469.519 2.723 1.554 3.758 1.035 1.035 2.293 1.555 3.774 1.555ZM7.5 7.5Zm0 0"/>
															</g>
														</svg>
													</span>
											</label>
											<div class="srel-input-group-prepend">
												<input class="btn btn-success" type="button" value="$">
												<input data-numeric-input="1" type="text" name="other_monthly_income" id="other_monthly_income">
											</div>
											<p class="srl-d-none srl-m0 srl-warning">Above Field Is Mandatory</p>
										</div>
										<div class="input-field-wrapper is-flex srl-d-none pr-0" data-optional-input="1">
											<label for="management_fee">Management Fee
												<span class="tooltip-container" >
													   <svg width="15" height="15" class="tooltip-trigger" title="Management Fee" body="Consider the mortgage fee or associated costs to calculate the total expense of your mortgage accurately and determine affordability.">
															<g id="surface1">
																<path style="stroke:none;fill-rule:nonzero;fill:#000;fill-opacity:1" d="M7.078 10.625h.938v-3.75h-.938ZM7.5 5.719c.145 0 .27-.047.367-.14a.48.48 0 0 0 .149-.36c0-.145-.051-.27-.149-.375a.482.482 0 0 0-.367-.157c-.145 0-.27.051-.367.157a.535.535 0 0 0-.149.375c0 .144.051.265.149.36.097.093.222.14.367.14Zm0 8.031c-.855 0-1.66-.164-2.422-.492a6.332 6.332 0 0 1-1.992-1.344 6.332 6.332 0 0 1-1.344-1.992 6.095 6.095 0 0 1-.492-2.438c0-.855.164-1.66.492-2.421a6.253 6.253 0 0 1 3.336-3.32 6.095 6.095 0 0 1 2.438-.493c.855 0 1.66.164 2.421.492a6.297 6.297 0 0 1 1.985 1.336 6.297 6.297 0 0 1 1.336 1.985c.328.761.492 1.574.492 2.437 0 .855-.164 1.66-.492 2.422a6.253 6.253 0 0 1-3.32 3.336 6.095 6.095 0 0 1-2.438.492Zm.016-.938c1.468 0 2.718-.519 3.75-1.554 1.03-1.035 1.546-2.293 1.546-3.774 0-1.468-.515-2.718-1.546-3.75C10.234 2.704 8.98 2.188 7.5 2.188c-1.469 0-2.723.515-3.758 1.546C2.707 4.766 2.188 6.02 2.188 7.5c0 1.469.519 2.723 1.554 3.758 1.035 1.035 2.293 1.555 3.774 1.555ZM7.5 7.5Zm0 0"/>
															</g>
														</svg>
													</span>
											</label>
											<div class="srel-input-group-prepend">
												<input class="btn btn-success" type="button" value="$">
												<input type="text" name="management_fee" id="management_fee">
											</div>
											<p class="srl-d-none srl-m0 srl-warning">Above Field Is Mandatory</p>
										</div>
									</div>
								</div>
								<p class="more-opts" data-parent-section-id="2">More Options ></p>
							</div>
						</div>
					</div>
					<div class="content-child" data-title="operating-expenses"   id="operating-expenses-i0">
						<div class="srl-input-section" data-section-id="3">
							<div class="is-inline w-100">
								<div class="input-wrapper">
									<div class="srl-input-group">
										<div class="input-field-wrapper is-flex srel-append pr-0" >
											<label for="property_tax">Property Tax (yearly)
												<span class="tooltip-container" >
													   <svg width="15" height="15" class="tooltip-trigger" title="Property Tax (yearly)" body="Incorporate the property tax amount yearly to accurately estimate your total housing expenses and determine the affordability of your mortgage.">
															<g id="surface1">
																<path style="stroke:none;fill-rule:nonzero;fill:#000;fill-opacity:1" d="M7.078 10.625h.938v-3.75h-.938ZM7.5 5.719c.145 0 .27-.047.367-.14a.48.48 0 0 0 .149-.36c0-.145-.051-.27-.149-.375a.482.482 0 0 0-.367-.157c-.145 0-.27.051-.367.157a.535.535 0 0 0-.149.375c0 .144.051.265.149.36.097.093.222.14.367.14Zm0 8.031c-.855 0-1.66-.164-2.422-.492a6.332 6.332 0 0 1-1.992-1.344 6.332 6.332 0 0 1-1.344-1.992 6.095 6.095 0 0 1-.492-2.438c0-.855.164-1.66.492-2.421a6.253 6.253 0 0 1 3.336-3.32 6.095 6.095 0 0 1 2.438-.493c.855 0 1.66.164 2.421.492a6.297 6.297 0 0 1 1.985 1.336 6.297 6.297 0 0 1 1.336 1.985c.328.761.492 1.574.492 2.437 0 .855-.164 1.66-.492 2.422a6.253 6.253 0 0 1-3.32 3.336 6.095 6.095 0 0 1-2.438.492Zm.016-.938c1.468 0 2.718-.519 3.75-1.554 1.03-1.035 1.546-2.293 1.546-3.774 0-1.468-.515-2.718-1.546-3.75C10.234 2.704 8.98 2.188 7.5 2.188c-1.469 0-2.723.515-3.758 1.546C2.707 4.766 2.188 6.02 2.188 7.5c0 1.469.519 2.723 1.554 3.758 1.035 1.035 2.293 1.555 3.774 1.555ZM7.5 7.5Zm0 0"/>
															</g>
														</svg>
													</span>
											</label>
											<div class="srel-input-group-prepend">
												<input class="btn btn-success" type="button" value="$">
												<input data-numeric-input="1" type="text" name="property_tax" id="property_tax">
											</div>

											<p class="srl-d-none srl-m0 srl-warning">Above Field Is Mandatory</p>
										</div>
										<div class="input-field-wrapper is-flex pr-0">
											<label for="total_insurance">House Insurance (yearly)
												<span class="tooltip-container" >
													   <svg width="15" height="15" class="tooltip-trigger" title="House Insurance (yearly)" body="Include the yearly cost of house insurance to calculate your comprehensive housing expenses and accurately assess mortgage affordability.">
															<g id="surface1">
																<path style="stroke:none;fill-rule:nonzero;fill:#000;fill-opacity:1" d="M7.078 10.625h.938v-3.75h-.938ZM7.5 5.719c.145 0 .27-.047.367-.14a.48.48 0 0 0 .149-.36c0-.145-.051-.27-.149-.375a.482.482 0 0 0-.367-.157c-.145 0-.27.051-.367.157a.535.535 0 0 0-.149.375c0 .144.051.265.149.36.097.093.222.14.367.14Zm0 8.031c-.855 0-1.66-.164-2.422-.492a6.332 6.332 0 0 1-1.992-1.344 6.332 6.332 0 0 1-1.344-1.992 6.095 6.095 0 0 1-.492-2.438c0-.855.164-1.66.492-2.421a6.253 6.253 0 0 1 3.336-3.32 6.095 6.095 0 0 1 2.438-.493c.855 0 1.66.164 2.421.492a6.297 6.297 0 0 1 1.985 1.336 6.297 6.297 0 0 1 1.336 1.985c.328.761.492 1.574.492 2.437 0 .855-.164 1.66-.492 2.422a6.253 6.253 0 0 1-3.32 3.336 6.095 6.095 0 0 1-2.438.492Zm.016-.938c1.468 0 2.718-.519 3.75-1.554 1.03-1.035 1.546-2.293 1.546-3.774 0-1.468-.515-2.718-1.546-3.75C10.234 2.704 8.98 2.188 7.5 2.188c-1.469 0-2.723.515-3.758 1.546C2.707 4.766 2.188 6.02 2.188 7.5c0 1.469.519 2.723 1.554 3.758 1.035 1.035 2.293 1.555 3.774 1.555ZM7.5 7.5Zm0 0"/>
															</g>
														</svg>
													</span>
											</label>
											<div class="srel-input-group-prepend">
												<input class="btn btn-success" type="button" value="$">
												<input data-numeric-input="1" type="text" name="total_insurance" id="total_insurance">
											</div>
											<p class="srl-d-none srl-m0 srl-warning">Above Field Is Mandatory</p>
										</div>
									</div>
									<div class="srl-input-group">
										<div class="input-field-wrapper is-flex pr-0">
											<label for="monthly_rent">Annual Expense Increase
												<span class="tooltip-container" >
													   <svg width="15" height="15" class="tooltip-trigger" title="Monthly Rent" body="Input the monthly rent amount to compare it with your potential mortgage payment and evaluate the feasibility of property investment.">
															<g id="surface1">
																<path style="stroke:none;fill-rule:nonzero;fill:#000;fill-opacity:1" d="M7.078 10.625h.938v-3.75h-.938ZM7.5 5.719c.145 0 .27-.047.367-.14a.48.48 0 0 0 .149-.36c0-.145-.051-.27-.149-.375a.482.482 0 0 0-.367-.157c-.145 0-.27.051-.367.157a.535.535 0 0 0-.149.375c0 .144.051.265.149.36.097.093.222.14.367.14Zm0 8.031c-.855 0-1.66-.164-2.422-.492a6.332 6.332 0 0 1-1.992-1.344 6.332 6.332 0 0 1-1.344-1.992 6.095 6.095 0 0 1-.492-2.438c0-.855.164-1.66.492-2.421a6.253 6.253 0 0 1 3.336-3.32 6.095 6.095 0 0 1 2.438-.493c.855 0 1.66.164 2.421.492a6.297 6.297 0 0 1 1.985 1.336 6.297 6.297 0 0 1 1.336 1.985c.328.761.492 1.574.492 2.437 0 .855-.164 1.66-.492 2.422a6.253 6.253 0 0 1-3.32 3.336 6.095 6.095 0 0 1-2.438.492Zm.016-.938c1.468 0 2.718-.519 3.75-1.554 1.03-1.035 1.546-2.293 1.546-3.774 0-1.468-.515-2.718-1.546-3.75C10.234 2.704 8.98 2.188 7.5 2.188c-1.469 0-2.723.515-3.758 1.546C2.707 4.766 2.188 6.02 2.188 7.5c0 1.469.519 2.723 1.554 3.758 1.035 1.035 2.293 1.555 3.774 1.555ZM7.5 7.5Zm0 0"/>
															</g>
														</svg>
													</span>
											</label>
											<div class="srel-input-group-prepend">
												<input class="btn btn-success" type="button" value="%">
												<input data-numeric-input="1" type="text" name="annual_expense_increase" id="annual_expense_increase">
											</div>
											<p class="srl-d-none srl-m0 srl-warning">Above Field Is Mandatory</p>
										</div>
									</div>
									<div class="srl-input-group">
										<div class="input-field-wrapper is-flex pr-0">
											<label for="maintenance_cost">Maintenance (yearly)
												<span class="tooltip-container" >
													   <svg width="15" height="15" class="tooltip-trigger" title="Maintenance (yearly)" body="Consider the estimated maintenance costs yearly to evaluate the total financial commitment of homeownership and determine the affordability of your mortgage.">
															<g id="surface1">
																<path style="stroke:none;fill-rule:nonzero;fill:#000;fill-opacity:1" d="M7.078 10.625h.938v-3.75h-.938ZM7.5 5.719c.145 0 .27-.047.367-.14a.48.48 0 0 0 .149-.36c0-.145-.051-.27-.149-.375a.482.482 0 0 0-.367-.157c-.145 0-.27.051-.367.157a.535.535 0 0 0-.149.375c0 .144.051.265.149.36.097.093.222.14.367.14Zm0 8.031c-.855 0-1.66-.164-2.422-.492a6.332 6.332 0 0 1-1.992-1.344 6.332 6.332 0 0 1-1.344-1.992 6.095 6.095 0 0 1-.492-2.438c0-.855.164-1.66.492-2.421a6.253 6.253 0 0 1 3.336-3.32 6.095 6.095 0 0 1 2.438-.493c.855 0 1.66.164 2.421.492a6.297 6.297 0 0 1 1.985 1.336 6.297 6.297 0 0 1 1.336 1.985c.328.761.492 1.574.492 2.437 0 .855-.164 1.66-.492 2.422a6.253 6.253 0 0 1-3.32 3.336 6.095 6.095 0 0 1-2.438.492Zm.016-.938c1.468 0 2.718-.519 3.75-1.554 1.03-1.035 1.546-2.293 1.546-3.774 0-1.468-.515-2.718-1.546-3.75C10.234 2.704 8.98 2.188 7.5 2.188c-1.469 0-2.723.515-3.758 1.546C2.707 4.766 2.188 6.02 2.188 7.5c0 1.469.519 2.723 1.554 3.758 1.035 1.035 2.293 1.555 3.774 1.555ZM7.5 7.5Zm0 0"/>
															</g>
														</svg>
													</span>
											</label>
											<div class="srel-input-group-prepend">
												<input class="btn btn-success" type="button" value="$">
												<input data-numeric-input="1" type="text" name="maintenance_cost" id="maintenance_cost">
											</div>
											<p class="srl-d-none srl-m0 srl-warning">Above Field Is Mandatory</p>
										</div>
										<div class="input-field-wrapper is-flex srl-d-none pr-0" data-optional-input="1">
											<label for="hoa_fee">Condo Fee (yearly)
												<span class="tooltip-container" >
													   <svg width="15" height="15" class="tooltip-trigger" title="Condo Fee (yearly)" body="Incorporate the monthly condo fees yearly into your mortgage calculations to accurately assess the total housing expenses and determine the affordability of owning a condominium.">
															<g id="surface1">
																<path style="stroke:none;fill-rule:nonzero;fill:#000;fill-opacity:1" d="M7.078 10.625h.938v-3.75h-.938ZM7.5 5.719c.145 0 .27-.047.367-.14a.48.48 0 0 0 .149-.36c0-.145-.051-.27-.149-.375a.482.482 0 0 0-.367-.157c-.145 0-.27.051-.367.157a.535.535 0 0 0-.149.375c0 .144.051.265.149.36.097.093.222.14.367.14Zm0 8.031c-.855 0-1.66-.164-2.422-.492a6.332 6.332 0 0 1-1.992-1.344 6.332 6.332 0 0 1-1.344-1.992 6.095 6.095 0 0 1-.492-2.438c0-.855.164-1.66.492-2.421a6.253 6.253 0 0 1 3.336-3.32 6.095 6.095 0 0 1 2.438-.493c.855 0 1.66.164 2.421.492a6.297 6.297 0 0 1 1.985 1.336 6.297 6.297 0 0 1 1.336 1.985c.328.761.492 1.574.492 2.437 0 .855-.164 1.66-.492 2.422a6.253 6.253 0 0 1-3.32 3.336 6.095 6.095 0 0 1-2.438.492Zm.016-.938c1.468 0 2.718-.519 3.75-1.554 1.03-1.035 1.546-2.293 1.546-3.774 0-1.468-.515-2.718-1.546-3.75C10.234 2.704 8.98 2.188 7.5 2.188c-1.469 0-2.723.515-3.758 1.546C2.707 4.766 2.188 6.02 2.188 7.5c0 1.469.519 2.723 1.554 3.758 1.035 1.035 2.293 1.555 3.774 1.555ZM7.5 7.5Zm0 0"/>
															</g>
														</svg>
													</span>
											</label>
											<div class="srel-input-group-prepend">
												<input class="btn btn-success" type="button" value="$">
												<input data-numeric-input="1" type="text" name="hoa_fee" id="hoa_fee">
											</div>
											<p class="srl-d-none srl-m0 srl-warning">Above Field Is Mandatory</p>
										</div>
									</div>
									<div class="srl-input-group">
										<div class="input-field-wrapper is-flex srl-d-none pr-0" data-optional-input="1">
											<label for="other_costs">Other Costs (yearly)
												<span class="tooltip-container" >
													   <svg width="15" height="15" class="tooltip-trigger" title="Other Costs (yearly)" body="Account for any additional costs yearly associated with homeownership, such as HOA fees, utilities, or special assessments, to calculate the complete financial commitment and assess the affordability of your mortgage.">
															<g id="surface1">
																<path style="stroke:none;fill-rule:nonzero;fill:#000;fill-opacity:1" d="M7.078 10.625h.938v-3.75h-.938ZM7.5 5.719c.145 0 .27-.047.367-.14a.48.48 0 0 0 .149-.36c0-.145-.051-.27-.149-.375a.482.482 0 0 0-.367-.157c-.145 0-.27.051-.367.157a.535.535 0 0 0-.149.375c0 .144.051.265.149.36.097.093.222.14.367.14Zm0 8.031c-.855 0-1.66-.164-2.422-.492a6.332 6.332 0 0 1-1.992-1.344 6.332 6.332 0 0 1-1.344-1.992 6.095 6.095 0 0 1-.492-2.438c0-.855.164-1.66.492-2.421a6.253 6.253 0 0 1 3.336-3.32 6.095 6.095 0 0 1 2.438-.493c.855 0 1.66.164 2.421.492a6.297 6.297 0 0 1 1.985 1.336 6.297 6.297 0 0 1 1.336 1.985c.328.761.492 1.574.492 2.437 0 .855-.164 1.66-.492 2.422a6.253 6.253 0 0 1-3.32 3.336 6.095 6.095 0 0 1-2.438.492Zm.016-.938c1.468 0 2.718-.519 3.75-1.554 1.03-1.035 1.546-2.293 1.546-3.774 0-1.468-.515-2.718-1.546-3.75C10.234 2.704 8.98 2.188 7.5 2.188c-1.469 0-2.723.515-3.758 1.546C2.707 4.766 2.188 6.02 2.188 7.5c0 1.469.519 2.723 1.554 3.758 1.035 1.035 2.293 1.555 3.774 1.555ZM7.5 7.5Zm0 0"/>
															</g>
														</svg>
													</span>
											</label>
											<div class="srel-input-group-prepend">
												<input class="btn btn-success" type="button" value="$">
												<input data-numeric-input="1" type="text" name="other_costs" id="other_costs">
											</div>
											<p class="srl-d-none srl-m0 srl-warning">Above Field Is Mandatory</p>
										</div>
									</div>
								</div>
								<p class="more-opts" data-parent-section-id="3">More Options ></p>
							</div>
						</div>
					</div>
					<div class="content-child" data-title="sell"  id="sell-i0">
						<div class="srl-input-section" data-section-id="4">
							<div class="is-inline w-100">
								<div class="input-wrapper">
									<div class="srl-input-group">
										<div class="input-field-wrapper is-flex pr-0">
											<label for="value_appreciation">Value Appreciation
												<span class="tooltip-container" >
													   <svg width="15" height="15" class="tooltip-trigger" title="Value Appreciation" body="Factor in the expected property value appreciation to assess the potential long-term return on investment and determine the financial benefits of your mortgage.">
															<g id="surface1">
																<path style="stroke:none;fill-rule:nonzero;fill:#000;fill-opacity:1" d="M7.078 10.625h.938v-3.75h-.938ZM7.5 5.719c.145 0 .27-.047.367-.14a.48.48 0 0 0 .149-.36c0-.145-.051-.27-.149-.375a.482.482 0 0 0-.367-.157c-.145 0-.27.051-.367.157a.535.535 0 0 0-.149.375c0 .144.051.265.149.36.097.093.222.14.367.14Zm0 8.031c-.855 0-1.66-.164-2.422-.492a6.332 6.332 0 0 1-1.992-1.344 6.332 6.332 0 0 1-1.344-1.992 6.095 6.095 0 0 1-.492-2.438c0-.855.164-1.66.492-2.421a6.253 6.253 0 0 1 3.336-3.32 6.095 6.095 0 0 1 2.438-.493c.855 0 1.66.164 2.421.492a6.297 6.297 0 0 1 1.985 1.336 6.297 6.297 0 0 1 1.336 1.985c.328.761.492 1.574.492 2.437 0 .855-.164 1.66-.492 2.422a6.253 6.253 0 0 1-3.32 3.336 6.095 6.095 0 0 1-2.438.492Zm.016-.938c1.468 0 2.718-.519 3.75-1.554 1.03-1.035 1.546-2.293 1.546-3.774 0-1.468-.515-2.718-1.546-3.75C10.234 2.704 8.98 2.188 7.5 2.188c-1.469 0-2.723.515-3.758 1.546C2.707 4.766 2.188 6.02 2.188 7.5c0 1.469.519 2.723 1.554 3.758 1.035 1.035 2.293 1.555 3.774 1.555ZM7.5 7.5Zm0 0"/>
															</g>
														</svg>
													</span>
											</label>
											<div class="srel-input-group-prepend">
												<input class="btn btn-success" type="button" value="%">
												<input type="text" name="value_appreciation" id="value_appreciation">
											</div>
											<p class="srl-d-none srl-m0 srl-warning">Above Field Is Mandatory</p>
										</div>
									</div>
									<div class="srl-input-group">
										<div class="input-field-wrapper is-flex pr-0">
											<label for="holding_length">Holding Length
												<span class="tooltip-container" >
													   <svg width="15" height="15" class="tooltip-trigger" title="Holding Length" body="Specify the estimated duration of property ownership to evaluate the financial implications and calculate the total cost of holding the mortgage.">
															<g id="surface1">
																<path style="stroke:none;fill-rule:nonzero;fill:#000;fill-opacity:1" d="M7.078 10.625h.938v-3.75h-.938ZM7.5 5.719c.145 0 .27-.047.367-.14a.48.48 0 0 0 .149-.36c0-.145-.051-.27-.149-.375a.482.482 0 0 0-.367-.157c-.145 0-.27.051-.367.157a.535.535 0 0 0-.149.375c0 .144.051.265.149.36.097.093.222.14.367.14Zm0 8.031c-.855 0-1.66-.164-2.422-.492a6.332 6.332 0 0 1-1.992-1.344 6.332 6.332 0 0 1-1.344-1.992 6.095 6.095 0 0 1-.492-2.438c0-.855.164-1.66.492-2.421a6.253 6.253 0 0 1 3.336-3.32 6.095 6.095 0 0 1 2.438-.493c.855 0 1.66.164 2.421.492a6.297 6.297 0 0 1 1.985 1.336 6.297 6.297 0 0 1 1.336 1.985c.328.761.492 1.574.492 2.437 0 .855-.164 1.66-.492 2.422a6.253 6.253 0 0 1-3.32 3.336 6.095 6.095 0 0 1-2.438.492Zm.016-.938c1.468 0 2.718-.519 3.75-1.554 1.03-1.035 1.546-2.293 1.546-3.774 0-1.468-.515-2.718-1.546-3.75C10.234 2.704 8.98 2.188 7.5 2.188c-1.469 0-2.723.515-3.758 1.546C2.707 4.766 2.188 6.02 2.188 7.5c0 1.469.519 2.723 1.554 3.758 1.035 1.035 2.293 1.555 3.774 1.555ZM7.5 7.5Zm0 0"/>
															</g>
														</svg>
													</span>
											</label>
											<div class="srel-input-group-append">
												<input type="text" name="holding_length" id="holding_length">
												<input class="btn btn-success" type="button" value=years>
											</div>
											<p class="srl-d-none srl-m0 srl-warning">Above Field Is Mandatory</p>
										</div>
										<div class="input-field-wrapper is-flex pr-0">
											<label for="cost_to_sell">Cost to Sell
												<span class="tooltip-container" >
													   <svg width="15" height="15" class="tooltip-trigger" title="Cost to Sell" body="Consider the anticipated costs associated with selling the property, such as real estate agent fees or closing costs, to accurately evaluate the overall financial outcome of your mortgage.">
															<g id="surface1">
																<path style="stroke:none;fill-rule:nonzero;fill:#000;fill-opacity:1" d="M7.078 10.625h.938v-3.75h-.938ZM7.5 5.719c.145 0 .27-.047.367-.14a.48.48 0 0 0 .149-.36c0-.145-.051-.27-.149-.375a.482.482 0 0 0-.367-.157c-.145 0-.27.051-.367.157a.535.535 0 0 0-.149.375c0 .144.051.265.149.36.097.093.222.14.367.14Zm0 8.031c-.855 0-1.66-.164-2.422-.492a6.332 6.332 0 0 1-1.992-1.344 6.332 6.332 0 0 1-1.344-1.992 6.095 6.095 0 0 1-.492-2.438c0-.855.164-1.66.492-2.421a6.253 6.253 0 0 1 3.336-3.32 6.095 6.095 0 0 1 2.438-.493c.855 0 1.66.164 2.421.492a6.297 6.297 0 0 1 1.985 1.336 6.297 6.297 0 0 1 1.336 1.985c.328.761.492 1.574.492 2.437 0 .855-.164 1.66-.492 2.422a6.253 6.253 0 0 1-3.32 3.336 6.095 6.095 0 0 1-2.438.492Zm.016-.938c1.468 0 2.718-.519 3.75-1.554 1.03-1.035 1.546-2.293 1.546-3.774 0-1.468-.515-2.718-1.546-3.75C10.234 2.704 8.98 2.188 7.5 2.188c-1.469 0-2.723.515-3.758 1.546C2.707 4.766 2.188 6.02 2.188 7.5c0 1.469.519 2.723 1.554 3.758 1.035 1.035 2.293 1.555 3.774 1.555ZM7.5 7.5Zm0 0"/>
															</g>
														</svg>
													</span>
											</label>
											<div class="srel-input-group-prepend">
												<input class="btn btn-success" type="button" value="%">
												<input type="text" name="cost_to_sell" id="cost_to_sell">
											</div>
											<p class="srl-d-none srl-m0 srl-warning">Above Field Is Mandatory</p>
										</div>
									</div>
								</div>

							</div>
						</div>
					</div>
					<div class="btns-wrapper is-flex">
						<div class="btn-result next-btn srl-btn" step="1" data-parent="first-property">Next</div>
						<div class="btn-result calc-btn srl-btn d-none">Calculate this Property</div>
						<div class="btn-clear-form srl-btn srl-sec-button ml-1">Clear</div>
					</div>
				</div>
			</div>
		</div>
		<div class="btns-wrapper text-center">
			<div class="btn-compare srl-sec-button"> + Compare Another Property</div>
		</div>
	</div>
	<div class="srel-results result-box srl-right-container">
		<div class="ml-1 summary w-100" >
			<div class="results-container" >
				<div class="results-content active" data-form-id="first-property">
					<h3 class="srl-d-none" data-result-title="1">TEST</h3>
					<h5 class="srl-h-price srl-d-none" >0</h5>
					<div aria-label="This rating evaluates your rental property's cash flow. Ratings below 'B' indicate room for improvement. Consider increasing rent or extending the loan term to enhance cash flow and upgrade your rating." data-balloon-length="fit" data-balloon-pos="left">
						<h5 class="srl-h-rating srl-d-none" >RATING <span data-row-rating="rating">F</span></h5>
					</div>
					<div class="results-heading">
						<h2 class="srl-income-expenses">Property Investment Analysis</h2>
					</div>
					<div class="srl-div-table">
						<div class="srl-cf-wrapper">
							<div class="srl-div-table-row srl-table-head">
								<div class="srl-div-table-col srl-fw-b">Expenses</div>
								<div class="srl-div-table-col srl-fw-b">Monthly</div>
								<div class="srl-div-table-col srl-fw-b">Yearly</div>
								<div class="srl-div-table-col srl-fw-b srl-d-none"><span class="srl-year-text" ></span> Years</div>

							</div>
							<div class="srl-div-table-row" data-row-info="income">
								<div class="srl-div-table-col title" data-title="Income"><span class="circle-green"></span><span>Income</span></div>
								<div data-label="Monthly" class="srl-div-table-col">0</div>
								<div data-label="Yearly" class="srl-div-table-col">0</div>
								<div data-label="Years" class="srl-div-table-col srl-d-none">0</div>
							</div>
							<div class="srl-div-table-row" data-row-info="mortgage-pay">
								<div class="srl-div-table-col title" data-title="Mortgage Pay"><span class="circle-red"></span><span>Mortgage Pay</span></div>
								<div data-label="Monthly" class="srl-div-table-col">0</div>
								<div data-label="Yearly" class="srl-div-table-col">0</div>
								<div data-label="Years" class="srl-div-table-col srl-d-none">0</div>
							</div>
							<div class="srl-div-table-row" data-row-info="vacancy">
								<div class="srl-div-table-col title" data-title="Vacancy"><span class="circle-red"></span><span>Vacancy</span></div>
								<div data-label="Monthly" class="srl-div-table-col">0</div>
								<div data-label="Yearly" class="srl-div-table-col">0</div>
								<div data-label="Years" class="srl-div-table-col srl-d-none">0</div>
							</div>
							<div class="srl-div-table-row" data-row-info="property-tax">
								<div class="srl-div-table-col title" data-title="Property Tax"><span class="circle-red"></span><span>Property Tax</span></div>
								<div data-label="Monthly" class="srl-div-table-col">0</div>
								<div data-label="Yearly" class="srl-div-table-col">0</div>
								<div data-label="Years" class="srl-div-table-col srl-d-none">0</div>
							</div>
							<div class="srl-div-table-row" data-row-info="total-insurance">
								<div class="srl-div-table-col title" data-title="Total Insurance"><span class="circle-red"></span><span>Total Insurance</span></div>
								<div data-label="Monthly" class="srl-div-table-col">0</div>
								<div data-label="Yearly" class="srl-div-table-col">0</div>
								<div data-label="Years" class="srl-div-table-col srl-d-none">0</div>
							</div>
							<div class="srl-div-table-row" data-row-info="management-fee">
								<div class="srl-div-table-col title" data-title="Management Fee"><span class="circle-red"></span><span>Management Fee</span></div>
								<div data-label="Monthly" class="srl-div-table-col">0</div>
								<div data-label="Yearly" class="srl-div-table-col">0</div>
								<div data-label="Years" class="srl-div-table-col srl-d-none">0</div>
							</div>
							<div class="srl-div-table-row" data-row-info="hoa-fee">
								<div class="srl-div-table-col title" data-title="Condo Fee"><span class="circle-red"></span><span>Condo Fee</span></div>
								<div data-label="Monthly" class="srl-div-table-col">0</div>
								<div data-label="Yearly" class="srl-div-table-col">0</div>
								<div data-label="Years" class="srl-div-table-col srl-d-none">0</div>
							</div>
							<div class="srl-div-table-row" data-row-info="maintenance-cost">
								<div class="srl-div-table-col title" data-title="Maintenance Cost"><span class="circle-red"></span><span>Maintenance Cost</span></div>
								<div data-label="Monthly" class="srl-div-table-col">0</div>
								<div data-label="Yearly" class="srl-div-table-col">0</div>
								<div data-label="Years" class="srl-div-table-col srl-d-none">0</div>
							</div>
							<div class="srl-div-table-row" data-row-info="other-cost">
								<div class="srl-div-table-col title" data-title="Other Cost"><span class="circle-red"></span><span>Other Cost</span></div>
								<div data-label="Monthly" class="srl-div-table-col">0</div>
								<div data-label="Yearly" class="srl-div-table-col">0</div>
								<div data-label="Years" class="srl-div-table-col srl-d-none">0</div>
							</div>
							<div class="srl-div-table-row" data-row-info="cash-flow">
								<div class="srl-div-table-col title" data-title="Cash Flow"><span class="circle-grey"></span><span>Cash Flow</span></div>
								<div data-label="Monthly" class="srl-div-table-col">0</div>
								<div data-label="Yearly" class="srl-div-table-col">0</div>
								<div data-label="Years" class="srl-div-table-col srl-d-none">0</div>
							</div>
							<div class="srl-div-table-row" data-row-info="noi">
								<div class="srl-div-table-col title" data-title="Net Operating Income (NOI)"><span class="circle-grey"></span><span>Net Operating Income (NOI)</span></div>
								<div data-label="Monthly" class="srl-div-table-col">0</div>
								<div data-label="Yearly" class="srl-div-table-col">0</div>
								<div data-label="Years" class="srl-div-table-col srl-d-none">0</div>
							</div>
							<div class="srl-div-table-row srl-d-none" data-row-info="caprate">
								<div class="srl-div-table-col title" data-title="Capitalization Rate"><span class="circle-grey"></span><span>Capitalization Rate</span></div>
								<div data-label="Monthly" class="srl-div-table-col">0</div>
								<div data-label="Yearly" class="srl-div-table-col">0</div>
								<div data-label="Years" class="srl-div-table-col srl-d-none">0</div>
							</div>
							<div class="srl-div-table-row srl-d-none" data-row-info="sellingprice">
								<div class="srl-div-table-col title" data-title="Total Selling Price"><span class="circle-grey"></span><span>Total Selling Price</span></div>
								<div data-label="Monthly" class="srl-div-table-col">0</div>
								<div data-label="Yearly" class="srl-div-table-col">0</div>
								<div data-label="Years" class="srl-div-table-col srl-d-none">0</div>
							</div>
							<div class="srl-div-table-row srl-d-none" data-row-info="totalprofit">
								<div class="srl-div-table-col title" data-title="Total Profit When Sold"><span class="circle-grey"></span><span>Total Profit When Sold</span></div>
								<div data-label="Monthly" class="srl-div-table-col">0</div>
								<div data-label="Yearly" class="srl-div-table-col">0</div>
								<div data-label="Years" class="srl-div-table-col srl-d-none">0</div>
							</div>
						</div>

					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
	var srel_options = <?php echo wp_kses_post( $options ); ?>;
	// window.onload is optional since it depends on the way in which you fire events
	// Get all tooltip trigger elements
	const tooltipTriggers = document.querySelectorAll('.tooltip-container');

	// Iterate over each trigger element
	tooltipTriggers.forEach((trigger) => {
		// Add event listener to show/hide tooltip on hover
		trigger.addEventListener('mouseenter', () => {
			const childElement = document.createElement('div');
			childElement.classList.add('tooltip-content');
			trigger.appendChild(childElement)
			var title = document.createElement('h4');
			title.classList.add('title');
			title.textContent = trigger.querySelector('.tooltip-trigger').getAttribute('title');
			childElement.appendChild(title);
			var arrow = document.createElement('div');
			arrow.classList.add('tooltip-arrow');
			childElement.appendChild(arrow);
			var body = document.createElement('div');
			body.classList.add('body');
			body.textContent = trigger.querySelector('.tooltip-trigger').getAttribute('body');
			childElement.appendChild(body);
			trigger.querySelector('.tooltip-content').style.display = 'block';
		});

		trigger.addEventListener('mouseleave', () => {
			trigger.querySelector('.tooltip-content').remove();
		});
	});

</script>
