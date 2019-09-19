## Yii2-columnlistview
Yii2-columnlistview for building a responsive column layout like boostrap
This is ideal for portfolio style layout of model/s content

---

## Feature

Default display column is 1

For example:

	col-lg-12
	col-sm-12
	col-md-12
	col-xs-12

Easily configurable for custom layouts

Generates fully responsive columns

---

## Installation

Either run:

	php composer.phar require songchiva/yii2-columnlistview "dev-master"


Or: add

	"songchiva/yii2-columnlistview": "dev-master"

to the require section of your composer.json file.

Then run: 

	composer update

---

## Basic usage

	use songchiva\widgets\ColumnListView;
	echo ColumnListView::widget([
		'dataProvider' => $dataProvider,

		'columns' => 3, // 3 columns will be displayed. You can set from value 2 to 12 of colunms property
		'layout' => '',
		'emptyText' => '', //error message if no data found in db
		'itemView' => '_itemDetail', //render the view: _itemDetail (single view)
		'summary' => '<span 
				class="mbottom10 btn" 
				style="background-color: #50CBFB; color: #FFF;"> 
				Show Internship List {count} of Total {totalCount}
			      </span>',
		 //...........
	]);

---

