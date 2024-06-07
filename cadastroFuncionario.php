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
                                                                <label id="labelAtivo" class="checkbox ">
                                                                    <input checked="checked" id="ativo" name="ativo" type="checkbox" value="true"><i></i>
                                                                    Ativo
                                                                </label>
                                                            </section>
                                                        </div>
                                                        <div class="row">
                                                        </div>
                                                        <div class="row">
                                                            <section class="col col-2">
                                                                <label class="label">Nome</label>
                                                                <label class="input"><i class="icon-prepend fa fa-user"></i>
                                                                    <input id="nome" maxlength="255" name="nome" class="required" type="text" value="">
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
                                                            <div>
                                                                <section class="col col-2 col-auto" required>
                                                                    <label class="label" for="genero">Gênero</label>
                                                                    <label class="select">
                                                                        <select id="genero" class="required" name="genero">
                                                                            <?php
                                                                            $reposit = new reposit();
                                                                            $sql = "SELECT codigo, descricao FROM 
                                                                        dbo.genero";
                                                                            $result = $reposit->RunQuery($sql);
                                                                            foreach ($result as $row) {
                                                                                $codigo = +$row['codigo'];
                                                                                $descricao = $row['descricao'];
                                                                                echo '<option value=' . $codigo . '>' . $descricao . '</option>';
                                                                            }
                                                                            ?>
                                                                        </select><i></i>
                                                                </section>
                                                                <section class="col col-2 col-auto" required>
                                                                    <label class="label" for="estadoCivil">Estado Civil</label>
                                                                    <label class="select">

                                                                        <select id="estadoCivil" class="required" name="estadoCivil">
                                                                            <option></option>
                                                                            <?php
                                                                            $reposit = new reposit();
                                                                            $sql = "SELECT codigo, estadoCivil FROM 
                                                                        dbo.estadoCivil";
                                                                            $result = $reposit->RunQuery($sql);
                                                                            foreach ($result as $row) {
                                                                                $codigo = +$row['codigo'];
                                                                                $estadoCivil = $row['estadoCivil'];
                                                                                echo '<option value=' . $codigo . '>' . $estadoCivil . '</option>';
                                                                            }
                                                                            ?>
                                                                        </select><i></i>
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
                                                            <input id="sequencialTelefone" name="sequencialTelefone" type="hidden" value="">

                                                            <div class="row">
                                                                <section class="col col-4">
                                                                    <label class="label">Telefone</label>
                                                                    <label class="input"><i class="icon-prepend fa fa-phone"></i>
                                                                        <input id="telefone" name="telefone" type="text">
                                                                    </label>
                                                                </section>

                                                                <section class="col col-md-2">
                                                                    <label class="label">&nbsp;</label>
                                                                    <label class="checkbox ">
                                                                        <input id="telefonePrincipal" name="telefonePrincipal" type="checkbox" value="true" checked="checked"><i></i>
                                                                        Principal
                                                                    </label>
                                                                </section>

                                                                <section class="col col-md-2">
                                                                    <label class="label">&nbsp;</label>
                                                                    <label class="checkbox ">
                                                                        <input id="telefoneWhatsApp" name="telefoneWhatsApp" type="checkbox" value="true"><i> </i>
                                                                        WhatsApp
                                                                    </label>
                                                                </section>

                                                                <section class="col col-md-4">
                                                                    <label class="label">&nbsp;</label>
                                                                    <button id="btnAddTelefone" type="button" class="btn btn-primary">
                                                                        <i class="fa fa-plus"></i>
                                                                    </button>
                                                                    <button id="btnExcluirTelefone" type="button" class="btn btn-danger">
                                                                        <i class="fa fa-minus"></i>
                                                                    </button>
                                                                </section>
                                                            </div>
                                                            <div class="table-responsive" style="min-height: 115px; width:95%; border: 1px solid #ddd; margin-bottom: 13px; overflow-x: auto;">
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

                                                    <!-- <fieldset class="col col-6">
                                                        <input id="jsonTelefone" name="jsonTelefone" type="hidden" value="[]">
                                                        <div id="formTelefone" class="col-12 required">
                                                            <input id="telefoneId" name="telefoneId" type="hidden" value="">
                                                            <input id="descricaoTelefonePrincipal" name="descricaoTelefonePrincipal" type="hidden" value="">
                                                            <input id="descricaoTelefoneWhatsApp" name="descricaoTelefoneWhatsApp" type="hidden" value="">
                                                            <input id="sequencialTelefone" name="sequencialTelefone" type="hidden" value="">

                                                            <div class="row">
                                                                <section class="col col-6">
                                                                    <label class="label">Email</label>
                                                                    <label class="input"><i class="icon-prepend fa fa-envelope"></i>
                                                                        <input id="email" name="email" class="required" type="email" class="form-control" value="">
                                                                    </label>
                                                                </section>

                                                                <section class="col col-2">
                                                                    <label class="label">&nbsp;</label>
                                                                    <label class="checkbox ">
                                                                        <input id="telefonePrincipal" name="telefonePrincipal" type="checkbox" value="true" checked="checked"><i></i>
                                                                        Principal
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
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                    </fieldset> -->
                                                </div>
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
    <!-- END MAIN CONTENT -->
