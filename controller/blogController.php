<?php

Class blogController Extends baseController {

public function index() 
{
        $this->registry->template->blog_heading = 'This is the blog Index';
        $this->registry->template->show('blog/index');
}


public function view(){

	/*** should not have to call this here.... FIX ME ***/

	$this->registry->template->blog_heading = 'This is the blog heading';
	$this->registry->template->blog_content = 'This is the blog content';
	$this->registry->template->show('blog/view');
}

public function posts($limit=0){

	/*** should not have to call this here.... FIX ME ***/
    $posts = array('uno' ,'dos' ,'tres' ,'cuatro' ,'cinco' ,'seis'  );
    
    if ($limit>0){
	    for ($i=0; $i < $limit ; $i++) { 
	    	# code...
	    	$new_posts[] = $posts[$i];
	    }
    	
    }else{
    	$new_posts = $posts;
    }

	$this->registry->template->posts = $new_posts;
	
	$this->registry->template->show('blog/posts');
}

public function posts_json($limit=0){

	/*** should not have to call this here.... FIX ME ***/
    $posts = array('uno' ,'dos' ,'tres' ,'cuatro' ,'cinco' ,'seis'  );
    
    if ($limit>0){
	    for ($i=0; $i < $limit ; $i++) { 
	    	# code...
	    	$new_posts[] = $posts[$i];
	    }
    	
    }else{
    	$new_posts = $posts;
    }

	$this->registry->template->posts = $new_posts;
	
	$this->registry->template->show('blog/posts_json');
}


public function save(){

	/*** should not have to call this here.... FIX ME ***/
    // Guardo el usuario
    $this->registry->template->usuario = $_POST['nombre'];
	$this->registry->template->show('blog/save');
}

}
?>
