<div class="module">
    <div class="module-body table">
        <table cellpadding="0" cellspacing="0" border="0" class="datatable-1 table table-bordered table-striped	 display"
            width="100%">
            <thead>
                <tr>
                    <th>#</th>
					<th>User Name</th>
					<th>Spend</th>
					<th>Total Product</th>
					<th>Start Day</th>
					<th>Last Action in Cart</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($history as $value) : ?>
					<tr class="odd gradeX">
						<td><?=$value['id'];?></td>
						<td><?=$value['firstname'];?></td>
						<td><?=$value['product_count'];?></td>
						<td><?=$value['total_price']?></td>
						<td><?=$value['created_date']?></td>
						<td><?=$value['last_action']?></td>
						
					</tr>
				<?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>