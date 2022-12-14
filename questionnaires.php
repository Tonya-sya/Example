<?php
/*
 Template Name:  questionnaires
*/
get_header();
$current_user = wp_get_current_user();
$current_user_id = $current_user->ID;
$new_count = get_user_meta( $current_user_id, 'questionnaires_new', true );
$is_completed = false;
$user_questionnaires = get_user_meta($current_user_id, 'questionnaires', true);
if (!empty($user_questionnaires) && array_key_exists(get_the_ID(), $user_questionnaires['completed'])) {
	$is_completed = true;
}
?>
	<section class="account">
		<div class="account__wrapper d-flex">
			<ul class="account__links d-none d-lg-block">
				<li><a href="<?php echo home_url( '/my-account' ); ?>">my
						account</a></li>
				<li class="active"><a
						href="<?php echo home_url( '/questionnaires' ); ?>">questionnaires<?php if ( $new_count ) { ?>
							<span>(<?php echo $new_count; ?>)</span><?php } ?>
					</a></li>
				<li><a class="d-flex alifn-items-center" href="#">
						<svg width="18" height="18" viewBox="0 0 18 18"
						     fill="none" xmlns="http://www.w3.org/2000/svg">
							<path
								d="M14.8333 0.666672H9.83333C9.61232 0.666672 9.40036 0.754469 9.24408 0.910749C9.0878 1.06703 9 1.27899 9 1.50001C9 1.72102 9.0878 1.93298 9.24408 2.08926C9.40036 2.24554 9.61232 2.33334 9.83333 2.33334H14.8333C15.0543 2.33334 15.2663 2.42114 15.4226 2.57742C15.5789 2.7337 15.6667 2.94566 15.6667 3.16667V14.8333C15.6667 15.0544 15.5789 15.2663 15.4226 15.4226C15.2663 15.5789 15.0543 15.6667 14.8333 15.6667H9.83333C9.61232 15.6667 9.40036 15.7545 9.24408 15.9107C9.0878 16.067 9 16.279 9 16.5C9 16.721 9.0878 16.933 9.24408 17.0893C9.40036 17.2455 9.61232 17.3333 9.83333 17.3333H14.8333C15.4964 17.3333 16.1323 17.0699 16.6011 16.6011C17.0699 16.1323 17.3333 15.4964 17.3333 14.8333V3.16667C17.3333 2.50363 17.0699 1.86775 16.6011 1.3989C16.1323 0.930064 15.4964 0.666672 14.8333 0.666672Z"
								fill="black"/>
							<path
								d="M5.42362 11.7442C5.50322 11.8211 5.5667 11.913 5.61038 12.0147C5.65405 12.1163 5.67704 12.2257 5.678 12.3363C5.67896 12.447 5.65788 12.5567 5.61598 12.6591C5.57408 12.7616 5.5122 12.8546 5.43395 12.9328C5.35571 13.0111 5.26267 13.073 5.16025 13.1149C5.05784 13.1568 4.94811 13.1778 4.83746 13.1769C4.72681 13.1759 4.61746 13.1529 4.51579 13.1093C4.41412 13.0656 4.32216 13.0021 4.24529 12.9225L0.911957 9.58918C0.755732 9.4329 0.667969 9.22098 0.667969 9.00001C0.667969 8.77904 0.755732 8.56712 0.911957 8.41085L4.24529 5.07751C4.32216 4.99792 4.41412 4.93443 4.51579 4.89076C4.61746 4.84709 4.72681 4.8241 4.83746 4.82314C4.94811 4.82217 5.05784 4.84326 5.16025 4.88516C5.26267 4.92706 5.35571 4.98894 5.43395 5.06718C5.5122 5.14543 5.57408 5.23847 5.61598 5.34088C5.65788 5.4433 5.67896 5.55303 5.678 5.66368C5.67704 5.77433 5.65405 5.88368 5.61038 5.98535C5.5667 6.08702 5.50322 6.17897 5.42362 6.25584L3.51279 8.16668H13.1678C13.3888 8.16668 13.6008 8.25448 13.757 8.41076C13.9133 8.56704 14.0011 8.779 14.0011 9.00001C14.0011 9.22103 13.9133 9.43299 13.757 9.58927C13.6008 9.74555 13.3888 9.83334 13.1678 9.83334H3.51279L5.42362 11.7442Z"
								fill="black"/>
						</svg>

						<p>logout </p></a></li>
			</ul>
			<div class="settings show"><a
					href="<?php echo home_url( '/questionnaires' ); ?>"
					class="forward-btn">
					<svg width="15" height="13" viewBox="0 0 15 13" fill="none"
					     xmlns="http://www.w3.org/2000/svg">
						<path
							d="M6.3125 12.4375L7.14969 11.6003L2.64906 7.09375H14.625V5.90625H2.64906L7.14969 1.39969L6.3125 0.5625L0.375 6.5L6.3125 12.4375Z"
							fill="black"/>
					</svg>

					<p>back</p></a>
				<h6 class="questionnaires__title"><?php echo get_the_title(); ?></h6>
				<?php
				if (!$is_completed){
				if ( have_rows( 'questionnaires_form' ) ):
					$index = 1;
					?>
					<form action="<?php echo home_url('/questionnaires') ?>" method="post">
						<?php
						while ( have_rows( 'questionnaires_form' ) ):
							the_row();
							$field_name = get_sub_field( 'name_field' );
							$field_type = get_sub_field( 'type_field' );
							?>
							<div class="settings__item">
								<div class="settings__title"
								     data-count="<?php echo $index ?>.">
									<p><?php echo $field_name; ?></p>
									<input type="hidden" name="<?php echo 'field_'. $index . '_name'; ?>" value="<?php echo $field_name; ?>">
									<input type="hidden" name="<?php echo 'field_'. $index . '_type'; ?>" value="<?php echo $field_type; ?>">
								</div>
								<?php
								if ( $field_type == 'radio'
								     || $field_type == 'checkbox'
								):
									$field_choices
										= get_sub_field( 'choices_field' );
									?>
									<div class="settings__inputs">
										<?php
										$choices_arr = array();
										foreach (
											$field_choices as $key => $choice

										) :
											$choices_arr[] = $choice['choice'];
											?>
											<input name="<?php echo 'field_'
											                        . $index; ?>"
											       value="<?php echo $choice['choice']; ?>"
											       type="<?php echo $field_type ?>"
											       id="<?php echo 'field_'
											                      . $index . '_'
											                      . $field_type
											                      . '_'
											                      . $key ?>">
											<label for="<?php echo 'field_'
											                       . $index
											                       . '_'
											                       . $field_type
											                       . '_'
											                       . $key ?>"><?php echo $choice['choice']; ?>
												<?php if ( $field_type
												           == 'radio'
												): ?>
													<div class="circle">
														<div class="dot"></div>
													</div>
												<?php elseif ( $field_type
												               == 'checkbox'
												): ?>
													<div
														class="check-mark"></div>
												<?php endif; ?>
											</label>
										<?php endforeach;
										$choices_str = implode(', ', $choices_arr);
										?>
										<input type="hidden" name="<?php echo 'field_' . $index . '_choices'; ?>" value="<?php echo $choices_str ?>">
									</div>
								<?php
								elseif ( $field_type == 'textarea' ):
									$field_placeholder
										= get_sub_field( 'placeholder_field' );
									?>
									<textarea name="<?php echo 'field_' . $index; ?>"
									          maxlength="10000"
									          placeholder="<?php echo $field_placeholder; ?>"></textarea>
									<p class="descr">Your answer cannot be more
										than 10000 characters.</p>
								<?php
								elseif ( $field_type == 'text' ):
									$field_placeholder
										= get_sub_field( 'placeholder_field' );
									?>
									<input type="text" class="questionnaires_text-input" name="<?php echo 'field_' . $index; ?>"
									       placeholder="<?php echo $field_placeholder; ?>">
								<?php endif; ?>
							</div>
							<?php
							$index ++;
						endwhile;
						?>
						<input type="hidden" name="questi_form_length" value="<?php echo $index ?>">
						<input type="hidden" name="questi_id" value="<?php echo get_the_ID(); ?>">
						<button class="btn_black" <?php if ($is_completed) { echo 'disabled '; echo 'style="display: none;"';} ?>>send</button>
					</form>
				<?php
				endif;
				} else {
					$response_id = $user_questionnaires['completed'][get_the_ID()];
					$response_form = get_post_meta($response_id, 'questionnaire_form', true);
					$index = 1;
					foreach ($response_form as $field):
						$field_name = $field['field_name'];
						$field_type = $field['field_type'];
						?>
						<div class="settings__item completed">
							<div class="settings__title"
							     data-count="<?php echo $index ?>.">
								<p><?php echo $field_name; ?></p>
							</div>
							<?php
							if ( $field_type == 'radio' || $field_type == 'checkbox' ):
								$field_choices
									= get_sub_field( 'choices_field' );
								$field_value = $field['field_value'];
								$field_values = explode(', ', $field['field_value']);
								$values = explode(', ', $field['choices']);
								?>
								<div class="settings__inputs">
									<?php foreach (
										$values as $key => $choice
									) :
										$is_checked = '';
										foreach ($field_values as $value) {
											if ($choice == $value) {
												$is_checked = 'checked ';
											}
										}
										?>
										<input <?php echo $is_checked ?>name="<?php echo 'field_'
										                        . $index; ?>"
										       value="<?php echo $choice; ?>"
										       type="<?php echo $field_type ?>"
										       id="<?php echo 'field_'
										                      . $index . '_'
										                      . $field_type
										                      . '_'
										                      . $key ?>" disabled>
										<label for="<?php echo 'field_'
										                       . $index
										                       . '_'
										                       . $field_type
										                       . '_'
										                       . $key ?>"><?php echo $choice; ?>
											<?php if ( $field_type
											           == 'radio'
											): ?>
												<div class="circle">
													<div class="dot"></div>
												</div>
											<?php elseif ( $field_type
											               == 'checkbox'
											): ?>
												<div
													class="check-mark"></div>
											<?php endif; ?>
										</label>
									<?php endforeach; ?>
								</div>
							<?php
							elseif ( $field_type == 'textarea' ):
								$field_value = $field['field_value'];
								?>
								<textarea name="<?php echo 'field_' . $index; ?>"
								          maxlength="10000" disabled><?php echo $field_value; ?></textarea>
							<?php
							elseif ( $field_type == 'text' ):
								$field_value = $field['field_value'];
								?>
								<input type="text" class="questionnaires_text-input" name="<?php echo 'field_' . $index; ?>"
								        value="<?php echo $field_value; ?>" disabled>
							<?php endif; ?>
						</div>

					<?php
					$index++;
					endforeach;
						} ?>
			</div>
		</div>
	</section>
<?php
get_footer( 'account' );
?>
