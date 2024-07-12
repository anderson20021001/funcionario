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
            if (data.trim() === 'success') {
                // smartAlert("Sucesso", "Operação realizada com sucesso!", "success");
            } else {
                smartAlert("Atenção", "CPF do Dependente inválido!!!", "error");
                document.getElementById('cpfDependente').value = "";
                return false;
            }
        }, error: function (xhr, er) {
            console.log(xhr, er);
        }
    });
}

function verificaCpf(cpf) {
    $.ajax({
        url: 'js/sqlscopeFuncionarioCadastro.php',
        type: 'post',
        dataType: "html",
        data: { funcao: "verificaCpf", cpf: cpf },
        success: function (data, textStatus) {
            if (data.trim() === 'success') {
                // smartAlert("Sucesso", "Operação realizada com sucesso!", "success");
            } else {
                smartAlert("Atenção", "CPF do Funcionário inválido!!!", "error");
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
    $.ajax({
        url: 'js/sqlscopeFuncionarioCadastro.php', //caminho do arquivo a ser executado
        dataType: 'html', //tipo do retorno
        type: 'post', //metodo de envio
        data: { funcao: 'recupera', id: id }, //valores enviados ao script     
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
                var jsonDependente = piece[10];
                var cep = piece[11];
                var logradouro = piece[12];
                var complemento = piece[13];
                var numero = piece[14];
                var uf = piece[15];
                var bairro = piece[16];
                var cidade = piece[17];
                var emprego = piece[18];
                var pis = piece[19];

                $("#codigo").val(codigo);
                $("#ativo").val(ativo);
                $("#nome").val(nome);
                $("#cpf").val(cpf);
                $("#rg").val(rg);
                $("#dataNascimento").val(dataNascimento);
                defineIdade();
                $("#genero").val(genero);
                $("#estadoCivil").val(estadoCivil);
                $("#jsonTelefone").val(jsonTelefone);
                $("#jsonEmail").val(jsonEmail);
                $("#jsonDependente").val(jsonDependente);
                $("#cep").val(cep);
                $("#logradouro").val(logradouro);
                $("#complemento").val(complemento);
                $("#numero").val(numero);
                $("#uf").val(uf);
                $("#bairro").val(bairro);
                $("#cidade").val(cidade);
                $("#emprego").val(emprego);
                $("#pis").val(pis);

                if (ativo === 1) {
                    $('#ativo').prop('checked', true);
                } else {
                    $('#ativo').prop('checked', false);
                }

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
