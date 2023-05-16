<?php include '../../../web/seguranca.php'; 

$title = "AdminPFC - Núcleos";

// protegePaginaUnica(901, 3);
protectPage("3;901;902;7;8");

if (isset($_GET['p']) && isset($_GET['r'])){
    $p = $_GET['p'];
    $r = $_GET['r'];
}
include '../../head.php';
?>
<body class="hold-transition skin-black sidebar-mini fixed">

    <div class="wrapper">

    <?php include '../../menu.php'; ?>

        <div class="content-wrapper">
            <?php if($_SESSION['h'] == 8): 
?>
<!----------------------------------- DIRETOR/ESCOLA PAGINA DIFERENTE------------------------------------------------->
            <section class="content-header">
                <?php if(!isset($p)): ?>
                    <a href="<?php echo $root_html ?>sistema/" class="btn btn-default"><i class="fa fa-arrow-left"></i>&ensp;Voltar</a>                
                <?php elseif(isset($p)): ?>
                    <a href="<?php echo $root_html ?>sistema/" class="btn btn-default"><i class="fa fa-arrow-left"></i>&ensp;Voltar</a>                
                <?php endif; ?>

                <ol class="breadcrumb">
                <li><a href="<?php echo $root_html ?>sistema/"><i class="fa fa-dashboard"></i> Home</a></li>
                <li>Núcleos</li>
                <?php if(!isset($p)): ?>
                <li class="active">Buscar</li>
                <?php elseif(isset($p) && $p == 'ver'): ?>
                <li class="active">Ver</li>     
                <?php endif; ?>           
              </ol>               
              </section>
<!-------------------------------------------------------------------------------------------------------------------->
<?php else: ?> 
            <section class="content-header">
                <?php if(!isset($p)): ?>
                    <a href="<?php echo $root_html ?>sistema/" class="btn btn-default"><i class="fa fa-arrow-left"></i>&ensp;Voltar</a>                
                <?php elseif(isset($p)): ?>
                    <a href="<?php echo $root_html ?>sistema/nucleos/buscar/" class="btn btn-default"><i class="fa fa-arrow-left"></i>&ensp;Voltar</a>                

                <?php endif; ?>
              <ol class="breadcrumb">
                <li><a href="<?php echo $root_html ?>sistema/"><i class="fa fa-dashboard"></i> Home</a></li>
                <li>Núcleos</li>
                <?php if(!isset($p)): ?>
                <li class="active">Buscar</li>
                <?php elseif(isset($p) && $p == 'editar'): ?>
                <li><a href="<?php echo $root_html ?>sistema/nucleos/buscar/">Buscar</a></li>
                <li class="active">Editar</li>
                <?php elseif(isset($p) && $p == 'ver'): ?>
                <li><a href="<?php echo $root_html ?>sistema/nucleos/buscar/">Buscar</a></li>
                <li class="active">Ver</li>     
                <?php endif; ?>           
              </ol> 
            </section>
        <?php endif;?>
<br><br>
            <div class="container-fluid">

                <?php if (!isset($_GET['p']) && !isset($_GET['r'])):
                ?>
                
                <form method="POST" action="busca.php" class="alunoCadastro forms-buscar">
 
                    <h2>
                        <i class="fa fa-search"></i> Busca
                    </h2>
                    <hr>

                    <div class="row">
                        <div class="form-group col-md-6">
                            <br>
                            <label style="text-align:center" for="nomeescolas">Nome da Escola</label>
                            <input type="text" id="buscaNome_escola" name="buscaNome_escola" class="form-control input-lg" placeholder="Procure pelo nome da escola...">
                        </div>
                        <div class="form-group col-md-6">
                            <br>
                            <label style="text-align:center" for="cidades">Cidade</label>
                            <select name="buscaCidade" id="buscaCidade" class="form-control input-lg">
                            <?php if($_SESSION['h'] == 3 || $_SESSION['h'] == 7 || $_SESSION['h'] == 8): 

                            ?>
                                <option value="<?php echo $_SESSION['supervisorCidade'] ?>"><?php echo $_SESSION['supervisorCidade'] ?></option>

                            <?php else: ?>
                   
                            <option value="" selected hidden>Escolha uma cidade</option>
                            <option value="all">Todas</option>

                            <?php    $query = "SELECT DISTINCT cidade FROM escola ORDER BY cidade";
                                $res = mysqli_query($_SG['link'], $query);

                                while($cidade = mysqli_fetch_assoc($res)):
                                ?>
                                    <option value="<?php echo $cidade['cidade'] ?>"><?php echo $cidade['cidade'] ?></option>
                            <?php endwhile; endif; ?>                           
                            </select>
                        </div>
                        
                        <div class="col-md-12">
                            
                            <div class="form-group">
                                <!-- <label for="categoria">Categoria</label> -->
                            <label style="text-align:center" for="nomeescolas">Graus</label>
                                <select name="categoria" id="categoria" class="form-control input-lg">
                                    <option value="" hidden>Selecione uma categoria</option>
                                    <!--<option value=">= 0">Todos</option>-->
                                    <option value="= 0">Ensino Fundamental</option>
                                    <option value="= 1">Ensino Médio</option>
                                    <option value=">= 0">Ensino Fundamental e Médio</option>
                                </select>
                            </div>
                        

