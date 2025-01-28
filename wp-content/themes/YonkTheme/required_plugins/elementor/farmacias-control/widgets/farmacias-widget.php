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
class Elementor_Farmacias_Widget extends \Elementor\Widget_Base
{
    public function get_name(): string
    {
        return 'farmacias_Widget';
    }

    public function get_title(): string
    {
        return esc_html__('Farmácias', 'blank');
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
        return ['farmacias'];
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
                'default' => esc_html__('Farmácias de Serviço', 'blank'),
            ]
        );

        $this->add_control(
            'stape',
            [
                'label' => esc_html__('STAPE', 'blank'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'default' => 1106
            ]
        );

        $this->end_controls_section();

    }

    protected function render(): void
    {
        $settings = $this->get_settings_for_display();
        $title = $settings['title'];
        $stape = $settings['stape'];

        if (!empty($stape)) {
            $stape = str_pad($stape, 4, '0', STR_PAD_LEFT);
            $did = substr($stape, 0, 2);
            $cid = substr($stape, 0, 4);
        }

    ?>

        <div class="card farmacias-widget" style="width:100%;">
            <div class="card-body">
                <h5 class="card-title"><?php echo $title; ?></h5>
                <div class="card-body p-0">
            <?php
                if (!empty($stape)) {
            ?>
                    <iframe
                        src="https://www.farmaciasdeservico.info/farm.php?did=<?php echo $did; ?>&cid=<?php echo $cid; ?>&fa=&font=Arial&bgcolor=ffffff&cortitulo=222222&cordescricao=888888"
                        frameborder="0" allowtransparency="true" style="width:100%;height:400px"></iframe>
            <?php
                } else {
                    echo '<p>Preencha o STAPE para apresentar conteúdo.</p>';
                }
            ?>
                </div>
            </div>
        </div>

    <?php
    }

}
