<div class="frontend_content">
	<ul class="front_ul">
	<?php foreach($product as $value) :?>
		<?php
			$string = $value['description'];
			$string = word_limiter($string, 30);
			$word_count = str_word_count($string);
		// $string = substr($string, 0,40);//sa chor php-ov e

            $img = strstr($value['image'], '550');
            if($img){
                $image =  base_url('assets/photos/eli_am')."/".$value['image'];
            }else{
                $image = base_url('assets/photos/thumbs')."/".$value['image'];
            }
		?>
		<li class="frontend_view_items frontend_content_li" id="<?=$value['id']?>">
			<div class="product_item">
				<div class="frontend_view_img_div">
					<img src="<?=$image;?>" width='200' class='DragItem' id='<?=$value["id"]?>' title='Add me to the cart'>
				</div>
				<div class="product_item_content">
					<h2><a href="<?=base_url('frontend').'/productItem/'.$value['id'];?>" class='product_item_title'><?=$value['title'];?></a></h2>
					<span style='font-size:30px; float: right;'>&#36;<?=$value['price'];?></span>
					<div class="clear"></div>
					<p class="product_item_p"><?=$string;?></p>
				</div>
				<div style="float:left; width: 140px; margin-top: 50px;">
					<a href="<?=base_url('frontend').'/productItem/'.$value['id'];?>" class='view_det'>View Detailes</a>
					<a onclick="add_to_cart(<?=$value["id"]?>)" href="#"  class='add_to_cart'>Add to cart</a>
					<p class="author_date"><?=$value['date'];?></p>
					<div class="clear"></div>
					<div data-id=<?=$value['id'];?>>
						<ul>
							<li data-id="star1" id="star1" class="star_li" value="20"></li>
							<li data-id="star2" id="star2" class="star_li" value="40"></li>
							<li data-id="star3" id="star3" class="star_li" value="60"></li>
							<li data-id="star4" id="star4" class="star_li" value="80"></li>
							<li data-id="star5" id="star5" class="star_li" value="100"></li>
						</ul>
					</div>
				</div>
				<div class="clear"></div>
			</div>
		</li>
	<?php endforeach; ?>
		<script>

			$(document).ready(function() {
				data = JSON.parse('<?php echo json_encode($product); ?>')
				$.each(data, function( index, value ) {
					star = value['rate'];
					id = value['id'];
					if(star > 1 && star <= 20){
						$("#"+id).find('#star1').removeClass('star_anactive').addClass('star_active');
						$("#"+id).find('#star1').prevAll().removeClass('star_anactive').addClass('star_active');
					}else if(star > 21 && star <= 40){
						$("#"+id).find('#star2').removeClass('star_anactive').addClass('star_active');
						$("#"+id).find('#star2').prevAll().removeClass('star_anactive').addClass('star_active');
					}else if(star > 41 && star <= 60){
						$("#"+id).find('#star3').removeClass('star_anactive').addClass('star_active');
						$("#"+id).find('#star3').prevAll().removeClass('star_anactive').addClass('star_active');
					}else if(star > 61 && star <= 80){
					 	$("#"+id).find('#star4').removeClass('star_anactive').addClass('star_active');
						$("#"+id).find('#star4').prevAll().removeClass('star_anactive').addClass('star_active');
					}else if(star > 81 && star <= 100){
						$("#"+id).find('#star5').removeClass('star_anactive').addClass('star_active');
						$("#"+id).find('#star5').prevAll().removeClass('star_anactive').addClass('star_active');
					}
				});
			});
		</script>
	</ul>
	<?php echo $this->pagination->create_links(); ?>
	<div class="clear"></div>
</div>