<br>
                        </div>
                        <!---------------------------------------- NOTAS INTERNAS ---------------------------------------------------->   
                        <div class="col-md-6">
                        <div class="form-group">
                    <label style="text-align:center" for="notas">Notas no PFC</label>
                    <select name="notas" id="notas" class="form-control input-lg">
                            <option value="" hidden>Selecione uma opção</option>
                            <option id="semmm" value="semmm">Sem Filtro</option>
                            <option id="maior" value="maior">Melhores notas do programa</option>
                            <option id="menor" value="menor">Menores notas do programa</option>
                            </select>
                    </div>
                    </div>


                          <!---------------------------------------- NOTAS EXTERNAS ---------------------------------------------------->   
                          <div class="col-md-6">
                        <div class="form-group">
                    <label style="text-align:center" for="notasex">Notas Externas</label>
                    <select name="notasex" id="notasex" class="form-control input-lg">
                            <option value="" hidden>Selecione uma opção</option>
                            <option id="semmmmm" value="semmmmm">Sem Filtro Externo</option>
                            <option id="maiorex" value="maiorex">Escola com as maiores notas</option>
                            <option id="menorex" value="menorex">Escola com as menores notas</option>
                            </select>
                    </div>
                    </div>

                        <!-------------------------------------------------------------------------------------------->

                               <!---------------------------------------- ANO ---------------------------------------------------->   
                               <div class="col-md-6">
                        <div class="form-group">
                    <label style="text-align:center" for="busca_notas">Ano do PFC</label>
                    <select name="ano" id="ano" class="form-control input-lg">
                            <option value="" hidden>Selecione um ano do PFC</option>
                            <option id="sem" value="sem">Sem filtro anual</option>
                            <option id="2022" value="2022">2022</option>
                            <option id="2023" value="2023">2022</option>
                            </select>
                    </div>
                    </div>

                      <!---------------------------------------- ANO ---------------------------------------------------->   
                      <div class="col-md-6">
                        <div class="form-group">
                    <label style="text-align:center" for="busca_notas">Semestre</label>
                    <select name="anoE" id="anoE" class="form-control input-lg">
                            <option value="" hidden>Selecione um semestre acadêmico</option>
                            <option id="seeem" value="semm">Sem filtro semestral</option>
                            <option id="2022E" value="2022">2023/1</option>
                            </select>
                    </div>
                    </div>
                        <!-------------------------------------------------------------------------------------------->

                        <div class="col-md-12 text-center">
                            <div class="radio">
                              <label>
                                <input type="radio" name="ativo" id="ativo" value="ativo" checked>
                                Ativos
                              </label>&ensp;
                                <label>
                                <input type="radio" name="ativo" id="invativo" value="inativo">
                               Inativos
                              </label>

                            </div>

                        </div>
                    </div>

                </form> 
                <?php 
                if($_SESSION['h'] != 3 AND $_SESSION['h'] != 7 AND $_SESSION['h'] != 8)
                    $query = "SELECT * FROM escola ORDER BY nome_escola";
                else{
                    $cidade = $_SESSION['supervisorCidade'];
                    $query = "SELECT * FROM escola WHERE cidade LIKE '".$_SESSION['supervisorCidade']."' ORDER BY nome_escola";
                }

                    // echo '<script>alert("'.$cidade.'")</script>';
 
                    $escolas = mysqli_query($_SG['link'],$query);
                 ?>
    <div align="center" class="row" style="margin: 0 auto; width: 100%;">
                    <div  id="resultado" class="container">
                    <?php 
                    echo '<br><p class="text-left"><b>'.mysqli_num_rows($escolas).'</b> resultados encontrados</p><hr>';

                        if (mysqli_num_rows($escolas) != 0){
                        while ($escola = mysqli_fetch_assoc($escolas)) {

                            $telefonedir = ($escola['tel_fixo_dir'] == '') ? 'NÃO INFORMADO' : $escola['tel_fixo_dir'];
                            $telefonecoord = ($escola['tel_fixo_cp'] == '') ? 'NÃO INFORMADO' : $escola['tel_fixo_cp'];
                             $telefoneesc = ($escola['telefone_fixo'] == '') ? 'NÃO INFORMADO' : $escola['telefone_fixo'];
                             $endereco = ($escola['logradouro'] == '') ? 'NÃO INFORMADO' : $escola['logradouro'];


                            
                                 echo '<div class="buscaContainer equipeContainer">

                                    <div align="left" class="equipeSobre col-md-8"><br>
                                        <h4><b>'.$escola['nome_escola'].'</b></h4>
                                        <p><b>Supervisor:</b> '.$escola['supervisor'].'</p>
                                        <p><b>Cidade:</b> '.$escola['cidade'].'</p>
                                        <p><b>Telefone Fixo Escola:</b> '.$telefoneesc.'</p>
                                        <p><b>Diretor:</b> '.$escola['nome_diretor'].' - Telefone: ('.$telefonedir.')</p>
                    <p><b>Coordenador pedagógico:</b> '.$escola['nome_cp'].' - Telefone: ('.$telefonecoord.')</p>
                                     <p><b>Endereço:</b> '.$endereco.'</p>
                                     <p><span style="color: green;"><b>MÉDIA DE NOTAS ALUNOS DO PFC: </b>'.$escola['soma_pfc'].'</span>
                    <p><span><b>TOTAL DE ALUNOS: </b>'.$escola['num_alunos'].'</span>
                    <p><span style="color: green;"><b>ALUNOS ATIVOS: </b>'.$escola['alunos_ativos'].'</span>
                                    </div>

                                    <div class="equipeMenu col-md-2 pull-right" style=" margin-right: 30px;">
                                        <a href="?p=ver&r='.$escola['id_escola'].'" class="btn btn-success btn-block"><span class="pull-left glyphicon glyphicon-eye-open"></span> Ver
                                        </a> ';
                                        if($_SESSION['h'] != 7):
                                        echo '<a href="?p=editar&r='.$escola['id_escola'].'" class="btn btn-warning btn-block"><span class="pull-left glyphicon glyphicon-pencil"></span> Editar
                                        </a> ';
                                    
                                        echo  '<a href="?p=listah&r='.$escola['id_escola'].'" class="btn btn-success btn-block"><span class="pull-left glyphicon glyphicon-eye-open"></span> Lista de Alunos
                                        </a> '; 

                                         
                                        echo  '<a href="?p=lista&r='.$escola['id_escola'].'" class="btn btn-info btn-block"><span class="pull-left glyphicon glyphicon-list-alt"></span> Histórico Alunos
                                        </a> '; 
                                        
                                        if($escola['ativo'] == 1): 
                                            echo '<button id="'.$escola['id_escola'].'" class="desativar btn btn-danger btn-block"><span class="pull-left glyphicon glyphicon-trash"></span>&ensp;Desativar</button>';
                                        else:
                                            echo '<button id="'.$escola['id_escola'].'" class="desativar btn btn-danger btn-block"><span class="pull-left glyphicon glyphicon-ok"></span>&ensp;Ativar</button>';
                                        endif;
                                        echo '<form class="formsHidden'.$escola['id_escola'].'">
                                            <input type="hidden" value="'.$escola['id_escola'].'" name="id" />
                                            <input id="input'.$escola['id_escola'].'" type="hidden" value="'.$escola['ativo'].'" name="ativo" />
                                        </form>
                                        '; endif; echo '
                                    </div>


                                 </div>';

                            }
                    } else {
                            echo '<div class="alert alert-danger" role="alert"><span class="glyphicon glyphicon-exclamation-sign"></span> Nenhum resultado encontrado</div>';
                    }
                     ?>
                </div>                
            </div>                

                <?php elseif($p == 'editar'):
                    protectPage("3;901;902");
 
                    $query = "SELECT * FROM escola WHERE id_escola = '$r' LIMIT 1";

                    $result = mysqli_query($_SG['link'], $query);
                    $escola = mysqli_fetch_assoc($result);
                ?>

                 
                <div class="container-fluid" style="width: 80%;">
                <form id="forms-cadastro" enctype="multipart/form-data" method="POST" class="vestibularEditar formsEquipe forms-cadastrar">


                    <input type="hidden" name="id_escola" value="<?php echo $escola['id_escola']?>">     

                    <h1 class="text-center">Editar dados da Escola: <br> <small><?php echo $escola['nome_escola'] ?></small><br>
                    <hr></h1>

                    <p class="help-block"><span style="color: red;">ATENÇÃO:</span> Campo marcado com "<span style="color: red;">*</span>"<u> NÃO</u> deixe de preencher.</p>
                    
                    <hr>              
                    <h1 class="text-center"><small>Escola</small></h1>
                    <hr>   

                    <div class="row">
                        
                        <div class="col-md-6 form-group">
                            <label for="nome_escola">Nome da Escola <span style="color: red;">*</span></label>
                            <input id="nome_escola" type="text" name="nome_escola" class="form-control" placeholder="Digite o nome da escola" value="<?php echo $escola['nome_escola'] ?>">
                        </div>
                        
                        <div class="col-md-6 form-group">
                            <label for="categoria">Categoria: <span style="color: red;">*</span></label>
                            <select name="categoria" id="categoria" class="form-control">
                                <option <?php echo ($escola['categoria'] == 0) ? 'selected' : ''; ?> value="0">Ensino Fundamental</option>
                                <option <?php echo ($escola['categoria'] == 1) ? 'selected' : ''; ?> value="1">Ensino Médio</option>
                                <option <?php echo ($escola['categoria'] == 2) ? 'selected' : ''; ?> value="2">Âmbos</option>
                            </select>
                        </div>

                        
                    </div>
                    
                    <div class="form-group">
                        <label for="cidade">Cidade <span style="color: red;">*</span></label>
                        <?php if($_SESSION['h'] == 3 OR $_SESSION['h'] == 7 || $_SESSION['h'] == 8): ?>
                            <input type="text" class="form-control" name="cidade" id="cidade" value="<?php echo $_SESSION['supervisorCidade'] ?>" readonly>
                        <?php else: ?>
                            <input type="text" class="form-control" name="cidade" id="cidade" value="<?php echo $escola['cidade'] ?>">
                            
                        <?php endif; ?>                           
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="cidade">Supervisor <span style="color: red;">*</span></label>
                            <input type="text" class="form-control" name="supervisor" id="supervisor" value="<?php echo $escola['supervisor'] ?>" required>              
                        </select>
                    </div>

               <!----------------------------------------------------------------------------------------------------------->


                    <div class="form-group">
                        <label for="logradouro">Logradouro <span style="color: red;">*</span></label>
                        <input type="text" name="logradouro" id="logradouro" class="form-control" placeholder="Digite o endereço da escola" value="<?php echo $escola['logradouro'] ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="bairro">Bairro <span style="color: red;">*</span></label>
                        <input type="text" name="bairro" id="bairro" class="form-control" placeholder="Digite o nome do bairro onde a escola fica" value="<?php echo $escola['bairro'] ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="cep">CEP <span style="color: red;">*</span></label>
                        <input type="text" name="cep" id="cep" class="form-control" placeholder="Digite o CEP da escola" value="<?php echo $escola['cep'] ?>" required>
                    </div>  

                    <div class="form-group">
                        <label for="estado">Estado <span style="color: red;">*</span></label>
                        <input type="text" name="estado" id="estado" class="form-control" placeholder="Digite as siglas do estado. Exemplo: SP, RJ..." value="<?php echo $escola['estado'] ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="email_esc">E-mail <span style="color: red;">*</span></label>
                        <input type="text" name="email_esc" id="email_esc" class="form-control" placeholder="Digite o e-mail da Escola" value="<?php echo $escola['email_esc'] ?>" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="tel_fixo_esc">Telefone fixo <span style="color: red;">*</span></label>
                        <input type="text" name="tel_fixo_esc" id="tel_fixo_esc" class="form-control" placeholder="Telefone fixo da escola para contato" value="<?php echo $escola['tel_fixo_esc'] ?>"required>
                    </div>

                    <div class="form-group">
                        <label for="cel_esc">Celular</label>
                        <input type="text" name="cel_esc" id="cel_esc" class="form-control" placeholder="Celular da escola para contato" value="<?php echo $escola['cel_esc'] ?>">
                    </div>
                   <h1 class="text-center"> <small>Diretor(a)</small></h1>
                    <hr><br>

                    <div class="form-group">
                        <label for="nome_diretor">Nome do Diretor(a) <span style="color: red;">*</span></label>
                        <input type="text" name="nome_diretor" id="nome_diretor" class="form-control" placeholder="Nome completo do Diretor(a)" value="<?php echo $escola['nome_diretor'] ?>" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="email_dir">E-mail do Diretor(a) <span style="color: red;">*</span></label>
                        <input type="text" name="email_dir" id="email_dir" class="form-control" placeholder="Digite o e-mail do Diretor(a)" value="<?php echo $escola['email_dir'] ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="tel_fixo_dir">Telefone fixo do Diretor(a)</label>
                        <input type="text" name="tel_fixo_dir" id="tel_fixo_dir" class="form-control" placeholder="Telefone fixo do Diretor(a)" value="<?php echo $escola['tel_fixo_dir'] ?>">
                    </div>
                    <div class="form-group">
                        <label for="cel_dir">Celular do Diretor(a) <span style="color: red;">*</span></label>
                        <input type="text" name="cel_dir" id="cel_dir" class="form-control" placeholder="Celular do Diretor(a)" value="<?php echo $escola['cel_dir'] ?>" required>
                    </div>

                    <hr>

                    <p class="help-block"><span style="color: red;">ATENÇÃO:</span> Caso a escola não possuir um <u>VICE DIRETOR</u> preencher com as informações do Diretor.</p>
                    
                    <hr>
                     
                    
                    <h1 class="text-center"> <small>Vice Diretor(a)</small></h1>
                    <hr><br>

                    <div class="form-group">
                        <label for="nome_vdir">Nome do Vice Diretor(a) <span style="color: red;">*</span></label>
                        <input type="text" name="nome_vdir" id="nome_vdir" class="form-control" placeholder="Nome completo do Vice Diretor(a)" value="<?php echo $escola['nome_vdir'] ?>" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="email_vdir">E-mail do Vice Diretor(a) <span style="color: red;">*</span></label>
                        <input type="text" name="email_vdir" id="email_vdir" class="form-control" placeholder="Digite o e-mail do Vice Diretor(a)" value="<?php echo $escola['email_vdir'] ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="tel_fixo_vdir">Telefone fixo do Vice Diretor(a)</label>
                        <input type="text" name="tel_fixo_vdir" id="tel_fixo_vdir" class="form-control" placeholder="Telefone fixo do Vice Diretor(a)" value="<?php echo $escola['tel_fixo_vdir'] ?>">
                    </div>
                    <div class="form-group">
                        <label for="cel_vdir">Celular do Vice Diretor(a) <span style="color: red;">*</span></label>
                        <input type="text" name="cel_vdir" id="cel_vdir" class="form-control" placeholder="Celular do Vice Diretor(a)" value="<?php echo $escola['cel_vdir'] ?>" required>
                    </div>

                    <hr>

                    <p class="help-block"><span style="color: red;">ATENÇÃO:</span> No caso do <u>COORDENADOR PEDAGÓGICO E COORDENADOR LOCAL</u> ser o mesmo, preencher o campo dos dois cargo com as mesmas informações.</p>
                    
                    <hr>

                    <h1 class="text-center"> <small>Coordenador Pedagógico</small></h1>
                    <hr><br>

                    <div class="form-group">
                        <label for="nome_cp">Nome do Coordenador Pedagógico <span style="color: red;">*</span></label>
                        <input type="text" name="nome_cp" id="nome_cp" class="form-control" placeholder="Nome completo do Coordenador Pedagógico" value="<?php echo $escola['nome_cp'] ?>" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="email_cp">E-mail do Coordenador Pedagógico <span style="color: red;">*</span></label>
                        <input type="text" name="email_cp" id="email_cp" class="form-control" placeholder="Digite o e-mail do Coordenador Pedagógico" value="<?php echo $escola['email_cp'] ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="tel_fixo_cp">Telefone fixo do Coordenador Pedagógico</label>
                        <input type="text" name="tel_fixo_cp" id="tel_fixo_cp" class="form-control" placeholder="Telefone fixo do Coordenador Pedagógico" value="<?php echo $escola['tel_fixo_cp'] ?>">
                    </div>
                    <div class="form-group">
                        <label for="cel_cp">Celular do Coordenador Pedagógico <span style="color: red;">*</span></label>
                        <input type="text" name="cel_cp" id="cel_cp" class="form-control" placeholder="Celular do Coordenador Pedagógico" value="<?php echo $escola['cel_cp'] ?>" required>
                    </div>
                    <h1 class="text-center"> <small>Coordenador Local</small></h1>
                    <hr><br>

                    <div class="form-group">
                        <label for="nome_cl">Nome do Coordenador(a) Local <span style="color: red;">*</span></label>
                        <input type="text" name="nome_cl" id="nome_cl" class="form-control" placeholder="Nome completo do Coordenador(a) Local" value="<?php echo $escola['nome_cl'] ?>" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="email_cl">E-mail do Coordenador(a) Local <span style="color: red;">*</span></label>
                        <input type="text" name="email_cl" id="email_cl" class="form-control" placeholder="Digite o e-mail do Coordenador(a) Local" value="<?php echo $escola['email_cl'] ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="tel_fixo_cl">Telefone fixo do Coordenador(a) Local</label>
                        <input type="text" name="tel_fixo_cl" id="tel_fixo_cl" class="form-control" placeholder="Telefone fixo do Coordenador(a) Local" value="<?php echo $escola['tel_fixo_cl'] ?>">
                    </div>
                    <div class="form-group">
                        <label for="cel_cl">Celular do Coordenador(a) Local <span style="color: red;">*</span></label>
                        <input type="text" name="cel_cl" id="cel_cl" class="form-control" placeholder="Celular do Coordenador(a) Local" value="<?php echo $escola['cel_cl'] ?>" required>
                    </div>     

                     <h1 class="text-center"> <small>Embaixador Júnior</small></h1>
                    <hr><br>

                    <div class="form-group">
                        <label for="nome_ej">Nome do Embaixador Júnior <span style="color: red;">*</span></label>
                        <input type="text" name="nome_ej" id="nome_ej" class="form-control" placeholder="Nome completo do Embaixador Júnior" value="<?php echo $escola['nome_ej'] ?>" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="email_ej">E-mail do Embaixador Júnior</label>
                        <input type="text" name="email_ej" id="email_ej" class="form-control" placeholder="Digite o e-mail do Embaixador Júnior" value="<?php echo $escola['email_ej'] ?>">
                    </div>

                    <div class="form-group">
                        <label for="tel_fixo_ej">Telefone fixo do Embaixador Júnior</label>
                        <input type="text" name="tel_fixo_ej" id="tel_fixo_ej" class="form-control" placeholder="Telefone fixo do Embaixador Júnior" value="<?php echo $escola['tel_fixo_ej'] ?>">
                    </div>
                    <div class="form-group">
                        <label for="cel_ej">Celular do Embaixador Júnior <span style="color: red;">*</span></label>
                        <input type="text" name="cel_ej" id="cel_ej" class="form-control" placeholder="Celular do Embaixador Júnior" value="<?php echo $escola['cel_ej'] ?>" required>
                    </div>     


                    <!---------------------------------------------------------------------------------------->

                    <div class="text-center">
                        <button id="enviarForm" type="button" class="btn btn-primary btn-lg">Salvar</button>   

                    </div>
                </form>
