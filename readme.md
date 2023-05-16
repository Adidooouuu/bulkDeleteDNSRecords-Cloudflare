# Suppression en masse des enregistrements DNS d'une zone - API Cloudflare

_Supprime, à la chaine, tous les enregistrements DNS d'une zone ciblée. Ne fonctionne que pour Cloudflare._

## Table des matières

1. [Versions](#versions)
2. [Mise en place](#mise-en-place)
3. [Références documentation officielle Cloudflare](#références-documentation-officielle-cloudflare)

---

## Versions

- **V1.0 (février 2023)** : ajoute tous les identifiants des enregistrements DNS dans une liste, page par page, puis boucle sur cette liste pour supprimer les enregistrements DNS ciblés.
  Ne prend actuellement pas en compte la limite requise de [1 200 requêtes toutes les 5 minutes](https://developers.cloudflare.com/fundamentals/api/reference/limits/), ce qui peut amener des erreurs 429 si la limite est excédée.

---

## Mise en place

Créer un fichier [config.php](/config.php) à la racine du projet. Si vous avez réussi, ce lien fonctionnera.
Dans ce fichier, entrer les trois valeurs nécessaires à partir de ce modèle :

```php
<?php
    define("X_AUTH_EMAIL", "");
    define("HTTP_TOKEN_AUTH", "");
    define("ZONE_ID", "");
?>
```

- `X_AUTH_EMAIL` : identifiant de compte
- `HTTP_TOKEN_AUTH` : autorise l'API à effectuer les actions pour laquelle cette clé a été paramétrée
- `ZONE_ID` : la zone dans laquelle vous voulez effectuer la suppression à la chaine des enregistrements de domaines

**NE PAS TOUCHER AUX CLÉS, SEULEMENT À LEURS VALEURS SI BESOIN.**<br>
Tout s'obtient depuis votre tableau de bord Cloudflare.<br>
Lorsque tout est rempli, exécuter le script.

---

## Références documentation officielle Cloudflare

[Trouver vos identifiants de compte et de zone](https://developers.cloudflare.com/fundamentals/get-started/basic-tasks/find-account-and-zone-ids/)<br>
[Limites de requêtes](https://developers.cloudflare.com/fundamentals/api/reference/limits/)<br>
[Lister les enregistrements DNS](https://developers.cloudflare.com/api/operations/dns-records-for-a-zone-list-dns-records)<br>
[Supprimer les enregistrements DNS](https://developers.cloudflare.com/api/operations/dns-records-for-a-zone-delete-dns-record)
