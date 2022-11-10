<?php

namespace JupiterX_Core\Raven\Modules\Forms\Widgets;

defined( 'ABSPATH' ) || die();

use JupiterX_Core\Raven\Modules\Forms\Module;
use JupiterX_Core\Raven\Utils;
use JupiterX_Core\Raven\Modules\Forms\Widgets\Form;
use Elementor\Plugin as Elementor;

/**
 * Form widget class.
 *
 * @SuppressWarnings(PHPMD.NPathComplexity)
 * @since 2.0.0
 */
class Login extends Form {
	public function get_name() {
		return 'raven-login';
	}

	public function get_title() {
		return __( 'Login Form', 'jupiterx-core' );
	}

	public function get_icon() {
		return 'raven-element-icon raven-element-icon-login-widget';
	}

	protected function register_controls() {
		$this->section_form_fields();
		$this->form_settings();
		$this->register_section_submit_button();
		$this->update_section_submit_button();
		$this->register_custom_messages();
		// Styles controls.
		$this->register_section_general();
		$this->register_section_label();
		$this->register_section_field();
		$this->register_section_button();
	}

	private function section_form_fields() {
		$this->start_controls_section(
			'section_form_fields',
			[
				'label' => __( 'Form Fields', 'jupiterx-core' ),
			]
		);

		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'enable',
			[
				'label' => __( 'Enable', 'jupiterx-core' ),
				'type' => 'switcher',
				'return_value' => 'true',
				'frontend_available' => true,
				'conditions' => [
					'terms' => [
						[
							'name' => 'type',
							'operator' => 'in',
							'value' => [
								'recaptcha',
								'recaptcha_v3',
							],
						],
					],
				],
			]
		);

		$repeater->add_control(
			'label',
			[
				'label' => __( 'Label', 'jupiterx-core' ),
				'type' => 'text',
				'condition' => [
					'_enable' => 'true',
				],
			]
		);

		$repeater->add_control(
			'placeholder',
			[
				'label' => __( 'Placeholder', 'jupiterx-core' ),
				'type' => 'text',
				'conditions' => [
					'terms' => [
						[
							'name' => 'type',
							'operator' => '!in',
							'value' => [
								'recaptcha',
								'recaptcha_v3',
							],
						],
					],
				],
			]
		);

		$repeater->add_control(
			'recaptcha_theme',
			[
				'name' => 'recaptcha_theme',
				'label' => __( 'Theme', 'jupiterx-core' ),
				'type' => 'select',
				'default' => 'light',
				'options' => [
					'light' => __( 'Light', 'jupiterx-core' ),
					'dark' => __( 'Dark', 'jupiterx-core' ),
				],
				'conditions' => [
					'terms' => [
						[
							'name' => 'type',
							'operator' => 'in',
							'value' => [
								'recaptcha',
								'recaptcha_v3',
							],
						],
						[
							'name' => 'enable',
							'value' => 'true',
						],
					],
				],
			]
		);

		$repeater->add_control(
			'recaptcha_size',
			[
				'name' => 'recaptcha_size',
				'label' => __( 'Size', 'jupiterx-core' ),
				'type' => 'select',
				'default' => 'normal',
				'options' => [
					'normal' => __( 'Normal', 'jupiterx-core' ),
					'compact' => __( 'Compact', 'jupiterx-core' ),
				],
				'conditions' => [
					'terms' => [
						[
							'name' => 'type',
							'operator' => 'in',
							'value' => [
								'recaptcha',
								'recaptcha_v3',
							],
						],
						[
							'name' => 'enable',
							'value' => 'true',
						],
					],
				],
			]
		);

		$repeater->add_control(
			'required',
			[
				'label' => __( 'Required', 'jupiterx-core' ),
				'type' => 'switcher',
				'return_value' => 'true',
				'conditions' => [
					'terms' => [
						[
							'name' => 'type',
							'operator' => '!in',
							'value' => [
								'recaptcha',
								'recaptcha_v3',
							],
						],
					],
				],
			]
		);

		$repeater->add_responsive_control(
			'width',
			[
				'label' => __( 'Column Width', 'jupiterx-core' ),
				'type' => 'select',
				'options' => [
					'' => __( 'Default', 'jupiterx-core' ),
					'100' => '100%',
					'80' => '80%',
					'75' => '75%',
					'66' => '66%',
					'60' => '60%',
					'50' => '50%',
					'40' => '40%',
					'33' => '33%',
					'25' => '25%',
					'20' => '20%',
				],
				'default' => '100',
				'conditions' => [
					'terms' => [
						[
							'name' => 'type',
							'operator' => '!in',
							'value' => [
								'recaptcha',
								'recaptcha_v3',
							],
						],
					],
				],
			]
		);

