# Changelog

All notable changes to this project will be documented in this file.

This project follows Keep a Changelog and Semantic Versioning.

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
