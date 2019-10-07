<?php
/**
 * Category Sources plugin for Craft CMS 3.x
 *
 * View your entries by their category-based taxonomies in Craft
 *
 * @link      https://glue.be
 * @copyright Copyright (c) 2019 Glue
 */

namespace glueagencygluecategorysources\gluecategorysources\models;

use glueagencygluecategorysources\gluecategorysources\GlueCategorySources;

use Craft;
use craft\base\Model;

/**
 * @author    Glue
 * @package   GlueCategorySources
 * @since     1.0.0
 */
class Settings extends Model
{

    public $categoryGroups = [];

    public function rules()
    {
        return [
            ['categoryGroups', 'default', 'value' => []],
        ];
    }
}
