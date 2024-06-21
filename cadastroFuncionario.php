<?php
//initilize the page
require_once("inc/init.php");

//require UI configuration (nav, ribbon, etc.)
require_once("inc/config.ui.php");

//colocar o tratamento de permissão sempre abaixo de require_once("inc/config.ui.php");
$condicaoAcessarOK = true;
$condicaoGravarOK = true;
$condicaoExcluirOK = true;

if ($condicaoAcessarOK == false) {
    unset($_SESSION['login']);
    header("Location:login.php");
}

$esconderBtnGravar = "";
if ($condicaoGravarOK === false) {
    $esconderBtnGravar = "none";
}

$esconderBtnExcluir = "";
if ($condicaoExcluirOK === false) {
    $esconderBtnExcluir = "none";
}

/* ---------------- PHP Custom Scripts ---------

  YOU CAN SET CONFIGURATION VARIABLES HERE BEFORE IT GOES TO NAV, RIBBON, ETC.
  E.G. $page_title = "Custom Title" */

$page_title = "Funcionário";

/* ---------------- END PHP Custom Scripts ------------- */

//include header
//you can add your custom css in $page_css array.
//Note: all css files are inside css/ folder
$page_css[] = "your_style.css";
include("inc/header.php");

//include left panel (navigation)
//follow the tree in inc/config.ui.php
$page_nav["Configuração"]["sub"]["funcionario"]["active"] = true;

