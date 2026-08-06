# Feature: order-request-dto-cleanup

**Feature Name**: order-request-dto-cleanup
**Feature ID**: feat-20260806-order-request-dto-cleanup
**Feature UUID**: 1ededf5b-619f-4b8b-8b5c-9989a58d34f8
**Mode**: standard
**Created**: 2026-08-06
**Project Type**: production
**Platform**: backend
**Technology**: php
**Spec Language**: es

## Status

| Phase | Status | Completed |
|-------|--------|-----------|
| 1-functional | approved | 2026-08-06 |
| 2-technical | approved | 2026-08-06 |
| 3-tasks | approved | 2026-08-06 |
| 4-implementation | pending | — |

## Context

**Branch**: feature/order-fields-sdk
**Project Mode**: brownfield

**Description**: Refactoring del branch `feature/order-fields-sdk` del SDK PHP de MercadoPago.
El ajuste introdujo 16 Request DTOs en `Client/Order/Request/` que duplican clases ya existentes
en `Resources/Order/`. La decisión es eliminar los DTOs y reutilizar los Resources pre-existentes
siguiendo los lineamientos actuales del proyecto (el resto de los clientes como PaymentClient
reciben plain arrays).

**Constraint crítico**: Los métodos existentes antes del ajuste no deben romperse bajo ningún motivo.

## Relationship Check

```yaml
performed_at: 2026-08-06T12:14:00Z
tier: NONE
decision: skipped_greenfield
decided_at: 2026-08-06T12:14:00Z
decided_by: express-auto
candidates: []
candidates_weak: []
candidates_dropped_by_llm: []
dismissed_conflicts: []
acknowledged_conflicts: []
```

## User Profile

```yaml
type: technical
source: global
selected_at: 2026-08-06T12:14:00Z
```
