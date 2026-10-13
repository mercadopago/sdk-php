# PHP examples

These programs demonstrate integration flows implemented by the PHP SDK. Start with Orders, then choose another API only when the payment product requires it.

## Orders first

Orders is the most complete learning path in this repository: it covers creation, retrieval, processing, capture, cancellation, refunds, and transaction management.

| Stage | Goal | Example |
|---|---|---|
| 1. Create | Submit a basic order | [`Create.php`](Order/Create.php) |
| 2. Inspect | Retrieve the server-side result | [`GetOrderById.php`](Order/GetOrderById.php) |
| 3. Advance | Process or capture an order | [`ProcessOrder.php`](Order/ProcessOrder.php) · [`Capture.php`](Order/Capture.php) |
| 4. Reverse | Cancel, partially refund, or fully refund | [`CancelOrderById.php`](Order/CancelOrderById.php) · [`RefundPartial.php`](Order/RefundPartial.php) · [`RefundTotal.php`](Order/RefundTotal.php) |
| 5. Manage transactions | Create, update, or delete a transaction | [`Transaction/Create.php`](Order/Transaction/Create.php) · [`Transaction/Update.php`](Order/Transaction/Update.php) · [`Transaction/Delete.php`](Order/Transaction/Delete.php) |
| 6. Add a payment flow | Use Checkout Pro, PSE, 3DS, or automatic payments | [`CreateCheckoutPRO.php`](Order/CreateCheckoutPRO.php) · [`CreateOrderPSE.php`](Order/CreateOrderPSE.php) · [`CreateOrderWith3DS.php`](Order/CreateOrderWith3DS.php) · [`CreateOrderWithAutomaticPayments.php`](Order/CreateOrderWithAutomaticPayments.php) |
| 7. Add specialized data | Use industry-specific fields | [`CreateOrderWithIndustryFields.php`](Order/CreateOrderWithIndustryFields.php) |

Install dependencies with Composer before running an example. For production use, persist the idempotency key and handle typed exceptions. See [request options](../docs/request-options.md) and [error handling](../docs/error-handling.md).

## Other supported examples

| Goal | API | Examples |
|---|---|---|
| Create a hosted checkout | Preferences API | [`Preference/`](Preference/) |
| Create a payment | Payments API | [`Payment/`](Payment/) |
| Search chargebacks | Chargebacks API | [`Chargeback/`](Chargeback/) |
| Refund a disbursement | Advanced Payments API | [`DisbursementRefund/`](DisbursementRefund/) |

Use test credentials and test data, replace every placeholder, and confirm fields in the [API reference](https://www.mercadopago.com/developers/en/reference). Never commit credentials or use production card data in examples.
