<?php

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
		}
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