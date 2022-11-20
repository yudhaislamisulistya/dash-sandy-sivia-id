<?php

use App\Models\FeedbackModel;
use App\Models\JasaModel;
use App\Models\JenisProdukModel;
use App\Models\PembelianModel;
use App\Models\ProdukModel;
use App\Models\TransaksiModel;
use App\Models\UserModel;

function cekUser(){
    return session()->get('level');
}

function get_product($id_produk){
    $produkModel = new ProdukModel();
    $data = $produkModel->where('id_produk', $id_produk)
        ->first();
    return $data;
}

function get_service($id_jasa){
    $jasaModel = new JasaModel();
    $data = $jasaModel->where('id_jasa', $id_jasa)
        ->first();
    return $data;
}

function get_user($id_user){
    $userModel = new UserModel();
    $data = $userModel->where('id_user', $id_user)
        ->first();
    return $data;
}

function format_rupiah($angka){
    $rupiah = number_format($angka, 0, ',', '.');
    return $rupiah;
}

function get_purcheses_by_id_transction($transcation_id){
    $pembelianModel = new PembelianModel();
    $data = $pembelianModel->where('transaction_id', $transcation_id)
        ->get()->getResult();
    return $data;
}

function get_type_product($id_jenis_produk){
    $jenisProdukModel = new JenisProdukModel();
    $data = $jenisProdukModel->where('id_jenis_produk', $id_jenis_produk)
        ->first();
    return $data;
}

function get_type_products(){
    $jenisProdukModel = new JenisProdukModel();
    $data = $jenisProdukModel->get()->getResult();
    return $data;
}

function get_notifications(){
    $transaksiModel = new TransaksiModel();
    $data = $transaksiModel->limit(5)
        ->get()->getResult();
    return $data;
}

function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

function get_top_5_product(){
    $produkModel = new ProdukModel();
    $data = $produkModel->getTop5Products()->getResult();
    return $data;
}

function get_transaction_status($status = null){
    $transaksiModel = new TransaksiModel();
    if(!$status){
        $data = $transaksiModel->get()->getResult();
    }else{
        $data = $transaksiModel->where('transaction_status', $status)->get()->getResult();
    }

    return $data;
}

function get_transaction_5(){
    $transaksiModel = new TransaksiModel();
    $data = $transaksiModel->limit(5)->get()->getResult();
    return $data;
}

function get_income_by_category(){
    $produkModel = new ProdukModel();
    $data = $produkModel->getIncomeByCategory()->getResult();
    return $data;
}

function get_purchases_by_id($id_produk){
    $pembelianModel = new PembelianModel();
    $data = $pembelianModel->select('jumlah_beli')
        ->where('id_produk', $id_produk)
        ->get()->getResult();
    return $data;
}

function get_purchases(){
    $pembelianModel = new PembelianModel();
    $data = $pembelianModel->groupBy('id_produk')
        ->get()->getResult();
    return $data;
}

function get_user_by_status($status = null){
    $userModel = new UserModel();
    if(!$status){
        $data = $userModel->get()->getResult();
    }else{
        $data = $userModel->where('level', 1)->get()->getResult();
    }
    return $data;
}

function get_feedbacks(){
    $feedbackModel = new FeedbackModel();
    $data = $feedbackModel->get()->getResult();
    return $data;
}



?>