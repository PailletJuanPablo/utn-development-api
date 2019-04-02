<?php

namespace App\Helpers;

use Exception;
use OneSignal;
use Illuminate\Support\Carbon;
use App\Notification;
use App\User;
use Illuminate\Support\Facades\Log;

class OneSignalHelper
{


    /**
     * PushHelper constructor.
     */
    public function __construct()
    { }

    /**
     * @param $data
     * @return bool
     * @throws
     */
    public function sendGeneral($notificationToCreate)
    {
        try {
            $notification = new Notification();
            $notification->fill($notificationToCreate);
            $notification->save();
            $now = Carbon::now();
            OneSignal::sendNotificationToAll(
                $notification->description,
                $url = null,
                $data =
                    [
                        "notificationId" => $notification->id
                    ],
                $buttons = null,
                $schedule = $now->toDateTimeString(),
                $headings = $notification->title
            );
            return $notification;
        } catch (Exception $e) {
            return $e;
        }
    }

    public function sendCustom($post)
    {
        $filters = [];
        foreach ($post->schools as $school) {
            if($school){
                $field_filter = ["field" => "tag", "key" => "school_id_" . $school->id, "relation" => "=", "value" => "true"];
                $or_filter =     ['operator' => 'OR'];

                array_push($filters, $field_filter);
                array_push($filters, $or_filter);
            }
        }


        if($post->category){
            $field_filter = ["field" => "tag", "key" => "category_id" . $post->category->id, "relation" => "=", "value" => "true"];
            $or_filter = ['operator' => 'OR'];
            array_push($filters, $field_filter);
            array_push($filters, $or_filter);
        }

        Log::info('sending notif', $filters);
        try {
            $notification = OneSignal::sendNotificationUsingTags(
                $post->title,
                $filters,
                $url = null,
                $data =
                    [
                        "type" => "post",
                        "postId" => $post->id
                    ],
                $buttons = null,
                $schedule = null,
                $headings = "¡Nueva publicación!"
            );
            // This means an error
            if($notification){
                Log::info('after sending notif', $notification);
            }

            return $notification;
        } catch (Exception $e) {
            throw $e;
        }
    }
}
