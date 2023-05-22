<?php
require("./config.php");
include("./TESTS_globalVars.php");

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

    $GLOBALS["requestsCount"]++;
    echo ($GLOBALS["requestsCount"]);

    $response = curl_exec($curl); //$curl_session[0]
    $err = curl_error($curl);    //$curl_session[1]

    curl_close($curl);

    return array($response, $err);
}
