<?php
    
namespace Academy;
use Academy\Db;
require_once __DIR__ . '/vendor/autoload.php';

class Request
{
	private $errors = [];

	public function isPost()
	{
		return $_SERVER['REQUEST_METHOD'] == 'POST';
	} 

	public function required($nameInput)
	{
		$inputData = $_POST[$nameInput] ?? '';
		$data = $this->clearData($inputData);

		if(empty($data))
		{
			$this->errors[$nameInput][] = 'Поле обазятельно к заполнению';
			return false;
		}
		return true;
    }
    
    public function getData()
    {
		if (isset($_POST)) {
			foreach ($_POST as $key=>$value){
				$arr[$key]=$this->clearData($value);
			}
		}
		return $arr;
    }

	public function getErrors()
	{
		return $this->errors;
	}

	public function clearData($text)
	{
		$text = trim(strip_tags(htmlspecialchars($text)));
		return $text;
	}
}
	$requestClass = new Request();
	$db = new Db();

    if( $requestClass->isPost() )
    {
        $requestClass->required('name');
        $requestClass->required('author');
	    $errors = $requestClass->getErrors();
		echo json_encode($errors);
		
		if ( $requestClass->required('name') && $requestClass->required('author'))
		{
			$db->insert($requestClass->getData());
		}
		
    }

