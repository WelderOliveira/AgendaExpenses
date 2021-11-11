$(document).ready(function ($) {
    $('.telefone').mask('(99) 9 9999-9999');
    $('#cep').mask('99.999-999');


    $('#cep').on('change', function (ev) {
        ev.preventDefault();

        var Dados = $(this).serialize();
        var cep = $('#cep').val();

        cep = cep.replace(".", "");
        cep = cep.replace("-", "");

        $.ajax({
            url: 'https://viacep.com.br/ws/' + cep + '/json/',
            method: 'get',
            dataType: 'json',
            data: Dados,
            success: function (Dados) {
                $('#logradouro').val(Dados.logradouro);
                $('#bairro').val(Dados.bairro);
                $('#uf').val(Dados.uf);
                $('#localidade').val(Dados.localidade);
            },
            error: function (Dados) {
                alert('Não encontrei nenhum informação sobre o CEP informado, insira os dados manualmente')
                $('#cep').focus();
            }
        })
    });
});

function addTelAdicional() {
    var index = $("#indexTelAdicional").val();
    index++;
    $("#indexTelAdicional").val(index);

    //INDEX ELEMENTO
    var indexTelInput = $("<input>");

    indexTelInput.attr('type', 'hidden');
    indexTelInput.attr('id', 'indexTel-' + index);
    indexTelInput.addClass('form-control TelsAdicionais');
    indexTelInput.attr('value', index);

    //Tel
    var labelTel = $("<label>Telefone</label>");
    var TelInput = $("<input>");

    labelTel.attr('id', 'labelTelAdicional-' + index);
    TelInput.attr('id', 'TelAdicional-' + index);
    TelInput.attr('name', 'TelAdicional-' + index);
    TelInput.attr('type', 'text');
    TelInput.addClass('form-control TelsAdicionais');

    $("#TelsAdicionais").append(indexTelInput, labelTel, TelInput);

    //ACAO
    var labelAcao = $("<label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>");
    var acaoTelDiv = $("<div></div>");
    var acaoTelIcon = $("<i></i>");
    var acaoTelBtn = $("<button></button>");

    acaoTelIcon.addClass('fa fa-minus-circle');
    acaoTelBtn.attr('id', 'excluirTelAdicional-' + index);
    acaoTelBtn.attr('type', 'button');
    acaoTelBtn.attr('onclick', 'delTelAdicional(' + index + ')');
    acaoTelBtn.addClass('btn btn-danger alinhamentoBtnAcao');
    acaoTelBtn.append(acaoTelIcon);
    acaoTelDiv.attr('id', 'acaoTelAdicional-' + index);
    acaoTelDiv.append(labelAcao);
    acaoTelDiv.append(acaoTelBtn);

    $("#acaoTelsAdicionais").append(acaoTelDiv);
}

function delTelAdicional(index) {
    $("#indexTel-" + index).remove();
    $("#labelDescricaoTel-" + index).remove();
    $("#descricaoTel-" + index).remove();
    $("#labelTelAdicional-" + index).remove();
    $("#TelAdicional-" + index).remove();
    $("#acaoTelAdicional-" + index).remove();
}

function save() {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('#submit').html('Please Wait...');
    $("#submit").attr("disabled", true);

    var TelsAdicionais = [];
    $(".TelsAdicionais").each(function () {

        var index = $(this).val();
        var Tel = $("#TelAdicional-" + index).val();

        if (Tel) {
            var TelsAdicionaisObject = {
                Tel: Tel
            };
            // console.log('Adc')

            TelsAdicionais.push(TelsAdicionaisObject);
        }
    });

    var formData = new FormData();
    formData.append('nome', $('#nome').val());
    formData.append('email', $('#email').val());
    formData.append('data_nascimento', $('#data_nascimento').val());
    formData.append('anotacao', $('#anotacoes').val());
    formData.append('cep', $('#cep').val());
    formData.append('localidade', $('#localidade').val());
    formData.append('uf', $('#uf').val());
    formData.append('bairro', $('#bairro').val());
    formData.append('logradouro', $('#logradouro').val());
    formData.append('complemento', $('#complemento').val());
    formData.append('telefones', JSON.stringify(TelsAdicionais));
    formData.append('avatar', $('input[type=file]')[0].files[0]);

    var id = $('.id').val();
    console.log(formData)
    // console.log(avatar)
    $.ajax({
        url: "/agenda/update/"+id,
        type: "PUT",
        data: formData,
        processData: false,
        // contentType: false,
        success: function (response) {
            $('#submit').html('Submit');
            $("#submit").attr("disabled", false);
            alert('Registro Atualizado com Sucesso!');
            document.getElementById("form").reset();
        },
        error: function (response) {
            var errors = response.responseJSON;
            console.log(errors.errors);

            errorsHtml = '';
            $.each(errors.errors, function (k, v) {
                errorsHtml += v + '\n';
            });
            errorsHtml += '';

            alert(
                errorsHtml
            )

        }
    })
    // console.log(data)
}
