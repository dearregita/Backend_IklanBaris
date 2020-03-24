<?php

namespace App\Http\Controllers;
use Auth;
use App\Barang;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BarangController extends Controller
{
    public function index()
    {
    	try{
	        $data["count"] = Barang::count();
	        $barang = array();

	        foreach (Barang::all() as $p) {
	            $item = [
	                "gambar"          		=> $p->gambar,
	                "kondisi"  => $p->kondisi,
	                "juduliklan"  => $p->juduliklan,
	                "deskripsi"  		=> $p->deskripsi,
	                "harga"    	  		=> $p->harga
	            ];

	            array_push($barang, $item);
	        }
	        $data["barang"] = $barang;
	        $data["status"] = 1;
	        return response($data);

	    } catch(\Exception $e){
			return response()->json([
			  'status' => '0',
			  'message' => $e->getMessage()
			]);
      	}
    }

    public function store(Request $request)
    {
      try{
    		$validator = Validator::make($request->all(), [
    			'gambar'      => 'required|string|max:255',
				'kondisi'	  => 'required|string|max:255',
				'juduliklan'  => 'required|string|max:500',
                'deskripsi'	  => 'required|string|max:500',
				'harga'		  => 'required|string|max:500',
                ]);

    		if($validator->fails()){
    			return response()->json([
    				'status'	=> 0,
    				'message'	=> $validator->errors()
    			]);
    		}

    		$data = new Barang();
	        $data->gambar = $request->input('gambar');
	        $data->kondisi = $request->input('kondisi');
	        $data->juduliklan = $request->input('juduliklan');
            $data->deskripsi = $request->input('deskripsi');
            $data->harga = $request->input('harga');
            $data->save();

    		return response()->json([
    			'status'	=> '1',
    			'message'	=> 'Data Iklan berhasil ditambahkan!'
    		], 201);

      } catch(\Exception $e){
            return response()->json([
                'status' => '0',
                'message' => $e->getMessage()
            ]);
        }
      }

      public function update(Request $request, $id)
    {
      try {
      	$validator = Validator::make($request->all(), [
			    'gambar'      => 'required|string|max:255',
				'kondisi'	  => 'required|string|max:255',
				'juduliklan'  => 'required|string|max:500',
                'deskripsi'	  => 'required|string|max:500',
				'harga'		  => 'required|string|max:500',
		]);

      	if($validator->fails()){
      		return response()->json([
      			'status'	=> '0',
      			'message'	=> $validator->errors()
      		]);
      	}

      	//proses update data
          $data = Barang::where('id', $id)->first();
          $data->gambar = $request->input('gambar');
          $data->kondisi = $request->input('kondisi');
          $data->juduliklan = $request->input('juduliklan');
          $data->deskripsi = $request->input('deskripsi');
          $data->harga = $request->input('harga');
          $data->save();

      	return response()->json([
      		'status'	=> '1',
      		'message'	=> 'Data Iklan berhasil diubah'
      	]);
        
      } catch(\Exception $e){
          return response()->json([
              'status' => '0',
              'message' => $e->getMessage()
          ]);
      }
    }

    public function delete($id)
    {
        try{

            $delete = Barang::where("id", $id)->delete();

            if($delete){
              return response([
                "status"  => 1,
                  "message"   => "Data Iklan berhasil dihapus."
              ]);
            } else {
              return response([
                "status"  => 0,
                  "message"   => "Data Iklan gagal dihapus."
              ]);
            }
            
        } catch(\Exception $e){
            return response([
            	"status"	=> 0,
                "message"   => $e->getMessage()
            ]);
        }
    }

}
