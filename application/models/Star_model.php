<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Star_model extends CI_Model {

		function __construct()
		{
				parent::__construct();
		}
		
		public function get_stars()
		{
				// returns all the people
				$this->db->order_by('name', 'asc');
				return $this->db->get('people');
		}
		
		public function get_votes()
		{
				$this->db->order_by('votes.timestamp', 'desc');
				return $this->db->get('votes');
		}
		
		public function get_star_count($person)
		{
				// get the person's current number of stars
				$this->db->select('stars');
				$this->db->where('id', $person);
				return $this->db->get('people');
		}
		
		public function save_vote($vote)
		{
				$this->db->insert('votes', $vote);
				return $this->db->affected_rows();
		}
		
		public function update_person($person, $data)
		{
				// update the people table record
				$this->db->where('id', $person);
				$this->db->update('people', $data);
				return $this->db->affected_rows();
		}
}

/* End of file star_model.php */
/* Location: ./application/models/star_model.php */