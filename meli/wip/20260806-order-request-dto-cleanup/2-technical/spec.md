# Technical Specification: order-request-dto-cleanup

**Feature**: order-request-dto-cleanup
**Status**: approved
**Language**: es
**Platform**: backend (PHP library / SDK)
**Project Mode**: brownfield
**Feature Type**: pure-logic (refactoring — no infra)
**Approved by**: Diego Gerardo Barajas Suarez
**Approved at**: 2026-08-06T17:30:40Z

## Executive Summary

Refactoring de limpieza sobre el branch `feature/order-fields-sdk`. Se elimina la capa de 16
Request DTOs introducida en `src/MercadoPago/Client/Order/Request/` y se revierte
`OrderClient::create()` al patrón solo-array consistente con el resto del SDK. Los Resources
de automatic payments permanecen intactos (ya existen en `master` y se usan para deserializar
respuestas). No hay servicios Fury, base de datos, ni infraestructura involucrada: es un
paquete PHP publicado vía Composer.

## Architecture Overview

No cambia la arquitectura del SDK. Se **remueve** una capa accidental. Flujo antes/después:

```
ANTES (branch):
  Integrador ──► array  ────────────────►┐
             └─► Order*Request (16 DTOs) ─┤─► OrderClient::create(array|OrderCreateRequest)
                     │ toArray()          │        │ json_encode
                     └────────────────────┘        ▼
                                             POST /v1/orders
                                                   │
                                                   ▼
                                          Serializer::deserialize ──► Order (Resources)

DESPUÉS (limpieza):
  Integrador ──► array ──► OrderClient::create(array)
                                  │ json_encode
                                  ▼
                           POST /v1/orders
                                  │
                                  ▼
                     Serializer::deserialize ──► Order (Resources, sin cambios)
```

## Design Decisions

### DD-1: Eliminar la capa Request DTO en lugar de consolidarla

**Selected**: Eliminar las 16 clases `Order*Request` y volver a solo-array.

**Options Considered**:
- **Opción A (seleccionada)**: Eliminar todos los DTOs, revertir `create()` a solo-array.
  Pros: consistencia total con `PaymentClient`/`PreferenceClient`; mínima superficie de
  mantenimiento; alineado con lineamientos actuales. Cons: se pierde el tipado fuerte opcional
  en la construcción del request.
- **Opción B**: Conservar dual-acceptance pero reusar Resources (con `toArray()`) en lugar de
  DTOs. Pros: mantiene tipado. Cons: obliga a agregar lógica de serialización a los Resources
  (que son de response), mezclando responsabilidades; sigue siendo un patrón distinto al resto
  del SDK.
- **Opción C**: Conservar solo los DTOs no-duplicados. Pros: cambio menor. Cons: deja un
  patrón inconsistente a medias; no resuelve el problema de fondo.

**Trade-offs Accepted**: Se renuncia al autocompletado/tipado fuerte opcional en la
construcción del request. Es aceptable porque el 100% del SDK ya usa arrays planos y los
ejemplos oficiales de automatic payments ya están escritos con arrays.

**Rationale**: El problema declarado es complejidad accidental e inconsistencia. La Opción A
es la única que elimina ambas de raíz sin introducir responsabilidades nuevas en la capa de
Resources.

### DD-2: Revertir `Resources/Common/*` a la línea base de `master`

**Selected**: Revertir `Address.php`, `Phone.php`, `Identification.php` al estado de `master`.

**Options Considered**:
- **Opción A (seleccionada)**: `git checkout master -- <archivos>`. Pros: restaura exactamente
  la línea base conocida-buena; cero riesgo de deserialización. Cons: ninguno relevante.
- **Opción B**: Editar manualmente para quitar solo `JsonSerializable`/`toArray()`. Pros:
  control fino. Cons: riesgo de dejar residuos o divergir de master.

**Trade-offs Accepted**: Ninguno significativo.

**Rationale**: `master` es la baseline pre-ajuste que ya pasa todos los tests. Restaurar
exactamente ese estado es la operación de menor riesgo. Verificado que los mocks de respuesta
con `city` como objeto (Customer) y como string (User, que NO usa `Common\Address`) siguen
deserializando: `Common\Address.city` en master es `array|object|null` y solo lo consumen
recursos cuyas respuestas traen `city` como objeto.

### DD-3: Conservar el rename de `StoredCredential`

**Selected**: Mantener `previous_transaction_reference` (rename hecho en el branch), NO revertir
a `prev_transaction_ref`.

**Rationale**: El nombre `previous_transaction_reference` coincide con el campo real de la API
de MercadoPago. Es una corrección de bug independiente de la capa DTO. Revertirlo reintroduciría
el nombre incorrecto.

## Fury Platform Compliance

**No aplica.** Este proyecto es una biblioteca PHP (`mercadopago/dx-php`) distribuida vía
Composer/Packagist, no una aplicación desplegada en Fury. No existe contenedor de runtime,
endpoint `/ping`, scopes, ni imágenes base Fury. Los checks de compliance de plataforma
(imágenes de contenedor, health check HTTP, etc.) no son pertinentes para un paquete de
librería.

| Requisito de plataforma | Estado | Motivo |
|-------------------------|--------|--------|
| Imagen de runtime | N/A | Librería, no servicio |
| /ping endpoint | N/A | Sin runtime HTTP propio |
| Scopes de despliegue | N/A | Sin despliegue en plataforma |
| CI Pipeline | Aplica (CI del repo) | GitHub Actions ejecuta PHPUnit + PHP CS Fixer |

