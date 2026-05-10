# Dokumentácia – Semestrálny projekt: Dopamine Store

## 1. Zadanie

Vytvorenie webovej aplikácie – e-shopu zameraného na predaj čerstvého ovocia. Aplikácia realizuje klientskú časť (prehliadanie produktov, košík, objednávka, registrácia/prihlásenie) a administrátorskú časť (správa produktov – pridanie, úprava, vymazanie). Implementácia je postavená na PHP frameworku Laravel s renderovaním na strane servera (SSR).

---

## 2. Diagram fyzického dátového modelu

Oproti 1. fáze bol dátový model rozšírený o:
- stĺpec `is_admin` (BOOLEAN, DEFAULT false) v tabuľke `users` – pre rozlíšenie roly administrátora
- tabuľka `sessions` – pre správu relácií (súčasť štandardnej Laravel migrácie)

### Tabuľky a vzťahy

```
users
  id (PK)
  name
  email (UNIQUE)
  password
  is_admin (BOOLEAN, DEFAULT false)
  email_verified_at
  remember_token
  timestamps

products
  id (PK)
  name
  price (DECIMAL 10,2)
  description (TEXT)
  stock (UNSIGNED INT, DEFAULT 0)
  category (STRING)
  url (STRING)
  slug (STRING)
  unit (ENUM: kg | pcs)
  timestamps

product_images
  id (PK)
  product_id (FK → products.id, CASCADE DELETE)
  image_path
  alt_text
  timestamps

carts
  id (PK)
  user_id (FK → users.id, NULL ON DELETE, UNIQUE, NULLABLE)
  session_id (STRING, UNIQUE, NULLABLE)
  timestamps

cart_items
  id (PK)
  cart_id (FK → carts.id, CASCADE DELETE)
  product_id (FK → products.id, CASCADE DELETE)
  quantity (UNSIGNED INT, DEFAULT 1)
  unit_price (DECIMAL 10,2)
  timestamps
  UNIQUE(cart_id, product_id)

orders
  id (PK)
  user_id (FK → users.id, NULL ON DELETE, NULLABLE)
  session_id (STRING, NULLABLE)
  delivery_method (STRING)
  payment_method (STRING)
  status (STRING, DEFAULT 'new')
  total_price (DECIMAL 10,2)
  customer_name
  email
  phone
  address
  city
  zip_code
  timestamps

order_items
  id (PK)
  order_id (FK → orders.id, CASCADE DELETE)
  product_id (FK → products.id, RESTRICT ON DELETE)
  quantity (UNSIGNED INT)
  unit_price (DECIMAL 10,2)
  timestamps

sessions
  id (PK)
  user_id (NULLABLE, INDEX)
  ip_address
  user_agent
  payload (LONGTEXT)
  last_activity (INDEX)

password_reset_tokens
  email (PK)
  token
  created_at
```

### Vzťahy medzi entitami

- `users` 1:1 `carts` (jeden používateľ má jeden košík)
- `users` 1:N `orders`
- `carts` 1:N `cart_items`
- `products` 1:N `cart_items`
- `products` 1:N `product_images`
- `products` 1:N `order_items`
- `orders` 1:N `order_items`

---

## 3. Návrhové rozhodnutia

### Rola administrátora

Rolu administrátora sme riešili pridaním stĺpca `is_admin` (BOOLEAN) do tabuľky `users`. Nevytvárali sme samostatnú tabuľku rolí ani polymorfné oprávnenia, pretože aplikácia rozlišuje iba dve role – bežný používateľ a administrátor. Toto riešenie je jednoduché a dostatočné pre daný rozsah projektu.

V modeli `User` je metóda `isAdmin()`, ktorá vracia `true` ak má používateľ `is_admin = true`. Admin-trasy sú chránené vlastným middlewarom `IsAdmin`, ktorý vracia HTTP 403 pre neoprávnených používateľov. V Blade šablónach sa admin tlačidlá zobrazujú len pri splnení podmienky `auth()->user()->isAdmin()`.

### Prenositeľnosť košíka

Košík funguje pre prihlásených aj neprihlásených používateľov. Pre neprihlásených je košík identifikovaný cez `session_id`, pre prihlásených cez `user_id`. Pri registrácii počas procesu objednávky (checkout) sa obsah sessionového košíka automaticky prenesie do košíka nového používateľa pomocou metódy `attachSessionCartToUser()`.

### Bez externých knižníc (frontend)

