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

	function add_rating()
	{
		$data = array();
		$this->set_data( $data, 'rating' );
		$this->set_data( $data, 'from_user_id' );
		$this->set_data( $data, 'to_user_id' );

		$from_user_id = $data['from_user_id'];
		$to_user_id = $data['to_user_id'];
		
		$conds['from_user_id'] = $from_user_id;
		$conds['to_user_id'] = $to_user_id;
		//print_r($conds);die;
		
		$id = $this->Rate->get_one_by($conds)->id;

		$rating = $data['rating'];
		if ( $id ) {

			$this->Rate->save( $data, $id );

			// response the inserted object	
			$obj = $this->Rate->get_one( $id );
		} else {
			$this->Rate->save( $data );

			// response the inserted object	
			$obj = $this->Rate->get_one( $data['id'] );
		}
		$data_rating['rating'] = $obj->rating;
		//Need to update rating value at product
		$conds_rating['to_user_id'] = $obj->to_user_id;

		$total_rating_count = $this->Rate->count_all_by($conds_rating);
		$sum_rating_value = $this->Rate->sum_all_by($conds_rating)->result()[0]->rating;

		if($total_rating_count > 0) {
			$total_rating_value = number_format((float) ($sum_rating_value  / $total_rating_count), 1, '.', '');
		} else {
			$total_rating_value = 0;
		}

		$user_data['overall_rating'] = $total_rating_value;
		$this->User->save($user_data, $obj->to_user_id);

		$this->success_response( $data_rating,get_msg( 'success_save_rate' ));
	}
}