# 📚 Kitap Alıntıları Uygulaması

Bu web sitesi, kullanıcıların okudukları kitaplardan dijital olarak alıntı kaydı yapabileceği, isterlerse kendi yorumlarını ekleyebileceği basit bir sistemdir. Kullanıcılar kayıt olabilir, giriş yapabilir ve yeni alıntılar kaydedebilir ve bu alıntıları güncelleyebilir.

## 🚀 Özellikler

- 👤 Kullanıcı Kaydı ve Girişi

Kullanıcılar ilk kayıtta bir kullanıcı adı, takma ad, ve şifre belirler. Takma ad site içinde kullanılacaktır ve eşsiz olmak zorunda değildir. Kullanıcı adı eşsiz olmalıdır ve şifreyle birlikte oturum açmada kullanılır.
![](images/register.png)


- 📝 Alıntı Ekleme (Kitap adı, yazar, alıntı ve yorum)

Kullanıcı istediği alıntıyı kitap adı, yazarı ve alıntının kendisi zorunlu olmak üzere kendi hesabına kaydedebilir. Yorum alanı isteğe göre doldurulabilir veya boş bırakılabilir.
![](images/add_quote.png)


- 📋 Alıntıları Listeleme (Giriş yapan kullanıcıya özel)

Kullanıcının bütün alıntıları giriş yaptığında ana sayfada en yeni kayıttan eskiye doğru listelenir.
![](images/dashboard.png)


- ✏️ Alıntıları Düzenleme

Kullanıcılar alıntı kayıtlarıyla ilgili diledikleri her şeyi değiştirebilir. Kitap adı, yazarı ve alıntı alanı boş bırakılamaz.
![](images/edit_quote.png)


- 🗑️ Alıntı Silme

Kullanıcılar alıntılarını silebilir. Uyarı mesajını onayladıktan sonra bu işlemin geri dönüşü yoktur.
![](images/delete_quote.png)

---

## 🛠️ Localhost'ta Çalıştırmak için:

1. **XAMPP** yerel sunucusunu kurun.
2. `kitap_alintilari` klasörünü `\xampp\htdocs` klasörü içine yerleştirin.
3. xampp kontrol panelinde Apache ve MySQL başlatın.
4. Tarayıcı üzerinden localhost'ta `kitap_alintilari` adlı veritabanı oluşturun.
    - Veritabanı içine `kitap_alintilari.sql` dosyasındaki CREATE TABLE komutlarıyla tabloları oluşturun.
5. localhost/kitap_alintilari/register.php adresinden siteye erişim sağlayabilirsiniz.

---
[YouTube uygulama videosunu izlemek için tıklayın.](https://youtu.be/UsPw3P8S-g8)




