document.addEventListener('DOMContentLoaded', function () {
    const elems = Array.prototype.slice.call(document.querySelectorAll('input[data-plugin="switchery"]'));
    elems.forEach(function (html) {
        const color = html.getAttribute('data-color');
        const size = html.getAttribute('data-size');
        new Switchery(html, {
            color: color,
            size: size
        });
    });
});

changeStatus = () => {
    $('.changeStatusPublish').on('change', function (){
        let _this = $(this)

        let data = {
            'field': _this.attr('data-field'),
            'publish': _this.attr('data-status'),
            'id': _this.attr('data-id'),
            'column': _this.attr('data-column'),
        }

        $.ajax({
            url: '/change-status',
            type: 'POST',
            data: data,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (data) {
                console.log("new publish value " + data.new_publish)
            },
            error: function (e) {

            }
        });
    })
}
changeStatusAll = () => {
    $(document).on('click', '.publishAll', function (e) {
        e.preventDefault()
        let ids = []
        $('.inputCheck').each(function () {
            let inputCheck = $(this)
            if (inputCheck.prop('checked')) {
                ids.push(inputCheck.attr('data-id'))
            }
        })

        let _this = $(this)
        let option = {
            'field': _this.attr('data-field'),
            'column': _this.attr('data-column'),
            'value': _this.attr('data-value'),
        }

        $.ajax({
            url: '/change-statusAll',
            type: 'POST',
            data: {'id': ids, 'option': option},
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (data) {
                console.log(data)
            },
            error: function (e) {
                console.log(e)
            }
        });

    })
}

inputCheckAll = () => {
    if ($('#inputCheckAll').length) {
        $(document).on('click', '#inputCheckAll', function (e) {
            let isChecked = $(this).prop('checked');
            $('.inputCheck').prop('checked', isChecked);

            $('.inputCheck').each(function () {
                changeBackground($(this));
            });
        });
    }
}

inputCheck = () => {
    if ($('.inputCheck').length) {
        $(document).on('click', '.inputCheck', function (e) {
            let _this = $(this);
            let unCheckedInputCheckExists = $('.inputCheck:not(:checked)').length > 0;
            $('#inputCheckAll').prop('checked', !unCheckedInputCheckExists);
            changeBackground(_this);
        });
    }
}

changeBackground = (object) => {
    let isChecked = object.prop('checked');
    if (isChecked) {
        object.closest('tr').addClass('bg-active');
    } else {
        object.closest('tr').removeClass('bg-active');
    }
}

$(document).ready(function (){
    $('.setupSelect2').select2()
    changeStatus()
    inputCheck()
    inputCheckAll()
    changeStatusAll()
})
