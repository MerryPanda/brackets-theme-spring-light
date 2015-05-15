<?php
//copyright Lawrence Truett and FluffyCat.com 2005, all rights reserved
include_once('BookColleague.php');
include_once('BookAuthorColleague.php');
include_once('BookTitleColleague.php');

class BookMediator {
	private $authorObject;
	private $titleObject;

	function __construct($author_in, $title_in) {
		$this->authorObject = new BookAuthorColleague($author_in,$this);
		$this->titleObject  = new BookTitleColleague($title_in,$this);
	}
	function getAuthor() {return $this->authorObject;}
	function getTitle() {return $this->titleObject;}

	//when title or author change case, this makes sure the other
	//  stays in sync
	function change(BookColleague $changingClassIn) {
		if ($changingClassIn instanceof BookAuthorColleague) {
			if ('upper' == $changingClassIn->getState()) {
				if ('upper' != $this->getTitle()->getState()) {
					$this->getTitle()->setTitleUpperCase();
				}
			} elseif ('lower' == $changingClassIn->getState()) {
				if ('lower' != $this->getTitle()->getState()) {
					$this->getTitle()->setTitleLowerCase();
				}
			}
		} elseif ($changingClassIn instanceof BookTitleColleague) {
			if ('upper' == $changingClassIn->getState()) {
				if ('upper' != $this->getAuthor()->getState()) {
					$this->getAuthor()->setAuthorUpperCase();
				}
			} elseif ('lower' == $changingClassIn->getState()) {
				if ('lower' != $this->getAuthor()->getState()) {
					$this->getAuthor()->setAuthorLowerCase();
				}
			}
		}
	}
}
?>
