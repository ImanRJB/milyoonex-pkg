## Milyoonex Microservice SDK Package

#### How to install

```bash
composer require imanrjb/milyoonex-pkg
```

#### Requires
- PHP >= 8.1
- Lumen >= 9.0

###### Register the Service Provider in bootstrap/app.php for <code>Lumen</code>:

```php
$app->register(Milyoonex\Providers\MilyoonexSdkServiceProvider::class);
```

###### Publish configuration files:

```bash
php artisan vendor:publish --tag=milyoonex-pkg
```

###### Set prefix in route for <code>Lumen</code>:

```php
// Change the route in app.php
$app->router->group([
    'namespace' => 'App\Http\Controllers',
    'prefix' => 'v1'
], function ($router) {
    require __DIR__.'/../routes/web.php';
});
```

#### Validators that exists in package
- National Code (کد ملی)
- IBAN (شماره شبا)
- Credit Card (شماره کارت بانکی)
- Zip Code (کد پستی)
- Shenase Meli (شناسه ملی)
- Mobile (موبایل)
- Phone (تلفن ثابت)
- Username (نام کاربری)
- Unique Dynamic (تشخیص یکتایی دو ستونه)
- Persian Alphabetic (الفبای فارسی)
- Persian Number (اعداد فارسی)

#### Validators Usage

