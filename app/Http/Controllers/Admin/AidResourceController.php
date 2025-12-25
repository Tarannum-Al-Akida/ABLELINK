<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AidResource;
use Illuminate\Http\Request;

class AidResourceController extends Controller
{
    public function index(Request $request)
    {
        $q = trim((string) $request->query('q', ''));

        $query = AidResource::query();
        if ($q !== '') {
            $query->where(function ($sub) use ($q) {
                $sub->where('name', 'like', "%{$q}%")
                    ->orWhere('category', 'like', "%{$q}%")
                    ->orWhere('region', 'like', "%{$q}%");
            });
        }

        $resources = $query->orderByDesc('is_active')->orderBy('category')->orderBy('name')->paginate(20)->withQueryString();

        return view('admin.aid-resources.index', compact('resources', 'q'));
    }

    public function create()
    {
        return view('admin.aid-resources.form', [
            'resource' => new AidResource(['is_active' => true]),
            'mode' => 'create',
        ]);
    }

    public function store(Request $request)
    {
        $data = $this->validateResource($request);
        $data['tags'] = $this->normalizeTags($data['tags'] ?? null);

        AidResource::create($data);

        return redirect()->route('admin.aid-resources.index')->with('status', 'Aid resource created.');
    }

    public function edit(AidResource $aidResource)
    {
        return view('admin.aid-resources.form', [
            'resource' => $aidResource,
            'mode' => 'edit',
        ]);
    }

    public function update(Request $request, AidResource $aidResource)
    {
        $data = $this->validateResource($request);
        $data['tags'] = $this->normalizeTags($data['tags'] ?? null);

        $aidResource->update($data);

        return redirect()->route('admin.aid-resources.index')->with('status', 'Aid resource updated.');
    }

    public function destroy(AidResource $aidResource)
    {
        $aidResource->delete();

        return redirect()->route('admin.aid-resources.index')->with('status', 'Aid resource deleted.');
    }

    private function validateResource(Request $request): array
    {
        return $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'category' => ['required', 'string', 'max:255'],
            'region' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:5000'],
            'phone' => ['nullable', 'string', 'max:255'],
            'email' => ['nullable', 'email', 'max:255'],
            'website' => ['nullable', 'url', 'max:255'],
            'address' => ['nullable', 'string', 'max:255'],
            'hours' => ['nullable', 'string', 'max:255'],
            'tags' => ['nullable', 'string', 'max:1000'], // comma-separated
            'is_active' => ['nullable', 'boolean'],
        ]);
    }

    /**
     * @return list<string>|null
     */
    private function normalizeTags(?string $tags): ?array
    {
        if ($tags === null) {
            return null;
        }

        $parts = array_map('trim', explode(',', $tags));
        $parts = array_values(array_filter($parts, static fn (string $t) => $t !== ''));
        $parts = array_values(array_unique($parts));

        return $parts === [] ? null : $parts;
    }
}

