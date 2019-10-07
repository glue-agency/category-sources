<?php
/**
 * Category Sources plugin for Craft CMS 3.x
 *
 * View your entries by their category-based taxonomies in Craft
 *
 * @link      https://glue.be
 * @copyright Copyright (c) 2019 Glue
 */

namespace glueagencygluecategorysources\gluecategorysources\assetbundles\GlueCategorySources;

use Craft;
use craft\web\AssetBundle;
use craft\web\assets\cp\CpAsset;

/**
 * @author    Glue
 * @package   GlueCategorySources
 * @since     1.0.0
 */
class GlueCategorySourcesAsset extends AssetBundle
{
    // Public Methods
    // =========================================================================

    /**
     * @inheritdoc
     */
    public function init()
    {
        $this->sourcePath = "@glueagencygluecategorysources/gluecategorysources/assetbundles/gluecategorysources/dist";

        $this->depends = [
            CpAsset::class,
        ];

        $this->js = [
            'js/GlueCategorySources.js',
        ];

        $this->css = [
            'css/GlueCategorySources.css',
        ];

        parent::init();
    }
}
