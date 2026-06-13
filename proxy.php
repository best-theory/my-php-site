<?php

$token = 'AAGHtfXEciiUfq8HL';

if(empty($_POST['token'])) die('Error Token');
if($_POST['token'] !== $token) die('Error Token');

function send_telegram(){

	$chat_id = empty($_POST['chat_id']) ? 0 : (int)$_POST['chat_id'];
	$message = empty($_POST['text']) ? '' : $_POST['text'];
	$tg_token = empty($_POST['token_bot']) ? '' : $_POST['token_bot'];

	if($chat_id && $message && $tg_token){
	
		$tg_url = "https://api.telegram.org/bot$tg_token/sendMessage";
	
		$data = array(
			'chat_id' => $chat_id,
			'parse_mode' => 'HTML',
			'text' => $message
		);

		$ch = curl_init($tg_url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
		$response = curl_exec($ch);
		curl_close($ch);

		if ($response === false) {
			return 'Ошибка отправки';
		} else {
			$http_code = curl_getinfo($ch);
			return $response . json_encode($http_code);
		}
	}
}

echo send_telegram();
