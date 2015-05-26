<?php 
//edit records with ajax! iaranc image uploadi!! contoller!!!!

public function edit($id)
    {
		$this->load->library('form_validation');
        $this->load->model('productItemModel');
       	$product['product'] = $this->productItemModel->getProduct($id);
		$image = $product['product'][0]['image'];
		

       	if($this->input->post('update')){
			$this->load->model('addProductModel');
			$this->form_validation->set_rules('title', 'title', 'trim');
			$this->form_validation->set_rules('description', 'description', 'trim');  
			$this->form_validation->set_rules('author', 'author', 'trim');

			if($this->form_validation->run()){
				$data['title'] = $this->input->post('title');
				$data['description'] = $this->input->post('description');
				$data['author'] = $this->input->post('author');
				$data['date'] = $this->input->post('date');

				$config['upload_path'] = './assets/photos/upload';
	            $config['allowed_types'] = 'gif|jpg|png';
	            $config['max_size'] = '10000';
	            $config['encrypt_name'] = TRUE;
	            $config['remove_spaces'] = TRUE;

	            $this->load->library('upload', $config);
	            $this->upload->initialize($config);
	            $this->upload->do_upload();
	            
	            $image_data = $this->upload->data();
	            if(empty($image_data['file_name'])){
					$data['image'] = $image;
				}
				else{
	            	$data['image'] = $image_data['file_name'];
				}
	           	
				$data['product'] = $this->addProductModel->updateRecord($data, $id);
				redirect('admin');
			}
		}
       	$this->load->view('header');
		$this->load->view('navbar');
        $this->load->view('editView', $product);
        $this->load->view('footer');
    }

 ?>

<!-- view!!!! -->
<a data-id=<?=$value['id']?> class="update_edit" id="update" data-dismiss="alert">Update</a><br>

<!-- JS -->

<script>
$('#update').on('click', function(){
    $.ajax({
        type: 'post',
        url: url2,
        data: ({
            id: $(this).data('id'),
            title: $('input[name=title]').val(),
            description:  $('textarea[name=text]').val(),
            author: $('input[name=author]').val(),
            price: $('input[name=price]').val(),
        }),
        success: function(){
            $('.alert').show();
        }
    })
})
</script>