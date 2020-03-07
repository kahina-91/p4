<?php
/**
 * 
 */
class Session
{
	public function hasFlash()
	{
		if(isset($_SESSION['flash'])) return true;
		return false;
	}
	public function setFlash($message)
	{
		$_SESSION['flash'] = $message;
		return $this;
		
	}
	public function getFlash()
	{
		$message = null;
		if(isset($_SESSION['flash']))
		{ 	
			$message = $_SESSION['flash'];
			unset($_SESSION['flash']);
		}
		return $message;
	}
}
