<?php
namespace App\Services;
use App\Repositories\AttributeValueRepository;
use App\Services\Interface\AttributeValueServiceInterface;
use App\Repositories\PostCatalogueRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AttributeValueService implements AttributeValueServiceInterface
{
    private AttributeValueRepository $attributeValueRepository;
    public function __construct(AttributeValueRepository $attributeValueRepository)
    {
        $this->attributeValueRepository = $attributeValueRepository;
    }

    public function paginate($request)
    {
        $condition['keyword'] = addslashes($request->input('keyword'));
        $perPage = $request->input('perpage', 10);
        return $this->attributeValueRepository->pagination(
            $this->paginateSelect(),
            $condition,
            $perPage,
            ['path' => 'attribute/value'],
            ['id', 'ASC'],
        );
    }

    public function find($id)
    {
        DB::beginTransaction();
        try {
            $result = $this->attributeValueRepository->findById($id);
            DB::commit();
            return $result;
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => 'Something went wrong', 'message' => $e->getMessage()]);
        }
    }

    public function create($payload)
    {
        DB::beginTransaction();
        try {
            $this->attributeValueRepository->create($this->filterPayload($payload));
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => 'Something went wrong', 'message' => $e->getMessage()]);
        }
    }

    public function update($id, array $payload)
    {
        DB::beginTransaction();
        try {
            $user = $this->attributeValueRepository->update($id, $this->filterPayload($payload));
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => 'Something went wrong', 'message' => $e->getMessage()]);
        }
    }

    public function delete($id)
    {
        DB::beginTransaction();
        try {
            $user = $this->attributeValueRepository->delete($id);
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => 'Something went wrong', 'message' => $e->getMessage()]);
        }
    }

    private function filterPayload(array $payload): array
    {
        return $payload;
    }

    private function paginateSelect(): array
    {
        return [
            '*'
        ];
    }
}
