var iconEvent = ['fa fa-glass', 'fa fa-calendar', 'fa fa-birthday-cake'];

function addEvent(obj) {
    $('div.eventShower').append('<div class="col-md-12 event" data-id="' + obj.id + '"> <span class="title">' + obj.title + '</span><span class="icons"><i class=" ' + iconEvent[obj.icon] + '"></i></span><br><span class = "date" data-div-date=' + obj.date + '>' + obj.date + '</span><br><span class="description">'+ obj.description +'</span><br><span class="icons"><i class="fa fa-pencil editEvent"  aria-hidden="true" data-toggle="modal" data-target="#myModal"></i> <i class="fa fa-trash-o removeEvent"  aria-hidden="true"></i></span>');
}

function saveDate(getdate,id) {
    var itemId = $(this).attr('data-id');
    var event = {
        id: id,
        title: $('#title').val(),
        date: getdate,
        event: $('option:selected').val(),
        desc: $('#desc').val()
    };

    $.post('db_proc/addnewproduct.php', event, function (res) {
        $.each(res, function (id, obj) {
            appendProduct(obj);
        });
    });
    $('#myModal').modal('hide');
}

$.get('db_proc/selectproducts.php', function (res) {
    $.each(res, function (id, obj) {
        addEvent(obj);
    });
});

$(document).on('click', 'td', function () {
    $('#title').val('');
    $('#event').val('');
    $('#date').val('');
    $('#description').val('');
    var getdate = this.dataset.date;
    $('#myModal #date').val(getdate);
    $('.saveDate').click(function () {
        saveDate(getdate);
    });
});

$(document).on('click', '.removeEvent', function () {
    var itemId = $(this).parent().parent().attr('data-id');
    var iId = {
        id: itemId
    }
    if (confirm("Вы действительно хотите удалить?")) {
        var point = this;
        $.post('db_proc/deleteproduct.php', iId, function (res) {
            if (res.status == "delete") {}
            $(point).parent().parent().remove();
        });
    }
});

$(document).on('click', '.editEvent', function () {
    var itemId = $(this).parent().parent().attr('data-id');
    var getdate = $(this).parent().parent().find('span.date').attr('data-div-date');
    var point = this;

    var iId = {
        id: itemId
    }
    $.get('db_proc/selectproducts.php', iId, function (res) {
        $.each(res, function (id, obj) {
            $('#title').val(obj.title);
            $('#event').val(obj.icon);
            $('#date').val(obj.date);
            $('#desc').val(obj.description);
        });
    });

    $('.saveDate').click(function () {
        $(point).parent().parent().remove();
        saveDate(getdate, itemId);
    });
});
