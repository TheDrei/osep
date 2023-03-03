
      {{-- table start --}}
      var users_table = $('#users_table').DataTable({
        processing: true,
        serverSide: true,
        deferRender: true,
        ajax: {
          url: "{{ route('users.table') }}",
          method: "GET",
          data : {
            '_token': '{{ csrf_token() }}'
          }
        },
        columns: [      
            {data: 'first_name', name: 'first_name'},
            {data: 'last_name', name: 'last_name'},
            {data: 'agency', name: 'agency'}, 
            {data: 'username', name: 'username'},  
            {data: 'user_role', name: 'user_role'},        
            {data: 'is_pcaarrd', name: 'is_pcaarrd',
              render: function (data, type, row) {
              if (type === 'display' || type === 'filter' ) {
                return data=='1' ? 'Yes' : 'No';
              }
                return data;
              }
            },       
            {data: 'is_active', name: 'is_active',
              render: function (data, type, row) {
              if (type === 'display' || type === 'filter' ) {
                return data=='1' ? 'Yes' : 'No';
              }
                return data;
              }
            },
            {data: 'action', orderable: false, searchable: false}          
        ]
      });

      var user_id;
   
    {{-- table end --}}

    {{-- START --}}
      {{-- modal start --}}
        $('#user_modal').on('hidden.bs.modal', function(){       
          init_view_user();
          clear_fields()
          clear_attributes()
          users_table.ajax.reload()
        });  
        $('#user_modal').on('shown.bs.modal', function () {
          $('#username').focus();
        })  
      {{-- modal end --}}

      {{-- view start --}}
        function init_view_user(){
          $('.user-field')
            .val('')
            .attr('disabled', true);

          $('.save-buttons')
            .removeClass('d-inline')
            .addClass('d-none')
            .attr('disabled', true);
        }

        function view_user(user_id){
          var request = $.ajax({
            method: "GET",
            url: "{{ route('users.show') }}",
            data: {
              '_token': '{{ csrf_token() }}',
              'id' : user_id
            }
          });
          return request;
        }

        $('#users_table').on('click', '.view-user', function(e){     
          $('#user_modal_header').html("View User");     
          user_id = $(this).parents('tr').attr('data-id');
          init_view_user();   
          var request = view_user(user_id);   
          request.then(function(data) {
            if(data['status'] == 1){
              $('.user-field').each(function() {
                $(this).val(data['users'][$(this).attr('id')]).change();
              });       
              if(data['users']['is_active'] == 1) {
                $('#user_is_active').iCheck('check'); 
              }  
            }
                          
          })
          $('#user_modal').modal('toggle');
        })
      {{-- view end --}}

      {{-- add start --}}
        function init_add_user(){
          init_view_user();
          $('.user-field')
            .attr('disabled', false);

          $('#add_user.save-buttons')
            .addClass('d-inline')
            .removeClass('d-none')
            .attr('disabled', false);
        }

        $('#add_new_user').on('click', function(){ 
          clear_fields();
          init_add_user();          
          $('#user_modal_header').html("Add User Account");
          $('#user_modal').modal('toggle')
        })
    
      $('#add_agency_class').on('click', function(event){   
        event.prevenDefault;         
        clear_attributes() 
        $.ajax({
          method: "POST",
          url: "{{ route('users.store') }}",
          data: {
            '_token': '{{ csrf_token() }}',
            'first_name' : $('#first_name').val(),
            'last_name' : $('#last_name').val(),
            'username' : $('#username').val(),
            'password' : $('#password').val(),     
            'is_pcaarrd' :  ($('#user_is_pcaarrd').iCheck('update')[0].checked ? 1  : 0),
            'is_active' :  ($('#user_is_active').iCheck('update')[0].checked ? 1  : 0)
          },
          success:function(data) {
            console.log(data);
            if(data.errors) {         
              if(data.errors.username){
                $('#username').addClass('is-invalid');
                $('#username-error').html(data.errors.username[0]);
              } 
              if(data.errors.password){
                $('#password').addClass('is-invalid');           
                $('#password-error').html(data.errors.password[0]);
              }                             
            }
            if(data.success) {
              
              Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: 'User has been successfully added.',
                showConfirmButton: false,
                timer: 1500
              }) 
             $('#user_modal').modal('toggle')
             users_table.ajax.reload();
          }
        },
      });
    })
    {{-- add end --}}
      
      {{-- update start --}}
        function init_update_user(){
          init_view_user()
          $('.user-field')
            .attr('disabled', false);

          $('#update_users.save-buttons')
            .addClass('d-inline')
            .removeClass('d-none')
            .attr('disabled', false);
        }

         $('#update_agency_class').on('click', function(event){
        event.preventDefault();
        clear_attributes()
        Swal.fire({
          title: 'Are you sure you want to save changes?',
          icon: 'warning',
          showCancelButton: true,
          confirmButtonText: 'Yes'
        })
        .then((result) => {
          if (result.value) {
            var request = $.ajax({
            method: "PATCH",
            url: "{{ route('users.update') }}",
            data: {
              '_token': '{{ csrf_token() }}',
              'id' : user_id,
            'first_name' : $('#first_name').val(),
            'last_name' : $('#last_name').val(),
            'username' : $('#username').val(),
            'password' : $('#password').val(),     
            'is_pcaarrd' :  ($('#user_is_pcaarrd').iCheck('update')[0].checked ? 1  : 0),
            'is_active' :  ($('#user_is_active').iCheck('update')[0].checked ? 1  : 0)
            },
            success:function(data) {
              console.log(data);
              if(data.errors) {         
                if(data.errors.username){
                  $('#username').addClass('is-invalid');
                  $('#username-error').html(data.errors.username[0]);
                } 
                if(data.errors.password){
                  $('#password').addClass('is-invalid');           
                  $('#password-error').html(data.errors.password[0]);
                }                             
              }
              if(data.success) {
                
                Swal.fire({
                  position: 'top-end',
                  icon: 'success',
                  title: 'User has been successfully edited.',
                  showConfirmButton: false,
                  timer: 1500
                }) 
                $('#user_modal').modal('toggle')  
                users_class_table.ajax.reload(); 
              }                      
              }                             
            });                                
          }       
        }) 

        $('#users_table').on('click', '.update-user', function(){
          $('#user_modal_header').html("Update User");         
          init_update_user();
          user_id = $(this).parents('tr').attr('data-id');
          var request = view_user(user_id);
          request.then(function(data) {
            if(data['status'] == 1){
              $('.user-field').each(function() {
                $(this).val(data['users'][$(this).attr('id')]).change();
              });    
              if(data['users']['is_active'] == 1) {
                $('#user_is_active').iCheck('check'); 
              }  
            }
                          
          })
          $('#user_modal').modal('toggle')            
        })
      {{-- update end --}}

      {{-- delete start --}}
        $('#users_table').on('click', '.delete-user', function(e){
          user_id = $(this).parents('tr').attr('data-id');
          delete_user(user_id);
        })

        function delete_user(user_id){
          Swal.fire({
            title: 'Are you sure you want to delete?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes'
          })
          .then((result) => {
            if (result.value) {
              $.ajax({
                method: "PATCH",
                url: "{{ route('users.delete') }}",
                data: {
                  '_token': '{{ csrf_token() }}',
                  'id' : user_id
                },
                success: function(data) {      
                  Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'User has been successfully deleted.',
                    showConfirmButton: false,
                    timer: 1500
                  }) 
                  users_table.ajax.reload();          
                }             
              })    
            }       
          })
        }
      {{-- delete end --}}      
    {{-- END --}}