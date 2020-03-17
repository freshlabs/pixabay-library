<?php

/*
 * This file is part of the pixabay-library package.
 *
 * (c) 2019 WEBEWEB
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace WBW\Library\Pixabay\Serializer;

use WBW\Library\Core\Argument\Helper\ArrayHelper;
use WBW\Library\Core\Argument\Helper\StringHelper;
use WBW\Library\Pixabay\Model\AbstractRequest;
use WBW\Library\Pixabay\Model\Request\SearchImagesRequest;
use WBW\Library\Pixabay\Model\Request\SearchVideosRequest;

/**
 * Request serializer.
 *
 * @author webeweb <https://github.com/webeweb/>
 * @package WBW\Library\Pixabay\Serializer
 */
class RequestSerializer {

    /**
     * Serialize a request.
     *
     * @param AbstractRequest $request The request.
     * @return array Returns the parameters.
     */
    protected static function serializeRequest(AbstractRequest $request) {

        $parameters = [];

        ArrayHelper::set($parameters, "q", $request->getQ(), [null]);
        ArrayHelper::set($parameters, "lang", $request->getLang(), [null, AbstractRequest::LANG_EN]);
        ArrayHelper::set($parameters, "id", $request->getId(), [null]);
        ArrayHelper::set($parameters, "category", $request->getCategory(), [null]);
        ArrayHelper::set($parameters, "min_width", $request->getMinWidth(), [null, 0]);
        ArrayHelper::set($parameters, "min_height", $request->getMinHeight(), [null, 0]);
        ArrayHelper::set($parameters, "editors_choice", StringHelper::parseBoolean($request->getEditorsChoice()), [null, "false"]);
        ArrayHelper::set($parameters, "safesearch", StringHelper::parseBoolean($request->getSafeSearch()), [null, "false"]);
        ArrayHelper::set($parameters, "order", $request->getOrder(), [null, AbstractRequest::ORDER_POPULAR]);
        ArrayHelper::set($parameters, "page", $request->getPage(), [null, 1]);
        ArrayHelper::set($parameters, "per_page", $request->getPerPage(), [null, AbstractRequest::PER_PAGE_DEFAULT]);
        ArrayHelper::set($parameters, "pretty", StringHelper::parseBoolean($request->getPretty()), [null, "false"]);

        return $parameters;
    }

    /**
     * Serialize a search images request.
     *
     * @param SearchImagesRequest $searchImagesRequest The search images request.
     * @return array Returns the parameters.
     */
    public static function serializeSearchImagesRequest(SearchImagesRequest $searchImagesRequest) {

        $parameters = static::serializeRequest($searchImagesRequest);

        ArrayHelper::set($parameters, "image_type", $searchImagesRequest->getImageType(), [null, SearchImagesRequest::IMAGE_TYPE_ALL]);
        ArrayHelper::set($parameters, "orientation", $searchImagesRequest->getOrientation(), [null, SearchImagesRequest::ORIENTATION_ALL]);
        ArrayHelper::set($parameters, "colors", implode(",", $searchImagesRequest->getColors()), [null, ""]);

        return $parameters;
    }

    /**
     * Serialize a search videos request.
     *
     * @param SearchVideosRequest $searchVideosRequest The search videos request.
     * @return array Returns the parameters.
     */
    public static function serializeSearchVideosRequest(SearchVideosRequest $searchVideosRequest) {

        $parameters = static::serializeRequest($searchVideosRequest);

        ArrayHelper::set($parameters, "video_type", $searchVideosRequest->getVideoType(), [null, SearchVideosRequest::VIDEO_TYPE_ALL]);

        return $parameters;
    }
}