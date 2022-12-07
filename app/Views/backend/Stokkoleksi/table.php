<?=$this->extend('backend/template')?>

<?=$this->section('content')?>

<div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-900">Stok Koleksi</h1>

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
                            <table id="table-stokkoleksi" class="datatable table table-bordered">
                                <thead>
                                    <tr>
                                    <th>No</th>
                                    <th>Koleksi</th> 
                                    <th>Nomor</th>
                                    <th>Status Tersedia</th>
                                    <th>Anggota</th>
                                    <th>Pustakawan</th>
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
                <h5 class="modal-title">Form Stok Koleksi</h5>
                <button class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="formStokkoleksi" method="post" action="<?=base_url('stokkoleksi')?>">
                    <input type="hidden" name="id" />
                    <input type="hidden" name="_method" />
                    <div class="mb-3">
                        <label class="form-label">Koleksi</label>
                        <select name="koleksi_id" class="form-control">
                            <option>Pilih Koleksi</option>
                            <?php foreach($koleksi as $k):?>
                                <option value='<?=$k['id']?>'><?=$k['judul']?></option>
                            <?php endforeach;?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nomor</label>
                        <input type="number" name="nomor" class="form-control"/>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Status Tersedia</label>
                        <select name="status_tersedia" class="form-control">
                        <option>Pilih Status Tersedia</option>
                            <option value="A">Ada</option>
                            <option value="P">Pinjam</option>
                            <option value="R">Rusak</option>
                            <option value="H">Hilang</option>
                        </select>
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
                        <label class="form-label">Pustakawan</label>
                        <select name="pustakawan_id" class="form-control">
                            <option>Pilih Pustakawan</option>
                            <?php foreach($pustakawan as $k):?>
                                <option value='<?=$k['id']?>'><?=$k['nama_lengkap']?></option>
                            <?php endforeach;?>
                        </select>
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
        $('select[name=koleksi_id], [name=anggota_id], [name=pustakawan_id]').select2({width:'100%',
            dropdownParent: $('form#formStokkoleksi')
        });
        
        $('button#btn-kirim').on('click', function(){
            $('form#formStokkoleksi').submit();
        });

        $('table#table-stokkoleksi').on('click', '.btn-edit', function(){
            let id = $(this).data('id');
            let baseurl = "<?=base_url()?>";
            $.get(`${baseurl}/stokkoleksi/${id}`).done((e)=>{
                $('input[name=id]').val(e.id);
                $('input[name=koleksi_id]').val(e.koleksi_id);
                $('input[name=nomor]').val(e.nomor);
                $('input[name=status_tersedia]').val(e.status_tersedia);
                $('input[name=anggota_id]').val(e.anggota_id);
                $('input[name=pustakawan_id]').val(e.pustakawan_id);
                $('#modalForm').modal('show');
                $('input[name=_method]').val('patch');

            });
        });

        
        $('table#table-stokkoleksi').on('click', '.btn-hapus', function(){
            let konfirmasi = confirm ('serius hapus data?');
            if(konfirmasi === true){
                let _id = $(this).data('id');
                let baseurl = "<?=base_url()?>";

                $.post(`${baseurl}/stokkoleksi`, {id:_id, _method:'delete'}).done(function(e){
                    $('table#table-stokkoleksi').DataTable().ajax.reload();
                });
            }
        }); 

        $('form#formStokkoleksi').submitAjax({
            pre:()=>{
                $('button#btn-kirim').hide();
            },
            pasca:()=>{
                $('button#btn-kirim').show();
            },
            success:(response, status)=>{
                $("#modalForm").modal('hide');
                $("table#table-stokkoleksi").DataTable().ajax.reload();
            },
            error: (xhr, status)=>{
                alert('maaf,data stok koleksi gagal direkam');
            },
        });

        $('button#btn-tambah').on('click', function(){
            $('#modalForm').modal('show');
            $('form#formStokkoleksi').trigger('reset');
        });

        $('table#table-stokkoleksi').DataTable({
            processing: true,
            serverSide: true,
            ajax:{
                url: "<?=base_url('stokkoleksi/all')?>",
                method: 'GET'
            },
            columns: [
                { data: 'id', sortable:false, seacrhable:false, render: (data,type,row,meta)=>{
                    return meta.settings._iDisplayStart + meta.row + 1;
                } 
            },
                { data: 'koleksi_id' },
                { data: 'nomor' },
                { data: 'status_tersedia', 
                    render: (data, type, meta, row)=>{
                        if(data === 'A'){
                            return 'Ada';
                        }
                        else if( data === 'P'){
                            return 'Pinjam';
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
                { data: 'anggota_id' },
                { data: 'pustakawan_id' },
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