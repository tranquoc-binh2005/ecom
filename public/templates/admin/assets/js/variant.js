setupProductVariant = () => {
    $('#variantCheckbox').on('click', function () {
        let price = $('input[name=price]').val()
        let code = $('input[name=code]').val()

        if(price === '' || code === ''){
            alert('Bạn cần phải nhập giá và mã sản phẩm để thực hiện chức năng này')
            return false
        }
        let isChecked = $('#variantCheckbox').is(':checked')

        $('.variant-wrapper').toggleClass('hidden', !isChecked)
    })
}

commasNumber = (nStr) => {
    nStr = String(nStr)
    nStr = nStr.replace(/\./gi, "")
    let str = ''
    for (let i = nStr.length; i > 0; i -= 3){
        let a = ( i - 3 < 0) ? 0 : (i - 3)
        str = nStr.slice(a, i) + '.' + str
    }
    str = str.slice(0, str.length - 1)
    return str
}

addVariant = () => {
    $(document).on('click', '.add-variant', function () {
        let html = renderVariantItem(attributes);
        $('.variant-body').append(html);
        $('.table-variant thead').html('')
        $('.table-variant tbody').html('')
        checkMaxAttribute(attributes);
        disableAttributeTrue();
    });
}

renderVariantItem = (attributes) => {
    let html = ''
    html += `<div class="col d-flex variant-item mb-10">
                    <div class="col-md-3">
                        <div class="attribute-catalogue">
                            <select name="attributeCatalogue[]" id="" class="chose-attribute form-control">
                                <option>[Chọn thuộc tính]</option>`;
                                for (let i = 0; i < attributes.length; i++){
                                    html += `<option value="${attributes[i].id}">${attributes[i].name}</option>`
                                }
    html +=                `</select>
                        </div>
                    </div>

                    <div class="col-md-7">
                        <input type="text" name="" disabled class="fake-variant form-control">
                    </div>

                    <div class="col-md-2">
                        <button class="remove-attribute btn btn-danger" type="button"><i class="fe-trash"></i> </button>
                    </div>
                </div>`
    return html
}

choseVariantValue = () => {
    $(document).on('change', '.chose-attribute', function () {
        let attributeId = $(this).val()
        if(attributeId !== 0){
            $(this).parents('.col-md-3').siblings('.col-md-7').html(select2Variant(attributeId))
        } else {
            $(this).parents('.col-md-3').siblings('.col-md-7')
                .html('<input type="text" name="attributeValue['+attributeId+'][]" disabled class="form-control">')
        }
        $('.selectVariant').each(function () {
            getSelect2($(this))
        })
    })
}

createProductVariant = () => {
    $(document).on('change','.selectVariant', function () {
        let _this = $(this)
        createVariant()
    })
}
createVariant = () => {
    let attributes = []
    let variants = []
    let attributeTitle = []

    $('.variant-item').each(function () {
        let _this = $(this)
        let attr = []
        let attrVariant = []
        let attributeId = _this.find('.chose-attribute').val()
        let optionText = _this.find('.chose-attribute option:selected').text()
        let attributeValue = $('.variant-'+attributeId).select2('data')

        for (let i = 0; i < attributeValue.length; i++){
            let item = {}
            let itemVariant = {}
            item[optionText] = attributeValue[i].text
            itemVariant[attributeId] = attributeValue[i].id
            attr.push(item)
            attrVariant.push(itemVariant)
        }
        attributeTitle.push(optionText)
        attributes.push(attr)
        variants.push(attrVariant)
    })

    attributes = attributes.reduce(
        (a,b) => a.flatMap(d => b.map(e => ({...d, ...e})))
    )

    variants = variants.reduce(
        (a,b) => a.flatMap(d => b.map(e => ({...d, ...e})))
    )

    createTableHeader(attributeTitle)

    let trClass = []
    attributes.forEach((item, index) => {
        let row = createVariantRow(item, variants[index])
        let classModified = 'tr-variant-' + Object.values(variants[index])
                                                            .join(', ')
                                                            .replace(/, /g, '-')
        trClass.push(classModified)
        if(!$('table.table-variant tbody tr').hasClass(classModified)){
            $('table.table-variant tbody').append(row)
        }
    })

    $('table.table-variant tbody tr').each(function () {
        const row = $(this)
        const rowClass = row.attr('class')

        if(rowClass){
            const rowClassArray = rowClass.split(' ')
            let shouldRemove = false
            rowClassArray.forEach(rowClass => {
                if(rowClass == 'variant-row'){
                    return
                } else if (!trClass.includes(rowClass)) {
                    shouldRemove = true
                }
            })
            if(shouldRemove){
                row.remove()
            }
        }
    })

    //let html = renderTableVariant(attributes, attributeTitle, variants)
    //$('.table-variant').html(html)
}

