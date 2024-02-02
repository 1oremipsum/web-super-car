$(function() {
    $('[formato=data]').mask('99/99/9999');
    $('[name=cnpj]').mask('99.999.999/9999-99');
    $('[name=fone]').mask('(99) 9999-9999');
    $('[name=preco]').maskMoney({prefix:'R$ ', allowNegative: false, thousands:'.', decimal:',', affixesStay: false});
})