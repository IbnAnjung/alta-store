## ALTA STORE API

Dibangun dengan lumen, sebuah micro framework dari laravel. ini dapat membantu kamu membuat endpoint dari toko online yang kamu buat. beberepa fitur di atnaranya adalah:

- database siap pakai
- melihat seluruh / sebagian dari kategori
- melihat seluruh / sebagian dari Produk
- melihat produk berdasarkan kategori
- menambah, menghapus & melihar daftar belanja
- membuat invoice dari daftar belanja (checkout).
- konfirmasi pembayarn
- menyetujui konfirmasi pembayaran
- middleware Tamu & Admin

### ERD
![ERD](https://lh5.googleusercontent.com/mgPtFQ15xUeXMVS6N0Ko-VePgM1YGIb9y4RRPFvOnsdz_ayYpgFk4ogtvLOY1JqL1eVa0QRvmMDjErye9Z_u=w1366-h568-rw)

## BAGAIMANA CARA MENGGUNAKANNYA ?

- Copy Repo ini git clone https://github.com/IbnAnjung/altastore.git
- Run Composer Install
- Atur konfigurasi 
  - kamu harus memasukan TOKEN_APP & ADMIN_TOKEN
  - TOKEN APP digunakan sebagai key bagi lumen
  - ADMIN_TOKEN digunakan sebagai key ketika ingin melakukan request dengan izin admin
- run php artisan migrate
- run php artisan db:seed jika kamu membutuhkan dummy data.

## BAGAIMANA INI BISA BEKERJA

- setiap request wajib request header berupa x-guest-token = {guest_token}
- token di dapatkan ketika pertama kali mengunjungi endpoint mana pun

## END POINT LISTS

- [GET] /category?page=&limit=
 - show all category 
 - limit - *not* *required* => membatasi jumlah data category
 - page  - *not* *required* => menentukan start awal dan akhir data category 
- [GET] /{idCategory}/products?page=&limit=
  - show all product from category
  - limit - *not* *required* => membatasi jumlah data product
  - page  - *not* *required* => menentukan start awal dan akhir data product
- [GET]/product?page=&limit=
  - show all product
  - limit - *not* *required* => membatasi jumlah data product
  - page  - *not* *required* => menentukan start awal dan akhir data product
- [GET]/product/{idProduct}
  - show product detail 
  - idProduct - requried
- [GET] /cart
  - show all product from cart
- [POST]/cart/store
  - menambahkan data product kedalam cart
  - {qty} - *not* *required*, default: 1, min: 1
  - {product_id} - *required*
- [PATCH]/cart/update/{productId}
  - merubah qty produk didalam cart
  - {qyu} - *required*
- [DELETE]/delete/{productId}
  - menghapus product dari dalam cart
  - {idProduct} - *required*
- [POST] /cart/checkout
  - checkout/ membuat invoice dari cart
  - {product_id} - *array*,
  - {city} - *not* *required* 
  - {phone} - *not* *required*
  - {addreess} - *not* *required*
- [POST]/{checkoutId}/create-invoice
  - membuat invoice dari checkout yang sudah terjadi
  - {checkoutId} - *required*
- [GET]/invoice/{invoiceId}
  - mengambil detail dari invoice
  - {invoiceId} - *required*
- [POST]/payment/confirmation
  - konfirmasi pembayaran invoice
  - {invoice_number} - *not required*
  - {payment_method} - string, eg: transfer
  - {payment_date} - *required*, d-m-Y
  - {payment_total} - *required*, int
  - {to_account} - *required*, string, eg: BCA, a/n ...
-[POST]/payment/approving/{invoiceId}
  - merubah status invoice jadi lunas
  - {invoiceId} - *required*