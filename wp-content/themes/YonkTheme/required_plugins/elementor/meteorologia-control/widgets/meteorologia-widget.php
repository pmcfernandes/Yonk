<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

/**
 * Elementor Test Widget.
 *
 * Elementor widget that uses the emojionearea control.
 *
 * @since 1.0.0
 */
class Elementor_Meteorologia_Widget extends \Elementor\Widget_Base
{
    public function get_name(): string
    {
        return 'meteorologia_Widget';
    }

    public function get_title(): string
    {
        return esc_html__('Meteorologia', 'blank');
    }

    public function get_icon(): string
    {
        return 'eicon-code';
    }

    public function get_categories(): array
    {
        return ['general'];
    }

    public function get_keywords(): array
    {
        return ['meteorologia'];
    }

    public function has_widget_inner_wrapper(): bool
    {
        return false;
    }

    protected function is_dynamic_content(): bool
    {
        return false;
    }

    protected function register_controls(): void
    {

        $this->start_controls_section(
            'content_section',
            [
                'label' => esc_html__('Content', 'blank'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'title',
            [
                'label' => esc_html__('Title', 'blank'),
                'type' => 'text',
                'default' => esc_html__('Meteorologia', 'blank'),
            ]
        );

        $this->add_control(
            'geoObjectKey',
            [
                'label' => esc_html__('Geo Key', 'blank'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => '13537715'
            ]
        );

        $this->end_controls_section();

    }

    protected function render(): void
    {
        $settings = $this->get_settings_for_display();
        $title = $settings['title'];
        $geoObjectKey = $settings['geoObjectKey'];
    ?>

        <div class="card farmacias-widget" style="width:100%;">
            <div class="card-body">
                <h5 class="card-title"><?php echo $title; ?></h5>
                <div class="card-body p-0">
            <?php
                if (!empty($geoObjectKey)) {
            ?>
                   <iframe src="https://api.wo-cloud.com/content/widget/?geoObjectKey=<?php echo $geoObjectKey; ?>&language=pt&region=PT&timeFormat=HH:mm&windUnit=kmh&systemOfMeasurement=metric&temperatureUnit=celsius" name="CW2" scrolling="no" width="418" height="318" frameborder="0" style="border: 1px solid #FFFFFF;"></iframe>
            <?php
                } else {
                    echo '<p>Preencha o geoObjectKey para apresentar conteúdo.</p>';
                }
            ?>
                </div>
            </div>
        </div>

    <?php
    }

}
