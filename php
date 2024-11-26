banco.php

<?php
    //objeto do tipo PDO - conexão com o banco de dados
    $con = new PDO("mysql:host=localhost;dbname=banco;charset=utf8", "root", "");
?>

alterar.php

<?php
    require 'banco.php';
    //isset vai procurar a variável, vai devolver verdadeiro ou falso
    if (!isset($_GET['id_cidade']) ||!isset($_GET['cidade']) || !isset($_GET['uf'])){
        echo 'Erro! Cidade, Estado e o Id da cidade são obrigatórios!';
        exit(); //vai encerrar o código, para por aqui
    }
    
    $id_cidade = $_GET['id_cidade'];
    $cidade = $_GET['cidade'];
    $uf = $_GET['uf'];

    $sql = "UPDATE cidade
            SET cidade = :cidade, uf = :uf
            WHERE id_cidade = :id_cidade"; //dois pontos significa parâmetros para o SQL

    $qry = $con->prepare($sql); //prepare valida se o comando sql está escrito corretamente
    $qry->bindParam(':id_cidade', $id_cidade, PDO::PARAM_STR);
    $qry->bindParam(':cidade', $cidade, PDO::PARAM_STR); //define os parâmetros, o PDO PARAM vai informar que é string
    $qry->bindParam(':uf', $uf, PDO::PARAM_STR);
    $qry->execute();

    $num = $qry->rowCount(); //devolve o numero de registros da query
    echo $num;

?>

excluir.php

<?php
    require 'banco.php';
    //isset vai procurar a variável, vai devolver verdadeiro ou falso
    if (!isset($_GET['id_cidade'])){
        echo 'Erro! Dados faltando';
        exit(); //vai encerrar o código, para por aqui
    }
    
    $id_cidade = $_GET['id_cidade'];

    $sql = "DELETE FROM cidade
            WHERE id_cidade = :id_cidade"; //dois pontos significa parâmetros para o SQL

    $qry = $con->prepare($sql); //prepare valida se o comando sql está escrito corretamente
    $qry->bindParam(':id_cidade', $id_cidade, PDO::PARAM_STR);

    $qry->execute();

    $num = $qry->rowCount(); //devolve o numero de registros da query
    echo $num;

?>

inserir.php

<?php
    require 'banco.php';
    //isset vai procurar a variável, vai devolver verdadeiro ou falso
    if (!isset($_GET['cidade']) || !isset($_GET['uf'])){
        echo 'Erro! Cidade e Estado são obrigatórios.';
        exit(); //vai encerrar o código, para por aqui
    }
    
    $cidade = $_GET['cidade'];
    $uf = $_GET['uf'];

    $sql = "INSERT INTO cidade (cidade, uf)
            VALUES (:cidade, :uf)"; //dois pontos significa parâmetros para o SQL

    $qry = $con->prepare($sql); //prepare valida se o comando sql está escrito corretamente
    $qry->bindParam(':cidade', $cidade, PDO::PARAM_STR); //define os parâmetros, o PDO PARAM vai informar que é string
    $qry->bindParam(':uf', $uf, PDO::PARAM_STR);
    $qry->execute();

    $num = $qry->rowCount(); //devolve o numero de registros da query
    echo $num;

?>

listar;.php

<?php
    require 'banco.php';

    $sql = "SELECT * FROM cidade
            ORDER BY id_cidade";
    $qry = $con->prepare($sql); //prepare valida se o comando sql está escrito corretamente
    $qry->execute();

    //$num = $qry->rowCount(); devolve o numero de registros da query
    //echo $num;

    $registros = $qry->fetchAll(PDO::FETCH_OBJ); //transforma os dados da query para o tipo fetch_obj - que é um array associativo
    echo json_encode($registros); //transforma no formato json

?>

selecionar.php

<?php
    require 'banco.php';
    //isset vai procurar a variável, vai devolver verdadeiro ou falso
    if (!isset($_GET['id_cidade'])){
        echo 'Erro! Dados faltando';
        exit(); //vai encerrar o código, para por aqui
    }
    
    $id_cidade = $_GET['id_cidade'];

    $sql = "SELECT * FROM cidade
            WHERE id_cidade = :id_cidade"; //dois pontos significa parâmetros para o SQL

    $qry = $con->prepare($sql); //prepare valida se o comando sql está escrito corretamente
    $qry->bindParam(':id_cidade', $id_cidade, PDO::PARAM_STR);

    $qry->execute();

    $num = $qry->fetchAll(PDO::FETCH_OBJ); //devolve o numero de registros da query
    echo json_encode($num);

?>
