<?php
        
//Importar o ficheiro com a ligacao a BD
//A ligacao a BD devera ser colocada na variavel conn
require 'Connection.php';


//$data = [{"name":"username","value":"a"},{"name":"password","value":"b"},{"name":"nome","value":"c"},{"name":"nif","value":"5"},{"name":"morada","value":"g"}];
                
        

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{        
  	$data = json_decode(file_get_contents("php://input"));
        
        $username = $data->username;
    	$password = $data->password;
        $nome = $data->nome;
        $nif = $data->nif;
        $morada = $data->morada;     

        $sql = "INSERT INTO `Cliente` (`ID`, `Username`, `Password`, `Nome`, `NIF`, `Morada`) 
        VALUES (NULL,'".$username."' , '".MD5($password)."', '".$nome."', '".$nif."', '".$morada."')";


        //$returnArray = array ("status" => "1","content" => $sql);
        //header('Content-type: application/json');
        //echo json_encode($returnArray);
        //exit();
        //echo $sql1;        
    
    
        $result = $conn->query($sql);

    	if ($result) {
        	// atualizado com sucesso
                $returnArray = array ("status" => "1","content" => "Cliente criado com sucesso.");
        } else {
    		// erro na atualizacao
                $returnArray = array ("status" => "1","content" => $conn->error);
                //$returnArray = array ("status" => "1","content" => "Erro na criação do cliente.");
        }
}
else {
        $returnArray = array ("status" => "0","content" => "Metodo nao e POST");
}

header('Content-type: application/json');
echo json_encode($returnArray);

?>
