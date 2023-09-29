<?php 
  session_start();
  include_once('../../conection.php');
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Abrir Chamado</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../styles/abrir_chamado/style.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg ">
        <div class="container">
            <a class="navbar-brand" href="#">
              <img src="../../assets/images/logo.png" id="logo" alt="Logo" width="30" height="30">
              
            </a>

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse justify-content-end header" id="navbarNav">
              <ul class="navbar-nav">
                <li class="nav-item">
                  <a class="nav-link linkss" href="#">Home</a>
                </li>

                <li class="nav-item dropdown linkss">
                  <a class="nav-link dropdown-toggle links" href="#" id="chamadosDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Chamados <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-down" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
                      </svg>
                  </a>

                  <div class="dropdown-menu" aria-labelledby="chamadosDropdown">
                    <a class="dropdown-item" href="./lista_chamados.php">Lista de Chamados</a>
                    <a class="dropdown-item" href="./abrir_chamado.php">Abrir Chamado</a>
                  </div>
                </li>

                <li class="nav-item dropdown ">
                  <a class="nav-link dropdown-toggle linkss" href="#" id="funcionariosDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Funcionários <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-down" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
                      </svg>
                  </a>

                  <div class="dropdown-menu" aria-labelledby="funcionariosDropdown">
                    <a class="dropdown-item" href="./lista_funcionarios.php">Lista de Funcionários</a>
                    <a class="dropdown-item" href="./cadastrar_funcionario.php">Cadastrar Funcionário</a>
                  </div>
                </li>
              </ul>
            </div>
          </nav>
        </div>
      
    <div class="container">
      <?php
        if(isset($_SESSION['msg'])){//serve para dar a mensagem de cadastrado ou não//isset = basicamente verifica a existência de uma variável
          echo $_SESSION['msg'];
          unset($_SESSION['msg']);//unset tira o valor da variavel ou finalizar
      }
      ?>
            <div class="container container-form">
                <div class="text-start">
                    <h2 class="d-flex justify-content-center align-items-center titulo">Abrir Chamado</h2>
                    <form class="cont-form" method="post" action= "../../src/api/controller/proc_chamado.php" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="assunto">Titulo do Chamado: <span id="asterisco">*</span></label>
                            <input type="text" class="form-control" id="assunto" name="titulo_chamado" required>
                        </div>
                        <div class="form-group">
                            <label for="mensagem">Assunto: <span id="asterisco">*</span></label>
                            <textarea class="form-control" id="mensagem" name="item" rows="4" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="local">Local: <span id="asterisco">*</span></label>
                            <input type="text" class="form-control" id="local" name="local" required>
                        </div>
                        <div class="form-group">
                            <label for="imagem">Upload de Imagem: </label>
                            <br>
                            <input type="file" class="form-control-file " id="imagem" name="imagem">
                        </div>
                        <div class="form-group">
                            <label for="selectOption" class="form-label">Urgência: <span id="asterisco">*</span></label>
                            <select class="form-select " style="width: 200px;" id="selectOption" name="urgencia">
                                <option value="" disabled selected>Selecione</option>
                                <option value="ALTA">Alta</option>
                                <option value="MEDIA">Média</option>
                                <option value="BAIXA">Baixa</option>
                            </select>
                        </div>
                        <div class="form-group ">
                            <label for="">Data Final: <span id="asterisco">*</span></label><br>
                            <input name="data" type="date" id="inputDate" min="<?php echo date("Y-m-d");?>">
                        </div>
                        <div class="form-group">
                            <label for="selectOption" class="form-label">Funcionario: <span id="asterisco">*</span></label>
                            <select name="funcionarios" class="form-select " style="width: 200px;" id="selectOption">
                                <option value="" disabled selected>Selecione</option>
                                <?php

                                   // Query para pegar todos os funcionarios Ativos
                                    $resultados_funcionarios = "SELECT * FROM funcionarios WHERE STATUS_FUNCIONARIO = 'ATIVO'";
                                    $query_funcionarios = mysqli_query($conn, $resultados_funcionarios);
                          
                                    while($row_funcionarios = mysqli_fetch_assoc($query_funcionarios)){
                          
                                        $funcionarios = $row_funcionarios['NOME_FUNCIONARIO'];
                                        $sobrenome = $row_funcionarios['SOBRENOME_FUNCIONARIO'];

                                        $id_funcionario = $row_funcionarios['ID_FUNCIONARIO'];
                                                    
                                        echo "<option value='$id_funcionario'>$funcionarios $sobrenome</option>";        
                                    };

                                ?>
                            </select>
                        </div>
                        <div class="d-flex justify-content-center align-items-center">
                            <button type="submit" class="btn ">Enviar</button>
                        </div>
                    </form>
                </div>
            </div>

    </div>

      <footer class="footer">
        <div>
            <img id="logo_equipe" src="../../assets/images/logo_equipe.png" alt="">
        </div> 
        <div class="container">
          <p class="d-flex justify-content-center align-items-center">© OrderTech. Todos os direitos reservados.</p>

        </div>                
      </footer>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

      
    
</body>
</html>





