<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit;

class sungarden_widget_project_detail_info extends Widget_Base {

	public function get_categories() {
		return array( 'sungarden_widgets' );
	}

	public function get_name() {
		return 'sungarden-project-detail-info';
	}

	public function get_title() {
		return esc_html__( 'Project Detail Info', 'sungarden' );
	}

	public function get_icon() {
		return 'eicon-text-area';
	}

	protected function _register_controls() {

		$this->start_controls_section(
			'section_content',
			[
				'label' => esc_html__( 'Description', 'sungarden' ),
			]
		);

		$this->add_control(
			'description',
			[
				'label'     =>  esc_html__( 'Description', 'sungarden' ),
				'type'      =>  Controls_Manager::WYSIWYG,
				'default'   =>  esc_html__( 'Default description', 'sungarden' ),
			]
		);

		$this->end_controls_section();

	}

	protected function render() {

		$settings = $this->get_settings_for_display();
		$categories = rwmb_meta( 'metabox_project_categories' );
		$customer = rwmb_meta( 'metabox_project_customer' );
		$place = rwmb_meta( 'metabox_project_place' );
		$area = rwmb_meta( 'metabox_project_area' );
		$style = rwmb_meta( 'metabox_project_style' );
		$date = rwmb_meta( 'metabox_project_date' );
	?>

		<div class="element-project-detail-info">
			<div class="project-detail-top">
				<div class="row">
					<div class="col-12 col-md-4">
						<div class="project-info">
							<div class="project-info__top d-flex align-items-center">
								<h5 class="title flex-grow-0">
									<?php esc_html_e('Thông tin dự án', 'sungarden'); ?>
								</h5>

								<span class="line flex-grow-1"></span>
							</div>

							<div class="project-info__detail">
								<div class="list">
									<p class="label">
										<img class="icon" alt="" src="<?php echo esc_url( get_theme_file_uri( '/assets/images/icon/list.png' ) ); ?>">

										<span>
                                            <?php esc_html_e('Hạng mục:', 'sungarden'); ?>
                                        </span>
									</p>

									<p class="text">
										<?php echo esc_html( $categories ); ?>
									</p>
								</div>

								<div class="list">
									<p class="label">
										<img class="icon" alt="" src="<?php echo esc_url( get_theme_file_uri( '/assets/images/icon/customer.png' ) ); ?>">

										<span>
                                            <?php esc_html_e('Khách hàng:', 'sungarden'); ?>
                                        </span>
									</p>

									<p class="text">
										<?php echo esc_html( $customer ); ?>
									</p>
								</div>

								<div class="list">
									<p class="label">
										<img class="icon" alt="" src="<?php echo esc_url( get_theme_file_uri( '/assets/images/icon/place.png' ) ); ?>">

										<span>
                                            <?php esc_html_e('Địa điểm:', 'sungarden'); ?>
                                        </span>
									</p>

									<p class="text">
										<?php echo esc_html( $place ); ?>
									</p>
								</div>

								<div class="list">
									<p class="label">
										<img class="icon" alt="" src="<?php echo esc_url( get_theme_file_uri( '/assets/images/icon/area.png' ) ); ?>">

										<span>
                                            <?php esc_html_e('Diện tích:', 'sungarden'); ?>
                                        </span>
									</p>

									<p class="text">
										<?php echo esc_html( $area . 'm2' ); ?>
									</p>
								</div>

								<div class="list">
									<p class="label">
										<img class="icon" alt="" src="<?php echo esc_url( get_theme_file_uri( '/assets/images/icon/style.png' ) ); ?>">

										<span>
                                            <?php esc_html_e('Phong cách:', 'sungarden'); ?>
                                        </span>
									</p>

									<p class="text">
										<?php echo esc_html( $style ); ?>
									</p>
								</div>

								<div class="list">
									<p class="label">
										<img class="icon" alt="" src="<?php echo esc_url( get_theme_file_uri( '/assets/images/icon/date.png' ) ); ?>">

										<span>
                                            <?php esc_html_e('Năm thực hiện:', 'sungarden'); ?>
                                        </span>
									</p>

									<p class="text">
										<?php echo esc_html( $date ); ?>
									</p>
								</div>
							</div>
						</div>
					</div>

					<div class="col-12 col-md-8">
						<div class="content">
							<div class="content__top d-flex align-items-center justify-content-between">
								<h1 class="title-item">
									<?php the_title(); ?>
								</h1>

								<?php sungarden_post_share(); ?>
							</div>

							<div class="content__desc">
								<?php echo wp_kses_post( $settings['description'] ); ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

	<?php

	}

}

Plugin::instance()->widgets_manager->register_widget_type( new sungarden_widget_project_detail_info );