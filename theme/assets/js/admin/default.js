function loadPlugins() {
    $('select').select2({
        language: {
            noResults: function(){
                return "Nenhum registro encontrado";
            }
        },
    });

    $('[msk=date]').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/aaaa' });
    $('[msk=datetime]').inputmask('dd/mm/yyyy 99:99', { 'placeholder': 'dd/mm/aaaa hh:ss' });
    $('[msk=referencia]').inputmask('999999', { 'placeholder': 'aaaamm' });
    $('[msk=telefone]').inputmask('(99) 9999-9999');
    $('[msk=celular]').inputmask('(99) 99999-9999');
    $('[msk=contato]').inputmask({
        mask: ['(99) 9999-9999', '(99) 99999-9999'],
        keepStatic: true
    });
    $('[msk=cpf]').inputmask('999.999.999-99');
    $('[msk=cnpj]').inputmask('99.999.999/9999-99');
    $('[msk=cpf_cnpj]').inputmask({
        mask: ['999.999.999-99', '99.999.999/9999-99'],
        keepStatic: true
    });
    $("[mask=dinheiro]").maskMoney({
        prefix: 'R$',
        affixesStay: false,
        thousands: ''
    });
    $('[mask=numero]').inputmask({alias: 'numeric', rightAlign: false});

    $('[pck=date]').datepicker({
        autoclose: true,
        format: 'yyyy-mm-dd',
        language: 'pt-BR',
        displayFormat: 'dd/mm/yyyy'
    });
    $('[pck=reference]').datepicker({
        format: 'yyyymm',
        language: 'pt-BR',
        todayHighlight:'TRUE',
        endDate: "-0d",
        startView: "months",
        minViewMode: "months",
        autoclose: true
    });

    $('input[type="checkbox"], input[type="radio"]').iCheck({
        checkboxClass: 'icheckbox_square-blue',
        radioClass   : 'iradio_square-blue'
    });

    $(".btn-excluir").on('click', function(event){
        event.preventDefault();
        let url = $(this).attr('href');
        excluir(url);
    });

    $(".btn-status").on('click', function(event){
        event.preventDefault();
        let url = $(this).attr('href');
        var element = $(this);
        var icon = element.find("span.badge");
        var html = element.html();

        $.ajax({
            url: url,
            type: 'get',
            data: {id: 1},
            contentType: "application/json; charset=utf-8",
            beforeSend: function () {
                icon.html('<i class="fa fa-spinner fa-spin"></i>');
                element.tooltip('hide')
            },
            success: function (result) {
                if(!result.error) {
                    if(result.status === 1){
                        element.html("<span class='badge bg-green'><i class='fa fa-check'></i></span>");
                    } else {
                        element.html("<span class='badge bg-red'><i class='fa fa-check'></i></span>");
                    }
                } else {
                    Swal.fire({
                        title: 'Erro!',
                        text: 'Erro ao alterar o status',
                        type: 'error',
                        confirmButtonText: 'Fechar',
                        confirmButtonClass: 'btn btn-flat btn-default',
                        buttonsStyling: false
                    }).then(()=> {
                        element.html(html);
                    })
                }
            },
            error: function () {
                Swal.fire({
                    title: 'Erro!',
                    text: 'Erro ao alterar o status',
                    type: 'error',
                    confirmButtonText: 'Fechar',
                    confirmButtonClass: 'btn btn-flat btn-default',
                    buttonsStyling: false
                }).then(()=> {
                    element.html(html);
                })
            },
            complete: function () {
                icon.html('<i class="fa fa-check"></i>');
            }
        });
    });
}

$.fn.yiiGridView = function (method) {}

function loader(mode) {
    $('#preloader')[mode]();
}

function excluir(url) {
    const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
            confirmButton: 'btn btn-danger btn-flat margin',
            cancelButton: 'btn btn-default btn-flat'
        },
        buttonsStyling: false
    });

    swalWithBootstrapButtons.fire({
        title: 'Deseja realmente excluir?',
        text: 'Você não poderá reverter esta operação!',
        type: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Excluir',
        cancelButtonText: 'Cancelar',
        reverseButtons: true,
        showLoaderOnConfirm: true,
        preConfirm: () => {
            var csrfToken = $('meta[name="csrf-token"]').attr("content");
            var params = {
                method: 'POST',
                headers: {
                    'Accept': 'application/json',
                    'Content-Type': 'application/json',
                    'X-CSRF-Token': csrfToken
                }
            };
            return fetch(url, params)
                .then(response => {
                    if (!response.ok) {
                        throw new Error(response.statusText)
                    }
                    return response.url;
                })
                .catch(error => {
                    Swal.showValidationMessage(
                        `Erro ao Excluir: ${error}`
                    )
                })
        },
        allowOutsideClick: () => !Swal.isLoading()
    }).then((result) => {
        if (result.value) {
            Swal.fire({
                title: 'Excluido!',
                text: 'O registro foi excluido com sucesso.',
                type: 'success',
                confirmButtonText: 'Fechar',
                confirmButtonClass: 'btn btn-flat btn-default',
                buttonsStyling: false
            }).then(()=> {
                window.location.href = result.value;
            })
        }
    })

    // Swal.fire({
    //     title: 'Deseja realmente excluir?',
    //     text: "Você não poderá reverter esta operação!",
    //     type: 'warning',
    //     width: '400px',
    //     buttonsStyling: false,
    //     showCancelButton: true,
    //     //confirmButtonColor: '#3085d6',
    //     //cancelButtonColor: '#d33',
    //     confirmButtonClass: 'btn btn-flat btn-success',
    //     cancelButtonClass: 'btn btn-flat btn-default',
    //     confirmButtonText: 'Sim, excluir!',
    //     cancelButtonText: 'Cancelar'
    // }).then((result) => {
    //     if (result.value) {
    //         Swal.fire(
    //             'Excluido!',
    //             'O registro foi excluido com sucesso.',
    //             'success'
    //         )
    //     }
    // });
    // Swal.fire({
    //     title: 'Submit your Github username',
    //     input: 'text',
    //     inputAttributes: {
    //         autocapitalize: 'off'
    //     },
    //     showCancelButton: true,
    //     confirmButtonText: 'Look up',
    //     showLoaderOnConfirm: true,
    //     preConfirm: (url) => {
    //         return fetch(url)
    //             .then(response => {
    //                 if (!response.ok) {
    //                     throw new Error(response.statusText)
    //                 }
    //                 return response.json()
    //             })
    //             .catch(error => {
    //                 Swal.showValidationMessage(
    //                     `Request failed: ${error}`
    //                 )
    //             })
    //     },
    //     allowOutsideClick: () => !Swal.isLoading()
    // }).then((result) => {
    //     if (result.value) {
    //         Swal.fire({
    //             title: `${result.value.login}'s avatar`,
    //             imageUrl: result.value.avatar_url
    //         })
    //     }
    // })
}

$(function () {
    loadPlugins();
});