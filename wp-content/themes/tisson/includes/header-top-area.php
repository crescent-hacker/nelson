<!-- #Top_area -->
<div id="Top_area">

	<!-- #Top_bar -->
	<div id="Top_bar">
		<div class="container">
			<div class="sixteen columns">				
			
				
				<?php if( mfn_opts_get('telephone-number') ): ?>
					<div class="phone">
						<i class="icon-mobile-phone"></i> 
						<a href="tel:<?php mfn_opts_show('telephone-number') ?>">
							<?php mfn_opts_show('telephone-number') ?>
						</a>
					</div>
				<?php endif; ?>	
				<div>
					<?php  echo qtrans_generateLanguageSelectCode('text'); ?>
					
				</div>
				<script charset="utf-8" src="http://wpa.b.qq.com/cgi/wpa.php"></script>
				<div id="BizQQWPA" style="float:right">
					<img style="cursor:pointer" src="/wp-content/uploads/2014/05/qq-rep.png" alt="qq"/>
				</div>
				<script>BizQQWPA.addCustom({aty: '0', a: '0', nameAccount: 3000052472, selector: 'BizQQWPA'});</script>
				<div class="one-third column last" style="float:right">
		<aside id="search-3" class="widget_alias widget_search">
			<form method="get" id="searchform" action="/">
				<input type="text" class="field" name="s" id="s" placeholder="输入你的搜索内容">
				<input type="submit" class="submit" name="submit" id="searchsubmit" value="Search">
			</form>
		</aside>
	</div>
				<!--<div class="phone">
					<ul class="qtrans_language_chooser"><li>						
					<a href="http://www.weibo.com" >
				<img src="/test/wp-content/uploads/2014/04/sina_login_btn.png"  alt="访问新浪微博">
					</a>
					</li>
					</ul>					
				</div>-->
			</div>
		</div>
	</div>
	
	<!-- #Header -->
	<header id="Header">
		<div class="container">
			<div class="sixteen columns">
			
				<!-- #logo -->
				<?php if( is_front_page() ) echo '<h1>'; ?>
				<a id="logo" href="<?php echo home_url(); ?>" title="<?php bloginfo( 'name' ); ?>">
					<img src="<?php mfn_opts_show('logo-img',THEME_URI .'/images/logo.png'); ?>" alt="<?php bloginfo( 'name' ); ?>" />
				</a>
				<?php if( is_front_page() ) echo '</h1>'; ?>
				
				<!-- main menu -->
				<?php mfn_wp_nav_menu(); ?>
				<a class="responsive-menu-toggle" href="#"><i class='icon-reorder'></i></a>
	
			</div>		
		</div>
	</header>

</div>