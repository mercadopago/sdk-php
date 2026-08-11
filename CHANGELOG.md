# Changelog

All notable changes to this project will be documented in this file.

This project follows Keep a Changelog and Semantic Versioning.

## [3.14.0] - 2026-08-11

### Added
- **Automatic Payments example**: two-step recurring flow ([#639](https://github.com/mercadopago/sdk-php/pull/639))
- **Order typed Request classes** with dual acceptance in `create()` ([#639](https://github.com/mercadopago/sdk-php/pull/639))
- **Order request layer**: reuse `Common\Address`, `Identification`, `Phone` ([#639](https://github.com/mercadopago/sdk-php/pull/639))
- **Pagination**: support `data` key (Orders v2) and string paging totals in `MPAutoPaginationGenerator` ([#639](https://github.com/mercadopago/sdk-php/pull/639))

### Fixed
- **Stored credential**: rename `prev_transaction_ref` to `previous_transaction_reference` ([#639](https://github.com/mercadopago/sdk-php/pull/639))

### CI
- Add CD workflow ([#651](https://github.com/mercadopago/sdk-php/pull/651))
- Standardize CI workflow ([#651](https://github.com/mercadopago/sdk-php/pull/651))
- Add mock-based unit test coverage ([#651](https://github.com/mercadopago/sdk-php/pull/651))

### Dependencies
- Fix CVE-2026-67434: upgrade `squizlabs/php_codesniffer` to `4.0.4` ([#651](https://github.com/mercadopago/sdk-php/pull/651))

## [3.13.0] - 2026-08-04

### Added

- **SDK ergonomics**: typed exceptions, configurable retry, and auto-pagination ([#646](https://github.com/mercadopago/sdk-php/pull/646))
  - `MPApiException` now has 12 specific subtypes per HTTP status code
  - `MPRequestOptions` gains optional `maxRetries`, `retryOn`, `initialDelayMs`, `maxDelayMs` and `onRetry` callback
  - New auto-pagination support on search endpoints
- **Missing API methods** — `DisbursementRefundClient::list()`, `AdvancedPaymentClient::update()`, `CustomerCard::update()`, `PaymentClient::update()` ([#645](https://github.com/mercadopago/sdk-php/pull/645))
- **CREDENTIAL_ON_FILE messaging fields** on `Payment` types ([#642](https://github.com/mercadopago/sdk-php/pull/642)): `firstTransaction`, `storage`, `transactionInitiator`, `reference`

### Fixed

- Webhook `toleranceSeconds` unit mismatch — `ts` header value compared in seconds against a millisecond clock ([#647](https://github.com/mercadopago/sdk-php/pull/647))
- `constantTimeEquals` `RangeError` on multibyte v1 hash ([#647](https://github.com/mercadopago/sdk-php/pull/647))

### CI

- Hotfix: pin GitHub Actions to SHA for supply chain security ([#638](https://github.com/mercadopago/sdk-php/pull/638))

### Dependencies

- Bump `symfony/console` ([#643](https://github.com/mercadopago/sdk-php/pull/643))
- Bump `friendsofphp/php-cs-fixer` ([#644](https://github.com/mercadopago/sdk-php/pull/644), [#640](https://github.com/mercadopago/sdk-php/pull/640))
- Bump `actions/checkout` to `v7.0.1` ([#641](https://github.com/mercadopago/sdk-php/pull/641))

## [3.12.0] - 2026-06-27

### Changed

- Order CheckokutPRO capability

## [3.11.0] - 2026-05-27

### Added

- **AdvancedPayment**: marketplace split-payment management — Create, Get, Search, Update, Capture, Cancel, UpdateReleaseDate (`POST/GET/PUT /v1/advanced_payments`).
- **DisbursementRefund**: refund management for split-payment disbursements — ListAll, CreateAll, Create (`GET/POST /v1/advanced_payments/{id}/refunds`, `POST /v1/advanced_payments/{id}/disbursements/{id}/refunds`).
- **Chargeback**: read-only access to payment dispute records — Get, Search (`GET /v1/chargebacks`).

## [3.7.1] - 2025-10-30

### Added

-

### Changed

- Bump the SDK version to `3.7.1` in `MercadoPagoConfig::$CURRENT_VERSION`

### Fixed

- Fix `addresses` and `cards` mapping in `Customer` resource

### Deprecated

-

### Security

## [3.6.0] - 2025-09-01

### Added

- Atualizações de documentação para instruções de instalação

### Changed

- Bump the SDK version to `3.6.0` in `MercadoPagoConfig::$CURRENT_VERSION`

### Fixed

-

### Deprecated

-

### Removed

-

### Security

-

## [3.5.1] - 2025-08-28

### Added

- Add and update fields and tests

### Changed

- Add and fix tests in `OrderClientUnitTest`
- Updates `.gitignore` to ignore `.idea`

### Fixed

-

### Deprecated

-

### Security

-

<!-- When releasing, duplicate the block below replacing X.Y.Z and date -->
<!-- Example: ## [3.6.0] - 2025-08-27 -->
