Acme Widget
---

1. Uruchomienie projektu:

   ```bash
   php index.php
   ```

2. `Basket::add(string $code): Basket` - dodawanie produktów do koszyka.
3. `Basket::total(): float` - ostateczny koszt zamówienia. Uwzględnia zasady dostaw oraz rabaty.

Podczas realizacji projektu zależało mi na stworzeniu czytelnego kodu,
oraz zrealizowaniu dokładnie tego i tylko tego co znalazło się w wymaganiach.
Zrezygnowałem z implementacji kodu "na zapas", który mógłby się teoretycznie
przydać do dalszego rozwoju projektu ecommerce.

Jeżeli jednak musiałbym przygotować ten projekt do dalszego rozwoju, wprowadziłbym
następujące modyfikacje:
  - rodzielenie interfejsu Basket - osobny interfejs zewnętrzny, do obsług zmówienia,
    osobny "bezpieczny" interfejs dla DeliveryRule i Offer
  - wyliczanie ofert, szczególnie rabatów na produkty, na poziomie lini produktowej,
    a nie całego zamówienia
