<?=$this->extend('backend/template')?>

<?=$this->section('content')?>

<div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-900">Transaksi</h1>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">
                            <button class="float-end btn btn-sm btn-primary" id="btn-tambah">Tambah</button>
                            </h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <div id="dataTable_wrapper" class="dataTables_wrapper dt-bootstrap4">
                                    <div class="row"><div class="col-sm-12 col-md-6">
                            <table id="table-transaksi" class="datatable table table-bordered">
                                <thead>
                                    <tr>
                                    <th>No</th>
                                    <th>Tanggal Pinjam</th>
                                    <th>Tanggal Harus Kembali</th>
                                    <th>Tanggal Kembali</th>
                                    <th>Anggota</th>
                                    <th>Stok Koleksi</th>
                                    <th>Pustakawan</th>
                                    <th>Kembali Pustakawan</th>
                                    <th>Denda</th>
                                    <th>Status TRX</th>
                                    <th>Catatan</th>
                                    <th>Aksi</th>
                                    </tr>
                                </thead>
                            </table>
                                    
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
<div class="contrainer mt-5">
<div id="modalForm" class="modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Form Transaksi</h5>
                <button class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="formTransaksi" method="post" action="<?=base_url('transaksi')?>">
                    <input type="hidden" name="id" />
                    <input type="hidden" name="_method" />
                    <div class="mb-3">
                        <label class="form-label">Tanggal Pinjam</label>
                        <input type="date" name="tgl_pinjam" class="form-control"/>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Tanggal Harus Kembali</label>
                        <input type="date" name="tgl_harus_kembali" class="form-control"/>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Tanggal Kembali</label>
                        <input type="date" name="tgl_kembali" class="form-control"/>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Anggota</label>
                        <select name="anggota_id" class="form-control">
                            <option>Pilih Anggota</option>
                            <?php foreach($anggota as $k):?>
                                <option value='<?=$k['id']?>'><?=$k['nama_depan']?></option>
                            <?php endforeach;?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Stok Koleksi</label>
                        <select name="stokkoleksi_id" class="form-control">
                            <option>Pilih Stok Koleksi</option>
                            <?php foreach($stokkoleksi as $k):?>
                                <option value='<?=$k['id']?>'><?=$k['nomor']?></option>
                            <?php endforeach;?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Pustakawan</label>
                        <select name="pustakawan_id" class="form-control">
                            <option>Pilih Pustakawan</option>
                            <?php foreach($pustakawan as $k):?>
                                <option value='<?=$k['id']?>'><?=$k['nama_lengkap']?></option>
                            <?php endforeach;?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Kembali_pustakawan</label>
                        <input type="text" name="kembali_pustakawan_id" class="form-control"/>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Denda</label>
                        <input type="number" name="denda" class="form-control"/>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Status TRX</label>
                        <select name="status_trx" class="form-control">
                            <option>Pilih Status TRX</option>
                            <option value="P">Pinjam</option>
                            <option value="K">Kembali</option>
                            <option value="R">Rusak</option>
                            <option value="H">Hilang</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Catatan</label>
                        <input type="text" name="catatan" class="form-control"/>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button class="btn btn-success" id="btn-kirim">Kirim</button>
            </div>
        </div>
    </div>
</div>

<?=$this->endSection()?>

<?=$this->section('script')?>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
    crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/gh/agoenxz2186/submitAjax@develop/submit_ajax.js"
    ></script>
<link href="//cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css" rel="stylesheet">
<script src="//cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>

<script>
    $(document).ready(function(){
        $('select[name=anggota_id], [name=stokkoleksi_id], [name=pustakawan_id]').select2({width:'100%',
            dropdownParent: $('form#formTransaksi')
        });

        $('button#btn-kirim').on('click', function(){
            $('form#formTransaksi').submit();
        });

        $('table#table-transaksi').on('click', '.btn-edit', function(){
            let id = $(this).data('id');
            let baseurl = "<?=base_url()?>";
            $.get(`${baseurl}/transaksi/${id}`).done((e)=>{
                $('input[name=id]').val(e.id);
                $('input[name=tgl_pinjam]').val(e.tgl_pinjam);
                $('input[name=tgl_harus_kembali]').val(e.tgl_harus_kembali);
                $('input[name=tgl_kembali]').val(e.tgl_kembali);
                $('input[name=anggota_id]').val(e.anggota_id);
                $('input[name=stokkoleksi_id]').val(e.stokkoleksi_id);
                $('input[name=pustakawan_id]').val(e.pustakawan_id);
                $('select[name=kembalipustakawan_id]').val(e.kembalipustakawan_id);
                $('input[name=denda]').val(e.denda);
                $('input[name=status_trx]').val(e.status_trx);
                $('input[name=catatan]').val(e.catatan);
                $('#modalForm').modal('show');
                $('input[name=_method]').val('patch');


            });
        });

        
        $('table#table-transaksi').on('click', '.btn-hapus', function(){
            let konfirmasi = confirm ('serius hapus data?');
            if(konfirmasi === true){
                let _id = $(this).data('id');
                let baseurl = "<?=base_url()?>";

                $.post(`${baseurl}/transaksi`, {id:_id, _method:'delete'}).done(function(e){
                    $('table#table-transaksi').DataTable().ajax.reload();
                });
            }
        }); 

        $('form#formTransaksi').submitAjax({
            pre:()=>{
                $('button#btn-kirim').hide();
            },
            pasca:()=>{
                $('button#btn-kirim').show();
            },
            success:(response, status)=>{
                $("#modalForm").modal('hide');
                $("table#table-transaksi").DataTable().ajax.reload();
            },
            error: (xhr, status)=>{
                alert('maaf,data transaksi gagal direkam');
            },
        });

        $('button#btn-tambah').on('click', function(){
            $('#modalForm').modal('show');
            $('form#formTransaksi').trigger('reset');
        });

        $('table#table-transaksi').DataTable({
            processing: true,
            serverSide: true,
            ajax:{
                url: "<?=base_url('transaksi/all')?>",
                method: 'GET'
            },
            columns: [
                { data: 'id', sortable:false, seacrhable:false, render: (data,type,row,meta)=>{
                    return meta.settings._iDisplayStart + meta.row + 1;
                } 
            },
                { data: 'tgl_pinjam' },
                { data: 'tgl_harus_kembali' },
                { data: 'tgl_kembali' },
                { data: 'anggota' },
                { data: 'stokkoleksi' },
                { data: 'pustakawan' },
                { data: 'kembalipustakawan_id' },
                { data: 'denda' },
                { data: 'status_trx', 
                    render: (data, type, meta, row)=>{
                        if(data === 'P'){
                            return 'Pinjam';
                        }
                        else if( data === 'K'){
                            return 'Kembali';
                        }
                        else if( data === 'R'){
                            return 'Rusak';
                        }
                        else if( data === 'H'){
                            return 'Hilang';
                        }
                        return data;
                    }
                 },
                { data: 'catatan' },
                { data: 'id',
                render: (data, type, meta, row)=>{
                    var btnEdit = `<button class='btn btn-info btn-edit' data-id='${data}'> Edit </button>`;
                    var btnHapus = `<button class='btn btn-danger btn-hapus' data-id='${data}'> Hapus </button>`;
                    return btnEdit + btnHapus;
                    
                } 
            }
            ]
        });
    });
</script>

<?=$this->endSection()?>