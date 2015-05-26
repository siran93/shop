<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Confirm Delete</h4>
            </div>
            <div class="modal-body">
				<p>Do you want to delete this image?</p>
            </div>
            <div class="modal-footer">
                <a class="btn btn-danger btn-ok">Delete</a>
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>

<span class='span_error'><?=form_error('userfile')?></span>

<div class="module">
    <div class="module-body table">
        <form method="POST" enctype="multipart/form-data" style="margin-bottom: 30px;">
        <span class="btn btn-default btn-file browse">
            Browse <input type="file" name="userfile" >
        </span>
			<input type="submit" name="slider" value="Upload" class="update_edit" >
		</form>
        <button class="edit_slider">Edit slider images</button>
        <button class="end_editing">End Editing</button>
		<ul class="slider">
           <?php foreach($slider as $value):?>
            <?php 
                $count = count($slider);
                for ($i=0; $i < count($slider); $i++) { 
                   $array[] = $slider[$i]['id'];
                }
                
                $key = array_rand($array);
                $rand_image = $array[$key];
            ?>

				<li>
					<img src="<?=base_url().'assets/photos/slider_photos/'.$value['image']?>">
               	 	<a href = "#" data-href="<?=base_url('admin/deleteSlider').'/'.$value['id'];?>" data-toggle="modal" data-target="#confirm-delete"  style="color: #333;">
               	 		<span class="glyphicon glyphicon-remove"></span>
					</a>
                    <div class="clear"></div>
                    <input type="checkbox" name="status" value="true" id="<?=$value['id'];?>" onchange="changeSlider(<?=$value['id'];?>)" class="checkbox_input" data-id="<?=$value['id'];?>" <?=($value['status'] == 1) ? 'checked' : '';?> >
                </li>
			<?php endforeach?>
		</ul>
		<span class='span_error'><?=form_error('userfile')?></span> 
    </div>
</div>
<script>
    $(document).ready(function() {
        data = JSON.parse('<?php echo json_encode($count); ?>');
        console.log(data);
        id = JSON.parse('<?php echo json_encode($value["id"]) ?>');
         //  rand_image = JSON.parse('<?php echo json_encode($rand_image) ?>');
        
        //$('#'+rand_image).attr('checked', '=checked');
        var last = data - 1;
        if(last == 0){
            $.ajax({
                type: 'post',
                url: selectSliderImage,
                data: ({id: id}),
                success: function(){
                    $('#'+id).attr('checked');
                    $('.edit_slider').hide();
                    $('#'+id).prev().prev().hide();
                }
            })
        }
    });
</script>

