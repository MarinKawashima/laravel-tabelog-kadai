<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Controllers\category_restaurantController;
use App\Models\Restaurant;
use App\Models\Category;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Illuminate\Http\Request;

class RestaurantController extends AdminController
{

    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Restaurant';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        
        $grid = new Grid(new Restaurant());

        $grid->column('id', __('Id'))->sortable();
        $grid->column('name', __('Name'));
        $grid->column('description', __('Description'));
        $grid->column('postal_code', __('Postal code'));
        $grid->column('address', __('Address'));
        $grid->column('phone', __('Phone'));
        $grid->column('opening_hours', __('Opening hours'));
        $grid->column('regular_holiday', __('Regular holiday'));
        $grid->column('budget', __('Budget'))->sortable();
        // $grid->column('category.name', __('Category Name'));
        $grid->categories()->display(function ($categories) {
            $categories = array_map(function ($category) {
                return "<span class='label label-success'>{$category['name']}   </span>";
            }, $categories);
    
            return join('&nbsp;', $categories);
        });
         $grid->column('image', __('Image'))->image();
        $grid->column('created_at', __('Created at'))->sortable();
        $grid->column('updated_at', __('Updated at'))->sortable();

        $grid->filter(function($filter) {
            $filter->like('name', '店舗名');
            $filter->like('description', '店舗説明');
            $filter->between('price', '予算');
            // $filter->in('category_id', 'カテゴリー')->multipleSelect(Category::all()->pluck('name', 'id'));
        });
        
        return $grid;
        
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(Restaurant::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('name', __('Name'));
        $show->field('description', __('Description'));
        $show->field('postal_code', __('Postal code'));
        $show->field('address', __('Address'));
        $show->field('phone', __('Phone'));
        $show->field('opening_hours', __('Opening hours'));
        $show->field('regular_holiday', __('Regular holiday'));
        $show->field('budget', __('Budget'));
        $grid->field('category.name', __('Category Name'));
         $grid->field('image', __('Image'))->image();
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Restaurant());

        $form->text('name', __('Name'));
        $form->textarea('description', __('Description'));
        $form->text('postal_code', __('Postal code'));
        $form->textarea('address', __('Address'));
        $form->mobile('phone', __('Phone'));
        $form->text('opening_hours', __('Opening hours'));
        $form->text('regular_holiday', __('Regular holiday'));
        $form->number('budget', __('Budget'));
        // 多対多の関係にあるカテゴリーの選択肢を表示する
        $form->multipleSelect('categories')->options(Category::all()->pluck('name', 'id'));
        $form->image('image', __('Image'));

        return $form;
    }
}