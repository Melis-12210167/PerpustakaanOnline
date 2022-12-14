<?=$this->extend('backend/template')?>

<?=$this->section('content')?>

<div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-900">Koleksi</h1>
                
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
                                    <table id="table-koleksi" class="datatable table table-bordered">
                                    <thead>
                                        <tr>
                                        <th>No</th>
                                        <th>Judul</th>
                                        <th>Jilid</th>
                                        <th>Edisi</th>
                                        <th>Penerbit</th>
                                        <th>Penulis</th>
                                        <th>Tahun Terbit</th>
                                        <th>Klasifikasi</th>
                                        <th>Jenis</th>
                                        <th>Jumlah Halaman</th>
                                        <th>ISBN</th>
                                        <th>Bahasa</th>
                                        <th>Stok</th>
                                        <th>Eksemplar</th>
                                        <th>Kategori</th>
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
                <h5 class="modal-title">Form Koleksi</h5>
                <button class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="formKoleksi" method="post" action="<?=base_url('koleksi')?>">
                    <input type="hidden" name="id" />
                    <input type="hidden" name="_method" />
                    <div class="mb-3">
                        <label class="form-label">Judul</label>
                        <input type="text" name="judul" class="form-control"/>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Jilid</label>
                        <input type="text" name="jilid" class="form-control"/>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Edisi</label>
                        <input type="text" name="edisi" class="form-control"/>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Penerbit</label>
                        <select name="penerbit_id" class="form-control">
                            <option>Pilih Penerbit</option>
                            <?php foreach($penerbit as $k):?>
                                <option value='<?=$k['id']?>'><?=$k['nama']?></option>
                            <?php endforeach;?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Penulis</label>
                        <input type="text" name="penulis" class="form-control"/>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Tahun Terbit</label>
                        <input type="number" name="thn_terbit" class="form-control"/>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Klasifikasi</label>
                        <select name="klasifikasi_id" class="form-control">
                            <option>Pilih Klasifikasi</option>
                            <?php foreach($klasifikasi as $k):?>
                                <option value='<?=$k['id']?>'><?=$k['nama']?></option>
                            <?php endforeach;?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Jenis ID</label>
                        <input type="number" name="jenis_id" class="form-control"/>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Jumlah Halaman</label>
                        <input type="text" name="jml_halaman" class="form-control"/>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">ISBN</label>
                        <input type="text" name="isbn" class="form-control"/>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Bahasa</label>
                        <select name="bahasa_id" class="form-control">
                            <option>Pilih Bahasa</option>
                            <?php foreach($bahasa as $k):?>
                                <option value='<?=$k['id']?>'><?=$k['nama']?></option>
                            <?php endforeach;?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Stok</label>
                        <input type="number" name="stok" class="form-control"/>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Eksemplar</label>
                        <input type="number" name="eksemplar" class="form-control"/>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Kategori</label>
                        <select name="kategori_id" class="form-control">
                            <option>Pilih Kategori</option>
                            <?php foreach($kategori as $k):?>
                                <option value='<?=$k['id']?>'><?=$k['nama']?></option>
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
<script src="https://cdn.jsdelivr.net/gh/agoenxz2186/submitAjax@develop/submit_ajax.js"></script>

<script src="//cdn.jsdelivr.net/gh/JeremyFagis/dropify@master/dist/js/dropify.min.js"></script>
<link href="https://cdn.jsdelivr.net/gh/JeremyFagis/dropify@master/dist/css/dropify.min.css" rel="stylesheet"/>

<link href="//cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css" rel="stylesheet">
<script src="//cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>

<script>

    $(document).ready(function(){
        $('select[name=penerbit_id], [name=klasifikasi_id], select[name=bahasa_id], select[name=kategori_id], [name=pustakawan_id]').select2({width:'100%',
            dropdownParent: $('form#formKoleksi')
        });

        $('button#btn-kirim').on('click', function(){
            $('form#formKoleksi').submit();
        });

        $('table#table-koleksi').on('click', '.btn-edit', function(){
            let id = $(this).data('id');
            $('input[name=_method]').val('patch');
            let baseurl = "<?=base_url()?>";
            $.get(`${baseurl}/koleksi/${id}`).done((e)=>{
                $('input[name=id]').val(e.id);
                $('input[name=judul]').val(e.judul);
                $('input[name=jilid]').val(e.jilid);
                $('input[name=edisi]').val(e.edisi);
                $('input[name=penerbit_id]').val(e.penerbit_id);
                $('input[name=penulis]').val(e.penulis);
                $('input[name=thn_terbit]').val(e.thn_terbit);
                $('select[name=klasifikasi_id]').val(e.klasifikasi_id);
                $('input[name=jenis_id]').val(e.jenis_id);
                $('input[name=jml_halaman]').val(e.jml_halaman);
                $('input[name=isbn]').val(e.isbn);
                $('input[name=bahasa_id]').val(e.bahasa_id);
                $('input[name=stok]').val(e.stok);
                $('input[name=eksemplar]').val(e.eksemplar);
                $('input[name=kategori_id]').val(e.kategori_id);
                $('input[name=pustakawan_id]').val(e.pustakawan_id);
                $('#modalForm').modal('show');
                $('input[name=_method]').val('patch');

            });
        });

        
        $('table#table-koleksi').on('click', '.btn-hapus', function(){
            let konfirmasi = confirm ('serius hapus data?');
            if(konfirmasi === true){
                let _id = $(this).data('id');
                let baseurl = "<?=base_url()?>";

                $.post(`${baseurl}/koleksi`, {id:_id, _method:'delete'}).done(function(e){
                    $('table#table-koleksi').DataTable().ajax.reload();
                });
            }
        }); 

        $('form#formKoleksi').submitAjax({
            pre:()=>{
                $('button#btn-kirim').hide();
            },
            pasca:()=>{
                $('button#btn-kirim').show();
            },
            success:(response, status)=>{
                $("#modalForm").modal('hide');
                $("table#table-koleksi").DataTable().ajax.reload();
            },
            error: (xhr, status)=>{
                alert('maaf,data koleksi gagal direkam');
            },
        });

        $('button#btn-tambah').on('click', function(){
            $('#modalForm').modal('show');
            $('form#formKoleksi').trigger('reset');
            $('input[name=_method]').val('');
            buatDropify();
        });

        $('table#table-koleksi').DataTable({
            processing: true,
            serverSide: true,
            ajax:{
                url: "<?=base_url('koleksi/all')?>",
                method: 'GET'
            },
            columns: [
                { data: 'id', sortable:false, seacrhable:false, render: (data,type,row,meta)=>{
                    return meta.settings._iDisplayStart + meta.row + 1;
                } 
            },
                { data: 'judul' },
                { data: 'jilid' },
                { data: 'edisi' },
                { data: 'penerbit' },
                { data: 'penulis' },
                { data: 'thn_terbit' },
                { data: 'klasifikasi'},
                { data: 'jenis_id' },
                { data: 'jml_halaman' },
                { data: 'isbn' },
                { data: 'bahasa' },
                { data: 'stok' },
                { data: 'eksemplar' },
                { data: 'kategori' },
                { data: 'pustakawan' },
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