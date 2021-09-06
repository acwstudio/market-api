<?php

namespace App\Http\Resources\Site;

use App\Models\Component;
use App\Models\ComponentMethod;
use App\Models\Method;
use App\Models\Page;
use App\Models\SeoTag;
use Illuminate\Http\Resources\Json\JsonResource;


class PageResource extends JsonResource
{
    const META_FIELD = 'meta';

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

        return [
            Page::FIELD_ID                   => $page->getId(),
            Page::FIELD_NAME                 => $page->getName(),
            Page::FIELD_SLUG                 => $page->getSlug(),
            Page::FIELD_STATIC               => (bool)$page->getStatic(),
            Page::FIELD_PAGE_TYPE            => $page->getPageType(),
            Page::ENTITY_RELATIVE_COMPONENTS => $components,
            self::META_FIELD                 => ($page->seotags instanceof SeoTag) ? $this->getSeoTags($page->seotags) : null
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
     * @param ComponentMethod $componentMethod
     * @param $queryParams
     * @return array
     */
    private function getMethod(ComponentMethod $componentMethod, $queryParams)
    {
        /** @var \App\Models\Method $methodModel */
        $methodModel = $componentMethod->method;

        return [
            ComponentMethod::FIELD_DATA => json_decode($this->replaceTemplateToValue($queryParams, $componentMethod->getData())),
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
     * @return string
     */
    private function replaceTemplateToValue($queryParams, $dataString): string
    {
        foreach ($queryParams as $key => $value) {
            $dataString = str_ireplace(
                sprintf("{%s}", $key),
                $value,
                $dataString
            );
        }

        return $dataString;
    }
}
