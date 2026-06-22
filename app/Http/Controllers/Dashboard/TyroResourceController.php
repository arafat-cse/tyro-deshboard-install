<?php

namespace App\Http\Controllers\Dashboard;

use App\Support\DashboardAccess;
use HasinHayder\TyroDashboard\Http\Controllers\ResourceController;
use Illuminate\Support\Facades\Request as RequestFacade;

class TyroResourceController extends ResourceController
{
    protected function hasAccess($config)
    {
        if (
            isset($config['permission_group'])
            && DashboardAccess::canGroup(auth()->user(), $config['permission_group'], ['view', 'create', 'edit', 'delete'])
        ) {
            return true;
        }

        if (DashboardAccess::can(auth()->user(), $config['permission'] ?? null)) {
            return true;
        }

        return parent::hasAccess($config);
    }

    public function index($resource)
    {
        $config = $this->getResourceConfig($resource);

        if (! $this->hasAccess($config)) {
            abort(403, 'You do not have permission to view this resource.');
        }

        $modelClass = $config['model'];

        if (! class_exists($modelClass)) {
            abort(500, "Model class {$modelClass} not found");
        }

        $query = $modelClass::query();

        $with = [];
        foreach ($config['fields'] as $fieldConfig) {
            if (isset($fieldConfig['relationship'])) {
                $with[] = $fieldConfig['relationship'];
            }
        }

        if ($with !== []) {
            $query->with($with);
        }

        $filterOptions = [];
        foreach ($config['fields'] as $field => $fieldConfig) {
            if (! ($fieldConfig['filterable'] ?? false)) {
                continue;
            }

            if (request()->filled($field)) {
                $query->where($field, request($field));
            }

            if (isset($fieldConfig['relationship'])) {
                $mainModel = new $modelClass;

                if (method_exists($mainModel, $fieldConfig['relationship'])) {
                    $relatedModel = $mainModel->{$fieldConfig['relationship']}()->getRelated();
                    $filterOptions[$field] = $relatedModel::query()
                        ->orderBy($fieldConfig['option_label'] ?? 'id')
                        ->get();
                }
            }
        }

        if (request()->has('search') && request('search')) {
            $search = request('search');
            $query->where(function ($q) use ($search, $config): void {
                $searchableFields = $config['search'] ?? [];

                foreach ($config['fields'] as $field => $fieldConfig) {
                    if ($fieldConfig['searchable'] ?? false) {
                        $searchableFields[] = $field;
                    }
                }

                foreach (array_unique($searchableFields) as $field) {
                    $q->orWhere($field, 'like', "%{$search}%");
                }
            });
        }

        $sortField = request('sort_by', 'created_at');
        $sortDirection = in_array(strtolower(request('sort_dir', 'desc')), ['asc', 'desc'], true)
            ? strtolower(request('sort_dir', 'desc'))
            : 'desc';

        if (isset($config['fields'][$sortField]) && ($config['fields'][$sortField]['sortable'] ?? false)) {
            $query->orderBy($sortField, $sortDirection);
        } elseif ($sortField === 'created_at') {
            $query->latest();
        }

        $items = $query->paginate(config('tyro-dashboard.pagination.resources', 15))
            ->appends(RequestFacade::query());

        return view('tyro-dashboard::resources.index', $this->getViewData([
            'resource' => $resource,
            'config' => $config,
            'items' => $items,
            'filterOptions' => $filterOptions,
            'isReadonly' => $this->isReadonly($config),
        ]));
    }
}