include("inc/nav.php");
?>
<!-- ==========================CONTENT STARTS HERE ========================== -->
<!-- MAIN PANEL -->
<div id="main" role="main">
    <?php
    //configure ribbon (breadcrumbs) array("name"=>"url"), leave url empty if no url
    //$breadcrumbs["New Crumb"] => "http://url.com"
    $breadcrumbs["Configurações"] = "";
    $breadcrumbs["Cadastro"] = "";
    include("inc/ribbon.php");
    ?>

    <!-- MAIN CONTENT -->
    <!-- MAIN CONTENT -->
    <div id="content">
        <!-- widget grid -->
        <section id="widget-grid" class="">
            <div class="row">
                <article class="col-sm-12 col-md-12 col-lg-12 sortable-grid ui-sortable centerBox">
                    <div class="jarviswidget" id="wid-id-1" data-widget-colorbutton="false" data-widget-editbutton="false" data-widget-deletebutton="false" data-widget-sortable="false">
                        <header>
                            <span class="widget-icon"><i class="fa fa-cog"></i></span>
                            <h2>Funcionário</h2>
                        </header>
                        <div>
                            <div class="widget-body no-padding">
                                <form class="smart-form client-form" id="formUsuario">
                                    <div class="panel-group smart-accordion-default" id="accordion">
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                <h4 class="panel-title">
                                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseCadastro" class="" id="accordionCadastro">
                                                        <i class="fa fa-lg fa-angle-down pull-right"></i>
                                                        <i class="fa fa-lg fa-angle-up pull-right"></i>
                                                        Cadastro
                                                    </a>
                                                </h4>
                                            </div>
                                            <div id="collapseCadastro" class="panel-collapse collapse in">
                                                <div class="panel-body no-padding">
                                                    <fieldset>
                                                        <div class="row">
                                                            <section class="col col-1 hidden">
                                                                <label class="label">Código</label>
                                                                <label class="input">
                                                                    <input id="codigo" name="codigo" type="text" class="readonly" readonly>
                                                                </label>
                                                            </section>
                                                            <section class="col col-2 hidden">
                                                                <label class="label">&nbsp;</label>
                                                                <label id="labelAtivo" class="checkbox">
                                                                    <input checked="checked" id="ativo" name="ativo" type="checkbox" value="true"><i></i>
                                                                    Ativo
                                                                </label>
                                                            </section>
                                                        </div>
                                                        <div class="row">
                                                            <section class="col col-2">
                                                                <label class="label">Nome</label>
                                                                <label class="input"><i class="icon-prepend fa fa-user"></i>
                                                                    <input id="nome" maxlength="15" name="nome" class="required" type="text" value="">
                                                                </label>
                                                            </section>
                                                            <section class="col col-2">
                                                                <label class="label">CPF</label>
                                                                <label class="input">
                                                                    <input id="cpf" maxlength="14" name="cpf" type="text" class="required" value="" placeholder="xxx.xxx.xxx-xx">
                                                                </label>
                                                            </section>
                                                            <section class="col col-2">
                                                                <label class="label">RG</label>
                                                                <label class="input">
                                                                    <input id="rg" maxlength="12" name="rg" type="text" class="required" value="" placeholder="xx.xxx.xxx-x">
                                                                </label>
                                                            </section>
                                                            <section class="col col-2">
                                                                <label class="label" for="dataNascimento">Data de Nascimento</label>
                                                                <label class="input">
                                                                    <i class="icon-append fa fa-calendar"></i>
                                                                    <input type="text" id="dataNascimento" name="dataNascimento">
                                                                </label>
                                                            </section>
                                                            <section class="col col-1">
                                                                <label class="label" for="idade">Idade</label>
                                                                <label class="input">
                                                                    <input type="text" id="idade" name="idade" class="readonly" disabled>
                                                                </label>
                                                            </section>
                                                            <section class="col col-2 col-auto" required>
                                                                <label class="label" for="genero">Gênero</label>
                                                                <label class="select">
                                                                    <select id="genero" class="required" name="genero">
                                                                        <?php
                                                                        $reposit = new reposit();
                                                                        $sql = "SELECT codigo, descricao FROM dbo.genero";
                                                                        $result = $reposit->RunQuery($sql);
                                                                        foreach ($result as $row) {
                                                                            $codigo = +$row['codigo'];
                                                                            $descricao = $row['descricao'];
                                                                            echo '<option value=' . $codigo . '>' . $descricao . '</option>';
                                                                        }
                                                                        ?>
                                                                    </select><i></i>
                                                                </label>
                                                            </section>
                                                            <section class="col col-2 col-auto" required>
                                                                <label class="label" for="estadoCivil">Estado Civil</label>
                                                                <label class="select">
                                                                    <select id="estadoCivil" class="required" name="estadoCivil">
                                                                        <option></option>
                                                                        <?php
                                                                        $reposit = new reposit();
                                                                        $sql = "SELECT codigo, estadoCivil FROM dbo.estadoCivil";
                                                                        $result = $reposit->RunQuery($sql);
                                                                        foreach ($result as $row) {
                                                                            $codigo = +$row['codigo'];
                                                                            $estadoCivil = $row['estadoCivil'];
                                                                            echo '<option value=' . $codigo . '>' . $estadoCivil . '</option>';
                                                                        }
                                                                        ?>
                                                                    </select><i></i>
                                                                </label>
                                                            </section>
                                                        </div>
                                                    </fieldset>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Accordion para Contato -->
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                <h4 class="panel-title">
                                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseContato" class="" id="accordionContato">
                                                        <i class="fa fa-lg fa-angle-down pull-right"></i>
                                                        <i class="fa fa-lg fa-angle-up pull-right"></i>
                                                        Contato
                                                    </a>
                                                </h4>
                                            </div>
                                            <div id="collapseContato" class="panel-collapse collapse">
                                                <div class="panel-body no-padding">
                                                    <fieldset class="col col-6">
                                                        <input id="jsonTelefone" name="jsonTelefone" type="hidden" value="[]">
                                                        <div id="formTelefone" class="col-12 required">
                                                            <input id="telefoneId" name="telefoneId" type="hidden" value="">
                                                            <input id="descricaoTelefonePrincipal" name="descricaoTelefonePrincipal" type="hidden" value="">
                                                            <input id="descricaoTelefoneWhatsApp" name="descricaoTelefoneWhatsApp" type="hidden" value="">
                                                            <input id="sequencialTel" name="sequencialTel" type="hidden" value="">
                                                            <div class="row">
                                                                <section class="col col-4">
                                                                    <label class="label">Telefone</label>
                                                                    <label class="input"><i class="icon-prepend fa fa-phone"></i>
                                                                        <input id="telefone" name="telefone" class="required" type="tel" class="form-control" value="">
                                                                    </label>
                                                                </section>
                                                                <section class="col col-2">
                                                                    <label class="label">&nbsp;</label>
                                                                    <label class="checkbox">
                                                                        <input id="telefonePrincipal" name="telefonePrincipal" type="checkbox" value="true" checked="checked"><i></i>
                                                                        Principal
                                                                    </label>
                                                                </section>
                                                                <section class="col col-2">
                                                                    <label class="label">&nbsp;</label>
                                                                    <label class="checkbox">
                                                                        <input id="telefoneWhatsapp" name="telefoneWhatsapp" type="checkbox" value="true" checked="checked"><i></i>
                                                                        WhatsApp
                                                                    </label>
                                                                </section>
                                                                <section class="col col-4">
                                                                    <label class="label">&nbsp;</label>
                                                                    <button id="btnAddTelefone" type="button" class="btn btn-primary">
                                                                        <i class="fa fa-plus"></i>
                                                                    </button>
                                                                    <button id="btnExcluirTelefone" type="button" class="btn btn-danger">
                                                                        <i class="fa fa-minus"></i>
                                                                    </button>
                                                                </section>
                                                            </div>
                                                            <div class="table-responsive" style="min-height: 115px; width: 95%; border: 1px solid #ddd; margin-bottom: 13px; overflow-x: auto;">
                                                                <table id="tableTelefone" class="table table-bordered table-striped table-condensed table-hover dataTable">
                                                                    <thead>
                                                                        <tr role="row">
                                                                            <th></th>
                                                                            <th class="text-left" style="min-width: 500%;">Telefone</th>
                                                                            <th class="text-left">Principal</th>
                                                                            <th class="text-left">WhatsApp</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </fieldset>
                                                    <fieldset class="col col-6">
                                                        <input id="jsonEmail" name="jsonEmail" type="hidden" value="[]">
                                                        <div id="formEmail" class="col-12 required">
                                                            <input id="emailId" name="emailId" type="hidden" value="">
                                                            <input id="descricaoEmailPrincipal" name="descricaoEmailPrincipal" type="hidden" value="">
                                                            <input id="sequencialEmail" name="sequencialEmail" type="hidden" value="">
                                                            <div class="row">
                                                                <section class="col col-6">
                                                                    <label class="label">Email</label>
                                                                    <label class="input"><i class="icon-prepend fa fa-envelope"></i>
                                                                        <input id="email" name="email" class="required" type="text" class="form-control" value="">
                                                                    </label>
                                                                </section>
                                                                <section class="col col-2">
                                                                    <label class="label">&nbsp;</label>
                                                                    <label class="checkbox">
                                                                        <input id="emailPrincipal" name="emailPrincipal" type="checkbox" value="true" checked="checked"><i></i>
                                                                        Principal
                                                                    </label>
                                                                </section>
                                                                <section class="col col-4">
                                                                    <label class="label">&nbsp;</label>
                                                                    <button id="btnAddEmail" type="button" class="btn btn-primary">
                                                                        <i class="fa fa-plus"></i>
                                                                    </button>
                                                                    <button id="btnExcluirEmail" type="button" class="btn btn-danger">
                                                                        <i class="fa fa-minus"></i>
                                                                    </button>
                                                                </section>
                                                            </div>
                                                            <div class="table-responsive" style="min-height: 115px; width: 95%; border: 1px solid #ddd; margin-bottom: 13px; overflow-x: auto;">
                                                                <table id="tableEmail" class="table table-bordered table-striped table-condensed table-hover dataTable">
                                                                    <thead>
                                                                        <tr role="row">
                                                                            <th></th>
                                                                            <th class="text-left" style="min-width: 500%;">Email</th>
                                                                            <th class="text-left">Principal</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </fieldset>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Accordion para Endereço -->
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                <h4 class="panel-title">
                                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseEndereco" class="" id="accordionEndereco">
                                                        <i class="fa fa-lg fa-angle-down pull-right"></i>
                                                        <i class="fa fa-lg fa-angle-up pull-right"></i>
                                                        Endereço
                                                    </a>
                                                </h4>
                                            </div>
                                            <div id="collapseEndereco" class="panel-collapse collapse">
                                                <div class="panel-body no-padding">



                                                    <fieldset>
                                                        <div class="row">
                                                            <section class="col col-2 ">
                                                                <label class="label">CEP</label>
                                                                <label class="input">
                                                                    <input id="cep" name="cep" type="text" class="required">
                                                                </label>
                                                            </section>
                                                        </div>
                                                        <div class="row">
                                                            <section class="col col-4">
                                                                <label class="label">Logradouro</label>
                                                                <label class="input">
                                                                    <input id="logradouro" maxlength="255" name="logradouro" class="readonly " type="text" value="" disabled>
                                                                </label>
                                                            </section>
                                                            <section class="col col-3">
                                                                <label class="label">Complemento</label>
                                                                <label class="input">
                                                                    <input id="complemento" name="complemento" type="text" class="required" value="">
                                                                </label>
                                                            </section>
                                                            <section class="col col-1">
                                                                <label class="label">Número</label>
                                                                <label class="input">
                                                                    <input id="numero" name="numero" type="text" value="" class="required">
                                                                </label>
                                                            </section>
                                                            <section class="col col-2">
                                                                <label class="label">UF</label>
                                                                <label class="input">
                                                                    <input type="text" id="uf" name="uf" class="readonly" disabled>
                                                                </label>
                                                            </section>
                                                            <section class="col col-2">
                                                                <label class="label" for="idade">Bairro</label>
                                                                <label class="input">
                                                                    <input type="text" id="bairro" name="bairro" class="readonly" disabled>
                                                                </label>
                                                            </section>

                                                            <section class="col col-3">
                                                                <label class="label" for="idade">Cidade</label>
                                                                <label class="input">
                                                                    <input type="text" id="cidade" name="cidade" class="readonly" disabled>
                                                                </label>
                                                            </section>

                                                            <section class="col col-2">
                                                                <label class="label" for="idade">IBGE</label>
                                                                <label class="input">
                                                                    <input type="text" id="ibge" name="ibge" class="readonly" disabled>
                                                                </label>
                                                            </section>

                                                        </div>



                                                </div>
                                            </div>
                                            <footer>
                                                <button type="button" id="btnExcluir" class="btn btn-danger" aria-hidden="true" title="Excluir" style="display:<?php echo $esconderBtnExcluir ?>">
                                                    <span class="fa fa-trash"></span>
                                                </button>
                                                <div class="ui-dialog ui-widget ui-widget-content ui-corner-all ui-front ui-dialog-buttons ui-draggable" tabindex="-1" role="dialog" aria-describedby="dlgSimpleExcluir" aria-labelledby="ui-id-1" style="height: auto; width: 600px; top: 220px; left: 262px; display: none;">
                                                    <div class="ui-dialog-titlebar ui-widget-header ui-corner-all ui-helper-clearfix">
                                                        <span id="ui-id-2" class="ui-dialog-title">
                                                        </span>
                                                    </div>
                                                    <div id="dlgSimpleExcluir" class="ui-dialog-content ui-widget-content" style="width: auto; min-height: 0px; max-height: none; height: auto;">
                                                        <p>CONFIRMA A EXCLUSÃO ? </p>
                                                    </div>
                                                    <div class="ui-dialog-buttonpane ui-widget-content ui-helper-clearfix">
                                                        <div class="ui-dialog-buttonset">
                                                        </div>
                                                    </div>
                                                </div>
                                                <button type="submited" id="btnGravar" class="btn btn-success" aria-hidden="true" title="Gravar" style="display:<?php echo $esconderBtnGravar ?>">
                                                    <span class="fa fa-floppy-o"></span>
                                                </button>
                                                <button type="button" id="btnNovo" class="btn btn-primary" aria-hidden="true" title="Novo" style="display:<?php echo $esconderBtnGravar ?>">
                                                    <span class="fa fa-file-o"></span>
                                                </button>
                                                <button type="button" id="btnVoltar" class="btn btn-default" aria-hidden="true" title="Voltar">
                                                    <span class="fa fa-backward "></span>
                                                </button>
                                            </footer>
                                </form>
                            </div>
                        </div>
                    </div>
                </article>
            </div>
        </section>
        <!-- end widget grid -->
    </div>
