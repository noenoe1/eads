<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Items Controller
 */
class Items extends BE_Controller {

	/**
	 * Construt required variables
	 */
	function __construct() {

		parent::__construct( MODULE_CONTROL, 'item_module' );
	}

	/**
	 * List down the registered users
	 */
	function index() {

		// get rows count
		$this->data['rows_count'] = $this->Item->count_all_by( $conds );

		// get categories
		$this->data['items'] = $this->Item->get_all_by( $conds , $this->pag['per_page'], $this->uri->segment( 4 ) );


		// load index logic
		parent::index();
	}

	/**
	 * Searches for the first match.
	 */
	function search() {

		// breadcrumb urls
		$this->data['action_title'] = get_msg( 'prd_search' );

		// condition with search term
		if($this->input->post('submit') != NULL ){

			if($this->input->post('searchterm') != "") {
				$conds['searchterm'] = $this->input->post('searchterm');
				$this->data['searchterm'] = $this->input->post('searchterm');
				$this->session->set_userdata(array("searchterm" => $this->input->post('searchterm')));
			} else {
				
				$this->session->set_userdata(array("searchterm" => NULL));
			}
			
			if($this->input->post('cat_id') != ""  || $this->input->post('cat_id') != '0') {
				$conds['cat_id'] = $this->input->post('cat_id');
				$this->data['cat_id'] = $this->input->post('cat_id');
				$this->data['selected_cat_id'] = $this->input->post('cat_id');
				$this->session->set_userdata(array("cat_id" => $this->input->post('cat_id')));
				$this->session->set_userdata(array("selected_cat_id" => $this->input->post('cat_id')));
			} else {
				$this->session->set_userdata(array("cat_id" => NULL ));
			}

			if($this->input->post('sub_cat_id') != ""  || $this->input->post('sub_cat_id') != '0') {
				$conds['sub_cat_id'] = $this->input->post('sub_cat_id');
				$this->data['sub_cat_id'] = $this->input->post('sub_cat_id');
				$this->session->set_userdata(array("sub_cat_id" => $this->input->post('sub_cat_id')));
			} else {
				$this->session->set_userdata(array("sub_cat_id" => NULL ));
			}

			if($this->input->post('item_price_type_id') != ""  || $this->input->post('item_price_type_id') != '0') {
				$conds['item_price_type_id'] = $this->input->post('item_price_type_id');
				$this->data['item_price_type_id'] = $this->input->post('item_price_type_id');
				
				$this->session->set_userdata(array("item_price_type_id" => $this->input->post('item_price_type_id')));
				
			} else {
				$this->session->set_userdata(array("item_price_type_id" => NULL ));
			}

			if($this->input->post('item_type_id') != ""  || $this->input->post('item_type_id') != '0') {
				$conds['item_type_id'] = $this->input->post('item_type_id');
				$this->data['item_type_id'] = $this->input->post('item_type_id');
				
				$this->session->set_userdata(array("item_type_id" => $this->input->post('item_type_id')));
				
			} else {
				$this->session->set_userdata(array("item_type_id" => NULL ));
			}

			if($this->input->post('item_currency_id') != ""  || $this->input->post('item_currency_id') != '0') {
				$conds['item_currency_id'] = $this->input->post('item_currency_id');
				$this->data['item_currency_id'] = $this->input->post('item_currency_id');
				
				$this->session->set_userdata(array("item_currency_id" => $this->input->post('item_currency_id')));
				
			} else {
				$this->session->set_userdata(array("item_currency_id" => NULL ));
			}

			if($this->input->post('status') != "0") {
				
				$conds['status'] = $this->input->post('status');
				$this->data['status'] = $this->input->post('status');
				$this->session->set_userdata(array("status" => $this->input->post('status')));
			
			} else {
				$this->session->set_userdata(array("status" => NULL ));
			}



		} else {
			//read from session value
			if($this->session->userdata('searchterm') != NULL){
				$conds['searchterm'] = $this->session->userdata('searchterm');
				$this->data['searchterm'] = $this->session->userdata('searchterm');
			}

			if($this->session->userdata('cat_id') != NULL){
				$conds['cat_id'] = $this->session->userdata('cat_id');
				$this->data['cat_id'] = $this->session->userdata('cat_id');
				$this->data['selected_cat_id'] = $this->session->userdata('cat_id');
			}

			if($this->session->userdata('sub_cat_id') != NULL){
				$conds['sub_cat_id'] = $this->session->userdata('sub_cat_id');
				$this->data['sub_cat_id'] = $this->session->userdata('sub_cat_id');
				$this->data['selected_cat_id'] = $this->session->userdata('cat_id');
			}

			if($this->session->userdata('item_price_type_id') != NULL){
				$conds['item_price_type_id'] = $this->session->userdata('item_price_type_id');
				$this->data['item_price_type_id'] = $this->session->userdata('item_price_type_id');
			}

			if($this->session->userdata('item_type_id') != NULL){
				$conds['item_type_id'] = $this->session->userdata('item_type_id');
				$this->data['item_type_id'] = $this->session->userdata('item_type_id');
			}

			if($this->session->userdata('item_currency_id') != NULL){
				$conds['item_currency_id'] = $this->session->userdata('item_currency_id');
				$this->data['item_currency_id'] = $this->session->userdata('item_currency_id');
			}
		
			if($this->session->userdata('status') != 0){
				$conds['status'] = $this->session->userdata('status');
				$this->data['status'] = $this->session->userdata('status');
			}
			

		}

		if ($conds['status'] == "Select Status") {
			$conds['status'] = "1";
		}


		// pagination
		$this->data['rows_count'] = $this->Item->count_all_by( $conds );

		// search data
		$this->data['items'] = $this->Item->get_all_by( $conds, $this->pag['per_page'], $this->uri->segment( 4 ) );

		// load add list
		parent::search();
	}

