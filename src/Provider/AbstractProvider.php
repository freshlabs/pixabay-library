<?php

/*
 * This file is part of the pixabay-library package.
 *
 * (c) 2019 WEBEWEB
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace WBW\Library\Pixabay\Provider;

use DateTime;
use Exception;
use GuzzleHttp\Client;
use InvalidArgumentException;
use Psr\Log\LoggerInterface;
use WBW\Library\Pixabay\Exception\APIException;
use WBW\Library\Pixabay\Model\AbstractRequest;
use WBW\Library\Pixabay\Traits\RateLimitTrait;

/**
 * Abstract provider.
 *
 * @author webeweb <https://github.com/webeweb/>
 * @package WBW\Library\Pixabay\Provider
 */
abstract class AbstractProvider {

    use RateLimitTrait;

    /**
     * Endpoint path.
     *
     * @var string
     */
    const ENDPOINT_PATH = "https://pixabay.com/api";

    /**
     * Debug.
     *
     * @var bool
     */
    private $debug;

    /**
     * Key.
     *
     * @var string
     */
    private $key;

    /**
     * Logger.
     *
     * @var LoggerInterface
     */
    private $logger;

    /**
     * Constructor.
     *
     * @param string $key The key.
     * @param LoggerInterface|null $logger The logger.
     */
    public function __construct($key = null, LoggerInterface $logger = null) {
        $this->setDebug(false);
        $this->setKey($key);
        $this->setLogger($logger);
    }

    /**
     * Build the configuration.
     *
     * @return array Returns the configuration.
     */
    private function buildConfiguration() {
        return [
            "base_uri"    => self::ENDPOINT_PATH . "/",
            "debug"       => $this->getDebug(),
            "headers"     => [
                "Accept"     => "application/json",
                "User-Agent" => "webeweb/pixabay-library",
            ],
            "synchronous" => true,
        ];
    }

    /**
     * Call the API.
     *
     * @param AbstractRequest $request The request.
     * @param array $queryData The query data.
     * @return string Returns the raw response.
     * @throws APIException Throws an API exception if an error occurs.
     * @throws InvalidArgumentException Throws an invalid argument exception if a parameter is missing.
     */
    protected function callAPI(AbstractRequest $request, array $queryData) {

        if (null === $this->getKey()) {
            throw new InvalidArgumentException("The mandatory parameter \"key\" is missing");
        }

        try {

            $config = $this->buildConfiguration();

            $client = new Client($config);

            $method  = "GET";
            $uri     = substr($request->getResourcePath(), 1);
            $options = [
                "query" => array_merge(["key" => $this->getKey()], $queryData),
            ];

            $this->log(sprintf("Call Pixabay API %s %s", $method, $uri), ["config" => $config, "options" => $options]);

            $response = $client->request($method, $uri, $options);

            $this->setLimit(intval($response->getHeaderLine("X-Ratelimit-Limit")));
            $this->setRemaining(intval($response->getHeaderLine("X-Ratelimit-Remaining")));
            $this->setReset(new DateTime("@" . $response->getHeaderLine("X-Ratelimit-Reset")));

            return $response->getBody()->getContents();
        } catch (Exception $ex) {

            throw new APIException("Call Pixabay API failed", $ex);
        }
    }

    /**
     * Get the debug.
     *
     * @return bool Returns the debug.
     */
    public function getDebug() {
        return $this->debug;
    }

    /**
     * Get the key.
     *
     * @return string Returns the key.
     */
    public function getKey() {
        return $this->key;
    }

    /**
     * Get the logger.
     *
     * @return LoggerInterface Returns the logger.
     */
    public function getLogger() {
        return $this->logger;
    }

    /**
     * Log.
     *
     * @param string $message The message.
     * @param array $context The context.
     * @return AbstractProvider Returns this provider.
     */
    protected function log($message, array $context) {
        if (null !== $this->getLogger()) {
            $this->getLogger()->info($message, $context);
        }
        return $this;
    }

    /**
     * Set the debug.
     *
     * @param bool $debug The debug.
     * @return AbstractProvider Returns this provider.
     */
    public function setDebug($debug) {
        $this->debug = $debug;
        return $this;
    }

    /**
     * Set the key.
     *
     * @param string $key The key.
     * @return AbstractProvider Returns this provider.
     */
    public function setKey($key) {
        $this->key = $key;
        return $this;
    }

    /**
     * Set the logger.
     *
     * @param LoggerInterface|null $logger The logger
     * @return AbstractProvider Returns this provider
     */
    protected function setLogger(LoggerInterface $logger = null) {
        $this->logger = $logger;
        return $this;
    }
}
