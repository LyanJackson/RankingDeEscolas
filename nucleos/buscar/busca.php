<?php 
include '../../../web/seguranca.php';


$notas = ($_POST['notas']);
$notasex = ($_POST['notasex']);
$_POST['buscaNome_escola'] = htmlentities($_POST['buscaNome_escola']);


$query = "SELECT * FROM escola JOIN escola_medias ON escola.id_escola = escola_medias.id_escola";

if (isset($_POST['buscaNome_escola']) != "")
    $query .= " WHERE nome_escola LIKE '%". $_POST['buscaNome_escola']."%' ";


if(isset($_POST['buscaCidade']) && $_POST['buscaCidade'] != "all" && $_POST['buscaCidade'] != ""){
    $query .= " AND escola.cidade LIKE '".htmlentities($_POST['buscaCidade'])."' ";
}

if(isset($_POST['categoria']) && $_POST['categoria'] != "all" && $_POST['categoria'] != ""){
    if(($_POST['categoria']) == 0){
        $query .= " AND categoria " . $_POST['categoria'] . " ";
    } elseif(($_POST['categoria']) == 1){
        $query .= " AND categoria " . $_POST['categoria'] . " ";
    } elseif (($_POST['categoria']) >= 0)  {
        $query .= " AND categoria " . $_POST['categoria'] . " ";
    } else{
        $query .= " AND categoria >= 0";
    }
    
}



if($_POST['ativo'] == "ativo")
    $query .= " AND escola.ativo = 1 ";
else
    $query .= " AND escola.ativo = 0 ";



//////////////////////////////////////NOTAS INTERNAS//////////////////////////////

if(isset($_POST['notas'])){
    if(($_POST['notas']) == 'maior'){
        $query .= " ORDER BY soma_pfc DESC";
    } elseif(($_POST['notas']) == 'menor'){
        $query .= " ORDER BY soma_pfc ASC";
    } else {
    }
}


if(isset($_POST['ano'])){
    if(($_POST['ano']) == 2022){
        $query .= " AND escola_medias.ano LIKE '%". $_POST['ano'] . "%' ";
    } elseif(($_POST['ano']) == 2023){
        $query .= " AND escola_medias.ano LIKE '%". $_POST['ano'] . "%' ";
    } 
}


//////////////////////////////////////NOTAS EXTERNAS//////////////////////////////

if(isset($_POST['notasex'])){
    if(($_POST['notasex']) == 'maiorex'){
        $query .= " ORDER BY soma_externa DESC";
    } elseif(($_POST['notasex']) == 'menorex'){
        $query .= " ORDER BY soma_externa ASC";
    
    } else {

    }
}

// echo '<script>alert("'.$query.'")</script>';

$escolas = mysqli_query($_SG['link'], $query);
echo '<br><p class="text-left"><b>'.mysqli_num_rows($escolas).'</b> resultados encontrados</p><hr>';

