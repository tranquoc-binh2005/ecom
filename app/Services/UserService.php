<?php
namespace App\Services;
use App\Services\Interface\UserServiceInterface;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserService implements UserServiceInterface
{
    private UserRepository $userRepository;
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function paginate($request)
    {
        $condition['keyword'] = addslashes($request->input('keyword'));
        $condition['publish'] = $request->input('publish') ?? 1;
        $perPage = $request->input('perpage', 10);
        return $this->userRepository->pagination(
            $this->paginateSelect(),
            $condition,
            $perPage,
            ['path' => 'user'],
            ['id', 'ASC'],
        );
    }

    public function find($id)
    {
        DB::beginTransaction();
        try {
            $result = $this->userRepository->findById($id);
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
            $user = $this->userRepository->create($this->filterPayload($payload));
            $user->roles()->attach($payload['role_id']);
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
            $user = $this->userRepository->update($id, $payload);
            $user->roles()->sync($payload['role_id']);
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
            $user = $this->userRepository->findById($id);
            $user->roles()->detach();
            $user->delete();
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => 'Something went wrong', 'message' => $e->getMessage()]);
        }
    }

    private function filterPayload(array $payload): array
    {
        $payload['password'] = Hash::make($payload['password']);

        return $payload;
    }

    private function paginateSelect(): array
    {
        return [
            '*'
        ];
    }
}
