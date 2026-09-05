<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

abstract class ApiController extends Controller
{
    protected function perPage(Request $request): int
    {
        return min(max((int) $request->query('per_page', 15), 1), 50);
    }

    protected function apiUser(Request $request): User
    {
        /** @var User $user */
        $user = $request->user();

        return $user;
    }

    protected function authorizeDashboard(Request $request): void
    {
        abort_unless($this->apiUser($request)->canAccessDashboard(), 403, 'Forbidden');
    }

    protected function authorizeClients(Request $request): void
    {
        abort_unless($this->apiUser($request)->canAccessClients(), 403, 'Forbidden');
    }

    protected function authorizeClientsRead(Request $request): void
    {
        abort_unless($this->apiUser($request)->hasStaffPermission('clients.read'), 403, 'Forbidden');
    }
}
