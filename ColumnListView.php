<?php

namespace songchiva\widgets;

use yii\helpers\Html;
use yii\helpers\ArrayHelper;

/**
 * The ColumnListView widget is used to display data from a data
 * provider in a (fully responsive) columnar layout. Each data model is rendered
 * using the view specified.
 *
 * @Author Chiva Song chiva.song@hotmail.com
 * @Role Developer
 * @Location Phnom Penh, Cambodia
 * @Year 2019
 */
class ColumnListView extends \yii\widgets\ListView
{
    /*
     * Bootstrap size suffixes
     */
    const SIZE_TINY = 'xs';
    const SIZE_SMALL = 'sm';
    const SIZE_MEDIUM = 'md';
    const SIZE_LARGE = 'lg';

    /*
     * @var int the number of columns to display (1-12 of bootstrap grid).
     */
    public $columns = 1;

    /*
     * @var array the HTML attributes for the container tag of the row.
     */
    public $rowOptions = ['class' => 'row'];

    /*
     * @var bool create rows
     */
    public $createRows = true;

    /*
     * @var array the HTML attributes for the container tag of the row.
     */
    public $columnsLayout = [
      2 => [// col-xx-2
        2 => [ self::SIZE_SMALL, self::SIZE_MEDIUM, self::SIZE_LARGE],
      ],
      3 => [// col-xx-3
        3 => [self::SIZE_MEDIUM, self::SIZE_LARGE, self::SIZE_SMALL],
      ],
      4 => [// col-xx-4
        4 => [self::SIZE_MEDIUM, self::SIZE_LARGE, self::SIZE_SMALL],
      ],
      5 => [// col-xx-5
        5 => [self::SIZE_MEDIUM, self::SIZE_LARGE, self::SIZE_SMALL],
      ],
      6 => [// col-xx-6
        6 => [ self::SIZE_MEDIUM, self::SIZE_LARGE, self::SIZE_SMALL ],
      ],
      7 => [// col-xx-7
        7 => [ self::SIZE_MEDIUM, self::SIZE_LARGE, self::SIZE_SMALL ],
      ],
      8 => [// col-xx-8
        8 => [ self::SIZE_MEDIUM, self::SIZE_LARGE, self::SIZE_SMALL ],
      ],
      9 => [// col-xx-9
        9 => [ self::SIZE_MEDIUM, self::SIZE_LARGE, self::SIZE_SMALL ],
      ],
      10 => [// col-xx-10
        10 => [ self::SIZE_MEDIUM, self::SIZE_LARGE, self::SIZE_SMALL ],
      ],
      11 => [// col-xx-11
        11 => [ self::SIZE_MEDIUM, self::SIZE_LARGE, self::SIZE_SMALL ],
      ],
      12 => [// col-xx-12
        12 => [ self::SIZE_MEDIUM, self::SIZE_LARGE, self::SIZE_SMALL ],
      ],
    ];

    /**
     * @inheritdoc
     */
    public function renderItems()
    {
        if ($this->columns < 2) {
            parent::renderItems();
            return;
        }

        $models = $this->dataProvider->getModels();
        $keys = $this->dataProvider->getKeys();
        $rows = [];
        $layouts = ArrayHelper::getValue($this->columnsLayout, $this->columns, []);
        $this->itemOptions = (empty($this->itemOptions)) ? $this->buildItemOptions($layouts) : $this->itemOptions;

        foreach (array_values($models) as $index => $model) {
          $rows[] = $this->renderItem($model, $keys[$index], $index);

          // set a clearfix breaks for responsive columns
          if ($this->createRows) {
              $clearRows = $this->buildClearFixTag($layouts, $index+1);
              if (empty($clearRows)) { continue; }
              $rows[] = implode("\n", $clearRows);
          }
        }

        return Html::beginTag('div', $this->rowOptions).implode($this->separator, $rows).Html::endTag('div');
    }

    private function buildClearFixTag($colBreaks = [], $index)
    {
      if (empty($colBreaks)) { return []; }
      $clears = [];
      foreach ($colBreaks as $col => $sizes) {
        if ($index % $col !== 0 ) { continue; }
        if (is_string($sizes)) {
          $clears[] = Html::tag('div', '', ['class' => 'clearfix visible-'.$sizes]);
          continue;
        }

        $clearOpts = 'clearfix visible-'.implode(' visible-',$sizes);
        $clears[] = Html::tag('div', '', ['class' => $clearOpts]);
      }

      return $clears;
    }

    private function buildItemOptions($colOptions)
    {
      if (empty($colOptions)) { return []; }

      $opts = '';
      foreach ($colOptions as $cols => $sizes)
      {
        if (is_string($sizes)) {
          $opts .= ' col-'.$sizes.'-'.(12/$cols);
        } else {
          foreach ($sizes as $aSize) {
            $opts .= ' col-'.$aSize.'-'.(12/$cols);
          }
        }
      }

      return ['class' => $opts];
    }
}
