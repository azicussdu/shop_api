<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            'name' => 'admin',
        ]);
        DB::table('roles')->insert([
            'name' => 'moderator',
        ]);
        DB::table('roles')->insert([
            'name' => 'user',
        ]);
        DB::table('users')->insert([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('123456'),
            'email_verified_at' => now(),
            'role_id'=> '1',
            'remember_token'=> Str::random(25),
            'email_verification_token'=>'',
            'email_verified'=>1,
            'reset_password_token'=>'',
            'ready_to_reset'=>0
        ]);

        DB::table('regions')->insert([
            [
                'name'=>'Акмолинская область'
            ],
            [
                'name'=>'Актюбинская область'
            ],
            [
                'name'=>'Алматинская область'
            ],
            [
                'name'=>'Атырауская область'
            ],
        ]);
        DB::table('cities')->insert([
            [
                'region_id'=>1,
                'zip_code'=>'8359',
                'name'=>'Нур-Султан'
            ],
            [
                'region_id'=>1,
                'zip_code'=>'8360',
                'name'=>'Атбасар'
            ],
            [
                'region_id'=>2,
                'zip_code'=>'8364',
                'name'=>'Акшимрау'
            ],
            [
                'region_id'=>3,
                'zip_code'=>'8408',
                'name'=>'Алматы'
            ],
            [
                'region_id'=>4,
                'zip_code'=>'8427',
                'name'=>'Атырау'
            ],
        ]);
        DB::table('addresses')->insert([
            [
                'address'=>'Дом Ерсына',
                'full_name'=>'Зачем нам это поле?',
                'telephone_number'=>'87021234567',
                'note'=>'ывфывфывфывфыввфыв ыфввфывф фывфы'
            ] ,
            [
                'address'=>'Дом Азамата',
                'full_name'=>'Зачем нам это поле?',
                'telephone_number'=>'87021234567',
                'note'=>'ывфывфывфывфыввфыв ыфввфывф фывфы'
            ] ,
            [
                'address'=>'Дом Галымжана',
                'full_name'=>'Зачем нам это поле?',
                'telephone_number'=>'87021234567',
                'note'=>'ывфывфывфывфыввфыв ыфввфывф фывфы'
            ] ,
        ]);
        DB::table('brands')->insert([
            [
                'name'=>'hewlett packard',
                'alias'=>'hewlett packard',

            ],
            [
                'name'=>'Lenovo',
                'alias'=>'Lenovo',
            ],
            [
                'name'=>'Acer',
                'alias'=>'Acer',
            ],
            [
                'name'=>'louis vuitton',
                'alias'=>'LV',

            ],
            [
                'name'=>'Supreme',
                'alias'=>'Supreme',
            ],
            [
                'name'=>'Samsung',
                'alias'=>'Samsung',
            ],
            [
                'name'=>'Apple',
                'alias'=>'Apple',
            ],

        ]);
        DB::table('categories')->insert([
            [
                'name'=>'Техника и электроника',
                'alias'=>'электротехника',
                'parent_id'=>null,
                'image'=>'no_image.jpg',
            ],
            [
                'name'=>'Компьютерная техника и ПО',
                'alias'=>'комп',
                'parent_id'=>1,
                'image'=>'no_image.jpg'
            ],
            [
                'name'=>'Ноутбуки и нетбуки',
                'alias'=>'ноуты',
                'parent_id'=>2,
                'image'=>'no_image.jpg',
            ],
            [
                'name'=>'Мониторы',
                'alias'=>'моник',
                'parent_id'=>2,
                'image'=>'no_image.jpg'

            ],
            [
                'name'=>'Одежда и обувь',
                'alias'=>'одежда',
                'parent_id'=>null,
                'image'=>'no_image.jpg',
            ],
            [
                'name'=>'Одежда и обувь детские',
                'alias'=>'детское',
                'parent_id'=>5,
                'image'=>'no_image.jpg'

            ],
            [
                'name'=>'Школьная форма',
                'alias'=>'форма',
                'parent_id'=>6,
                'image'=>'no_image.jpg'
            ],
            [
                'name'=>'Одежда и обувь мужское',
                'alias'=>'мужское',
                'parent_id'=>5,
                'image'=>'no_image.jpg'
            ],
            [
                'name'=>'Рубашки мужские',
                'alias'=>'рубкашка',
                'parent_id'=>8,
                'image'=>'no_image.jpg'

            ],
            [
                'name'=>'Дом и сад',
                'alias'=>'дом',
                'parent_id'=>null,
                'image'=>'no_image.jpg',

            ],
            [
                'name'=>'Мебель',
                'alias'=>'мебель',
                'parent_id'=>10,
                'image'=>'no_image.jpg'
            ],
            [
                'name'=>'Надувная мебель',
                'alias'=>'надув',
                'parent_id'=>11,
                'image'=>'no_image.jpg'
            ],
            [
                'name'=>'Антикварная мебель',
                'alias'=>'анттиквар',
                'parent_id'=>11,
                'image'=>'no_image.jpg'
            ],

        ]);
        DB::table('currencies')->insert([
            [
                'name'=>'Тенге',
                'code'=>'KZT',
                'value'=>1,
                'base'=>'1',

            ],
            [
                'name'=>'Доллар США',
                'code'=>'USD',
                'value'=>420,
                'base'=>'0',

            ],
            [
                'name'=>'Евро',
                'code'=>'EUR',
                'value'=>440,
                'base'=>'0',

            ],
            [
                'name'=>'Российский рубль',
                'code'=>'RUB',
                'value'=>5,
                'base'=>'0',

            ],
            [
                'name'=>'Китайский юань',
                'code'=>'CNY',
                'value'=>10,
                'base'=>'0',

            ]
        ]);
        DB::table('orders')->insert([
            [
                'user_id'=>1,
                'status'=>'0',
                'currency_id'=>1,
                'address_id'=>1,

            ],
            [
                'user_id'=>1,
                'status'=>'0',
                'currency_id'=>1,
                'address_id'=>2,

            ],
            [
                'user_id'=>1,
                'status'=>'0',
                'currency_id'=>1,
                'address_id'=>3,

            ],
        ]);
        DB::table('products')->insert([
            [
                'volume' => 1,
                'weight' => 1,
                'name'=>'Ноутбук HP 2RR85EA ProBook',
                'alias'=>'HP-2RR85EA',
                'brand_id'=>1,
                'price'=>441590,
                'image'=>'no_image.jpg'

            ],
            [
                'volume' => 1,
                'weight' => 1,
                'name'=>'Ноутбук Lenovo ThinkPad X1 Carbon 14.0\'\' FHD(1920x1080)',
                'alias'=>'Lenovo-ThinkPad',
                'brand_id'=>2,
                'price'=>160000,
                'image'=>'no_image.jpg'

            ],
            [
                'volume' => 1,
                'weight' => 1,
                'name'=>'Ноутбук Acer (NX.EFAER.122) EX2519/15.6\' HD/Celeron 3060 1.6Ghz/4GB/500GB/Intel HD/DVD-RW/Черный/ DOS',
                'alias'=>'Acer-NX.EFAER.122',
                'brand_id'=>3,
                'price'=>110000,
                'image'=>'no_image.jpg'

            ],
            [
                'volume' => 1,
                'weight' => 1,
                'name'=>'Ноутбук Acer EX2519 / 15.6" / NX.EFAER.025',
                'alias'=>'Acer-NX.EFAER.025',
                'brand_id'=>3,
                'price'=>145000,
                'image'=>'no_image.jpg'

            ],
            [
                'volume' => 1,
                'weight' => 1,
                'name'=>'Монитор Asus MX259H 90LM0190-B01670 (Art:904360528)',
                'alias'=>'Asus-MX259H',
                'brand_id'=>null,
                'price'=>139000,
                'image'=>'no_image.jpg'

            ],
            [
                'volume' => 1,
                'weight' => 1,
                'name'=>'Монитор Acer K202HQLAb UM.IX3EE.A01',
                'alias'=>'Acer-K202HQLAb',
                'brand_id'=>null,
                'price'=>56000,
                'image'=>'no_image.jpg'

            ],
            [
                'volume' => 1,
                'weight' => 1,
                'name'=>'Монитор Dell SE2416H 210-AFZC',
                'alias'=>'Dell-SE2416H',
                'brand_id'=>null,
                'price'=>45134,
                'image'=>'no_image.jpg'

            ],
            [
                'volume' => 1,
                'weight' => 1,
                'name'=>'Пиджак школьный "Колледж"',
                'alias'=>'Пиджак',
                'brand_id'=>null,
                'price'=>4800,
                'image'=>'no_image.jpg'

            ],
            [
                'volume' => 1,
                'weight' => 1,
                'name'=>'Платье школьное со шлицей, воротник стойка, манжеты, р. 44, рост 170 см, цвет чёрный',
                'alias'=>'Платье',
                'brand_id'=>null,
                'price'=>14567,
                'image'=>'no_image.jpg'

            ],
            [
                'volume' => 1,
                'weight' => 1,
                'name'=>'Рубашка ONTHEGO GM',
                'alias'=>'shirt-onthego',
                //'alias'=>'ONTHEGO-GM',
                'brand_id'=>4,
                'price'=>800000,
                'image'=>'no_image.jpg'
            ],
            [
                'volume' => 1,
                'weight' => 1,
                'name'=>'Рубашка Supreme',
                'alias'=>'shirt-supreme',
                'brand_id'=>5,
                'price'=>14490,
                'image'=>'no_image.jpg'

            ],
            [
                'volume' => 1,
                'weight' => 1,
                'name'=>'Матрас надувной Intex DELUX SINGLE-HIGH 64708/64709 [полуторный | двухспальный] (Двуспальный)',
                'alias'=>'p',
                'brand_id'=>null,
                'price'=>14800,
                'image'=>'no_image.jpg'

            ],
            [
                'volume' => 1,
                'weight' => 1,
                'name'=>'Кровать надувная Intex 66768 Pillow Rest Classic',
                'alias'=>'a',
                'brand_id'=>null,
                'price'=>14678,
                'image'=>'no_image.jpg'

            ],
            [
                'volume' => 1,
                'weight' => 1,
                'name'=>'Стол в классическом китайском стиле',
                'alias'=>'s',
                'brand_id'=>null,
                'price'=>500000,
                'image'=>'no_image.jpg'

            ],
            [
                'volume' => 1,
                'weight' => 1,
                'name'=>'Витрина в стиле Рококо',
                'alias'=>'f',
                'brand_id'=>null,
                'price'=>640000,
                'image'=>'no_image.jpg'

            ],
            [
                'volume' => 1,
                'weight' => 1,
                'name'=>'LED монитор Samsung LS22F350FHIXCI',
                'alias'=>'Samsung-LS22F350FHIXCI',
                'brand_id'=>6,
                'price'=>64000,
                'image'=>'no_image.jpg'

            ],
            [
                'volume' => 1,
                'weight' => 1,
                'name'=>'Монитор Samsung LC34F791WQIXCI',
                'alias'=>'Samsung LC34F791WQIXC',
                'brand_id'=>6,
                'price'=>388800,
                'image'=>'no_image.jpg'

            ],
            [
                'volume' => 1,
                'weight' => 1,
                'name'=>'Монитор 23" PHILIPS 234E5QHAW/00 Белый',
                'alias'=>'PHILIPS-234E5QHAW',
                'brand_id'=>null,
                'price'=>102000,
                'image'=>'no_image.jpg'

            ],
            [
                'volume' => 1,
                'weight' => 1,
                'name'=>'Монитор HP EliteDisplay E223 1FH45AA LCD 21.5\'\' [16:9] 1920х1080(FHD) IPS, nonGLARE, nonTOUCH, 250cd/m2, H178°',
                'alias'=>'HP EliteDisplay E223',
                'brand_id'=>1,
                'price'=>93060,
                'image'=>'no_image.jpg'

            ],
            [
                'volume' => 1,
                'weight' => 1,
                'name'=>'Ноутбук Lenovo IP 110S 11,6\'HD/Celeron N3060/32Gb SSD/2Gb/Win10/Red',
                'alias'=>'Lenovo IP 110S',
                'brand_id'=>2,
                'price'=>95000,
                'image'=>'no_image.jpg'

            ],
            [
                'volume' => 1,
                'weight' => 1,
                'name'=>'Ноутбук Asus Zenbook UX333FA-A4181T 13.3\'\' FHD(1920x1080) GLARE/Intel Core i5-8265U 1.60GHz Quad/8GB/256GB SSD',
                'alias'=>'Asus Zenbook UX333FA-A4181T',
                'brand_id'=>null,
                'price'=>120000,
                'image'=>'no_image.jpg'

            ],
            [
                'volume' => 1,
                'weight' => 1,
                'name'=>'Ноутбук Acer Swift 3 SF314-54-876H NX.GZXER.004 14"FHD IPS Core i7-8550U 1.8GHz/max4GHz 8Gb SSD256Gb Linux',
                'alias'=>'Acer Swift 3 SF314-54-876H',
                'brand_id'=>3,
                'price'=>119000,
                'image'=>'no_image.jpg'

            ],
            [
                'volume' => 1,
                'weight' => 1,
                'name'=>'Ноутбук Lenovo Yoga S940-14IIL 14.0FHD Intel® Core i5 1035/8Gb/SSD 512Gb/Win10(81Q8002QRK)',
                'alias'=>'Lenovo Yoga S940-14IIL',
                'brand_id'=>2,
                'price'=>404000,
                'image'=>'no_image.jpg'

            ],
            [
                'volume' => 1,
                'weight' => 1,
                'name'=>'HP 1EP73EA EliteBook 1040 G4 14" Core i5 8Gb SSD 360Gb Win10Pro',
                'alias'=>'HP 1EP73EA EliteBook',
                'brand_id'=>1,
                'price'=>309000,
                'image'=>'no_image.jpg'

            ],
            [
                'volume' => 1,
                'weight' => 1,
                'name'=>'Ноутбук Apple MacBook 12 дюймов (MLH72) Space Gray',
                'alias'=>'Apple MacBook 12',
                'brand_id'=>7,
                'price'=>719000,
                'image'=>'no_image.jpg'

            ],

        ]);
        DB::table('category_product')->insert([
            [
                'category_id'=>3,
                'product_id'=>1,
            ],
            [
                'category_id'=>3,
                'product_id'=>2,
            ],
            [
                'category_id'=>3,
                'product_id'=>3,
            ],
            [
                'category_id'=>3,
                'product_id'=>4,
            ],
            [
                'category_id'=>4,
                'product_id'=>5,
            ],
            [
                'category_id'=>4,
                'product_id'=>6,
            ],
            [
                'category_id'=>4,
                'product_id'=>7,
            ],
            [
                'category_id'=>7,
                'product_id'=>8,
            ],
            [
                'category_id'=>7,
                'product_id'=>9,
            ],
            [
                'category_id'=>9,
                'product_id'=>10,
            ],
            [
                'category_id'=>9,
                'product_id'=>11,
            ],
            [
                'category_id'=>12,
                'product_id'=>12,
            ],
            [
                'category_id'=>12,
                'product_id'=>13,
            ],
            [
                'category_id'=>13,
                'product_id'=>14,
            ],
            [
                'category_id'=>13,
                'product_id'=>15,
            ],
        ]);
        DB::table('order_product')->insert([
            [
                'product_id'=>1,
                'order_id'=>1,
                'pieces'=>1,
                'price'=>441590,
            ],
            [
                'product_id'=>2,
                'order_id'=>2,
                'pieces'=>1,
                'price'=>800000,
            ],
            [
                'product_id'=>3,
                'order_id'=>3,
                'pieces'=>1,
                'price'=>14490,
            ],
        ]);
        DB::table('filter_groups')->insert([
            [
                'name'=>'Цвет',

            ],
            [
                'name'=>'Страна производитель',

            ],
            [
                'name'=>'Скидки',
            ],
            [
                'name'=>'Доставка',
            ]

        ]);
        DB::table('filter_values')->insert([
            [
                'value'=>'белый',
                'filter_group_id'=>1,
            ],
            [
                'value'=>'черный',
                'filter_group_id'=>1,
            ],
            [
                'value'=>'Америка',
                'filter_group_id'=>2,
            ],
            [
                'value'=>'Китай',
                'filter_group_id'=>2,
            ],
            [
                'value'=>'50%',
                'filter_group_id'=>3,
            ],
            [
                'value'=>'10%',
                'filter_group_id'=>3,
            ],
            [
                'value'=>'Нет',
                'filter_group_id'=>4,
            ],
            [
                'value'=>'Есть',
                'filter_group_id'=>4,
            ],
            [
                'value'=>'серый',
                'filter_group_id'=>1,
            ],
            [
                'value'=>'красный',
                'filter_group_id'=>1,
            ],
        ]);
        DB::table('filter_value_product')->insert([
            [
                'product_id'=>1,
                'filter_value_id'=>3,
            ],
            [
                'product_id'=>2,
                'filter_value_id'=>4,
            ],
            [
                'product_id'=>3,
                'filter_value_id'=>3,
            ],
            [
                'product_id'=>4,
                'filter_value_id'=>3,
            ],
            [
                'product_id'=>5,
                'filter_value_id'=>3,
            ],
            [
                'product_id'=>5,
                'filter_value_id'=>7,
            ],
            [
                'product_id'=>6,
                'filter_value_id'=>4,
            ],
            [
                'product_id'=>6,
                'filter_value_id'=>8,
            ],
            [
                'product_id'=>7,
                'filter_value_id'=>3,
            ],
            [
                'product_id'=>7,
                'filter_value_id'=>7,
            ],
            [
                'product_id'=>8,
                'filter_value_id'=>2,
            ],
            [
                'product_id'=>9,
                'filter_value_id'=>1,
            ],
            [
                'product_id'=>10,
                'filter_value_id'=>10,
            ],
            [
                'product_id'=>11,
                'filter_value_id'=>9,
            ],
            [
                'product_id'=>12,
                'filter_value_id'=>7,
            ],
            [
                'product_id'=>13,
                'filter_value_id'=>8,
            ],
            [
                'product_id'=>14,
                'filter_value_id'=>5,
            ],
            [
                'product_id'=>15,
                'filter_value_id'=>6,
            ],
            [
                'product_id'=>16,
                'filter_value_id'=>2,
            ],
            [
                'product_id'=>17,
                'filter_value_id'=>1,
            ],
            [
                'product_id'=>18,
                'filter_value_id'=>1,
            ],
            [
                'product_id'=>19,
                'filter_value_id'=>9,
            ],
            [
                'product_id'=>20,
                'filter_value_id'=>10,
            ],
            [
                'product_id'=>20,
                'filter_value_id'=>4,
            ],
            [
                'product_id'=>20,
                'filter_value_id'=>6,
            ],
            [
                'product_id'=>21,
                'filter_value_id'=>10,
            ],
            [
                'product_id'=>21,
                'filter_value_id'=>3,
            ],
            [
                'product_id'=>22,
                'filter_value_id'=>10,
            ],
            [
                'product_id'=>22,
                'filter_value_id'=>3,
            ],
            [
                'product_id'=>22,
                'filter_value_id'=>5,
            ],
            [
                'product_id'=>23,
                'filter_value_id'=>4,
            ],
            [
                'product_id'=>23,
                'filter_value_id'=>9,
            ],
            [
                'product_id'=>24,
                'filter_value_id'=>3,
            ],
            [
                'product_id'=>24,
                'filter_value_id'=>9,
            ],
            [
                'product_id'=>25,
                'filter_value_id'=>3,
            ],
            [
                'product_id'=>25,
                'filter_value_id'=>9,
            ],
            [
                'product_id'=>25,
                'filter_value_id'=>8,
            ],

        ]);
        // $this->call(UserSeeder::class);
    }
}
