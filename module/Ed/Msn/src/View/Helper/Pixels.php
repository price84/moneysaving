<?php

namespace Ed\Msn\View\Helper;

use Zend\View\Helper\AbstractHelper;
use Zend\Session\Container as SessionContainer;
use Ed\Hits\Service\TrackingService;
use Ed\Website\Service\PageService;
use Ed\Pixels\Service\PixelProvider;
use Ed\Applications\Service\ApplicationService;

/**
 * View helper to manage the display of our disclaimers
 */
class Pixels extends AbstractHelper
{
    /**
     * @var \Zend\Session\Container
     */
    protected $session;

    /**
     * @var \Ed\Applications\Service\ApplicationService
     */
    protected $applicationService;

    /**
     * @var \Ed\Hits\Service\TrackingService
     */
    protected $trackingService;

    /**
     * @var \Ed\Website\Service\PageService
     */
    protected $pageService;

    /**
     * @var \Ed\Pixels\Service\PixelProvider
     */
    protected $pixelProvider;

    /**
     * @var boolean
     */
    protected $isDev;

    /**
     * @var bool
     */
    protected $debugPixels = false;

    public function __construct(SessionContainer $session, ApplicationService $applicationService, PageService $pageService, TrackingService $trackingService, PixelProvider $pixelProvider, $isDev)
    {
        $this->session = $session;
        $this->applicationService = $applicationService;
        $this->trackingService = $trackingService;
        $this->pageService = $pageService;
        $this->pixelProvider = $pixelProvider;
        $this->isDev = (bool)$isDev;
    }

    /**
     * Is the current page one of the ones specified in $pageNames (array of strings)
     *
     * @param string[] $pageNames
     * @return boolean
     */
    public function pageNameIn(array $pageNames)
    {
        $page = $this->pageService->getPage();
        return in_array($page->getName(), $pageNames);
    }

    /**
     * Is the current page a "submitted" action?
     *
     * @return boolean
     */
    public function isSubmittedAction()
    {
        $submittedActions = ["thank-you"];

        if ($this->pageNameIn($submittedActions)) {
            return true;
        }

        return false;
    }

    public function getSubmittedPagePixels()
    {
        $pixelString = '';

        // Traffic specific conversion pixels
        // Only display those pixels if we have personal details in the app
        $app = $this->applicationService->getApplicationFromSession();

        if (!$app->hasAttribute('noPersonalDetails') || ($app->hasAttribute('noPersonalDetails') && $app->getAttribute('noPersonalDetails') != '1')) {
            // Fire the conversion pixels and save trackingPixelFired in session so we only fire them once
            if (!$this->session->offsetExists('trackingPixelFired') || !$this->session->trackingPixelFired) {
                $trackingPixel = $this->pixelProvider->getPixel($app);
                if (!empty($trackingPixel)) {
                    $this->session->trackingPixelFired = true;
                    $pixelString .= $trackingPixel->getCodeHtml();
                }
            }
        }

        return $pixelString;
    }

    public function getGooglePixels()
    {
        return "<script>
            (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function()
            { (i[r].q=i[r].q||[]).push(arguments)}
            ,i[r].l=1*new Date();a=s.createElement(o),
            m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
            })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
            ga('create', 'UA-49497270-1', 'auto');
            ga('send', 'pageview');
            </script>";
    }

    /**
     * Build the pixels for the current page
     *
     * @return string
     */
    public function buildPixels()
    {
        $pixelString = '';

        if ($this->isSubmittedAction()) {
            $pixelString .= $this->getSubmittedPagePixels();
        }

        $pixelString .= $this->getGooglePixels();

        return $pixelString;
    }

    /**
     * This method exists so we can call it directly and not have a case of the
     * "__toString must not throw exception" problem if something inside this
     * class throws an exception.
     *
     * @return string
     */
    public function toString()
    {
        if (!$this->trackingService->isInitialised()) {
            return '';
        }
        if ($this->debugPixels) {
            return '<h3>Pixels for testing</h3><textarea rows="30" cols="100">' . htmlentities($this->buildPixels()) . '</textarea><br /><br /><br /><br />';
        } elseif ($this->isDev) {
            return '';
        } else {
            return $this->buildPixels();
        }
    }

    /**
     * Proxy to toString.
     *
     * @return string
     */
    public function __toString()
    {
        return $this->toString();
    }

    /**
     *
     * @return \Ed\Msn\View\Helper\Pixels
     */
    public function __invoke()
    {
        return $this;
    }
}
