<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Front End Controller
 */
class Home extends FE_Controller 
{

	/**
	 * constructs required variables
	 */
	function __construct()
	{
		parent::__construct( NO_AUTH_CONTROL, 'HOME' );

	}

	/**
	 *  Home Page
	 */
	function home()
	{
		$this->load_template( 'home' );
	}

	/**
	 * Register Page
	 */
	function register()
	{
		if($this->get_data('submit') != NULL ){
			if($this->get_data('user_id') == '') {
				$code = generate_random_string(5);
				$user_data = array(
					"user_name" => $this->get_data( 'user_name' ),
					"user_email" => $this->get_data( 'user_email' ),
					"user_password" => md5($this->get_data( 'user_password' )),
					"code" =>  $code,
		        	"email_verify" => 1,
		        	"status" => 2 //Need to verified status
				);
				$conds['user_email'] = $user_data['user_email'];
		        $conds['status'] = 2;
		       	$user_infos = $this->User->user_exists($conds)->result();

		       	if (empty($user_infos)) {

		       		if ( !$this->User->save($user_data)) {

		        		$this->set_flash_msg( 'error', get_msg( 'err_user_register' ));
		        	} else {
		        		$subject = "New User Account Registration";

			        	if ( !send_user_register_email( $user_data['user_id'], $subject )) {

							$this->error_response( get_msg( 'user_register_success_but_email_not_send' ));
						
						} 
		        	}

		        } else {
		        	$user_id = $user_infos[0]->user_id;
		       		$subject = get_msg('user_acc_reg_label');

		       		if ( !send_user_register_email( $user_id, $subject )) {

						$this->set_flash_msg( 'error', get_msg( 'user_register_success_but_email_not_send' ));
					
					} 
		        }
		        $this->data['register'] = $this->User->get_one($user_data['user_id']);
		        $this->data['user_id'] = $user_data['user_id'];
		    } else {
		    	$user_verify_data = array(
		        	"code"     => $this->get_data('code'),
		        	"user_id"  => $this->get_data('user_id')
		        );

				$user_id = $this->User->get_one_by($user_verify_data)->user_id;

		        if($user_id  == $this->get_data('user_id')) {
		        	$user_data = array(
			        	"code"    => " ",
			        	"status"  => 1
		        	);
		        	$this->User->save($user_data,$user_id);
		        	
		        	$this->set_flash_msg( 'success', get_msg( 'success_user_regi' )); 
		        } else {

		        	$this->set_flash_msg( 'error', get_msg( 'invalid_code' )); 

		        }
		    }
	    }
		$this->load_template( 'register' );
	}

	

	/**
	 * LOgin Page
	 */
	function userlogin() {
		
		if ( $this->ps_auth->is_logged_in() ) {
		 // if the user is already logged in, redirect to respective url
			
			$this->redirect_url();
		}

		if ( $this->is_POST() ) {
		// if the user is not yet logged in, authenticate url or load the login form view

			if ( $this->is_valid_login_input()) {
			// if valid input,

				// if request is post method, login and redirect
				$user_email = $this->get_data( 'user_email' );
				$user_password = $this->get_data( 'user_password' );

				if ( ! $this->ps_auth->login( $user_email, $user_password )) {
				// if credentail is wrong, redirect to login
				
					$this->set_flash_msg( 'error', 'error_login' );
					redirect( 'userlogin' );
				} else {
					$conds['user_email'] = $user_email;
					$role_id = $this->User->get_one_by($conds)->role_id;
					if ($role_id != '4') {
						// if credential is correct, redirect to respective url

						$this->redirect_url();
					} else {
						$this->set_flash_msg('error',"You don't have access to admin panel.");
					}
				}
			}
		}

		// load login form 
		$this->load_template( 'login' );
	}

	/**
	 * redirects to the respective urls based on user action
	 * 
	 */
	function redirect_url()
	{
		/* different urls based on user credential */
		$admin_url = site_url( 'home' );
		$login_url = site_url( 'userlogin ');
		$frontend_url = site_url();

		if ( null !== $this->session->userdata( 'source_url' )) {
		// if coming from existing url
			
			$source_url = $this->session->userdata( 'source_url' );
			$this->session->unset_userdata( 'source_url' );
			redirect( $source_url );		

		} else if ( !$this->ps_auth->is_logged_in() ) {
		// if user is not yet logged in, redirect to login
		
			redirect( $login_url );
		} else if ( $this->ps_auth->is_frontend_user() ) {
		// if the logged in user is frontend user, 

			redirect( $frontend_url );
		} else if ( $this->ps_auth->is_system_user() ) {
		// if the logged in user is system user, redirect to admin
			
			redirect( $admin_url );
		} else {
		// if the logged in user is not frontend user, redirect to dashbaord
			
			//$this->goto_approved_cities();
		}
	}

