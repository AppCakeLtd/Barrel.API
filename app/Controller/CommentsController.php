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
 
App::uses('ConnectionManager', 'Model');
 
class CommentsController extends AppController {
	public $components = array('RequestHandler');
	 
    public function addNewComment() {
        if ($this->request->is('post')) {
        	$db = ConnectionManager::getDataSource('default');
        	
        	// Check the database, if this user has already written a review
        	// If he has, return a non fatal error to Barrel
        	$conditions = array(
				'conditions' => array(
					'and' => array(
						'Comment.gameID' => $this->request->data["gameID"],
						'Comment.userID' => $this->request->data["userID"]
					)
				)
			);
			
			$commentsFound = $this->Comment->find('all', $conditions);
			if (sizeof($commentsFound) == 0) {
        	
	            $newComment["title"] = $this->request->data["title"];
	            $newComment["comment"] = $this->request->data["comment"];
	            $newComment["gameID"] = $this->request->data["gameID"];
	            $newComment["userID"] = $this->request->data["userID"];
	            $newComment["rating"] = $this->request->data["rating"];
	            $newComment["postDate"] = $db->expression('NOW()');
	            
	            if ($this->Comment->save($newComment)) {
	                $response = new CommentGenericResponse();
	            	$response->responseCode = 200;
	            	$response->responseDescription = "OK";
	            }
	            else {
	                $response = new CommentGenericResponse();
	            	$response->responseCode = 500;
	            	$response->responseDescription = "Error saving in the Database";
	            }
	        }
	        else {
		        $response = new CommentGenericResponse();
            	$response->responseCode = 204;
            	$response->responseDescription = "You have already written a review on this game.";
	        }
        }
        else {
            $response = new CommentGenericResponse();
        	$response->responseCode = 504;
        	$response->responseDescription = "No data was sent to the server!";
        }
        
        $this->set('results', $response);
        $this->set('_serialize', array('results'));
    }
}
 
final class CommentGenericResponse {
   public $responseCode;
   public $responseDescription;
}