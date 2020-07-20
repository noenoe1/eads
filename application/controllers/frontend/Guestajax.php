<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Front End Controller
 */
class Guestajax extends Ajax_Controller {

	/**
	 * Construct
	 */
	function __construct()
	{
		parent::__construct();

		$this->load->library( "PS_Auth" );
		$this->load->library( "PS_Widget" );
		$this->load->library( "PS_Mail" );
	}

	function add_favourite_items()
	{
		$data = array();
		$this->set_data( $data, 'item_id' );
		$this->set_data( $data, 'user_id' );
		$item_id = $data['item_id'];
		if ( $this->Favourite->exists( $data )) {

			if ( !$this->Favourite->delete_by( $data )) {
				$this->error_response( get_msg( 'err_model' ));
			} else {
				$conds_fav['item_id'] = $item_id;

			    $total_fav_count = $this->Favourite->count_all_by($conds_fav);

			    $item_data['favourite_count'] = $total_fav_count;
			    $this->Item->save($item_data, $item_id);
			}

		} else {
			
			if ( !$this->Favourite->save( $data )) {
				$this->error_response( get_msg( 'err_model' ));
			} else {
				$conds_fav['item_id'] = $item_id;

			    $total_fav_count = $this->Favourite->count_all_by($conds_fav);

			    $item_data['favourite_count'] = $total_fav_count;
			    $this->Item->save($item_data, $item_id);
			}

		}

		$this->success_response( get_msg( 'success_save_fav' ));
	}
}