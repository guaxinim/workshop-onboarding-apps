<?php
$Sorteio = new Sorteio;

$Sorteio->Sorteia($Mparticipantes);

class Sorteio {
        public function Sorteia($Mparticipantes) {
                $data = json_encode($Mparticipantes);
$data_string = $data;                                                                                   
$data_string = "{
        "alunos" : [
            {
                "nome": "Gustavo Luszczynski"
            },
            {
                "nome": "Luciano Scorsin"
            }
        ]
}"
                                                                                                                     
$ch = curl_init('http://sorteio:8080/rest/sorteio');                                                                      
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);                                                                  
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                      
curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
    'Content-Type: application/json',                                                                                
    'Content-Length: ' . strlen($data_string))                                                                       
);                                                                                                                   
                                                                                                                     
$result = curl_exec($ch);
        return $result;

        }
}

?>
