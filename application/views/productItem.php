<?php foreach($product_item as $value) : ?>
<?php 
	$img = strstr($value['image'], '550');
    if($img){
        $image =  base_url('assets/photos/eli_am')."/".$value['image'];
    }else{
        $image = base_url('assets/photos/thumbs')."/".$value['image'];
    }
?>
<!--_____ start of share button _____-->	
	<div id="fb-root"></div>
	<script>
	  	window.fbAsyncInit = function() {
			FB.init({
			    appId  : '489102077905686',
			    status : true, // check login status
			    cookie : true, // enable cookies to allow the server to access the session
			    xfbml  : true  // parse XFBML
			});
	  	};
	  	(function() {
			var e = document.createElement('script');
			e.src = document.location.protocol + '//connect.facebook.net/en_US/all.js';
			e.async = true;
			document.getElementById('fb-root').appendChild(e);
	  	}());
	</script>

	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js" type="text/javascript"></script>
	
	<script type="text/javascript">
		$(document).ready(function(){
			$('#share_button').click(function(e){
				e.preventDefault();
				FB.ui({
					method: 'feed',
					name: '<?=$value["title"] ?>',
					link: '<?=base_url("frontend")?>',
					redirect_uri: '<?=base_url("frontend")?>',
					picture: 'http://www.eastcan.org/wp-content/uploads/2012/08/shop-for-good-logo.png',
					caption: '$<?=$value["price"] ?>',
					description: "<?=$value['description'] ?>",
					message: ''
				});
			});
		});
	</script>
<!--_____ end of share button _____-->	

<!--_____ start of like part_____-->
	<div id="fb-root"></div>
		<script>
			(function(d, s, id) {
		  		var js, fjs = d.getElementsByTagName(s)[0];
		  		if (d.getElementById(id)) return;
		  		js = d.createElement(s); js.id = id;
		  		js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.3&appId=489102077905686";
		  		fjs.parentNode.insertBefore(js, fjs);
		}(document, 'script', 'facebook-jssdk'));
		</script>
<!--_____ end of like part ______-->

<!--_____ start of comment part ____-->
	<div id="fb-root"></div>
		<script>
			(function(d, s, id) {
			  	var js, fjs = d.getElementsByTagName(s)[0];
			  	if (d.getElementById(id)) return;
			  	js = d.createElement(s); js.id = id;
			  	js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.3&appId=489102077905686";
			  	fjs.parentNode.insertBefore(js, fjs);
			}(document, 'script', 'facebook-jssdk'));
		</script>
<!--_____ end of comment part _____-->

	<div class="product_item_separate">
		<div class="product_item_img">
			<span class='zoom' id='ex1'>
				<img src="<?=$image;?>">
			</span>
		</div>
		<div class="product_item_div_info">
			<span class='product_item_title'><?=$value['title'] ?></span>
			<span class='product_item_price'>$<?=$value['price'] ?></span>
			<p class="product_item_separate_p"><?=$value['description'] ?></p>
			<p class="author_date"><?=$value['date'] ?></p>
		</div>
		<img id = "share_button" src = '<?=base_url("/assets/images/share.png")?>' style='width: 100px;'><!-- Share button/image -->
		<div class="fb-like" data-href="http://localhost/Shop/frontend/productItem/186" data-layout="button_count" data-action="like" data-show-faces="false" data-share="false"></div>
		<a onclick="add_to_cart(<?=$value["id"]?>)" href="#" class='add_to_cart' style='float:right;'>Add to cart</a>
		<div class="clear"></div>
		<div class="fb-comments" data-href="http://localhost/Shop/frontend/productItem/<?=$value['id']?>" data-numposts="5" data-colorscheme="light"></div>
	</div>
<?php endforeach; ?>
