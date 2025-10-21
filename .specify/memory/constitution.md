<!--
Sync Impact Report
Version change: 0.0.0 -> 1.0.0
Modified principles: none (initial ratification)
Added sections: Core Principles (I-V); Architecture Guardrails; Workflow & Quality Gates; Governance
Removed sections: none
Templates requiring updates:
- ✅ .specify/templates/plan-template.md
- ✅ .specify/templates/spec-template.md
- ✅ .specify/templates/tasks-template.md
Follow-up TODOs: none
-->
# Boshop Constitution

## Core Principles

### I. Inertia-First Experience
- Must deliver primary user journeys through Inertia-rendered React pages invoked from Laravel routes in `routes/`.
- Must keep server-side controllers slim, delegating view state to `resources/js/` layouts and components for consistency.
- Must provide progressive enhancement or graceful fallback when JavaScript is disabled for critical flows.
Rationale: A unified Laravel + React stack keeps UX cohesive and reduces divergence between server and client behaviour.

### II. Typed Data Contracts
- Must represent cross-layer payloads with `App\\Data\\` DTOs and keep them in sync with generated TypeScript types.
- Must reject ad-hoc array payloads; any new field requires DTO evolution plus corresponding frontend type updates.
- Must document backward-incompatible changes in release notes before merging.
Rationale: Typed contracts protect Inertia responses from drift and enable confident refactors across PHP and TypeScript.

### III. Account Security & Privacy
- Must enforce authentication via Laravel Fortify/Wayfinder middleware on any route exposing user data.
- Must store secrets solely in `.env` and access them through config helpers; never commit credentials.
- Must log and alert on repeated auth failures without exposing sensitive context to clients.
Rationale: Strong guardrails prevent accidental data leaks while supporting future compliance needs.

### IV. Quality Gates & Automation
- Must gate merges on Pest unit + feature coverage, PHPStan static analysis, and ESLint/TypeScript checks.
- Must add regression tests alongside every behaviour change; deleting tests requires equivalent replacements that cover intent.
- Must keep CI pipelines under 10 minutes by parallelising PHP and Node tasks or deferring heavy suites.
Rationale: Automated gates preserve reliability as the monolith scales and keep feedback loops fast enough for daily iteration.

### V. Operability & Observability
- Must emit structured logs for queue jobs, background tasks, and external integrations via Laravel Pail conventions.
- Must monitor queue backlogs and failed jobs, triggering alerts when thresholds defined in `config/queue.php` are exceeded.
- Must supply deployment runbooks outlining rollback, cache clear, and asset build steps before production release.
Rationale: Visibility into runtime health is essential for diagnosing issues quickly and supporting continuous delivery.

## Architecture Guardrails

- Backend domain logic lives in `app/` with facades kept thin; heavy orchestration belongs in dedicated service classes or actions.
- React components under `resources/js/` must be co-located with feature folders, sharing Tailwind utility tokens to standardise styling.
- Database schema changes require matching factories/seeders in `database/` to maintain local reproducibility.
- Real-time requirements must prefer Laravel Echo or native broadcasting; introducing new queues or transports demands architecture review.

## Workflow & Quality Gates

- Feature work must begin with `/speckit.specify` to capture user stories and explicit acceptance tests.
- `/speckit.plan` outputs must document Constitution Check decisions, citing affected principles and mitigation when deviating.
- `/speckit.tasks` must group work by user story, ensuring each slice is independently releasable and testable.
- Pull requests must include CI evidence (test + lint logs) and reference updated DTOs, migrations, and TypeScript types when applicable.

## Governance

- The constitution supersedes informal practices; conflicts are resolved in favour of these rules.
- Amendments require consensus of maintainers, recorded rationale, and version bump following semantic rules (major/minor/patch).
- Ratified copies live in `.specify/memory/constitution.md`; any runtime guidance (e.g., CLAUDE.md, GEMINI.md) must align within 48 hours of amendments.
- Compliance reviews occur each release cycle, verifying template outputs and CI pipelines against Principles I–V.

**Version**: 1.0.0 | **Ratified**: 2025-10-21 | **Last Amended**: 2025-10-21
