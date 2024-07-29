function gravaUsuario(codigo, ativo, nome, cpf, rg, dataNascimento, genero, estadoCivil, jsonTelefoneArray, jsonEmailArray, jsonDependenteArray, cep, logradouro, complemento, numero, uf, bairro, cidade, emprego, pis) {
    $.ajax({
        url: 'js/sqlscopeFuncionarioCadastro.php',
        dataType: 'html', //tipo do retorno
        type: 'post', //metodo de envio
        data: {
            funcao: "grava", codigo: codigo, ativo: ativo, nome: nome, cpf: cpf, rg: rg, dataNascimento: dataNascimento, genero: genero, estadoCivil: estadoCivil, jsonTelefoneArray: jsonTelefoneArray, jsonEmailArray: jsonEmailArray, jsonDependenteArray: jsonDependenteArray,
            cep: cep, logradouro: logradouro, complemento: complemento, numero: numero, uf: uf, bairro: bairro, cidade: cidade, emprego: emprego, pis: pis
        }, //valores enviados ao script     
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
                    smartAlert("Atenção", "Operação não realizada - entre em contato com o suporte!", "error");
                }

                return '';
            } else {
                smartAlert("Sucesso", "Operação realizada com sucesso!", "success");
                setInterval(function () { voltar() }, 1500);
            }
            //retorno dos dados
        },
        error: function (xhr, er) {
            //tratamento de erro
        }
    });
    return '';

}
// function verificaCpf(cpf) {
//     $.ajax({
//         url: 'js/sqlscopeFuncionarioCadastro.php', //caminho do arquivo a ser executado
//         dataType: 'html', //tipo do retorno
//         type: 'post', //metodo de envio
//         data: { funcao: 'verificaCpf', cpf: cpf }, //valores enviados ao script     
//         beforeSend: function () {
//             //função chamada antes de realizar o ajax
//         },
//         complete: function () {
//             //função executada depois de terminar o ajax
//         },
//         success: function (data, textStatus) {
//             var piece = data.split("#");
//             var mensagem = piece[1];
//             if (data.indexOf('failed') > -1) {
//                 var piece = data.split("#");
//                 var mensagem = piece[1];

//                 if (mensagem !== "") {
//                     smartAlert("Atenção", mensagem, "error");
//                 } else {
//                     smartAlert("Atenção", "Operação não realizada - entre em contato com a GIR!", "error");
//                 }

//             } else {
//                 smartAlert("Sucesso", "CPF VÁLIDO", "success");

//             }
//         },
//         error: function (xhr, er) {
//             //tratamento de erro
//         }
//     });
// }


function validaCPFDependente(cpf) {
    $.ajax({
        url: 'js/sqlscopeFuncionarioCadastro.php',
        type: 'post',
        dataType: "html",
        data: { funcao: "validaCPFDependente", cpf: cpf },
        success: function (data, textStatus) {
            var piece = data.split("#");
            var mensagem = piece[1];
            if (data.trim() === 'success') {
                // smartAlert("Sucesso", "Operação realizada com sucesso!", "success");
            } else {
                smartAlert("Atenção", mensagem , "error");
                document.getElementById('cpfDependente').value = "";
                return false;
            }
        }, error: function (xhr, er) {
            console.log(xhr, er);
        }
    });
}

function verificaCpf(ativo, cpf) {
    $.ajax({
        url: 'js/sqlscopeFuncionarioCadastro.php',
        type: 'post',
        dataType: "html",
        data: { funcao: "verificaCpf", cpf: cpf, ativo:ativo },
        
        success: function (data, textStatus) {
            var piece = data.split("#");
            var mensagem = piece[1];
            if (data.trim() === 'success') {
                // smartAlert("Sucesso", "Operação realizada com sucesso!", "success");
            } else {
                smartAlert("Atenção", mensagem, "error");
                document.getElementById('cpf').value = "";
                return false;
            }
        }, error: function (xhr, er) {
            console.log(xhr, er);
        }
    });
}

