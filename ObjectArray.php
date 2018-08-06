<?php

/**
 * A Universal container class to hold multiple fieldset objects (i.e.: FieldsetMulti) for a single page
 *
 */

class ObjectArray extends WireArray {

	protected $page;

	public function __construct(Page $page) {
		$this->page = $page;
	}

	public function isValidItem($item) {
		return $item instanceof WireData;
	}

	public function add($item) {
		$item->page = $this->page;
		return parent::add($item);
	}

	public function __toString() {
		$out = '';
		foreach($this as $item) $out .= $item;
		return $out;
	}
}