if (mysqli_num_rows($escolas) != 0){
    while ($escola = mysqli_fetch_assoc($escolas)) {

        $telefonedir = ($escola['tel_fixo_dir'] == '') ? 'TELEFONE NÃO INFORMADO' : $escola['tel_fixo_dir'];
        $telefonecoord = ($escola['tel_fixo_cp'] == '') ? 'TELEFONE NÃO INFORMADO' : $escola['tel_fixo_cp'];
        $telefoneesc = ($escola['telefone_fixo'] == '') ? 'TELEFONE NÃO INFORMADO' : $escola['telefone_fixo'];
        $endereco = ($escola['logradouro'] == '') ? 'ENDEREÇO NÃO INFORMADO' : $escola['logradouro'];





             echo '<div class="buscaContainer equipeContainer">

                <div align="left" class="equipeSobre col-md-8"><br>
                    <h4><b>'.$escola['nome_escola'].'</b></h4>
                    <p><b>Supervisor:</b> '.$escola['supervisor'].'</p>
                    <p><b>Cidade:</b> '.$escola['cidade'].'</p>
                    <p><b>Telefone Fixo Escola:</b> '.$telefoneesc.'</p>
                    <p><b>Diretor:</b> '.$escola['nome_diretor'].' - Telefone: ('.$telefonedir.')</p>
                    <p><b>Coordenador pedagógico:</b> '.$escola['nome_cp'].' - Telefone: ('.$telefonecoord.')</p>
                    <p><span style="color: green;"><b>MÉDIA DE NOTAS ALUNOS DO PFC: </b>'.$escola['soma_pfc'].'</span>
                    <p><span><b>TOTAL DE ALUNOS: </b>'.$escola['num_alunos'].'</span>
                    <p><span style="color: green;"><b>ALUNOS ATIVOS: </b>'.$escola['alunos_ativos'].'</span>
                </div>

                <div class="equipeMenu col-md-2 pull-right" style=" margin-right: 30px;">
                    <a href="?p=ver&r='.$escola['id_escola'].'" class="btn btn-success btn-block"><span class="pull-left glyphicon glyphicon-eye-open"></span> Ver
                    </a> ';
                    if($_SESSION['h'] != 7):
                    echo '<a href="?p=editar&r='.$escola['id_escola'].'" class="btn btn-warning btn-block"><span class="pull-left glyphicon glyphicon-pencil"></span> Editar
                    </a>  '; 

                 
                    echo  '<a href="?p=listah&r='.$escola['id_escola'].'" class="btn btn-success btn-block"><span class="pull-left glyphicon glyphicon-eye-open"></span> Lista de Alunos
                    </a> '; 

                     
                    echo  '<a href="?p=lista&r='.$escola['id_escola'].'" class="btn btn-warning btn-block"><span class="pull-left glyphicon glyphicon-list-alt"></span> Histórico de Alunos
                    </a> '; 
                    
                    if($escola['ativo'] == 1): 
                        echo '<button id="'.$escola['id_escola'].'" class="desativar btn btn-danger btn-block"><span class="pull-left glyphicon glyphicon-trash"></span>&ensp;Desativar</button>';
                    else:
                        echo '<button id="'.$escola['id_escola'].'" class="desativar btn btn-danger btn-block"><span class="pull-left glyphicon glyphicon-trash"></span>&ensp;Ativar</button>';
                    endif;
                    echo '<form class="formsHidden'.$escola['id_escola'].'">
                        <input type="hidden" value="'.$escola['id_escola'].'" name="id" />
                        <input id="input'.$escola['id_escola'].'" type="hidden" value="'.$escola['ativo'].'" name="ativo" />
                    </form>
                    '; endif;
                echo '</div>


             </div>';

        }
} else {
        echo '<div class="alert alert-danger" role="alert"><span class="glyphicon glyphicon-exclamation-sign"></span> Nenhum resultado encontrado</div>';
}
 ?>

 <script>
            $('.desativar').click(function () {
                var $id = $(this).attr('id');
                var $ativo = $('#input'+$id).val();

                var data = $('.formsHidden'+ $id).serialize();

                $.ajax({
                    url: '<?php echo $root_html?>sistema/nucleos/buscar/desativar.php',
                    type: 'POST',
                    data: data,
                    beforeSend: function (e) {
                        if($ativo == 1)
                            $("#"+$id).html("Desativando...");
                        else
                            $("#"+$id).html("Ativando...");                        
                    },
                    success: function (data) {
                    setTimeout(function() {$('#'+$id).html(data);}, 1000);
                    },
                    complete: function (e) {
                        if($ativo == 1)
                            $("#input"+$id).val(0);
                        else
                            $("#input"+$id).val(1);         
                    },
                    error: function (e) {
                        $('#resultado1').html("<option>Nenhum resultado encontrado.</option>");
                    },
                });

            });

</script>