</div>

<?php elseif($p == 'listah'): 
                    $sql = "SELECT id_escola, logradouro, bairro, cidade, cep, estado, email_esc, tel_fixo_esc, cel_esc, nome_diretor, email_dir, tel_fixo_dir, cel_dir, nome_vdir, email_vdir, tel_fixo_vdir, cel_vdir, nome_cp, email_cp, tel_fixo_cp, cel_cp, nome_cl, email_cl, tel_fixo_cl, cel_cl, nome_ej, email_ej, tel_fixo_ej, cel_ej FROM escola WHERE id_escola = '$r' ";

                    $results = mysqli_query($_SG['link'], $sql);
                    $escolaaaaa = mysqli_fetch_assoc($results);

                    $sqll = "SELECT *
                    FROM alunos 
                    JOIN usuario ON alunos.id_usuario = usuario.id_usuario 
                    WHERE alunos.id_escola = (SELECT id_escola FROM escola WHERE id_escola = '$r')";
                    $resultt = mysqli_query($_SG['link'], $sqll);
        
                    $queryyy = "SELECT id_escola, logradouro, bairro, cidade, cep, estado, email_esc, tel_fixo_esc, cel_esc, nome_diretor, email_dir, tel_fixo_dir, cel_dir, nome_vdir, email_vdir, tel_fixo_vdir, cel_vdir, nome_cp, email_cp, tel_fixo_cp, cel_cp, nome_cl, email_cl, tel_fixo_cl, cel_cl, nome_ej, email_ej, tel_fixo_ej, cel_ej FROM escola WHERE id_escola = '$r' ";
        
                    $resulttt = mysqli_query($_SG['link'], $queryyy);
                    $escolaa = mysqli_fetch_assoc($resulttt);
                ?>

             

    <div class="col-md-12">Número de alunos ativos<b></b> <?php $escolaa['num_alunos'] ?></div><br>

	<div class="col-md-12">

	<table class="table table-hover table-bordered">

		<thead>
			<th class="">Nome</th>
			<th class="">RA</th>
			<th class="">Série</th>
			<th class="">Escola</th>
			<th class="">Cidade</th>
			<th class="">Status</th>		
			<th class="">Ingresso</th>		
		</thead>

		<tbody>
            <?php


            $sqll = "SELECT *
            FROM alunos 
            JOIN escola ON escola.id_escola = alunos.id_escola
            JOIN usuario ON alunos.id_usuario = usuario.id_usuario 
            WHERE alunos.id_escola = (SELECT id_escola FROM escola WHERE id_escola = '$r')
            AND usuario.h = 1;";
            $resultt = mysqli_query($_SG['link'], $sqll);

            $queryyy = "SELECT id_escola, logradouro, bairro, cidade, cep, estado, email_esc, tel_fixo_esc, cel_esc, nome_diretor, email_dir, tel_fixo_dir, cel_dir, nome_vdir, email_vdir, tel_fixo_vdir, cel_vdir, nome_cp, email_cp, tel_fixo_cp, cel_cp, nome_cl, email_cl, tel_fixo_cl, cel_cl, nome_ej, email_ej, tel_fixo_ej, cel_ej FROM escola WHERE id_escola = '$r' ";

            $resulttt = mysqli_query($_SG['link'], $queryyy);
            $escolaa = mysqli_fetch_assoc($resulttt);


   while($row = mysqli_fetch_assoc($resultt)):

    $partes_nome = explode(" ", $row['nome']);

    $nome_email = $partes_nome[0] . "." . $partes_nome[count($partes_nome)-1];

    $nome_email = strtolower($nome_email);

    if($row['email'] == '')
        $row['email'] = $nome_email . "@futurocientista.net";

