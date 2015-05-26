<div class="frontend_content">
	<?php foreach($product_list as $value) : ?>
	<?php  
		$img = strstr($value['image'], '550');
        if($img){
            $image =  base_url('assets/photos/eli_am')."/".$value['image'];
        }else{
            $image = base_url('assets/photos/thumbs')."/".$value['image'];
        }

	?>
		<a href="<?=base_url('frontend/productItem').'/'.$value['id']?>">
			<div class="product_list del_drag" id="<?=$value['cart_id']?>" title="<?=$value['title']?>">
				<img src="<?=$image?>">
				<a href="#" onclick="remove_product(<?=$value["cart_id"]?>)" id="<?=$value['cart_id']?>"><span class="glyphicon glyphicon-remove remove_product"></span></a>
				<div class='product_list_hover'>
					<span class="product_price">$<?=$value['price']?></span>
					<span class="product_name"><?=$value['title']?></span>
				</div>
			</div>
		</a>
	<?php endforeach;?>
	<!-- <img src='<?=base_url()?>/assets/images/bin.jpg' class='bin'> -->
	<div class='clear'></div>
</div>
	
<!-- 
<input type="button" id="btnOpenDialog" value="Open Confirm Dialog" />
<div id="dialog-confirm"></div> -->