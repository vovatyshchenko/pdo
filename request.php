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
    
    public function getData($nameInput)
    {
        $inputData = $_POST[$nameInput] ?? '';
		$data = $this->clearData($inputData);
		return $data;

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
	    $errors = $requestClass->getErrors();
		echo json_encode($errors);
		
		if ( $requestClass->required('name'))
		{
			$db->insert($requestClass->getData('name'));
		}
		
    }

