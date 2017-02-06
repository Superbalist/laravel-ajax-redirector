<?php

namespace Superbalist\AjaxRedirector;

use Illuminate\Routing\Redirector as BaseRedirector;

class Redirector extends BaseRedirector
{
    /**
     * Create a new redirect response.
     *
     * @param string $path
     * @param int $status
     * @param array $headers
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function createRedirect($path, $status, $headers)
    {
        $request = $this->generator->getRequest();
        if ($request->ajax()) {
            // for ajax requests, we don't want to return a typical 301 or 302 redirect since the ajax request
            // will follow that and not actually redirect the browser, which is likely our intention
            // we therefore return a json response via our AjaxRedirectResponse class
            $redirect = new AjaxRedirectResponse($path, 278, $headers);

            if (isset($this->session)) {
                $redirect->setSession($this->session);
            }

            $redirect->setRequest($this->generator->getRequest());

            return $redirect;
        } else {
            return parent::createRedirect($path, $status, $headers);
        }
    }
}
