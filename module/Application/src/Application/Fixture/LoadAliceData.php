<?php

namespace Application\Fixture;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Nelmio\Alice\Fixtures;

/**
 * Alice loader
 * 
 * @package Application
 * @subpackage Fixture
 * 
 * @author Julien Guittard <julien.g@zend.com>
 * @version 1.0
 *
 */
class LoadAliceData implements FixtureInterface 
{
	/**
	 * (non-PHPdoc)
	 * @see \Doctrine\Common\DataFixtures\FixtureInterface::load()
	 */
	public function load(ObjectManager $manager) 
	{
		Fixtures::load(getcwd() . '/data/orm/fixtures/*.yml', $manager, ['providers' => [$this]]);
	}
	
	public function bcrypt($value) {
		if ($value=='') {
			$value = $this->generatePassword();
		}
		$bCrypt = new \Zend\Crypt\Password\Bcrypt();
		return $bCrypt->create($value);
	}
	
	/**
	 * @param int $length
	 * @return string
	 */
	protected function generatePassword($length = 8)
	{
		$chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
		$count = mb_strlen($chars);
	
		for ($i = 0, $clear = ''; $i < $length; $i++) {
			$index = rand(0, $count - 1);
			$clear .= mb_substr($chars, $index, 1);
		}
	
		return $clear;
	}
	
	/**
	 * 
	 * @param string $text
	 * @return string|null
	 */
	public function slugify($text)
	{
		// replace non letter or digits by -
		$text = preg_replace('~[^\\pL\d]+~u', '-', $text);
	
		// trim
		$text = trim($text, '-');
	
		// transliterate
		$text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
	
		// lowercase
		$text = strtolower($text);
	
		// remove unwanted characters
		$text = preg_replace('~[^-\w]+~', '', $text);
	
		if (empty($text))
		{
			return null;
		}
	
		return $text;
	}
	
	public function username($first, $last)
	{
		return substr(strtolower($first), 0, 1) . strtolower($last);
	}
}