</div>
<!-- END MAIN CONTENT -->

<!-- PAGE FOOTER -->

<!-- END MAIN PANEL -->

<!-- ==========================CONTENT ENDS HERE ========================== -->



<!-- PAGE FOOTER -->
<?php
include("inc/footer.php");
?>
<!-- END PAGE FOOTER -->

<?php
//include required scripts
include("inc/scripts.php");
?>

<script src="<?php echo ASSETS_URL; ?>/js/businessFuncionario.js" type="text/javascript"></script>

<!-- PAGE RELATED PLUGIN(S) 
<script src="..."></script>-->
<!-- Flot Chart Plugin: Flot Engine, Flot Resizer, Flot Tooltip -->
<script src="<?php echo ASSETS_URL; ?>/js/plugin/flot/jquery.flot.cust.min.js"></script>
<script src="<?php echo ASSETS_URL; ?>/js/plugin/flot/jquery.flot.resize.min.js"></script>
<script src="<?php echo ASSETS_URL; ?>/js/plugin/flot/jquery.flot.time.min.js"></script>
<script src="<?php echo ASSETS_URL; ?>/js/plugin/flot/jquery.flot.tooltip.min.js"></script>

<!-- Vector Maps Plugin: Vectormap engine, Vectormap language -->
<script src="<?php echo ASSETS_URL; ?>/js/plugin/vectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="<?php echo ASSETS_URL; ?>/js/plugin/vectormap/jquery-jvectormap-world-mill-en.js"></script>

