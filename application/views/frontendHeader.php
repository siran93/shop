<div class="frontend_header">
	<div class="frontend_header_content">
		<ul>
			<li><a href="<?=base_url('frontend');?>"><img src="<?=base_url();?>assets/images/148.png"></a></li>
		</ul>
		<nav>
			<ul class="second_ul">
				<a href="<?=base_url('frontend');?>"><li>Home</li></a>
				<a href="<?=base_url('frontend/about');?>"><li>About Us</li></a>
				<a href="<?=base_url('frontend/news');?>"><li>News</li></a>
				<a href="#"><li>Contacts</li></a>
				<a href="<?=base_url('frontend/cart');?>">
					<li style="padding: 8.5px 20px;"  class="DropItem">
						<img src='<?=base_url()?>/assets/images/cart.jpg' class='cart_img'>
						<?php foreach($admin as $value) : ?>
							<span id='cart_count'><?=$count;?></span>
						<?php endforeach;?>
					</li>
				</a>
				<a href='<?=base_url('admin/logout');?>' class="logout_li">
					<li style="padding: 15px 20px;">
						<i class="menu-icon icon-signout"></i>Logout 
						<?php foreach($admin as $value) : ?>
							<?=$value['firstname'];?>
						<?php endforeach;?> 
					</li>
				</a>
			</ul>
		</nav>
	</div>
</div>
<div class="clear"></div>