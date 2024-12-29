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
    $('.changeStatusPublish').on('change', function () {
        let _this = $(this)
        let filed = _this.attr('data-filed')
        let column = _this.attr('data-column')
        let _id = _this.attr('data-id')
        let status = _this.attr('data-status')

        let data = {
            'filed': filed,
            'column': column,
            'id': _id,
            'status': status,
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
            'filed': _this.attr('data-field'),
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
                let cssSpanPublish = 'background-color: rgb(100, 176, 242); border-color: rgb(100, 176, 242); ' +
                    'box-shadow: rgb(100, 176, 242) 0px 0px 0px 10.5px inset; transition: border 0.4s, box-shadow 0.4s, background-color 1.2s;';
                let cssSmallPublish = 'left: 12px; transition: background-color 0.4s, left 0.2s; background-color: rgb(255, 255, 255);';

                let cssSpanUnpublish = 'box-shadow: rgb(223, 223, 223) 0px 0px 0px 0px inset; border-color: rgb(223, 223, 223); ' +
                    'background-color: rgb(255, 255, 255); transition: border 0.4s, box-shadow 0.4s;';
                let cssSmallUnpublish = 'left: 0px; transition: background-color 0.4s, left 0.2s;';

                for (let i = 0; i < ids.length; i++) {

                    let location = $('.location-' + ids[i]);
                    let userSpan = location.siblings('span.switchery');

                    if (data.new_publish == 1) {
                        userSpan.attr('style', cssSmallPublish);
                        location.next('.switchery').find('small').attr('style', cssSmallPublish);
                    } else if (data.new_publish == 2) { // Nếu unpublish
                        userSpan.attr('style', cssSmallUnpublish);
                        location.next('.switchery').find('small').attr('style', cssSmallUnpublish);
                    }
                }
            },
            error: function (e) {

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


$(document).ready(function () {
    changeStatus()
    changeStatusAll()
    inputCheckAll()
    inputCheck()
})