	/**
	 * Determines if valid input
	 */
	function is_valid_login_input() {

		$validation = array(
			array(
				'field' => 'user_email',
				'label' => get_msg( 'email' ),
				'rules' => 'trim|required|valid_email'
			),
			array(
				'field' => 'user_password',
				'label' => get_msg( 'password' ),
				'rules' => 'trim|required'
			)
		);

		$this->form_validation->set_rules( $validation );

		if ( $this->form_validation->run() == FALSE ) {
		// if there is an error in validating, 
			
			$this->session->set_flashdata('error', validation_errors());
			return false;
		}

		return true;
	}

	/**
	 * Rest password by email
	 */
	function reset_password() {

		if ( $this->is_POST() ) {
		// if the user is not yet logged in, authenticate url or load the login form view
			if ( $this->is_valid_reset_request_input()) {
			// if valid input,

				// get email and user info
				$user_email = $this->get_data( 'user_email' );
				
				$user_info = $this->User->get_one_by( array( "user_email" => $user_email ));

		        if ( isset( $user_info->is_empty_object )) {
		        // if user info is empty,
		        	
		        	$this->set_flash_msg( 'error', 'err_user_not_exist' );
					redirect( 'reset_request' );
		        }

				// generate code
		        $code = md5(time().'teamps');

		        // insert to reset
		        $data = array(
					'user_id' => $user_info->user_id,
					'code' => $code
				);

				if ( !$this->ResetCode->save( $data )) {
				// if error in inserting,

					$this->set_flash_msg( 'error', 'err_model' );
					redirect( 'reset_request' );
				}

				// Send email with reset code
				$to = $user_info->user_email;
			    $subject = get_msg('pwd_reset_label');
				$msg = "<p>Hi,". $user_info->user_name ."</p>".
							"<p>".get_msg( 'pwd_reset_link' )."<br/>".
							"<a href='". site_url( $this->config->item( 'reset_url') .'/'. $code ) ."'>".get_msg( 'reset_link_label' )."</a></p>".
							"<p>".get_msg( 'best_regards_label' ).",<br/>". $this->Backend_config->get_one('be1')->sender_name ."</p>";

				// send email from admin
				if ( ! $this->ps_mail->send_from_admin( $to, $subject, $msg ) ) {

					$this->set_flash_msg( 'error', 'err_email_not_send' );
					redirect( 'reset_request' );
				}
				
				$this->set_flash_msg( 'success', 'success_reset_email_sent' );
				redirect( 'reset_request' );
			}
		}
		
		// load reset form 
		$this->load_template( 'reset_request' );
	}

	function is_valid_reset_request_input() {

		$rules = array(
			array(
				'field' => 'user_email',
				'label' => get_msg( 'email' ),
				'rules' => 'trim|required|valid_email'
			)
		);
		
		$this->form_validation->set_rules( $rules );

		if ( $this->form_validation->run() == FALSE ) {
		// if there is an error in validating, 
			
			$this->session->set_flashdata('error', validation_errors());
			return false;
		}

		return true;
	}

	/**
	 * Logout from the system
	 */
	function userlogout() {
		// logout 
		$this->ps_auth->logout();

		// redirect
		$this->redirect_url();
	}

	/**
	 * Privacy Policy Page
	 */
	function privacy_policy()
	{
		$content = $this->Privacy_policy->get_one('privacy1')->content;
		$this->data['content'] = $content;
		$this->load_template( 'privacy_policy' );
	}

	/**
	 *  Blog Page
	 */
	function blog($page=1)
	{
		$total = $this->Feed->count_all_by( array( 'no_publish_filter' => 1 ) );
	 	$pag = $this->config->item( 'blog_display_limit' );
	 	$noofpage = ceil($total/$pag);
	 	$conds['status'] = 1;
	 	$offset = (($page-1)*$pag);
	 	$limit = $pag;
		$blogs = $this->Feed->get_all_by( array( 'no_publish_filter' => 1 ), $limit, $offset );
		$this->data['blogs'] = $blogs;
		$this->data['blogs_count'] = $this->Feed->count_all_by( array( 'no_publish_filter' => 1 ));
		$this->data['current'] = $page;
		$this->data['noofpage'] =$noofpage;
		$this->load_template( 'blog' );
	}

