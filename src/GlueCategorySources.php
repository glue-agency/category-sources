<?php
/**
 * Category Sources plugin for Craft CMS 3.x
 *
 * View your entries by their category-based taxonomies in Craft
 *
 * @link      https://glue.be
 * @copyright Copyright (c) 2019 Glue
 */

namespace glueagencygluecategorysources\gluecategorysources;

use glueagencygluecategorysources\gluecategorysources\models\Settings;

use Craft;
use craft\base\Plugin;
use craft\base\Element;

use craft\elements\Entry;
use craft\elements\Category;

use craft\services\Plugins;

use craft\events\PluginEvent;
use craft\events\RegisterElementSourcesEvent;

use craft\models\CategoryGroup;
use craft\models\CategoryGroup_SiteSettings;

use yii\base\Event;

/**
 * Class GlueCategorySources
 *
 * @author    Glue
 * @package   GlueCategorySources
 * @since     1.0.0
 *
 */
class GlueCategorySources extends Plugin
{
    public static $plugin;
    public $schemaVersion = '1.0.0';

    private $_rootCategoryIds = array();

    public function init()
    {
        parent::init();
        self::$plugin = $this;

        Event::on(Entry::class, Element::EVENT_REGISTER_SOURCES, function (RegisterElementSourcesEvent $event) {

            $selectedGroups = $this->getSettings()->categoryGroups;

            if (!$selectedGroups)
    		{
    			$selectedGroups = Craft::$app->getCategories()->getAllGroupIds();
    		}

            foreach ($selectedGroups as $groupId)
    		{
    			$group = Craft::$app->getCategories()->getGroupById($groupId);
                $event->sources[] = [
                    'heading' => \Craft::t('site', $group->name),
                ];
    			$lastSourceByLevel = array();

                $categories = Category::find()
                    ->groupId($groupId)
                    ->all();

    			foreach ($categories as $category)
    			{
    				$l = 'l'.$category->level;
                    $n = $category->title;

                    $event->sources[] = [
                        'key' => 'cat:'.$category->id,
                        'label' => $n,
                        'criteria' => ['relatedTo' => array('targetElement' => $category->id)]
                    ];
    			}

            }

        });

    }

    protected function createSettingsModel()
    {
        return new Settings();
    }

    protected function settingsHtml(): string
    {
        $groups = Craft::$app->getCategories()->getAllGroups();
        $selectedGroups = $this->getSettings()->categoryGroups;
        $groupOptions = array();

        foreach ($groups as $group) {
            $groupOptions[] = array('label' => $group->name, 'value' => $group->id);
        }

        return Craft::$app->view->renderTemplate(
            'category-sources/settings',
            [
                'settings' => $this->getSettings(),
                'options' => $groupOptions,
                'values' => $selectedGroups
            ]
        );
    }
}
