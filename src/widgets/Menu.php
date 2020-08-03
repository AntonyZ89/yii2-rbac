<?php

namespace antonyz89\rbac\widgets;

use antonyz89\rbac\components\AccessRule;
use dmstr\widgets\Menu as MenuBase;
use Yii;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

class Menu extends MenuBase
{

    public $linkTemplate = '<a href="{url}" {linkOptions}>{icon} {label}</a>';
    public $labelTemplate = '<span {spanStyles}>{label}</span>';

    /**
     * @inheritdoc
     */
    protected function renderItem($item)
    {
        if (isset($item['items'])) {
            $labelTemplate = '<a href="{url}" {linkOptions}>{icon} {label} <span class="pull-right-container" {spanStyles}><i class="fas fa-chevron-left pull-right"></i></span></a>';
            $linkTemplate = '<a href="{url}" {linkOptions}>{icon} {label} <span class="pull-right-container" {spanStyles}><i class="fas fa-chevron-left pull-right"></i></span></a>';
        } else {
            $labelTemplate = $this->labelTemplate;
            $linkTemplate = $this->linkTemplate;
        }

        $options = [];

        if (isset($item['linkOptions'])) {
            foreach ($item['linkOptions'] as $key => $value) {
                $options[] = "$key=\"$value\"";
            }
        }

        $replacements = [
            '{linkOptions}' => implode(' ', $options),
            '{spanStyles}' => isset($item['spanStyles']) ? 'style=' . $item['spanStyles'] : '',
            '{label}' => strtr($this->labelTemplate, [
                '{label}' => $item['label'],
                '{spanStyles}' => isset($item['spanStyles']) ? "style='{$item['spanStyles']}'" : '',
            ]),
            '{icon}' => empty($item['icon']) ? ''
                : '<i class="' . static::$iconClassPrefix . $item['icon'] . '"></i> ',
            '{url}' => isset($item['url']) ? Url::to($item['url']) : 'javascript:void(0);',
        ];

        $template = ArrayHelper::getValue($item, 'template', isset($item['url']) ? $linkTemplate : $labelTemplate);

        return strtr($template, $replacements);
    }

    protected function normalizeItems($items, &$active)
    {
        foreach ($items as $i => $item) {
            if (isset($item['roles'])) {
                $access_rule = new AccessRule();
                $access_rule->roles = $item['roles'];

                $logged_user = Yii::$app->user;
                if (!$access_rule->matchRole($logged_user)) {
                    unset($items[$i]);
                    continue;
                }
            }
        }

        return parent::normalizeItems($items, $active);
    }

    protected function isItemActive($item)
    {
        if (!isset($item['url'])) {
            return false;
        }
        return Url::toRoute($item['url']) === Yii::$app->request->url;
    }

}
