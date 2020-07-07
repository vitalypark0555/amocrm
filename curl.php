<?php

class Curl {
    public static function request($link, $type = 'GET', $params = []){
        $accessToken = "eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6ImMyYWEwZGI3OWIyZjUzOTI5ZWZiZjFiMmRhNmE5ZDYyZjY2MDlkZGRiZjlmYjRmZTJkZWQ4ZjllMjRkYWJiYjBkZWQyMDVmNjk4NzFiNWMzIn0.eyJhdWQiOiIzNzU3OTE3Zi02Yzg3LTQzOGItODhhNy0zODQ2Yjc1OWNlMGUiLCJqdGkiOiJjMmFhMGRiNzliMmY1MzkyOWVmYmYxYjJkYTZhOWQ2MmY2NjA5ZGRkYmY5ZmI0ZmUyZGVkOGY5ZTI0ZGFiYmIwZGVkMjA1ZjY5ODcxYjVjMyIsImlhdCI6MTU5NDEzNjczMywibmJmIjoxNTk0MTM2NzMzLCJleHAiOjE1OTQyMjMxMzMsInN1YiI6IjYxNjAxNjgiLCJhY2NvdW50X2lkIjoyODk1Nzg0OSwic2NvcGVzIjpbInB1c2hfbm90aWZpY2F0aW9ucyIsImNybSIsIm5vdGlmaWNhdGlvbnMiXX0.oD7yxKEMCDj-8FRlnAurwhYk4IgLcoeIameCYSTiej5IxC3VWFqAesRCILFNz61DtsVoyQ9Q5WDTplQZjn3ssyP6DKGZv2UZdJigdAuLR5axqZFoGIHoK3febcNwGBL0mcnDzT9OwBPPuBq16vxI2bkRdc7qL29Gf80ytWFPHkWj3ee5bDQFdxUAmReh4_v2yuiwjtwNtEJjVzbemWOSQo0e9OW4K8e8gT-Rj3fwMl1GShqqW9Kf3r9DkSZgSzEooPufh9kuBVmMol1cwS_dDfOZYVhyO_dg8sc3rwvXyVieFHXrn6Su2Gb86s4_b_Q3piCH-cYe-ZhOpEYwbhdBkQ";
        $headers = [
            'Authorization: Bearer ' . $accessToken,
            'Content-Type: application/json'
        ];
        $curl = curl_init(); # Save the cURL session handle
        # Set the necessary options for cURL session
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_USERAGENT, 'amoCRM-API-client/1.0');
        curl_setopt($curl, CURLOPT_URL, $link);
        if($type == 'POST'){
            curl_setopt($curl,CURLOPT_CUSTOMREQUEST,'POST');
            curl_setopt($curl,CURLOPT_POSTFIELDS,json_encode($params));
        }
        curl_setopt($curl,CURLOPT_HTTPHEADER,$headers);
        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt($curl, CURLOPT_COOKIEFILE, dirname(__FILE__) . '/cookie.txt'); #PHP>5.3.6 dirname(FILE) -> DIR
        curl_setopt($curl, CURLOPT_COOKIEJAR, dirname(__FILE__) . '/cookie.txt'); #PHP>5.3.6 dirname(FILE) -> DIR
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);

        $out = curl_exec($curl); # Initiate a request to the API and stores the response to variable

        $code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl); #Завершаем сеанс cURL

        $code = (int)$code;

        $errors = array(
            301 => "Moved permanently",
            400 => "Bad request",
            401 => "Unauthorized",
            403 => "Forbidden",
            404 => "Not found",
            500 => "Internal server error",
            502 => "Bad gateway",
            503 => "Service unavailable"
        );
        try
        {
            #Если код ответа не равен 200 или 204 - возвращаем сообщение об ошибке
            if($code != 200 && $code != 204)
                throw new Exception(isset($errors[$code]) ? $errors[$code] : "Undescribed error",$code);
        }
        catch(Exception $E)
        {
            die("Ошибка: ".$E->getMessage().PHP_EOL."Код ошибки: ".$E->getCode());
        }
        $Response = json_decode($out,true);
        return $Response;

    }

}