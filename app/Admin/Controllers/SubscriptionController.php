<?php

namespace App\Admin\Controllers;

use App\Models\Subscription;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class SubscriptionController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Subscription';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */

     protected function grid()
    {
        $grid = new Grid(new Subscription());

        $grid->model()->where('stripe_status', 'active'); // stripe_statusがactiveのレコードのみを表示

        $grid->column('id', __('Id'))->sortable();
        $grid->column('user_id', __('User id'))->sortable();
        $grid->column('stripe_status', __('Stripe status'));
        $grid->column('quantity', __('Quantity'))->totalRow();
        $grid->column('created_at', __('Created at'))->sortable();

        $grid->filter(function($filter) {
            $filter->disableIdFilter();
            $filter->equal('id', 'ID');
            $filter->equal('user_id', 'User ID');
            $filter->between('created_at', '登録日')->datetime();
        });

        $grid->disableCreateButton();
        $grid->actions(function ($actions) {
            $actions->disableDelete();
            $actions->disableEdit();
            $actions->disableView();
        });

        // activeなレコードの数を取得
        $activeCount = Subscription::where('stripe_status', 'active')->count();
        // 合計金額を計算
        $totalAmount = $activeCount * 300;

        $totalText = "合計金額：サブスク登録 {$activeCount} 件 × 300円 = {$totalAmount} 円です。";
        
        return '<div>' . $totalText . '</div>'. $grid->render() ;
    }

}
