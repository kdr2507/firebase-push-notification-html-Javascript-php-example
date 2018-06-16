<?php

    
    $apiKey = $_POST['api_key'];
    $token = $_POST['token'];
    
    
    $url = 'https://fcm.googleapis.com/fcm/send';

    
    $headers = array(
        "Authorization:key =$apiKey",
        "Content-Type: application/json"
    );

    $send_Data = array(
        "to" => $token,
        "notification" => array(
            "body"  => "FCM message TESTTEST!!!!!!!!",
            "title" => "FCM Message"
        )
        
    );
    

    $ch = curl_init(); //curl 사용전 초기화 필수
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);                  //0이 default 값이며 POST 통신을 위해 1로 설정
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers); //header 지정하기
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);        //이 옵션이 0으로 지정되면 curl_exec의 결과값을 브라우저에 바로 보여준다. 
                                                        //이 값을 1로 하면 결과값을 return하게 되어 변수에 저장 가능
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);          //호스트에 대한 인증서 이름 확인
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);      //인증서 확인
    curl_setopt($ch, CURLOPT_POSTFIELDS,json_encode($send_Data));   //POST로 보낼 데이터 지정하기
    //curl_setopt($ch, CURLOPT_POSTFIELDSIZE, 0);         //이 값을 0으로 해야 알아서 &post_data 크기를 측정하는듯
    
    $res = curl_exec($ch);

    //에러 발생시 실행
    if ($res === FALSE) {
        die('Curl failed: ' . curl_error($ch));
    }

    curl_close($ch);
    
    echo $res;
    
?>