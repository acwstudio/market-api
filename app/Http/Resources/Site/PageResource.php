<?php

namespace App\Http\Resources\Site;

use App\Models\Component;
use App\Models\ComponentMethod;
use App\Models\EntitySection;
use App\Models\Method;
use App\Models\Page;
use App\Models\SeoTag;
use Illuminate\Http\Resources\Json\JsonResource;


class PageResource extends JsonResource
{
    const META_FIELD = 'meta';
    const ENTITY_PAGE_FIELD = 'entity_page';

    const URL_METHOD_SECTIONS = '/api/v1/entities/sections/detail';

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        $queryParams = $request->all()['params'] ?? [];

        /** @var \App\Models\Page $page */
        $page = $this->resource;

        /** @var \App\Models\Component $component */
        $components = [];
        foreach ($page->components as $component) {
            $methods = [];
            /** @var \App\Models\ComponentMethod $method */
            foreach ($component->methods as $method) {
                $methods[] = $this->getMethod($method, $queryParams);
            }

            $components[] = $this->getComponent($component, $methods);
        }

        $meta = ($page->seotags instanceof SeoTag) ? $this->getSeoTags($page->seotags) : null;

        /** building components for section methods  */
        if (!is_null($page->getEntityType())) {

            if (!isset($queryParams['id']) && isset($queryParams['slug'])) {

                $entityClassString = $page->getEntityType();
                $entityClass = (new $entityClassString)->where($entityClassString::FIELD_SLUG, $queryParams['slug'])->first();
                $entityId = (!is_null($entityClass)) ? $entityClass->id : null;


            } else if (isset($queryParams['id'])) {
                $entityId = $queryParams['id'];
            } else {
                $entityId = null;
            }

            $entityComponents = $this->getEntityComponents($page->getEntityType(), $entityId);
            $components = array_merge($components, $entityComponents);
        }

        if (isset($entityClass) && !is_null($entityId)) {

            if (!is_null($entityClass->seotags)) {
                $meta = $this->getSeoTags($entityClass->seotags);
            }

            $entityTypeSingle = strtolower(basename(str_replace('\\', '/', $page->getEntityType())));

            $entityPage = [
                'type' => $entityTypeSingle ?? '',
                'id'   => $entityId ?? '',
            ];
        }

        return [
            Page::FIELD_ID                   => $page->getId(),
            Page::FIELD_NAME                 => $page->getName(),
            Page::FIELD_SLUG                 => $page->getSlug(),
            Page::FIELD_STATIC               => (bool)$page->getStatic(),
            Page::FIELD_PAGE_TYPE            => $page->getPageType(),
            self::ENTITY_PAGE_FIELD          => $entityPage ?? null,
            Page::ENTITY_RELATIVE_COMPONENTS => $components,
            self::META_FIELD                 => $meta
        ];
    }

    /**
     * @param Component $component
     * @param $methods
     * @return array
     */
    private function getComponent(Component $component, $methods)
    {
        return [
            Component::FIELD_ID                => $component->getId(),
            Component::FIELD_TITLE             => $component->getTitle(),
            Component::FIELD_KEY               => $component->getKey(),
            Component::FIELD_VIEW_TYPE         => $component->getViewType(),
            Component::ENTITY_RELATIVE_METHODS => $methods
        ];
    }

    /**
     * @param $entityType
     * @param $entityId
     * @return array
     */
    private function getEntityComponents($entityType, $entityId)
    {
        $entityComponents = [];

        $entitySectionList = EntitySection::query()->where([
            EntitySection::FIELD_ENTITY_ID   => $entityId,
            EntitySection::FIELD_ENTITY_TYPE => $entityType,
        ])->get();

        /** @var EntitySection $item */
        foreach ($entitySectionList as $item) {
            $entityComponents[] = [
                Component::FIELD_TITLE             => $item->getTitle(),
                Component::FIELD_KEY               => $item->section->getApiKey() ?? $item->section->getConfigKey(),
                Component::FIELD_VIEW_TYPE         => 'json_section',
                Component::ENTITY_RELATIVE_METHODS => [
                    [
                        'data' => [
                            "filter" => [
                                "section_id"  => $item->getSectionId(),
                                "entity_id"   => $entityId,
                                "entity_type" => strtolower(basename(str_replace('\\', '/', $entityType))),
                            ]
                        ],
                        'url'  => self::URL_METHOD_SECTIONS
                    ]
                ]
            ];
        }

        return $entityComponents;
    }

    /**
     * @param ComponentMethod $componentMethod
     * @param $queryParams
     * @return array
     */
    private function getMethod(ComponentMethod $componentMethod, $queryParams)
    {
        /** @var \App\Models\Method $methodModel */
        $methodModel = $componentMethod->method;

        return [
            ComponentMethod::FIELD_DATA => $this->replaceTemplateToValue($queryParams, $componentMethod->getData()),
            Method::FIELD_URL           => $methodModel->getUrl()
        ];
    }

    /**
     * @param SeoTag $seoTag
     * @return array
     */
    private function getSeoTags(SeoTag $seoTag)
    {
        return [
            SeoTag::FIELD_H1          => $seoTag->getH1(),
            SeoTag::FIELD_TITLE       => $seoTag->getTitle(),
            SeoTag::FIELD_KEYWORDS    => $seoTag->getKeywords(),
            SeoTag::FIELD_DESCRIPTION => $seoTag->getDescription(),
        ];
    }

    /**
     * @param $queryParams
     * @param $dataString
     * @return array
     */
    private function replaceTemplateToValue($queryParams, $dataString): array
    {
        $regTemplateParams = '/"[A-Za-z_]+":( |)("|){[A-Za-z_]+}("|)( |)(,|)/u';

        foreach ($queryParams as $key => $value) {
            $dataString = str_ireplace(
                sprintf("{%s}", $key),
                $value,
                $dataString
            );
        }

        if (preg_match($regTemplateParams, $dataString)) {

            /** Удаляем поля которые не были переданы */
            $dataString = preg_replace($regTemplateParams, '', $dataString);

            /** Избавляемся от запятой при условии если передан один параметр */
            if (count($queryParams) == 1) {
                $dataString = preg_replace('/,/u', '', $dataString);
            }
        }

        $dataString = json_decode($dataString, true);

        return $dataString;
    }
}
