# Functional Specification: order-request-dto-cleanup

**Feature**: order-request-dto-cleanup
**Status**: approved
**Language**: es
**Created**: 2026-08-06
**Approved by**: Diego Gerardo Barajas Suarez
**Approved at**: 2026-08-06T17:30:40Z

## Problem Statement

El branch `feature/order-fields-sdk` introdujo una capa paralela de 16 clases Request DTO
tipadas en `src/MercadoPago/Client/Order/Request/` (p. ej. `OrderCreateRequest`,
`OrderPaymentRequest`, `OrderStoredCredentialRequest`) para construir el body de
`OrderClient::create()`. Estas clases:

1. **Duplican** estructuras que ya existen como Resources en `src/MercadoPago/Resources/Order/`
   (`Payment`, `StoredCredential`, `AutomaticPayments`, `SubscriptionData`, etc.).
2. **Rompen la consistencia** del SDK: el resto de los clientes (`PaymentClient`,
   `PreferenceClient`, etc.) reciben un `array` plano en sus métodos `create()`, no objetos
   tipados. La capa DTO es un patrón nuevo que no sigue los lineamientos actuales del proyecto.
3. Introdujeron cambios colaterales en `Resources/Common/` (Address, Phone, Identification)
   para soportar serialización de request (`JsonSerializable`, `toArray()`), que solo existen
   para alimentar la capa DTO.

El objetivo es **simplificar** el ajuste eliminando la capa DTO y volviendo al patrón
solo-array, manteniendo intactos los campos de automatic payments que ya viven en los
Resources (usados para deserializar respuestas).

## Objectives

1. Eliminar la complejidad accidental introducida por la capa Request DTO.
2. Alinear `OrderClient::create()` con el patrón solo-array del resto del SDK.
3. Garantizar cero regresiones: ningún método ni comportamiento que existía antes del ajuste puede romperse.

## Success Metrics

- 0 clases en `src/MercadoPago/Client/Order/Request/`.
- `OrderClient::create()` con firma `create(array $request, ...)` — idéntica al resto del SDK.
- Suite de tests existente (unit + integration) pasa al 100% sin modificaciones de assertions
  no relacionadas.
- Los ejemplos de automatic payments (`examples/Order/CreateOrderWithAutomaticPayments.php`)
  siguen funcionando sin cambios (ya usan arrays).

## Scope

### In Scope

- Eliminar las 16 clases Request DTO de `Client/Order/Request/`.
- Revertir `OrderClient::create()` a firma solo-array.
- Revertir los cambios de `Resources/Common/Address.php`, `Phone.php`, `Identification.php`
  al estado de `master` (quitar `JsonSerializable`/`toArray()`/campos agregados solo para
  requests), **verificando** que no sean necesarios para deserializar respuestas.
- Eliminar el test `OrderCreateRequestUnitTest.php` (prueba exclusivamente la capa DTO).

### Out of Scope

- Modificar los Resources de automatic payments (`AutomaticPayments`, `StoredCredential`,
  `SubscriptionData`, `SubscriptionSequence`, `InvoicePeriod`). Ya contienen los campos
  correctos para deserializar respuestas y no dependen de los DTOs.
- Cambiar la API pública de otros clientes del SDK.
- Renombrar campos de la API (el rename `prev_transaction_ref` → `previous_transaction_reference`
  en el Resource `StoredCredential` es correcto y se conserva).

## User Stories

### US-1: Integrador crea orders con automatic payments usando arrays

<!-- Persona: desarrollador que integra el SDK PHP de MercadoPago -->

**Como** desarrollador que integra el SDK PHP de MercadoPago,
**quiero** crear orders (incluyendo flujos de automatic payments) pasando un array plano a
`OrderClient::create()`,
**para** usar el mismo patrón consistente que ya uso en `PaymentClient` y el resto del SDK,
sin aprender una capa de objetos tipados paralela.

**Acceptance Criteria**:
- `OrderClient::create(array $request)` acepta un array plano y serializa el body vía
  `json_encode`, igual que antes del ajuste.
- Los flujos de automatic payments (first payment + recurring con `stored_credential`,
  `automatic_payments`, `subscription_data`) funcionan pasando arrays anidados.
