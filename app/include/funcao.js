function invalidaInput(id) {
    let input = $(`#${id}`);
    input.addClass('is-invalid')
}

function validaInput(id) {
    let input = $(`#${id}`);
    input.removeClass('is-invalid')
}