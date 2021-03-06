<?php

namespace Ubiquity\utils\flash;

use Ubiquity\utils\http\USession;

/**
 * Bag for Session Flash messages
 * @author jc
 *
 */
class FlashBag implements \Iterator {
	const FLASH_BAG_KEY="_flash_bag";
	private $array;
	private $position;

	public function __construct() {
		USession::start();
		$this->array=USession::get(self::FLASH_BAG_KEY, [ ]);
	}

	public function addMessage($type, $content, $icon=NULL) {
		$this->array[]=new FlashMessage($type, $content, $icon);
	}

	public function getMessages($type) {
		$result=[ ];
		foreach ( $this->array as $msg ) {
			if ($msg->getType() == $type)
				$result[]=$msg;
		}
		return $result;
	}

	public function getAll() {
		return $this->array;
	}

	public function clear() {
		USession::delete(self::FLASH_BAG_KEY);
	}

	public function rewind() {
		$this->position=0;
	}

	public function current() {
		return $this->array[$this->position];
	}

	public function key() {
		return $this->position;
	}

	public function next() {
		++$this->position;
	}

	public function valid() {
		return isset($this->array[$this->position]);
	}

	public function save() {
		$this->array=USession::set(self::FLASH_BAG_KEY, $this->array);
	}
}

