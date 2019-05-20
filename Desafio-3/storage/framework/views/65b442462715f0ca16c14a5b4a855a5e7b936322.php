<!doctype html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
<!-- CSRF Token -->
<meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
<title>Desafio-3</title>
<link rel="icon" type="image/png" href="<?php echo e(asset('favicon.png')); ?>">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
<link  href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker.css" rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/js/bootstrap-datepicker.js"></script>
</head>
<body>
 
<div class="container">
<br>
<a href="javascript:void(0)" class="btn btn-info ml-3" id="create-new-user">Adicionar Novo Usuario</a>
<br><br>
 
<table class="table table-bordered table-striped" id="laravel_datatable">
   <thead>
      <tr>
         <th>ID</th>
         <th>S. No</th>
         <th>Nome</th>
         <th>Email</th>
         <th>Data Nascimento</th>
         <th>Action</th>
      </tr>
   </thead>
</table>
</div>
 
<div class="modal fade" id="ajax-crud-modal" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
    <div class="modal-header">
        <h4 class="modal-title" id="userCrudModal"></h4>
    </div>
    <div class="modal-body">
        <form id="userForm" name="userForm" class="form-horizontal">
           <input type="hidden" name="user_id" id="user_id">
            <div class="form-group">
                <label for="name" class="col-sm-2 control-label">Nome</label>
                <div class="col-sm-12">
                    <input type="text" class="form-control" id="nome" name="nome" placeholder="Digite seu Nome" value="" maxlength="50" required="">
                </div>
            </div>
 
            <div class="form-group">
                <label class="col-sm-2 control-label">Email</label>
                <div class="col-sm-12">
                    <input type="email" class="form-control" id="email" name="email" placeholder="Digite seu email" value="" required="">
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-2 control-label">Senha</label>
                <div class="col-sm-12">
                    <input type="password" class="form-control  " id="senha" name="senha" placeholder="Digite sua senha" value="" required="">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-5 control-label">Data Nascimento</label>
                <div class="col-sm-12">
                    <input type="text" class="form-control date" id="dnascimento" placeholder="Data Nascimento" name="dnascimento"  value="" required="">
                </div>
            </div>
            <div class="col-sm-offset-2 col-sm-10">
             <button type="submit" class="btn btn-primary" id="btn-save" value="create">Cadastrar
             </button>
            </div>
        </form>
    </div>
    <div class="modal-footer">
        
    </div>
</div>
</div>
</div>
</body>
</html>
<script>
var SITEURL = '<?php echo e(URL::to('')); ?>';
 $(document).ready( function () {
   $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
  });
  $('#laravel_datatable').DataTable({
         processing: true,
         serverSide: true,
         ajax: {
          url: SITEURL,
          type: 'GET',
         },
         columns: [
                  {data: 'id', name: 'id', 'visible': false},
                  {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false,searchable: false},
                  { data: 'nome', name: 'nome' },
                  { data: 'email', name: 'email' },
                  { data: 'datanascimento', name: 'datanascimento' },
                  {data: 'action', name: 'action', orderable: false},
               ],
        order: [[0, 'desc']]
      });
    $('.date').datepicker({  
       format: 'dd-mm-yyyy'
     });  

    $('#create-new-user').click(function () {
        $('#btn-save').val("create-user");
        $('#user_id').val('');
        $('#userForm').trigger("reset");
        $('#userCrudModal').html("Novo Usuario");
        $('#ajax-crud-modal').modal('show');
    });
 
   /* When click edit user */
    $('body').on('click', '.edit-user', function () {
      var user_id = $(this).data('id');
      $.get('/' + user_id +'/atualizarUsuario', function (data) {
         $('#name-error').hide();
         $('#email-error').hide();
         $('#userCrudModal').html("Editar Usuario");
          $('#btn-save').val("edit-user");
          $('#ajax-crud-modal').modal('show');
          $('#user_id').val(data.id);
          $('#nome').val(data.nome);
          $('#email').val(data.email);
          $('#senha').val(data.senha);
          $('.date').datepicker().datepicker("setDate", new Date(data.datanascimento));
      })
   });
    $('body').on('click', '#delete-user', function () {
 
        var user_id = $(this).data("id");
        confirm("Deseja Mesmo Apagar Usuario ?!");
 
        $.ajax({
            type: "get",
            url: SITEURL + "/deletarUsuario/"+user_id,
            success: function (data) {
            var oTable = $('#laravel_datatable').dataTable(); 
            oTable.fnDraw(false);
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    });   
   });
 
if ($("#userForm").length > 0) {
      $("#userForm").validate({
 
     submitHandler: function(form) {
 
      var actionType = $('#btn-save').val();
      $('#btn-save').html('Enviando..');
      
      $.ajax({
          data: $('#userForm').serialize(),
          url: SITEURL + "/criarUsuario",
          type: "POST",
          dataType: 'json',
          success: function (data) {
              console.log(data);
              $('#userForm').trigger("reset");
              $('#ajax-crud-modal').modal('hide');
              $('#btn-save').html('Save Changes');
              var oTable = $('#laravel_datatable').dataTable();
              oTable.fnDraw(false);
              
          },
          error: function (data) {
              console.log('Error:', data);
              $('#btn-save').html('Save Changes');
          }
      });
    }
  })
}
</script><?php /**PATH C:\laragon\www\Desafio-3\resources\views/usuarioAjax.blade.php ENDPATH**/ ?>