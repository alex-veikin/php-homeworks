$(function () {

    $("body").on("click", ".btn", function(e) {
        e.preventDefault(); //Отменяем стандартную отправку

        var json = { //Формируем json-строку
            first_name: $('input[name=first_name]').val(),
            last_name: $('input[name=last_name]').val(),
            birth: $('input[name=birth]').val(),
            gender: $('input[name=gender]:checked').val(),
            login: $('input[name=login]').val(),
            password: $('input[name=password]').val(),
            password_confirm: $('input[name=password_confirm]').val()
        };

        $.ajax({ //Посылаем запрос
            url: $('form') .prop('action'),
            method: 'POST',
            data: 'json=' + JSON.stringify(json)
        }).done(function(msg) {
            $('.message') .html(msg); //Выводим ответ
            if ($('.message p').hasClass('good')) { //Очищаем форму при успехе
                $('form').get(0).reset();
            }
        });
    });

});