switch ($row['serie']) {
    case '5EF':
        $txt_serie = "5º Ano Ensino Fundamental";
    break;

    case '6EF':
        $txt_serie = "6º Ano Ensino Fundamental";
    break;

    case '7EF':
        $txt_serie = "7º Ano Ensino Fundamental";
    break;

    case '8EF':
        $txt_serie = "8º Ano Ensino Fundamental";
    break;

    case '9EF':
        $txt_serie = "9º Ano Ensino Fundamental";
    break;

    case '1EM':
        $txt_serie = "1º Ano Ensino Médio";
    break;
    
    case '2EM':
        $txt_serie = "2º Ano Ensino Médio";
    break;
    
    case '3EM':
        $txt_serie = "3º Ano Ensino Médio";
    break;
    
    default:
        $txt_serie = "";
    break;
}
switch ($row['h']) {
    case '1':
        $ativo = "ATIVO";
    break;

    case '0':
        $ativo = "INATIVO";
    break;

    default:
    $ativo = "";
     break;
}

echo '<tr>';
echo '<td class="text-uppercase">
    '.$row['nome'].'
</td>';

echo '<td>
    '.$row['ra'].'
</td>';

echo '<td>
    '.$txt_serie.'
</td>';

echo '<td>
    '.$row['nome_escola'].'
