<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

/**
 * Ensures certification POSTs from our fetch() client get JSON validation/error responses.
 * Without this, proxies may strip Accept / X-Requested-With; Laravel then redirects with HTML,
 * fetch follows the redirect, and the client sees HTTP 200 + HTML instead of JSON.
 *
 * We also honour a POST body flag (_certification_json_response) because some WAFs strip
 * custom headers while leaving the form body intact.
 */
class PrepareCertificationAjaxJson
{
    /** @internal Must match the field appended by resources/views/certification/form.blade.php */
    public const JSON_RESPONSE_BODY_FLAG = '_certification_json_response';

    public function handle(Request $request, Closure $next)
    {
        if (! $request->isMethod('POST')) {
            return $next($request);
        }

        if (! $this->isCertificationSubmitPath($request)) {
            return $next($request);
        }

        if (! $this->certificationPostWantsJsonResponse($request)) {
            return $next($request);
        }

        $request->headers->set('Accept', 'application/json', true);

        if (! $request->headers->has('X-Requested-With')) {
            $request->headers->set('X-Requested-With', 'XMLHttpRequest');
        }

        return $next($request);
    }

    private function certificationPostWantsJsonResponse(Request $request): bool
    {
        if ($this->clientMarksCertificationAjax($request)) {
            return true;
        }

        return (string) $request->input(self::JSON_RESPONSE_BODY_FLAG, '') === '1';
    }

    private function isCertificationSubmitPath(Request $request): bool
    {
        return $request->is('lms/certification', 'lms/certification/support')
            || $request->is('*/lms/certification', '*/lms/certification/support');
    }

    /**
     * Recognise our fetch() client even if some proxies alter headers differently.
     */
    private function clientMarksCertificationAjax(Request $request): bool
    {
        $marker = (string) $request->header('X-Certification-Ajax', '');

        return $marker === '1' || strcasecmp($marker, 'true') === 0;
    }
}
