<?php

namespace MercadoPago\Net;

use Generator;
use MercadoPago\Client\Common\RequestOptions;

/**
 * Creates a lazy PHP Generator that automatically fetches all pages of search results.
 *
 * Each call to {@see of()} returns a Generator that yields individual items from the
 * API response. Pages are fetched on demand; iteration stops when results are empty
 * or the offset reaches the total.
 *
 * Example:
 * ```php
 * $request = new MPSearchRequest(100, 0);
 * foreach ($paymentClient->searchAll($request) as $payment) {
 *     process($payment);
 * }
 * ```
 */
class MPAutoPaginationGenerator
{
    private const DEFAULT_PAGE_SIZE = 100;

    /**
     * Creates a Generator that lazily fetches all pages.
     *
     * @param callable $searchFn function(MPSearchRequest $req, ?RequestOptions $opts): object
     *        The callable must return an object with a public $results array and
     *        a public $paging object having a $total property.
     * @param MPSearchRequest $request Initial search parameters.
     * @param RequestOptions|null $options Per-request overrides.
     * @return Generator<mixed> Yields individual items from each page.
     */
    public static function of(callable $searchFn, MPSearchRequest $request, ?RequestOptions $options = null): Generator
    {
        $limit = ($request->getLimit() !== null && $request->getLimit() > 0)
            ? $request->getLimit()
            : self::DEFAULT_PAGE_SIZE;
        $offset = $request->getOffset() ?? 0;

        while (true) {
            $pageRequest = new MPSearchRequest($limit, $offset, $request->getFilters());
            $page = $searchFn($pageRequest, $options);

            $results = $page->results ?? [];
            if (empty($results)) {
                return;
            }

            foreach ($results as $item) {
                yield $item;
            }

            $total = $page->paging?->total ?? 0;
            $offset += count($results);

            if ($offset >= $total) {
                return;
            }
        }
    }
}
