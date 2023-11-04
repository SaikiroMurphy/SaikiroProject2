$(document).ready(function () {
    $('#types').on('change', function () {
        var type_id = $(this).val();
        if (type_id) {
            $.ajax({
                url: 'orders/getFields/' + type_id,
                type: "GET",
                data: {"_token": "{{ csrf_token() }}"},
                dataType: "json",
                success: function (data) {
                    if (data) {
                        $('#fields').empty();
                        $('#fields').append('<option value="" selected>Chọn sân</option>');
                        $.each(data, function (key, fields) {
                            $('select[name="fields"]').append('<option value="' + fields.id + '" id="field' + fields.id + '">' + fields.name + '</option>');
                        });
                    } else {
                        $('#fields').empty();
                    }
                },

            });
            $.ajax({
                url: 'orders/getPrices/' + type_id,
                type: "GET",
                data: {"_token": "{{ csrf_token() }}"},
                dataType: "json",
                success: function (data) {
                    if (data) {
                        $('#price').empty();
                        $.each(data, function (key, types) {
                            $('#price').append('<input class="form-control" type="text" id="prices" value="'+ types.price + 'đ" readonly>\n' +
                                '<label for="prices" class="form-label">Giá</label>\n');
                        });
                    } else {
                        $('#price').empty();
                    }
                },
            });
        } else {
            $('#price').empty();
        }
    });
});

// {{ number_format($item -> price, 0, '.', ',') }}đ

$(document).ready(function () {
    $('#fields').on('change', function () {
        var field_id = $(this).val();
        if (field_id) {
            $.ajax({
                url: 'orders/getImg/' + field_id,
                type: "GET",
                data: {"_token": "{{ csrf_token() }}"},
                dataType: "json",
                success: function (data) {
                    if (data) {
                        $('#img').empty();
                        $('#desc').empty();
                        $.each(data, function (key, field) {
                            $('#img').append('<img src="http://localhost/SaikiroProject2/public/storage/dashboard/img/' + field.image + '" id="output" width="500">');
                            $('#desc').append('<input class="form-control" type="text" id="des" value="'+ field.description + '" readonly>\n' +
                                '<label for="des" class="form-label">Mô tả</label>\n');
                        });

                    } else {
                        $('#img').empty();
                    }
                }
            });
        }
    });
});

$(document).ready(function () {
    $('#date').on('change', function () {
        var now = new Date();
        var today = now.getFullYear() + '-' + (now.getMonth() + 1) + '-' + '0' + now.getDate();
        var date = $(this).val();
        // alert(today);
        if (date == today) {
            $.ajax({
                url: 'orders/getTimes2Day/',
                type: "GET",
                data: {"_token": "{{ csrf_token() }}"},
                dataType: "json",
                success: function (data) {
                    if (data) {
                        $('#times').empty();
                        $('#times').append('<option value="" selected>Chọn khung giờ</option>');
                        $.each(data, function (key, times) {
                            $('select[name="times"]').append('<option value="' + times.id + '">' + times.timeStart + ' - ' + times.timeEnd + '</option>');
                        });
                    } else {
                        $('#times').empty();
                    }
                }
            });
        } else {
            $.ajax({
                url: 'orders/getTimesNextDay/',
                type: "GET",
                data: {"_token": "{{ csrf_token() }}"},
                dataType: "json",
                success: function (data) {
                    if (data) {
                        $('#times').empty();
                        $('#times').append('<option value="" selected>Chọn khung giờ</option>');
                        $.each(data, function (key, times) {
                            $('select[name="times"]').append('<option value="' + [key + 1] + '">' + times.timeStart + ' - ' + times.timeEnd + '</option>');
                        });
                    } else {
                        $('#times').empty();
                    }
                }
            });
        }
    });
});

$(document).ready(function () {
    $('#times').on('change', function () {
        var time_id = $(this).val();
        var field_id = $('#fields').val();
        var date = $('#date').val();
        if (time_id) {
            $.ajax({
                url: 'orders/checkTime/',
                type: "GET",
                data: {"_token": "{{ csrf_token() }}"},
                dataType: "json",
                success: function (data) {
                    if (data) {

                        $.each(data, function (key, details) {
                            if (field_id == details.field_id){
                                alert('Testing');

                                $.each(data, function (key, details) {
                                    if (date == details.orders.date){

                                        $.each(data, function (key, details) {
                                            if (time_id == details.time_id){
                                                alert('Đã có người chọn khung thời gian này.')
                                            }
                                        })
                                    }
                                })
                            }
                        })
                    } else {

                    }
                }
            });
        }
    });
});
