<?php

namespace Wpdew\HelperPack;

class HelperPack
{
    

    public function getName($name)
    {
        return 'Hi from HelperPack Class '.$name;
    }

    /**
     * @param $name
     * @return string v1.0.1
     */
    
    public function SendTelegram($botToken, $chatId, $message)
    {
        $botToken = $botToken;
        $chatId = $chatId;
        $message = $message;

        $url = "https://api.telegram.org/bot$botToken/sendMessage?chat_id=$chatId&parse_mode=html&text=".$message."";
        $ch = curl_init();
        $optArray = array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true
        );
        curl_setopt_array($ch, $optArray);
        $result = curl_exec($ch);
        curl_close($ch);

        return $result;
    }

    public function SendTelegramArray($botToken, $chatId, $message)
    {
        $botToken = $botToken;
        $chatId = $chatId;
        $message = $message;
        $message = $this->array2string($message);
        $result = fopen("https://api.telegram.org/bot{$botToken}/sendMessage?chat_id={$chatId}&parse_mode=html&text={$message}","r");
        return $result;
    }

    public function SendCurl($url, $data)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }

    public function SendToBot($url, $data)
    {
        $curl_tel = curl_init();
        curl_setopt($curl_tel, CURLOPT_URL, $url);
        curl_setopt($curl_tel, CURLOPT_RETURNTRANSFER,true);
        curl_setopt($curl_tel, CURLOPT_POSTFIELDS, http_build_query($data));
        $out = curl_exec($curl_tel);
        curl_close($curl_tel);
        return $out;
    }


    public function array2string($data){
        $log_a = "";
        foreach ($data as $key => $value) {
            if(is_array($value))    $log_a .= "<b>".$key."</b> - ". array2string($value). " %0A";
            else                    $log_a .= "<b>".$key."</b> - ".$value."%0A";
        }
        return $log_a;
    }


}
