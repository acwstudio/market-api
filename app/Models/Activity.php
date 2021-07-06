<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    use HasFactory;

    public $table = 'activities';

    const FIELD_ID = 'id',
        FIELD_MODEL = 'model',
        FIELD_ACTION = 'action',
        FIELD_MODEL_ID = 'model_id',
        FIELD_USER_ID = 'user_id',
        FIELD_CREATED_AT = 'created_at',
        FIELD_UPDATED_AT = 'updated_at';

    const ACTION_VIEW = 'view',
        ACTION_CREATE = 'create',
        ACTION_UPDATE = 'update',
        ACTION_DISABLE = 'disable',
        ACTION_ENABLE = 'enable',
        ACTION_DELETE = 'delete',
        ACTION_SAVE = 'save';

    const CREATED_AT_DISPLAY_FORMAT = 'd.m.Y H:i';

    public $fillable = [
        self::FIELD_ID,
        self::FIELD_MODEL,
        self::FIELD_ACTION,
        self::FIELD_MODEL_ID,
        self::FIELD_USER_ID
    ];

    public function getId()
    {
        return $this->getAttribute(self::FIELD_ID);
    }

    public function getModel()
    {
        return $this->getAttribute(self::FIELD_MODEL);
    }

    public function getModelDisplay()
    {
        $class = $this->getModel();
        return (method_exists($class, 'getModelName')) ? $class::getModelName() : $class;
    }

    public function getAction()
    {
        return $this->getAttribute(self::FIELD_ACTION);
    }

    public function getActionDisplay()
    {
        switch ($this->getAction()) {
            case self::ACTION_VIEW:
                return 'Просмотрел';
            case self::ACTION_CREATE:
                return 'Добавил';
            case self::ACTION_UPDATE:
                return 'Обновил';
            case self::ACTION_DISABLE:
                return 'Отключил';
            case self::ACTION_ENABLE:
                return 'Включил';
            case self::ACTION_DELETE:
                return 'Удалил';
            case self::ACTION_SAVE:
                return 'Сохранил';
        }
    }

    public function getModelId()
    {
        return $this->getAttribute(self::FIELD_MODEL_ID);
    }

    public function getModelIdDisplay()
    {
        if (empty($this->getModelId())) {
            return null;
        }

        $class = $this->getModel();
        $model = $class::where($class::FIELD_ID, $this->getModelId())->first();

        $link = null;
        if (method_exists($class, 'getModelLink')) {
            $route = sprintf('admin.%s.show', $class::getModelLink());
            $link = route($route, $model->getId());
        }

        return [
            'name' => $model->getName(),
            'link' => $link
        ];
    }

    public function getUserId()
    {
        return $this->getAttribute(self::FIELD_USER_ID);
    }

    public function getCreatedAt()
    {
        return $this->getAttribute(self::FIELD_CREATED_AT);
    }

    public function getCreatedAtDisplay()
    {
        return Carbon::parse($this->getCreatedAt())->format(self::CREATED_AT_DISPLAY_FORMAT);
    }

    public function user()
    {
        return $this->hasOne(User::class, User::FIELD_ID, self::FIELD_USER_ID);
    }
}