	/**
	 * Blog Detail Page
	 */
	function blogdetail($id)
	{
		// load blog
		$this->data['blog'] = $this->Feed->get_one( $id );
		$this->load_template( 'blogdetail' );
	}

	/**
	 * Search Result Page
	 */
	function search($page=1)
	{
		
	 	// condition with search term
		if($this->input->post('submit') != NULL ){
			if ($this->get_data( 'title' ) != '') {
				$conds['title'] = $this->get_data( 'title' );
				$this->session->set_userdata(array("title" => $this->input->post('title')));
				$this->data['item_title'] = $this->session->userdata('title');
			}
		
			if ($this->get_data('item_location_id') != '' || $this->get_data('item_location_id') != '0') {
				$conds['item_location_id'] = $this->get_data('item_location_id');
				$this->session->set_userdata(array("item_location_id" => $this->input->post('item_location_id')));
				$this->data['item_location_id'] = $this->session->userdata('item_location_id');
			}
			
			if ($this->get_data('cat_id') != '' || $this->get_data('cat_id') != '0') {
				$conds['cat_id'] = $this->get_data('cat_id');
				$this->session->set_userdata(array("cat_id" => $this->input->post('cat_id')));
				$this->data['cat_id'] = $this->session->userdata('cat_id');
			}
		} else {
			//read from session value
			if($this->session->userdata('title') != NULL){
				$conds['title'] = $this->session->userdata('title');
				$this->data['item_title'] = $this->session->userdata('title');
			}

			if($this->session->userdata('item_location_id') != NULL){
				$conds['item_location_id'] = $this->session->userdata('item_location_id');
				$this->data['item_location_id'] = $this->session->userdata('item_location_id');
			}

			if($this->session->userdata('cat_id') != NULL){
				$conds['cat_id'] = $this->session->userdata('cat_id');
				$this->data['cat_id'] = $this->session->userdata('cat_id');
			}

		}

		// search data
		$total = $this->Item->count_all_by( $conds );
	 	$pag = $this->config->item( 'item_display_limit' );
	 	$noofpage = ceil($total/$pag);
	 	$conds['status'] = 1;
	 	$offset = (($page-1)*$pag);
	 	$limit = $pag;
		$this->data['items'] = $this->Item->get_all_by( $conds, $limit, $offset );
		$this->data['current'] = $page;
		$this->data['noofpage'] =$noofpage;
		$this->load_template( 'search' );
	}

	/**
	 * Category Page
	 */
	function categories()
	{
		// no publish filter
		$conds['no_publish_filter'] = 1;
		$conds['order_by'] = 1;
		$conds['order_by_field'] = "added_date";
		$conds['order_by_type'] = "desc";
		
		// get categories
		$this->data['categories'] = $this->Category->get_all_by( $conds );		
		$this->load_template( 'category' );
	}

	/**
	 * Ads List Page
	 */
	function listing($id,$page=1)
	{
		
		$conds['cat_id'] = $id;
		
		// get items
		$total = $this->Item->count_all_by( $conds );
	 	$pag = $this->config->item( 'item_display_limit' );
	 	$noofpage = ceil($total/$pag);
	 	$conds['status'] = 1;
	 	$offset = (($page-1)*$pag);
	 	$limit = $pag;
		$this->data['items'] = $this->Item->get_all_by( $conds, $limit, $offset );	
		$this->data['current'] = $page;
		$this->data['noofpage'] =$noofpage;	
		$this->data['cat_id'] =$conds['cat_id'];
		$this->load_template( 'listing' );
	}