</td>';

echo '<td class="text-uppercase">
    '.$escolaa['cidade'].'
</td>';

echo '<td>
    '.$ativo.'
</td>';

echo '<td>
    '.$row['data_ingresso'].'
</td>';

echo '</tr>';
endwhile;
    echo '</tbody>

</table>';

echo '<div class="row"><div class="col-md-12" align="center"><br><br><button id="btn-print" onclick="imprimir()" class="btn btn-default"><i class="fa fa-print"></i> IMPRIMIR</button></div></div>';
?>

</div>

<?php ?>
         
              <?php elseif($p == 'lista'): 
                    $sql = "SELECT id_escola, logradouro, bairro, cidade, cep, estado, email_esc, tel_fixo_esc, cel_esc, nome_diretor, email_dir, tel_fixo_dir, cel_dir, nome_vdir, email_vdir, tel_fixo_vdir, cel_vdir, nome_cp, email_cp, tel_fixo_cp, cel_cp, nome_cl, email_cl, tel_fixo_cl, cel_cl, nome_ej, email_ej, tel_fixo_ej, cel_ej FROM escola WHERE id_escola = '$r' ";

                    $results = mysqli_query($_SG['link'], $sql);
                    $escolaaaaa = mysqli_fetch_assoc($results);

                    $sqll = "SELECT *
                    FROM alunos 
                    JOIN usuario ON alunos.id_usuario = usuario.id_usuario 
                    WHERE alunos.id_escola = (SELECT id_escola FROM escola WHERE id_escola = '$r')";
                    $resultt = mysqli_query($_SG['link'], $sqll);
        
                    $queryyy = "SELECT id_escola, logradouro, bairro, cidade, cep, estado, email_esc, tel_fixo_esc, cel_esc, nome_diretor, email_dir, tel_fixo_dir, cel_dir, nome_vdir, email_vdir, tel_fixo_vdir, cel_vdir, nome_cp, email_cp, tel_fixo_cp, cel_cp, nome_cl, email_cl, tel_fixo_cl, cel_cl, nome_ej, email_ej, tel_fixo_ej, cel_ej FROM escola WHERE id_escola = '$r' ";
        
                    $resulttt = mysqli_query($_SG['link'], $queryyy);
                    $escolaa = mysqli_fetch_assoc($resulttt);
                ?>

             

    <div class="col-md-12">Número de alunos ativos<b></b> <?php $escolaa['num_alunos'] ?></div><br>

	<div class="col-md-12">

	<table class="table table-hover table-bordered">

		<thead>
			<th class="">Nome</th>
			<th class="">RA</th>
			<th class="">Série</th>
			<th class="">Escola</th>
			<th class="">Cidade</th>
			<th class="">Status</th>		
			<th class="">Ingresso</th>		
		</thead>

		<tbody>
            <?php


            $sqll = "SELECT *
            FROM alunos 
            JOIN escola ON escola.id_escola = alunos.id_escola
            JOIN usuario ON alunos.id_usuario = usuario.id_usuario 
            WHERE alunos.id_escola = (SELECT id_escola FROM escola WHERE id_escola = '$r')";
            $resultt = mysqli_query($_SG['link'], $sqll);

            $queryyy = "SELECT id_escola, logradouro, bairro, cidade, cep, estado, email_esc, tel_fixo_esc, cel_esc, nome_diretor, email_dir, tel_fixo_dir, cel_dir, nome_vdir, email_vdir, tel_fixo_vdir, cel_vdir, nome_cp, email_cp, tel_fixo_cp, cel_cp, nome_cl, email_cl, tel_fixo_cl, cel_cl, nome_ej, email_ej, tel_fixo_ej, cel_ej FROM escola WHERE id_escola = '$r' ";

            $resulttt = mysqli_query($_SG['link'], $queryyy);
            $escolaa = mysqli_fetch_assoc($resulttt);


   while($row = mysqli_fetch_assoc($resultt)):

    $partes_nome = explode(" ", $row['nome']);

    $nome_email = $partes_nome[0] . "." . $partes_nome[count($partes_nome)-1];

    $nome_email = strtolower($nome_email);

    if($row['email'] == '')
        $row['email'] = $nome_email . "@futurocientista.net";

