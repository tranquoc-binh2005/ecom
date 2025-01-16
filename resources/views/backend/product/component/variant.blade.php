<div class="ibox-content">
    <div class="variant-container">
        <h3>Sản phẩm có nhiều phiên bản</h3>
        <p>
            Cho phép bạn có thể chọn các phiên bản sản phẩm khác nhau: <span class="text-danger">phiên bản, màu
                sắc, chất liệu</span>
        </p>
        <hr>
        <input
            type="checkbox"
            name="accept"
            id="variantCheckbox"
            value="1"
            {{ old('accept') == 1 ? 'checked' : '' }}
        > &nbsp;
        <label for="variantCheckbox">Sản phẩm khác nhau: <span class="text-danger">phiên bản, màu sắc,chất liệu</span></label>

        <div class="variant-wrapper {{ old('accept') == 1 ? '' : 'hidden' }}">
            <div class="col d-flex variant-container mt-10">
                <div class="col-md-3">
                    <div class="attribute-title">Chọn thuộc tính</div>
                </div>
                <div class="col-md-9">
                    <div class="attribute-title">Chọn giá trị thuộc tính</div>
                </div>
            </div>
            <div class="variant-body">
                @if(old('attributeCatalogue'))
                    @foreach(old('attributeCatalogue') as $keyAttr => $valAttr)
                        <div class="col d-flex variant-item mb-10">
                            <div class="col-md-3">
                                <div class="attribute-catalogue">
                                    <select name="attributeCatalogue[]" id="" class="chose-attribute form-control">
                                        @foreach($attributes as $val)
                                            <option {{ $valAttr == $val->id ? 'selected' : '' }}
                                                    value="{{ $val->id }}">{{$val->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-7">
                                <!--<input type="text" name="" disabled class="fake-variant form-control">-->

                                <select class="selectVariant form-control variant-{{ $valAttr }}"
                                        name="attribute_value[{{ $valAttr }}][]"
                                        multiple
                                        data-catid="{{ $valAttr }}">
                                </select>
                            </div>

                            <div class="col-md-2">
                                <button class="remove-attribute btn btn-danger" type="button"><i class="fe-trash"></i> </button>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
            <div class="variant-foot mt-10">
                <button type="button" class="add-variant">Thêm thuộc tính</button>
            </div>
        </div>
    </div>
    <div class="product-variant">
        <h3>Danh sách phiên bản</h3>
        <div class="table-responsive card-box">
            <table class="table mb-0 table-variant">
                <thead></thead>
                <tbody></tbody>
            </table>
        </div>

    </div>
</div>
<script>
    var attributes = @json($attributes->map(function ($items){
        return [
            'id' => $items->id,
            'name' => $items->name
        ];
    })->values())

    var attribute_value = '{{ (isset($product->attribute_value)) ? $product->attribute_value : base64_encode(json_encode(old('attribute_value'))) }}'
    var variant = '{{ (isset($product->variant)) ? $product->variant : base64_encode(json_encode(old('variant'))) }}'
</script>
