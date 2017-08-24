<?php namespace VojtaSvoboda\Reviews\Components;

use Config;
use Request;
use Cms\Classes\ComponentBase;
use October\Rain\Support\Facades\Flash;
use VojtaSvoboda\Reviews\Models\Review;

class Form extends ComponentBase
{

    public function componentDetails()
    {
        return [
            'name'        => 'Review form',
            'description' => 'Form for sending review'
        ];
    }

    public function onRun()
    {
    }

    public function onRender()
    {
    }

    public function onSubmit()
    {
        // get input
        $data = post();

        // create review
        $review = new Review;
        $review->fill($data);
        $review->ip = Request::ip();
        $review->approved = false;

        if ($review->save()) {
            Flash::success('Success!');

            return [
                'status' => 'ok'
            ];
        } else {
            Flash::error('Error!');

            return [
                'status' => 'fail',
                'errors' => $review->errors()->jsonSerialize(),
            ];
        }
    }

}