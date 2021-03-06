<div <?php qode_framework_class_attribute( $holder_classes ); ?>>
    <div class="qodef-m-content" style="height: <?php echo esc_attr( $image_params['height'] ) ?>;">
        <?php if ( $image_action === 'custom-link' && ! empty( $link ) ) { ?>
            <a itemprop="url" href="<?php echo esc_url( $link ); ?>" target="<?php echo esc_attr( $target ); ?>">
                <div class="qodef-m-image qodef-image--original"
                     style="<?php echo esc_attr( $image_inline_style ) ?>"></div>
                <div class="qodef-m-image qodef-image--copy"
                     style="<?php echo esc_attr( $copy_image_inline_style ) ?>"></div>
            </a>
        <?php } else { ?>
            <div class="qodef-m-image qodef-image--original"
                 style="<?php echo esc_attr( $image_inline_style ) ?>"></div>
            <div class="qodef-m-image qodef-image--copy"
                 style="<?php echo esc_attr( $copy_image_inline_style ) ?>"></div>
        <?php } ?>
    </div>
    <div class="qodef-m-content qodef-marquee-mobile"
         style="height: <?php echo esc_attr( $image_params['mobile_height'] ) ?>;">
        <?php if ( $image_action === 'custom-link' && ! empty( $link ) ) { ?>
            <a itemprop="url" href="<?php echo esc_url( $link ); ?>" target="<?php echo esc_attr( $target ); ?>">
                <div class="qodef-m-image qodef-image--original"
                     style="<?php echo esc_attr( $mobile_image_inline_style ) ?>"></div>
                <div class="qodef-m-image qodef-image--copy"
                     style="<?php echo esc_attr( $copy_mobile_image_inline_style ) ?>"></div>
            </a>
        <?php } else { ?>
            <div class="qodef-m-image qodef-image--original"
                 style="<?php echo esc_attr( $mobile_image_inline_style ) ?>"></div>
            <div class="qodef-m-image qodef-image--copy"
                 style="<?php echo esc_attr( $copy_mobile_image_inline_style ) ?>"></div>
        <?php } ?>
    </div>
</div>