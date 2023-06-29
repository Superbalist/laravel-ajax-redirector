<?php

namespace Superbalist\AjaxRedirector;

use Illuminate\Http\RedirectResponse;

class AjaxRedirectResponse extends RedirectResponse
{
    /**
     * Sets the redirect target of this response.
     *
     * @param string $url The URL to redirect to
     *
     * @throws \InvalidArgumentException
     *
     * @return RedirectResponse The current response.
     */
    public function setTargetUrl($url)
    {
        if (empty($url)) {
            throw new \InvalidArgumentException('Cannot redirect to an empty URL.');
        }

        $this->targetUrl = $url;

        $data = [
            'redirect_url' => $url,
        ];

        $this->setContent(json_encode($data));
        $this->headers->set('Content-Type', 'application/json');

        return $this;
    }

    /**
     * Is the response a redirect of some form?
     *
     * @param string $location
     *
     * @return bool
     */
    public function isRedirect(string $location = null): bool
    {
        return true;
    }
}
