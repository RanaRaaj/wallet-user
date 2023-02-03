(function(window, undefined) {
    'use strict';

    /*
    NOTE:
    ------
    PLACE HERE YOUR OWN JAVASCRIPT CODE IF NEEDED
    WE WILL RELEASE FUTURE UPDATES SO IN ORDER TO NOT OVERWRITE YOUR JAVASCRIPT CODE PLEASE CONSIDER WRITING YOUR SCRIPT HERE.  */

})(window);
$("body").on("click", 'a.delete', function () {
    var from = $(this).parent('form');
    var task_id = $( this ).attr( "data-id" );
    var url = $( this ).attr( "data-url" );
    var back = $( this ).attr( "data-back" );
    data = {
      id: task_id
    }
    swal({
        title: 'Are you sure?',
        text: 'You won\'t be able to revert this!',
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!',
        closeOnConfirm: true,
        closeOnCancel: true
    }).then(function (isConfirm) {
        if (isConfirm.value) {
            $.ajax({
              type:'post',
              headers: {
                  'X-CSRF-TOKEN': $( 'meta[name="csrf-token"]' ).attr( 'content' )
              },
              url:'/'+url,
              data:data,
              success:function(msg){
                swal({
                  title: msg,
                  type: 'success',
                }).then((result) => {
                  window.location.href = "/"+back;              
                })
              }
            });
        }
    }).catch(swal.noop)
});


$("body").on("click", 'a.inactive', function () {
    var from = $(this).parent('form');
    swal({
        title: 'Are you sure?',
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, inactive it!',
        closeOnConfirm: true,
        closeOnCancel: true
    }).then(function (isConfirm) {
        if (isConfirm.value) {
            from.submit();
        }
    }).catch(swal.noop)
});

$("body").on("click", 'a.active', function () {
    var from = $(this).parent('form');
    swal({
        title: 'Are you sure?',
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, active it!',
        closeOnConfirm: true,
        closeOnCancel: true
    }).then(function (isConfirm) {
        if (isConfirm.value) {
            from.submit();
        }
    }).catch(swal.noop)
});