Pre CSS sme použili **Tailwind CSS** cez CDN (`@tailwindcss/browser@4`) – nevyžaduje inštaláciu cez npm pre produkčné účely v rámci projektu. Fonty načítavame z Google Fonts (Manrope). Žiadne ďalšie externé JS knižnice neboli použité.

### Vyhľadávanie

Fulltext vyhľadávanie je implementované ako LIKE query nad stĺpcami `name` a `category` v tabuľke `products`. Navyše je implementovaný AJAX endpoint `/search-suggestions`, ktorý vracia až 5 návrhov v reálnom čase (s debounce 300 ms) bez znovunačítania stránky.

### Skladová logika

Pri pridaní do košíka a pri finalizácii objednávky sa overuje dostupnosť skladu (`stock`). Pri dokončení objednávky sa používa `DB::transaction` a `lockForUpdate()` pre ochranu pred race condition pri súbežných objednávkach.

### Obrázky produktov

Obrázky sa ukladajú na disk (`storage/app/public/products`) cez Laravel Storage. Produkt môže mať viac obrázkov. Na stránke produktu a v kartičke produktu sa zobrazuje hover efekt – pri prejdení myšou sa zobrazí druhý obrázok (ak existuje). Pri vymazaní produktu alebo konkrétneho obrázku sa fyzicky vymaže súbor zo storage.

---

## 4. Programovacie prostredie

| Položka | Hodnota |
|---|---|
| Backend framework | Laravel 12 (PHP 8.2+) |
| Databáza | SQLite (súbor `database/database.sqlite`) |
| Frontend CSS | Tailwind CSS v4 (via CDN) |
| Fonty | Google Fonts – Manrope |
| Renderovanie | Server-side rendering (Blade šablóny) |
| Ukladanie súborov | Laravel Storage (lokálny disk `public`) |

> Odporúčané prostredie podľa zadania je PostgreSQL. V projekte sme použili SQLite z dôvodu jednoduchšieho lokálneho vývoja. Migrácie sú kompatibilné s PostgreSQL bez zmien.

---

## 5. Stručný opis implementácie vybraných prípadov použitia

### 5.1 Zmena množstva pre daný produkt (košík)

V košíku (`cart.blade.php`) má každá položka dve tlačidlá – zníženie (`−`) a zvýšenie (`+`). Každé tlačidlo odošle PATCH request na príslušnú routu:

- `PATCH /cart/items/{item}/decrease` → `CartController@decrease`
- `PATCH /cart/items/{item}/increase` → `CartController@increase`

V kontroléri sa overí, že položka patrí aktuálnemu košíku (ochrana pred manipuláciou iných košíkov). Pri znížení sa množstvo zníži len ak je väčšie ako 1. Pri zvýšení sa overí dostupnosť skladu.

### 5.2 Prihlásenie používateľa

Prihlásenie je implementované v `AuthController`. Formulár odosiela POST na `/login`. Kontrolér validuje email a heslo, pri nesprávnych údajoch vráti späť s chybovou hláškou. Pri úspechu sa vygeneruje nové session ID (`regenerate()`) a používateľ je presmerovaný na shop. Odhlásenie zneplatní session a vygeneruje nový CSRF token.

Admin sa prihlasuje rovnakým formulárom ako bežný používateľ – rozlišovanie prebieha na základe hodnoty `is_admin` v databáze, nie samostatným prihlasovacím formulárom.

### 5.3 Vyhľadávanie

Fulltext vyhľadávanie funguje na dvoch úrovniach:

1. **Stránka `/shop`** – parameter `search` v GET požiadavke. `ShopController@index` pridá do Eloquent query podmienku `WHERE name LIKE '%...%' OR category LIKE '%...%'`. Výsledky sa stránkujú rovnako ako bežný výpis.

2. **Live návrhy** – v hlavičke je input, ktorý pri každej zmene (s debounce 300 ms) posiela AJAX GET na `/search-suggestions`. Endpoint `ShopController@suggestions` vrátia JSON s max. 5 produktmi (id, name, slug, category, price, image). Výsledky sa vykreslia pod vyhľadávacím poľom bez obnovenia stránky.

### 5.4 Pridanie produktu do košíka

Na stránke detailu produktu (`product.blade.php`) je formulár s číselným inputom pre množstvo. Po odoslaní ide POST na `CartController@addAmount`. Kontrolér:
1. Nájde alebo vytvorí košík (podľa `user_id` alebo `session_id`).
2. Skontroluje, či produkt nie je vypredaný.
3. Ak položka v košíku už existuje, aktualizuje množstvo (overí voči skladu).
4. Ak položka neexistuje, vytvorí novú `CartItem`.
5. Presmeruje na stránku košíka.

