# VEHIKL Oil Change Check

A small Laravel app that checks whether a car is due for an oil change based on distance driven (5,000 km) or time since the last change (6 months).

## Setup

These steps assume a fresh clone. PHP **8.2+** and [Composer](https://getcomposer.org/) must be installed.

1. **Clone the repository**
  ```bash
   git clone https://github.com/Udokailodigwe/VEHIKL-OIL-CHANGE.git
   cd VEHIKL-OIL-CHANGE
  ```
2. **Install PHP dependencies**
  ```bash
   composer install
  ```
3. **Create your environment file**
  ```bash
   cp .env.example .env
   php artisan key:generate
  ```
   On Windows (PowerShell):
   The default `.env` uses SQLite (`DB_CONNECTION=sqlite`). MySQL lines in `.env.example` can stay commented out.
4. **Create the SQLite database file**
  ```bash
   touch database/database.sqlite
  ```
   On Windows (PowerShell):
5. **Run migrations**
  ```bash
   php artisan migrate
  ```
6. **Start the development server**
  ```bash
   php artisan serve
  ```
7. **Open the app**
  Visit [http://localhost:8000](http://localhost:8000), submit the form, and you will be redirected to a result page.

## Run tests

```bash
php artisan test
```

CI runs the same command on push and pull requests to `main`.

## App structure

### FormRequest vs inline validation

Validation lives in `StoreOilChangeCheckRequest` instead of inside the controller. That keeps HTTP entry points thin, makes rules reusable and easy to find, and lets feature tests exercise validation through a real POST without duplicating rule logic in the controller.

### Domain logic on the model for unit test isolation

`isDueByKm()`, `isDueByDate()`, and `isDue()` live on `OilChangeCheck`. Unit tests can construct a model in memory and assert business rules without routing, HTTP, or the database. The controller only orchestrates: validate, compute due status, persist, redirect.

### Thin controller

`OilChangeController` delegates validation to the FormRequest, due logic to the model, and rendering to Blade views. Each action has a single job: show the form, store a check, or show a result.

### TDD commit order (tests before controller)

Work was done in small RED/GREEN steps: failing tests first (unit domain rules, validation, form, store, result), then the minimum code to make them pass. That kept scope tight and made regressions obvious in CI at each step.

### Stored `is_due_for_oil_change` for stable refresh

The due flag is calculated once in `store()` and saved on the record. The result page reads that stored value instead of recalculating on every request. Refreshing `/result/{id}` always shows the same answer, even if “six months ago” would evaluate differently tomorrow.

### Assumptions — “exactly 6 months” boundary

- **Distance:** due when `current_odometer - previous_odometer >= 5000` (5,000 km exactly counts as due).
- **Time:** due when `previous_change_date` is **on or before** the date six months ago (`lte(now()->subMonths(6))`). A change dated exactly six months ago is treated as due.
- **Combined:** due if **either** threshold is met.
- **Validation:** `previous_change_date` must be in the past (`before:today`); today or future dates are rejected.
- **Persistence:** result messaging uses the stored `is_due_for_oil_change` from submit time, not a live recalculation.

