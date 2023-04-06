<?php

namespace Database\Seeders;

use App\Models\Field;
use App\Models\Tab;
use Exception;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class TabSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tabsData = Data::getTabTableData();
        DB::beginTransaction();
        try {
            foreach ($tabsData as $tabData) {
                $tab = Tab::create(Arr::only($tabData, ['name', 'description', 'slug', 'icon', 'sort_order', 'meta_data', 'is_progress_countable']));
                $this->groupInsertRecursive(Arr::get($tabData, 'groups', []), $tab);
                $this->fieldInsert(Arr::get($tabData, 'fields', []), null, $tab);
            }
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    private function groupInsertRecursive($groups, $tab, $parentId = null)
    {
        if (! Arr::isAssoc($groups)) {
            foreach ($groups as $groupData) {
                $group = $this->groupInsert($groupData, $tab, $parentId);
                $hasChildGroups = Arr::has($groupData, 'groups');
                if ($hasChildGroups) {
                    $this->groupInsertRecursive(Arr::get($groupData, 'groups', []), $tab, $group->id);
                }
            }
        } else {
            $this->groupInsert($groups, $tab, $parentId);
        }
    }

    private function groupInsert($groupData, $tab, $parentId = null)
    {
        $groupInsertArray = Arr::add(Arr::only($groupData, ['internal_name', 'title', 'description', 'can_add_more', 'add_more_label', 'sort_order']), 'parent_id', $parentId);
        $group = $tab->groups()->create($groupInsertArray);
        $this->fieldInsert(Arr::get($groupData, 'fields', []), $group, $tab);

        return $group;
    }

    private function fieldInsert($fields, $group, $tab)
    {
        foreach ($fields as $fieldData) {
            $fieldInsertArray = Arr::add(Arr::except($fieldData, ['options']), 'tab_id', $tab->id);
            if ($group) {
                $field = $group->fields()->create($fieldInsertArray);

                foreach (data_get($fieldData, 'options', []) as $option) {
                    $field->options()->create($option);
                }
            } else {
                Field::create($fieldInsertArray);
            }
        }
    }
}
