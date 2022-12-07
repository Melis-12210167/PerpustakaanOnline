<?=$this->extend('backend/template')?>

<?=$this->section('content')?>

<div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-900">Bahasa</h1>
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
                                    <table id="table-bahasa" class="datatable table table-bordered">
                                        <thead>
                                            <tr>
                                            <th>No</th>
                                            <th>Kode</th>
                                            <th>Nama</th>
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
                <h5 class="modal-title">Form Bahasa</h5>
                <button class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="formBahasa" method="post" action="<?=base_url('bahasa')?>">
                    <input type="hidden" name="id" />
                    <input type="hidden" name="_method" />
                    <div class="mb-3">
                        <label class="form-label">Kode</label>
                        <input type="text" name="kode" class="form-control"/>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nama</label>
                        <input type="text" name="nama" class="form-control"/>
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
            $('form#formBahasa').submit();
        });

        $('table#table-bahasa').on('click', '.btn-edit', function(){
            let id = $(this).data('id');
            let baseurl = "<?=base_url()?>";
            $.get(`${baseurl}/bahasa/${id}`).done((e)=>{
                $('input[name=id]').val(e.id);
                $('input[name=kode]').val(e.kode);
                $('input[name=nama]').val(e.nama);
                $('#modalForm').modal('show');
                $('input[name=_method]').val('patch');
            });
        });

        
        $('table#table-bahasa').on('click', '.btn-hapus', function(){
            let konfirmasi = confirm ('serius hapus data?');
            if(konfirmasi === true){
                let _id = $(this).data('id');
                let baseurl = "<?=base_url()?>";

                $.post(`${baseurl}/bahasa`, {id:_id, _method:'delete'}).done(function(e){
                    $('table#table-bahasa').DataTable().ajax.reload();
                });
            }
        }); 

        $('form#formBahasa').submitAjax({
            pre:()=>{
                $('button#btn-kirim').hide();
            },
            pasca:()=>{
                $('button#btn-kirim').show();
            },
            success:(response, status)=>{
                $("#modalForm").modal('hide');
                $("table#table-bahasa").DataTable().ajax.reload();
            },
            error: (xhr, status)=>{
                alert('maaf,data bahasa gagal direkam');
            },
        });

        $('button#btn-tambah').on('click', function(){
            $('#modalForm').modal('show');
            $('form#formBahasa').trigger('reset');
        });

        $('table#table-bahasa').DataTable({
            processing: true,
            serverSide: true,
            ajax:{
                url: "<?=base_url('bahasa/all')?>",
                method: 'GET'
            },
            columns: [
                { data: 'id', sortable:false, seacrhable:false, render: (data,type,row,meta)=>{
                    return meta.settings._iDisplayStart + meta.row + 1;
                } 
            },
                { data: 'kode' },
                { data: 'nama' },
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