<div class="module">
    <div class="module-body table">
        <form method="POST" enctype="multipart/form-data">
			<label>
				<span class="add_product_span">Title</span>
				<input type="text" name="title" value="<?=set_value('title');?>" class="add_product_input add_prod" id='add_prod'>
				<span class='span_error'><?=form_error('title')?></span>
			</label><br>
			<label>
				<span class="add_product_span">Description</span>
				<textarea name="description" class="text_area add_prod"><?=set_value('description');?></textarea>
				<span class='span_error'><?=form_error('description')?></span>
			</label><br>
			<label>
				<span class="add_product_span">Price</span>
				<input type="text" name="price" value="<?=set_value('price');?>" class="add_product_input">
				<span class='span_error'><?=form_error('price')?></span>
			</label><br>
			<label>
				<span class="add_product_span">Image</span>
				<input type="file" name="userfile" class="add_product_input" style="padding-top: 10px; float: left;">
				<span class='span_error'><?=form_error('userfile')?></span>
			</label><br>
			<input type="submit" name="save" value="Save" class='update_edit'><br>
		</form>
    </div>
</div>