createVariantRow = (attributeItem, variantsItem) => {
    let attributeString = Object.values(attributeItem).join(', ')
    let attributeId = Object.values(variantsItem).join(', ')
    console.log({attributeId, attributeString})
    let classModified = attributeId.replace(/, /g, '-')
    let row = $('<tr>').addClass('variant-row tr-variant-' + classModified)

    let td = $('<td>').append(
        $('<img>').attr('src', 'https://t3.ftcdn.net/jpg/01/44/86/46/360_F_144864656_yfNDNmeMSaTHIJFLYBq9GtRgjiFeBc10.jpg')
                  .attr('width', '50px')
                  .addClass('imageSrc')
    )

    row.append(td)

    Object.values(attributeItem).forEach(value => {
        td = $('<td>').text(value)
        row.append(td)
    })

    td = $('<td>').addClass('td-variant hidden')
    let mainPrice = $('input[name=price]').val()
    let mainSKU = $('input[name=code]').val()
    let inputHiddenField = [
        {name: 'variant[quantity][]', class: 'variant_quantity'},
        {name: 'variant[sku][]', class: 'variant_sku', value: mainSKU + '-' + classModified},
        {name: 'variant[price][]', class: 'variant_price', value: mainPrice},
        {name: 'variant[barcode][]', class: 'variant_barcode'},
        {name: 'variant[album][]', class: 'variant_album'},
        {name: 'attribute[name][]', value: attributeString},
        {name: 'attribute[id][]', value: attributeId},
    ]

    $.each(inputHiddenField, function (_, field) {
        let input = $('<input>').attr('type', 'text').attr('name', field.name).addClass(field.class);
        if(field.value){
            input.val(field.value)
        }
        td.append(input)
    })

    row.append($('<td>').addClass('td-quantity').text('-'))
        .append($('<td>').addClass('td-price').text(mainPrice))
        .append($('<td>').addClass('td-sku').text(mainSKU + '-' + classModified))
        .append(td);
    return row
}

createTableHeader = (attributeTitle) => {
    let thead = $('table.table-variant thead');
    let row = $('<tr>')

    row.append($('<td>').text('Hình ảnh'))

    for (let i = 0; i < attributeTitle.length; i++){
        row.append($('<td>').text(attributeTitle[i]))
    }

    row.append($('<td>').text('Số lượng'))
    row.append($('<td>').text('Giá tiền'))
    row.append($('<td>').text('SKU'))

    return thead.html(row)
}

getSelect2 = (object) => {
    let attributeId = object.attr('data-catid')

    $.ajax({
        url: '/getAllAttributeValue',
        type: 'POST',
        data: {'attributeId': attributeId},
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function (response) {
            let html = '';
            response.items.forEach((values) => {
                html += `<option value='${values.id}'>${values.value}</option>`;

            });
            object.append(html);
            setupSelect2()
        },
        error: function (e) {
            console.log(e)
        }
    });
}