> national_code
>
>A rule for validating Iranian national code [(How calculated)](https://fa.wikipedia.org/wiki/%DA%A9%D8%A7%D8%B1%D8%AA_%D8%B4%D9%86%D8%A7%D8%B3%D8%A7%DB%8C%DB%8C_%D9%85%D9%84%DB%8C#%D8%AD%D8%B3%D8%A7%D8%A8_%DA%A9%D8%B1%D8%AF%D9%86_%DA%A9%D8%AF_%DA%A9%D9%86%D8%AA%D8%B1%D9%84)
```
return [
    'code' => 'required|national_code'
];

For national_code with exeptions code or valid codes for foreign national codes
First step for use this parameters is migrate, php artisan migrate, and save your exeptions in this table 
but if you want to use another table you can set your table and column
return [
    'code' => 'required|national_code:national_code_exceptions' // This is default table that contains exeption codes
    -- OR -- 
    'code' => 'required|national_code:national_code_exceptions,code' // Second parameter is column of exeption table
];

-- OR --

return [
    'code' => ['required', 'national_code']
];

-- OR --

$validatedData = $request->validate([
    'code' => 'national_code',
]);
```

> iban
>
>A rule for validating IBAN (International Bank Account Number) known in Iran as Sheba. [(How calculated)](https://fa.wikipedia.org/wiki/%D8%A7%D9%84%DA%AF%D9%88%D8%B1%DB%8C%D8%AA%D9%85_%DA%A9%D8%AF_%D8%B4%D8%A8%D8%A7#%D8%A7%D9%84%DA%AF%D9%88%D8%B1%DB%8C%D8%AA%D9%85_%DA%A9%D8%AF_%D8%B4%D8%A8%D8%A7)
```
return [
    'account' => 'iban'
];

-- OR --

Add `false` optional parameter after `iban`, If IBAN doesn't begin with `IR`, so the validator will add `IR` as default to the account number:
return [
    'account' => 'iban:false'
];

-- OR --

If you want to validate non Iranian IBAN, add the 2 letters of country code after `false` optional parameter:
return [
    'account' => 'iban:false,DE'
];
```

> credit_card
>
>A rule for validating Iranian credit cards. [(How calculated)](http://www.aliarash.com/article/creditcart/credit-debit-cart.htm)
```
return [
    'code' => 'required|credit_card'
];

-- OR --

return [
    'code' => ['required', 'credit_card']
];

-- OR --

$validatedData = $request->validate([
    'code' => 'credit_card',
]);

-- OR --

You can add an optional parameter if you want to validate a card from a specific bank:
return [
    'code' => 'required|credit_card:bmi'
];

List of the bank codes:

 - bmi (بانک ملی)
 - banksepah (بانک سپه)
 - edbi (بانک توصعه صادرات)
 - bim (بانک صنعت و معدن)
 - bki (بانک کشاورزی)
 - bank-maskan (بانک مسکن)
 - postbank (پست بانک ایران)
 - ttbank (بانک توسعه تعاون)
 - enbank (بانک اقتصاد نوین)
 - parsian-bank (بانک پارسیان)
 - bpi (بانک پاسارگاد)
 - karafarinbank (بانک کارآفرین)
 - sb24 (بانک سامان)
 - sinabank (بانک سینا)
 - sbank (بانک سرمایه)
 - shahr-bank (بانک شهر)
 - bank-day (بانک دی)
 - bsi (بانک صادرات)
 - bankmellat (بانک ملت)
 - tejaratbank (بانک تجارت)
 - refah-bank (بانک رفاه)
 - ansarbank (بانک انصار)
 - mebank (بانک مهر اقتصاد)
```

> zip_code
```
return [
    'code' => 'required|zip_code'
];

--OR--

return [
    'code' => ['required, 'zip_code']
];

--OR--

$validatedData = $request->validate([
    'code' => 'zip_code',
]);
```

> shenase_meli
>
>A rule for validating Iranian shenase meli [(How calculated)](http://www.aliarash.com/article/shenasameli/shenasa_meli.htm)
```
return [
    'code' => 'required|shenase_meli'
];

--OR--

return [
    'code' => ['required, 'shenase_meli']
];

--OR--

$validatedData = $request->validate([
    'code' => 'shenase_meli',
]);
```

> mobile
```
return [
    'mobile' => 'required|mobile'
];

--OR--

return [
    'mobile' => ['required, 'mobile']
];

--OR--

$validatedData = $request->validate([
    'mobile' => 'mobile',
]);
```

> username (Valid characters: English Alphabetic, Numbers and _)
```
return [
    'username' => 'required|username'
];

--OR--

return [
    'username' => ['required, 'username']
];

--OR--

$validatedData = $request->validate([
    'username' => 'username',
]);
```

> phone
```
return [
    'phone' => 'required|phone'
];

--OR--

return [
    'phone' => ['required, 'phone']
];

--OR--

$validatedData = $request->validate([
    'phone' => 'phone',
]);
```

> unique_dynamic (table_name, target_column, extra_column, extra_column_value, ignore_column, ignore_column_value)
```
return [
    // Without ignore for create user, 4 parameters
    // If we want to check a username is unique in users table when type of this useranme equal student
    // If username = 'v.ashourzadeh' and type = 'student' you can't create username = 'v.ashourzadeh' but create username = 'v.ashourzadeh' if type = 'teacher'
    'username' => 'required|unique_dynamic:users,username,type,student'

    // With ignore for edit user, 6 parameters
    // If we want to check a username is unique in users table and ignore this for special id, for example id = 5
    // If username = 'v.ashourzadeh' and type = 'student' you can set username = 'v.ashourzadeh' when id = 5
    'username' => 'required|unique_dynamic:users,username,type,student,id,5'
];

--OR--

return [
    // Without ignore for create user, 4 parameters
    'username' => ['required, 'unique_dynamic:users,username,type,student']

    // With ignore for edit user, 6 parameter
    'username' => ['required, 'unique_dynamic:users,username,type,student,id,5']
];

--OR--

$validatedData = $request->validate([
    // Without ignore for create user, 4 parameters
    'username' => 'unique_dynamic:users,username,type,student',
    // With ignore for edit user, 6 parameter
    'username' => 'unique_dynamic:users,username,type,student,id,5',
]);
```

> persian_alphabetic
```
return [
    'code' => 'required|persian_alphabetic'
];

--OR--

return [
    'code' => ['required, 'persian_alphabetic']
];

--OR--

$validatedData = $request->validate([
    'code' => 'persian_alphabetic',
]);
```

> persian_number
```
return [
    'code' => 'required|persian_number'
];

--OR--

return [
    'code' => ['required, 'persian_number']
];

--OR--

$validatedData = $request->validate([
    'code' => 'persian_number',
]);
```
