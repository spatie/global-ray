# Changelog

All notable changes to `global-ray` will be documented in this file.

## 1.2.4 - 2026-02-09

### What's Changed

- Fix Symfony 8 compatibility (#77, #78): `Application::add()` and `Command::setName()` were removed in Symfony 8.0. Added `#[AsCommand]` attributes and backward-compatible method checks.

## 1.2.3 - 2025-12-23

### What's Changed

* Bump actions/checkout from 5 to 6 by @dependabot[bot] in https://github.com/spatie/global-ray/pull/73
* Php 8.5 Support by @stevebauman in https://github.com/spatie/global-ray/pull/75

**Full Changelog**: https://github.com/spatie/global-ray/compare/1.2.2...1.2.3

## 1.2.2 - 2025-11-03

### What's Changed

* Bump dependabot/fetch-metadata from 2.3.0 to 2.4.0 by @dependabot[bot] in https://github.com/spatie/global-ray/pull/62
* Bump stefanzweifel/git-auto-commit-action from 5 to 6 by @dependabot[bot] in https://github.com/spatie/global-ray/pull/63
* Bump actions/checkout from 3 to 5 by @dependabot[bot] in https://github.com/spatie/global-ray/pull/66
* Update issue template by @AlexVanderbist in https://github.com/spatie/global-ray/pull/69
* Added Symfony 8 support to all symfony/* packages. by @thecaliskan in https://github.com/spatie/global-ray/pull/71
* Bump stefanzweifel/git-auto-commit-action from 6 to 7 by @dependabot[bot] in https://github.com/spatie/global-ray/pull/70

### New Contributors

* @AlexVanderbist made their first contribution in https://github.com/spatie/global-ray/pull/69

**Full Changelog**: https://github.com/spatie/global-ray/compare/1.2.1...1.2.2

## 1.2.1 - 2025-02-25

### What's Changed

* Changes implicitly nullable parameter types by @yoeriboven in https://github.com/spatie/global-ray/pull/60

### New Contributors

* @yoeriboven made their first contribution in https://github.com/spatie/global-ray/pull/60

**Full Changelog**: https://github.com/spatie/global-ray/compare/1.2.0...1.2.1

## 1.2.0 - 2025-02-24

### What's Changed

* Bump dependabot/fetch-metadata from 2.2.0 to 2.3.0 by @dependabot in https://github.com/spatie/global-ray/pull/57
* Fix PHP 8.4 issues by @stevebauman in https://github.com/spatie/global-ray/pull/59

**Full Changelog**: https://github.com/spatie/global-ray/compare/1.1.3...1.2.0

## 1.1.3 - 2024-12-11

- support PHP 8.4

### What's Changed

* Bump dependabot/fetch-metadata from 1.6.0 to 2.1.0 by @dependabot in https://github.com/spatie/global-ray/pull/50
* Bump dependabot/fetch-metadata from 2.1.0 to 2.2.0 by @dependabot in https://github.com/spatie/global-ray/pull/54

**Full Changelog**: https://github.com/spatie/global-ray/compare/1.1.2...1.1.3

## 1.1.2 - 2024-06-07

### What's Changed

* Add return type declarations by @jklue in https://github.com/spatie/global-ray/pull/52

### New Contributors

* @jklue made their first contribution in https://github.com/spatie/global-ray/pull/52

**Full Changelog**: https://github.com/spatie/global-ray/compare/1.1.1...1.1.2

## 1.1.1 - 2024-05-30

### What's Changed

* Allow Symfony 7.x by @thecaliskan in https://github.com/spatie/global-ray/pull/46
* fix: on macOS if Herd is installed, adjust the valet config file path accordingly by @wkhayrattee in https://github.com/spatie/global-ray/pull/51

### New Contributors

* @thecaliskan made their first contribution in https://github.com/spatie/global-ray/pull/46
* @wkhayrattee made their first contribution in https://github.com/spatie/global-ray/pull/51

**Full Changelog**: https://github.com/spatie/global-ray/compare/1.1.0...1.1.1

## 1.1.0 - 2023-12-11

- support PHP 8.3

## 1.0.6 - 2023-01-11

### What's Changed

- Bump dependabot/fetch-metadata from 1.3.1 to 1.3.3 by @dependabot in https://github.com/spatie/global-ray/pull/24
- Bump dependabot/fetch-metadata from 1.3.3 to 1.3.4 by @dependabot in https://github.com/spatie/global-ray/pull/28
- Bump dependabot/fetch-metadata from 1.3.4 to 1.3.5 by @dependabot in https://github.com/spatie/global-ray/pull/32
- Add PHP 8.2 Support by @patinthehat in https://github.com/spatie/global-ray/pull/34
- Add Phar for PHP 8.2

### New Contributors

- @patinthehat made their first contribution in https://github.com/spatie/global-ray/pull/34

**Full Changelog**: https://github.com/spatie/global-ray/compare/1.0.5...1.0.6

## 1.0.5 - 2022-06-21

### What's Changed

- Bump actions/checkout from 2 to 3 by @dependabot in https://github.com/spatie/global-ray/pull/11
- Bump dependabot/fetch-metadata from 1.3.0 to 1.3.1 by @dependabot in https://github.com/spatie/global-ray/pull/20
- Look for valet site composer file by @jeffreyvr in https://github.com/spatie/global-ray/pull/23

### New Contributors

- @jeffreyvr made their first contribution in https://github.com/spatie/global-ray/pull/23

**Full Changelog**: https://github.com/spatie/global-ray/compare/1.0.4...1.0.5

## 1.0.4 - 2022-03-14

- ability to select a loaded `*.ini` file to install to

## 1.0.3 - 2022-03-09

- A method for installing global-ray manually will now be displayed if updating php.ini fails

## 1.0.2 - 2022-03-03

- add dump phars for each php version

## 1.0.1 - 2022-03-03

- fix links in output

## 1.0.0 - 2022-03-03

- stable release

## 0.0.9 - 2022-03-03

- experimental release

## 0.0.8 - 2022-03-03

- experimental release

## 0.0.7 - 2022-03-03

- experimental release

## 0.0.6 - 2022-03-01

## What's Changed

- Complete windows implementation by @stevebauman in https://github.com/spatie/global-ray/pull/3
- Implement Windows retrying as administrator to update PHP ini by @stevebauman in https://github.com/spatie/global-ray/pull/4

## New Contributors

- @stevebauman made their first contribution in https://github.com/spatie/global-ray/pull/3

**Full Changelog**: https://github.com/spatie/global-ray/compare/0.0.5...0.0.6

## 0.0.2 - 2022-02-23

- experimental release

## 0.0.1 - 2022-02-23

- experimental release

## 1.0.0 - 202X-XX-XX

- initial release