setupSelect2 = () => {
    $('.selectVariant').select2()
}

disableAttributeTrue = () => {
    let id = []
    $('.chose-attribute').each(function () {
        let _this = $(this)
        let selected = _this.find('option:selected').val()
        if(selected !== 0 && selected !== ""){
            id.push(selected)
        }
        $('.chose-attribute').find('option').removeAttr('disabled')
        for (let i = 0; i < id.length; i++){
            $('.chose-attribute').find('option[value="' + id[i] + '"]').prop('disabled', true);
        }
        $('.chose-attribute').find('option:selected').removeAttr('disabled')
    })
}

choseAttributeDisable = () => {
    $(document).on('change', '.chose-attribute', function () {
        disableAttributeTrue();
    });
};

checkMaxAttribute = (attributes) => {
    let variantItem = $('.variant-item').length
    if (variantItem >= attributes.length) {
        $('.variant-foot').html('');
    } else {
        $('.variant-foot').html(`<button type="button" class="add-variant">Thêm thuộc tính</button>`)
    }
}

removeAttribute = () => {
    $(document).on('click', '.remove-attribute', function () {
        _this = $(this)
        _this.parents('.variant-item').remove()
        checkMaxAttribute(attributes)
        createVariant()
    })
}

select2Variant = (attributeId) => {
    let html = `
        <select class="selectVariant form-control variant-${attributeId}"
                name="attribute_value[${attributeId}][]"
                multiple
                data-catid="${attributeId}">
        </select>`;
    return html;
};

variantAlbum = () => {
    $(document).on('click', '.click-to-upload-variant', function () {
        multipleVariant()
    })
}

multipleVariant = () => {
    CKFinder.popup({
        chooseFiles: true,
        width: 800,
        height: 600,
        onInit: function (finder) {
            finder.on('files:choose', function (evt) {
                var files = evt.data.files.toArray();
                files.forEach(function (file) {
                    appendImageVariant(file.getUrl());
                });
            });

            finder.on('file:choose:resizedImage', function (evt) {
                appendImageVariant(evt.data.resizedUrl);
            });
        }
    });
}

appendImageVariant = (imageUrl) => {
    const container = document.querySelector('.upload-variant-list')

    let html = ''
    html += '<span class="image-wrapper">'
    html += '<img class="uploaded-image" id="ckAlbum" src="'+imageUrl+'" alt="'+imageUrl+'">'
    html += '<input type="hidden" name="albumVariant[]" value="'+imageUrl+'">'
    html += '<span class="delete-icon">x</span>'
    html += '</span>'

    $(container).append(html);
    $('.variant-box').addClass('hidden');
    $('.upload-variant-list').sortable();
}

deletePicture = () => {
    $(document).on('click', '.delete-icon', function () {
        let _this = $(this)
        _this.parents('.image-wrapper').remove()
        if ($('.upload-variant-list .image-wrapper').length === 0) {
            $('.variant-box').removeClass('hidden');
        }
    })
}

switchChangeVariant = () => {
    $(document).on('change', '.js-switch', function () {
        let _this = $(this)
        let isChecked = _this.prop('checked')
        if(isChecked === true){
            _this.parents('.col-md-2').siblings('.col-md-10').find('.disabled').removeAttr('disabled')
        } else {
            _this.parents('.col-md-2').siblings('.col-md-10').find('.disabled').attr('disabled', true)
        }
    })
}

updateVariant = () => {
    $(document).on('click', '.variant-row', function () {
        let _this = $(this)
        let variantData = {}
        _this.find(".td-variant input[type=text][class^='variant_']").each(function () {
            let className = $(this).attr('class')
            variantData[className] = $(this).val()
        })

        let updateVariantBox = updateVariantHtml(variantData)
        if($('.updateVariantTr').length === 0){
            _this.after(updateVariantBox)
            switchCherry()
        }
    })
}