switch ($row['serie']) {
    case '5EF':
        $txt_serie = "5º Ano Ensino Fundamental";
    break;

    case '6EF':
        $txt_serie = "6º Ano Ensino Fundamental";
    break;

    case '7EF':
        $txt_serie = "7º Ano Ensino Fundamental";
    break;

    case '8EF':
        $txt_serie = "8º Ano Ensino Fundamental";
    break;

    case '9EF':
        $txt_serie = "9º Ano Ensino Fundamental";
    break;

    case '1EM':
        $txt_serie = "1º Ano Ensino Médio";
    break;
    
    case '2EM':
        $txt_serie = "2º Ano Ensino Médio";
    break;
    
    case '3EM':
        $txt_serie = "3º Ano Ensino Médio";
    break;
    
    default:
        $txt_serie = "";
    break;
}

switch ($row['h']) {
    case '1':
        $ativo = "ATIVO";
    break;

    case '0':
        $ativo = "INATIVO";
    break;

    default:
    $ativo = "";
     break;
}

echo '<tr>';
echo '<td class="text-uppercase">
    '.$row['nome'].'
</td>';

echo '<td>
    '.$row['ra'].'
</td>';

echo '<td>
    '.$txt_serie.'
</td>';

echo '<td>
    '.$row['nome_escola'].'
