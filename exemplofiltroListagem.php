<?php
include "js/repositorio.php";
?>
<div class="table-container">
    <div class="table-responsive" style="min-height: 115px; border: 1px solid #ddd; margin-bottom: 13px; overflow-x: auto;">
        <table id="tableSearchResult" class="table table-bordered table-striped table-condensed table-hover dataTable">
            <thead>
                <tr role="row">
                    <!-- <th class="text-left" style="min-width:20px;">Codigo</th> -->
                    <th class="text-left" style="min-width:30px;">Nome</th>
                    <th class="text-left" style="min-width:20px;">Data de Nascimento</th>
                    <th class="text-left" style="min-width:25px;">CPF</th>
                    <th class="text-left" style="min-width:25px;">Estado Cívil</th>
                    <th class="text-left" style="min-width:25px;">Gênero</th>
                    <th class="text-left" style="min-width:25px;">Ativo</th>
                    <th class="text-center" style="min-width:25px;">Gerar PDF</th>
                </tr>
            </thead>
            <tbody>
                <?php

                $where = " WHERE (0 = 0)";

                $nome = $_POST['nome'];
                $dataNascimentoInicio = $_POST['dataNascimentoInicio'];
                $dataNascimentoFim = $_POST['dataNascimentoFim'];
                $cpf = $_POST['cpf'];
                $estadoCivil = $_POST['estadoCivil'];
                $genero = $_POST['genero'];
                $ativo = $_POST['ativo'];

                if ($nome != "") {
                    $where = $where . " AND (nome like '%' + " . "replace('" . $nome . "',' ','%') + " . "'%')";
                }

                if ($cpf != "") {
                    $where = $where . " AND cpf = '$cpf'";
                }

                if ($estadoCivil != "") {
                    $where = $where . " AND EC.codigo = '$estadoCivil'";
                }

                if ($genero != "") {
                    $where = $where . " AND G.codigo = '$genero'";
                }


                if ($dataNascimentoInicio != "") {
                    $where = $where . " AND dataNascimento  >= '$dataNascimentoInicio' OR dataNascimento BETWEEN '$dataNascimentoInicio' AND '$dataNascimentoFim' ";
                }

                if ($dataNascimentoFim != "") {
                    $where = $where . " AND dataNascimento  <= '$dataNascimentoFim' OR dataNascimento BETWEEN '$dataNascimentoFim' AND '$dataNascimentoInicio' ";
                }


                if ($dataNascimentoInicio != "" && $dataNascimentoFim != "") {
                    if ($dataNascimentoInicio) {
                        $dataNascimentoInicio = explode(" ", $dataNascimentoInicio);
                        $data = explode("/", $dataNascimentoInicio[0]);
                        $dataNascimentoInicio = ($data[2] . "-" . $data[1] . "-" . $data[0]);
                    };
                    if ($dataNascimentoFim) {
                        $dataNascimentoFim = explode(" ", $dataNascimentoFim);
                        $data = explode("/", $dataNascimentoFim[0]);
                        $dataNascimentoFim = ($data[2] . "-" . $data[1] . "-" . $data[0]);
                    };
                    $where = $where . " AND dataNascimento BETWEEN '$dataNascimentoInicio' AND '$dataNascimentoFim' ";
                }



                // if ($dataNascimentoInicio == "" && $dataNascimentoFim != "") {
                //     $where = $where . " AND dataNascimento  <= $dataNascimentoFim ";
                // }





                // $dataNascimentoFiltro = $dataNascimento;
                // if ($_POST["dataNascimentoFiltro"] != "") {
                //     $dataNascimentoFiltro = $_POST["dataNascimentoFiltro"];
                //     $where = $where . " AND dataNascimento >= '$dataNascimentoFiltro'";;
                // }

                // $dataFimFiltro = $dataFim;
                // if ($_POST["dataFimFiltro"] != "") {
                //     $dataFimFiltro = $_POST["dataFimFiltro"];
                //     $where = $where . " AND dataNascimento <= '$dataFimFiltro'";;
                // }

                // $dataFimFiltro = $dataFim;
                // if ($_POST["dataFimFiltro"] != "") {
                //     $dataNascimentoFiltro = $_POST["dataNascimentoFiltro"];
                //     $dataFimFiltro = $_POST["dataFimFiltro"];
                //     $where = $where . " AND dataNascimento between '$dataFimFiltro'";;
                // }


                $ativo = $ativo;
                if ($_POST["ativo"] != "") {
                    $ativo = $_POST["ativo"];
                    $where = $where . " AND FC.ativo = '$ativo'";;
                }


                $sql = "SELECT FC.codigo, FC.ativo, FC.nome, FC.cpf, FC.dataNascimento, EC.descricao as estadoCivil, G.descricao as genero FROM dbo.funcionarioCadastro FC
                        LEFT JOIN dbo.genero G ON G.codigo = FC.genero
                        LEFT JOIN dbo.estadoCivil EC ON EC.codigo = FC.estadoCivil ";

                $sql = $sql . $where . "ORDER BY dataNascimento DESC";
                $reposit = new reposit();
                $result = $reposit->RunQuery($sql);

                foreach ($result as $row) {
                    $codigo = (int) $row['codigo'];
                    $nome =  $row['nome'];
                    $ativo = (int)$row['ativo'];
                    $cpf =   $row['cpf'];
                    $dataNascimento = $row['dataNascimento'];
                    $estadoCivil = $row['estadoCivil'];
                    $genero = $row['genero'];
                    if ($ativo == 1) {
                        $descricaoAtivo = "Sim";
                    } else {
                        $descricaoAtivo = "Não";
                    }

                    if ($dataNascimento) {
                        $dataNascimento = explode(" ", $dataNascimento);
                        $data = explode("-", $dataNascimento[0]);
                        $dataNascimento = ($data[2] . "/" . $data[1] . "/" . $data[0]);
                    };

                    echo '<tr >';
                    // echo '<td class="text-left"><a href="cadastroFuncionario.php?id=' . $codigo . '">' . $codigo . '</a></td>';
                    echo '<td class="text-left"><a href="cadastroFuncionario.php?id=' . $codigo . '">' . $nome . '</a></td>';
                    echo '<td class="text-left">' . $dataNascimento . '</td>';
                    echo '<td class="text-left">' . $cpf . '</td>';
                    echo '<td class="text-left">' . $estadoCivil . '</td>';
                    echo '<td class="text-left">' . $genero . '</td>';
                    echo '<td class="text-left">' . $descricaoAtivo . '</td>';
                    echo '<td class="text-center"> ' . '' . '  <a href="relatorioFuncionario.php?codigo=' . $codigo . '"><span class="btn btn-danger fa fa-file text-center "> </span> </td>';
                    echo '</tr >';
                }
                ?>
            </tbody>
        </table>
    </div>
