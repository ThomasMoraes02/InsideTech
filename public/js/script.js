//Carregar endereço através de viaCep
function viaCep() {
    $(document).ready(function() {

        function limpa_formulário_cep() {
            // Limpa valores do formulário de cep.
            $("#logradouro").val("");
            $("#bairro").val("");
            $("#cidade").val("");
            $("#estado").val("");
            $("#ibge").val("");
        }

        //Quando o campo cep perde o foco.
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
                    $("#logradouro").val("...");
                    $("#bairro").val("...");
                    $("#cidade").val("...");
                    $("#estado").val("...");
                    $("#ibge").val("...");

                    //Consulta o webservice viacep.com.br/
                    $.getJSON("https://viacep.com.br/ws/" + cep + "/json/?callback=?", function(dados) {

                        if (!("erro" in dados)) {
                            //Atualiza os campos com os valores da consulta.
                            $("#logradouro").val(dados.logradouro);
                            $("#bairro").val(dados.bairro);
                            $("#cidade").val(dados.localidade);
                            $("#estado").val(dados.estado);
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
    });
}
viaCep();

//Valida CPF
$('#cpf').mask('000.000.000-00');
$('.cpf').mask('000.000.000-00');

//Valida Telefone
$('#telefone').mask('(99) 99999-9999');
$('.telefone').mask('(99) 99999-9999');

// Valida Cep
$('.cep').mask('99.999-999');


// Requisição AJAX para Deletar

$(function() {
    $(".delete-ajax").on("click", "[data-action]", function(e) {
        e.preventDefault();

        var data = $(this).data();
        var id = data.id;
        var div = $(this).parent().parent();

        $.ajax({
            url: data.action,
            data: 'id=' + id,
            type: "POST",

            success: function() {
                div.fadeOut();
            },

            error: function() {
                alert("Erro ao processar requisição")
            }
        })
    });
});

// Login
var headerDisabled = $("#header-disabled").val();

if(headerDisabled == "disabled") {
    $("nav").hide();
}

// Data em tempo real
// Função para formatar 1 em 01
const zeroFill = n => {
	return ('0' + n).slice(-2);
}

// Cria intervalo
const interval = setInterval(() => {
	// Pega o horário atual
	const now = new Date();
	// Formata a data conforme dd/mm/aaaa hh:ii:ss
	const dataHora = zeroFill(now.getUTCDate()) + '/' + zeroFill((now.getMonth() + 1)) + '/' + now.getFullYear() + ' ' + zeroFill(now.getHours()) + ':' + zeroFill(now.getMinutes()) + ':' + zeroFill(now.getSeconds());
	// Exibe na tela usando a div#data-hora
	document.getElementById('data-hora').innerHTML = dataHora;
}, 1000);


// Paginação de Logs
var $table = document.getElementById("table-logs"),
    $n = 5,
    $rowCount = $table.rows.length,
    $firstRow = $table.rows[0].firstElementChild.tagName,
    $hasHead = ($firstRow === "TH"),
    $tr = [],
    $i, $ii, $j = ($hasHead) ? 1 : 0,
    $th = ($hasHead ? $table.rows[(0)].outerHTML : "");

var $pageCount = Math.ceil($rowCount / $n);

if ($pageCount > 1) {
    for ($i = $j, $ii = 0; $i < $rowCount; $i++, $ii++)
        $tr[$ii] = $table.rows[$i].outerHTML;
    $table.insertAdjacentHTML("afterend", "<div id='buttons-pagination'></div");
    sort(1);
}

function sort($p) {
    var $rows = $th,
        $s = (($n * $p) - $n);
    for ($i = $s; $i < ($s + $n) && $i < $tr.length; $i++)
        $rows += $tr[$i];

    $table.innerHTML = $rows;
    document.getElementById("buttons-pagination").innerHTML = pageButtons($pageCount, $p);
    document.getElementById("id" + $p).setAttribute("class", "active");
}

function pageButtons($pCount, $cur) {
    var $prevDis = ($cur == 1) ? "disabled" : "",
        $nextDis = ($cur == $pCount) ? "disabled" : "",
        $buttons = "<input type='button' value='Anterior' onclick='sort(" + ($cur - 1) + ")' " + $prevDis + ">";
    for ($i = 1; $i <= $pCount; $i++)
        $buttons += "<input type='button' id='id" + $i + "'value='" + $i + "' onclick='sort(" + $i + ")'>";
    $buttons += "<input type='button' value='Próxima' onclick='sort(" + ($cur + 1) + ")' " + $nextDis + ">";
    return $buttons;
}

// Maquina de escrever

function TypeWriter(elemento) {
    const textoArray = elemento.innerHTML.split('');
    elemento.innerHTML = '';

    textoArray.forEach((letra, i) => {
        setTimeout(function() {
            elemento.innerHTML += letra;
        }, 75 * i);
    });
}

const titulo = document.querySelector('.introducao-home');
TypeWriter(titulo);