</td>';

echo '<td class="text-uppercase">
    '.$escolaa['cidade'].'
</td>';

echo '<td>
    '.$ativo.'
</td>';

echo '<td>
    '.$row['data_ingresso'].'
</td>';

echo '</tr>';
endwhile;
    echo '</tbody>

</table>';

echo '<div class="row"><div class="col-md-12" align="center"><br><br><button id="btn-print" onclick="imprimir()" class="btn btn-default"><i class="fa fa-print"></i> IMPRIMIR</button></div></div>';
?>

</div>

<?php ?>


                <?php elseif($p == 'ver'): 
                    $query = "SELECT id_escola, logradouro, bairro, cidade, cep, estado, email_esc, tel_fixo_esc, cel_esc, nome_diretor, email_dir, tel_fixo_dir, cel_dir, nome_vdir, email_vdir, tel_fixo_vdir, cel_vdir, nome_cp, email_cp, tel_fixo_cp, cel_cp, nome_cl, email_cl, tel_fixo_cl, cel_cl, nome_ej, email_ej, tel_fixo_ej, cel_ej FROM escola WHERE id_escola = '$r' ";

                    $result = mysqli_query($_SG['link'], $query);
                    $escola = mysqli_fetch_assoc($result);

                ?>


                <div class="container-fluid">
                    
                    <h2 class="text-center <?php if($escola['ativo'] == 1) echo "text-success"; else if($escola['ativo'] == 0) echo "text-danger"; ?>"><?php echo $escola['nome_escola'] ?></h2>