Z výpisu produktov (shop) funguje tlačidlo cez `CartController@add`, ktoré pridáva vždy 1 kus.

### 5.5 Stránkovanie

Stránkovanie je implementované pomocou Eloquent metódy `paginate(8)` s `withQueryString()` – zachováva všetky aktuálne filtre a parametre v URL pri navigácii na ďalšiu/predchádzajúcu stranu. V šablóne `shop.blade.php` sa zobrazujú tlačidlá Prev/Next s aktuálnou stranou a celkovým počtom strán. Na homepage (`HomeController`) sa stránkuje 4 produkty podľa popularity (podľa celkového predaného množstva).

### 5.6 Základné filtrovanie

Filtrovanie je dostupné na stránke `/shop` cez panel (Filters). Implementované filtre:

| Filter | Parameter | Implementácia |
|---|---|---|
| Kategória | `category` | `WHERE category = ?` |
| Cena od | `price_min` | `WHERE price >= ?` |
| Cena do | `price_max` | `WHERE price <= ?` |
| Dostupnosť | `stock` (`instock`/`soldout`) | `WHERE stock > 0` alebo `WHERE stock <= 0` |
| Zoradenie | `sort` (`price_asc`/`price_desc`) | `ORDER BY price ASC/DESC` |

Všetky filtre je možné kombinovať. Filtre sú uchovávané v URL query parametroch, čo umožňuje zdieľanie a záložkovanie výsledkov.

---

## 6. Administrátorská časť

### Prihlásenie administrátora

Administrátor sa prihlasuje rovnakým formulárom ako bežný zákazník (`/login`). Rozlíšenie prebieha na základe hodnoty `is_admin = true` v databáze. Po prihlásení sa administrátorovi zobrazujú tlačidlá Edit/Delete pri každom produkte a tlačidlo „Add new product" na stránke shopu. Všetky admin-trasy (`/admin/*`) sú chránené middlewarom `auth` + `admin` (vlastný `IsAdmin` middleware), takže priamy prístup cez URL nie je možný bez oprávnenia.

### Zoznam produktov

Administrátor vidí zoznam všetkých produktov na stránke `/shop` rovnako ako zákazník, ale s pridanými tlačidlami Edit a Delete pri každej produktovej kartičke.

### Pridanie produktu

`GET /admin/create` zobrazí formulár (`admin/create.blade.php`).  
`POST /admin/create` → `AdminController@create`:
- Validuje povinné polia: name, description, price, quantity, images (min. 1), category, unit.
- Vytvorí záznam `Product` s automaticky generovaným `slug` (Str::slug).
- Uloží každý obrázok na disk (`storage/app/public/products`) a vytvorí záznamy `ProductImage`.
- Formulár obsahuje `select` pre kategóriu (stone/exotic/citrus/pome/boxes) a jednotku (kg/pcs) – ide o číselníkové polia.

### Úprava produktu

`GET /admin/edit/{slug}` zobrazí formulár (`admin/edit.blade.php`) s predvyplnenými hodnotami.  
`PATCH /admin/edit/{slug}` → `AdminController@edit`:
- Validuje rovnaké polia ako pri vytvorení (obrázky sú voliteľné – môžu sa pridať nové).
- Aktualizuje produkt, vrátane slug a URL.
- Nové obrázky sa uložia a pridajú k existujúcim.
- Na formulári je zoznam existujúcich obrázkov, každý s tlačidlom na vymazanie (`DELETE /admin/delete-img/{id}` → `AdminController@deleteImg`), ktoré fyzicky vymaže súbor a záznam z DB.

### Vymazanie produktu

`DELETE /admin/delete/{slug}` → `AdminController@delete`:
- Načíta produkt so závislosťami (images, orderItems).
- Fyzicky vymaže všetky obrázky zo storage.
- Vymaže záznamy `ProductImage` a `OrderItem`.
- Vymaže produkt z databázy.
- Presmeruje na stránku shopu.

---

## 7. Snímky obrazoviek

> Snímky obrazoviek sú priložené ako samostatné súbory v priečinku `docs/screenshots/`:

| Obrazovka | Súbor |
|---|---|
| Homepage | `screenshot-homepage.png` |
| Prihlásenie | `screenshot-login.png` |
| Detail produktu | `screenshot-product.png` |
| Nákupný košík s produktom | `screenshot-cart.png` |
| Shop – výpis produktov | `screenshot-shop.png` |
| Admin – pridanie produktu | `screenshot-admin-create.png` |
| Admin – úprava produktu | `screenshot-admin-edit.png` |