</div>
<!-- PAGE RELATED PLUGIN(S) -->
<script src="js/plugin/datatables/jquery.dataTables.min.js"></script>
<script src="js/plugin/datatables/dataTables.colVis.min.js"></script>
<script src="js/plugin/datatables/dataTables.tableTools.min.js"></script>
<script src="js/plugin/datatables/dataTables.bootstrap.min.js"></script>
<script src="js/plugin/datatable-responsive/datatables.responsive.min.js"></script>
<script>
    // function abreviar(nome) {
    //     const [nome, ...sobrenomes] = str.split(' ');

    //     const abreviaturas = sobrenomes.reduce((arr, str) => {
    //         const letraGrande = str.match(/[A-ZÖÄÅÀÁÂÃÌÍÒÓÉÊÚ]/);
    //         if (!letraGrande) return arr;
    //         return arr.concat(`${letraGrande[0]}.`);
    //     }, []);

    //     return [nome, ...abreviaturas].join(' ');
    // }

    // testes.forEach((teste, i) => {
    //     console.log(i, '>', abreviar(teste));
    // });
    $(document).ready(function() {

        var responsiveHelper_dt_basic = undefined;
        var responsiveHelper_datatable_fixed_column = undefined;
        var responsiveHelper_datatable_col_reorder = undefined;
        var responsiveHelper_datatable_tabletools = undefined;

        var breakpointDefinition = {
            tablet: 1024,
            phone: 480
        };

        /* TABLETOOLS */
        $('#tableSearchResult').dataTable({

            // Tabletools options:
            //   https://datatables.net/extensions/tabletools/button_options
            "sDom": "<'dt-toolbar'<'col-xs-12 col-sm-6'f><'col-sm-6 col-xs-6 hidden-xs'B'l'C>r>" +
                "t" +
                "<'dt-toolbar-footer'<'col-sm-6 col-xs-12 hidden-xs'i><'col-sm-6 col-xs-12'p>>",
            "oLanguage": {
                "sSearch": '<span class="input-group-addon"><i class="glyphicon glyphicon-search"></i></span>',
                "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
                "sInfoEmpty": "Mostrando 0 até 0 de 0 registros",
                "sInfoFiltered": "(Filtrados de _MAX_ registros)",
                //"sLengthMenu": "_MENU_ Resultados por página",
                "sLengthMenu": "_MENU_",
                "sInfoPostFix": "",
                "sInfoThousands": ".",
                "sLoadingRecords": "Carregando...",
                "sProcessing": "Processando...",
                "sZeroRecords": "Nenhum registro encontrado",
                "oPaginate": {
                    "sNext": "Próximo",
                    "sPrevious": "Anterior",
                    "sFirst": "Primeiro",
                    "sLast": "Último"
                },
                "oAria": {
                    "sSortAscending": ": Ordenar colunas de forma ascendente",
                    "sSortDescending": ": Ordenar colunas de forma descendente"
                }
            },
            "aaSorting": [],
            "buttons": [
                //{extend: 'copy', className: 'btn btn-default'},
                //{extend: 'csv', className: 'btn btn-default'},
                {
                    extend: 'excel',
                    className: 'btn btn-default'
                },
                {
                    extend: 'pdf',
                    className: 'btn btn-default'
                },
                //{extend: 'print', className: 'btn btn-default'}
            ],
            "autoWidth": true,

            "preDrawCallback": function() {
                // Initialize the responsive datatables helper once.
                if (!responsiveHelper_datatable_tabletools) {
                    responsiveHelper_datatable_tabletools = new ResponsiveDatatablesHelper($('#tableSearchResult'), breakpointDefinition);
                }
            },
            "rowCallback": function(nRow) {
                responsiveHelper_datatable_tabletools.createExpandIcon(nRow);
            },
            "drawCallback": function(oSettings) {
                responsiveHelper_datatable_tabletools.respond();
            },
        });
    });
</script>