variantAlbumList = (album) => {
    let html = '';
    if (album[0] !== '' && album.length) {
        for (let i = 0; i < album.length; i++) {
            html += `
                <span class="image-wrapper ui-sortable-handle">
                    <img class="uploaded-image" id="ckAlbum" src="${album[i]}" alt="${album[i]}">
                    <input type="hidden" name="albumVariant[]" value="${album[i]}">
                    <span class="delete-icon">x</span>
                </span>
            `;
        }
    }
    return html;
};


updateVariantHtml = (variantData) => {
    let variantAlbum = (variantData.variant_album).split(',')
    let variantAlbumItem = variantAlbumList(variantAlbum)
    return `
        <tr class="ibox-content updateVariantTr">
            <td colspan="5">
                <div class="col-md-12 d-flex">
                    <h5>Cập nhật thông tin phiên bản</h5>
                    <div class="btnVariant">
                        <button type="button" class="btn btn-danger cancelVariant">Hủy</button>
                        <button type="button" class="btn btn-success saveVariant">Lưu lại</button>
                    </div>
                </div>
                <div class="album-wrapper">
                    <div class="title">
                        <p>ALBUM ẢNH</p>
                        <p class="click-to-upload-variant">Chọn ảnh</p>
                    </div>
                    <div class="variant-box content ${(variantAlbumItem.length ? 'hidden' : '')}">
                        <p>
                            <img class="click-to-upload-variant" id="ckAlbum"
                                 src="templates/admin/assets/images/noimage.png" alt="">
                        </p>
                        <p>Sử dụng nút chọn hình hoặc nhấn vào đây để chọn hình ảnh</p>
                    </div>
                    <div class="upload-variant-list">${variantAlbumItem}</div>
                    <div class="col d-flex">
                        <div class="col-md-2 justify-center">
                            <label class="control-label">Tồn kho</label>
                            <input type="checkbox"
                                   data-plugin="switchery"
                                   data-color="#64b0f2"
                                   data-size="small"
                                   data-switchery="true"
                                   data-target="variantQuantity"
                                   ${(variantData.variant_quantity > 0) ? 'checked' : ''}
                                   class="allowQuantity js-switch disabled">
                        </div>
                        <div class="col col-md-10 d-flex">
                            <div class="col-md-3">
                                <label class="control-label">Số lượng</label>
                                <input type="text"
                                       name="quantity_variant"
                                       id="variantQuantity"
                                        ${(variantData.variant_quantity > 0) ? '' : 'disabled'}
                                       value="${variantData.variant_quantity}"
                                       class="form-control disabled text-right">
                            </div>
                            <div class="col-md-3">
                                <label class="control-label">SKU</label>
                                <input
                                    type="text"
                                    name="sku_variant"
                                    value="${variantData.variant_sku}"
                                    class="form-control">
                            </div>
                            <div class="col-md-3">
                                <label class="control-label">Gia</label>
                                <input
                                    type="text"
                                    name="price_variant"
                                    value="${variantData.variant_price}"
                                    class="form-control text-right">
                            </div>
                            <div class="col-md-3">
                                <label class="control-label">BarCode</label>
                                <input
                                    type="text"
                                    name="barcode_variant"
                                    class="form-control"
                                    value="${variantData.variant_barcode}">
                            </div>
                        </div>
                    </div>
                </div>
            </td>
        </tr>`;
};

cancelVariantUpdate = () => {
    $(document).on('click', '.cancelVariant', function () {
        closeVariantBox()
    })
}

closeVariantBox = () => {
    $('.updateVariantTr').remove()
}

saveVariantUpdate = () => {
    $(document).on('click', '.saveVariant', function () {
        let variant = {
            'quantity': $('input[name=quantity_variant]').val(),
            'sku': $('input[name=sku_variant]').val(),
            'price': $('input[name=price_variant]').val(),
            'barcode': $('input[name=barcode_variant]').val(),
            'album': $.map($('input[name="albumVariant[]"]'), function (input) {
                return $(input).val();
            }),
        }
        $.each(variant, function (index, value) {
            $('.updateVariantTr').prev().find('.variant_'+index).val(value)
        })
        previewVariantTr(variant)
        closeVariantBox()
    })
}

