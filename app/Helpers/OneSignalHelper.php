<?php

namespace App\Helpers;

use Exception;
use OneSignal;
use Illuminate\Support\Carbon;
use App\Notification;
use App\User;
class OneSignalHelper
{


    /**
     * PushHelper constructor.
     */
    public function __construct()
    {

    }

    /**
     * @param $data
     * @return bool
     * @throws
     */
    public function sendGeneral($notificationToCreate)
    {
        try{
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
        }
        catch(Exception $e){
            return $e;
        }

    }

    public function sendCustom($notificationToCreate)
    {

        try{
            $db_notification = new Notification();
            $db_notification->fill($notificationToCreate);
            $db_notification->save();
            $tags = array(
                ["field" => "tag", "key" => "general", "relation" => "=", "value" => "true"],
            );
           if($db_notification->school_id){
                array(
                    ["field" => "tag", "key" => "general", "relation" => "=", "value" => "true"],
                    ["field" => "tag", "key" => "school_id_" . $db_notification->school_id, "relation" => "=", "value" => "true"],
                );
            }

          $notification = OneSignal::sendNotificationUsingTags(
                $db_notification->title,
                $tags,
                $url = null,
                $data =
                [
                    "type" => "post",
                    "notificationId" => $db_notification->id
                ],
                $buttons = null,
                $schedule = null,
                $headings = "¡Nueva publicación!"
            );
            return $notification;
        }  catch(Exception $e){
            return $e;
        }
    }





}
