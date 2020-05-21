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
                'city_id'=>1,
                'zip_code'=>'6666',
                'address'=>'Дом Ерсына',
                'full_name'=>'Зачем нам это поле?',
                'telephone_number'=>'87021234567',
                'note'=>'ывфывфывфывфыввфыв ыфввфывф фывфы'
            ] ,
            [
                'city_id'=>2,
                'zip_code'=>'6666',
                'address'=>'Дом Азамата',
                'full_name'=>'Зачем нам это поле?',
                'telephone_number'=>'87021234567',
                'note'=>'ывфывфывфывфыввфыв ыфввфывф фывфы'
            ] ,
            [
                'city_id'=>3,
                'zip_code'=>'6666',
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
                /*'description'=>'Hewlett-Packard — одна из крупнейших американских компаний в сфере информационных
                технологий, существовавшая в период 1939—2015 годов',
                //'image'=>'',*/

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
                /*'description'=>'ОписаниеLouis Vuitton — французский дом моды,
                специализирующийся на производстве чемоданов и сумок, модной одежды,
                парфюмерии и аксессуаров класса «люкс» под одноимённой торговой маркой.',
                //'image'=>'',*/

            ],
            [
                'name'=>'Supreme',
                'alias'=>'Supreme',
                /*'description'=>'Supreme — американский стритвер-бренд одежды, основанный в Нью-Йорке в апреле 1994 года',
                //'image'=>'',*/

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
               // 'keyword'=>'электротехника',
                //'description'=>'',
                'image'=>'no_image.jpg',
            ],
            [
                'name'=>'Компьютерная техника и ПО',
                'alias'=>'комп',
                'parent_id'=>1,
                'image'=>'12746992_w230_h230_kompyuternaya-tehnika-i.jpg'
            ],
            [
                'name'=>'Ноутбуки и нетбуки',
                'alias'=>'ноуты',
                'parent_id'=>2,
                //'keyword'=>'ноуты',
                //'description'=>'',
                'image'=>'72624213_w230_h230_noutbuki-i-netbuki.jpg',
            ],
            [
                'name'=>'Мониторы',
                'alias'=>'моник',
                'parent_id'=>2,
                'image'=>'11632477_w230_h230_monitory.jpg'

            ],
            [
                'name'=>'Одежда и обувь',
                'alias'=>'одежда',
                'parent_id'=>null,
                //'keyword'=>'шмот',
                //'description'=>'',
                'image'=>'no_image.jpg',
            ],
            [
                'name'=>'Одежда и обувь детские',
                'alias'=>'детское',
                'parent_id'=>5,
                'image'=>'82119649_w230_h230_odezhda-i-obuv.jpg'

            ],
            [
                'name'=>'Школьная форма',
                'alias'=>'форма',
                'parent_id'=>6,
                'image'=>'11780224_w230_h230_shkolnaya-forma.jpg'
            ],
            [
                'name'=>'Одежда и обувь мужское',
                'alias'=>'мужское',
                'parent_id'=>5,
                'image'=>'82119662_w230_h230_odezhda-muzhskaya.jpg'
            ],
            [
                'name'=>'Рубашки мужские',
                'alias'=>'рубкашка',
                'parent_id'=>8,
                'image'=>'82130822_w230_h230_rubashki-muzhskie.jpg'

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
                'image'=>'10916561_w230_h230_mebel.jpg'
            ],
            [
                'name'=>'Надувная мебель',
                'alias'=>'надув',
                'parent_id'=>11,
                'image'=>'10916580_w230_h230_naduvnaya-mebel.jpg'
            ],
            [
                'name'=>'Антикварная мебель',
                'alias'=>'анттиквар',
                'parent_id'=>11,
                'image'=>'10916608_w230_h230_antikvarnaya-mebel.jpg'
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
                'name'=>'Ноутбук HP 2RR85EA ProBook',
                'alias'=>'HP-2RR85EA',
                'brand_id'=>1,
                'price'=>441590,
                'image'=>'77286631_w200_h200_noutbuk-hp-probook.jpg'

            ],
            [
                'name'=>'Ноутбук Lenovo ThinkPad X1 Carbon 14.0\'\' FHD(1920x1080)',
                'alias'=>'Lenovo-ThinkPad',
                'brand_id'=>2,
                'price'=>160000,
                'image'=>'117115501_w200_h200_noutbuk-lenovo-thinkpad.jpg'

            ],
            [
                'name'=>'Ноутбук Acer (NX.EFAER.122) EX2519/15.6\' HD/Celeron 3060 1.6Ghz/4GB/500GB/Intel HD/DVD-RW/Черный/ DOS',
                'alias'=>'Acer-NX.EFAER.122',
                'brand_id'=>3,
                'price'=>110000,
                'image'=>'115229591_w640_h640_noutbuk-acer-nxefaer122.jpg'

            ],
            [
                'name'=>'Ноутбук Acer EX2519 / 15.6" / NX.EFAER.025',
                'alias'=>'Acer-NX.EFAER.025',
                'brand_id'=>3,
                'price'=>145000,
                'image'=>'125363494_w640_h640_noutbuk-acer-ex2519.jpg'

            ],
            [
                'name'=>'Монитор Asus MX259H 90LM0190-B01670 (Art:904360528)',
                'alias'=>'Asus-MX259H',
                'brand_id'=>null,
                'price'=>139000,
                'image'=>'45894023_w640_h640_monitor-asus-mx259h.jpg'

            ],
            [
                'name'=>'Монитор Acer K202HQLAb UM.IX3EE.A01',
                'alias'=>'Acer-K202HQLAb',
                'brand_id'=>null,
                'price'=>56000,
                'image'=>'87002914_w640_h640_monitor-acer-k202hqlab.jpg'

            ],
            [
                'name'=>'Монитор Dell SE2416H 210-AFZC',
                'alias'=>'Dell-SE2416H',
                'brand_id'=>null,
                'price'=>45134,
                'image'=>'86584231_w640_h640_monitor-dell-se2416h.jpg'

            ],
            [
                'name'=>'Пиджак школьный "Колледж"',
                'alias'=>'Пиджак',
                'brand_id'=>null,
                'price'=>4800,
                'image'=>'101290132_w640_h640_pidzhak-shkolnyj-kolledzh.jpg'

            ],
            [
                'name'=>'Платье школьное со шлицей, воротник стойка, манжеты, р. 44, рост 170 см, цвет чёрный',
                'alias'=>'Платье',
                'brand_id'=>null,
                'price'=>14567,
                'image'=>'122552292_w640_h640_plate-shkolnoe-so.jpg'

            ],
            [
                'name'=>'Рубашка ONTHEGO GM',
                'alias'=>'shirt-onthego',
                //'alias'=>'ONTHEGO-GM',
                'brand_id'=>4,
                'price'=>800000,
                'image'=>'117961268_w640_h640_rubashka-muzhskaya-gongl.jpg'
            ],
            [
                'name'=>'Рубашка Supreme',
                'alias'=>'shirt-supreme',
                'brand_id'=>5,
                'price'=>14490,
                'image'=>'113491507_w640_h640_rubashka-red-polo.jpg'

            ],
            [
                'name'=>'Матрас надувной Intex DELUX SINGLE-HIGH 64708/64709 [полуторный | двухспальный] (Двуспальный)',
                'alias'=>'p',
                'brand_id'=>null,
                'price'=>14800,
                'image'=>'76660831_w640_h640_matras-naduvnoj-intex.jpg'

            ],
            [
                'name'=>'Кровать надувная Intex 66768 Pillow Rest Classic',
                'alias'=>'a',
                'brand_id'=>null,
                'price'=>14678,
                'image'=>'9945242_w640_h640_krovat-naduvnaya-intex.jpg'

            ],
            [
                'name'=>'Стол в классическом китайском стиле',
                'alias'=>'s',
                'brand_id'=>null,
                'price'=>500000,
                'image'=>'96581051_w640_h640_stol-v-klassicheskom.jpg'

            ],
            [
                'name'=>'Витрина в стиле Рококо',
                'alias'=>'f',
                'brand_id'=>null,
                'price'=>640000,
                'image'=>'96054813_w640_h640_vitrina-v-stile.jpg'

            ],
            [
                'name'=>'LED монитор Samsung LS22F350FHIXCI',
                'alias'=>'Samsung-LS22F350FHIXCI',
                'brand_id'=>6,
                'price'=>64000,
                'image'=>'106697615_w640_h640_led-monitor-samsung.jpg'

            ],
            [
                'name'=>'Монитор Samsung LC34F791WQIXCI',
                'alias'=>'Samsung LC34F791WQIXC',
                'brand_id'=>6,
                'price'=>388800,
                'image'=>'75273701_w640_h640_monitor-samsung-lc34f791wqixci.jpg'

            ],
            [
                'name'=>'Монитор 23" PHILIPS 234E5QHAW/00 Белый',
                'alias'=>'PHILIPS-234E5QHAW',
                'brand_id'=>null,
                'price'=>102000,
                'image'=>'63786298_w640_h640_monitor-23-philips.jpg'

            ],
            [
                'name'=>'Монитор HP EliteDisplay E223 1FH45AA LCD 21.5\'\' [16:9] 1920х1080(FHD) IPS, nonGLARE, nonTOUCH, 250cd/m2, H178°',
                'alias'=>'HP EliteDisplay E223',
                'brand_id'=>1,
                'price'=>93060,
                'image'=>'113491986_w640_h640_monitor-hp-elitedisplay.jpg'

            ],
            [
                'name'=>'Ноутбук Lenovo IP 110S 11,6\'HD/Celeron N3060/32Gb SSD/2Gb/Win10/Red',
                'alias'=>'Lenovo IP 110S',
                'brand_id'=>2,
                'price'=>95000,
                'image'=>'90070173_w640_h640_noutbuk-lenovo-ip.jpg'

            ],
            [
                'name'=>'Ноутбук Asus Zenbook UX333FA-A4181T 13.3\'\' FHD(1920x1080) GLARE/Intel Core i5-8265U 1.60GHz Quad/8GB/256GB SSD',
                'alias'=>'Asus Zenbook UX333FA-A4181T',
                'brand_id'=>null,
                'price'=>120000,
                'image'=>'109147879_w640_h640_noutbuk-asus-zenbook.jpg'

            ],
            [
                'name'=>'Ноутбук Acer Swift 3 SF314-54-876H NX.GZXER.004 14"FHD IPS Core i7-8550U 1.8GHz/max4GHz 8Gb SSD256Gb Linux',
                'alias'=>'Acer Swift 3 SF314-54-876H',
                'brand_id'=>3,
                'price'=>119000,
                'image'=>'126476838_w640_h640_noutbuk-acer-swift.jpg'

            ],
            [
                'name'=>'Ноутбук Lenovo Yoga S940-14IIL 14.0FHD Intel® Core i5 1035/8Gb/SSD 512Gb/Win10(81Q8002QRK)',
                'alias'=>'Lenovo Yoga S940-14IIL',
                'brand_id'=>2,
                'price'=>404000,
                'image'=>'126568311_w640_h640_noutbuk-lenovo-yoga.jpg'

            ],
            [
                'name'=>'HP 1EP73EA EliteBook 1040 G4 14" Core i5 8Gb SSD 360Gb Win10Pro',
                'alias'=>'HP 1EP73EA EliteBook',
                'brand_id'=>1,
                'price'=>309000,
                'image'=>'69643979_w640_h640_hp-1ep73ea-elitebook.jpg'

            ],
            [
                'name'=>'Ноутбук Apple MacBook 12 дюймов (MLH72) Space Gray',
                'alias'=>'Apple MacBook 12',
                'brand_id'=>7,
                'price'=>719000,
                'image'=>'106723960_w640_h640_noutbuk-apple-macbook.jpg'

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
        DB::table('product_images')->insert([
            [
                'product_id'=>16,
                'image'=>'106697616_w640_h640_led-monitor-samsung.jpg'
            ],
            [
                'product_id'=>16,
                'image'=>'106697617_w640_h640_led-monitor-samsung.jpg'
            ],
            [
                'product_id'=>16,
                'image'=>'106697618_w640_h640_led-monitor-samsung.jpg'
            ],
            [
                'product_id'=>17,
                'image'=>'75273704_w640_h640_monitor-samsung-lc34f791wqixci.jpg'
            ],
            [
                'product_id'=>19,
                'image'=>'113491989_w640_h640_monitor-hp-elitedisplay.jpg'
            ],
            [
                'product_id'=>19,
                'image'=>'113492061_w640_h640_monitor-hp-elitedisplay.jpg'
            ],
            [
                'product_id'=>19,
                'image'=>'113492064_w640_h640_monitor-hp-elitedisplay.jpg'
            ],
            [
                'product_id'=>20,
                'image'=>'90070255_w640_h640_noutbuk-lenovo-ip.jpg'
            ],
            [
                'product_id'=>20,
                'image'=>'90070178_w640_h640_noutbuk-lenovo-ip.jpg'
            ],
            [
                'product_id'=>22,
                'image'=>'126476837_w640_h640_noutbuk-acer-swift.jpg'
            ],
            [
                'product_id'=>23,
                'image'=>'126568313_w640_h640_noutbuk-lenovo-yoga.jpg'
            ],
            [
                'product_id'=>23,
                'image'=>'126568314_w640_h640_noutbuk-lenovo-yoga.jpg'
            ],
            [
                'product_id'=>24,
                'image'=>'69643980_w640_h640_hp-1ep73ea-elitebook.jpg'
            ],
            [
                'product_id'=>24,
                'image'=>'69643982_w640_h640_hp-1ep73ea-elitebook.jpg'
            ],
            [
                'product_id'=>25,
                'image'=>'106723961_w640_h640_noutbuk-apple-macbook.jpg'
            ],
            [
                'product_id'=>25,
                'image'=>'106723962_w640_h640_noutbuk-apple-macbook.jpg'
            ],
            [
                'product_id'=>25,
                'image'=>'106723963_w640_h640_noutbuk-apple-macbook.jpg'
            ],
        ]);
        // $this->call(UserSeeder::class);
    }
}
