<?php

namespace App\Controllers;

use Agoenxz21\Datatables\Datatable;
use App\Controllers\BaseController;
use App\Models\AnggotaModel;
use App\Models\KoleksiModel;
use App\Models\PustakawanModel;
use App\Models\StokkoleksiModel;
use CodeIgniter\Exceptions\PageNotFoundException;
use KoleksiTest;

class StokkoleksiController extends BaseController
{
    public function index()
    {
        return view('backend/Stokkoleksi/table', [
            'koleksi' => (new KoleksiModel())->findAll(),
            'anggota' => (new AnggotaModel())->findAll(),
            'pustakawan' => (new PustakawanModel())->findAll(),
        ]);
    }

    public function all(){


        return (new Datatable( StokkoleksiModel::view() ))
                ->setFieldFilter(['koleksi_id', 'nomor', 'status_tersedia', 'anggota_id', 'pustakawan_id'])
                ->draw();
    }

    public function show($id){
        $r = (new StokkoleksiModel())->where('id', $id)->first();
        if($r == null)throw PageNotFoundException::forPageNotFound();

        return $this->response->setJSON($r);
    }

    public function store(){
        $pm     = new StokkoleksiModel();

        $id = $pm->insert([
            'koleksi_id'        => $this->request->getVar('koleksi_id'),
            'nomor'             => $this->request->getVar('nomor'),
            'status_tersedia'   => $this->request->getVar('status_tersedia'),
            'anggota_id'        => $this->request->getVar('anggota_id'),
            'pustakawan_id'     => $this->request->getVar('pustakawan_id'),
        ]);
        return $this->response->setJSON(['id' => $id])
                    ->setStatusCode( intval($id) > 0 ? 200 : 406 );
    }

    public function update(){
        $pm     = new StokkoleksiModel();
        $id  = (int)$this->request->getVar('id');

        if( $pm->find($id) == null)
        throw PageNotFoundException::forPageNotFound();

        $hasil = $pm->update($id, [
            'koleksi_id'            => $this->request->getVar('koleksi_id'),
            'nomor'                 => $this->request->getVar('nomor'),
            'status_tersedia'       => $this->request->getVar('status_tersedia'),
            'anggota_id'            => $this->request->getVar('anggota_id'),
            'pustakawan_id'         => $this->request->getVar('pustakawan_id'),
        ]);
        return $this->response->setJSON(['result'=>$hasil]);
    }

    public function delete(){
        $pm     = new StokkoleksiModel();
        $id     = $this->request->getVar('id');
        $hasil  = $pm->delete($id);
        return $this->response->setJSON(['result' => $hasil ]);
    }
}
