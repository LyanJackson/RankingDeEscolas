<?php include '../../../web/seguranca.php';

$title = "AdminPFC - Núcleos";
protegePaginaUnica(901, 3);

$escola1 = mysqli_query($_SG['link'], "SELECT DISTINCT cidade FROM escola");


include '../../head.php';
?>
<body class="hold-transition skin-black sidebar-mini fixed">

	<div class="wrapper">

	<?php include '../../menu.php'; ?>
		<div class="content-wrapper">
            <section class="content-header">
                <a href="<?php echo $root_html ?>sistema/" class="btn btn-default"><i class="fa fa-arrow-left"></i>&ensp;Voltar</a>                
              <ol class="breadcrumb">
                <li><a href="<?php echo $root_html ?>sistema/"><i class="fa fa-dashboard"></i> Home</a></li>
                <li>Núcleos</li>
                <li class="active">Cadastrar</li>
              </ol> 
            </section>
<br><br>

        	<div class="container-fluid" style="width: 80%;">
				
				<form id="forms-cadastro" enctype="multipart/form-data" method="POST" action="cadastrar.php" class="alunoCadastro forms-cadastrar">

					<h1 class="text-center">Ficha de Cadastro <br><small>Escola</small></h1>
					<hr>

					<p class="help-block"><span style="color: red;">ATENÇÃO:</span> Campo marcado com "<span style="color: red;">*</span>" é <u>OBRIGATÓRIO</u> preencher.</p>
					
					<hr><br>

					<div class="row">
						
						<div class="col-md-6 form-group">
							<label for="nome_escola">Nome da Escola <span style="color: red;">*</span></label>
							<input id="nome_escola" type="text" name="nome_escola" class="form-control" placeholder="Digite o nome da escola" required>
						</div>
						
						<div class="col-md-6 form-group">
							<label for="categoria">Categoria <span style="color: red;">*</span></label>
							<select name="categoria" id="categoria" class="form-control" required>
								<option value="0">Ensino Fundamental</option>
								<option value="1">Ensino Médio</option>
								<option value="2">Âmbos</option>
							</select>
						</div>

						
					</div>
                    <div class="form-group">
                        <label for="cidade">Cidade <span style="color: red;">*</span></label>
                                                  
                       <?php if($_SESSION['h'] == 3): ?> 
                            <input type="text" class="form-control" name="cidade" id="cidade" value="<?php echo $_SESSION['supervisorCidade'] ?>" readonly>
                        <?php else: ?>
                            <input type="text" class="form-control" name="cidade" id="cidade" placeholder="Digite o nome da cidade">
                        	<p class="help-block">Escreva <u>corretamente</u> o nome da cidade.</p>
                        <?php endif; ?> 
						
                    </div>

                    <div class="form-group">
						<label for="logradouro">Logradouro <span style="color: red;">*</span></label>
						<input type="text" name="logradouro" id="logradouro" class="form-control" placeholder="Digite o endereço da escola" required>
					</div>

					<div class="form-group">
						<label for="bairro">Bairro <span style="color: red;">*</span></label>
						<input type="text" name="bairro" id="bairro" class="form-control" placeholder="Digite o nome do bairro onde a escola fica" required>
					</div>

					<div class="form-group">
						<label for="cep">CEP <span style="color: red;">*</span></label>
						<input type="text" name="cep" id="cep" class="form-control" placeholder="Digite o CEP da escola" required>
					</div>	

					<div class="form-group">
						<label for="estado">Estado <span style="color: red;">*</span></label>
						<input type="text" name="estado" id="estado" class="form-control" placeholder="Digite as siglas do estado. Exemplo: SP, RJ..." required>
					</div>

									
