<!--
Sync Impact Report
- Version change: (template) → 1.0.0
- Modified principles: Converted placeholder principles to concrete, actionable principles tailored for this repository (Test-First, Laravel Way, Inertia & Frontend Integration, Observability & Simplicity, Versioning/Releases).
- Added sections: Constraints & Compliance, Development Workflow & Quality Gates.
- Removed sections: No sections removed; placeholders replaced with concrete content.
- Templates requiring updates:
  - .specify/templates/plan-template.md ✅ updated (Constitution Check clarified)
  - .specify/templates/spec-template.md ✅ updated (Constitution compliance note)
  - .specify/templates/tasks-template.md ⚠ pending (no forced changes required; samples remain)
- Follow-up TODOs:
  - RATIFICATION_DATE intentionally left as TODO because repository does not contain an authoritative adoption date. See 'deferred items' below.
-->

# Boshop Constitution

## Core Principles

### Test-First (NON-NEGOTIABLE)
Every new feature or change MUST be accompanied by automated tests written before implementation. Tests are the primary specification and acceptance criteria for work.

- Use Pest for unit, feature, and browser tests according to project conventions.
- Prefer feature tests for user-facing behavior and browser tests (Pest v4) for important flows; write contract and integration tests where appropriate.
- Use model factories, dataset-driven tests, and mocks only where helpful — prefer real integrations for core paths.
- Tests MUST fail before implementation (red → green → refactor). Continuous integration MUST enforce passing tests on merge.

Rationale: Tests reduce regressions, document expected behavior, and align with the project's mandatory test-first policy.

### The Laravel Way (Eloquent & Conventions)
Leverage Laravel conventions and first-class framework features. Prefer Eloquent, Form Requests, Policies, Gates, and artisan generators over handwritten plumbing.

- Use `php artisan make:` commands (controllers, models, requests, jobs) with `--no-interaction` in automation.
- Validation SHOULD be implemented in Form Request classes; controllers remain thin.
- Use Eloquent relationships and eager-loading to avoid N+1 problems; prefer query scopes and model APIs over raw DB access.
- Use queued jobs for long-running tasks and the `ShouldQueue` interface for asynchronous processing.

Rationale: Following Laravel's idioms keeps codebase consistent, maintainable, and leverages framework upgrades safely.

### Inertia & Frontend Integration
Frontend components and pages MUST follow the project's Inertia + React conventions.

- Place Inertia pages under `resources/js/Pages` and use `Inertia::render()` for server-rendered routes.
- Use the Inertia `Form` component or the `useForm` helper for forms; adopt deferred props, prefetching, and WhenVisible patterns where beneficial.
- Ensure frontend builds are reproducible; if UI changes are not visible, run `npm run build`, `npm run dev`, or `composer run dev` as appropriate.

Rationale: Consistent Inertia usage prevents integration drift between backend routes and frontend pages and ensures predictable UX behavior.

### Observability & Simplicity
Design for operability and keep solutions as simple as possible.

- Structured logging and meaningful log levels are required for server-side operations.
- Use Tailwind utility conventions already present in the codebase; prefer gap utilities for lists and support `dark:` where existing components do.
- Avoid premature optimization and complexity; YAGNI applies — add instrumentation and performance work only when justified by evidence.

Rationale: Simple, observable systems are easier to debug, maintain, and iterate on.

### Versioning, Releases & Breaking Changes
Follow semantic versioning for public or internal package releases and document breaking changes and migration plans for the application.

- Versioning convention: MAJOR.MINOR.PATCH. MAJOR for incompatible governance or public API changes; MINOR for new principles or additive features; PATCH for clarifications and typos.
- Breaking changes MUST include a migration plan, a clear changelog entry, and CI checks that surface incompatibilities.
- All releases/merges that affect runtime behavior MUST reference a ticket and include tests verifying the change.

Rationale: Clear versioning and migration plans reduce upgrade friction and set expectations for consumers and maintainers.

## Constraints & Compliance

- Platform: PHP 8.4, Laravel 12 as recorded in `composer.json`.
- Frontend: Inertia v2, React v19, Tailwind v4 conventions present in the repo.
- Build: Developers MAY need to run `npm run build` or `npm run dev` (or `composer run dev`) when frontend assets change.
- Security: Environment variables MUST be accessed via `config()` in config files; do not call `env()` outside configuration.
- Tooling: Use Pint for formatting (`vendor/bin/pint` to fix), run `vendor/bin/pint --dirty` before finalizing changes; use Rector and PHPStan per repo scripts where appropriate.

## Development Workflow & Quality Gates

- Use `php artisan make:` generators for new code; include Form Requests for validation and create factories when adding models.
- Code style: Run Pint to fix formatting. CI MUST run tests and linters before merges.
- PRs: At minimum, include description, tests, and a changelog line for behavior changes. Major or breaking changes require an explicit migration guide in the PR.
- Tests: Follow project Pest conventions; prefer feature tests and datasets where helpful. Run minimal affected tests locally before pushing.

## Governance

The Constitution is the source of truth for project-level engineering norms. Amendments follow the process below.

- Amendments: Proposals MUST be documented as a PR that updates this file and contains a migration or implementation plan for any behavioral changes.
- Approval: A change to the Constitution requires approval from at least one project maintainer and passing CI (tests + linters). Major governance changes should have two maintainer approvals.
- Versioning: Bump `CONSTITUTION_VERSION` per semantic rules. The author of the amendment SHOULD include a short rationale in the PR body explaining the bump type.
- Compliance: All PRs MUST include a short checklist that references applicable Constitution principles and how the change satisfies them.

**Version**: 1.0.0 | **Ratified**: 2025-10-17 | **Last Amended**: 2025-10-17
<!-- Dates are ISO format YYYY-MM-DD. -->
