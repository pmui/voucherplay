<?php

namespace Database\Seeders;

use App\Models\PaymentMethod;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PaymentMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PaymentMethod::insert([
            [
                'category'=> 'Bank Transfer',
                'code'=> 'bca',
                'name'=> 'BCA',
                'image_url' => 'https://storage.googleapis.com/go-merchant-production.appspot.com/uploads/2020/09/fc68a00838f69124fddaf64e30f5e958_ca45aac69ce87ce691c3e6582894b6f0_compressed.png',
                'min_amount'=> '50000',
                'fee_amount'=> '4000',
                'fee_percent'=> '0',
                'active'=> '1',
                'note'=> '',],
            [
                'category'=> 'Bank Transfer',
                'code'=> 'mandiri',
                'name'=> 'Mandiri',
                'image_url' => 'https://storage.googleapis.com/go-merchant-production.appspot.com/uploads/2020/09/11f8970a182ad8cf6aaf0a0cd22dd9ad_3948cb3bf5c4887c7cca7ca7ee421708_compressed.png',
                'min_amount'=> '50000',
                'fee_amount'=> '4000',
                'fee_percent'=> '0',
                'active'=> '1',
                'note'=> '',],
            [
                'category'=> 'Bank Transfer',
                'code'=> 'bri',
                'name'=> 'BRI',
                'image_url' => 'https://storage.googleapis.com/go-merchant-production.appspot.com/uploads/2020/09/0fcddd245474380834dfe5f3beb0492f_093eb297aba2188382cf91e556dd9bdf_compressed.png',
                'min_amount'=> '50000',
                'fee_amount'=> '4000',
                'fee_percent'=> '0',
                'active'=> '1',
                'note'=> '',],
            [
                'category'=> 'Bank Transfer',
                'code'=> 'bni',
                'name'=> 'BNI',
                'image_url' => 'https://storage.googleapis.com/go-merchant-production.appspot.com/uploads/2020/09/f6f57e9126c57179cf729cc9586e47c0_e26ce4cce944fe379072ae509fe72ec1_compressed.png',
                'min_amount'=> '50000',
                'fee_amount'=> '4000',
                'fee_percent'=> '0',
                'active'=> '1',
                'note'=> '',],
            [
                'category'=> 'Bank Transfer',
                'code'=> 'permata',
                'name'=> 'Permata',
                'image_url' => 'https://storage.googleapis.com/go-merchant-production.appspot.com/uploads/2020/09/3809ed0cf7907054f860ef4f64529ba0_bc5e15f9d4b3eedc3d459c45e2df7709_compressed.png',
                'min_amount'=> '50000',
                'fee_amount'=> '4000',
                'fee_percent'=> '0',
                'active'=> '1',
                'note'=> '',],
            [
                'category'=> 'QRIS',
                'code'=> 'qris',
                'name'=> 'QRIS',
                'image_url' => 'https://storage.googleapis.com/go-merchant-production.appspot.com/uploads/2021/03/2fdbf10f54c4f970356742f641a6dce5_dc3818bde5dfa8e4dc2fd9f27e7567ea_compressed.png',
                'min_amount'=> '0',
                'fee_amount'=> '0',
                'fee_percent'=> '0.7',
                'active'=> '1',
                'note'=> '',],
            [
                'category'=> 'E-Wallet',
                'code'=> 'gopay',
                'name'=> 'Gopay',
                'image_url' => 'https://storage.googleapis.com/go-merchant-production.appspot.com/uploads/2020/09/5038aa2e01be0c79443496e8b6112010_718692dca7079b31a47f68e149c81aff_compressed.png',
                'min_amount'=> '0',
                'fee_amount'=> '0',
                'fee_percent'=> '2',
                'active'=> '1',
                'note'=> '',],
            [
                'category'=> 'E-Wallet',
                'code'=> 'shopeepay',
                'name'=> 'ShopeePay',
                'image_url' => 'https://storage.googleapis.com/go-merchant-production.appspot.com/uploads/2020/10/f7fb2e0ab8572355142dba33ddc7b8d6_0747205be87147c03d04217ad4eb06c3_compressed.png',
                'min_amount'=> '0',
                'fee_amount'=> '0',
                'fee_percent'=> '2',
                'active'=> '1',
                'note'=> '',],
            [
                'category'=> 'Store',
                'code'=> 'alfamart',
                'name'=> 'Alfamart',
                'image_url' => 'https://storage.googleapis.com/go-merchant-production.appspot.com/uploads/2020/09/0b49d7de63b2367e0515c1283060f64e_c16ca417c1f390206d3ccc6785df8f19_compressed.png',
                'min_amount'=> '0',
                'fee_amount'=> '0',
                'fee_percent'=> '2',
                'active'=> '1',
                'note'=> '',],

            [
                'category'=> 'Store',
                'code'=> 'indomaret',
                'name'=> 'Indomaret',
                'image_url' => 'https://storage.googleapis.com/go-merchant-production.appspot.com/uploads/2023/01/bedfe301c61b7586b6835b0cdad6c1fc_772ddf07783a3370978e2a3929891338_compressed.png',
                'min_amount'=> '0',
                'fee_amount'=> '0',
                'fee_percent'=> '2',
                'active'=> '1',
                'note'=> '',],
        ]);
    }
}
