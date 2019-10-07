<?php
$array = array();

//Base de Treinamento
$array[] = treinamento(0.3, 0.7, 1);
$array[] = treinamento(-0.6, 0.3, 0);
$array[] = treinamento(-0.1, -0.8, 0);
$array[] = treinamento(0.1, -0.45, 1);

//Pesos Aleatórios
$pesos = array(
    "w1" => 0.8,
    "w2" => -0.5,
);

//Taxa de aprendizado
$n = 0.5;

//Inicialização do processo
$pesos = processo($array, $pesos, $n);

//Testes com pesos atualizados
teste(0.3, 0.7, 1, $pesos);
teste(-0.6, 0.3, 0, $pesos);

//Função de Treinamento
function treinamento($x, $y, $classe){
    $array = array(
        "x1" => $x,
        "x2" => $y,
        "classe" => $classe
    );
    return $array;
    echo "ae";
}

//Verificação dos valores
function processo($array, $pesos, $n){
    $i = 0;
    $iteracoes = 1;
    while($i < count($array)){
        echo "Iteração #".$iteracoes.": <br>";
        echo "Teste no Array #".$i.": <br>";
        echo "Peso 1: ".$pesos['w1']." / Peso 2: ".$pesos['w2']."<br>";
        echo "Saída #".$i.": ";
        //Cálculo do output
        echo $output = $array[$i]['x1']*$pesos['w1']+$array[$i]['x2']*$pesos['w2'];
        echo "<br>";
        $saida = $output >= 0 ? 1 : 0;
        if($array[$i]['classe'] == $saida){
            echo "<b>Não Precisa Ajustar Pesos</b>"."<br><br>";
            $i++;
        }else{
            echo "<b>Ajustando Pesos:</b><br>";
            //Calcular Erro
            echo "Erro #".$i.": ";
            echo $e = $array[$i]['classe']-$saida;
            echo "<br>";
            echo "Peso 1: ";
            echo $pesos['w1'] = $pesos['w1']+$n*$e*$array[$i]['x1'];
            echo "<br>";
            echo "Peso 2: ";
            echo $pesos['w2'] = $pesos['w2']+$n*$e*$array[$i]['x2'];
            echo "<br><br>";
            $i = 0;
        }
        $iteracoes++;
    }
    return $pesos;
}

function teste($x1, $x2, $classe, $pesos){
    $output = $x1*$pesos['w1']+$x2*$pesos['w2'];
    $saida = $output >= 0 ? 1 : 0;
    if($classe == $saida){
        echo "Classificado Corretamente"."<br>";
    }else{
        echo "Classificado Erroneamente"."<br>";
    }
}
?>