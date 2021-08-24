</div><!--End Sticky Footer-->

<?php
global $sungarden_options;

$phone = $sungarden_options['sungarden_information_phone'] ? : '';

if ( $phone ) :
?>

<div class="footer-box-phone">
    <a class="d-flex align-items-center" href="tel:<?php echo esc_attr( phone_number_format( $phone ) ); ?>">
        <span class="line"></span>
        <span class="icon"><i class="fas fa-phone-alt"></i></span>
        <span class="phone"><?php echo esc_html( $phone ) ?></span>
    </a>
</div>

<?php endif; ?>

<footer class="site-footer">

    <?php get_template_part( 'template-parts/footer/inc','multi-column' ); ?>

</footer>

<?php wp_footer(); ?>

</body>
</html>
