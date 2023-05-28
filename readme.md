# Bulk Delete DNS Records on a zone - Cloudflare API

_Bulk deleting all DNS Records on a targeted zone. Working only with Cloufdlare services._

New : [🇫🇷 French README](translations/readme-fr.md) available!

## Table of contents

1. [Versions](#versions)
2. [Getting started](#getting-started)
3. [Cloudflare official documentation references](#références-documentation-officielle-cloudflare)

---

## Versions

- **V1.0 (February 2023)** : adds all the DNS records' identifiers in an array by looping over all pages, and loops over this array to delete the related DNS Records. For now, it doesn't consider the required limit of [1 200 requests every 5 minutes](https://developers.cloudflare.com/fundamentals/api/reference/limits/), which can cause an error 429 if the limit is exceeded.

---

## Getting started

Create a "config.php" file to the root of the project.
In this file, add these three mandatory values according to this template :

```php
<?php
    define("X_AUTH_EMAIL", "");
    define("HTTP_TOKEN_AUTH", "");
    define("ZONE_ID", "");
?>
```

- `X_AUTH_EMAIL` : Account ID
- `HTTP_TOKEN_AUTH` : gives the API the right to act on this : all zones - DNS - modify
- `ZONE_ID` : the targeted zone where all DNS records will be deleted

**DON'T TOUCH THE KEYS, ONLY THE VALUES.**<br>
Everything is available on your Cloudflare Dashboard.<br>
When everything is filled, run the script.

---

## Cloudflare official documentation references

[Find your account and zone ids](https://developers.cloudflare.com/fundamentals/get-started/basic-tasks/find-account-and-zone-ids/)<br>
[Requests limits](https://developers.cloudflare.com/fundamentals/api/reference/limits/)<br>
[List DNS records](https://developers.cloudflare.com/api/operations/dns-records-for-a-zone-list-dns-records)<br>
[Delete DNS Records](https://developers.cloudflare.com/api/operations/dns-records-for-a-zone-delete-dns-record)

