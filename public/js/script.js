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