previewVariantTr = (variant) => {
    let option = {
        'quantity': variant.quantity,
        'sku': variant.sku,
        'price': variant.price,
        'barcode': variant.barcode,
    }
    $.each(option, function (index, value) {
        $('.updateVariantTr').prev().find('.td-'+index).html(value)
    })
    if(variant.album[0]){
        $('.updateVariantTr').prev().find('.imageSrc').attr('src', variant.album[0])
    }
}

switchCherry = () => {
    const elems = Array.prototype.slice.call(document.querySelectorAll('input[data-plugin="switchery"]'));

    elems.forEach(function (html) {
        if (!html.switchery) {
            const color = html.getAttribute('data-color');
            const size = html.getAttribute('data-size');
            new Switchery(html, {
                color: color,
                size: size
            });
        }
    });
};

setupSelectMultiple = (callback) => {
    if($('.selectVariant').length){
        let count = $('.selectVariant').length

        $('.selectVariant').each(function () {
            let _this = $(this)
            let attributeCatalogueId = _this.attr('data-catid')
            if(attribute_value !== ''){
                $.ajax({
                    url: '/loadAttribute_value',
                    type: 'POST',
                    data: {'attribute_value': attribute_value, 'attributeCatalogueId': attributeCatalogueId},
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (reponse) {
                        let json = reponse.data
                        if(json !== 'undefined' && json.length){
                            for (let i = 0; i < json.length; i++){
                                var option = new Option(json[i].value, json[i].id, true, true)
                                _this.append(option)
                            }
                            _this.trigger('change');
                        }
                        if(--count === 0 && callback){
                            callback()
                        }
                    },
                    error: function (e) {
                        console.log(e)
                    }
                });
            }
            setupSelect2(_this)
        })
    }
}

productVariant = () => {
    productVariant = JSON.parse(atob(variant))

    $('.variant-row').each(function (index, value) {
        let _this = $(this)
        let inputHiddenFields = [
            {name: 'variant[quantity][]', class: 'variant_quantity', value: productVariant.quantity[index]},
            {name: 'variant[sku][]', class: 'variant_sku', value: productVariant.sku[index]},
            {name: 'variant[price][]', class: 'variant_price', value: productVariant.price[index]},
            {name: 'variant[barcode][]', class: 'variant_barcode', value: productVariant.barcode[index]},
            {name: 'variant[album][]', class: 'variant_album', value: productVariant.album[index]},
        ]

        for(let i = 0; i < inputHiddenFields.length; i++){
            _this.find(`.${inputHiddenFields[i].class}`).val((inputHiddenFields[i].value) ? inputHiddenFields[i].value : 0);
        }
        let album = productVariant.album[index]
        let variantImage = (album) ? album.split(',')[0] : 'https://t3.ftcdn.net/jpg/01/44/86/46/360_F_144864656_yfNDNmeMSaTHIJFLYBq9GtRgjiFeBc10.jpg'

        _this.find('.td-quantity').html(commasNumber(productVariant.quantity[index]))
        _this.find('.td-price').html(commasNumber(productVariant.price[index]))
        _this.find('.td-sku').html(productVariant.sku[index])
        _this.find('.imageSrc').attr('src', variantImage)
    })
}


$(document).ready(function () {
    setupProductVariant()
    addVariant()
    choseAttributeDisable()
    removeAttribute()
    choseVariantValue()
    createProductVariant()
    variantAlbum()
    switchChangeVariant()
    updateVariant()
    cancelVariantUpdate()
    saveVariantUpdate()
    setupSelectMultiple(
        () => {
            productVariant()
        }
    )
})
