<?php namespace Acme\Helpers;

use Carbon\Carbon;

class LeaveHelper {

	/** Generates an Approval Button for Leave Application
	* --> This function depends on another function [getStatus]
	*/
	public function approveButton($status, $id, $url, $text=  "Approve") {

		$link = '';

		// Check if the leave  is pending
		if (strtolower($this->getStatus($status)) == 'pending') {
			$link = '<button id="approve_leave_button" href="' . $url .'" class="btn btn-success"> <span class="glyphicon glyphicon-thumbs-up"></span>  ' . $text .'</button>';
			
			$link .= '<input type="hidden" name="id" value="' . $id .'">';
			$link .= '<input type="hidden" name="approval_date" value="' . Carbon::now() .'">';

		} 	


		
		return $link;
	}

	/** Generates an Rejection Button for Leave Application
	* --> This function depends on another function [getStatus]
	*/
	public function rejectButton($status, $id, $url, $text=  "Reject&nbsp;&nbsp;&nbsp;") {

		$link = '';

		// Check if the leave  is pending
		if (strtolower($this->getStatus($status)) == 'pending') {
			$link = '<button id="reject_leave_button" href="' . $url .'" class="btn btn-warning"> <span class="glyphicon glyphicon-thumbs-down"></span>  ' . $text .'</button>';
			$link .= '<input type="hidden" name="id" value="' . $id .'">';
			$link .= '<input type="hidden" name="approval_date" value="' . Carbon::now() .'">';

		} 
		
		return $link;
	}

	/** Generates an Rejection Button for Leave Application
	* --> This function depends on another function [getStatus]
	*/
	public function cancelButton($status, $id, $url, $text=  "Cancel Leave") {

		$link = '';

		// Check if the leave  is pending
		if (strtolower($this->getStatus($status)) == 'pending') {
			$link = '<button id="reject_leave_button" href="' . $url .'" class="btn btn-danger"> <span class="glyphicon glyphicon-remove"></span>  ' . $text .'</button>';
			$link .= '<input type="hidden" name="id" value="' . $id .'">';
			$link .= '<input type="hidden" name="approval_date" value="' . Carbon::now() .'">';

		} 
		
		return $link;
	}

	public function getLeaveType($type) {
		$types = ['1' => 'Vacation Leave', '2' => 'Personal Business', '3' => 'Leave with Pay'];

		if (!array_key_exists($type, $types)) {

			throw new \Exception('Invalid Leave type. The type doesn\'t  exists.');

			return false;
		}

		return $types[$type];
	}

	public function dateDiff($start, $end, $output_type) {

		$result = "";
		$ts1 = strtotime($start);
		$ts2 = strtotime($end);

		$seconds_diff = $ts2 - $ts1;

		switch ($output_type) {
			case 'months':
				$result = round($seconds_diff/2419200,0);
				break;
			case 'days':
				$result = round($seconds_diff/86400,0);
			break;

			case 'weeks':
			$result = round($seconds_diff/604800,0);
			break;

			case 'year':
			$result = round($seconds_diff/31536000,0);
			break;
			
			default:
				$result = $seconds_diff;
				break;
		}
		

		return $result;
	}

	public function tableHighlight($status) {
		switch ($status) {
		
			case 'Approved':
				$type = 'info';
			break;

			case 'Done':
				$type = 'success';

			break;

			case 'Denied':
				$type = 'warning';
				break;

			case 'Cancelled':
				$type= 'danger';
				break;
			
			default:
				$type = '';
				break;
		}

		return $type;
	}

	public function getStatus($status, $format=false) {

		$status = (strlen($status) > 0) ? $status : 'undefined';

		if ($format == true) {

			switch ($status) {
			case 'Pending':
				$type = 'info';
				break;
			case 'Approved':
				$type = 'primary';
			break;

			case 'Done':
				$type = 'success';

			break;

			case 'Denied':
				$type = 'warning';
				break;

			case 'Cancelled':
				$type="danger";
			break;

			
			default:
				$type = 'info';
				break;
		}

			return '<span class="label label-' . $type .'"">' . $status . '</span>';
		} 
		return $status;
	}
}