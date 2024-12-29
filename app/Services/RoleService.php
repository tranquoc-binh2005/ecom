<?php
namespace App\Services;
use App\Services\Interface\RoleServiceInterface;
use App\Repositories\RoleRepository;
use App\Models\Role;
use Illuminate\Support\Facades\DB;

class RoleService implements RoleServiceInterface
{
    private RoleRepository $roleRepository;
    public function __construct(RoleRepository $roleRepository)
    {
        $this->roleRepository = $roleRepository;
    }

    public function paginate($request)
    {
        $condition['keyword'] = addslashes($request->input('keyword'));
        $perPage = $request->input('perPage', 10);
        return $this->roleRepository->pagination(
            $this->paginateSelect(),
            $condition,
            $perPage,
            ['path' => 'role'],
            ['id', 'ASC'],
        );
    }

    public function find($id)
    {
        DB::beginTransaction();
        try {
            $result = $this->roleRepository->findById($id);
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
            $this->roleRepository->create($payload);
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
            $this->roleRepository->update($id, $payload);
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
            $this->roleRepository->delete($id);
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => 'Something went wrong', 'message' => $e->getMessage()]);
        }
    }

    private function paginateSelect(): array
    {
        return [
            'id',
            'name',
            'slug',
            'description',
        ];
    }
}