		$repeater->add_control(
			'recaptcha_badge',
			[
				'name' => 'recaptcha_badge',
				'label' => __( 'Badge', 'jupiterx-core' ),
				'type' => 'select',
				'default' => 'inline',
				'options' => [
					'inline' => __( 'Inline', 'jupiterx-core' ),
					'bottomright' => __( 'Bottom Right', 'jupiterx-core' ),
					'bottomleft' => __( 'Bottom Left', 'jupiterx-core' ),
				],
				'conditions' => [
					'terms' => [
						[
							'name' => 'type',
							'value' => 'recaptcha_v3',
						],
						[
							'name' => 'enable',
							'value' => 'true',
						],
					],
				],
			]
		);

		$this->add_control(
			'fields',
			[
				'type' => 'repeater',
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'label' => 'Email or Username',
						'type' => 'text',
						'placeholder' => 'Email or Username',
						'required' => 'true',
						'_enable' => 'true',
						'name' => 'username',
					],
					[
						'label' => 'Password',
						'type' => 'password',
						'placeholder' => 'Password',
						'required' => 'true',
						'_enable' => 'true',
						'name' => 'password',
					],
					[
						'label' => 'reCAPTCHA',
						'type' => 'recaptcha',
						'_enable' => 'false',
						'name' => 'recaptcha',
					],
				],
				'item_actions' => [
					'add' => false,
					'duplicate' => false,
					'remove' => false,
					'sort' => false,
				],
				'frontend_available' => true,
				'title_field' => '{{{ label }}}',
			]
		);

		$this->end_controls_section();
	}

	private function form_settings() {
		$this->start_controls_section(
			'form_settings',
			[
				'label' => __( 'Form Settings', 'jupiterx-core' ),
			]
		);

		$this->add_control(
			'label',
			[
				'label' => __( 'Show Label', 'jupiterx-core' ),
				'type' => 'switcher',
				'label_on'  => __( 'Yes', 'jupiterx-core' ),
				'label_off' => __( 'No', 'jupiterx-core' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control(
			'required_mark',
			[
				'label' => __( 'Required Mark', 'jupiterx-core' ),
				'type' => 'switcher',
				'label_on'  => __( 'Show', 'jupiterx-core' ),
				'label_off' => __( 'Hide', 'jupiterx-core' ),
				'default' => 'yes',
				'separator' => 'before',
			]
		);

		$this->add_control(
			'redirect_to',
			[
				'label' => __( 'Redirect After Login URL', 'jupiterx-core' ),
				'type' => 'url',
				'placeholder' => __( 'Enter your web address', 'jupiterx-core' ),
				'dynamic' => [
					'active' => false,
				],
				'options' => false,
				'separator' => 'before',
				'label_block' => true,
			]
		);

		$this->add_control(
			'logout_redirect_to',
			[
				'label' => __( 'Redirect After Logout URL', 'jupiterx-core' ),
				'type' => 'url',
				'placeholder' => __( 'Enter your web address', 'jupiterx-core' ),
				'dynamic' => [
					'active' => false,
				],
				'options' => false,
				'separator' => 'before',
				'label_block' => true,
			]
		);

		$this->add_control(
			'enable_remember_me',
			[
				'label' => __( 'Remember me', 'jupiterx-core' ),
				'type' => 'switcher',
				'label_on'  => __( 'Show', 'jupiterx-core' ),
				'label_off' => __( 'Hide', 'jupiterx-core' ),
				'default' => 'yes',
				'separator' => 'before',
			]
		);

		$this->add_control(
			'enable_forget_password',
			[
				'label' => __( 'Forget password', 'jupiterx-core' ),
				'type' => 'switcher',
				'label_on'  => __( 'Show', 'jupiterx-core' ),
				'label_off' => __( 'Hide', 'jupiterx-core' ),
				'default' => 'yes',
				'separator' => 'before',
			]
		);

		$this->add_control(
			'forget_password_text',
			[
				'label' => __( 'Forget password text', 'jupiterx-core' ),
				'type' => 'text',
				'label_block' => true,
				'default' => __( 'Forget password?', 'jupiterx-core' ),
				'condition' => [
					'enable_forget_password' => 'yes',
				],
			]
		);

		$this->add_control(
			'forget_password_link',
			[
				'label' => __( 'Forget password link', 'jupiterx-core' ),
				'type' => 'url',
				'placeholder' => __( 'Enter your web address', 'jupiterx-core' ),
				'dynamic' => [
					'active' => false,
				],
				'options' => [ 'is_external', 'nofollow' ],
				'label_block' => true,
			]
		);

		$this->add_control(
			'actions',
			[
				'label' => __( 'Actions', 'jupiterx-core' ),
				'type' => 'text',
				'classes' => 'elementor-control-type-hidden',
				'default' => [ 'login' ],
			]
		);

		$this->end_controls_section();
	}

	private function register_custom_messages() {
		$this->start_controls_section(
			'form_custom_messages',
			[
				'label' => __( 'Custom Messages', 'jupiterx-core' ),
			]
		);

		$this->add_control(
			'enable_custom_messages',
			[
				'label' => __( 'Custom Messages', 'jupiterx-core' ),
				'type' => 'switcher',
				'label_on'  => __( 'Show', 'jupiterx-core' ),
				'label_off' => __( 'Hide', 'jupiterx-core' ),
				'default' => 'yes',
			]
		);

		$this->add_control(
			'success_message',
			[
				'label' => __( 'Success', 'jupiterx-core' ),
				'type' => 'text',
				'label_block' => true,
				'condition' => [
					'enable_custom_messages' => 'yes',
				],
			]
		);

		$this->add_control(
			'error_message',
			[
				'label' => __( 'Incorrect Password or Email', 'jupiterx-core' ),
				'type' => 'text',
				'label_block' => true,
				'condition' => [
					'enable_custom_messages' => 'yes',
				],
			]
		);

		$this->end_controls_section();
	}

	private function update_section_submit_button() {
		$this->update_control( 'submit_button_text', [
			'default' => __( 'Sign in', 'jupiterx-core' ),
		] );
	}

	protected function render() {
		if ( is_user_logged_in() && ! current_user_can( 'administrator' ) ) {
			return;
		}

		$settings = $this->get_settings_for_display();
		$fields   = $settings['fields'];

		$this->add_render_attribute( 'form', [
			'class'  => 'raven-form raven-flex raven-flex-wrap raven-flex-bottom',
			'method' => 'post',
		] );

		if ( empty( $settings['required_mark'] ) ) {
			$this->add_render_attribute(
				'form',
				'class',
				'raven-hide-required-mark'
			);
		}

		$this->add_render_attribute(
			'submit-button',
			'class',
			'raven-field-group raven-field-type-submit-button elementor-column elementor-col-' . $settings['submit_button_width']
		);

		if ( ! empty( $settings['submit_button_width_tablet'] ) ) {
			$this->add_render_attribute(
				'submit-button',
				'class',
				'elementor-md-' . $settings['submit_button_width_tablet']
			);
		}

		if ( ! empty( $settings['submit_button_width_mobile'] ) ) {
			$this->add_render_attribute(
				'submit-button',
				'class',
				'elementor-sm-' . $settings['submit_button_width_mobile']
			);
		}

		if ( $settings['hover_effect'] ) {
			$this->add_render_attribute(
				'submit-button',
				'class',
				'elementor-animation-' . $settings['hover_effect']
			);
		}

		if ( ! empty( $settings['forget_password_link']['url'] ) ) {
			$this->add_render_attribute( 'forget_pass', 'href', $settings['forget_password_link']['url'] );
		}

		if ( $settings['forget_password_link']['is_external'] ) {
			$this->add_render_attribute( 'forget_pass', 'target', '_blank' );
		}

		if ( $settings['forget_password_link']['nofollow'] ) {
			$this->add_render_attribute( 'forget_pass', 'rel', 'nofollow' );
		}

		?>
		<form <?php echo $this->get_render_attribute_string( 'form' ); ?>>
			<input type="hidden" name="post_id" value="<?php echo Utils::get_current_post_id(); ?>" />
			<input type="hidden" name="form_id" value="<?php echo $this->get_id(); ?>" />
			<?php foreach ( $fields as $field ) {
				if (
					strpos( $field['type'], 'recaptcha' ) !== false &&
					empty( $field['enable'] )
				) {
					continue;
				}

				Module::render_field( $this, $field );
			} ?>
			<div class="raven-flex-wrap raven-field-group elementor-column elementor-col-100 login-tools-wrapper">
				<?php if ( 'yes' === $settings['enable_remember_me'] ) : ?>
					<div class="raven-login-remember-me-wrapper">
						<input type="checkbox" name="remember-me" id="raven-login-widget-remember-me-checkbox" >
						<label class="raven-field-label" for="raven-login-widget-remember-me-checkbox"> <?php echo __( 'Remember me', 'jupiterx-core' ); ?></label>
					</div>
				<?php endif; ?>
				<?php if ( 'yes' === $settings['enable_forget_password'] ) : ?>
					<div class="raven-login-forget-password-wrapper">
						<a <?php echo $this->get_render_attribute_string( 'forget_pass' ); ?> >
							<?php echo $settings['forget_password_text']; ?>
						</a>
					</div>
				<?php endif; ?>
			</div>
			<div <?php echo $this->get_render_attribute_string( 'submit-button' ); ?>>
				<button type="submit" class="raven-submit-button">
					<?php Elementor::$instance->icons_manager->render_icon( $settings['submit_button_icon_new'], [ 'aria-hidden' => 'true' ] ); ?>
					<span><?php echo $settings['submit_button_text']; ?></span>
				</button>
			</div>
		</form>
		<?php if ( current_user_can( 'administrator' ) ) : ?>
			<div class="elementor-alert elementor-alert-danger">
				<?php echo __( 'This element is hidden for logged-in users and visible only to logged-out users and also administrator for demo purposes.', 'jupiterx-core' ); ?>
			</div>
		<?php endif;
	}
}
