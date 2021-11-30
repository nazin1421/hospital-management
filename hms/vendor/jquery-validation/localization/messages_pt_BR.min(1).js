/*! jQuery Validation Plugin - v1.13.1 - 10/14/2014
 * http://jqueryvalidation.org/
 * Copyright (c) 2014 Jörn Zaefferer; Licensed MIT */
!function(a){"function"==typeof define&&define.amd?define(["jquery","../jquery.validate.min"],a):a(jQuery)}(function(a){a.extend(a.validator.messages,{required:"Este campo &eacute; requerido.",remote:"Por favor, corrija este campo.",email:"Por favor, forne&ccedil;a um endere&ccedil;o de email v&aacute;lido.",url:"Por favor, forne&ccedil;a uma URL v&aacute;lida.",date:"Por favor, forne&ccedil;a uma data v&aacute;lida.",dateISO:"Por favor, forne&ccedil;a uma data v&aacute;lida (ISO).",number:"Por favor, forne&ccedil;a um n&uacute;mero v&aacute;lido.",digits:"Por favor, forne&ccedil;a somente d&iacute;gitos.",creditcard:"Por favor, forne&ccedil;a um cart&atilde;o de cr&eacute;dito v&aacute;lido.",equalTo:"Por favor, forne&ccedil;a o mesmo valor novamente.",extension:"Por favor, forne&ccedil;a um valor com uma extens&atilde;o v&aacute;lida.",maxlength:a.validator.format("Por favor, forne&ccedil;a n&atilde;o mais que {0} caracteres."),minlength:a.validator.format("Por favor, forne&ccedil;a ao menos {0} caracteres."),rangelength:a.validator.format("Por favor, forne&ccedil;a um valor entre {0} e {1} caracteres de comprimento."),range:a.validator.format("Por favor, forne&ccedil;a um valor entre {0} e {1}."),max:a.validator.format("Por favor, forne&ccedil;a um valor menor ou igual a {0}."),min:a.validator.format("Por favor, forne&ccedil;a um valor maior ou igual a {0}."),nifES:"Por favor, forne&ccedil;a um NIF v&aacute;lido.",nieES:"Por favor, forne&ccedil;a um NIE v&aacute;lido.",cifEE:"Por favor, forne&ccedil;a um CIF v&aacute;lido.",postalcodeBR:"Por favor, forne&ccedil;a um CEP v&aacute;lido."})});