> **Nota de compliance (N/A por tipo de proyecto)**: De ser este un servicio desplegado en
> Fury, aplicaría el patrón estándar: `Dockerfile` + `Dockerfile.runtime` basados en imágenes
> aprobadas `hub.furycloud.io/mercadolibre/distroless-*`, y un endpoint `/ping` que retorna
> `pong`. Como este paquete es una **librería Composer** sin runtime propio, ninguno de esos
> artefactos existe ni debe crearse.

## Data Model

Sin cambios en el modelo de datos. Los Resources de `Order/` permanecen idénticos, salvo el
rename ya presente en `StoredCredential` (`previous_transaction_reference`).

## Affected Files

| Archivo | Acción | Nota |
|---------|--------|------|
| `src/MercadoPago/Client/Order/Request/*.php` (16) | **Eliminar** | Toda la carpeta `Request/` |
| `src/MercadoPago/Client/Order/OrderClient.php` | **Revertir** | Quitar `use ...OrderCreateRequest`, firma `create(array $request, ...)`, quitar branch `instanceof` |
| `src/MercadoPago/Resources/Common/Address.php` | **Revertir a master** | Quita `JsonSerializable`, `toArray()`, campo `country`, tipo ampliado de `city` |
| `src/MercadoPago/Resources/Common/Phone.php` | **Revertir a master** | Quita `JsonSerializable`, `toArray()` |
| `src/MercadoPago/Resources/Common/Identification.php` | **Revertir a master** | Quita `JsonSerializable`, `toArray()` |
| `src/MercadoPago/Resources/Order/StoredCredential.php` | **Conservar** | Rename correcto — no tocar |
| `tests/MercadoPago/Client/Unit/Order/OrderCreateRequestUnitTest.php` | **Eliminar** | Prueba exclusivamente la capa DTO |
| `examples/Order/CreateOrderWithAutomaticPayments.php` | **Sin cambios** | Ya usa arrays |
| `.php-cs-fixer.dist.php` | **Sin cambios** | Config de estilo, independiente |

## REST API Contracts

No aplica. El SDK consume la API de Orders existente (`POST /v1/orders`); el body serializado
(`json_encode` del array) es idéntico byte-a-byte al que producía el `toArray()` de los DTOs.

## Testing Strategy

**Enfoque**: refactoring por eliminación — la red de seguridad es la suite existente. No se
agregan tests nuevos; se elimina el test obsoleto y se corre la suite completa para confirmar
cero regresiones. Cobertura objetivo: mantener el nivel de cobertura previo del paquete
(la limpieza no debe reducir cobertura de código productivo vigente).

### Unit Tests

(HTTP client mockeado, patrón `BaseClient`):
- Conservar `OrderClientUnitTest.php` — cubre `create` con array + resto de métodos.
- Eliminar `OrderCreateRequestUnitTest.php` — obsoleto al remover los DTOs.
- Verificar que la suite completa (`composer test` / PHPUnit) pasa sin cambios de assertions
  no relacionados.

### Integration Tests

- `OrderClientITTest.php` y `OrderTransactionClientITTest.php` usan arrays — no requieren cambios.

### E2E Tests

No aplica: un SDK no tiene E2E propios más allá de los unit/integration con HTTP mockeado.
Los escenarios E2E-1..E2E-4 de la spec funcional se cubren a nivel unit/integration.

**Regresión clave** (mapea a E2E-1..E2E-4 de la spec funcional): deserialización de respuesta
con `stored_credential`, `automatic_payments`, `subscription_data` sigue funcionando (Resources
intactos); serialización de request produce el mismo JSON con arrays planos.

**Comando de verificación**: `composer test` (o `vendor/bin/phpunit`) debe finalizar en verde.

## Security

Este refactoring no altera la superficie de seguridad del SDK. Se documenta el modelo vigente
para completitud.

### Authentication

La autenticación contra la API de MercadoPago se realiza vía **access token** (Bearer),
configurado por el integrador en `MercadoPagoConfig::setAccessToken()` y enviado por el
`MPHttpClient` en el header `Authorization`. Este refactoring **no modifica** el mecanismo de
autenticación: `OrderClient` sigue heredando el flujo de `MercadoPagoClient::send()` sin cambios.

### Input Validation

- **Boundary de entrada**: el array de request lo provee el integrador (código confiable que
  consume el SDK), no un usuario final anónimo. Se serializa con `json_encode`; PHP garantiza
  el escape correcto de la carga JSON.
- La validación de negocio de los campos la realiza la API de MercadoPago del lado servidor,
  que responde `400 Bad Request` ante payloads inválidos — comportamiento inalterado.
- No se construyen queries SQL, comandos de shell, ni HTML: no hay vectores de inyección
  introducidos ni removidos por este cambio.

### Secrets Management

No hay secrets en el código. El access token es responsabilidad del integrador en runtime;
no se persiste ni se registra en logs dentro del SDK.

## Performance

Neutral. Eliminar la capa DTO remueve una indirección (`toArray()` + `array_map` recursivo)
en el path de construcción del request. Impacto despreciable pero no negativo.

## Deployment Strategy

Se publica como una versión nueva del paquete Composer `mercadopago/dx-php`. Al no haber
existido release previo con los DTOs, no hay ruptura de compatibilidad pública: la firma final
`create(array $request)` es idéntica a la de `master`.
