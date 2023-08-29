<?php
// app/Helpers/getNewClientsHelper.php
function getNewClients()
{
    $oneDayAgo = \Illuminate\Support\Carbon::now()->subDay();
    return \App\Models\Client::where('created_at', '>=', $oneDayAgo)->select('id', 'name', 'surname', 'phone', 'created_at')->get();
}