function verificaRG(rg) {
    $.ajax({
        url: 'js/sqlscopeFuncionarioCadastro.php', //caminho do arquivo a ser executado
        dataType: 'html', //tipo do retorno
        type: 'post', //metodo de envio
        data: { funcao: 'verificaRG', rg: rg }, //valores enviados ao script     
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
                    $("#rg").val("");
                } else {
                    smartAlert("Atenção", "Operação não realizada - entre em contato com a GIR!", "error");
                }

            } else {
                

            }
        },
        error: function (xhr, er) {
            //tratamento de erro
        }
    });
}

function recuperaUsuario(id) {
    $.ajax({
        url: 'js/sqlscopeFuncionarioCadastro.php', //caminho do arquivo a ser executado
        dataType: 'html', //tipo do retorno
        type: 'post', //metodo de envio
        data: { funcao: 'recupera', id: id }, //valores enviados ao script     
     
        success: (result)=> {     

                let {status, data} = JSON.parse(result)
                if(status == 'failed'){
                    smartAlert('Atenção', "Operação não realizada", 'error');
                    return
                }
                if(status == 'success'){
                    $("#codigo").val(data.codigo);
                    $("#ativo").val(data.ativo);
                    $("#nome").val(data.nome);
                    $("#cpf").val(data.cpf);
                    $("#rg").val(data.rg);
                    $("#dataNascimento").val(data.dataNascimento);
                    defineIdade();
                    $("#genero").val(data.genero);
                    $("#estadoCivil").val(data.estadoCivil);
                    $("#jsonTelefone").val(data.jsonTelefone);
                    $("#jsonEmail").val(data.jsonEmail);
                    $("#jsonDependente").val(data.jsonDependente);
                    $("#cep").val(cep);
                    $("#logradouro").val(data.logradouro);
                    $("#complemento").val(data.complemento);
                    $("#numero").val(data.numero);
                    $("#uf").val(data.uf);
                    $("#bairro").val(data.bairro);
                    $("#cidade").val(data.cidade);
                    $("#emprego").val(data.emprego);
                    $("#pis").val(data.pis);
    
                    if (ativo === 1) {
                        $('#ativo').prop('checked', true);
                    } else {
                        $('#ativo').prop('checked', false);
                    }
    
                    if(emprego == "1"){
                        $("#pis").addClass("readonly").attr("disabled", true).val("");
                    }
                    $("#btnGerar").removeClass("hidden");
                    $("#btnExcluir").removeClass("hidden");
                    btnExcluir
                    jsonTelefoneArray = JSON.parse($("#jsonTelefone").val());
                    jsonEmailArray = JSON.parse($("#jsonEmail").val());
                    jsonDependenteArray = JSON.parse($("#jsonDependente").val());
                    fillTableTelefone();
                    fillTableEmail();
                    fillTableDependente();
                    validaDataInversa();
    
                    return;

                }

             
            


        },
        error: function (xhr, er) {
            //tratamento de erro
        }
    });

    return;
}
function validaDataInversa(dataNascimento) {
    $.ajax({
        url: 'js/sqlscopeFuncionarioCadastro.php', //caminho do arquivo a ser executado
        dataType: 'html', //tipo do retorno
        type: 'post', //metodo de envio
        data: { funcao: 'validaDataInversa', dataNascimento: dataNascimento }, //valores enviados ao script     
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

function excluirUsuario(id) {
    $.ajax({
        url: 'js/sqlscopeFuncionarioCadastro.php', //caminho do arquivo a ser executado
        dataType: 'html', //tipo do retorno
        type: 'post', //metodo de envio
        data: { funcao: 'excluir', id: id }, //valores enviados ao script     
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
                setInterval(function () { voltar() }, 1500);;
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
        data: { funcao: 'recuperarDadosUsuario' }, //valores enviados ao script

        success: function (data) {
            callback(data)
        },
    })

    return
}


function gravaNovaSenha(senha, senhaConfirma, callback) {
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