</div>

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

        jsonTelefoneArray = JSON.parse($("#jsonTelefone").val());
        $("#cpf").mask("999.999.999-99");
        $("#rg").mask("99.999.999-9");
        $("#dataNascimento").mask('99/99/9999');

        var SPMaskBehavior = function(val) {
                return val.replace(/\D/g, '').length === 11 ? '(00) 00000-0000' : '(00) 0000-00000';
            },
            spOptions = {
                onKeyPress: function(val, e, field, options) {
                    field.mask(SPMaskBehavior.apply({}, arguments), options);
                }
            };

        $('#telefone').mask(SPMaskBehavior, spOptions);

        jQuery.validator.addMethod(
            "senhaRequerida",
            function(value, element, params) {
                var senha = $("#senha").val();
                var codigo = +$("#codigo").val();
                var senhaConfirma = $("#senhaConfirma").val();

                if (codigo === 0) {
                    if (senha === "") {
                        return false;
                    }
                } else {
                    if ((senha === "") & (senhaConfirma !== "")) {
                        return false;
                    }
                }

                return true;
            }, ''
        );

        jQuery.validator.addMethod(
            "confirmaSenhaRequerida",
            function(value, element, params) {
                var senha = $("#senha").val();
                var senhaConfirma = $("#senhaConfirma").val();
                var codigo = +$("#codigo").val();

                if (codigo === 0) {
                    if (senhaConfirma === "") {
                        return false;
                    }
                } else {
                    if ((senha !== "") & (senhaConfirma === "")) {
                        return false;
                    }
                }

                return true;
            }, ''
        );

        jQuery.validator.addMethod(
            "confirmaSenhaequalto",
            function(value, element, params) {
                var senha = $("#senha").val();
                var senhaConfirma = $("#senhaConfirma").val();

                if ((senha !== "") | (senhaConfirma !== "")) {
                    if (senha !== senhaConfirma) {
                        return false;
                    }
                }
                return true;
            }, ''
        );

        $('#formUsuario').validate({
            // Rules for form validation
            rules: {
                'login': {
                    required: true,
                    maxlength: 35
                },
                'senha': {
                    senhaRequerida: true,
                    minlength: 7,
                    maxlength: 20
                },
                'senhaConfirma': {
                    confirmaSenhaRequerida: true,
                    confirmaSenhaequalto: true
                }
            },


            // Messages for form validation
            messages: {
                'login': {
                    required: 'Informe o Login.',
                    maxlength: 'Digite no máximo de 35 caracteres.',
                    minlength: 'Digite no mínimo 7 caracteres'
                },
                'senha': {
                    maxlength: 'Digite no máximo de 20 caracteres.',
                    minlength: 'Digite no mínimo 7 caracteres',
                    senharequerida: 'Informe a senha.'
                },
                'senhaConfirma': {
                    confirmacaosenharequerida: 'Informe a senha mais uma vez.',
                    confirmacaosenhaequalto: 'Informe a mesma senha digitada no campo senha.'
                }
            },

            // Do not change code below
            errorPlacement: function(error, element) {
                error.insertAfter(element.parent());
                //$("#accordionCadastro").click();
                $("#accordionCadastro").removeClass("collapsed");
            },
            highlight: function(element) {
                //$(element).parent().addClass('error');
            },
            unhighlight: function(element) {
                //$(element).parent().removeClass('error');
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

        $("#btnAddTelefone").on("click", function(){
            addTelefone();
        }) 
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
        var id = +($("#codigo").val());
        var ativo = $('#ativo').val();
        var nome = $("#nome").val();
        var cpf = $("#cpf").val();
        var rg = $("#rg").val();
        var dataNascimento = $("#dataNascimento").val();
        var genero = $("#genero").val();
        var estadoCivil = $("#estadoCivil").val();

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
        gravaUsuario(id, ativo, nome, cpf, rg, dataNascimento, genero, estadoCivil);
    }

    function verificarCpf() {
        var cpf = $("#cpf").val();
        verificaCpf(cpf)

    }

    function verificaRG() {
        var rg = $("#rg").val();
        verificaRG(rg)

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
            alert('Por favor, insira uma data de nascimento válida.');
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
            alert("Por favor, digite uma idade válida entre 14 e 120 anos.");
            return false; // Retorna false para indicar que a validação falhou
        }
        return true; // Retorna true se a validação for bem-sucedida
    }

    function limparCampoData() {
        document.getElementById('dataNascimento').value = ""; // Limpa o valor do campo de entrada de data
    }

    // Chama a função verificaIdade() quando o campo de data de nascimento é alterado
    $('#dataNascimento').on('change', function() {
        verificaIdade();
    });

    //TABELA DE TELEFONE
    function addTelefone() {
        var item = $("#formTelefone").toObject({
            mode: 'combine',
            skipEmpty: false,
            nodeCallback: processDataTel
        });

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
        // clearFormTelefone();

    }

    function validaTelefone() {
        var existe = false;
        var achou = false;
        var tel = $('#telefone').val();
        var sequencial = +$('#sequencialTel').val();
        var telefonePrincipalMarcado = 0;

        for (i = jsonTelefoneArray.length - 1; i >= 0; i--) {
            if (telefonePrincipalMarcado === 1) {
                if ((jsonTelefoneArray[i].telefonePrincipal === 1) && (jsonTelefoneArray[i].sequencialTel !== sequencial)) {
                    achou = true;
                    break;
                }
            }
        }

        if (existe === true) {
            smartAlert("Erro", "Telefone já cadastrado.", "error");
            return false;
        }

        return true;
    }

    function fillTableTelefone() {
        $("#tableTelefone tbody").empty();
        for (var i = 0; i < jsonTelefoneArray.length; i++) {
            if (jsonTelefoneArray[i].telefone !== null && jsonTelefoneArray[i].telefone != '') {
                var row = $('<tr />');
                $("#tableTelefone tbody").append(row);
                row.append($('<td><label class="checkbox"><input type="checkbox" name="checkbox" value="' + jsonTelefoneArray[i].sequencialTel + '"><i></i></label></td>'));
                row.append($('<td class="text-nowrap" onclick="carregaTelefone(' + jsonTelefoneArray[i].sequencialTel + ');">' + jsonTelefoneArray[i].telefone + '</td>'));
                row.append($('<td class="text-nowrap">' + jsonTelefoneArray[i].descricaoTelefonePrincipal + '</td>'));
                row.append($('<td class="text-nowrap">' + jsonTelefoneArray[i].descricaoTelefoneWhatsapp + '</td>'));
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

    function excluirContato() {
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
        var arr = jQuery.grep(jsonTelefoneArray, function(item, i) {
            return (item.sequencialTel === sequencialTel);
        });

        clearFormTelefone();

        if (arr.length > 0) {
            var item = arr[0];
            $("#telefoneId").val(item.telefoneId);
        }
    }

    function validEmail(email) {
        return /^[\w+.]+@\w+\.\w{2,}(?:\.\w{2})?$/.test(email)
    }
</script>