$(function() {
    $('[name=cnpj]').mask('99.999.999/9999-99');
    $('[name=fone]').mask('(99) 9999-9999');
    $('[name=preco]').maskMoney({prefix:'R$ ', allowNegative: true, thousands:'.', decimal:',', affixesStay: false});
})