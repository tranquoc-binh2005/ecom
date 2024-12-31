<?php
namespace App\Services;
use App\Models\PostCatalogue;
use App\Services\Interface\PostCatalogueServiceInterface;
use App\Repositories\PostCatalogueRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class PostCatalogueService implements PostCatalogueServiceInterface
{
    private PostCatalogueRepository $postCatalogueRepository;
    public function __construct(PostCatalogueRepository $postCatalogueRepository)
    {
        $this->postCatalogueRepository = $postCatalogueRepository;
    }

    public function paginate($request)
    {
        $condition['keyword'] = addslashes($request->input('keyword'));
        $condition['publish'] = $request->input('publish') ?? 1;
        $perPage = $request->input('perpage', 10);
        return $this->postCatalogueRepository->pagination(
            $this->paginateSelect(),
            $condition,
            $perPage,
            ['path' => 'post/catalogue'],
            ['_lft', 'ASC'],
        );
    }

    public function find($id)
    {
        DB::beginTransaction();
        try {
            $result = $this->postCatalogueRepository->findById($id);
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
            $this->postCatalogueRepository->create($this->filterPayload($payload));
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
            $user = $this->postCatalogueRepository->update($id, $this->filterPayload($payload));
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
            $user = $this->postCatalogueRepository->delete($id);
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => 'Something went wrong', 'message' => $e->getMessage()]);
        }
    }

    private function filterPayload(array $payload): array
    {
        $payload['user_id'] = Auth::id();
        $payload['slug'] = Str::slug($payload['slug']);
        return $payload;
    }

    private function paginateSelect(): array
    {
        return [
            '*'
        ];
    }
}
