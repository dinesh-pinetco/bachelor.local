<?php

namespace App\Services;

class ModelHelper
{
    /**
     * Get model instance.
     *
     * @return mixed
     */
    public static function getModel($modelName, $id)
    {
        return (new static)->registeredModels(ucfirst($modelName))->findOrFail($id);
    }

    /**
     * Model registration.
     *
     * @return mixed
     */
    private function registeredModels($modelName)
    {
        return app("App\\Models\\$modelName");
    }

    /**
     * Get model instance.
     *
     * @param $id
     * @return mixed
     */
    public static function getModelByName($modelName)
    {
        return (new static)->registeredModels(ucfirst($modelName));
    }

    /**
     * Get model instance.
     *
     * @return mixed
     */
    public static function getModelFromName($modelName, $id)
    {
        return (new static)->registeredModelsFromName(ucfirst($modelName))->find($id);
    }

    /**
     * Model registration.
     *
     * @return mixed
     */
    private function registeredModelsFromName($model)
    {
        return app($model);
    }

    /**
     * Get model query.
     *
     * @return mixed
     */
    public static function getQuery($modelName)
    {
        return (new static)->registeredModels($modelName);
    }
}
