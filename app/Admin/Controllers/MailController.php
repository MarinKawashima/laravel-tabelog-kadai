<?php

namespace App\Admin\Controllers;

use App\Models\Mail;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class MailController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Mail';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Mail());

        $grid->column('id', __('Id'));
        $grid->column('subject', __('Subject'));
        $grid->column('line1', __('Line1'));
        $grid->column('action', __('Action'));
        $grid->column('line2', __('Line2'));
        $grid->column('line3', __('Line3'));
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));

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
        $show = new Show(Mail::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('subject', __('Subject'));
        $show->field('line1', __('Line1'));
        $show->field('action', __('Action'));
        $show->field('line2', __('Line2'));
        $show->field('line3', __('Line3'));
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
        $form = new Form(new Mail());

        $form->text('subject', __('Subject'));
        $form->textarea('line1', __('Line1'));
        $form->text('action', __('Action'));
        $form->textarea('line2', __('Line2'));
        $form->textarea('line3', __('Line3'));

        return $form;
    }
}
