<?php 
	$config['image_library'] = 'imagemagick';
	$config['library_path'] = '/usr/X11R6/bin/';
	$config['source_image']	= '/assets/images/kria.jpg';
	$config['x_axis'] = '100';
	$config['y_axis'] = '60';

	$this->image_lib->initialize($config); 

	if ( ! $this->image_lib->crop())
	{
	    echo $this->image_lib->display_errors();
	}
?>