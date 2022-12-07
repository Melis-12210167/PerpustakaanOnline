<?=$this->extend('backend/template')?>

<?=$this->section('content')?>

<div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-900">Pustakawan</h1>

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
                            <table id="table-pustakawan" class="datatable table table-bordered">
                                <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Lengkap</th>
                                            <th>Gender</th>
                                            <th>Tanggal Lahir</th>
                                            <th>Level</th>
                                            <th>Email</th>
                                            <th>No Hp</th>
                                            <th>Alamat</th>
                                            <th>Kota</th>
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

                </div>

<div class="contrainer">
<div id="modalForm" class="modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Form Pustakawan</h5>
                <button class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="formPustakawan" method="post" action="<?=base_url('pustakawan')?>">
                    <input type="hidden" name="id" />
                    <input type="hidden" name="_method" />
                    <div class="mb-3">
                        <label class="form-label">Nama Lengkap</label>
                        <input type="text" name="nama_lengkap" class="form-control"/>
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
                        <label class="form-label">Tanggal Lahir</label>
                        <input type="date" name="tgl_lhr" class="form-control"/>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Level</label>
                        <select name="level" class="form-control">
                            <option>Pilih Level</option>
                            <option value="P">Platinum</option>
                            <option value="K">King</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control"/>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Sandi</label>
                        <input type="password" name="sandi" class="form-control"/>
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
                    <label class="form-label">Token Reset</label>
                        <input type="text" name="token_reset" class="form-control"/>
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
        $('button#btn-kirim').on('click', function(){
            $('form#formPustakawan').submit();
        });

        $('table#table-pustakawan').on('click', '.btn-edit', function(){
            let id = $(this).data('id');
            let baseurl = "<?=base_url()?>";
            $.get(`${baseurl}/pustakawan/${id}`).done((e)=>{
                $('input[name=id]').val(e.id);
                $('input[name=nama_lengkap]').val(e.nama_lengkap);
                $('input[name=gender]').val(e.gender);
                $('select[name=tgl_lhr]').val(e.tgl_lhr);
                $('input[name=level]').val(e.level);
                $('input[name=email]').val(e.email);
                $('input[name=sandi]').val(e.sandi);
                $('input[name=nohp]').val(e.nohp);
                $('input[name=alamat]').val(e.alamat);
                $('input[name=kota]').val(e.kota);
                $('input[name=token_reset]').val(e.token_reset);
                $('#modalForm').modal('show');
                $('input[name=_method]').val('patch');


            });
        });
        

        
        $('table#table-pustakawan').on('click', '.btn-hapus', function(){
            let konfirmasi = confirm ('serius hapus data?');
            if(konfirmasi === true){
                let _id = $(this).data('id');
                let baseurl = "<?=base_url()?>";

        $.post(`${baseurl}/pustakawan`, {id:_id, _method:'delete'}).done(function(e){
            $('table#table-pustakawan').DataTable().ajax.reload();

            });
        }
    }); 

        $('form#formPustakawan').submitAjax({
            pre:()=>{
                $('button#btn-kirim').hide();
            },
            pasca:()=>{
                $('button#btn-kirim').show();
            },
            success:(response, status)=>{
                $("#modalForm").modal('hide');
                $("table#table-pustakawan").DataTable().ajax.reload();
            },
            error: (xhr, status)=>{
                alert('maaf,data pustakawan gagal direkam');
            },
        });

        $('button#btn-tambah').on('click', function(){
            $('#modalForm').modal('show');
            $('form#formPustakawan').trigger('reset');
            $('input[name=_method]').val('');
        });

        $('table#table-pustakawan').DataTable({
            processing: true,
            serverSide: true,
            ajax:{
                url: "<?=base_url('pustakawan/all')?>",
                method: 'GET'
            },
            columns: [
                { data: 'id', sortable:false, seacrhable:false, render: (data,type,row,meta)=>{
                    return meta.settings._iDisplayStart + meta.row + 1;
                } 
            },
                { data: 'nama_lengkap' },
                { data: 'gender',
                render: (data, type, meta, row)=>{
                    if( data === 'L'){
                        return 'Laki-Laki';
                    }else if( data === 'P' ){
                        return 'Perempuan';
                    }
                    return data;
                  }
                },
                { data: 'tgl_lhr' },
                { data: 'level',
                    render: (data, type, meta, row)=>{
                    if( data === 'P'){
                        return 'Platinum';
                    }else if( data === 'K' ){
                        return 'King';
                    }
                    return data;
                  }
                },
                { data: 'email' },
                { data: 'nohp' },
                { data: 'alamat' },
                { data: 'kota' },
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