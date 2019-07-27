[![Build Status](https://travis-ci.org/francis94c/openapi-parser.svg?branch=master)](https://travis-ci.org/francis94c/openapi-parser) [![Coverage Status](https://coveralls.io/repos/github/francis94c/openapi-parser/badge.svg?branch=master)](https://coveralls.io/github/francis94c/openapi-parser?branch=master) ![Latest Release](https://img.shields.io/github/release/francis94c/openapi-parser.svg) ![Commits](https://img.shields.io/github/last-commit/francis94c/openapi-parser.svg)
# openapi-parser
![Swagger](https://res.cloudinary.com/francis94c/image/upload/v1563332638/Swagger-logo.png)

A Code Igniter Package for Rendering Swagger Docs Open API Schema (JSON &amp; YAML(later)).

__NB:__ This library hasn't been released on splint because it's still in development. To use/test/install, you'll have to clone this repository using `git clone <repo_url>` under `application/splints/francis94c`.

### Installation ###
Download and Install Splint from https://splint.cynobit.com/downloads/splint and run the below from the root of a Code Igniter distribution.
```bash
splint install francis94c/openapi-parser
```
### Usage ###
Top load the library, use
```php
$this->load->package("francis94c/openapi-parser", "parser");
```
Then render an Open API Spec JSON file.

```php
$this->parser->parse("path_to_spec_file.json");
```
