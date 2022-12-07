<?=$this->extend('backend/template')?>

<?=$this->section('content')?>

<div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-900">Pemesanan</h1>

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
                            <table id="table-pemesanan" class="datatable table table-bordered">
                                <thead>
                                    <tr>
                                    <th>No</th>
                                    <th>Tanggal Awal</th>
                                    <th>Tanggal Akhir</th>
                                    <th>Koleksi</th>
                                    <th>Anggota</th>
                                    <th>Status Pesanan</th>
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
<div class="contrainer">
<div id="modalForm" class="modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Form Pemesanan</h5>
                <button class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="formPemesanan" method="post" action="<?=base_url('pemesanan')?>">
                    <input type="hidden" name="id" />
                    <input type="hidden" name="_method" />
                    <div class="mb-3">
                        <label class="form-label">Tanggal Awal</label>
                        <input type="date" name="tgl_awal" class="form-control"/>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Tanggal Akhir</label>
                        <input type="date" name="tgl_akhir" class="form-control"/>
                    </div>
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
                        <label class="form-label">Anggota</label>
                        <select name="anggota_id" class="form-control">
                            <option>Pilih Anggota</option>
                            <?php foreach($anggota as $k):?>
                                <option value='<?=$k['id']?>'><?=$k['nama_depan']?></option>
                            <?php endforeach;?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Status Pesan</label>
                        <select name="status_pesan" class="form-control">
                        <option>Pilih Status Pesan</option>
                            <option value="B">Baru Pesan</option>
                            <option value="O">Oke Sudah Dipinjam</option>
                            <option value="X">Batal</option>
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
        $('select[name=koleksi_id], [name=anggota_id]').select2({width:'100%',
            dropdownParent: $('form#formPemesanan')
        });

        $('button#btn-kirim').on('click', function(){
            $('form#formPemesanan').submit();
        });

        $('table#table-pemesanan').on('click', '.btn-edit', function(){
            let id = $(this).data('id');
            let baseurl = "<?=base_url()?>";
            $.get(`${baseurl}/pemesanan/${id}`).done((e)=>{
                $('input[name=id]').val(e.id);
                $('input[name=tgl_awal]').val(e.tgl_awal);
                $('input[name=tgl_akhir]').val(e.tgl_akhir);
                $('input[name=koleksi_id]').val(e.koleksi_id);
                $('input[name=anggota_id]').val(e.anggota_id);
                $('input[name=status_pesanan]').val(e.status_pesanan);
                $('#modalForm').modal('show');
                $('input[name=_method]').val('patch');


            });
        });

        
        $('table#table-pemesanan').on('click', '.btn-hapus', function(){
            let konfirmasi = confirm ('serius hapus data?');
            if(konfirmasi === true){
                let _id = $(this).data('id');
                let baseurl = "<?=base_url()?>";

                $.post(`${baseurl}/pemesanan`, {id:_id, _method:'delete'}).done(function(e){
                    $('table#table-pemesanan').DataTable().ajax.reload();
                });
            }
        }); 

        $('form#formPemesanan').submitAjax({
            pre:()=>{
                $('button#btn-kirim').hide();
            },
            pasca:()=>{
                $('button#btn-kirim').show();
            },
            success:(response, status)=>{
                $("#modalForm").modal('hide');
                $("table#table-pemesanan").DataTable().ajax.reload();
            },
            error: (xhr, status)=>{
                alert('maaf,data pemesanan gagal direkam');
            },
        });

        $('button#btn-tambah').on('click', function(){
            $('#modalForm').modal('show');
            $('form#formPemesanan').trigger('reset');
        });

        $('table#table-pemesanan').DataTable({
            processing: true,
            serverSide: true,
            ajax:{
                url: "<?=base_url('pemesanan/all')?>",
                method: 'GET'
            },
            columns: [
                { data: 'id', sortable:false, seacrhable:false, render: (data,type,row,meta)=>{
                    return meta.settings._iDisplayStart + meta.row + 1;
                } 
            },
                { data: 'tgl_awal' },
                { data: 'tgl_akhir' },
                { data: 'koleksi' },
                { data: 'anggota' },
                { data: 'status_pesan', 
                    render: (data, type, meta, row)=>{
                        if(data === 'B'){
                            return 'Baru Pesan';
                        }
                        else if( data === 'O'){
                            return 'Oke Sudah Dipinjam';
                        }
                        else if( data === 'X'){
                            return 'Batal';
                        }
                        return data;
                    }
                 },
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