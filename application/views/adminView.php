
<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Confirm Delete</h4>
            </div>
            <div class="modal-body">
				<p>Do you want to delete this record?</p>
            </div>
            <div class="modal-footer">
                <a class="btn btn-danger btn-ok">Delete</a>
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>
<!--  onclick='return confirm_delete();'  -->
<div class="module">
    <div class="module-body table">
        <table cellpadding="0" cellspacing="0" border="0" class="datatable-1 table table-bordered table-striped	 display"
            width="100%">
            <thead>
                <tr>
                    <th>#</th>
					<th>Title</th>
					<th>Description</th>
					<th>Price</th>
					<th>Date</th>
					<th>Image</th>
					<th>Edit</th>
					<th>Delete</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($product as $value) : ?>
                    <?php
                        $img = strstr($value['image'], '550');
                        if($img){
                            $image =  base_url('assets/photos/eli_am')."/".$value['image'];
                        }else{
                            $image = base_url('assets/photos/thumbs')."/".$value['image'];
                        }
                    ?>
					<tr class="odd gradeX">
						<td><?=$value['id'];?></td>
						<td><?=$value['title'];?></td>
						<td><?=$value['description'];?></td>
						<td><?=$value['price'];?></td>
						<td><?=$value['date'];?></td>
						<td><img src="<?=$image;?>" class='admin_table_img'></td>
						<td><a href="<?=base_url('admin/edit').'/'.$value['id'];?>" data-id="<?=$value['id'];?>" class="edit_prod"><span class="glyphicon glyphicon-edit edit_icon" aria-hidden="true"></span></a></td>
						<td><a href = "#" data-href="<?=base_url('admin/delete').'/'.$value['id'];?>" data-toggle="modal" data-target="#confirm-delete"><span class="glyphicon glyphicon-trash delete_icon" aria-hidden="true"></span></a></td>
					</tr>
				<?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<div class="clear"></div>
<!--!!!!-->
        </div><!-- bacvel e navbar.php-um -->
    </div><!-- bacvel e navbar.php-um -->
    <!--/.container-->
</div><!-- bacvel e navbar.php-um -->
<!--/.wrapper-->

