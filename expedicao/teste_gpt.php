<?php
$api_key = 'SUA_API_KEY_AQUI';

$data = [
    'model' => 'gpt-3.5-turbo',
    'messages' => [
        ['role' => 'user', 'content' => 'Olá, como você está?']
    ],
    'max_tokens' => 100
];

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://api.openai.com/v1/chat/completions');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Content-Type: application/json',
    'Authorization: Bearer ' . $api_key
]);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

$response = curl_exec($ch);
$http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

if ($http_code == 200) {
    $response_data = json_decode($response, true);
    if (isset($response_data['choices'][0]['message']['content'])) {
        echo $response_data['choices'][0]['message']['content'];
    } else {
        echo 'Erro: Nenhuma resposta encontrada.';
    }
} else {
    echo 'Erro na solicitação: ' . $response;
}