<!--
					<div class="form-group">
						<label for="nome_diretor">Nome do Diretor</label>
						<input type="text" name="nome_diretor" id="nome_diretor" class="form-control" placeholder="Nome completo do diretor ou diretora">
					</div>-->

					<div class="form-group">
						<label for="email_esc">E-mail <span style="color: red;">*</span></label>
						<input type="text" name="email_esc" id="email_esc" class="form-control" placeholder="Digite o e-mail da Escola" required>
					</div>
					
					<div class="form-group">
						<label for="tel_fixo_esc">Telefone fixo <span style="color: red;">*</span></label>
						<input type="text" name="tel_fixo_esc" id="tel_fixo_esc" class="form-control" placeholder="Telefone fixo da escola para contato" required>
					</div>

					<div class="form-group">
						<label for="cel_esc">Celular</label>
						<input type="text" name="cel_esc" id="cel_esc" class="form-control" placeholder="Celular da escola para contato">
					</div>
                   <h1 class="text-center"> <small>Diretor(a)</small></h1>
                    <hr><br>

                    <div class="form-group">
						<label for="nome_diretor">Nome do Diretor(a) <span style="color: red;">*</span></label>
						<input type="text" name="nome_diretor" id="nome_diretor" class="form-control" placeholder="Nome completo do Diretor(a)" required>
					</div>
                    
                    <div class="form-group">
						<label for="email_dir">E-mail do Diretor(a) <span style="color: red;">*</span></label>
						<input type="text" name="email_dir" id="email_dir" class="form-control" placeholder="Digite o e-mail do Diretor(a)" required>
					</div>

					<div class="form-group">
						<label for="tel_fixo_dir">Telefone fixo do Diretor(a)</label>
						<input type="text" name="tel_fixo_dir" id="tel_fixo_dir" class="form-control" placeholder="Telefone fixo do Diretor(a)">
					</div>
					<div class="form-group">
						<label for="cel_dir">Celular do Diretor(a) <span style="color: red;">*</span></label>
						<input type="text" name="cel_dir" id="cel_dir" class="form-control" placeholder="Celular do Diretor(a)" required>
					</div>

					<hr>

					<p class="help-block"><span style="color: red;">ATENÇÃO:</span> Caso a escola não possuir um <u>VICE DIRETOR</u> preencher com as informações do Diretor.</p>
					
					<hr>
                     
                    
                    <h1 class="text-center"> <small>Vice Diretor(a)</small></h1>
                    <hr><br>

                    <div class="form-group">
						<label for="nome_vdir">Nome do Vice Diretor(a) <span style="color: red;">*</span></label>
						<input type="text" name="nome_vdir" id="nome_vdir" class="form-control" placeholder="Nome completo do Vice Diretor(a)" required>
					</div>
                    
                    <div class="form-group">
						<label for="email_vdir">E-mail do Vice Diretor(a) <span style="color: red;">*</span></label>
						<input type="text" name="email_vdir" id="email_vdir" class="form-control" placeholder="Digite o e-mail do Vice Diretor(a)" required>
					</div>

					<div class="form-group">
						<label for="tel_fixo_vdir">Telefone fixo do Vice Diretor(a)</label>
						<input type="text" name="tel_fixo_vdir" id="tel_fixo_vdir" class="form-control" placeholder="Telefone fixo do Vice Diretor(a)">
					</div>
					<div class="form-group">
						<label for="cel_vdir">Celular do Vice Diretor(a) <span style="color: red;">*</span></label>
						<input type="text" name="cel_vdir" id="cel_vdir" class="form-control" placeholder="Celular do Vice Diretor(a)" required>
					</div>

                    <hr>

					<p class="help-block"><span style="color: red;">ATENÇÃO:</span> No caso do <u>COORDENADOR PEDAGÓGICO E COORDENADOR LOCAL</u> ser o mesmo, preencher o campo dos dois cargo com as mesmas informações.</p>
					
					<hr>

                    <h1 class="text-center"> <small>Coordenador Pedagógico</small></h1>
                    <hr><br>

                    <div class="form-group">
						<label for="nome_cp">Nome do Coordenador Pedagógico <span style="color: red;">*</span></label>
						<input type="text" name="nome_cp" id="nome_cp" class="form-control" placeholder="Nome completo do Coordenador Pedagógico" required>
					</div>
                    
                    <div class="form-group">
						<label for="email_cp">E-mail do Coordenador Pedagógico <span style="color: red;">*</span></label>
						<input type="text" name="email_cp" id="email_cp" class="form-control" placeholder="Digite o e-mail do Coordenador Pedagógico" required>
					</div>

					<div class="form-group">
						<label for="tel_fixo_cp">Telefone fixo do Coordenador Pedagógico</label>
						<input type="text" name="tel_fixo_cp" id="tel_fixo_cp" class="form-control" placeholder="Telefone fixo do Coordenador Pedagógico">
					</div>
					<div class="form-group">
						<label for="cel_cp">Celular do Coordenador Pedagógico <span style="color: red;">*</span></label>
						<input type="text" name="cel_cp" id="cel_cp" class="form-control" placeholder="Celular do Coordenador Pedagógico" required>
					</div>
                    <h1 class="text-center"> <small>Coordenador Local</small></h1>
                    <hr><br>

                    <div class="form-group">
						<label for="nome_cl">Nome do Coordenador(a) Local <!-- <span style="color: red;">*</span> --></label>
						<input type="text" name="nome_cl" id="nome_cl" class="form-control" placeholder="Nome completo do Coordenador(a) Local">
					</div>
                    
                    <div class="form-group">
						<label for="email_cl">E-mail do Coordenador(a) Local <!-- <span style="color: red;">*</span> --></label>
						<input type="text" name="email_cl" id="email_cl" class="form-control" placeholder="Digite o e-mail do Coordenador(a) Local">
					</div>

					<div class="form-group">
						<label for="tel_fixo_cl">Telefone fixo do Coordenador(a) Local</label>
						<input type="text" name="tel_fixo_cl" id="tel_fixo_cl" class="form-control" placeholder="Telefone fixo do Coordenador(a) Local">
					</div>
					<div class="form-group">
						<label for="cel_cl">Celular do Coordenador(a) Local <!-- <span style="color: red;">*</span> --></label>
						<input type="text" name="cel_cl" id="cel_cl" class="form-control" placeholder="Celular do Coordenador(a) Local">
					</div>     

					<!-- <h1 class="text-center"> <small>Embaixador Júnior</small></h1>
                    <hr><br>

                    <div class="form-group">
                        <label for="nome_ej">Nome do Embaixador Júnior <span style="color: red;">*</span></label>
                        <input type="text" name="nome_ej" id="nome_ej" class="form-control" placeholder="Nome completo do Embaixador Júnior" value="<?php echo $escola['nome_ej'] ?>" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="email_ej">E-mail do Embaixador Júnior </label>
                        <input type="text" name="email_ej" id="email_ej" class="form-control" placeholder="Digite o e-mail do Embaixador Júnior" value="<?php echo $escola['email_ej'] ?>">
                    </div>

                    <div class="form-group">
                        <label for="tel_fixo_ej">Telefone fixo do Embaixador Júnior</label>
                        <input type="text" name="tel_fixo_ej" id="tel_fixo_ej" class="form-control" placeholder="Telefone fixo do Embaixador Júnior" value="<?php echo $escola['tel_fixo_ej'] ?>">
                    </div>
                    <div class="form-group">
                        <label for="cel_ej">Celular do Embaixador Júnior <span style="color: red;">*</span></label>
                        <input type="text" name="cel_ej" id="cel_ej" class="form-control" placeholder="Celular do Embaixador Júnior" value="<?php echo $escola['cel_ej'] ?>" required>
                    </div> -->     

					<br>
					<div class="text-center">
						<button id="salvarCadastro" type="submit" value="Cadastrar" class="btn btn-primary btn-lg">
							Cadastrar
						</button>	
						<input type="reset" class="btn btn-default pull-right">		
					</div>
				</form>
        	</div>
        </div>

	</div>

	<?php include '../../footer.php'; ?>

<script type="text/javascript">

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

	$('#cep').mask('00000-000');

	$('#forms-cadastro').submit(function(event){
		
		event.preventDefault();

		tinyMCE.triggerSave();

		data = $('#forms-cadastro').serialize();

        $.ajax({
            url: '<?php echo $root_html?>sistema/nucleos/cadastrar/cadastrar.php',
            type: 'POST',
            data: data,
            complete: function() {
                setTimeout(function(){ location.reload();}, 500);
            },
            success: function (data) {
                $('.alerta').show().addClass('alert-success');
                $('#alerta_conteudo').html(data);

                setTimeout(function(){ $('.alerta').fadeOut(500).removeClass('alert-success', 500);}, 4000);
            },
            error: function (e) {
                $('.alerta').show().addClass('alert-danger');
                $('#alerta_conteudo').html("<span class='glyphicon glyphicon-remove'></span>&ensp;Nenhum resultado encontrado");

                setTimeout(function(){ $('.alerta').fadeOut(500).removeClass('alert-danger', 500);}, 4000);
            }
        });
	});

</script>

</body>
</html>