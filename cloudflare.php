<?php
require("./config.php");

function curlSession(CurlHandle | false $curl, String $path, String $request_type)
{
    curl_setopt_array($curl, [
        CURLOPT_URL => $path,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => $request_type,
        CURLOPT_POSTFIELDS => "",
        CURLOPT_HTTPHEADER => [
            "Authorization: Bearer " . constant("HTTP_TOKEN_AUTH"),
            "Content-Type: application/json",
            "X-Auth-Email: " . constant("X_AUTH_EMAIL")
        ],
    ]);

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    //$response = $curl_session[0]
    //$err = $curl_session[1]
    return array($response, $err);
}

//récupérer le nombre de page d'enregistrements DNS dans la zone donnée
$curl_session = curlSession(curl_init(), "https://api.cloudflare.com/client/v4/zones/" . constant("ZONE_ID") . "/dns_records", "GET");

if ($curl_session[1]) {
    echo "cURL Error #:" . $curl_session[1];
} else {
    //décoder la réponse afin d'itérer tranquille
    $decoded_response = json_decode($curl_session[0], true);

    //récupérer pour chaque page les id de tous les enregistrements DNS & les insérer dans $id_array
    $id_array = array();

    for ($page = 1; $page <= $decoded_response["result_info"]["total_pages"]; $page++) {
        $curl_session = curlSession(curl_init(), "https://api.cloudflare.com/client/v4/zones/" . constant("ZONE_ID") . "/dns_records?page=" . $page, "GET");

        $decoded_response = json_decode($curl_session[0], true);

        echo "Page : " . $page . "\n";

        for ($i = 0; $i < count($decoded_response["result"]); $i++) {
            echo "Résultat n° " . $i . " : " . $decoded_response["result"][$i]["id"] . "\n";

            if ($curl_session[1]) {
                echo "cURL Error #:" . $curl_session[1];
            } else {
                $id_array[] = $decoded_response["result"][$i]["id"];
            }
        }
    }
}

//lit le tableau d'id et lance une requête par suppression
foreach ($id_array as $key => $value) {
    $curl_session = curlSession(curl_init(), "https://api.cloudflare.com/client/v4/zones/" . constant("ZONE_ID") . "/dns_records//" . $value, "DELETE");

    if ($curl_session[1]) {
        echo "cURL Error #:" . $curl_session[1];
    } else {
        echo "L'enregistrement " . $curl_session[0] . " est effacé. \n";
    }
}
