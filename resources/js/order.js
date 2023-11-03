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
                            $('select[name="fields"]').append('<option value="' + [key + 1] + '">' + fields.name + '</option>');
                        });
                    } else {
                        $('#fields').empty();
                    }
                }
            });
        } else {
            $('#fields').empty();
        }
    });
});

// $(document).ready(function () {
//     $('#date').on('change', function () {
//         $.ajax({
//             url: 'orders/getDates/',
//             type: "GET",
//             data: {"_token": "{{ csrf_token() }}"},
//             dataType: "json",
//             success: function (data) {
//                 if ($('#date').value < data) {
//                     $('#unvaliDATE').append('<b>' + $('#date').value + '</b>');
//                 } else {
//                     $('#unvaliDATE').append('<b>' + $('#date') + '</b>');
//                     $('#times').empty();
//                 }
//             }
//         });
//     });
// });

$(document).ready(function () {
    $('#date').on('change', function () {
        var now = new Date();
        var today = now.getFullYear() + '-' + (now.getMonth()+1) + '-' + '0' + now.getDate();
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
            });        }
    });
});
