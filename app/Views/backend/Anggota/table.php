<?=$this->extend('backend/template')?>

<?=$this->section('content')?>

<div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-900">Anggota</h1>
                
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">
                            <button class="float-end btn btn-sm btn-primary" id="btn-tambah">Tambah Anggota Baru</button>

                            </h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <div id="dataTable_wrapper" class="dataTables_wrapper dt-bootstrap4">
                                    <div class="row"><div class="col-sm-12 col-md-6">
                                    <table id="table-anggota" class="datatable table table-bordered">
                                    <thead>
                                        <tr>
                                        <th>No</th>
                                        <th>Nama Depan</th>
                                        <th>Nama Belakang</th>
                                        <th>Email</th>
                                        <th>No hp</th>
                                        <th>Alamat</th>
                                        <th>Kota</th>
                                        <th>Gender</th>
                                        <th>Foto</th>
                                        <th>Tanggal Daftar</th>
                                        <th>Status Aktif</th>
                                        <th>Berlaku Awal</th>
                                        <th>Berlaku Akhir</th>
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
                <h5 class="modal-title">Form Anggota</h5>
                <button class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="formAnggota" method="post" action="<?=base_url('anggota')?>">
                    <input type="hidden" name="id" />
                    <input type="hidden" name="_method" />
                    <div class="mb-3">
                        <label class="form-label">Nama Depan</label>
                        <input type="text" name="nama_depan" class="form-control"/>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nama Belakang</label>
                        <input type="text" name="nama_belakang" class="form-control"/>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Alamat Email</label>
                        <input type="email" name="email" class="form-control"/>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">No Handphone</label>
                        <input type="text" name="nohp" class="form-control"/>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Alamat</label>
                        <input type="text" name="alamat" class="form-control"/>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Kota</label>
                        <input type="text" name="kota" class="form-control"/>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Jenis Kelamin</label>
                        <select name="gender" class="form-control">
                            <option>Pilih Jenis Kelamin</option>
                            <option value="L">Laki-Laki</option>
                            <option value="P">Perempuan</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Foto</label>
                       
                        <div class="mb-3" id="fileberkas">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Tanggal Daftar</label>
                        <input type="date" name="tgl_daftar" class="form-control"/>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Status Aktif</label>
                        <select name="status_aktif" class="form-control">
                        <option>Pilih Status Aktif</option>
                            <option value="A">Aktif</option>
                            <option value="N">No Aktif</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Berlaku Awal</label>
                        <input type="date" name="berlaku_awal" class="form-control"/>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Berlaku Akhir</label>
                        <input type="date" name="berlaku_akhir" class="form-control"/>
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
    function buatDropify(filename=''){
        $('div#fileberkas').html(`<input type="file"
                                    name="berkas"
                                    data-allowed-file-extensions="png jpg bmp gif"
                                    data-default-file="${filename}">`);
        $('input[name=berkas]').dropify();
    }

    $(document).ready(function(){
        $('button#btn-kirim').on('click', function(){
            $('form#formAnggota').submit();
        });

        $('table#table-anggota').on('click', '.btn-edit', function(){
            let id = $(this).data('id');
            $('input[name=_method]').val('patch');
            let baseurl = "<?=base_url()?>";
            $.get(`${baseurl}/anggota/${id}`).done((e)=>{
                $('input[name=id]').val(e.id);
                $('input[name=nama_depan]').val(e.nama_depan);
                $('input[name=nama_belakang]').val(e.nama_belakang);
                $('input[name=email]').val(e.email);
                $('input[name=nohp]').val(e.nohp);
                $('input[name=alamat]').val(e.alamat);
                $('input[name=kota]').val(e.kota);
                $('select[name=gender]').val(e.gender);
                buatDropify(e?.filename ?? '');
                $('input[name=tgl_daftar]').val(e.tgl_daftar);
                $('input[name=status_aktif]').val(e.status_aktif);
                $('input[name=berlaku_awal]').val(e.berlaku_awal);
                $('input[name=berlaku_akhir]').val(e.berlaku_akhir);
                $('#modalForm').modal('show');
                $('input[name=_method]').val('patch');


            });
        });

        
        $('table#table-anggota').on('click', '.btn-hapus', function(){
            let konfirmasi = confirm ('serius hapus data?');
            if(konfirmasi === true){
                let _id = $(this).data('id');
                let baseurl = "<?=base_url()?>";

                $.post(`${baseurl}/anggota`, {id:_id, _method:'delete'}).done(function(e){
                    $('table#table-anggota').DataTable().ajax.reload();
                });
            }
        }); 

        $('form#formAnggota').submitAjax({
            pre:()=>{
                $('button#btn-kirim').hide();
            },
            pasca:()=>{
                $('button#btn-kirim').show();
            },
            success:(response, status)=>{
                $("#modalForm").modal('hide');
                $("table#table-anggota").DataTable().ajax.reload();
            },
            error: (xhr, status)=>{
                alert('maaf,data anggota gagal direkam');
            },
        });

        $('button#btn-tambah').on('click', function(){
            $('#modalForm').modal('show');
            $('form#formAnggota').trigger('reset');
            $('input[name=_method]').val('');
            buatDropify();
        });

        $('table#table-anggota').DataTable({
            processing: true,
            serverSide: true,
            ajax:{
                url: "<?=base_url('anggota/all')?>",
                method: 'GET'
            },
            columns: [
                { data: 'id', sortable:false, seacrhable:false, render: (data,type,row,meta)=>{
                    return meta.settings._iDisplayStart + meta.row + 1;
                } 
            },
                { data: 'nama_depan' },
                { data: 'nama_belakang' },
                { data: 'email' },
                { data: 'nohp' },
                { data: 'alamat' },
                { data: 'kota' },
                { data: 'gender', 
                    render: (data, type, meta, row)=>{
                        if(data === 'L'){
                            return 'Laki-Laki';
                        }
                        else if( data === 'P'){
                            return 'Perempuan';
                        }
                        return data;
                    }
                 },
                { data: 'foto' },
                { data: 'tgl_daftar' },
                { data: 'status_aktif' },
                { data: 'berlaku_awal' },
                { data: 'berlaku_akhir' },
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