<?php

namespace App\Models;

use CodeIgniter\Model;

class ProdukModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'products';
    protected $primaryKey       = 'id_produk';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'id_jenis_produk',
        'nama_produk',
        'jumlah_produk_satuan',
        'harga',
        'deskripsi', 
        'foto', 
        'slug'
    ];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    public function getTop5Products(){
        $query = $this->db->table('products')
            ->select('products.id_produk, products.nama_produk, sum(jumlah_beli) as total')
            ->join('purchases', 'products.id_produk = purchases.id_produk')
            ->groupBy('products.nama_produk')
            ->orderBy('total', 'DESC')
            ->limit(5)
            ->get();
        return $query;
    }

    public function getIncomeByCategory(){
        $query = $this->db->table('type_of_products')
            ->select('type_of_products.nama_jenis_produk, type_of_products.id_jenis_produk, products.id_produk')
            ->join('products', 'type_of_products.id_jenis_produk = products.id_jenis_produk')
            ->groupBy('type_of_products.nama_jenis_produk')
            ->get();
        return $query;
    }
}
