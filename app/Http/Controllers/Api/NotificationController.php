<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\NotificationResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function notification()
    {
        $notifications['list'] = auth('api')->user()->notifications;
        
        $notifications['count'] = auth('api')->user()->unreadNotifications->count();
        return $this->responseWithSuccess($notifications,'Notification list');
    }


    public function countNotification(): JsonResponse
    {
        $countNotifications = auth('api')->user()->unreadNotifications->count();
        return $this->responseWithSuccess($countNotifications,'Unread notification.');
    }


    public function markNotification($id): JsonResponse
    {
        $data = auth('api')->user()->unreadNotifications->where('id',$id);
        if(count($data)>0)
        {
            $data->markAsRead();
            return $this->responseWithSuccess(null,'Notification marked as read.');
        }

        return $this->responseWithSuccess(null,'No notification found');
    }
}
