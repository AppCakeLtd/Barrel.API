<?php
/**
 Copyright (c) 2013, Barrel Team
 
 Redistribution and use in source and binary forms, with or without
 modification, are permitted provided that the following conditions are met:
 * Redistributions of source code must retain the above copyright
 notice, this list of conditions and the following disclaimer.
 * Redistributions in binary form must reproduce the above copyright
 notice, this list of conditions and the following disclaimer in the
 documentation and/or other materials provided with the distribution.
 * Neither the name of the Barrel Team nor the
 names of its contributors may be used to endorse or promote products
 derived from this software without specific prior written permission.
 
 THIS SOFTWARE IS PROVIDED BY Barrel Team ''AS IS'' AND ANY
 EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED
 WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE
 DISCLAIMED. IN NO EVENT SHALL Barrel Team BE LIABLE FOR ANY
 DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES
 (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES;
 LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND
 ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT
 (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS
 SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
 */
 
 class UsersController extends AppController {
	 public $components = array('RequestHandler');
	 
	 public function index() {
		 
	 }
	 
	 public function searchForUser() {
		 if ($this->request->is('get')) {
		 	$usernameToSearchFor = $this->request->query["username"];
		 	
		 	$conditions = array(
		 		'conditions' => array(
			 		'or' => array(
			 			"User.username" => "$usernameToSearchFor"
			 		)
			 	)
		 	);
		 
			$this->set('results', $this->User->find('all', $conditions));
			
			$this->set('_serialize', array('results'));
		 }
	 }
	 
	 public function registerNewUser() {
		 if ($this->request->is('post')) {
			$userdata['username'] 	= $this->request->data['username'];
			$userdata['password'] 	= $this->request->data['password'];
			$userdata['email']	 	= $this->request->data['email'];
			
			if ($this->User->save($userdata)) {
				$response = new UserGenericResponse();
				$response->responseCode = 200;
				$response->responseDescription = "OK";
			}
			else {
				$response = new UserGenericResponse();
				$response->responseCode = 500;
				$response->responseDescription = "Error saving in the Database!";
			}
		 }
		 else {
			 $response = new UserGenericResponse();
			 $response->responseCode = 501;
			 $response->responseDescription = "No data was sent to the server!";
		 }
		 
		 $this->set('results', $response);
  		 $this->set('_serialize', array('results'));
	 }
 }
 
 final class UserGenericResponse {
	 public $responseCode;
	 public $responseDescription;
 }