<?php

namespace App\Admin\Controllers;

use App\Models\Reservation;
use App\Models\User;
use App\Models\Restaurant;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class ReservationController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Reservation';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Reservation());

        $grid->column('id', __('Id'));
        $grid->column('user_id', __('User id'));
        $grid->column('user.name', __('User Name')); // ユーザー名を表示
        $grid->column('restaurant_id', __('Restaurant id'));
        $grid->column('restaurant.name', __('Restaurant Name')); // 店舗名を表示
        $grid->column('start_time', __('Start time'));
        $grid->column('num_of_guests', __('Num of guests'));
        $grid->column('created_at', __('Created at'));
        $grid->column('reservation_date', __('Reservation date'));
        $grid->column('fee_price', __('Fee price'));

        $grid->filter(function($filter) {
            $filter->like('user_id', 'ユーザーID');
            $filter->like('user.name', 'ユーザー名'); // ユーザー名で検索できるようにする
            $filter->like('restaurant_id', '店舗ID');
            $filter->like('restaurant.name', '店舗名'); // 店舗名で検索できるようにする
            $filter->between('created_at', '登録日')->datetime();
            $filter->like('fee_price', '手数料');

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
        $show = new Show(Reservation::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('user_id', __('User id'));
        $show->field('user.name', __('User Name')); // ユーザー名を表示
        $show->field('restaurant_id', __('Restaurant id'));
        $show->field('restaurant.name', __('Restaurant Name')); // 店舗名を表示
        $show->field('start_time', __('Start time'));
        $show->field('num_of_guests', __('Num of guests'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));
        $show->field('reservation_date', __('Reservation date'));
        $show->field('fee_price', __('Fee price'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Reservation());

        $form->number('user_id', __('User id'));
        $form->number('restaurant_id', __('Restaurant id'));
        $form->time('start_time', __('Start time'))->default(date('H:i:s'));
        $form->number('num_of_guests', __('Num of guests'));
        $form->date('reservation_date', __('Reservation date'))->default(date('Y-m-d'));
        $form->number('fee_price', __('Fee price'));

        return $form;
    }
}
