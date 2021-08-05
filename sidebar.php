
<?php if( is_active_sidebar( 'sungarden-sidebar-main' ) ): ?>

    <aside class="<?php echo esc_attr( sungarden_col_sidebar() ); ?> site-sidebar order-1">
        <?php dynamic_sidebar( 'sungarden-sidebar-main' ); ?>
    </aside>

<?php endif; ?>