<!-- Full Calendar -->
<script src="<?php echo ASSETS_URL; ?>/js/plugin/moment/moment.min.js"></script>
<!--<script src="/js/plugin/fullcalendar/jquery.fullcalendar.min.js"></script>-->
<script src="<?php echo ASSETS_URL; ?>/js/plugin/fullcalendar/fullcalendar.js"></script>
<!--<script src="<?php echo ASSETS_URL; ?>/js/plugin/fullcalendar/locale-all.js"></script>-->


<!-- Form to json -->
<script src="<?php echo ASSETS_URL; ?>/js/plugin/form-to-json/form2js.js"></script>
<script src="<?php echo ASSETS_URL; ?>/js/plugin/form-to-json/jquery.toObject.js"></script>

<!-- SCRIPT PARA FORMATACAO DE TELEFONE PARA DOIS MODELOS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.min.js"></script>

<script language="JavaScript" type="text/javascript">
    $(document).ready(function() {
        jsonEmailArray = JSON.parse($("#jsonEmail").val());
        jsonTelefoneArray = JSON.parse($("#jsonTelefone").val());
        $("#cpf").mask("999.999.999-99");
        $("#rg").mask("99.999.999-9");
        $("#dataNascimento").mask('99/99/9999');
        $("#cep").mask("99999999");

        var SPMaskBehavior = function(val) {
                return val.replace(/\D/g, '').length === 11 ? '(00) 00000-0000' : '(00) 0000-00000';
            },
            spOptions = {
                onKeyPress: function(val, e, field, options) {
                    field.mask(SPMaskBehavior.apply({}, arguments), options);
                }
            };

        $('#telefone').mask(SPMaskBehavior, spOptions);
        $("#telefonePrincipal").prop('checked', false);
        $("#telefoneWhatsapp").prop('checked', false);
        $("#emailPrincipal").prop('checked', false);
        $("#cep").blur(function() {

            //Nova variável "cep" somente com dígitos.
            var cep = $(this).val().replace(/\D/g, '');

            //Verifica se campo cep possui valor informado.
            if (cep != "") {

                //Expressão regular para validar o CEP.
                var validacep = /^[0-9]{8}$/;

                //Valida o formato do CEP.
                if (validacep.test(cep)) {

                    //Preenche os campos com "..." enquanto consulta webservice.
                    $("#rua").val("...");
                    $("#bairro").val("...");
                    $("#cidade").val("...");
                    $("#uf").val("...");
                    $("#ibge").val("...");

                    //Consulta o webservice viacep.com.br/
                    $.getJSON("https://viacep.com.br/ws/" + cep + "/json/?callback=?", function(dados) {

                        if (!("erro" in dados)) {
                            //Atualiza os campos com os valores da consulta.
                            $("#logradouro").val(dados.logradouro);
                            $("#bairro").val(dados.bairro);
                            $("#cidade").val(dados.localidade);
                            $("#uf").val(dados.uf);
                            $("#ibge").val(dados.ibge);
                        } //end if.
                        else {
                            //CEP pesquisado não foi encontrado.
                            limpa_formulário_cep();
                            alert("CEP não encontrado.");
                        }
                    });
                } //end if.
                else {
                    //cep é inválido.
                    limpa_formulário_cep();
                    alert("Formato de CEP inválido.");
                }
            } //end if.
            else {
                //cep sem valor, limpa formulário.
                limpa_formulário_cep();
            }
        });




        carregaPagina();

        $.widget("ui.dialog", $.extend({}, $.ui.dialog.prototype, {
            _title: function(title) {
                if (!this.options.title) {
                    title.html("&#160;");
                } else {
                    title.html(this.options.title);
                }
            }
        }));

        $('#dlgSimpleExcluir').dialog({
            autoOpen: false,
            width: 400,
            resizable: false,
            modal: true,
            title: "<div class='widget-header'><h4><i class='fa fa-warning'></i> Atenção</h4></div>",
            buttons: [{
                html: "Excluir registro",
                "class": "btn btn-success",
                click: function() {
                    $(this).dialog("close");
                    excluir();
                }
            }, {
                html: "<i class='fa fa-times'></i>&nbsp; Cancelar",
                "class": "btn btn-default",
                click: function() {
                    $(this).dialog("close");
                }
            }]
        });

        $("#btnExcluir").on("click", function() {
            var id = +$("#codigo").val();

            if (id === 0) {
                smartAlert("Atenção", "Selecione um registro para excluir !", "error");
                $("#nome").focus();
                return;
            }

            if (id !== 0) {
                $('#dlgSimpleExcluir').dialog('open');
            }
        });

        $("#btnNovo").on("click", function() {
            novo();
        });

        $("#btnGravar").on("click", function() {
            gravar();
        });

        $("#btnVoltar").on("click", function() {
            voltar();
        });

        $("#cpf").on("change", function() {
            verificarCpf();
        });

        $("#rg").on("change", function() {
            verificarRG();
        });
        $("#nome").on("change", function() {
            verificarNome();
        });

        $("#btnAddTelefone").on("click", function() {
            if (validaTelefone() === true) {
                validEmail(email);
                addTelefone();
            } else {
                clearFormTelefone()
            }
        });

        $("#btnAddEmail").on("click", function() {
            if (validEmail()) {
                if (validaEmail() === true) {
                    addEmail();
                } else {
                    clearFormEmail()
                }
            } else {
                smartAlert("Atenção","VASCO","error");
                return;
            }
        });

        $("#btnExcluirTelefone").on("click", function() {
            excluirContatoTelefone()
        });

        $("#btnExcluirEmail").on("click", function() {
            excluirContatoEmail()
        });

    });

    function carregaPagina() {
        var urlx = window.document.URL.toString();
        var params = urlx.split("?");
        if (params.length === 2) {
            var id = params[1];
            var idx = id.split("=");
            var idd = idx[1];
            if (idd !== "") {
                recuperaUsuario(idd);

            }
        }
        $("#nome").focus();
    }

    function novo() {
        $(location).attr('href', 'cadastroFuncionario.php');
    }

    function voltar() {
        $(location).attr('href', 'index.php');
    }

    function excluir() {
        var id = +$("#codigo").val();

        if (id === 0) {
            smartAlert("Atenção", "Selecione um registro para excluir!", "error");
            return;
        }
        excluirUsuario(id);
    }

    function gravar() {
        debugger
        var id = +($("#codigo").val());
        var ativo = $('#ativo').val();
        var nome = $("#nome").val();
        var cpf = $("#cpf").val();
        var rg = $("#rg").val();
        var dataNascimento = $("#dataNascimento").val();
        var genero = $("#genero").val();
        var estadoCivil = $("#estadoCivil").val();
        var cep = $("#cep").val();
        var logradouro = $("#logradouro").val();
        var complemento = $("#complemento").val();
        var numero = $("#numero").val();
        var uf = $("#uf").val();
        var bairro = $("#bairro").val();
        var cidade = $("#cidade").val();
        var ibge = $("#ibge").val();



        if (nome === "") {
            smartAlert("Atenção", "Informe o nome !", "error");
            $("#nome").focus();
            return;
        }

        if (cpf === "") {
            smartAlert("Atenção", "Informe o cpf !", "error");
            $("#cpf").focus();
            return;
        }
        if (rg === "") {
            smartAlert("Atenção", "Informe o rg !", "error");
            $("#rg").focus();
            return;
        }

        if (dataNascimento === "") {
            smartAlert("Atenção", "Informe a data de nascimento !", "error");
            $("#dataNascimento").focus();
            return;
        }
        if (genero === "") {
            smartAlert("Atenção", "Informe o gênero !", "error");
            $("#genero").focus();
            return;
        }
        if (estadoCivil === "") {
            smartAlert("Atenção", "Informe o estado civil !", "error");
            $("#estadoCivil").focus();
            return;
        }
        if (cep === "") {
            smartAlert("Atenção", "Informe o cep !", "error");
            $("#cep").focus();
            return;
        }
        if (complemento === "") {
            smartAlert("Atenção", "Informe o complemento !", "error");
            $("#complemento").focus();
            return;
        }
        if (numero === "") {
            smartAlert("Atenção", "Informe o estado civil !", "error");
            $("#numero").focus();
            return;
        }
        gravaUsuario(id, ativo, nome, cpf, rg, dataNascimento, genero, estadoCivil, jsonTelefoneArray, jsonEmailArray, cep, logradouro, complemento, numero, uf, bairro, cidade, ibge);
    }
    function verificarNome(){
        var nome = $("#nome").val();
        if (nome === (/^[A-Za-záàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ ]+$/)){
            alert("corrijaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa")
        }else{
            alert("Parabéns")
        }
       
    }

    function verificarCpf() {


        var cpf = $("#cpf").val();

        if (cpf == '000.000.000-00' ||
            cpf == '111.111.111-11' ||
            cpf == '..-' ||
            cpf == '222.222.222-22' ||
            cpf == '333.333.333-33' ||
            cpf == '444.444.444-44' ||
            cpf == '555.555.555-55' ||
            cpf == '666.666.666-66' ||
            cpf == '777.777.777-77' ||
            cpf == '888.888.888-88' ||
            cpf == '999.999.999-99' ||
            cpf == '' || cpf.length != 14) {
            smartAlert("Atenção", "CPF INVÁLIDO", "Error");
            apagarCpf();
            $("#cpf").focus();
            return false;
        } else {
            verificaCpf(cpf);
        }
    }

    function apagarCpf() {
        document.getElementById('cpf').value = "";
    }

    function verificarRG() {
        var rg = $("#rg").val();
        if (rg == '00.000.000-0' ||
            rg == '11.111.111-1' ||
            rg == '..-' ||
            rg == '22.222.222-2' ||
            rg == '33.333.333-3' ||
            rg == '44.444.444-4' ||
            rg == '55.555.555-5' ||
            rg == '66.666.666-6' ||
            rg == '77.777.777-7' ||
            rg == '88.888.888-8' ||
            rg == '99.999.999-9') {
            smartAlert("Atenção", "RG INVÁLIDO", "Error");
            apagarRg();
            $("#rg").focus();
            return false;
        } else {
            verificaRG(rg);
        }

        function apagarRg() {
            document.getElementById('rg').value = "";
        }


    }

    // function limparCampoData() {
    //     document.getElementById('dataNascimento').value = ""; // Limpa o valor do campo de entrada de data
    // }

    // $('#dataNascimento').on('change', function(){
    //     if (validadeData()) {
    //     }
    // });


    function calcularIdade() {
        var dataNasc = document.getElementById('dataNascimento').value;
        var hoje = new Date();
        var nasc = new Date(dataNasc);
        var idade = hoje.getFullYear() - nasc.getFullYear();
        var m = hoje.getMonth() - nasc.getMonth();
        if (dataNasc) {

            if (m < 0 || (m === 0 && hoje.getDate() < nasc.getDate())) {
                idade--;
            }
            document.getElementById('idade').value = idade;
            $('#idade').val(idade);
        } else {
            smartAlert("Atenção", 'Por favor, insira uma data de nascimento válida.', "error");


        }
    }

    // Adiciona o evento de clique ao documento inteiro
    // document.addEventListener('focusout', calcularIdade);
    $('#dataNascimento').on('change', function() {
        calcularIdade()
    });

    function verificaIdade() {
        var idadeCalcule = document.getElementById('idade').value;
        if (idadeCalcule < 14 || idadeCalcule > 125) {

            limparCampoData();
            smartAlert("Atenção", "Por favor, digite uma data válida.", "error");
            limparCampoIdade()
            return false; // Retorna false para indicar que a validação falhou
        }
        return true; // Retorna true se a validação for bem-sucedida
    }

    function limparCampoData() {
        document.getElementById('dataNascimento').value = ""; // Limpa o valor do campo de entrada de data
    }

    function limparCampoIdade() {
        document.getElementById('idade').value = ""; // Limpa o valor do campo de entrada de data
    }

    // Chama a função verificaIdade() quando o campo de data de nascimento é alterado
    $('#dataNascimento').on('change', function() {
        verificaIdade();
    });

    function clearFormEmail() {
        $("#email").val('');
    }

    //TABELA DE TELEFONEf

    function validaTelefone() {
        var achouTelefone = false;
        var achouTelefonePrincipal = false;
        let tell = $('#telefone').val();
        let tellChecked = $('#telefonePrincipal').is(':checked');
        let sequencial = +$('#sequencialTelefone').val();


        if ($('#telefonePrincipal').is(':checked')) {
            telefonePrincipal = true;
        } else {
            telefonePrincipal = false;
        }

        if (tell === '') {
            smartAlert("Erro", "Informe o Telefone ", "error");
            return false;
        }

        for (i = jsonTelefoneArray.length - 1; i >= 0; i--) {
            if (telefonePrincipal == true) {
                if ((jsonTelefoneArray[i].telefonePrincipal == "Sim") && (jsonTelefoneArray[i].sequencialTelefone !== sequencial)) {
                    achouTelefonePrincipal = true;
                    break;
                }
            }

            if (tell !== "") {
                debugger
                if ((jsonTelefoneArray[i].telefone === tell) && (jsonTelefoneArray[i].sequencialTelefone !== sequencial)) {
                    achouTelefone = true;
                    break;
                }
            }
        }

        if (achouTelefonePrincipal === true) {
            smartAlert("Erro", "Já existe o Telefone Principal na lista.", "error");
            clearFormTelefone();
            return false;

        }

        if (achouTelefone === true) {
            smartAlert("Erro", "Já existe o Telefone na lista.", "error");
            clearFormTelefone();
            return false;

        }

        return true;
    }

    function addTelefone() {
        debugger
        var item = $("#formTelefone").toObject({
            mode: 'combine',
            skipEmpty: false,
            nodeCallback: processDataTel
        });



        item["descricaoPrincipal"] = item["telefonePrincipal"] ? "Sim" : "Não"

        if (item["descricaoPrincipal"] === "Sim") {
            item["telefonePrincipal"] = "Sim";
        } else {
            item["telefonePrincipal"] = "Não";
        }

        if (item["telefoneWhatsapp"] === false) {
            item["telefoneWhatsapp"] = "Não";
        } else {
            item["telefoneWhatsapp"] = "Sim";
        }


        if (item["sequencialTel"] === '') {
            if (jsonTelefoneArray.length === 0) {
                item["sequencialTel"] = 1;
            } else {
                item["sequencialTel"] = Math.max.apply(Math, jsonTelefoneArray.map(function(o) {
                    return o.sequencialTel;
                })) + 1;
            }
            item["telefoneId"] = 0;
        } else {
            item["sequencialTel"] = +item["sequencialTel"];
        }

        if (!validaTelefone()) {
            return false;
        }

        var index = -1;
        $.each(jsonTelefoneArray, function(i, obj) {
            if (+$('#sequencialTel').val() === obj.sequencialTel) {
                index = i;
                return false;
            }
        });

        if (index >= 0)
            jsonTelefoneArray.splice(index, 1, item);
        else
            jsonTelefoneArray.push(item);

        $("#jsonTelefone").val(JSON.stringify(jsonTelefoneArray));
        fillTableTelefone();
        clearFormTelefone();

    }


    function fillTableTelefone() {
        $("#tableTelefone tbody").empty();
        for (var i = 0; i < jsonTelefoneArray.length; i++) {
            if (jsonTelefoneArray[i].telefone !== null && jsonTelefoneArray[i].telefone != '') {
                var row = $('<tr />');
                $("#tableTelefone tbody").append(row);
                row.append($('<td><label class="checkbox"><input type="checkbox" name="checkbox" value="' + jsonTelefoneArray[i].sequencialTel + '"><i></i></label></td>'));
                row.append($('<td class="text-nowrap" onclick="carregaTelefone(' + jsonTelefoneArray[i].sequencialTel + ');">' + jsonTelefoneArray[i].telefone + '</td>'));
                row.append($('<td class="text-nowrap">' + jsonTelefoneArray[i].telefonePrincipal + '</td>'));
                row.append($('<td class="text-nowrap">' + jsonTelefoneArray[i].telefoneWhatsapp + '</td>'));

            }




        }
    }

    function processDataTel(node) {
        var fieldId = node.getAttribute ? node.getAttribute('id') : '';
        var fieldName = node.getAttribute ? node.getAttribute('name') : '';

        if (fieldName !== '' && (fieldId === "telefone")) {
            var valorTel = $("#telefone").val();
            if (valorTel !== '') {
                fieldName = "telefone";
            }
            return {
                name: fieldName,
                value: valorTel
            };
        }
        if (fieldName !== '' && (fieldId === "telefonePrincipal")) {
            var telefonePrincipal = 0;
            if ($("#telefonePrincipal").is(':checked') === true) {
                telefonePrincipal = 1;
            }
            return {
                name: fieldName,
                value: telefonePrincipal
            };
        }

        return false;
    }

    function excluirContatoTelefone() {
        var arrSequencial = [];
        $('#tableTelefone input[type=checkbox]:checked').each(function() {
            arrSequencial.push(parseInt($(this).val()));
        });
        if (arrSequencial.length > 0) {
            for (i = jsonTelefoneArray.length - 1; i >= 0; i--) {
                var obj = jsonTelefoneArray[i];
                if (jQuery.inArray(obj.sequencialTel, arrSequencial) > -1) {
                    jsonTelefoneArray.splice(i, 1);
                }
            }
            $("#jsonTelefone").val(JSON.stringify(jsonTelefoneArray));
            fillTableTelefone();
        } else
            smartAlert("Erro", "Selecione pelo menos 1 telefone para excluir.", "error");
    }

    function carregaTelefone(sequencialTel) {
        debugger

        var arr = jQuery.grep(jsonTelefoneArray, function(item, i) {
            return (item.sequencialTel === sequencialTel);
        });


        clearFormTelefone();
        if (arr.length > 0) {
            var item = arr[0];
            $("#sequencialTel").val(item.sequencialTel);
            $("#telefoneId").val(item.telefoneId);
            $("#telefone").val(item.telefone);

        }
    }

    function clearFormTelefone() {
        $("#sequencialTel").val("");
        $("#telefoneId").val("");
        $("#telefone").val("");
        return true;
    }


    function validEmail(email) {
        var email = $("#email").val();
        return /^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/g.test(email)
    }


    function validaEmail() {
        var achouEmail = false;
        var achouEmailPrincipal = false;
        let emaill = $('#email').val();
        let emailChecked = $('#emailPrincipal').is(':checked');
        let sequencial = +$('#sequencialEmail').val();


        if ($('#descricaoPrincipal').is(':checked')) {
            descricaoPrincipal = "Sim";
        } else {
            descricaoPrincipal = "Não";
        }

        if (emaill === '') {
            smartAlert("Erro", "Informe o Email ", "error");
            return false;
        }

        for (i = jsonEmailArray.length - 1; i >= 0; i--) {
            if (emailPrincipal == true) {
                if (jsonEmailArray[i].descricaoPrincipal && (jsonEmailArray[i].sequencialEmail !== sequencial)) {
                    achouEmailPrincipal = true;
                    break;
                }
            }

            if (emaill !== "") {
                debugger
                if ((jsonEmailArray[i].email === emaill) && (jsonEmailArray[i].sequencialEmail !== sequencial)) {
                    achouEmail = true;
                    break;
                }
            }
        }

        if (achouEmailPrincipal === true) {
            smartAlert("Erro", "Já existe o Email Principal na lista.", "error");
            clearFormTelefone();
            return false;

        }

        if (achouEmail === true) {
            smartAlert("Erro", "Já existe o Email na lista.", "error");
            clearFormTelefone();
            return false;

        }

        return true;
    }


    function addEmail() {
        var item = $("#formEmail").toObject({
            mode: 'combine',
            skipEmpty: false,
            nodeCallback: processDataTel
        });
        validEmail();

        item["descricaoPrincipal"] = item["emailPrincipal"] ? "Sim" : "Não"

        if (item["sequencialEmail"] === '') {
            if (jsonEmailArray.length === 0) {
                item["sequencialEmail"] = 1;
            } else {
                item["sequencialEmail"] = Math.max.apply(Math, jsonEmailArray.map(function(o) {
                    return o.sequencialEmail;
                })) + 1;
            }
            item["emailId"] = 0;
        } else {
            item["sequencialEmail"] = +item["sequencialEmail"];
        }

        if (!validaEmail()) {
            return false;
        }

        var index = -1;
        $.each(jsonEmailArray, function(i, obj) {
            if (+$('#sequencialEmail').val() === obj.sequencialEmail) {
                index = i;
                return false;
            }
        });

        if (index >= 0)
            jsonEmailArray.splice(index, 1, item);
        else
            jsonEmailArray.push(item);

        $("#jsonEmail").val(JSON.stringify(jsonEmailArray));
        fillTableEmail();
        // clearFormTelefone();
        clearFormEmail();

    }


    function fillTableEmail() {
        $("#tableEmail tbody").empty();
        for (var i = 0; i < jsonEmailArray.length; i++) {
            if (jsonEmailArray[i].email !== null && jsonEmailArray[i].email != '') {
                var row = $('<tr />');
                $("#tableEmail tbody").append(row);
                row.append($('<td><label class="checkbox"><input type="checkbox" name="checkbox" value="' + jsonEmailArray[i].sequencialEmail + '"><i></i></label></td>'));
                row.append($('<td class="text-nowrap" onclick="carregaEmail(' + jsonEmailArray[i].sequencialEmail + ');">' + jsonEmailArray[i].email + '</td>'));
                row.append($('<td class="text-nowrap">' + (jsonEmailArray[i].emailPrincipal == 1 ? "Sim" : "Não") + '</td>'));

            }
        }
    }

    function processDataTel(node) {
        var fieldId = node.getAttribute ? node.getAttribute('id') : '';
        var fieldName = node.getAttribute ? node.getAttribute('name') : '';

        if (fieldName !== '' && (fieldId === "telefone")) {
            var valorTel = $("#telefone").val();
            if (valorTel !== '') {
                fieldName = "telefone";
            }
            return {
                name: fieldName,
                value: valorTel
            };
        }
        if (fieldName !== '' && (fieldId === "telefonePrincipal")) {
            var telefonePrincipal = 0;
            if ($("#telefonePrincipal").is(':checked') === true) {
                telefonePrincipal = 1;
            }
            return {
                name: fieldName,
                value: telefonePrincipal
            };
        }

        return false;
    }

    function excluirContatoEmail() {
        var arrSequencial = [];
        $('#tableEmail input[type=checkbox]:checked').each(function() {
            arrSequencial.push(parseInt($(this).val()));
        });
        if (arrSequencial.length > 0) {
            for (i = jsonEmailArray.length - 1; i >= 0; i--) {
                var obj = jsonEmailArray[i];
                if (jQuery.inArray(obj.sequencialEmail, arrSequencial) > -1) {
                    jsonEmailArray.splice(i, 1);
                }
            }
            $("#jsonEmail").val(JSON.stringify(jsonEmailArray));
            fillTableEmail();
        } else
            smartAlert("Erro", "Selecione pelo menos 1 telefone para excluir.", "error");
    }

    function carregaEmail(sequencialEmail) {
        debugger

        var arr = jQuery.grep(jsonEmailArray, function(item, i) {
            return (item.sequencialEmail === sequencialEmail);
        });



        clearFormEmail();
        if (arr.length > 0) {
            var item = arr[0];
            $("#sequencialEmail").val(item.sequencialEmail);
            $("#emailId").val(item.emailId);
            $("#email").val(item.email);
        }
    }

    function clearFormEmail() {
        $("#sequencialEmail").val("");
        $("#emailId").val("");
        $("#email").val("");
        return true;
    }
</script>