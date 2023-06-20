<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class m_purchasingOrder extends Model
{
    protected $fillable = [
        'id_hki',
        'part_no',
        'part_name',
        'class',
        'composition',
        'unit',
        'default_supplier',
        'supplier_name',
        'unit_price',
        'bom_x_price',
        'currency_code'
    ];

    use HasFactory;

    public function allData()
    {
        return DB::table('purchasing')->get();
    }


    public function tampilPO_Supplier()
    {
        return DB::table('purchasing')->join('users','purchasing.id_tujuan','=','users.id')->where('users.role_id', '3')->get();
    }

    public function tampilPO_Subcon()
    {
        return DB::table('m_purchasing_orders')->join('users','m_purchasing_orders.class','=','users.id')->where('users.role_id', '2')->get();
    }

    public function addData($data)
    {
        DB::table('purchasing')->insert($data);
    }
    
    public function editData($no, $data)
    {
        return DB::table('purchasing')->where('no', $no)->update($data);
    }

    public function detailData($no)
    {
        return DB::table('purchasing')->where('no', $no)->first();
    }

    public function deleteData($no)
    {
        return DB::table('purchasing')->where('no', $no)->delete();
    }

    public function checkID()
    {
        return DB::table('purchasing')->count();
    }

    public function maxIditem()
    {
        return DB::table('purchasing')->max('no');
    }

    // PO DI HALAMAN SUBCON
    public function myPO_Subcon($id)
    {
        return DB::table('purchasing')->join('users','purchasing.id_tujuan','=','users.id')->where('id_tujuan', $id)->get();
    }

    public function fromPO($no)
    {
        return DB::table('purchasing')->join('users','purchasing.id_hki','=','users.id')->where('no', $no)->first();
    }

    public function download($no)
    {
        return DB::table('purchasing')->join('users','purchasing.id_tujuan','=','users.id')->join('users_detail','users.id','=','users_detail.id_user')->where('no', $no)->first();
    }



    // END PO DI HALAMAN SUBCON

     // PO DI HALAMAN SUBCON

     public function myPO_Supplier($id)
     {
         return DB::table('purchasing')->join('users','purchasing.id_tujuan','=','users.id')->where('id_tujuan', $id)->get();
     }
      // END PO DI HALAMAN SUBCON


    //   Kondisi Ketika User dihapus dan User masih punya PO, maka PO akan dijadikan Log
    public function jadiLOG($id, $data)
    {
        return DB::table('purchasing')->where('id_tujuan', $id)->update($data);
    }


    // END Kondisi
}
