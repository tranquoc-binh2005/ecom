<?php
namespace App\Services;
use App\Models\PostCatalogue;
use App\Repositories\PostRepository;
use App\Services\Interface\PostServiceInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class PostService implements PostServiceInterface
{
    private PostRepository $postRepository;
    public function __construct(PostRepository $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    public function paginate($request)
    {
        $condition['keyword'] = addslashes($request->input('keyword'));
        $condition['publish'] = $request->input('publish') ?? 1;
        $condition['parent_id'] = $request->input('parent_id') ?? null;
        $perPage = $request->input('perpage', 10);
        return $this->postRepository->pagination(
            $this->paginateSelect(),
            $condition,
            $perPage,
            ['path' => 'post'],
            ['order', 'DESC'],
        );
    }

    public function find($id)
    {
        DB::beginTransaction();
        try {
            $result = $this->postRepository->findById($id);
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
            $this->postRepository->create($this->filterPayload($payload));
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
            $this->postRepository->update($id, $this->filterPayload($payload));
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
            $user = $this->postRepository->delete($id);
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
        $payload['description'] = preg_replace('/^<p>(.*?)<\/p>$/s', '$1', $payload['description']);
        $payload['content'] = preg_replace('/^<p>(.*?)<\/p>$/s', '$1', $payload['content']);
        $payload['time_read'] = ceil(str_word_count($payload['content']) / 200);
        return $payload;
    }

    private function paginateSelect(): array
    {
        return [
            '*'
        ];
    }
}
