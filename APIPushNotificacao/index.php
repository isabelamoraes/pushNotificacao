<?php
function sendMessage() {
	
    $content = array(
        "en" => 'Conteúdo da Push'
    );
	
    $heading = array(
        "en" => 'Titulo da Push'
    );
    
	$send_after = "2019-12-30 12:59:00 GMT-0300";
	
    $fields = array(
        //id do app no OneSignal
        'app_id' => "APP_ID",
        //mandar para todos os usuarios
        /*'included_segments' => array(
            'All'
        ),*/
        //mandar para um ou mais usuários
        //esses usuários podem ser obtidos através do método onIds da aplicação
        'include_player_ids' => array("USER_ID"),
        'headings' => $heading,
        'contents' => $content,
		//programar horário da notificacao
		//'send_after' => $send_after
    );
    
    $fields = json_encode($fields);
    print("\nJSON sent:\n");
    print($fields);
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
    //Token do OneSignal
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json; charset=utf-8',
        'Authorization: Basic TOKEN...'
    ));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ch, CURLOPT_HEADER, FALSE);
    curl_setopt($ch, CURLOPT_POST, TRUE);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
    
    $response = curl_exec($ch);
    curl_close($ch);
    
    return $response;
}

$response = sendMessage();
$return["allresponses"] = $response;
$return = json_encode($return);

$data = json_decode($response, true);
print_r($data);
$id = $data['id'];
print_r($id);

print("\n\nJSON received:\n");
print($return);
print("\n");
?>