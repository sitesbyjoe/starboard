<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

		function __construct()
		{
				parent::__construct();
		}

		//$this->load->library('database');

		function index()
		{
				$data['stars'] = self::get_stars();
				$data['votes'] = self::get_votes();
				$this->load->view('stars', $data);
		}
		
		private function get_stars()
		{
				// returns all the people
				$this->db->order_by('name', 'asc');
				return $this->db->get('people');
		}
		
		function get_votes()
		{
				$this->db->order_by('votes.timestamp', 'desc');
				return $this->db->get('votes');
		}
		
		function vote($vote_from, $vote_to, $reason)
		{
				// get the person's current number of stars
				$this->db->select('stars');
				$this->db->where('id', $vote_to);
				$stars = $this->db->get('people')->row();

				// build the array for our record with incremented starts
				$data = array(
						'stars' => $stars->stars + 1
				);
				
				// update the people table record
				$this->db->where('id', $vote_to);
				$this->db->update('people', $data);
				
				$this->db->where('id', $vote_from);
				$query = $this->db->get('people');
				$from = $query->row()->name;
				
				
				// record the vote in the votes table
				$vote = array(
						'vote_from' => $vote_from,
						'vote_to' => $vote_to,
						'reason' => $reason
				);
				
				$this->db->insert('votes', $vote);
				//return $this->db->rows_affected();
				
				$this->load->library('email');
				// let the person know they got a star!
				$this->load->library('email');
				/*
				$this->email->initialize(array(
						'protocol' => 'smtp',
						'smtp_host' => '',
						'smtp_user' => '',
						'smtp_pass' => ''
				));
				*/
				
				$this->email->from('joe@sitesbyjoe.com');
				//$this->email->to($stars->email);
				$this->email->to('joe@sitesbyjoe.com');
				$this->email->subject('You got a star!');
				
				$body = "You got a star!!!\n";
				$body .= "From: " . $from . "\n";
				$body .= "Reason: " . $vote['reason'] . "\n\n";
				$body .= "Know someone who deserves a star? Go to " . $this->config->item('base_url') . " to give a star to someone.";
				
				$this->email->message($body);
				if ($this->email->send())
				{
						return '{"id":' . $vote['vote_to'] . ', "stars":' . $data['stars'] . '}';
				}
				else
				{
						return 'ERROR';
				}
				
		}
		
		function give()
		{
				//print_r($this->input->post());
				echo self::vote($this->input->post('vote_from'), $this->input->post('vote_to'), $this->input->post('reason'));
		}
}

/* End of file welcome.php */
/* Location: ./application/controllers/Welcome.php */