	/**
	 * Contact Page
	 */
	function contact()
	{
		if ( $this->is_POST() ) {
			//contact_name
		   	if ( $this->has_data( 'contact_name' )) {
				$data['contact_name'] = $this->get_data( 'contact_name' );

			}

		   	// contact_email
		   	if ( $this->has_data( 'contact_email' )) {
				$data['contact_email'] = $this->get_data( 'contact_email' );
			}

			// contact_phone
		   	if ( $this->has_data( 'contact_phone' )) {
				$data['contact_phone'] = $this->get_data( 'contact_phone' );
			}

			// contact_message
		   	if ( $this->has_data( 'contact_message' )) {
				$data['contact_message'] = $this->get_data( 'contact_message' );
			}

			// set timezone

			if($contact_id == "") {
				//save
				$data['added_date'] = date("Y-m-d H:i:s");

			}
			// print_r($data);die;
			//save item
			if ( ! $this->Contact->save( $data, $contact_id )) {
			// if there is an error in inserting user data,	

				// rollback the transaction
				$this->db->trans_rollback();

				// set error message
				$this->data['error'] = get_msg( 'err_model' );
				
				return;
			}

			
			/** 
			 * Check Transactions 
			 */

			// commit the transaction
			if ( ! $this->check_trans()) {
	        	
				// set flash error message
				$this->set_flash_msg( 'error', get_msg( 'err_model' ));
			} else {

				if ( $contact_id ) {
				// if user id is not false, show success_add message
					
					$this->set_flash_msg( 'success', get_msg( 'success_contact_edit' ));
				} else {
				// if user id is false, show success_edit message

					$this->set_flash_msg( 'success', get_msg( 'success_contact_add' ));
				}
			}

		}
		$this->load_template( 'contact' );
	}

	/**
	 * Add Ads Page
	 */
	function additem()
	{
		$logged_in_user = $this->ps_auth->get_user_info();
		if ( !isset( $logged_in_user->user_id )) {
			$this->load_template( 'login' );
		} else {
			if ( $this->is_POST() ) {
				// Item id
			   	if ( $this->has_data( 'id' )) {
					$data['id'] = $this->get_data( 'id' );

				}

			   	// Category id
			   	if ( $this->has_data( 'cat_id' )) {
					$data['cat_id'] = $this->get_data( 'cat_id' );
				}

				// Sub Category id
			   	if ( $this->has_data( 'sub_cat_id' )) {
					$data['sub_cat_id'] = $this->get_data( 'sub_cat_id' );
				}

				// Type id
			   	if ( $this->has_data( 'item_type_id' )) {
					$data['item_type_id'] = $this->get_data( 'item_type_id' );
				}

				// Price id
			   	if ( $this->has_data( 'item_price_type_id' )) {
					$data['item_price_type_id'] = $this->get_data( 'item_price_type_id' );
				}

				// Currency id
			   	if ( $this->has_data( 'item_currency_id' )) {
					$data['item_currency_id'] = $this->get_data( 'item_currency_id' );
				}

				// location id
			   	if ( $this->has_data( 'item_location_id' )) {
					$data['item_location_id'] = $this->get_data( 'item_location_id' );
				}

				//title
			   	if ( $this->has_data( 'title' )) {
					$data['title'] = $this->get_data( 'title' );
				}

				//condition of item
			   	if ( $this->has_data( 'condition_of_item_id' )) {
					$data['condition_of_item_id'] = $this->get_data( 'condition_of_item_id' );
				}

				// description
			   	if ( $this->has_data( 'description' )) {
					$data['description'] = $this->get_data( 'description' );
				}

				// highlight_info
			   	if ( $this->has_data( 'highlight_info' )) {
					$data['highlight_info'] = $this->get_data( 'highlight_info' );
				}

				// price
			   	if ( $this->has_data( 'price' )) {
					$data['price'] = $this->get_data( 'price' );
				}

				// brand
			   	if ( $this->has_data( 'brand' )) {
					$data['brand'] = $this->get_data( 'brand' );
				}

				// address
			   	if ( $this->has_data( 'address' )) {
					$data['address'] = $this->get_data( 'address' );
				}

				// deal_option_id
			   	if ( $this->has_data( 'deal_option_id' )) {
					$data['deal_option_id'] = $this->get_data( 'deal_option_id' );
				}

				// prepare Item lat
				if ( $this->has_data( 'lat' )) {
					$data['lat'] = $this->get_data( 'lat' );
				}

				// prepare Item lng
				if ( $this->has_data( 'lng' )) {
					$data['lng'] = $this->get_data( 'lng' );
				}

				// if 'is_sold_out' is checked,
				if ( $this->has_data( 'is_sold_out' )) {
					$data['is_sold_out'] = 1;
				} else {
					$data['is_sold_out'] = 0;
				}

				// if 'business_mode' is checked,
				if ( $this->has_data( 'business_mode' )) {
					$data['business_mode'] = 1;
				} else {
					$data['business_mode'] = 0;
				}

				// if 'status' is checked,
				if ( $this->has_data( 'status' )) {
					$data['status'] = 1;
				} else {
					$data['status'] = 0;
				}

				// set timezone

				if($id == "") {
					//save
					$data['added_date'] = date("Y-m-d H:i:s");
					$data['added_user_id'] = $logged_in_user->user_id;

				} else {
					//edit
					unset($data['added_date']);
					$data['updated_date'] = date("Y-m-d H:i:s");
					$data['updated_user_id'] = $logged_in_user->user_id;
				}
				//save item
				if ( ! $this->Item->save( $data, $id )) {
				// if there is an error in inserting user data,	

					// rollback the transaction
					$this->db->trans_rollback();

					// set error message
					$this->data['error'] = get_msg( 'err_model' );
					
					return;
				}

				/** 
				 * Upload Image Records 
				 */
				if ( !$id ) {
					if ( ! $this->insert_images( $_FILES, 'item', $data['id'] )) {
						// if error in saving image

						// commit the transaction
						$this->db->trans_rollback();
						
						return;
					}
					
				}

				
				/** 
				 * Check Transactions 
				 */

				// commit the transaction
				if ( ! $this->check_trans()) {
		        	
					// set flash error message
					$this->set_flash_msg( 'error', get_msg( 'err_model' ));
				} else {

					if ( $id ) {
					// if user id is not false, show success_add message
						
						$this->set_flash_msg( 'success', get_msg( 'success_prd_edit' ));
					} else {
					// if user id is false, show success_edit message

						$this->set_flash_msg( 'success', get_msg( 'success_prd_add' ));
					}
				}

				//get inserted item id	
				$id = ( !$id )? $data['id']: $id ;
				
				// Item Id Checking 
				// if ( $this->has_data( 'gallery' )) {
				// // if there is gallery, redirecti to gallery
				// 	redirect( $this->module_site_url( 'gallery/' .$id ));
				// } else if ( $this->has_data( 'promote' )) {
				// 	redirect( $this->module_site_url( 'promote/' .$id ));
				// } else {
					// redirect to list view
					$this->load_template( 'additem' );
				//}
			}
			$this->load_template( 'additem' );
		}
	}

