<?php

namespace App\Http\Controllers;

use App\Models\AidResource;
use Illuminate\Http\Request;

class AidDirectoryController extends Controller
{
    public function index(Request $request)
    {
        $q = trim((string) $request->query('q', ''));
        $category = trim((string) $request->query('category', ''));
        $region = trim((string) $request->query('region', ''));

        $query = AidResource::query()->where('is_active', true);

        if ($q !== '') {
            $query->where(function ($sub) use ($q) {
                $sub->where('name', 'like', "%{$q}%")
                    ->orWhere('description', 'like', "%{$q}%")
                    ->orWhere('category', 'like', "%{$q}%")
                    ->orWhere('region', 'like', "%{$q}%");
            });
        }

        if ($category !== '') {
            $query->where('category', $category);
        }

        if ($region !== '') {
            $query->where('region', $region);
        }

        $resources = $query->orderBy('category')->orderBy('name')->paginate(12)->withQueryString();

        $categories = AidResource::query()
            ->where('is_active', true)
            ->select('category')
            ->distinct()
            ->orderBy('category')
            ->pluck('category')
            ->all();

        $regions = AidResource::query()
            ->where('is_active', true)
            ->whereNotNull('region')
            ->select('region')
            ->distinct()
            ->orderBy('region')
            ->pluck('region')
            ->all();

        return view('aid-directory.index', compact('resources', 'q', 'category', 'region', 'categories', 'regions'));
    }
}

