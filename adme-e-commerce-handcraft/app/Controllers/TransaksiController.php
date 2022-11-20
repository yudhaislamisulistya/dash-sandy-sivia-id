<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PembelianModel;
use App\Models\ProdukModel;
use App\Models\TransaksiModel;

class TransaksiController extends BaseController
{
    public function __construct()
    {
        $this->transaksiModel = new TransaksiModel(); 
        $this->pembelianModel = new PembelianModel();
    }
    public function index()
    {
        $data = $this->transaksiModel->get()->getResult();
        return view('merchant/transaction', compact('data'));
    }

    public function delete(){
        try {
            $data = $this->request->getVar();
            $this->transakiModel->where('id_transaksi', $data['id_transaksi'])->delete();
        } catch (\Exception $th) {
            return redirect()->back()->with('status', 'success');
        }
    }

    public function detail($id_transaksi){
        try {
            $transaksi = $this->transaksiModel->where('id_transaksi',$id_transaksi)
                ->first();

            if(!$transaksi){
                return redirect()->route('merchant_transaction_index')->with('status', 'url_not_found');
            }

            $data = $this->pembelianModel->getProducts($transaksi['transaction_id'])->getResult();

            return view('/merchant/transaction-detail', compact('transaksi', 'data'));
        } catch (\Throwable $th) {
            var_dump($th);exit;
            return redirect()->route('merchant_transaction_index')->with('status', 'failed');
        }
    }
}
