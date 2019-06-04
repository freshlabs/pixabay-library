<?php

/*
 * This file is part of the pixabay-library package.
 *
 * (c) 2019 WEBEWEB
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace WBW\Library\Pixabay\Tests\Fixtures\Provider;

use WBW\Library\Pixabay\Model\AbstractResponse;
use WBW\Library\Pixabay\Provider\APIProvider;

/**
 * Test API provider.
 *
 * @author webeweb <https://github.com/webeweb/>
 * @package WBW\Library\Pixabay\Tests\Fixtures\Provider
 */
class TestAPIProvider extends APIProvider {

    /**
     * {@inheritDoc}
     */
    public function beforeReturnResponse(AbstractResponse $response) {
        return parent::beforeReturnResponse($response);
    }
}
