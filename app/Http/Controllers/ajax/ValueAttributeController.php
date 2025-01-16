<?php
namespace App\Http\Controllers\ajax;

use App\Http\Controllers\Controller;
use App\Models\Attribute;
use App\Models\AttributeValue;
use Illuminate\Http\Request;

class ValueAttributeController extends Controller
{
    public function getAllAttributeValue(Request $request)
    {
        $attributeValues = AttributeValue::where('attribute_id', $request->attributeId)->get();
        return response()->json(['items'=> $attributeValues]);
    }

    public function getAllAttribute(Request $request)
    {
        $attributes = Attribute::all();
        return response()->json(['data'=> $attributes]);
    }

    public function loadAttribute_value(Request $request){
        $payload['attribute'] = json_decode(base64_decode($request->input('attribute_value')), TRUE);
        $payload['attributeCatalogueId'] = $request->input('attributeCatalogueId');

        $attribute = $payload['attribute'][$payload['attributeCatalogueId']];

        $item = AttributeValue::whereIn('id', $attribute)->get();
        foreach ($item as $val) {
            $tem[] = [
                'id' => $val->id,
                'value' => $val->value,
            ];
        }

        return response()->json(['data'=> $tem]);
    }
}
