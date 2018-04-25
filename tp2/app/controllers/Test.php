<?php
namespace controllers;
 /**
 * Controller Test
 **/
class Test extends ControllerBase{

	public function index(){
		echo "Hello World";
	}
	
	public function hello($message="Salut",$destinataire="tout le monde"){
		echo $message." ".$destinataire;
	}
	
	public function afficher($message="I SEXY AND I KNOW IT",$type="",$icon="info"){
		$this->loadView('Test/afficher.html',["msg"=>$message,"type"=>$type,"icon"=>$icon]);
	}
	
	public function message(){
		$message=[
				["msg"=>"hello","icon"=>"user"],
				["msg"=>"tu prends une douche","icon"=>"shower"],
				["msg"=>"404 Fatal Error","icon"=>"frown"]
		];
		foreach ($message as $message){
			$this->loadView('Test/afficher.html',$message);
		}
	}
}
