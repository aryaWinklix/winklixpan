<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Feedback;
use App\Item;

class FeedbackController extends Controller
{
    public function getFeedbacks()
    {
    	$feedbacks = Feedback::all();
    	$items = Item::all();
    	$finalarray = array();
    	foreach ($items as $item) {
    		foreach ($feedbacks as $feedback) {
    			if(in_array($item->id, explode(',',$feedback->selected_snacks)))
    			{
    				$item_name =Item::where('id',$item->id)->first()->name;
    				// echo $item_name;
    				// exit();
    				if(array_key_exists($item_name, $finalarray))
    				{

    					$finalarray[$item_name]=$finalarray[$item_name]+1;
    				}
    				else
    				{
    				$finalarray[$item_name]=1;
    			}
    			}
    		}
    	}
    	$finalarray['totalFeedbacks']=count($feedbacks);
    	//echo count($feedbacks);
    	// echo "<pre>";
    	// 		print_r($finalarray);
    	// exit();
        return view('admin.feedback.index')->with('feedbacks',$finalarray);
    }
}
