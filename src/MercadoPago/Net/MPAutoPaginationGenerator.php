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
 * Supports different response key conventions used across MercadoPago APIs:
 * - "results"  → payments, customers, preapprovals, preferences, etc.
 * - "data"     → Orders v2 API (also uses string paging values like "181")
 * - "elements" → some Order patterns (Pattern B)
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
     *        The callable must return an object with a results/data/elements array and
     *        a paging object having a total property (int or string).
     * @param MPSearchRequest $request Initial search parameters.
     * @param RequestOptions|null $options Per-request overrides.
     * @return Generator<mixed> Yields individual items from each page.
     */
    public static function of(callable $searchFn, MPSearchRequest $request, ?RequestOptions $options = null): Generator
    {
        $limit  = ($request->getLimit() !== null && $request->getLimit() > 0)
            ? $request->getLimit()
            : self::DEFAULT_PAGE_SIZE;
        $offset = $request->getOffset() ?? 0;

        while (true) {
            $pageRequest = new MPSearchRequest($limit, $offset, $request->getFilters());
            $page        = $searchFn($pageRequest, $options);

            // Support different response key conventions:
            // - "results"  → payments, customers, preapprovals, etc.
            // - "data"     → Orders v2 API
            // - "elements" → some Order patterns (Pattern B)
            $items = $page->results ?? $page->data ?? $page->elements ?? null;

            if (empty($items)) {
                return;
            }

            foreach ($items as $item) {
                yield $item;
            }

            // paging.total may be int (payments) or string (Orders v2 → "181")
            $total  = isset($page->paging->total) ? (int) $page->paging->total : 0;
            $offset += count($items);

            if ($total > 0 && $offset >= $total) {
                return;
            }
        }
    }
}