	/**
	 * Saving Logic
	 * 1) upload image
	 * 2) save category
	 * 3) save image
	 * 4) check transaction status
	 *
	 * @param      boolean  $id  The user identifier
	 */
	function save( $id = false ) {
		
			$logged_in_user = $this->ps_auth->get_user_info();

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
		if ( $this->has_data( 'gallery' )) {
		// if there is gallery, redirecti to gallery
			redirect( $this->module_site_url( 'gallery/' .$id ));
		} else if ( $this->has_data( 'promote' )) {
			redirect( site_url( ) . '/admin/paid_items/add/'.$id);
		}
		else {
		// redirect to list view
			redirect( $this->module_site_url() );
		}
	}

	//get all subcategories when select category

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

    /**
	 * Create new one
	 */
	function add() {

		// breadcrumb urls
		$this->data['action_title'] = get_msg( 'prd_add' );

		// call the core add logic
		parent::add();
	}


	/**
 	* Update the existing one
	*/
	function edit( $id ) 
	{
		
		// breadcrumb urls
		$this->data['action_title'] = get_msg( 'prd_edit' );

		// load user
		$this->data['item'] = $this->Item->get_one( $id );

		// call the parent edit logic
		parent::edit( $id );

	}

	/**
	 * Determines if valid input.
	 *
	 * @return     boolean  True if valid input, False otherwise.
	 */
	function is_valid_input( $id = 0 ) 
	{
		
		$rule = 'required|callback_is_valid_name['. $id  .']';

		$this->form_validation->set_rules( 'title', get_msg( 'name' ), $rule);
		
		if ( $this->form_validation->run() == FALSE ) {
		// if there is an error in validating,

			return false;
		}

		return true;
	}

	/**
	 * Determines if valid name.
	 *
	 * @param      <type>   $name  The  name
	 * @param      integer  $id     The  identifier
	 *
	 * @return     boolean  True if valid name, False otherwise.
	 */
	function is_valid_name( $name, $id = 0 )
	{		
		 $conds['title'] = $name;
		
		if ( strtolower( $this->Item->get_one( $id )->title ) == strtolower( $name )) {
		// if the name is existing name for that user id,
			return true;
		} else if ( $this->Item->exists( ($conds ))) {
		// if the name is existed in the system,
			$this->form_validation->set_message('is_valid_name', get_msg( 'err_dup_name' ));
			return false;
		}
		return true;
	}


	/**
	 * Delete the record
	 * 1) delete Item
	 * 2) delete image from folder and table
	 * 3) check transactions
	 */
	function delete( $id ) 
	{
		// start the transaction
		$this->db->trans_start();

		// check access
		$this->check_access( DEL );

		// delete categories and images
		$enable_trigger = true; 
		
		// delete categories and images
		//if ( !$this->ps_delete->delete_product( $id, $enable_trigger )) {
		$type = "item";

		if ( !$this->ps_delete->delete_history( $id, $type, $enable_trigger )) {

			// set error message
			$this->set_flash_msg( 'error', get_msg( 'err_model' ));

			// rollback
			$this->trans_rollback();

			// redirect to list view
			redirect( $this->module_site_url());
		}
		/**
		 * Check Transcation Status
		 */
		if ( !$this->check_trans()) {

			$this->set_flash_msg( 'error', get_msg( 'err_model' ));	
		} else {
        	
			$this->set_flash_msg( 'success', get_msg( 'success_prd_delete' ));
		}
		
		redirect( $this->module_site_url());
	}


	/**
	 * Check Item name via ajax
	 *
	 * @param      boolean  $Item_id  The cat identifier
	 */
	function ajx_exists( $id = false )
	{
		
		// get Item name
		$name = $_REQUEST['title'];
		
		if ( $this->is_valid_name( $name, $id )) {
		// if the Item name is valid,
			
			echo "true";
		} else {
		// if invalid Item name,
			
			echo "false";
		}
	}
	/**
	 * Publish the record
	 *
	 * @param      integer  $prd_id  The Item identifier
	 */
	function ajx_publish( $item_id = 0 )
	{
		// check access
		$this->check_access( PUBLISH );
		
		// prepare data
		$prd_data = array( 'status'=> 1 );
			
		// save data
		if ( $this->Item->save( $prd_data, $item_id )) {
			//Need to delete at history table because that wallpaper need to show again on app
			$data_delete['item_id'] = $item_id;
			$this->Item_delete->delete_by($data_delete);
			echo 'true';
		} else {
			echo 'false';
		}
	}
	
	/**
	 * Unpublish the records
	 *
	 * @param      integer  $prd_id  The category identifier
	 */
	function ajx_unpublish( $item_id = 0 )
	{
		// check access
		$this->check_access( PUBLISH );
		
		// prepare data
		$prd_data = array( 'status'=> 0 );
			
		// save data
		if ( $this->Item->save( $prd_data, $item_id )) {

			//Need to save at history table because that wallpaper no need to show on app
			$data_delete['item_id'] = $item_id;
			$this->Item_delete->save($data_delete);
			echo 'true';
		} else {
			echo 'false';
		}
	}

 }