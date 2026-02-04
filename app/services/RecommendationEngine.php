<?php

namespace App\Services;

use App\Models\RecommendationRule;
use App\Models\ProductShade;

class RecommendationEngine
{
    public function recommend(array $profile, array $options = [])
    {
        $category = $options['category'] ?? null;
        $brand    = $options['brand'] ?? null;

        $rules = RecommendationRule::query()
            ->where('is_active', true)
            ->with(['conditions', 'actions'])
            ->orderByDesc('priority')
            ->get();

        $filters = [
            'shade_undertone' => [],
            'shade_tone' => [],
        ];

        foreach ($rules as $rule) {
            if ($this->ruleMatchesProfile($rule->conditions, $profile)) {
                $this->applyActionsToFilters($rule->actions, $filters);
            }
        }

        $query = ProductShade::query()->with('product');

        if ($category) {
            $query->whereHas('product', fn($q) => $q->where('category', $category));
        }
        if ($brand) {
            $query->whereHas('product', fn($q) => $q->where('brand', $brand));
        }

        if (!empty($filters['shade_undertone'])) {
            $query->whereIn('undertone', $filters['shade_undertone']); // lowercase
        }

        if (!empty($filters['shade_tone'])) {
            $query->whereIn('tone', $filters['shade_tone']); // lowercase
        }

        return $query->get();
    }

    private function ruleMatchesProfile($conditions, array $profile): bool
    {
        foreach ($conditions as $cond) {
            $field = $cond->field;
            $op    = strtolower($cond->operator);
            $vals  = is_array($cond->value) ? $cond->value : [$cond->value];

            $profileVal = $profile[$field] ?? null;

            if (!$this->match($profileVal, $op, $vals)) {
                return false;
            }
        }
        return true;
    }

    private function match($profileVal, string $op, array $vals): bool
    {
        $p = is_string($profileVal) ? strtolower(trim($profileVal)) : $profileVal;
        $v = array_map(fn($x) => is_string($x) ? strtolower(trim($x)) : $x, $vals);

        return match ($op) {
            '=', '==' => $p !== null && in_array($p, $v, true),
            '!='      => $p === null ? true : !in_array($p, $v, true),
            'in'      => $p !== null && in_array($p, $v, true),
            'not_in'  => $p === null ? true : !in_array($p, $v, true),
            default   => false,
        };
    }

    private function applyActionsToFilters($actions, array &$filters): void
    {
        foreach ($actions as $act) {
            $target = strtolower(trim($act->target));     // shade_undertone / shade_tone
            $op     = strtolower(trim($act->operator));   // in
            $vals   = is_array($act->value) ? $act->value : [$act->value];

            if ($op !== 'in') continue;
            if (!isset($filters[$target])) continue;

            foreach ($vals as $val) {
                $filters[$target][] = is_string($val) ? strtolower(trim($val)) : $val;
            }
        }

        foreach ($filters as $k => $arr) {
            $filters[$k] = array_values(array_unique($arr));
        }
    }
}
