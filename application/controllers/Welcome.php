<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

		function __construct()
		{
				parent::__construct();
		}

		public function index()
		{
				$data['stars'] = $this->Star_model->get_stars();
				$data['votes'] = $this->Star_model->get_votes();
				$this->load->view('stars', $data);
		}
		
		function vote($vote_from, $vote_to, $reason)
		{
				// get the person's current number of stars
				$stars = $this->Star_model->get_star_count($vote_to)->row();

				// build the array for our record with incremented starts
				$data = array(
						'stars' => $stars->stars + 1
				);
				
				// update the people table record with the new star value
				$this->Star_model->update_person($vote_to, $data);
				
				// get the star giver's info
				$this->db->where('id', $vote_from);
				$query = $this->db->get('people');
				$from = $query->row()->name;
				
				// record the vote in the votes table
				$vote = array(
						'vote_from' => $vote_from,
						'vote_to' => $vote_to,
						'reason' => $reason
				);
				
				$this->Star_model->save_vote($vote);
				
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