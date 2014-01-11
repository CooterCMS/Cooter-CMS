<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Posts extends CI_Controller {
	
	private $post_type = 'post';
	
	private $default_post = '0';

	public function __construct(){
		parent::__construct();

	  $this->load->model('posts_model');
	  
	  // Load our theme
	  $this->theme_model->load_theme();
	  
	  // Default post to be displayed	  
	  $this->default_post = $this->options_model->get_default_post();

	}

	public function index($post_value = NULL)
	{
	  $data = new stdClass;

	  if($post_value == NULL){
	  	
	  	$data->post_data = $this->posts_model->get_post($this->default_post, $this->post_type);

	  }else{
	  
	    $data->post_data = $this->posts_model->get_post($post_value, $this->post_type);

	  }
	  // Load meta for the post
	  $this->theme_model->load_meta($data->post_data[0]->name);
	  // Add post title  
	  $this->template->addtitle($data->post_data[0]->title);
	  // Setup and Load the template
	  $template_data = $this->template->load($this->template->get_template_dir().$data->post_data[0]->post_view, $data);
	  // Load the view	
	  $this->load->view($template_data->template, $template_data);
	}		

}

/* End of file posts.php */
/* Location: ./application/controllers/posts.php */
?>