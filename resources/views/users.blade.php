<!DOCTYPE html>
<html>
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <link href="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/jquery-editable/css/jquery-editable.css" rel="stylesheet"/>
    <script>$.fn.poshytip={defaults:null}</script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/jquery-editable/js/jquery-editable-poshytip.min.js"></script>
</head>
<body>
      
@if (@$user)
<div class="container">
    <h1 align="center">View Student</h1>
    <table class="table table-bordered data-table">
        <thead>
            <tr>
                <th>No</th>
                <th>Name</th>
                <th>Phone</th>
                <th>E-mail</th>
            </tr>
        </thead>
        <tbody>
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>
                        <a href="" class="update" data-name="Nombre" data-type="text" data-pk="{{ $user->id }}" data-title="Enter name">{{ $user->Nombre }}</a>
                    </td>
                    <td>
                        <a href="" class="update" data-name="Telefono" data-type="text" data-pk="{{ $user->id }}" data-title="Enter phone">{{ $user->Telefono }}</a>
                    </td>
                    <td>
                        <a href="" class="update" data-name="Correo" data-type="text" data-pk="{{ $user->id }}" data-title="Enter email">{{ $user->Correo }}</a>
                    </td>
                </tr>
        </tbody>
    </table>
    <h4 align="center">
        <a href="{{ route('users.home') }}" class="btn btn-warning">Back</a>
    </h4>
</div>
@else
<div class="container">
    <h1 align="center" class="mb-3">Students List</h1>
    <table class="table table-bordered data-table">
        <thead>
            <tr>
                <th>No</th>
                <th>Name</th>
                <th>Phone</th>
                <th>E-mail</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>
                        {{ $user->Nombre }}
                    </td>
                    <td>
                        {{ $user->Telefono }}
                    </td>
                    <td>
                        {{ $user->Correo }}
                    </td>
                    <td>
                        <a href="{{ route('users.index', ['id' => $user->id] ) }}" class="btn btn-info btn-sm">Edit</a>
                        <form  action="/estudiantes/{{$user->id}}" method="post">
                                @csrf
                                @method('DELETE')
                            <input type="submit" class="btn btn-danger btn-sm" value="delete " >
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<hr class="my-5">
     
<div class="container">
    <h2 align="center" class="mb-3">Create new Student</h2>  
    <div class="form-group">
         <form name="add_name" id="add_name">  

            <div class="alert alert-danger print-error-msg" style="display:none">
            <ul></ul>
            </div>


            <div class="alert alert-success print-success-msg" style="display:none">
            <ul></ul>
            </div>


            <div class="table-responsive">  
                <table class="table table-bordered" id="dynamic_field">  
                    <tr>  
                        <td><input type="text" name="name" placeholder="Enter your Name" class="form-control name_list" /></td>  
                        <td><input type="text" name="telefono" placeholder="Enter your phone" class="form-control name_list" /></td>  
                        <td><input type="text" name="correo" placeholder="Enter your e-mail" class="form-control name_list" /></td>  
                    </tr>  
                </table>  
                <input type="button" name="submit" id="submit" class="btn btn-info" value="Submit" />  
            </div>


         </form>  
    </div> 
</div>

@endif
     
<script type="text/javascript">
    $.fn.editable.defaults.mode = 'inline';
  
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': '{{csrf_token()}}'
        }
    }); 
  
    $('.update').editable({
           url: "{{ route('users.change',  ['id' => @$user->id] ) }}",
           type: 'text',
           pk: 1,
           title: 'Enter name',
           ajaxOptions: {
                type: 'put'
            } 
    });

    $(document).ready(function(){      
      var postURL = "<?php echo url('estudiantes'); ?>";
      var i=1;  


      $('#add').click(function(){  
           i++;  
           $('#dynamic_field').append('<tr id="row'+i+'" class="dynamic-added"><td><input type="text" name="name[]" placeholder="Enter your Name" class="form-control name_list" /></td><td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button></td></tr>');  
      });  


      $(document).on('click', '.btn_remove', function(){  
           var button_id = $(this).attr("id");   
           $('#row'+button_id+'').remove();  
      });  


      $.ajaxSetup({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });


      $('#submit').click(function(){            
           $.ajax({  
                url:postURL,  
                method:"POST",  
                data:$('#add_name').serialize(),
                type:'json',
                success:function(data)  
                {
                    if(data.error){
                        printErrorMsg(data.error);
                    }else{
                        i=1;
                        $('.dynamic-added').remove();
                        $('#add_name')[0].reset();
                        $(".print-success-msg").find("ul").html('');
                        $(".print-success-msg").css('display','block');
                        $(".print-error-msg").css('display','none');
                        $(".print-success-msg").find("ul").append('<li>Record Inserted Successfully.</li>');
                    }
                }  
           });  
      });  


      function printErrorMsg (msg) {
         $(".print-error-msg").find("ul").html('');
         $(".print-error-msg").css('display','block');
         $(".print-success-msg").css('display','none');
         $.each( msg, function( key, value ) {
            $(".print-error-msg").find("ul").append('<li>'+value+'</li>');
         });
      }
    });  
</script>
</body>
</html>