<?php
require("./curlSessionFunction.php");
include("./TESTS_globalVars.php");

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
/*foreach ($id_array as $key => $value) {
    $curl_session = curlSession(curl_init(), "https://api.cloudflare.com/client/v4/zones/" . constant("ZONE_ID") . "/dns_records//" . $value, "DELETE");

    if ($curl_session[1]) {
        echo "cURL Error #:" . $curl_session[1];
    } else {
        echo "L'enregistrement " . $curl_session[0] . " est effacé. \n";
    }
}*/
