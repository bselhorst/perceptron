<?php
$array = array();

//Base de Treinamento
$array[] = treinamento(0.3, 0.7, 0.7, 1);
$array[] = treinamento(-0.6, 0.3, 0.8, 0);
$array[] = treinamento(-0.1, -0.8, 0.6, 0);
$array[] = treinamento(0.1, -0.45, 0.2, 1);

//Pesos Aleatórios
$pesos = array(
    "w1" => 0.8,
    "w2" => -0.5,
    "w3" => 1,
);

//Taxa de aprendizado
$n = 0.5;

//Inicialização do processo
$pesos = processo($array, $pesos, $n);

//Testes com pesos atualizados
teste(0.3, 0.7, 0.6, 1, $pesos);
teste(-0.6, 0.3, 0.5, 0, $pesos);

//Função de Treinamento
function treinamento($x, $y, $z, $classe){
    $array = array(
        "x1" => $x,
        "x2" => $y,
        "x3" => $z,
        "classe" => $classe
    );
    return $array;
}

//Verificação dos valores
function processo($array, $pesos, $n){
    $i = 0;
    $iteracoes = 1;
    while($i < count($array)){
        //Cálculo do output
        echo $output = $array[$i]['x1']*$pesos['w1']+$array[$i]['x2']*$pesos['w2']+$array[$i]['x3']*$pesos['w3'];
        $saida = $output >= 0 ? 1 : 0;
        if($array[$i]['classe'] == $saida){
            $i++;
        }else{
            //Calcular Erro
            $e = $array[$i]['classe']-$saida;
            //Recalculo dos Pesos
            $pesos['w1'] = $pesos['w1']+$n*$e*$array[$i]['x1'];
            $pesos['w2'] = $pesos['w2']+$n*$e*$array[$i]['x2'];
            $pesos['w3'] = $pesos['w3']+$n*$e*$array[$i]['x3'];
            $i = 0;
        }
    }
    return $pesos;
}

function teste($x1, $x2, $x3, $classe, $pesos){
    $output = $x1*$pesos['w1']+$x2*$pesos['w2']+$x3*$pesos['w3'];
    
    $saida = $output >= 0 ? 1 : 0;
    
    if($classe == $saida){
        echo "Classificado Corretamente"."<br>";
    }else{
        echo "Classificado Erroneamente"."<br>";
    }
}
?>