	function get_all_sub_categories( $cat_id )
    {
    	$conds['cat_id'] = $cat_id;
    	
    	$sub_categories = $this->Subcategory->get_all_by($conds);
		echo json_encode($sub_categories->result());
    }

    /**
	 * Show Gallery
	 *
	 * @param      <type>  $id     The identifier
	 */
	function gallery( $id ) {
		// breadcrumb urls
		$edit_item = get_msg('prd_edit');

		$this->data['action_title'] = array( 
			array( 'url' => 'edit/'. $id, 'label' => $edit_item ), 
			array( 'label' => get_msg( 'item_gallery' ))
		);
		
		$_SESSION['parent_id'] = $id;
		$_SESSION['type'] = 'item';
    	    	
    	$this->load_gallery();
    }

    function insert_images( $files, $img_type, $img_parent_id )
	{

		// return false if the image type is empty
		if ( empty( $img_type )) return false;

		// return false if the parent id is empty
		if ( empty( $img_parent_id )) return false;

		// upload images
		//print_r($files); die;
		$upload_data = $this->ps_image->upload( $files );
			
		if ( isset( $upload_data['error'] )) {
		// if there is an error in uploading

			// set error message
			$this->data['error'] = $upload_data['error'];
			
			return;
		}

		// save image 
		foreach ( $upload_data as $upload ) {
			if ($upload['image_width'] == "" && $upload['file_ext'] == ".ico") {
				// prepare image data
				$image = array(
					'img_parent_id'=> $img_parent_id,
					'img_type' => $img_type,
					'img_desc' => "",
					'img_path' => $upload['file_name'],
					'img_width'=> "",
					'img_height'=> ""
				);
			} else {
				// prepare image data
				$image = array(
					'img_parent_id'=> $img_parent_id,
					'img_type' => $img_type,
					'img_desc' => "",
					'img_path' => $upload['file_name'],
					'img_width'=> $upload['image_width'],
					'img_height'=> $upload['image_height']
				);
			}

			if ( ! $this->Image->save( $image )) {
			// if error in saving image
				
				// set error message
				$this->data['error'] = get_msg( 'err_model' );
				
				return false;
			}
		}

		return true;
	}

    /**
	 * Ads single Page
	 */
	function listing_single($id)
	{
		// load ads single
		$this->data['item'] = $this->Item->get_one( $id );
		$this->load_template( 'listing_single' );
	}


	/**
	* User Profile Page
	*/
	function userprofile() {
		// profile 
		$this->load_template( 'profile' );
	}

	
}