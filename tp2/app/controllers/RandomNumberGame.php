<?php
namespace controllers;
 use Ubiquity\utils\http\USession;
use Ubiquity\utils\http\URequest;

 /**
 * Controller RandomNumberGame
 **/
class RandomNumberGame extends ControllerBase{
	const SESSION_KEY="nb";
	public function index(){
		if(USession::exists(self::SESSION_KEY)){
			return $this->propose();
		}
		$this->loadView("RandomNumberGame/index.html",["nb"=>$nb]);
	}

	public function propose(){
		
		$this->loadView('RandomNumberGame/propose.html');
	}


	public function genere(){
		$number=\mt_rand(1,10);
		USession::set(self::SESSION_KEY, $number);
		$this->index();
	}


	public function soumet(){
		$reponse=URequest::post("nombre");
		$nb=USession::get(self::SESSION_KEY);
		$win=($nb==$reponse);
		if($win){
			$type="positive";
			$icon="thumbs up";
			$message="Vous avez gagné";
		}else{
			$type="negative";
			$icon="thumbs down";
			$message="Vous n'avez pas donné la bonne réponse...";
			}
		$this->loadView('RandomNumberGame/soumet.html',compact("win","reponse","type","icon","message"));

	}


	public function termine(){
		USession::terminate();
		$this->index();
	}

}
