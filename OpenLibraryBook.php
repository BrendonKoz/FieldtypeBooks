<?php

/**
 * Class to hold book data (optionally pulled from OpenLibrary API)
 * File: OpenLibraryBook.php
 *
 */
class OpenLibraryBook extends WireData {

	const dateFormat = 'Y';

	/**
	 * We keep a copy of the $page that owns this event so that we can follow
	 * its outputFormatting state and change our output per that state
	 *
	 */
	protected $page;

	#public $isbn;
	#public $title;
	#public $author;
	#public $callno;
	#public $pubdate;
	#public $cover;
	#public $summary;
	#public $rating;

	public function __construct() {
		#try {
			$this->set('isbn',    '');
			$this->set('title',   '');
			$this->set('author',  '');
			$this->set('callno',  '');
			$this->set('pubdate', '');
			$this->set('cover',   '');
			$this->set('summary', '');
			$this->set('rating',  0);
		#} catch (WireException $e) {
		#	throw new WireException('Error in setting the constructor values in '. __FILE__ .' near line ' . __LINE__);
		#}
	}


	/**
	 * Set a value to the book: isbn, title, author, callno, pubdate, cover, summary, or rating
	 *
	 */
	public function set($key, $value) {
		if ($key == 'page') {
			$this->page = $value;
			return $this;
		} else if ($key == 'isbn') {
			if (!is_numeric($value)) {
				// Make the value an empty string if it isn't numeric
				$value = '';
			}
			if (strlen($value) < 13) {
				if (strlen($value) < 10) {
					// Under 10 characters
					$value = str_pad($value, 10, '0', STR_PAD_LEFT);
				} else {
					// 11 or 12 characters, needs to be 13
					$value = str_pad($value, 13, '0', STR_PAD_LEFT);
				}
			} else if (strlen($value > 13)) {
				// Too long, trim to 13 characters
				$value = substr($value, 0, 13);
			}
		} else if ($key == 'pubdate') {
			if (!is_numeric($value)) {
				// Make the value an empty string if it isn't numeric
				$value = '';
			}
			if ($value && strlen($value) != 4) {
				// Make the value an empty string if it isn't correct
				$value = '';
			}
		} else if ($key == 'cover') {
			$value = wire('sanitizer')->url($value);
		} else if ($key == 'summary') {
			$value = wire('sanitizer')->textarea($value);
		} else {
			$value = wire('sanitizer')->text($value);
		}

		return parent::set($key, $value);
	}

	public function get($key) {
		$value = parent::get($key);

		// If the page's output formatting is on, then we'll return formatted values
		if ($this->page && $this->page->of()) {
			/*if ($key == 'date') {
				// format a unix timestamp to a date string
				$value = date(self::dateFormat, $value);
			}*/
			if (in_array($key, array('summary', 'title', 'author'))) {
				// return entity encoded versions of strings
				$value = $this->sanitizer->entities($value);
			}
		}

		return $value;
	}

	/**
	 * Provide a default rendering for a book
	 *
	 */
	public function renderBook() {
		// remember page's output formatting state
		$of = $this->page->of();
		// turn on output formatting for our rendering (if it's not already on)
		if(!$of) $this->page->of(true);
		$out = "<p><strong>$this->title</strong><br /><em>$this->author</em><br />$this->summary</p>";
		if(!$of) $this->page->of(false);
		return $out;
	}

	/**
	 * Return a string representing this book
	 *
	 */
	public function __toString() {
		return $this->renderBook();
	}
}