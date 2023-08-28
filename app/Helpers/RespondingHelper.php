<?php
// app/Helpers/RespondingHelper.php

namespace App\Helpers;

class RespondingHelper
{
    public static function respond($data, $message, $status = 'success', $redirectTo = null)
    {
        if (request()->ajax()) {
            return response()->json([
                'status' => $status,
                'message' => $message,
                'data' => $data,
            ]);
        } else {
            if ($redirectTo === 'back') {
                return redirect()->back()->with($status, $message);
            } elseif ($redirectTo) {
                return redirect()->route($redirectTo)->with($status, $message);
            } else {
                // Default behavior, return a view or something else
            }
        }
    }

}