<br>

                

                    <div class="equipeTexto">
                        <h3 class="text-left">Dados da Escola</h3>
                        <hr>
                        <p><strong>Supervisor: </strong><?php echo $escola['supervisor']?></p>
                        <p><strong>Logradouro: </strong><?php echo $escola['logradouro']?></p>
                        <p><strong>Bairro: </strong><?php echo $escola['bairro']?></p>
                        <p><strong>Cidade: </strong><?php echo $escola['cidade']?></p>
                        <p><strong>CEP: </strong><?php echo $escola['cep']?></p>
                        <p><strong>Estado: </strong><?php echo $escola['estado']?></p>
                        <p><strong>E-mail:</strong><?php echo $escola['email_esc']?></p>
                        <p><strong>Telefone fixo: </strong><?php echo $escola['tel_fixo_esc']?></p>
                        <p><strong>Celular: </strong><?php echo $escola['cel_esc']?></p>

                        <br><br><h3 class="text-left">Dados do Diretor(a)</h3>
                        <hr>

                        <p><strong>Nome: </strong><?php echo $escola['nome_diretor']?></p>
                        <p><strong>E-mail:</strong><?php echo $escola['email_dir']?></p>
                        <p><strong>Telefone fixo: </strong><?php echo $escola['tel_fixo_dir']?></p>
                        <p><strong>Celular: </strong><?php echo $escola['cel_dir']?></p>
                        
                        <br><br><h3 class="text-left">Dados do Vice Diretor(a)</h3>
                        <hr>

                        <p><strong>Nome: </strong><?php echo $escola['nome_vdir']?></p>
                        <p><strong>E-mail:</strong><?php echo $escola['email_vdir']?></p>
                        <p><strong>Telefone fixo: </strong><?php echo $escola['tel_fixo_vdir']?></p>
                        <p><strong>Celular: </strong><?php echo $escola['cel_vdir']?></p>

                        <br><br><h3 class="text-left">Dados do Coordenador Pedagógico</h3>
                        <hr>

                        <p><strong>Nome: </strong><?php echo $escola['nome_cp']?></p>
                        <p><strong>E-mail:</strong><?php echo $escola['email_cp']?></p>
                        <p><strong>Telefone fixo: </strong><?php echo $escola['tel_fixo_cp']?></p>
                        <p><strong>Celular: </strong><?php echo $escola['cel_cp']?></p>

                        <br><br><h3 class="text-left">Dados do Coordenador Local</h3>
                        <hr>

                        <p><strong>Nome: </strong><?php echo $escola['nome_cl']?></p>
                        <p><strong>E-mail:</strong><?php echo $escola['email_cl']?></p>
                        <p><strong>Telefone fixo: </strong><?php echo $escola['tel_fixo_cl']?></p>
                        <p><strong>Celular: </strong><?php echo $escola['cel_cl']?></p>

                        <br><br><h3 class="text-left">Dados do Embaixador Júnior</h3>
                        <hr>

                        <p><strong>Nome: </strong><?php echo $escola['nome_ej']?></p>
                        <p><strong>E-mail:</strong><?php echo $escola['email_ej']?></p>
                        <p><strong>Telefone fixo: </strong><?php echo $escola['tel_fixo_ej']?></p>
                        <p><strong>Celular: </strong><?php echo $escola['cel_ej']?></p>

                    </div>

                </div>



                <?php endif; ?>

            </div>
        </div>

    </div>

    <?php include '../../footer.php'; ?>
<script type="text/javascript">
            
            $('#buscaNome_escola').keyup(function() {
                
                var data = $(".alunoCadastro").serialize();
                $.ajax({
                    url: '<?php echo $root_html ?>sistema/nucleos/buscar/busca.php',
                    type: 'POST',
                    data: data,
                    success: function (data) {
                        $('#resultado').html(data);
                    },
                    error: function (e) {
                        $('#resultado').html("<option>Nenhum resultado encontrado.</option>");

                    }
                });

            });

            $('#buscaCidade, #ano, #anoE, #notas, #notasex, .radio input, #categoria').change(function () {
                
                var data = $(".alunoCadastro").serialize();
                $.ajax({
                    url: '<?php echo $root_html ?>sistema/nucleos/buscar/busca.php',
                    type: 'POST',
                    data: data,
                    success: function (data) {
                        $('#resultado').html(data);
                    },
                    error: function (e) {
                        $('#resultado').html("<option>Nenhum resultado encontrado.</option>");

                    }
                });

            });

            $('#enviarForm').click(function () {

                tinyMCE.triggerSave();

                var data = $(".vestibularEditar").serialize();

                $.ajax({
                    url: '<?php echo $root_html?>sistema/nucleos/buscar/editar.php',
                    type: 'POST',
                    data: data,
                    complete: function() {
                        setTimeout(function(){ location.href = '../';}, 500);
                    },
                    success: function (data) {
                        $('.alerta').hide().show();
                        $('#alerta_conteudo').html(data);

                        setTimeout(function(){ $('.alerta').fadeOut(500).removeClass('alert-success', 500);}, 4000);
                    },
                    error: function (e) {
                        $('.alerta').hide().show().addClass('alert-danger');
                        $('#alerta_conteudo').html("<span class='glyphicon glyphicon-remove'></span>&ensp;Nenhum resultado encontrado");

                        setTimeout(function(){ $('.alerta').fadeOut(500).removeClass('alert-danger', 500);}, 4000);
                    }
                });

            });

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


            tinymce.init({
              selector: 'textarea',
              height: 100,
              menubar: false,
              placeholder: true,
              plugins: [
                'advlist autolink lists link image charmap print preview anchor',
                'searchreplace visualblocks code fullscreen',
                'insertdatetime media table contextmenu paste code'
              ],
              toolbar: 'undo redo | insert | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
              content_css: [
                '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
                '//www.tinymce.com/css/codepen.min.css']
            });

            
           /* $('#telefone').mask('(00) 0000-0000');
            $('#celular').mask('(00) 00000-0000');*/
            $('#data-inscricao-inicio').mask('00/00/0000');
            $('#data-inscricao-final').mask('00/00/0000');
            /*$('#tel_fixo').mask('(00) 0000-0000');*/
            $('#cep').mask('00000-000');

            $('#tel_fixo_esc').mask('(00) 0000-0000');
            $('#tel_fixo_dir').mask('(00) 0000-0000');
            $('#tel_fixo_vdir').mask('(00) 0000-0000');
            $('#tel_fixo_cp').mask('(00) 0000-0000');
            $('#tel_fixo_cl').mask('(00) 0000-0000');
            $('#tel_fixo_ej').mask('(00) 0000-0000');

            $('#cel_esc').mask('(00) 00000-0000');
            $('#cel_dir').mask('(00) 00000-0000');
            $('#cel_vdir').mask('(00) 00000-0000');
            $('#cel_cp').mask('(00) 00000-0000');
            $('#cel_cl').mask('(00) 00000-0000');
            $('#cel_ej').mask('(00) 00000-0000');


            function imprimir(){
		$('#btn-print').hide();
		window.print();
		setTimeout(function(){
			$('#btn-print').show();
		}, 1000);
	}


</script>

</body>
</html>