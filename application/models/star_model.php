<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Star_model extends CI_Model {

		function __construct()
		{
				parent::__construct();
		}
		/*
		function get_stars()
		{
				// returns all the people
				return $this->db->get('people');
		}
		
		function vote($vote_from, $vote_to)
		{
				// get the person's current number of stars
				$this->db->select('stars');
				$this->db->where('id', $vote_to);
				$stars = $this->db->get('people')->row();

				// build the array for our record with incremented starts
				$data = array(
						'stars' => $stars + 1
				);
				
				// update the people table record
				$this->db->where('id', $vote_to);
				$this->db->update('people', $data);
				
				// record the vote in the votes table
				$vote = array(
						'vote_from' => $vote_from,
						'vote_to' => $vote_to
				);
				
				$this->db->insert('votes', $vote);
				return $this->db->rows_affected();
		}
		*/
}

/* End of file star_model.php */
/* Location: ./application/models/star_model.php */