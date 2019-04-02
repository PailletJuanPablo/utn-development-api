<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\NotificationSubscription;

class NotificationsController extends Controller
{
    public function setSubscriptions(Request $request)
    {
        $requestedSchools = $request->schools;
        $requestedCategories = $request->categories;

        if($request->token){
            NotificationSubscription::where('token', $request->token)->delete();
        }


        $subscriptionsCreated = [];
        foreach ($requestedSchools as $requestedSchool) {
            $subscriptionToCreate = new NotificationSubscription();
            $subscriptionToCreate->user_id = $request->user_id;
            $subscriptionToCreate->school_id = $requestedSchool['id'];
            $subscriptionToCreate->token = $request->token ? $request->token : null;
            $subscriptionToCreate->save();
            array_push($subscriptionsCreated, $subscriptionToCreate);
        }

        foreach ($requestedCategories as $requestedCategory) {
            if ($requestedCategory) {
                $subscriptionToCreate = new NotificationSubscription();
                $subscriptionToCreate->user_id = $request->user_id;
                $subscriptionToCreate->category_id = $requestedCategory['id'];
                $subscriptionToCreate->token = $request->token ? $request->token : null;
                $subscriptionToCreate->save();
                array_push($subscriptionsCreated, $subscriptionToCreate);
            }
        }

        return response()->json(['created' => $subscriptionsCreated]);
    }
}
