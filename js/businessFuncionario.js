function gravaUsuario(id, ativo, nome, cpf,rg, dataNascimento, genero, estadoCivil, jsonTelefoneArray, jsonEmailArray) {
    $.ajax({
        url: 'js/sqlscopeFuncionarioCadastro.php',
        dataType: 'html', //tipo do retorno
        type: 'post', //metodo de envio
        data: {funcao: "grava", id:id, ativo:ativo, nome:nome, cpf:cpf, rg:rg, dataNascimento:dataNascimento, genero:genero, estadoCivil:estadoCivil, jsonTelefoneArray:jsonTelefoneArray, jsonEmailArray}, //valores enviados ao script     
        beforeSend: function () {
            //função chamada antes de realizar o ajax
        },
        complete: function () {
            //função executada depois de terminar o ajax
        },
        success: function (data, textStatus) {
            if (data.indexOf('sucess') < 0) {
                var piece = data.split("#");
                var mensagem = piece[1];
                if (mensagem !== "") {
                    smartAlert("Atenção", mensagem, "error");
                } else {
                    smartAlert("Atenção", "Operação não realizada - entre em contato com a GIR!", "error");
                }

                return '';
            } else {
                smartAlert("Sucesso", "Operação realizada com sucesso!", "success");
                setInterval(function(){voltar()}, 1500);
            }
            //retorno dos dados
        },
        error: function (xhr, er) {
            //tratamento de erro
        }
    });
    return '';

}
function verificaCpf(cpf) {
    $.ajax({
        url: 'js/sqlscopeFuncionarioCadastro.php', //caminho do arquivo a ser executado
        dataType: 'html', //tipo do retorno
        type: 'post', //metodo de envio
        data: {funcao: 'verificaCpf', cpf: cpf}, //valores enviados ao script     
        beforeSend: function () {
            //função chamada antes de realizar o ajax
        },
        complete: function () {
            //função executada depois de terminar o ajax
        },
        success: function (data, textStatus) {
            var piece = data.split("#");
        var mensagem = piece[1];
            if (data.indexOf('failed') > -1) {
                var piece = data.split("#");
                var mensagem = piece[1];

                if (mensagem !== "") {
                    smartAlert("Atenção", mensagem, "error");
                } else {
                    smartAlert("Atenção", "Operação não realizada - entre em contato com a GIR!", "error");
                }
                
            } else {
                smartAlert("Sucesso", mensagem, "success");
            
            }
        },
        error: function (xhr, er) {
            //tratamento de erro
        }
    });
}

function recuperaUsuario(id) {
    debugger
    $.ajax({
        url: 'js/sqlscopeFuncionarioCadastro.php', //caminho do arquivo a ser executado
        dataType: 'html', //tipo do retorno
        type: 'post', //metodo de envio
        data: {funcao: 'recupera', id: id}, //valores enviados ao script     
        beforeSend: function () {
            //função chamada antes de realizar o ajax
        },
        complete: function () {
            //função executada depois de terminar o ajax
        },
        success: function (data, textStatus) {
            if (data.indexOf('failed') > -1) {
                return;
            } else {
                
                data = data.replace(/failed/g, '');
                var piece = data.split("#");

                

                var mensagem = piece[0];
                var out = piece[1];
                piece = out.split("^");
                var codigo = +piece[0];
                var ativo = piece[1];
                var nome = piece[2];
                var cpf = piece[3];
                var dataNascimento = piece[4];
                var rg = piece[5];
                var genero = piece[6];
                var estadoCivil = piece[7];
                var jsonTelefone = piece[8];
                var jsonEmail = piece[9];
           
               
                $("#codigo").val(codigo);
                $("#ativo").val(ativo);
                $("#nome").val(nome);
                $("#cpf").val(cpf);
                $("#rg").val(rg);
                $("#dataNascimento").val(dataNascimento);
                calcularIdade()
                $("#genero").val(genero);
                $("#estadoCivil").val(estadoCivil);
                $("#jsonTelefone").val(jsonTelefone);
                $("#jsonEmail").val(jsonEmail);
                if (ativo === 1) {
                    $('#ativo').prop('checked', true);
                } else {
                    $('#ativo').prop('checked', false);
                }

                jsonTelefoneArray = JSON.parse($("#jsonTelefone").val());
                jsonEmailArray = JSON.parse($("#jsonEmail").val());
                fillTableTelefone();
                fillTableEmail();  
               
                return;
            }
                
                
        },
        error: function (xhr, er) {
            //tratamento de erro
        }
    });

    return;
}

function excluirUsuario(id) {
    $.ajax({
        url: 'js/sqlscopeFuncionarioCadastro.php', //caminho do arquivo a ser executado
        dataType: 'html', //tipo do retorno
        type: 'post', //metodo de envio
        data: {funcao: 'excluir', id: id}, //valores enviados ao script     
        beforeSend: function () {
            //função chamada antes de realizar o ajax
        },
        complete: function () {
            //função executada depois de terminar o ajax
        },
        success: function (data, textStatus) {
            if (data.indexOf('failed') > -1) {
                var piece = data.split("#");
                var mensagem = piece[1];

                if (mensagem !== "") {
                    smartAlert("Atenção", mensagem, "error");
                } else {
                    smartAlert("Atenção", "Operação não realizada - entre em contato com a GIR!", "error");
                }
                novo();
            } else {
                smartAlert("Sucesso", "Operação realizada com sucesso!", "success");
                novo();
            }
        },
        error: function (xhr, er) {
            //tratamento de erro
        }
    });
}

function recuperaDadosUsuario(callback) {
    $.ajax({
      url: 'js/sqlscopeUsuario.php', //caminho do arquivo a ser executado
      dataType: 'html', //tipo do retorno
      type: 'post', //metodo de envio
      data: { funcao: 'recuperarDadosUsuario'}, //valores enviados ao script
  
      success: function (data) {
        callback(data)
      },
    })
  
    return
  }


  function gravaNovaSenha(senha, senhaConfirma,callback) {
    $.ajax({
      url: 'js/sqlscopeUsuario.php',
      dataType: 'html', //tipo do retorno
      type: 'post', //metodo de envio
      data: {
        funcao: 'gravarNovaSenha',
        senha: senha,
        senhaConfirma: senhaConfirma,
      }, //valores enviados ao script
      success: function (data) {
        callback(data)
      },
    })
  }
  