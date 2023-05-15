# Suppression de masse des enregistrements DNS d'une zone - API Cloudflare

_Supprime, à la chaine, tous les enregistrements DNS d'une zone ciblée. Ne fonctionne que pour Cloudflare._

## Table des matières

1. [Versions](#versions-versions)
2. [Mise en place](#mise-en-place-mep)
3. [Références documentation officielle Cloudflare](#références-documentation-officielle-cloudflare-refs-doc)

## Versions {#versions}

- **V1.0 (février 2023)** : ajoute tous les identifiants des enregistrements DNS dans une liste, page par page, puis boucle sur cette liste pour supprimer les enregistrements DNS ciblés.
  Ne prend actuellement pas en compte la limite requise de [1 200 requêtes toutes les 5 minutes](https://developers.cloudflare.com/fundamentals/api/reference/limits/), ce qui peut amener des erreurs 429 si la limite est excédée.

---

## Mise en place {#mep}

Dans le fichier [config.php](/config.php) fourni, entrer les trois valeurs nécessaires :

- `X_AUTH_EMAIL` : jeton à fournir lors des appels API
- `HTTP_TOKEN_AUTH` : correspond à la clé d'API
- `ZONE_ID` : la zone dans laquelle vous voulez effectuer la suppression à la chaine des domaines.

**NE PAS TOUCHER AUX CLÉS, SEULEMENT À LEURS VALEURS SI BESOIN.**<br>
Tout s'obtient depuis votre tableau de bord Cloudflare.
Lorsque tout est rempli, exécuter le script.

---

## Références documentation officielle Cloudflare {#refs-doc}

[Limites de requêtes](https://developers.cloudflare.com/fundamentals/api/reference/limits/)<br>
[Lister les enregistrements DNS](https://developers.cloudflare.com/api/operations/dns-records-for-a-zone-list-dns-records)<br>
[Supprimer les enregistrements DNS](https://developers.cloudflare.com/api/operations/dns-records-for-a-zone-delete-dns-record)

