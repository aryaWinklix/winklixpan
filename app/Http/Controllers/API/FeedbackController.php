<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Feedback;
class FeedbackController extends Controller
{
    public function addFeedback(Request $request)
    {
            //return $request;
    	//return $ABC = Feedback::where('id',7)->first();
            $feedback = new Feedback;
            $feedback->user_id = $request->user_id;
            $feedback->selected_snacks = $request->selected_snacks;
            $feedback->how_often = $request->how_often;
            $feedback->comments = $request->comments;
            // $abc = unserialize($feedback->selected_snacks);
            // echo $abc[0];
            // exit();
            if ($feedback->save()) {
                 //return "true";
                $res = [
                    'status' => 'success',
                    'message' => 'Feedback Added Successfully',
                    // 'feedbackDetails' => $feedback,
                ];
                return $res;
            }else{
                // return "false";
                $res = [
                    'status' => 'failure',
                    'message' => 'feedback Not Added',
                ];
                return $res;
            }
         

    }
}
