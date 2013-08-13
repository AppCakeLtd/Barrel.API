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
 
class GamesController extends AppController {
	public $components = array('RequestHandler', 'CrossController');
	public $uses = array('Game', 'WineBuild');
	 
	public function index() {
		 
	}
	 
	public function getAllGames() {
	   $this->set('allGames', $this->Game->find('all'));
	   $this->set('_serialize', array('allGames'));
	}
	
	public function saveGameIdentifier() {
		$results = "";
	
		if ($this->request->is('get')) {
			// Get the current game identifiers before appending them
			$conditions = array(
				'conditions' => array(
					'Game.id' => $this->request->query["gameID"]
				)
			);
			
			if ($currentGame = $this->Game->find('all', $conditions)) {
				if (!preg_match("~\b" . $this->request->query["identifier"] . "\b~", $currentGame[0]["Game"]["identifiers"])) {
					$game["identifiers"] = $currentGame[0]["Game"]["identifiers"] . ", " . $this->request->query["identifier"];
					$game["id"] = $this->request->query["gameID"];
					
					if ($this->Game->save($game)) {
						$response = new GameGenericResponse();
	                	$response->gameID = $this->Game->id;
	                	$response->responseCode = 200;
	                	$response->responseDescription = "OK";
					}
					else {
						$response = new GameGenericResponse();
	                    $response->gameID = 0;
	                    $response->responseCode = 500;
	                    $response->responseDescription = "Error saving in the Database!";
					}
				}
				else {
					$response = new GameGenericResponse();
	                $response->gameID = 0;
	                $response->responseCode = 505;
	                $response->responseDescription = "Identifier already exists";
				}
			}
			else {
				$response = new GameGenericResponse();
                $response->gameID = 0;
                $response->responseCode = 502;
                $response->responseDescription = "Unable to get the current game!";
			}
		}
		else {
			$response = new GameGenericResponse();
            $response->gameID = 0;
            $response->responseCode = 504;
            $response->responseDescription = "No data was sent to the server!";
		}
		
		$this->set('results', $response);
	    $this->set('_serialize', array('results'));
	}
	 
	public function searchForGame() {
		if ($this->request->is('get')) {
		    $view = new View($this);
		    $html = $view->loadHelper('Html');
		    
    		$gameIdentifiers = $this->request->query["identifier"];
    		$gameName = $this->request->query["gameName"];
		 	
    		$conditions = array(
		        'conditions' => array(
		            'or' => array(
		                 "Game.identifiers LIKE" => "%$gameIdentifiers%",
		                 "Game.name LIKE" => "%$gameName%"
		             )  
		         )
		    );
		    
		    $gamesFound = $this->Game->find('all', $conditions);
		    // Convert paths to URLs
		    for($i = 0; $i < sizeof($gamesFound); $i++) {
    		    $gamesFound[$i]["Game"]["coverArtURL"] = $html->url($gamesFound[0]["Game"]["coverArtURL"], true);
    		    $gamesFound[$i]["Game"]["recipeURL"] = $html->url($gamesFound[0]["Game"]["recipeURL"], true);
    		    
    		    $portEngineData = $this->CrossController->getWineBuildByID($gamesFound[$i]["Game"]["wineBuildID"], $this->WineBuild);
    		    $portEngineURL = "http://api.appcake.co.uk" . $portEngineData[0]["WineBuild"]["archivePath"];
    		    
    		    // Get the engine URL and add it to the results
    		    $gamesFound[$i]["Game"]["engineURL"] = $portEngineURL;
		    }
		    

		    $this->set('results', $gamesFound);
		    $this->set('_serialize', array('results'));
	    }
    }
	 
	public function addNewGame() {
	    // debug($this->request);
    	if ($this->request->is('post')) {
        	if (!empty($this->request->params['form']['game']['tmp_name']) && is_uploaded_file($this->request->params['form']['game']['tmp_name'])) {
        	    $filename = basename($this->request->params['form']['game']['name']); 
                move_uploaded_file(
                    $this->request->params['form']['game']['tmp_name'],
                    WWW_ROOT . 'recipes' . DS . $filename
                );
        	
            	$gameData["name"] = $this->request->data["name"];
            	$gameData["identifiers"] = $this->request->data["identifiers"];
            	$gameData["wineBuildID"] = $this->request->data["wineBuildID"];
            	$gameData["userID"] = $this->request->data["userID"];
            	$gameData["recipeURL"] = $this->webroot . 'recipes' . DS . $filename;

            	if ($this->Game->save($gameData)) {
                	$response = new GameGenericResponse();
                	$response->gameID = $this->Game->id;
                	$response->responseCode = 200;
                	$response->responseDescription = "OK";
                }
                else {
                    $response = new GameGenericResponse();
                    $response->gameID = 0;
                    $response->responseCode = 500;
                    $response->responseDescription = "Error saving in the Database!";
                }
            }
            else {
                $response = new GameGenericResponse();
                $response->gameID = 0;
                $response->responseCode = 501;
                $response->responseDescription = "No file data was sent to the server!";
            }
        }
        else {
            $response = new GameGenericResponse();
            $response->gameID = 0;
            $response->responseCode = 504;
            $response->responseDescription = "No data was sent to the server!";
        }

        $this->set('results', $response);
        $this->set('_serialize', array('results'));
    }
    
    public function updateGameArtwork() {
        if ($this->request->is('post')) {
            if (!empty($this->request->params['form']['coverArtURL']['tmp_name']) && is_uploaded_file($this->request->params['form']['coverArtURL']['tmp_name'])) {
        	    $filename = basename($this->request->params['form']['coverArtURL']['name']); 
                move_uploaded_file(
                    $this->request->params['form']['coverArtURL']['tmp_name'],
                    WWW_ROOT . 'artwork' . DS . $filename
                );
                
                $gameData["id"] = $this->request->data["id"];
                $gameData["coverArtURL"] = $this->webroot . 'artwork' . DS . $filename;
                if ($this->Game->save($gameData)) {
                    $response = new GameGenericResponse();
                	$response->gameID = $this->Game->id;
                	$response->responseCode = 200;
                	$response->responseDescription = "OK";
                }
                else {
                    $response = new GameGenericResponse();
                    $response->gameID = 0;
                    $response->responseCode = 500;
                    $response->responseDescription = "Error saving in the Database!";
                }
            }
        }
        else {
            $response = new GameGenericResponse();
            $response->gameID = 0;
            $response->responseCode = 504;
            $response->responseDescription = "No data was sent to the server!";
        }

        $this->set('results', $response);
        $this->set('_serialize', array('results'));
    }
}
 
final class GameGenericResponse {
    public $gameID;
    public $responseCode;
    public $responseDescription;
}