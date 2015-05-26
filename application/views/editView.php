<div class="alert alert-success" style="display:<?=$display?>; margin-top: 19px;">
    <a href="#" class="close" data-dismiss="alert">&times;</a>
    <strong>Success!</strong> The update was successful.
</div>
<div class="module">

    <div class="module-body table">
		
        <?php foreach($product as $value) : ?>
		<?php 
			$img = strstr($value['image'], '550');
            if($img){
                $image =  base_url('assets/photos/eli_am')."/".$value['image'];
            }else{
                $image = base_url('assets/photos/thumbs')."/".$value['image'];
            }
		?>
		<form method="POST" enctype="multipart/form-data">
			<label>
				<span class="add_product_span">Title</span>
				<input type="text" name="title" class="add_product_input add_prod" value="<?=$value['title']?>">
				<span class='span_error'><?=form_error('title')?></span>
			</label><br>
			<label>
				<span class="add_product_span">Description</span>
				<textarea name="description" class="text_area add_prod"><?=$value['description']?></textarea>
				<span class='span_error'><?=form_error('description')?></span>
			</label><br>
			<label>
				<span class="add_product_span">Price</span>
				<input type="text" name="price" class="add_product_input" value="<?=$value['price']?>">
				<span class='span_error'><?=form_error('price')?></span>
			</label><br>
			<label>
				<span class="add_product_span">Image</span>
				<input type="file" name="userfile" class="add_product_input" id="userfile">
				<img src="<?=$image?>" class='edit_view_img'>
			</label><br>
			<input type="hidden" value="<?=date('Y-m-d');?>" name='date'>
			<input type="submit" name="update" value="Update" class="update_edit"><br>
			<!-- <a data-id=<?=$value['id']?> class="update_edit" id="update" data-dismiss="alert">Update</a><br> -->
			
		</form>
		<?php endforeach; ?>
    </div>
</div>