- No existe ninguna clase `Order*Request` en el namespace `Client\Order\Request`.

### US-2: Mantenedor del SDK preserva compatibilidad total

**Como** mantenedor del SDK,
**quiero** que la limpieza no rompa ningún método ni test existente previo al ajuste,
**para** poder mergear el refactoring con confianza de cero regresiones.

**Acceptance Criteria**:
- Todos los métodos públicos de `OrderClient` (`create`, `capture`, `cancel`, `process`,
  `refund`, `get`, `search`) conservan su firma y comportamiento previos al branch.
- La deserialización de respuestas de order (incluyendo campos de automatic payments) sigue
  funcionando: `$order->transactions->payments[0]->stored_credential->previous_transaction_reference`
  resuelve correctamente.
- La suite de tests completa pasa; los únicos tests eliminados son los que prueban
  exclusivamente la capa DTO eliminada.

## User Experience

Al ser un SDK (biblioteca), la "experiencia de usuario" es la Developer Experience (DX) del
integrador que consume el paquete.

**User Journey — construir una order con automatic payments**:

1. El desarrollador instancia `new OrderClient()`.
2. Construye el payload como un `array` PHP asociativo anidado (mismo patrón que
   `PaymentClient`, `PreferenceClient`, etc.).
3. Llama `$client->create($request)` pasando el array.
4. Recibe un objeto `Order` deserializado y accede a sus campos tipados
   (`$order->transactions->payments[0]->stored_credential->previous_transaction_reference`).

**Antes vs. después de la limpieza**:

- Antes del ajuste (master): array plano. ✅ Consistente.
- Con el ajuste (branch): array plano **o** cadena de objetos `Order*Request` tipados.
  ⚠️ Dos patrones conviven, incrementan superficie de mantenimiento.
- Después de la limpieza: array plano únicamente. ✅ Vuelve a un solo patrón consistente.

No hay UI ni wireframes: el "producto" es la API pública del paquete PHP.

## Dependencies

- Ninguna dependencia externa. Es un refactoring interno del paquete PHP.

## Critical E2E Test Scenarios

> Escenarios verificables end-to-end sobre la API pública del SDK (unit tests con HTTP client
> mockeado, siguiendo el patrón de `BaseClient` del proyecto).

### E2E-1: Crear order con array plano (compatibilidad base)

- **Dado** un payload de order como array (type, total_amount, payer, transactions.payments),
- **Cuando** se llama `OrderClient::create($array)` con una respuesta 200 mockeada,
- **Entonces** se obtiene un `Order` con `id`, `type` y `status` deserializados correctamente.

### E2E-2: Crear order de automatic payments con arrays anidados

- **Dado** un payload con `stored_credential`, `automatic_payments` y `subscription_data`
  como arrays anidados dentro de `transactions.payments[0]`,
- **Cuando** se llama `OrderClient::create($array)`,
- **Entonces** el body serializado (`json_encode`) contiene las claves snake_case correctas
  (`previous_transaction_reference`, `payment_profile_id`, `subscription_sequence`).

### E2E-3: Deserializar respuesta con campos de automatic payments

- **Dado** un mock de respuesta de order que incluye `stored_credential` en un payment,
- **Cuando** se deserializa la respuesta,
- **Entonces** `$order->transactions->payments[0]->stored_credential->previous_transaction_reference`
  resuelve al valor esperado.

### E2E-4: Ausencia de la capa DTO

- **Dado** el paquete tras la limpieza,
- **Cuando** se inspecciona el namespace `MercadoPago\Client\Order\Request`,
- **Entonces** no existe ninguna clase (autoload no resuelve `Order*Request`).

## Risks & Edge Cases

- **Riesgo**: los cambios en `Resources/Common/` pudieran ser necesarios para deserializar
  respuestas (no solo para requests). **Mitigación**: verificar contra `master` y contra los
  tests de deserialización antes de revertir; conservar cualquier cambio requerido por el
  response mapping.
- **Edge case**: el campo `city` en `Address` fue ampliado a `string|array|object|null`. Si
  alguna respuesta de la API devuelve `city` como string, revertir el tipo podría afectar la
  deserialización. Verificar en los mocks de respuesta antes de revertir.
